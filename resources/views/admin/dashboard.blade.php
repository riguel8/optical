@include('template.admin.header')


        @include('template.admin.navbar')
        @include('template.admin.sidebar')

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
                            <h4>100</h4>
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
                            <h4>100</h4>
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
                            <h4>105</h4>
                            <h5>Available Eyewears</h5>
                        </div>
                        <div class="dash-imgs">
                            <i class="si si-eyeglass"></i>
                        </div>
                    </div>
                </div>  
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Line Chart</div>
                        </div>
                        <div class="card-body chart-set">
                            <div class="h-250" id="flotLine1"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Bar Chart</div>
                        </div>
                        <div class="card-body chart-set">
                            <div class="h-250" id="flotBar2"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-md-8">
                <div class="card bg-white">
                    <div class="card-body">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>  
        </div>
    </div>

    
    <div class="modal fade" id="viewAppointmentModal" tabindex="-1" role="dialog" aria-labelledby="viewAppointmentModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewAppointmentModalLabel">Appointment Details</h5>
                    <button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                </div>
                <div class="modal-footer justify-content-end">
                    <button class="btn btn-sm btn-primary" type="button" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@include('template.admin.footer')
