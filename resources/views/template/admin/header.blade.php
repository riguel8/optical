<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
  <title>Delin Optical</title>

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

  <!-- FontAwesome and Icons -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/icons/pe7/pe-icon-7.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/simpleline/simple-line-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/icons/feather/feather.css') }}">

  <!-- Custom Styles -->
  <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">


  <!-- Pang modal(di pako sure maong ge lahi nako) - Karl -->
  {{-- <link href="{{ asset('assets/formodal/bootstrap.min.css') }}" rel="stylesheet"> --}}

</head>
<body>
    <head>
  <div id="global-loader">
    <div class="whirly-loader"> </div>
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

<!-- Appointment modal -->
      <div class="modal fade" id="newAppointmentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">New Appointment</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
              <form action="{{ route('appointments.add') }}" method="POST">
                @csrf
                <div class="mb-3">
                  <label for="patientName" class="form-label">Patient Name</label>
                  <input type="text" class="form-control" id="patientName" name="patient_name" required>
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                  <label for="address" class="form-label">Address</label>
                  <input type="text" class="form-control" id="address" name="address" required>
                </div>
                <div class="mb-3">
                  <label for="contact" class="form-label">Contact</label>
                  <input type="text" class="form-control" id="contact" name="contact" required>
                </div>
                <div class="mb-3">
                  <label for="age" class="form-label">Age</label>
                  <input type="number" class="form-control" id="age" name="age" required>
                </div>
                <div class="mb-3">
                  <label for="appointmentDate" class="form-label">Set Date</label>
                  <input type="date" class="form-control" id="appointmentDate" name="appointment_date" required>
                </div>


                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>


      <!-- Admin add patient modal -->

      <div class="modal fade" id="add" tabindex="-1" aria-labelledby="add" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Patients</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label"><strong>Patients Name</strong></label>
                                    <input class="form-control" type="text" placeholder="Enter Patients Name" name="complete_name" required="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label"><strong>Age</strong></label>
                                    <input class="form-control" type="text" placeholder="Enter Age" name="age" required="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                    <div class="mb-3 custom-select">
                                        <label class="form-label"><strong>Prescription</strong></label>
                                        <div class="select-wrapper">
                                            <select name="prescription" class="form-control">
                                                <option value="" disabled selected>Select Prescription</option>
                                                <option value="(OD) Right Eye">(OD) Right Eye</option>
                                                <option value="(OS) Left Eye">(OS) Left Eye</option>
                                                <option value="(OU) Both Eyes">(OU) Both Eyes</option>
                                            </select>
                                            <span class="arrow"></span>
                                        </div>
                                    </div>
                                </div>
                            <div class="col-md-6">
                                <div class="mb-3 custom-select">
                                    <label class="form-label"><strong>Gender</strong></label>
                                    <div class="select-wrapper">
                                        <select name="gender" class="form-control">
                                            <option value="" disabled selected>Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Other</option>
                                        </select>
                                        <span class="arrow"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3 custom-select">
                                    <label class="form-label"><strong>Lens</strong></label>
                                    <div class="select-wrapper">
                                        <select name="lens" class="form-control">
                                            <option value="" disabled selected>Select Lens</option>
                                            <option value="SINGLE VISION">SINGLE VISION</option>
                                            <option value="DOUBLE VISION">DOUBLE VISION</option>
                                            <option value="PROGRESSIVE">PROGRESSIVE</option>
                                            <option value="NEAR VISION">NEAR VISION</option>
                                        </select>
                                        <span class="arrow"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label"><strong>Frame</strong></label>
                                    <input class="form-control" type="text" placeholder="Enter Frame" name="frame" required="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label"><strong>Price</strong></label>
                                    <input class="form-control" type="number" placeholder="Enter Price" name="price" required="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label"><strong>Date</strong></label>
                                    <input type="datetime-local" class="form-control" name="date" required="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label"><strong>Contact Number</strong></label>
                                    <input class="form-control" type="text" placeholder="Enter contact number" name="contact_number" required="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label"><strong>Address</strong></label>
                                    <input class="form-control" type="address" placeholder="Enter address" name="address" required="">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-end">
                            <button class="btn btn-sm btn-primary " type="submit">Save</button>
                            <button class="btn btn-sm btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

