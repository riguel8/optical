<footer>
    <div class="text-center p-3">
        <p>&copy; 2024 SoftDev, BSIT-3A. All Rights Reserved.</p>
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
<script src="{{ asset('assets/plugins/sweetalert/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('assets/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/js/script.js') }}"></script>

<!-- Commented out scripts -->
<!-- <script src="{{ asset('assets/js/dataTables.buttons.min.js') }}"></script> -->
<script src="{{ asset('assets/js/jszip.min.js') }}"></script>
<script src="{{ asset('assets/js/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/js/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/js/xlsx.full.min.js') }}"></script>
<script src="{{ asset('assets/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/js/buttons.print.min.js') }}"></script>
<!-- <script src="{{ asset('assets/js/listTable.js') }}"></script> -->

<!-- Plugins -->
<script src="{{ asset('assets/plugins/flot/jquery.flot.js') }}"></script>
<script src="{{ asset('assets/plugins/flot/jquery.flot.fillbetween.js') }}"></script>
<script src="{{ asset('assets/plugins/flot/jquery.flot.pie.js') }}"></script>
<script src="{{ asset('assets/plugins/flot/chart-data.js') }}"></script>

<!-- Pang modal(di pako sure maong ge lahi nako) - Karl -->
{{-- <script src="{{ asset('assets/formodal/bootstrap.bundle.min.js') }}"></script> --}}

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
                            window.location.href = "{{ url('appointments') }}";
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
$(document).ready(function() {
    // Similar AJAX requests for handling patient forms and deletion
});
</script>



</body>
</html>
