@extends('template.admin.header')

@section('content')
<div class="page-wrapper">
    <div class="content" style="overflow-y: auto; height: calc(100vh - 60px);">
        <div class="page-header">
            <div class="page-title">
                <h4>Appointments</h4>
                <h6>Appointment Lists</h6>
            </div>
            <div class="page-btn">
                <a data-bs-target="#addAppointment" data-bs-toggle="modal" class="btn btn-added">
                    <img src="{{ asset('assets/img/icons/plus.svg') }}" alt="img">Add Appointment
                </a>
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
                            @forelse ($appointments as $appointment)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($appointment->DateTime)->format('h:i A') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($appointment->DateTime)->format('Y-m-d') }}</td>
                                    <td>{{ $appointment->patient->complete_name ?? 'N/A' }}</td>
                                    <td>{{ $appointment->patient->age ?? 'N/A' }}</td>
                                    <td>
                                        @if ($appointment->Status == 'pending')
                                            <span class="bg-lightyellow badges">Pending</span>
                                        @elseif ($appointment->Status == 'confirm')
                                            <span class="bg-lightgreen badges">Confirm</span>
                                        @elseif ($appointment->Status == 'completed')
                                            <span class="bg-lightgreen badges">Completed</span>
                                        @elseif ($appointment->Status == 'cancelled')
                                            <span class="badges bg-lightred">Cancelled</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a class="me-3" href="#" data-bs-toggle="modal" data-bs-target="#viewAppointment">
                                                <img src="{{ asset('assets/img/icons/eye.svg') }}" alt="View Appointment">
                                            </a>
                                            <a class="me-3" href="#">
                                                <img src="{{ asset('assets/img/icons/edit.svg') }}" alt="img">
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="5">No appointments found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Appointment Modal -->
<div class="modal fade" id="addAppointment">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content w-100">
            <div class="modal-header">
                <h4 class="modal-title">New Appointment</h4>
                <button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('admin.storeAppointment') }}">
                    @csrf
                    <input type="hidden" id="patient_id" name="patientID" value="">
                    <div class="form-floating mb-3">
                        <input id="cname" type="text" name="complete_name" placeholder="Name" class="form-control" required autofocus value="{{ old('complete_name') }}" />
                        <label for="cname">Complete Name</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input id="age" type="text" name="age" class="form-control" placeholder="Age" required value="{{ old('age') }}" />
                        <label for="age">Age</label>
                    </div>

                    <div class="form-floating mb-3">
                        <select name="gender" class="form-control" id="floatingSelect" required>
                            <option value="" disabled selected>Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Female">Other</option>
                        </select>
                        <span class="arrow"></span>
                        <label for="floatingSelect">Gender</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" placeholder="Enter contact number" name="contact_number" required value="{{ old('contact_number') }}">
                        <label for="contact_number">Contact Number</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" placeholder="Enter address" name="address" required value="{{ old('address') }}">
                        <label for="address">Address</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="datetime-local" class="form-control" name="DateTime" required>
                        <label for="date">Appointment Date</label>
                    </div>

                    <div class="modal-footer justify-content-end">
                        <button class="btn btn-sm btn-primary" type="submit">Submit</button>
                        <button class="btn btn-sm btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




<!-- View Appointment Modal -->
<div class="modal fade" id="viewAppointment" tabindex="-1" aria-labelledby="viewAppointmentLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content w-100">
            <div class="modal-header">
                <h4 class="modal-title" id="viewAppointmentLabel">Appointment Details</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <strong>Appointment Schedule:</strong>
                    <span id="appointmentSchedule"></span>
                </div>
                
                <div class="mb-3">
                    <strong>Patient Name:</strong>
                    <span id="patientName"></span>
                </div>
                
                <div class="mb-3">
                    <strong>Age:</strong>
                    <span id="patientAge"></span>
                </div>
                
                <div class="mb-3">
                    <strong>Gender:</strong>
                    <span id="patientGender"></span>
                </div>
                
                <div class="mb-3">
                    <strong>Contact Number:</strong>
                    <span id="contactNumber"></span>
                </div>
                
                <div class="mb-3">
                    <strong>Address:</strong>
                    <span id="patientAddress"></span>
                </div>

                <div class="mb-3">
                    <strong>Status:</strong>
                    <span id="appointmentStatus"></span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<style>
.text-orange {
    color: orange !important;
}

.text-green {
    color: green !important;
}

.text-red {
    color: red !important;
}

</style>


@endsection
