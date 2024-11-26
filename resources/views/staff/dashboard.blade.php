@extends('template.staff.layout')

@section('content')
    <div class="page-wrapper">
        <div class="content" style="overflow-y: auto; height: calc(100vh - 60px);">
            <div class="row">
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="page-title">Welcome {{ session('name') }}</h3>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6 col-12 d-flex">
                    <div class="dash-count">
                        <div class="dash-counts">
                            <h4>{{ $patientCount }}</h4>
                            <h5>Patients</h5>
                        </div>
                        <div class="dash-imgs">
                            <i class="si si-people"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12 d-flex">
                    <div class="dash-count das1">
                        <div class="dash-counts">
                            <h4>4</h4>
                            <h5>Staff</h5>
                        </div>
                        <div class="dash-imgs">
                            <i class="si si-user-following"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12 d-flex">
                    <div class="dash-count das2">
                        <div class="dash-counts">
                            <h4>{{ $appointmentCount }}</h4>
                            <h5>Appointments</h5>
                        </div>
                        <div class="dash-imgs">
                            <i class="si si-event"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12 d-flex">
                    <div class="dash-count das3">
                        <div class="dash-counts">
                            <h4>{{ $eyewearCount }}</h4>
                            <h5>Available Eyewears</h5>
                        </div>
                        <div class="dash-imgs">
                            <i class="si si-eyeglass"></i>
                        </div>
                    </div>
                </div>  
            </div>
            <div class="page-header">
                <div class="page-title">
                </div>
                <div class="page-btn">
                    <a data-bs-target="#addAppointment" data-bs-toggle="modal" class="btn btn-added">
                        <iconify-icon icon="streamline:waiting-appointments-calendar" width="24" height="24" data-bs-toggle="tooltip" data-bs-placement="top" title="New Appointment"></iconify-icon>
                    </a>
                </div>
            </div>
            <div class="col-lg-12 col-md-8">
                <div class="card bg-white">
                    <div class="card-body">
                        <div id="calendar"></div>
                        <!-- Legend -->
                        <div class="calendar-legend d-flex justify-content-center mt-3">
                            <div class="legend-item">
                                <span class="legend-color" style="background-color: #f90;"></span> Pending
                            </div>
                            <div class="legend-item">
                                <span class="legend-color" style="background-color: #28c76f;"></span> Confirm
                            </div>
                            <div class="legend-item">
                                <span class="legend-color" style="background-color: #0d6efd;"></span> Completed
                            </div>
                            <div class="legend-item">
                                <span class="legend-color" style="background-color: #ea5455;"></span> Cancelled
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- View Appointment Modal -->
    <div class="modal fade" id="viewAppointmentModal" tabindex="-1" aria-labelledby="viewAppointmentLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 style="text-align: center; width: 100%;" class="modal-title" id="viewAppointmentLabel">Appointment Details</h4>
                    <button class="close" type="button" aria-label="Close" data-bs-dismiss="modal">
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
  
 <!-- Add Appointment Modal -->
 <div class="modal fade" id="addAppointment">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content w-100">
                <div class="modal-header">
                    <h4 class="modal-title">New Appointment</h4>
                    <button class="close" type="button" aria-label="Close" data-bs-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="padding: 30px;">
                    <form id="addAppointmentForm" method="POST" action="{{ route('staff.appointments.store') }}">
                        @csrf
                        <input type="hidden" id="patient_id" name="patientID" value="">
                        <div class="row">
                            <div class="col-md-6 border-end">
                                <h4>Personal Information</h4>
                                <p>Fields with * are required</p>
                                
                                <div class="form-floating mb-3">
                                    <input id="cname" type="text" name="complete_name" placeholder="Name" class="form-control" required autofocus value="{{ old('complete_name') }}" />
                                    <label for="cname">Complete Name *</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input id="age" type="text" name="age" class="form-control" placeholder="Age" required value="{{ old('age') }}" />
                                    <label for="age">Age *</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <select name="gender" class="form-control" id="floatingSelect" required>
                                        <option value="" disabled selected>Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                    </select>
                                    <label for="floatingSelect">Gender</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input class="form-control" type="text" placeholder="Enter contact number" name="contact_number" required value="{{ old('contact_number') }}">
                                    <label for="contact_number">Contact Number *</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input class="form-control" type="text" placeholder="Enter address" name="address" required value="{{ old('address') }}">
                                    <label for="address">Address *</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="date" id="appointmentDate" class="form-control" name="appointment_date" required>
                                    <label for="appointmentDate">Appointment Date *</label>
                                </div>
                                <h5 class="mt-4">Select Time</h5>
                                <div class="time-selection d-flex flex-wrap gap-2">
                                    @for ($hour = 10; $hour <= 21; $hour++)
                                        @for ($minute = 0; $minute < 60; $minute += 30)
                                            <input type="radio" class="btn-check" name="appointment_time" id="time-{{ $hour }}-{{ $minute }}" value="{{ sprintf('%02d:%02d', $hour, $minute) }}" required>
                                            <label class="btn btn-outline-primary time-box" for="time-{{ $hour }}-{{ $minute }}">
                                                {{ date('g:i A', strtotime(sprintf('%02d:%02d', $hour, $minute))) }}
                                            </label>
                                        @endfor
                                    @endfor
                                </div>
                                <div class="mt-4 d-flex justify-content-end gap-2">
                                    <button class="btn btn-lg btn-submit w-100 me-2" type="submit">Submit</button>
                                    <button class="btn btn-lg btn-cancel w-100" type="button" data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @section("scripts")
        <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/fullcalendar/main.js') }}"></script>
        <script src="{{ asset('assets/js/staff/dashboard/calendarevent.js') }}"></script>
        <script src="{{ asset('assets/js/staff/appointment/appointmentform.js')}}"></script>
        <script src="{{ asset('assets/js/staff/appointment/datetime-slot.js')}}"></script>
    @endsection

@endsection
