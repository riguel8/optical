document.addEventListener("DOMContentLoaded", function () {
    let currentAppointmentId = null;

    // Handle decline button click
    document.querySelectorAll('.btn-decline').forEach(button => {
        button.addEventListener('click', function () {
            currentAppointmentId = this.getAttribute('data-id');
        });
    });

    // Handle confirm action
    document.getElementById('confirm-action').addEventListener('click', function () {
        if (!currentAppointmentId) return;

        const modal = bootstrap.Modal.getInstance(document.getElementById('confirmModal'));
        modal.hide();

        // Show processing state
        Swal.fire({
            title: 'Processing Cancellation',
            html: `
                <div class="text-center">
                    <p>Please wait while we process your cancellation...</p>
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            `,
            allowOutsideClick: false,
            showConfirmButton: false
        });

        // Send cancellation request
        fetch(`/client/appointments/${currentAppointmentId}/update-status`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                status: 'Cancelled'
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Appointment Cancelled',
                    html: `
                        <div class="text-center">
                            <p>Your appointment has been cancelled successfully.</p>
                            <p class="small text-muted">All relevant parties have been notified.</p>
                        </div>
                    `,
                    showConfirmButton: true,
                    confirmButtonColor: '#28a745',
                    confirmButtonText: 'OK'
                }).then(() => {
                    location.reload();
                });
            } else {
                throw new Error(data.message || 'Failed to cancel appointment');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Cancellation Failed',
                html: `
                    <div class="text-center">
                        <p class="text-danger">${error.message || 'Failed to cancel appointment.'}</p>
                        <p class="small text-muted">Please try again or contact support if the problem persists.</p>
                    </div>
                `,
                confirmButtonColor: '#dc3545'
            });
        });
    });
});