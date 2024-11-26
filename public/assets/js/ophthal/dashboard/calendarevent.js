$(document).ready(function () {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridWeek,dayGridMonth,listDay'
        },
        buttonText: {
            dayGridWeek: "Week",
            dayGridMonth: "Month",
            listDay: "Day",
            listWeek: "Week",
        },
        events: {
            url: '/ophthal/dashboard/get_appointments',
            method: 'GET',
            failure: function () {
                alert('There was an error while fetching appointments!');
            }
        },
        eventContent: function (arg) {
            let status = arg.event.extendedProps.status;
            let color = getStatusColor(status);
            let time = arg.event.start
                ? FullCalendar.formatDate(arg.event.start, { hour: '2-digit', minute: '2-digit', hour12: true })
                : '';

            return {
                html: `
                    <div style="text-align: left; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                        <div style="display: flex; align-items: center; gap: 5px;">
                            <span class="dot" style="height: 10px; width: 10px; background-color: ${color}; border-radius: 50%;"></span>
                            <span style="font-weight: bold; font-size: 14px;">${arg.event.title}</span>
                        </div>
                        <div style="font-size: 12px; color: gray; margin-top: 2px;">${time}</div>
                    </div>
                `
            };
        },
        eventClick: function (info) {
            $.ajax({
                url: '/ophthal/dashboard/get_appointment_details',
                method: 'GET',
                data: { appointmentId: info.event.id },
                dataType: 'json',
                success: function (data) {
                    console.log("Fetched appointment details:", data);

                    if (data && !data.error) {
                        document.getElementById('appointmentSchedule').textContent = new Date(data.DateTime).toLocaleString();
                        document.getElementById('patientName').textContent = data.complete_name;
                        document.getElementById('patientAge').textContent = data.age || 'N/A';
                        document.getElementById('patientGender').textContent = data.gender;
                        document.getElementById('contactNumber').textContent = data.contact_number;
                        document.getElementById('patientAddress').textContent = data.address;

                        document.getElementById('appointmentStatus').innerHTML = getStatusBadge(data.Status);

                        $('#viewAppointmentModal').modal('show');
                    } else {
                        alert(data.error || 'Failed to fetch appointment details.');
                    }
                },
                error: function (xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                    alert('Failed to fetch appointment details.');
                }
            });
        }
    });

    calendar.render();
});

function getStatusColor(status) {
    switch (status) {
        case 'Pending':
            return '#f90';
        case 'Confirm':
            return '#28c76f';
        case 'Completed':
            return '#0d6efd';
        case 'Cancelled':
            return '#ea5455';
        default:
            return 'gray';
    }
}

function getStatusBadge(status) {
    let badgeClass;
    let statusText;

    if (status === 'Pending') {
        badgeClass = 'bg-lightyellow badges';
        statusText = 'Pending';
    } else if (status === 'Confirm') {
        badgeClass = 'bg-lightgreen badges';
        statusText = 'Confirm';
    } else if (status === 'Completed') {
        badgeClass = 'bg-primary badges';
        statusText = 'Completed';
    } else if (status === 'Cancelled') {
        badgeClass = 'badges bg-lightred';
        statusText = 'Cancelled';
    } else {
        badgeClass = 'badges';
        statusText = 'Unknown Status';
    }

    return `<span class="${badgeClass}">${statusText}</span>`;
}
