document.addEventListener('DOMContentLoaded', function () {
    const editButtons = document.querySelectorAll('.edit-appointment');
    const editForm = document.querySelector('#editAppointmentForm');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            const AppointmentID = this.getAttribute('data-id');
            document.getElementById('appointment_id').value = AppointmentID;
            editForm.action = `/staff/appointments/update/${AppointmentID}`;

            fetch(`/staff/appointments/edit/${AppointmentID}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('edit_cname').value = data.patient.complete_name;
                    document.getElementById('edit_age').value = data.patient.age;
                    document.getElementById('edit_floatingSelect').value = data.patient.gender;
                    document.getElementById('edit_contact_number').value = data.patient.contact_number;
                    document.getElementById('edit_address').value = data.patient.address;
                    document.getElementById('edit_status').value = data.appointment.Status;
                    document.getElementById('edit_appointmentNote').value = data.appointment.Notes;

                    const rawDateTime = data.appointment.DateTime;
                    const appointmentDate = rawDateTime.split('T')[0];
                    const timePart = new Date(rawDateTime).toLocaleTimeString('en-US', {
                        hour: '2-digit',
                        minute: '2-digit',
                        hour12: false,
                    });

                    document.getElementById('edit_appointmentDate').value = appointmentDate;

                    document.querySelectorAll('input[name="edit_appointment_time"]').forEach(input => {
                        input.checked = false;
                        input.disabled = true;
                    });

                    disableTimeSlots(data.takenSlots);

                    const selectedInput = document.querySelector(`input[value="${timePart}"][name="edit_appointment_time"]`);
                    if (selectedInput) {
                        selectedInput.checked = true;
                        selectedInput.disabled = false;
                    }
                })
                .catch(error => console.error('Error fetching appointment details:', error));
        });
    });

    editForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const appointmentDate = document.getElementById('edit_appointmentDate').value;
        const appointmentTime = document.querySelector('input[name="edit_appointment_time"]:checked')?.value;

        if (!appointmentDate || !appointmentTime) {
            alert('Please select both the appointment date and time.');
            return;
        }

        const dateTime = `${appointmentDate} ${appointmentTime}:00`;
        document.getElementById('edit_appointmentDateTime').value = dateTime;

        const formData = new FormData(this);
        formData.append('DateTime', dateTime);

        fetch(editForm.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': csrfToken,
            },
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: data.message,
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message,
                    });
                }
            })
            .catch(error => alert('An unexpected error occurred.'));
            
    });
});

function disableTimeSlots(takenSlots) {
    const timeInputs = document.querySelectorAll('input[name="edit_appointment_time"]');
    timeInputs.forEach(input => {
        input.disabled = takenSlots.includes(input.value);
    });
}
