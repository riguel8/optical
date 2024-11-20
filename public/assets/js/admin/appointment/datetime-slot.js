document.addEventListener('DOMContentLoaded', function () {
    const addAppointmentDateInput = document.getElementById('appointmentDate');
    const editAppointmentDateInput = document.getElementById('edit_appointmentDate');
    
    const addTimeSelectionInputs = document.querySelectorAll('input[name="appointment_time"]');
    const editTimeSelectionInputs = document.querySelectorAll('input[name="edit_appointment_time"]');
    
    function resetModalState(timeSelectionInputs) {
        timeSelectionInputs.forEach(input => {
            input.disabled = false;
            input.checked = false;
        });
    }

    function checkAvailability(date, timeSelectionInputs) {
        fetch(`/appointments/check-availability?date=${date}`)
            .then(response => response.json())
            .then(data => {
                console.log('Availability Check:', data);
                timeSelectionInputs.forEach(function (timeInput) {
                    const appointmentTime = timeInput.value;
                    const timeSlotAvailable = !data.unavailableSlots.includes(appointmentTime);

                    timeInput.disabled = !timeSlotAvailable;
                });
            })
            .catch(error => console.error('Error checking availability:', error));
    }

    if (addAppointmentDateInput) {
        addAppointmentDateInput.addEventListener('change', function () {
            const selectedDate = addAppointmentDateInput.value;
            console.log('Selected Date (Add Appointment): ', selectedDate);
            checkAvailability(selectedDate, addTimeSelectionInputs);
        });
    }

    if (editAppointmentDateInput) {
        editAppointmentDateInput.addEventListener('change', function () {
            const selectedDate = editAppointmentDateInput.value;
            console.log('Selected Date (Edit Appointment): ', selectedDate);
            checkAvailability(selectedDate, editTimeSelectionInputs);
        });
    }

    addTimeSelectionInputs.forEach(function (timeInput) {
        timeInput.addEventListener('change', function () {
            const selectedTime = timeInput.checked ? timeInput.value : null;
            console.log('Selected Time (Add): ', selectedTime);
        });
    });

    editTimeSelectionInputs.forEach(function (timeInput) {
        timeInput.addEventListener('change', function () {
            const selectedTime = timeInput.checked ? timeInput.value : null;
            console.log('Selected Time (Edit): ', selectedTime);
        });
    });

    $('#addAppointment').on('show.bs.modal', function () {
        resetModalState(addTimeSelectionInputs);
        addAppointmentDateInput.value = '';
    });


    $('#editAppointment').on('show.bs.modal', function () {
        resetModalState(editTimeSelectionInputs);
        editAppointmentDateInput.value = '';
    });
});

document.addEventListener("DOMContentLoaded", function() {
    const today = new Date();
    const tomorrow = new Date(today);
    tomorrow.setDate(tomorrow.getDate() + 1);
    const minDate = tomorrow.toISOString().split("T")[0];

    const appointmentDateInput = document.getElementById("appointmentDate");
    const editAppointmentDateInput = document.getElementById("edit_appointmentDate");

    if (appointmentDateInput) {
        appointmentDateInput.setAttribute("min", minDate);
    }

    if (editAppointmentDateInput) {
        editAppointmentDateInput.setAttribute("min", minDate);
    }
});