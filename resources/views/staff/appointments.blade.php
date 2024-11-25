@extends('template.staff.layout')

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

		<section class="comp-section">
			<div class="card bg-white">

				<div class="card-body">
					<ul class="nav nav-tabs nav-tabs-solid nav-justified">
						<li class="nav-item"><a class="nav-link active" href="#solid-justified-tab1" data-bs-toggle="tab">Pending Appointments</a></li>
						<li class="nav-item"><a class="nav-link" href="#solid-justified-tab2" data-bs-toggle="tab">Confirmed Appointments</a></li>
						<li class="nav-item"><a class="nav-link" href="#solid-justified-tab3" data-bs-toggle="tab">Cancelled Appointments</a></li>
					</ul>

					<div class="tab-content">
                        <div class="table-top">
							<div class="wordset">
								<ul>
									<li>
										<a class="pdf-btn" data-bs-toggle="tooltip" data-bs-placement="top" title="pdf">
											<img src="{{ asset('assets/img/icons/pdf.svg') }}" alt="img">
										</a>
									</li>
									<li>
										<a class="excel-btn" data-bs-toggle="tooltip" data-bs-placement="top" title="excel">
											<img src="{{ asset('assets/img/icons/excel.svg') }}" alt="img">
										</a>
									</li>
                                    <li>
										<a class="btn-archive text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Archive Appointments">
                                            <iconify-icon icon="ic:outline-archive" width="24" height="24"></iconify-icon>
										</a>
									</li>
								</ul>
							</div>
						</div>
						<div class="tab-pane show active" id="solid-justified-tab1">
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
										@if ($appointment->Status == 'Pending')
										<tr>
                                            <td>{{ \Carbon\Carbon::parse($appointment->DateTime)->format('g:i A') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($appointment->DateTime)->format('F-j-Y') }}</td>
											<td>{{ $appointment->patient->complete_name ?? 'N/A' }}</td>
											<td>{{ $appointment->patient->age ?? 'N/A' }}</td>
											<td>
                                                <button class="btn-accept" data-id="{{ $appointment->AppointmentID }}" data-bs-toggle="modal" data-bs-target="#confirmModal">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-check" viewBox="0 0 16 16" data-bs-toggle="tooltip" data-bs-placement="top" title="Accept Appointment">
                                                        <path d="M13.485 3.485a1 1 0 0 1 0 1.414L7 10.414 4.707 8.121a1 1 0 1 1 1.414-1.414L7 7.586l5.879-5.88a1 1 0 0 1 1.414 0z"/>
                                                    </svg>
                                                </button>
                                                <button class="btn-decline" data-id="{{ $appointment->AppointmentID }}" data-bs-toggle="modal" data-bs-target="#confirmModal" >
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-x" viewBox="0 0 16 16" data-bs-toggle="tooltip" data-bs-placement="top" title="Decline Appointment">
                                                        <path d="M4.646 4.646a1 1 0 0 1 1.414 0L8 6.586l2.939-2.94a1 1 0 1 1 1.414 1.414L9.414 8l2.939 2.94a1 1 0 0 1-1.414 1.414L8 9.414l-2.939 2.94a1 1 0 0 1-1.414-1.414L6.586 8 3.646 5.06a1 1 0 0 1 0-1.414z"/>
                                                    </svg>
                                                </button>
											</td>
											<td>
												<a class="me-3 view-appointment" href="#" data-id="{{ $appointment->AppointmentID }}" data-bs-toggle="modal" data-bs-target="#viewAppointment">
													<img src="{{ asset('assets/img/icons/eye.svg') }}" alt="img" data-bs-toggle="tooltip" data-bs-placement="top" title="View Appointment">
												</a>

												@if ($appointment->Status != 'Cancelled')
												<a class="me-3 edit-appointment" href="#" data-id="{{ $appointment->AppointmentID }}" data-bs-toggle="modal" data-bs-target="#editAppointment">
													<img src="{{ asset('assets/img/icons/edit.svg') }}" alt="img" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Appointment">
												</a>
												@else
												<a class="me-3 d-inline-block" style="pointer-events: none; opacity: 0.5;">
													<img src="{{ asset('assets/img/icons/edit.svg') }}" alt="img" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Appointment (Unavailable)">
												</a>
												@endif

												@if ($appointment->Status != 'Completed')
												<a class="me-3 btn-delete" data-id="{{ $appointment->AppointmentID }}" href="#" data-bs-toggle="modal" data-bs-target="#deleteModal">
													<img src="{{ asset('assets/img/icons/delete.svg') }}" alt="img" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Appointment">
												</a>
												@else
												<a class="me-3 d-inline-block" style="pointer-events: none; opacity: 0.5;">
													<img src="{{ asset('assets/img/icons/delete.svg') }}" alt="img" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Appointment (Unavailable)">
												</a>
												@endif
											</td>
										</tr>
										@endif
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
						<div class="tab-pane" id="solid-justified-tab2">
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
                                            <td>{{ \Carbon\Carbon::parse($appointment->DateTime)->format('g:i A') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($appointment->DateTime)->format('F-j-Y') }}</td>
											<td>{{ $appointment->patient->complete_name ?? 'N/A' }}</td>
											<td>{{ $appointment->patient->age ?? 'N/A' }}</td>
											<td>
												@if ($appointment->Status == 'Pending')
												<span class="bg-lightyellow badges">Pending</span>
												@elseif ($appointment->Status == 'Confirm')
												<span class="bg-lightgreen badges">Confirm</span>
												@elseif ($appointment->Status == 'Completed')
												<span class="bg-primary badges">Completed</span>
												@elseif ($appointment->Status == 'Cancelled')
												<span class="bg-lightred badges">Cancelled</span>
												@endif
											</td>
											<td>
												<a class="me-3 view-appointment" href="#" data-id="{{ $appointment->AppointmentID }}" data-bs-toggle="modal" data-bs-target="#viewAppointment">
													<img src="{{ asset('assets/img/icons/eye.svg') }}" alt="img" data-bs-toggle="tooltip" data-bs-placement="top" title="View Appointment">
												</a>

												@if ($appointment->Status != 'Cancelled')
												<a class="me-3 edit-appointment" href="#" data-id="{{ $appointment->AppointmentID }}" data-bs-toggle="modal" data-bs-target="#editAppointment">
													<img src="{{ asset('assets/img/icons/edit.svg') }}" alt="img" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Appointment">
												</a>
												@else
												<a class="me-3 d-inline-block" style="pointer-events: none; opacity: 0.5;">
													<img src="{{ asset('assets/img/icons/edit.svg') }}" alt="img" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Appointment (Unavailable)">
												</a>
												@endif

												@if ($appointment->Status != 'Completed')
												<a class="me-3 btn-delete" data-id="{{ $appointment->AppointmentID }}" href="#" data-bs-toggle="modal" data-bs-target="#deleteModal">
													<img src="{{ asset('assets/img/icons/delete.svg') }}" alt="img" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Appointment">
												</a>
												@else
												<a class="me-3 d-inline-block" style="pointer-events: none; opacity: 0.5;">
													<img src="{{ asset('assets/img/icons/delete.svg') }}" alt="img" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Appointment (Unavailable)">
												</a>
												@endif
											</td>
										</tr>
										@endif
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
						<div class="tab-pane" id="solid-justified-tab3">
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
										@if ($appointment->Status == 'Cancelled')
										<tr>
                                            <td>{{ \Carbon\Carbon::parse($appointment->DateTime)->format('g:i A') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($appointment->DateTime)->format('F-j-Y') }}</td>
											<td>{{ $appointment->patient->complete_name ?? 'N/A' }}</td>
											<td>{{ $appointment->patient->age ?? 'N/A' }}</td>
											<td>
												@if ($appointment->Status == 'Pending')
												<span class="bg-lightyellow badges">Pending</span>
												@elseif ($appointment->Status == 'Confirm')
												<span class="bg-lightgreen badges">Confirm</span>
												@elseif ($appointment->Status == 'Completed')
												<span class="bg-primary badges">Completed</span>
												@elseif ($appointment->Status == 'Cancelled')
												<span class="bg-lightred badges">Cancelled</span>
												@endif
											</td>
											<td>
												<a class="me-3 view-appointment" href="#" data-id="{{ $appointment->AppointmentID }}" data-bs-toggle="modal" data-bs-target="#viewAppointment">
													<img src="{{ asset('assets/img/icons/eye.svg') }}" alt="img" data-bs-toggle="tooltip" data-bs-placement="top" title="View Appointment">
												</a>

												@if ($appointment->Status != 'Cancelled')
												<a class="me-3 edit-appointment" href="#" data-id="{{ $appointment->AppointmentID }}" data-bs-toggle="modal" data-bs-target="#editAppointment">
													<img src="{{ asset('assets/img/icons/edit.svg') }}" alt="img" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Appointment">
												</a>
												@else
												<a class="me-3 d-inline-block" style="pointer-events: none; opacity: 0.5;">
													<img src="{{ asset('assets/img/icons/edit.svg') }}" alt="img" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Appointment (Unavailable)">
												</a>
												@endif

												@if ($appointment->Status != 'Completed')
												<a class="me-3 btn-delete" data-id="{{ $appointment->AppointmentID }}" href="#" data-bs-toggle="modal" data-bs-target="#deleteModal">
													<img src="{{ asset('assets/img/icons/delete.svg') }}" alt="img" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Appointment">
												</a>
												@else
												<a class="me-3 d-inline-block" style="pointer-events: none; opacity: 0.5;">
													<img src="{{ asset('assets/img/icons/delete.svg') }}" alt="img" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Appointment (Unavailable)">
												</a>
												@endif
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
		</section>               
	</div>
</div>


<!-- Add Appointment Modal -->
<div class="modal fade" id="addAppointment">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content w-100">
            <div class="modal-header">
                <h4 class="modal-title">New Appointment</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
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

<!-- View Appointment Modal -->
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
                            <h6><span id="appointmentSchedule"></span></h6>
                        </li>
                        <li>
                            <h4><strong>Patient Name</strong></h4>
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


<!-- Modal for Editing Appointment -->
<div class="modal fade" id="editAppointment">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content w-100">
            <div class="modal-header">
                <h4 class="modal-title">Edit Appointment</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 30px;">
                <form method="POST" action="" id="editAppointmentForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="appointment_id" name="AppointmentID" value="">
                    <div class="row">
                        <div class="col-md-6 border-end">
                            <h4>Personal Information</h4>
                            <p>Fields with * are required</p>

                            <div class="form-floating mb-3">
                                <input id="edit_cname" type="text" name="complete_name" placeholder="Name" class="form-control" required autofocus value="{{ old('complete_name') }}" />
                                <label for="edit_cname">Complete Name *</label>
                            </div>


                            <div class="form-floating mb-3">
                                <input id="edit_age" type="text" name="age" class="form-control" placeholder="Age" required value="{{ old('age') }}" />
                                <label for="edit_age">Age *</label>
                            </div>

                            <div class="form-floating mb-3">
                                <select name="gender" class="form-control" id="edit_floatingSelect" required>
                                    <option value="" disabled selected>Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                                <label for="edit_floatingSelect">Gender</label>
                            </div>


                            <div class="form-floating mb-3">
                                <input id="edit_contact_number" type="text" name="contact_number" class="form-control" placeholder="Enter Contact Number" required value="{{ old('contact_number') }}" />
                                <label for="edit_contact_number">Contact Number *</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input id="edit_address" type="text" name="address" class="form-control" placeholder="Enter Address" required value="{{ old('address') }}" />
                                <label for="edit_address">Address *</label>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <input type="hidden" id="edit_appointmentDateTime" name="DateTime">
                            <div class="form-floating mb-3">
                                <input type="date" id="edit_appointmentDate" class="form-control" name="appointment_date" required>
                                <label for="edit_appointmentDate">Appointment Date *</label>
                            </div>
                            <h5 class="mt-4">Select Time</h5>
                           <div class="time-selection d-flex flex-wrap gap-2">
                                @for ($hour = 10; $hour <= 21; $hour++)
                                    @for ($minute = 0; $minute < 60; $minute += 30)
                                        <input type="radio" class="btn-check" name="edit_appointment_time" id="edit_time-{{ $hour }}-{{ $minute }}" value="{{ sprintf('%02d:%02d', $hour, $minute) }}" required>
                                        <label class="btn btn-outline-primary time-box" for="edit_time-{{ $hour }}-{{ $minute }}">
                                            {{ date('g:i A', strtotime(sprintf('%02d:%02d', $hour, $minute))) }}
                                        </label>
                                    @endfor
                                @endfor
                            </div>
                            <br>
                            <div class="form-floating mb-3">
                                <select name="Status" class="form-control" id="edit_status" required>
                                    <option value="Pending">Pending</option>
                                    <option value="Confirm">Confirm</option>
                                    <option value="Completed">Completed</option>
                                    <option value="Cancelled">Cancelled</option>
                                </select>
                                <span class="arrow"></span>
                                <label for="edit_status">Appointment Status</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" id="edit_appointmentNote" class="form-control" placeholder="Enter Note" name="Notes" />
                                <label for="edit_appointmentNote"> Appointment Note </label>
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

<!-- Modal for Confirming Accept/Decline -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 style="text-align: center; width: 100%;" class="modal-title">Confirm Action</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center" style="padding: 20px;">
                Are you sure you want to <span id="action-type" style="font-weight: bold; color: #007bff;">Accept</span> this appointment?
            </div>
            <div class="modal-body text-center" style="padding: 1px">
                Add Note: <input type="text" id="AppointmentNote" name="AppointmentNote" required>
            </div>
            <div class="modal-footer justify-content-center">
                <button class="btn btn-sm btn-submit me-2" id="confirm-action" type="submit">Confirm</button>
                <button class="btn btn-sm btn-cancel" type="button" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>


    @section('scripts')
        <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>    
        <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/js/dataTables.bootstrap5.min.js') }}"></script>

        <script src="{{ asset("assets/js/staff/appointment/appointmentform.js")}}"></script>
        <script src="{{ asset("assets/js/staff/appointment/view-appointment.js")}}"></script>
        <script src="{{ asset("assets/js/staff/appointment/accept-decline-appointment.js")}}"></script>
        <script src="{{ asset("assets/js/staff/appointment/edit-update.js")}}"></script>
        <script src="{{ asset("assets/js/staff/appointment/datetime-slot.js")}}"></script>
        
        <!-- Delete modal -->
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.btn-delete');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault(); 
                    const id = this.getAttribute('data-id'); 

                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'You won\'t be able to revert this!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#ff9f43',
                        cancelButtonColor: '#dc3545',
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch(`/staff/appointments/${id}`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}', 
                                    'Accept': 'application/json',
                                },
                            })
                            .then(response => {
                                if (response.ok) {
                                    Swal.fire(
                                        'Deleted!',
                                        'Appointment has been deleted.',
                                        'success',
                                    ).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        'There was a problem deleting the Appointment.',
                                        'error'
                                    );
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                            });
                        }
                    });
                });
            });
        });
        </script>
    @endsection

@endsection

