document.addEventListener("DOMContentLoaded", function() {
    let currentAction = ''; 
    let appointmentId = ''; 

    document.querySelectorAll('.btn-accept').forEach(button => {
        button.addEventListener('click', function() {
            currentAction = 'accept';
            appointmentId = this.getAttribute('data-id');
            document.getElementById('action-type').textContent = 'Accept';
        });
    });

    document.querySelectorAll('.btn-decline').forEach(button => {
        button.addEventListener('click', function() {
            currentAction = 'decline';
            appointmentId = this.getAttribute('data-id');
            document.getElementById('action-type').textContent = 'Decline';
        });
    });

    document.getElementById('confirm-action').addEventListener('click', function() {
        const appointmentNote = document.getElementById('AppointmentNote').value;  

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
                const row = document.querySelector(`tr[data-id='${appointmentId}']`);
                if (row) {
                    const statusColumn = row.querySelector('.status-column');
                    statusColumn.innerHTML = currentAction === 'accept'
                        ? '<span class="bg-lightgreen badges">Confirmed</span>'
                        : '<span class="bg-lightred badges">Cancelled</span>';
                }

                var modal = new bootstrap.Modal(document.getElementById('confirmModal'));
                modal.hide();

                location.reload();
            } else {
                alert('Error updating the appointment status');
            }
        })
        .catch(error => {
            alert('An error occurred. Please try again.');
        });
    });
});
