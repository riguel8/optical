@include('template.admin.header')


        @include('template.admin.navbar')
        @include('template.admin.sidebar')
        <div class="page-wrapper">
            <div class="content">
                <div class="page-header">
                    <div class="page-title">
                        <h4>Appointments</h4>
                        <h6>Appointment Lists</h6>
                    </div>
                    <div class="page-btn">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newAppointmentModal">
                            Add New Appointment
                        </button>
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
                                                <div class="btn-group" role="group" aria-label="Basic example">
                                                    <a class="me-3" href="#">
                                                        <img src="{{ asset('assets/img/icons/eye.svg') }}" alt="img">
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




        <!-- Modal Part (Adding new Appointment) -->

        <div class="modal fade" id="newAppointmentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">New Appointment</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
          
                <!-- Modal Body with Form -->
                <div class="modal-body">
                  <form action="{{ route('appointments.add') }}" method="POST">
                    @csrf
                    <!-- Information section -->
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
          
                    <!-- Modal Footer with Submit and Cancel buttons -->
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        


@include('template.admin.footer')