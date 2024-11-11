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
										<a class="print-btn" data-bs-toggle="tooltip" data-bs-placement="top" title="print">
											<img src="{{ asset('assets/img/icons/printer.svg') }}" alt="img">
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
											<td>{{ \Carbon\Carbon::parse($appointment->DateTime)->format('h:i A') }}</td>
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
											<td>{{ \Carbon\Carbon::parse($appointment->DateTime)->format('h:i A') }}</td>
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
											<td>{{ \Carbon\Carbon::parse($appointment->DateTime)->format('h:i A') }}</td>
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
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content w-100">
            <div class="modal-header">
                <h4 class="modal-title">New Appointment</h4>
                <button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('admin.appointments.store') }}">
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

                    <div class="mt-auto d-flex justify-content-end gap-2">
                        <button class="btn btn-lg btn-submit w-100" type="submit">Submit</button>
                        <button class="btn btn-lg btn-cancel w-100" type="button" data-bs-dismiss="modal">Cancel</button>
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
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <div class="productdetails">
                    <ul class="product-bar">
                        <li>
                            <h4><strong>Appointment Schedule:</strong></h4>
                            <h6 id="appointmentSchedule"></h6>
                        </li>
                        <li>
                            <h4><strong>Patient Name:</strong>
                            <h6><span id="patientName"></span></h6>
                        </li>
                        <li>
                            <h4><strong>Age:</strong></h4>
                            <h6><span id="patientAge"></span></h6>
                        </li>
                        <li>
                            <h4><strong>Gender:</strong></h4>
                            <h6><span id="patientGender"></span></h6>
                        </li>
                        <li>
                            <h4><strong>Contact Number:</strong></h4>
                            <h6><span id="contactNumber"></span></h6>
                        </li>
                        <li>
                            <h4><strong>Address:</strong></h4>
                            <h6><span id="patientAddress"></span></h6>
                        </li>
                        <li class="mb-5">
                            <h4><strong>Status:</strong></h4>
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
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content w-100">
            <div class="modal-header">
                <h4 class="modal-title">Edit Appointment</h4>
                <button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="" id="editAppointmentForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="appointment_id" name="appointmentID" value="">

                    <div class="form-floating mb-3">
                        <input id="edit_cname" type="text" name="complete_name" placeholder="Name" class="form-control" required autofocus value="{{ old('complete_name') }}" />
                        <label for="edit_cname">Complete Name</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input id="edit_age" type="text" name="age" class="form-control" placeholder="Age" required value="{{ old('age') }}" />
                        <label for="edit_age">Age</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select name="gender" class="form-control" id="edit_floatingSelect" required>
                            <option value="" disabled selected>Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                        <span class="arrow"></span>
                        <label for="edit_floatingSelect">Gender</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input id="edit_contact_number" class="form-control" type="text" placeholder="Enter contact number" name="contact_number" required value="{{ old('contact_number') }}">
                        <label for="edit_contact_number">Contact Number</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input id="edit_address" class="form-control" type="text" placeholder="Enter address" name="address" required value="{{ old('address') }}">
                        <label for="edit_address">Address</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input id="edit_date" type="datetime-local" class="form-control" name="DateTime" required value="{{ old('DateTime') }}">
                        <label for="edit_date">Appointment Date</label>
                    </div>

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

                    <div class="mt-auto d-flex justify-content-end gap-2">
                        <button class="btn btn-lg btn-submit w-100" type="submit">Update Changes</button>
                        <button class="btn btn-lg btn-cancel w-100" type="button" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
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



@section('scripts')
    
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.bootstrap5.min.js') }}"></script>

    <!-- View Appointment -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
        const viewButtons = document.querySelectorAll('.view-appointment');
        viewButtons.forEach(button => {
            button.addEventListener('click', function () {
                const AppointmentId = this.getAttribute('data-id');
                console.log('Fetching details for appointment ID:', AppointmentId); // Debug log

                fetch(`/admin/appointments/${AppointmentId}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        document.getElementById('appointmentSchedule').textContent = new Date(data.appointment.DateTime).toLocaleString();
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
    </script>

    <!-- Script to open Edit and Update Appointments-->
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const editButtons = document.querySelectorAll('.edit-appointment');
        const editForm = document.querySelector('#editAppointmentForm');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Button to open the edit modal
        editButtons.forEach(button => {
            button.addEventListener('click', function () {
                const AppointmentID = this.getAttribute('data-id');
                document.getElementById('appointment_id').value = AppointmentID;
                editForm.action = `/admin/appointments/update/${AppointmentID}`;

                fetch(`/admin/appointments/edit/${AppointmentID}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('edit_cname').value = data.patient.complete_name;
                        document.getElementById('edit_age').value = data.patient.age;
                        document.getElementById('edit_floatingSelect').value = data.patient.gender;
                        document.getElementById('edit_contact_number').value = data.patient.contact_number;
                        document.getElementById('edit_address').value = data.patient.address;
                        document.getElementById('edit_date').value = data.appointment.DateTime;
                        document.getElementById('edit_status').value = data.appointment.Status;
                    })
                    .catch(error => console.error('Error fetching appointment details:', error));
            });
        });

        // Form submission handling
        editForm.addEventListener('submit', function (e) {
            e.preventDefault(); 

            const formData = new FormData(this);
            fetch(editForm.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: data.message,
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: data.message,
                    });
                }
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An unexpected error occurred. Please try again.',
                });
            });
        });
    });
    </script>
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
                        fetch(`/admin/appointments/${id}`, {
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

