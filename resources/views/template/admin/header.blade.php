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
    <link rel="stylesheet" href="{{ asset('assets/plugins/alertify/alertify.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/owlcarousel/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fullcalendar/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

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
</head>
<body>
    <div id="global-loader">
        <div class="whirly-loader"></div>
    </div>

    <div class="main-wrapper">
        <div class="header">
            <div class="header-left active">
                <a href="{{ url('admin/dashboard') }}" class="logo">
                    <img src="{{ asset('assets/img/Dlogo.png') }}" alt="">
                </a>
                <a href="{{ url('admin/dashboard') }}" class="logo-small">
                    <img src="{{ asset('assets/img/Dlogo-small.png') }}" alt="">
                </a>
                <a id="toggle_btn" href=""></a>
            </div>

            @include('template.admin.navbar')
            @include('template.admin.sidebar')
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

<!-- External Scripts -->
<script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
<script src="{{ asset('assets/js/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
<script src="{{ asset('assets/plugins/fullcalendar/main.js') }}"></script>
<!-- <script src="{{ asset('assets/plugins/sweetalert/sweetalert2.all.min.js') }}"></script> -->

<script src="{{ asset('assets/js/sweetalert2.min.js') }}"></script>

<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/js/script.js') }}"></script>

<!-- Commented out scripts -->
<!-- <script src="{{ asset('assets/js/dataTables.buttons.min.js') }}"></script> -->
<!-- <script src="{{ asset('assets/js/jszip.min.js') }}"></script>
<script src="{{ asset('assets/js/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/js/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/js/xlsx.full.min.js') }}"></script>
<script src="{{ asset('assets/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/js/buttons.print.min.js') }}"></script> -->
<!-- <script src="{{ asset('assets/js/listTable.js') }}"></script> -->

<!-- Plugins -->
<script src="{{ asset('assets/plugins/flot/jquery.flot.js') }}"></script>
<script src="{{ asset('assets/plugins/flot/jquery.flot.fillbetween.js') }}"></script>
<script src="{{ asset('assets/plugins/flot/jquery.flot.pie.js') }}"></script>
<script src="{{ asset('assets/plugins/flot/chart-data.js') }}"></script>

<script src="{{ asset("assets/plugins/summernote/summernote-bs4.min.js")}}"></script>


<script>
$(document).ready(function() {
    // Target the form directly within the modal
    $('#addAppointment form').submit(function(e) {
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
                        text: response.message,
                        confirmButtonColor: '#ff9f43',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "{{ route('admin.appointments') }}"; 
                        }
                    });
                } else if (response.status === 'error') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message,
                        confirmButtonColor: '#ff9f43',
                        confirmButtonText: 'OK'
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
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridWeek,dayGridMonth,listDay'
            },
            buttonText: {
                dayGridWeek: "Week",
                dayGridMonth: "Month",
                listDay: "Day",
                listWeek: "Week",
            },
            events: {
                url: '{{ url("/admin/dashboard/get_appointments") }}',
                method: 'GET',
                failure: function() {
                    alert('There was an error while fetching appointments!');
                }
            },
            eventClick: function(info) {
                $.ajax({
                    url: '{{ url("/admin/dashboard/get_appointment_details") }}',
                    method: 'GET',
                    data: { appointmentId: info.event.id },
                    dataType: 'json',
                    success: function(data) {
                        console.log("Fetched appointment details:", data); // Debugging

                        if (data && !data.error) {
                            // Populate the modal fields with the data received
                            document.getElementById('appointmentSchedule').textContent = new Date(data.DateTime).toLocaleString();
                            document.getElementById('patientName').textContent = data.complete_name;
                            document.getElementById('patientAge').textContent = data.age || 'N/A'; // Assuming age is available
                            document.getElementById('patientGender').textContent = data.gender;
                            document.getElementById('contactNumber').textContent = data.contact_number;
                            document.getElementById('patientAddress').textContent = data.address;
                            
                            // Use innerHTML to render the badge as HTML
                            document.getElementById('appointmentStatus').innerHTML = getStatusBadge(data.Status);

                            // Show the modal
                            $('#viewAppointmentModal').modal('show');
                        } else {
                            alert(data.error || 'Failed to fetch appointment details.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', status, error);
                        alert('Failed to fetch appointment details.');
                    }
                });
            }
        });

        calendar.render();
    });

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
            statusText = 'Unknown Status'; // Default case if needed
        }

        // Return badge HTML as a string
        return `<span class="${badgeClass}">${statusText}</span>`;
    }
</script>


<script>
// $(document).ready(function() {
//     $('#addAppointmentForm').submit(function(e) {
//         e.preventDefault(); 
        
//         var formData = $(this).serialize();

//         $.ajax({
//             type: 'POST',
//             url: $(this).attr('action'),
//             data: formData,
//             dataType: 'json',
//             success: function(response) {
//                 if (response.status === 'success') {
//                     Swal.fire({
//                         icon: 'success',
//                         title: 'Success!',
//                         text: 'New appointment was added successfully',
//                         confirmButtonColor: '#ff9f43',
//                         confirmButtonText: 'OK'
//                     }).then((result) => {
//                         if (result.isConfirmed) {
//                             window.location.href = "{{ url('appointments') }}";
//                         }
//                     });
//                 } else {
//                     Swal.fire({
//                         icon: 'error',
//                         title: 'Error',
//                         text: 'Failed to add appointment: ' + response.message
//                     });
//                 }
//             },
//             error: function(xhr, status, error) {
//                 console.error(xhr.responseText);
//                 Swal.fire({
//                     icon: 'error',
//                     title: 'Error',
//                     text: 'An error occurred while processing your request. Please try again later.'
//                 });
//             }
//         });
//     });
// });
// </script>

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