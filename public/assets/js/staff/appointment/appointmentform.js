$(document).ready(function() {
    $('#addAppointmentForm').submit(function(e) {
        e.preventDefault(); 
        
        toastr.options = {
            closeButton: true,
            progressBar: true,
            positionClass: "toast-top-right", 
            timeOut: 2000,
            showMethod: "slideDown", 
            hideMethod: "slideUp",   
            showDuration: 300,     
            hideDuration: 200,      
            extendedTimeOut: 1000      
        };

        var formData = $(this).serialize();

        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    toastr.success(response.message, 'Appointment Added');
                    $('#addAppointment').modal('hide');
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                } else {
                    toastr.error('Failed to add the appointment: ' + response.message, 'Error');
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                toastr.error('An unexpected error occurred. Please try again later.', 'Error');
            }
        });
    });
});
