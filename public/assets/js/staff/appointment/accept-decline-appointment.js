document.addEventListener("DOMContentLoaded", function () {
    let currentAction = '';
    let appointmentId = '';

    document.querySelectorAll('.btn-accept').forEach(button => {
        button.addEventListener('click', function () {
            currentAction = 'accept';
            appointmentId = this.getAttribute('data-id');
            document.getElementById('action-type').textContent = 'Accept';
        });
    });

    document.querySelectorAll('.btn-decline').forEach(button => {
        button.addEventListener('click', function () {
            currentAction = 'decline';
            appointmentId = this.getAttribute('data-id');
            document.getElementById('action-type').textContent = 'Decline';
        });
    });


    document.getElementById('confirm-action').addEventListener('click', function () {
        const appointmentNote = document.getElementById('AppointmentNote').value;

        const modal = bootstrap.Modal.getInstance(document.getElementById('confirmModal'));
        modal.hide();
  
        Swal.fire({
            title: 'Processing...',
            text: 'Updating appointment status and sending notification.',
            icon: 'info',
            allowOutsideClick: false,
            showConfirmButton: false,
            willOpen: () => {
                Swal.showLoading();
            }
        });


        fetch(`/staff/appointments/${appointmentId}/update-status`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                status: currentAction === 'accept' ? 'Confirm' : 'Cancelled',
                note: appointmentNote
            })
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
   
                    Swal.fire({
                        title: 'Success!',
                        text: 'Appointment status updated and email notification sent.',
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        location.reload(); 
                    });
                } else {
                    throw new Error(data.message || 'Unknown error occurred.');
                }
            })
            .catch(error => {
                console.error(error);

                Swal.fire({
                    title: 'Error!',
                    text: 'Failed to process the request. Please try again.',
                    icon: 'error',
                    timer: 3000,
                    showConfirmButton: false
                });
            });
    });
});
