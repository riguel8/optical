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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/icons/pe7/pe-icon-7.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/simpleline/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/icons/feather/feather.css') }}">

    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/footer.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote-bs4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/sweetalert2.min.css') }}">

    <style>
        .productset {
            max-height: 200; 
            overflow: hidden; 
            text-align: center; 
        }

        .productsetimg img {
            max-height: 150px; 
            object-fit: cover; 
            width: 100%; 
        }

        .productsetcontent {
            padding: 10px; 
        }

        .filter-sidebar {
            background-color: #f9f9f9;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .filter-link {
            color: #637381;
            text-decoration: none;
        }

        .filter-link:hover {
            color: #1b2850;
        }

        .filter-toggle {
            cursor: pointer;
            color: black;
        }

        .filter-toggle:hover {
            color: #1b2850;
        }

        .filter-group .filter-toggle {
            cursor: pointer;
        }

        .filter-group .toggle-symbol {
            font-weight: bold;
            transition: transform 0.2s;
        }

        .filter-group .collapse.show + .filter-toggle .toggle-symbol {
            transform: rotate(45deg);
        }
        .collapse {
            display: none;
        }

        .collapse.show {
            display: block;
        }
        .input-icon {
            position: relative;
        }
        .input-icon input {
            padding-right: 30px; 
        }
        .input-icon i {
            position: absolute;
            top: 50%;
            right: 20px;
            transform: translateY(-50%);
            cursor: pointer;
        }

    </style>
</head>
<body>
    <div id="global-loader">
        <div class="whirly-loader"> </div>
    </div>

    <div class="main-wrapper">
        <div class="header">
            <div class="header-left active">
                <a href="{{ url('dashboard') }}" class="logo">
                    <img src="{{ asset('assets/img/Dlogo.png') }}" alt="">
                </a>
                <a href="{{ url('dashboard') }}" class="logo-small">
                    <img src="{{ asset('assets/img/Dlogo-small.png') }}" alt="">
                </a>
                <a id="toggle_btn" href=""></a>
            </div>


            @include('template.client.navbar')
            @include('template.client.sidebar')
            @yield('content')
      
            @yield('scripts')
            
<footer>
    <div class="p-2">
        <p>&copy; 2024 Software Development. All Rights Reserved.</p>
    </div>
</footer>

<!-- jQuery and Bootstrap -->
<script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

<!-- Additional JS -->
<script src="{{ asset('assets/js/feather.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/bs-init.js') }}"></script>
<script src="{{ asset('assets/js/dataTables.bootstrap5.min.js') }}"></script>

<!-- Plugins -->
<script src="{{ asset('assets/plugins/flot/jquery.flot.js') }}"></script>
<script src="{{ asset('assets/plugins/flot/jquery.flot.fillbetween.js') }}"></script>
<script src="{{ asset('assets/plugins/flot/jquery.flot.pie.js') }}"></script>
<script src="{{ asset('assets/plugins/flot/chart-data.js') }}"></script>

<!-- Commented out scripts -->
<!-- <script src="{{ asset('assets/js/dataTables.buttons.min.js') }}"></script> -->
<script src="{{ asset('assets/js/jszip.min.js') }}"></script>
<script src="{{ asset('assets/js/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/js/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/js/xlsx.full.min.js') }}"></script>
<script src="{{ asset('assets/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/js/buttons.print.min.js') }}"></script>
<!-- <script src="{{ asset('assets/js/listTable.js') }}"></script> -->

<!-- External Scripts -->
<script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
<script src="{{ asset('assets/js/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
<script src="{{ asset('assets/plugins/fullcalendar/main.js') }}"></script>
<script src="{{ asset('assets/plugins/sweetalert/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('assets/plugins/sweetalert/sweetalerts.min.js') }}"></script>
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/js/script.js') }}"></script>

<script>
$(document).ready(function() {
    // Event listeners for PDF, Excel, and Print buttons
    $('.pdf-btn').on('click', function() {
        table.button('.buttons-pdf').trigger();
    });

    $('.excel-btn').on('click', function() {
        table.button('.buttons-excel').trigger();
    });

    $('.print-btn').on('click', function() {
        window.print();
    });
});
</script>

<script>
$(document).ready(function() {
    // Initialize the FullCalendar
    var calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridWeek,dayGridMonth,listDay'
        },
        buttonText:{
            dayGridWeek :"Week",
            dayGridMonth :"Month",
            listDay :"Day",
            listWeek :"Week",
        },
        events: {
            url: '{{ url("dashboard/get_appointments") }}',
        },
        eventClick: function(info) {
            // Get the appointment ID from the clicked event
            var appointmentId = info.event.id;

            // Fetch appointment details using AJAX
            $.ajax({
                url: '{{ url("dashboard/get_appointment_details") }}',
                method: 'GET',
                data: { appointmentId: appointmentId },
                dataType: 'json',
                success: function(data) {
                    if (data) {
                        // Populate the modal with appointment details
                        var modalContent = `
                            <p><b>Appointment Schedule:</b> ${new Date(data.DateTime).toLocaleString()}</p>
                            <p><b>Patient Name:</b> ${data.complete_name}</p>
                            <p><b>Gender:</b> ${data.gender}</p>
                            <p><b>Contact #:</b> ${data.contact_number}</p>
                            <p><b>Address:</b> ${data.address}</p>
                            <p><b>Status:</b> ${getStatusBadge(data.status)}</p>
                        `;
                        $('#viewAppointmentModal .modal-body').html(modalContent);
                        $('#viewAppointmentModal').modal('show');
                    } else {
                        alert('Failed to fetch appointment details.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Failed to fetch appointment details:', error);
                    alert('Failed to fetch appointment details.');
                }
            });
        }
    });

    calendar.render();
});

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
    $('#addAppointmentForm').submit(function(e) {
        e.preventDefault(); 
        
        var formData = $(this).serialize();

        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'New appointment was added successfully',
                        confirmButtonColor: '#ff9f43',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "{{ url('/client/appointments') }}";
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to add appointment: ' + response.message
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred while processing your request. Please try again later.'
                });
            }
        });
    });
});
</script>

<script>
    // Restore filter state from local storage on page load
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.filter-group').forEach(function (group) {
            const toggle = group.querySelector('.filter-toggle');
            const collapseElement = group.querySelector('.collapse');
            const symbol = toggle.querySelector('.toggle-symbol');
            const filterId = collapseElement.id;

            // Check local storage for the state of this filter
            const isExpanded = localStorage.getItem(filterId) === 'true';

            if (isExpanded) {
                collapseElement.classList.add('show');
                symbol.textContent = '-';
            } else {
                collapseElement.classList.remove('show');
                symbol.textContent = '+';
            }

            // Set up the click event listener for toggling
            toggle.addEventListener('click', function () {
                const isCurrentlyExpanded = collapseElement.classList.contains('show');

                // Toggle the state
                if (isCurrentlyExpanded) {
                    collapseElement.classList.remove('show');
                    symbol.textContent = '+';
                    localStorage.setItem(filterId, 'false');
                } else {
                    collapseElement.classList.add('show');
                    symbol.textContent = '-';
                    localStorage.setItem(filterId, 'true');
                }
            });
        });
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

<!-- script for status color/badge -->
<script>
        function getStatusBadge(status) {
        let badgeClass;
        let statusText;

        // Use if-else to determine badge class and text
        if (status === 'Pending') {
            badgeClass = 'bg-lightyellow badges';
            statusText = 'Pending';
        } else if (status === 'Confirm') {
            badgeClass = 'bg-lightgreen badges';
            statusText = 'Confirm';
        } else if (status === 'Completed') {
            badgeClass = 'bg-lightgreen badges';
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

</script>


</body>
</html>

