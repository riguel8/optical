document.addEventListener('DOMContentLoaded', function () {
    const viewButtons = document.querySelectorAll('.view-appointment');
    viewButtons.forEach(button => {
        button.addEventListener('click', function () {
            const AppointmentId = this.getAttribute('data-id');
            console.log('Fetching details for appointment ID:', AppointmentId);

            fetch(`/staff/appointments/${AppointmentId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    const appointmentDateTime = new Date(data.appointment.DateTime);
                    const formattedDate = formatAppointmentDate(appointmentDateTime);

                    document.getElementById('appointmentSchedule').textContent = formattedDate;
                    document.getElementById('patientName').textContent = data.patient.complete_name;
                    document.getElementById('patientAge').textContent = data.patient.age;
                    document.getElementById('patientGender').textContent = data.patient.gender;
                    document.getElementById('contactNumber').textContent = data.patient.contact_number;
                    document.getElementById('patientAddress').textContent = data.patient.address;
                    document.getElementById('appointmentStatus').innerHTML = getStatusBadge(data.appointment.Status);
                })
                .catch(error => console.error('Error fetching appointment details:', error));
        });
    });
});

function formatAppointmentDate(date) {
    const options = { 
        year: 'numeric', 
        month: 'long', 
        day: 'numeric', 
        hour: 'numeric', 
        minute: 'numeric', 
        second: 'numeric', 
        hour12: true 
    };
    
    const formattedDate = date.toLocaleString('en-US', options);
    const [datePart, timePart] = formattedDate.split(', ');
    return `${datePart}, ${timePart}`;
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