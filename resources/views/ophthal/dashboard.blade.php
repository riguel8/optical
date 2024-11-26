@extends('template.ophthal.layout')

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
                <div class="col-lg-6 col-sm-6 col-12">
                    <div class="dash-widget dash2">
                        <div class="dash-widgetimg">
                            <span><img src="{{ asset("assets/img/icons/group-color.png")}}" alt="img"></span>
                        </div>
                        <div class="dash-widgetcontent">
                            <h5><span class="counters" data-count="{{ $clientcount }}"></span></h5>
                            <h6>Total Clients</h6>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-lg-3 col-sm-6 col-12">
                    <div class="dash-widget dash1">
                        <div class="dash-widgetimg">
                            <span><img src="{{ asset("assets/img/icons/dash2.svg")}}" alt="img"></span>
                        </div>
                        <div class="dash-widgetcontent">
                            <h5>₱<span class="counters" data-count="{{ $totalSales }}"></span></h5>
                            <h6>Total Sales</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="dash-widget dash2">
                        <div class="dash-widgetimg">
                            <span><img src="assets/img/icons/dash3.svg" alt="img"></span>
                        </div>
                        <div class="dash-widgetcontent">
                            <h5>$<span class="counters" data-count="385656.50">385,656.50</span></h5>
                            <h6>Total Sale Amount</h6>
                        </div>
                    </div>
                </div> -->
                <div class="col-lg-6 col-sm-6 col-12">
                    <div class="dash-widget dash3">
                        <div class="dash-widgetimg">
                            <span><img src="{{ asset("assets/img/icons/dash4.svg")}}" alt="img"></span>
                        </div>
                        <div class="dash-widgetcontent">
                            <h5>₱<span class="counters" data-count="{{ $totalSales }}"></span></h5>
                            <h6>Total Sale Amount</h6>
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
                            <h4>{{ $staffcount }}</h4>
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

    @section("scripts")
        <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/fullcalendar/main.js') }}"></script>
        <script src="{{ asset('assets/js/ophthal/dashboard/calendarevent.js') }}"></script>
    @endsection

@endsection