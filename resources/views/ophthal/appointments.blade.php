@extends('template.ophthal.layout')

@section('content') 
<div class="page-wrapper">
    <div class="content"  style="overflow-y: auto; height: calc(100vh - 60px);">
        <div class="page-header">
            <div class="page-title">
                <h4>Appointments</h4>
                <h6>Appointment Lists</h6>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-top">
                    <div class="search-set">
                        <div class="search-input">
                            <a class="btn btn-searchset">
                                <img src="{{ asset('assets/img/icons/search-white.svg') }}" alt="img">
                            </a>
                        </div>
                    </div>
                    <div class="wordset">
                        <ul>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf">
                                    <img src="{{ asset('assets/img/icons/pdf.svg') }}" alt="img">
                                </a>
                            </li>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel">
                                    <img src="{{ asset('assets/img/icons/excel.svg') }}" alt="img">
                                </a>
                            </li>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="print">
                                    <img src="{{ asset('assets/img/icons/printer.svg') }}" alt="img">
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table datanew">
                        <thead>
                            <tr>
                                <th>Time</th>
                                <th>Date</th>
                                <th>Patient Name</th>
                                <th>Patient Age</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($appointments as $appointment)
                                @if ($appointment->Status == 'Confirm')
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($appointment->DateTime)->format('h:i A') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($appointment->DateTime)->format('Y-m-d') }}</td>
                                        <td class="{{ isset($appointment->patient) && $appointment->patient->complete_name ? '' : 'text-red' }}">
                                            {{ $appointment->patient->complete_name ?? 'N/A' }}
                                        </td>
                                        <td class="{{ isset($appointment->patient) && $appointment->patient->age ? '' : 'text-red' }}">
                                            {{ $appointment->patient->age ?? 'N/A' }}
                                        </td>
                                        <td>
                                            <span class="bg-lightgreen badges">Confirm</span>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
												<a class="me-3 view-appointment" href="#" data-id="{{ $appointment->AppointmentID }}" data-bs-toggle="modal" data-bs-target="#viewAppointment">
													<img src="{{ asset('assets/img/icons/eye.svg') }}" alt="img" data-bs-toggle="tooltip" data-bs-placement="top" title="View Appointment">
												</a>
                                                {{-- <a class="me-3" href="#">
                                                    <img src="{{ asset('assets/img/icons/edit.svg') }}" alt="img">
                                                </a> --}}
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="viewAppointment" tabindex="-1" aria-labelledby="viewAppointmentLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 style="text-align: center; width: 100%;" class="modal-title" id="viewAppointmentLabel">Appointment Details</h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body" style="padding: 30px;">
                <div class="productdetails">
                    <ul class="product-bar">
                        <li>
                            <h4><strong>Date/Time</strong></h4>
                            <h6 id="appointmentSchedule"></h6>
                        </li>
                        <li>
                            <h4><strong>Patient Name</strong>
                            <h6><span id="patientName"></span></h6>
                        </li>
                        <li>
                            <h4><strong>Age</strong></h4>
                            <h6><span id="patientAge"></span></h6>
                        </li>
                        <li>
                            <h4><strong>Gender</strong></h4>
                            <h6><span id="patientGender"></span></h6>
                        </li>
                        <li>
                            <h4><strong>Contact Number</strong></h4>
                            <h6><span id="contactNumber"></span></h6>
                        </li>
                        <li>
                            <h4><strong>Address</strong></h4>
                            <h6><span id="patientAddress"></span></h6>
                        </li>
                        <li class="mb-5">
                            <h4><strong>Status</strong></h4>
                            <h6><span id="appointmentStatus"></span></h6>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>




    @section('scripts')
        <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/js/dataTables.bootstrap5.min.js') }}"></script>
    @endsection   




    <script>
    document.addEventListener('DOMContentLoaded', function () {
    const viewButtons = document.querySelectorAll('.view-appointment');
    viewButtons.forEach(button => {
        button.addEventListener('click', function () {
            const AppointmentId = this.getAttribute('data-id');
            console.log('Fetching details for appointment ID:', AppointmentId);

            fetch(`/ophthal/appointments/${AppointmentId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    const appointmentDateTime = new Date(data.appointment.DateTime);
                    const formattedDate = formatAppointmentDate(appointmentDateTime);

                    document.getElementById('appointmentSchedule').textContent = formattedDate;
                    document.getElementById('patientName').textContent = data.patient.complete_name;
                    document.getElementById('patientAge').textContent = data.patient.age;
                    document.getElementById('patientGender').textContent = data.patient.gender;
                    document.getElementById('contactNumber').textContent = data.patient.contact_number;
                    document.getElementById('patientAddress').textContent = data.patient.address;
                    document.getElementById('appointmentStatus').innerHTML = getStatusBadge(data.appointment.Status);
                })
                .catch(error => console.error('Error fetching appointment details:', error));
        });
    });
});

function formatAppointmentDate(date) {
    const options = { 
        year: 'numeric', 
        month: 'long', 
        day: 'numeric', 
        hour: 'numeric', 
        minute: 'numeric', 
        second: 'numeric', 
        hour12: true 
    };
    
    const formattedDate = date.toLocaleString('en-US', options);
    const [datePart, timePart] = formattedDate.split(', ');
    return `${datePart}, ${timePart}`;
}

function getStatusBadge(status) {
    let badgeClass;
    let statusText;

    if (status === 'Pending') {
        badgeClass = 'bg-lightyellow badges';
        statusText = 'Pending';
    } else if (status === 'Confirm') {
        badgeClass = 'bg-lightgreen badges';
        statusText = 'Confirm';
    } else if (status === 'Completed') {
        badgeClass = 'bg-primary badges';
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



@endsection