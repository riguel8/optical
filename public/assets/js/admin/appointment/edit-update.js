
    document.addEventListener('DOMContentLoaded', function () {
        const editButtons = document.querySelectorAll('.edit-appointment');
        const editForm = document.querySelector('#editAppointmentForm');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        editButtons.forEach(button => {
            button.addEventListener('click', function () {
                const AppointmentID = this.getAttribute('data-id');
                document.getElementById('appointment_id').value = AppointmentID;
                editForm.action = `/admin/appointments/update/${AppointmentID}`;

                fetch(`/admin/appointments/edit/${AppointmentID}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('edit_cname').value = data.patient.complete_name;
                        document.getElementById('edit_age').value = data.patient.age;
                        document.getElementById('edit_floatingSelect').value = data.patient.gender;
                        document.getElementById('edit_contact_number').value = data.patient.contact_number;
                        document.getElementById('edit_address').value = data.patient.address;
                        
                        document.getElementById('edit_status').value = data.appointment.Status;

                        document.getElementById('edit_appointmentDate').value = data.appointment.DateTime.split(' ')[0]; // Date only (YYYY-MM-DD)
                    
                        document.querySelectorAll('input[name="edit_appointment_time"]').forEach(timeInput => {
                        timeInput.checked = false;
                    });

                        // disableTimeSlots(data.takenSlots);
                    })
                    .catch(error => console.error('Error fetching appointment details:', error));

                    
            });
        });

        editForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const appointmentDate = document.getElementById('edit_appointmentDate').value;
        const appointmentTime = document.querySelector('input[name="edit_appointment_time"]:checked')?.value;


        if (!appointmentDate || !appointmentTime) {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Please select both the appointment date and time.',
            });
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
                    'X-CSRF-TOKEN': csrfToken
                }
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
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An unexpected error occurred. Please try again.',
                });
            });
        });
    });


    //
    function disableTimeSlots(takenSlots) {
            const timeSelectionInputs = document.querySelectorAll('input[name="appointment_time"]');
            
            console.log("Disabling time slots...");

            timeSelectionInputs.forEach(function (timeInput) {
                const appointmentTime = timeInput.value;
                const timeSlotAvailable = !takenSlots.includes(appointmentTime);

                console.log(`Checking time slot: ${appointmentTime}, Available: ${timeSlotAvailable}`);

                if (timeSlotAvailable) {
                    timeInput.disabled = false;
                } else {
                    timeInput.disabled = true;
                }
            });
        }
