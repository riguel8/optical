document.addEventListener("DOMContentLoaded", function () {
    let currentAction = '';
    let appointmentId = '';

    toastr.options = {
        closeButton: true,
        progressBar: true,
        positionClass: "toast-top-right", 
        timeOut: 3000,
        showMethod: "slideDown",
        hideMethod: "slideUp",
        showDuration: 300,
        hideDuration: 200,
        extendedTimeOut: 2000
    };

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
            text: 'Updating the appointment status and sending a notification. Please wait.',
            icon: 'info',
            allowOutsideClick: false,
            showConfirmButton: false,
            willOpen: () => {
                Swal.showLoading();
            }
        });

        fetch(`/admin/appointments/${appointmentId}/update-status`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                status: currentAction === 'accept' ? 'Confirmed' : 'Cancelled',
                note: appointmentNote
            })
        })
        .then(response => response.json())
        .then(data => {
            Swal.close(); 
            if (data.status === 'success') {
                toastr.success(data.message, 'Success!');
                setTimeout(() => location.reload(), 3000);
            } else {
                toastr.error(data.message || 'An error occurred');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.close();
            toastr.error('An unexpected error occurred', 'Error!');
        });
    });
});
