<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>{{ $title ?? 'Delin Optical' }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/img/Dlogo-small.png') }}" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

    <!-- Additional CSS -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/alertify/alertify.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fullcalendar/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/material/materialdesignicons.css')}}">

    <!-- FontAwesome and Icons -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/icons/pe7/pe-icon-7.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/simpleline/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/icons/feather/feather.css') }}">

    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/contactus.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/appointmentcard.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/eyewearfilter.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/time-select.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/chat-tab.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/chatbot.css') }}">
</head>
<body>
    <div id="global-loader">
        <div class="whirly-loader"> </div>
    </div>

    <div class="main-wrapper">
        <div class="header">
            <div class="header-left active">
                <a href="{{ url('client/dashboard') }}" class="logo">
                    <img src="{{ asset('assets/img/Dlogo.png') }}" alt="">
                </a>
                <a href="{{ url('client/dashboard') }}" class="logo-small">
                    <img src="{{ asset('assets/img/Dlogo-small.png') }}" alt="">
                </a>
                <a id="toggle_btn" href=""></a>
            </div>

            @include('template.client.navbar')

        </div>

            @include('template.client.sidebar')
            @yield('content')

    </div>

    <footer>
        <div class="p-2">
            <p>&copy; 2024 Software Development. All Rights Reserved.</p>
        </div>
    </footer>

    @yield('scripts')




<!-- jQuery and Bootstrap -->
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

<!-- Additional JS -->
<script src="{{ asset('assets/js/feather.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/bs-init.js') }}"></script>
<script src="{{ asset('assets/js/dataTables.bootstrap5.min.js') }}"></script>

<!-- External Scripts -->
<!-- <script src="{{ asset('assets/js/iconify-icon.min.js') }}"></script> -->
<script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
<script src="{{ asset('assets/js/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
<script src="{{ asset('assets/plugins/sweetalert/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/js/script.js') }}"></script>
<!-- <script src="{{ asset("assets/js/showmodal.js")}}"></script> -->

<script src="https://js.pusher.com/8.4/pusher.min.js"></script>
<script>
    window.CURRENT_USER_ID = @json(auth()->id());
</script>
<script src="{{ asset('assets/js/staff/chats/chatting-system.js') }}"></script>



<script>
// Helper function to create status badge
function getStatusBadge(status) {
    var badgeClass;
    var statusText;

    // Determine the badge class and text based on status
    switch (status) {
        case 'Pending':
            badgeClass = 'bg-lightyellow badges';
            statusText = 'Pending';
            break;
        case 'Confirm':
            badgeClass = 'bg-lightgreen badges';
            statusText = 'Confirm';
            break;
        case 'Cancelled':
            badgeClass = 'bg-lightred badges';
            statusText = 'Cancelled';
            break;
        default:
            badgeClass = '';
            statusText = status;
            break;
    }

    // Return the HTML string for the badge
    return `<span class="${badgeClass}">${statusText}</span>`;
}
</script>

<script>
$(document).ready(function() {
    // Define the error handling function within the scope
    function showErrorMessage(message) {
        Swal.fire({
            icon: 'error',
            title: 'Request Failed',
            html: `
                <div class="text-center">
                    <p class="text-danger">${message}</p>
                    <p class="small text-muted">Please try again or contact support if the problem persists.</p>
                </div>
            `,
            confirmButtonColor: '#dc3545'
        });
    }

    $('#addAppointmentForm').submit(function(e) {
        e.preventDefault();
        
        var formData = $(this).serialize();
        var submitButton = $(this).find('button[type="submit"]');
        var originalButtonText = submitButton.html();

        // Show processing state
        Swal.fire({
            title: 'Processing Request',
            html: `
                <div class="text-center">
                    <p>Please wait while we submit your appointment...</p>
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            `,
            allowOutsideClick: false,
            allowEscapeKey: false,
            showConfirmButton: false
        });

        // Disable submit button
        submitButton.prop('disabled', true);
        submitButton.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...');

        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                Swal.close();

                if (response.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Appointment Requested!',
                        html: `
                            <div class="text-center">
                                <p>Your appointment request has been submitted successfully.</p>
                                <p class="small text-muted">You will receive an email confirmation shortly.</p>
                            </div>
                        `,
                        confirmButtonColor: '#28a745',
                        confirmButtonText: 'View My Appointments',
                        showCancelButton: true,
                        cancelButtonText: 'Stay on Page',
                        cancelButtonColor: '#6c757d'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "{{ url('/client/appointments') }}";
                        } else {
                            $('#addAppointmentForm')[0].reset();
                            $('#addAppointment').modal('hide');
                        }
                    });
                } else {
                    showErrorMessage(response.message || 'Failed to process request');
                }
            },
            error: function(xhr, status, error) {
                console.error('Ajax Error:', {
                    status: status,
                    error: error,
                    response: xhr.responseText
                });

                let errorMessage = 'An error occurred while processing your request.';
                
                try {
                    const response = JSON.parse(xhr.responseText);
                    
                    if (xhr.status === 422 && response.errors) {
                        errorMessage = '<ul class="text-left mb-0">';
                        Object.values(response.errors).forEach(function(errors) {
                            if (Array.isArray(errors)) {
                                errors.forEach(function(error) {
                                    errorMessage += `<li>${error}</li>`;
                                });
                            } else {
                                errorMessage += `<li>${errors}</li>`;
                            }
                        });
                        errorMessage += '</ul>';
                    } else if (response.message) {
                        errorMessage = response.message;
                    }
                } catch (e) {
                    console.error('Error parsing response:', e);
                }

                showErrorMessage(errorMessage);
            },
            complete: function() {
                submitButton.prop('disabled', false);
                submitButton.html(originalButtonText);
            }
        });
    });
});
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var introMessage = "Welcome to Delin Optical! How can we assist you today?";
        appendMessage('received', introMessage);
    
        document.querySelectorAll('.question-btn').forEach(function(button) {
            button.addEventListener('click', function() {
                var chatbotId = this.getAttribute('data-chatbot-id');
                var questionText = this.textContent;
                sendMessage(questionText, chatbotId);
            });
        });
    });
    
    function sendMessage(message, chatbotId) {
        const messageId = 'message-' + new Date().getTime(); 
        appendMessage('sent', message, messageId);
    
        scrollToMessage(messageId);
    
        setTimeout(function() {
            showTypingIndicator(messageId);
    
            setTimeout(function() {
                fetch('{{ route("fetchResponse") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ chatbot_id: chatbotId })
                })
                .then(response => response.json())
                .then(data => {
                    removeTypingIndicator();
                    appendMessage('received', data.answer, messageId);
    
                    scrollToMessage(messageId);
                });
            }, 2000); 
        }, 1000); 
    }
    function showTypingIndicator(messageId) {
        var chatMessages = document.getElementById('chat-messages');
        
        if (!document.querySelector('.typing-indicator')) {
            var li = document.createElement('li');
            li.classList.add('media', 'received', 'd-flex', 'typing-indicator');
            li.id = messageId; 
            li.innerHTML = `
                <div class="avatar flex-shrink-0">
                    <img src="{{ asset("assets/img/Dlogo-small.png")}}" alt="Typing..." class="avatar-img rounded-circle">
                </div>
                <div class="media-body flex-grow-1">
                    <div class="msg-box">
                        <div>
                            <div class="msg-typing">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            chatMessages.appendChild(li);
            scrollToMessage(messageId);
        }
    }
    
    function removeTypingIndicator() {
        var typingIndicator = document.querySelector('.typing-indicator');
        if (typingIndicator) {
            typingIndicator.remove();
        }
    }
    
    function appendMessage(type, message, messageId) {
        var chatMessages = document.getElementById('chat-messages');
        var li = document.createElement('li');
        li.classList.add('media', type === 'sent' ? 'sent' : 'received', 'd-flex');
        li.id = messageId;  
        li.innerHTML = `
            <div class="avatar flex-shrink-0">
                <img src="${window.location.origin + '/assets/img/users/' + (type === 'sent' ? 'noimages.jpg' : 'Dlogo-small.png')}" alt="User Image" class="avatar-img rounded-circle">
            </div>
            <div class="media-body flex-grow-1">
                <div class="msg-box">
                    <div>
                        <p>${message}</p>
                        <ul class="chat-msg-info">
                            <li>
                                <div class="chat-time">
                                    <span>${new Date().toLocaleTimeString()}</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        `;
        chatMessages.appendChild(li);
    }
    
    function scrollToMessage(messageId) {
        var messageElement = document.getElementById(messageId);
        if (messageElement) {
            messageElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    }
    
    document.getElementById('chatbotModal').addEventListener('hidden.bs.modal', function () {
        document.getElementById('chat-messages').innerHTML = '';
    });
    </script>



<script>
    var checkeventcount = 1,prevTarget;
        $('.modal').on('show.bs.modal', function (e) {
            if(typeof prevTarget == 'undefined' || (checkeventcount==1 && e.target!=prevTarget))
            {  
              prevTarget = e.target;
              checkeventcount++;
              e.preventDefault();
              $(e.target).appendTo('body').modal('show');
            }
            else if(e.target==prevTarget && checkeventcount==2)
            {
              checkeventcount--;
            }
         });
</script>




</body>
</html>

