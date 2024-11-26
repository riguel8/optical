@extends('template.client.layout')

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
						<li class="nav-item">
							<a class="nav-link active" href="#solid-justified-tab1" data-bs-toggle="tab">Pending Requests</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#solid-justified-tab2" data-bs-toggle="tab">Confirmed Appointments</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#solid-justified-tab3" data-bs-toggle="tab">Cancelled Appointments</a>
						</li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane show active" id="solid-justified-tab1">
							@php
								$pendingAppointments = $appointments->filter(fn($appointment) => $appointment->Status === 'Pending');
							@endphp

							@if ($pendingAppointments->isEmpty())
								<div class="col-12">
									<div class="alert-info px-4 py-2 text-center text-sm text-gray-500" colspan="6">
										{{ __('No pending requests available.') }}
									</div>
								</div>
							@else
								@foreach ($pendingAppointments as $appointment)
									<div class="appointment-card p-4 rounded shadow-sm mb-4">
										<div class="row align-items-justify">
											<div class="col-md-4 col-12">
												<div class="details-section border-status-pending">
													<h6 class="section-title mb-3">Personal Details</h6>
													<p class="mb-1"><strong>Name:</strong> {{ $appointment->patient->complete_name }}</p>
													<p class="mb-1"><strong>Age:</strong> {{ $appointment->patient->age }}</p>
													<p class="mb-0"><strong>Contact Number:</strong> {{ $appointment->patient->contact_number }}</p>
												</div>
											</div>
											<div class="col-md-4 col-12">
												<h6 class="section-title mb-3">Appointment Schedule</h6>
												<p class="mb-1"><strong>Date:</strong> {{ \Carbon\Carbon::parse($appointment->DateTime)->format('F j, Y') }}</p>
												<p class="mb-0"><strong>Time:</strong> {{ \Carbon\Carbon::parse($appointment->DateTime)->format('g:i A') }}</p>
											</div>
											<div class="col-md-4 col-12 text-md-end text-center">
												<div class="status-badge mb-5">
													<span class="badges status-pending"><strong>Pending</strong></span>
												</div>
												<div class="action-buttons mt-3">
													<a class="me-3 view-appointment" href="#" data-id="{{ $appointment->AppointmentID }}" data-bs-toggle="modal" data-bs-target="#viewAppointment">
														<img src="{{ asset('assets/img/icons/eye.svg') }}" alt="img" data-bs-toggle="tooltip" data-bs-placement="top" title="View Appointment">
													</a>
													<a class="me-3 edit-appointment" href="#" data-id="{{ $appointment->AppointmentID }}" data-bs-toggle="modal" data-bs-target="#editAppointment">
														<img src="{{ asset('assets/img/icons/edit.svg') }}" alt="img" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Appointment">
													</a>
												</div>
											</div>
										</div>
									</div>
								@endforeach
							@endif
						</div>

						<div class="tab-pane" id="solid-justified-tab2">
							@php
								$confirmedAppointments = $appointments->filter(fn($appointment) => $appointment->Status === 'Confirm');
							@endphp

							@if ($confirmedAppointments->isEmpty())
								<div class="col-12">
									<div class="alert-info px-4 py-2 text-center text-sm text-gray-500" colspan="6">
										{{ __('No confirmed appointments available.') }}
									</div>
								</div>
							@else
								@foreach ($confirmedAppointments as $appointment)
									<div class="appointment-card p-4 rounded shadow-sm mb-4">
										<div class="row align-items-justify">
											<div class="col-md-4 col-12">
												<div class="details-section border-status-confirm">
													<h6 class="section-title mb-3">Personal Details</h6>
													<p class="mb-1"><strong>Name:</strong> {{ $appointment->patient->complete_name }}</p>
													<p class="mb-1"><strong>Age:</strong> {{ $appointment->patient->age }}</p>
													<p class="mb-0"><strong>Contact Number:</strong> {{ $appointment->patient->contact_number }}</p>
												</div>
											</div>
											<div class="col-md-4 col-12">
												<h6 class="section-title mb-3">Appointment Schedule</h6>
												<p class="mb-1"><strong>Date:</strong> {{ \Carbon\Carbon::parse($appointment->DateTime)->format('F j, Y') }}</p>
												<p class="mb-1"><strong>Time:</strong> {{ \Carbon\Carbon::parse($appointment->DateTime)->format('g:i A') }}</p>
												<p class="mb-0"><strong>Note:</strong> {{ $appointment->Notes }}</p>

											</div>
											<div class="col-md-4 col-12 text-md-end text-center">
												<div class="status-badge  mb-5">
													<span class="badges status-confirm"><strong>Confirm</strong></span>
												</div>
												<div class="action-buttons mt-3">
													<a class="me-3 view-appointment" href="#" data-id="{{ $appointment->AppointmentID }}" data-bs-toggle="modal" data-bs-target="#viewAppointment">
														<img src="{{ asset('assets/img/icons/eye.svg') }}" alt="img" data-bs-toggle="tooltip" data-bs-placement="top" title="View Appointment">
													</a>
													{{-- <a class="me-3 edit-appointment" href="#" data-id="{{ $appointment->AppointmentID }}" data-bs-toggle="modal" data-bs-target="#editAppointment">
														<img src="{{ asset('assets/img/icons/edit.svg') }}" alt="img" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Appointment">
													</a> --}}
												</div>
											</div>
										</div>
									</div>
								@endforeach
							@endif
						</div>

						<div class="tab-pane" id="solid-justified-tab3">
							@php
								$confirmedAppointments = $appointments->filter(fn($appointment) => $appointment->Status === 'Cancelled');
							@endphp

							@if ($confirmedAppointments->isEmpty())
								<div class="col-12">
									<div class="alert-info px-4 py-2 text-center text-sm text-gray-500" colspan="6">
										{{ __('No confirmed appointments available.') }}
									</div>
								</div>
							@else
								@foreach ($confirmedAppointments as $appointment)
									<div class="appointment-card p-4 rounded shadow-sm mb-4">
										<div class="row align-items-justify">
											<div class="col-md-4 col-12">
												<div class="details-section border-status-confirm">
													<h6 class="section-title mb-3">Personal Details</h6>
													<p class="mb-1"><strong>Name:</strong> {{ $appointment->patient->complete_name }}</p>
													<p class="mb-1"><strong>Age:</strong> {{ $appointment->patient->age }}</p>
													<p class="mb-0"><strong>Contact Number:</strong> {{ $appointment->patient->contact_number }}</p>
												</div>
											</div>
											<div class="col-md-4 col-12">
												<h6 class="section-title mb-3">Appointment Schedule</h6>
												<p class="mb-1"><strong>Date:</strong> {{ \Carbon\Carbon::parse($appointment->DateTime)->format('F j, Y') }}</p>
												<p class="mb-1"><strong>Time:</strong> {{ \Carbon\Carbon::parse($appointment->DateTime)->format('g:i A') }}</p>
												<p class="mb-0"><strong>Note:</strong> {{ $appointment->Notes }}</p>

											</div>
											<div class="col-md-4 col-12 text-md-end text-center">
												<div class="status-badge  mb-5">
													<span class="bg-lightred badges"><strong>Cancelled</strong></span>
												</div>
												<div class="action-buttons mt-3">
													<a class="me-3 view-appointment" href="#" data-id="{{ $appointment->AppointmentID }}" data-bs-toggle="modal" data-bs-target="#viewAppointment">
														<img src="{{ asset('assets/img/icons/eye.svg') }}" alt="img" data-bs-toggle="tooltip" data-bs-placement="top" title="View Appointment">
													</a>
													{{-- <a class="me-3 edit-appointment" href="#" data-id="{{ $appointment->AppointmentID }}" data-bs-toggle="modal" data-bs-target="#editAppointment">
														<img src="{{ asset('assets/img/icons/edit.svg') }}" alt="img" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Appointment">
													</a> --}}
												</div>
											</div>
										</div>
									</div>
								@endforeach
							@endif
						</div>

					</div>
				</div>
			</div>
		</section>


	
<!-- Add Appointment -->
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
				<form id="addAppointmentForm" method="POST" action="{{ route('client.appointments.store') }}">
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
				<button class="close" type="button" aria-label="Close" data-bs-dismiss="modal">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" style="padding:30px">
				<div class="productdetails">
					<ul class="product-bar">
						<li>
							<h4><strong>Date/Time:</strong></h4>
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
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content w-100">
            <div class="modal-header">
                <h4 class="modal-title">Edit Appointment</h4>
                <button class="close" type="button" aria-label="Close" data-bs-dismiss="modal">
					<span aria-hidden="true">&times;</span>
				</button>
            </div>
            <div class="modal-body" style="padding:30px;">
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

</div>
</div>


<style>

</style>

@section('scripts')

	<!-- Script to check time slot -->
	<script>
		document.addEventListener('DOMContentLoaded', function () {
			const addAppointmentDateInput = document.getElementById('appointmentDate');
			const editAppointmentDateInput = document.getElementById('edit_appointmentDate');
			
			const addTimeSelectionInputs = document.querySelectorAll('input[name="appointment_time"]');
			const editTimeSelectionInputs = document.querySelectorAll('input[name="edit_appointment_time"]');
			
			function resetModalState(timeSelectionInputs) {
				timeSelectionInputs.forEach(input => {
					input.disabled = false;
					input.checked = false;
				});
			}
	
			function checkAvailability(date, timeSelectionInputs) {
				fetch(`/appointments/check-client-availability?date=${date}`)
					.then(response => response.json())
					.then(data => {
						console.log('Availability Check:', data);
						timeSelectionInputs.forEach(function (timeInput) {
							const appointmentTime = timeInput.value;
							const timeSlotAvailable = !data.unavailableSlots.includes(appointmentTime);
	
							timeInput.disabled = !timeSlotAvailable;
						});
					})
					.catch(error => console.error('Error checking availability:', error));
			}
	
			if (addAppointmentDateInput) {
				addAppointmentDateInput.addEventListener('change', function () {
					const selectedDate = addAppointmentDateInput.value;
					console.log('Selected Date (Add Appointment): ', selectedDate);
					checkAvailability(selectedDate, addTimeSelectionInputs);
				});
			}
	
			if (editAppointmentDateInput) {
				editAppointmentDateInput.addEventListener('change', function () {
					const selectedDate = editAppointmentDateInput.value;
					console.log('Selected Date (Edit Appointment): ', selectedDate);
					checkAvailability(selectedDate, editTimeSelectionInputs);
				});
			}
	
			addTimeSelectionInputs.forEach(function (timeInput) {
				timeInput.addEventListener('change', function () {
					const selectedTime = timeInput.checked ? timeInput.value : null;
					console.log('Selected Time (Add): ', selectedTime);
				});
			});
	
			editTimeSelectionInputs.forEach(function (timeInput) {
				timeInput.addEventListener('change', function () {
					const selectedTime = timeInput.checked ? timeInput.value : null;
					console.log('Selected Time (Edit): ', selectedTime);
				});
			});
	
			$('#addAppointment').on('show.bs.modal', function () {
				resetModalState(addTimeSelectionInputs);
				addAppointmentDateInput.value = '';
			});
	

			$('#editAppointment').on('show.bs.modal', function () {
				resetModalState(editTimeSelectionInputs);
				editAppointmentDateInput.value = '';
			});
		});
	</script>


	<!-- Script to Limit the selection of date in the calendar (Edit & Add) -->
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			const today = new Date();
			const tomorrow = new Date(today);
			tomorrow.setDate(tomorrow.getDate() + 1);
			const minDate = tomorrow.toISOString().split("T")[0];

			const appointmentDateInput = document.getElementById("appointmentDate");
			const editAppointmentDateInput = document.getElementById("edit_appointmentDate");

			if (appointmentDateInput) {
				appointmentDateInput.setAttribute("min", minDate);
			}

			if (editAppointmentDateInput) {
				editAppointmentDateInput.setAttribute("min", minDate);
			}
		});
	</script>


    <!-- View Appointment -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const viewButtons = document.querySelectorAll('.view-appointment');
            viewButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const AppointmentId = this.getAttribute('data-id');
                    console.log('Fetching details for appointment ID:', AppointmentId);

                    fetch(`/client/appointments/${AppointmentId}`)
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
				timeZone: 'Asia/Manila',
            };
            
            const formattedDate = new Intl.DateTimeFormat('en-PH', options).format(date);
            const [datePart, timePart] = formattedDate.split(', ');
            return `${datePart}, ${timePart}`;
        }
    </script>

    <!-- Script to open Edit and Update Appointments-->
    <script>
document.addEventListener('DOMContentLoaded', function () {
    const editButtons = document.querySelectorAll('.edit-appointment');
    const editForm = document.querySelector('#editAppointmentForm');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            const AppointmentID = this.getAttribute('data-id');
            document.getElementById('appointment_id').value = AppointmentID;
            editForm.action = `/client/appointments/update/${AppointmentID}`;

            fetch(`/client/appointments/edit/${AppointmentID}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('edit_cname').value = data.patient.complete_name;
                    document.getElementById('edit_age').value = data.patient.age;
                    document.getElementById('edit_floatingSelect').value = data.patient.gender;
                    document.getElementById('edit_contact_number').value = data.patient.contact_number;
                    document.getElementById('edit_address').value = data.patient.address;

                    const rawDateTime = data.appointment.DateTime;
                    const appointmentDate = rawDateTime.split('T')[0];
                    const timePart = new Date(rawDateTime).toLocaleTimeString('en-US', {
                        hour: '2-digit',
                        minute: '2-digit',
                        hour12: false,
                    });

                    document.getElementById('edit_appointmentDate').value = appointmentDate;

                    document.querySelectorAll('input[name="edit_appointment_time"]').forEach(input => {
                        input.checked = false;
                        input.disabled = true;
                    });

                    disableTimeSlots(data.takenSlots);

                    const selectedInput = document.querySelector(`input[value="${timePart}"][name="edit_appointment_time"]`);
                    if (selectedInput) {
                        selectedInput.checked = true;
                        selectedInput.disabled = false;
                    }
                })
                .catch(error => console.error('Error fetching appointment details:', error));
        });
    });

    editForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const appointmentDate = document.getElementById('edit_appointmentDate').value;
        const appointmentTime = document.querySelector('input[name="edit_appointment_time"]:checked')?.value;

        if (!appointmentDate || !appointmentTime) {
            alert('Please select both the appointment date and time.');
            return;
        }

        const dateTime = `${appointmentDate} ${appointmentTime}:00`;
        document.getElementById('edit_appointmentDateTime').value = dateTime;

        const formData = new FormData(this);
        formData.append('DateTime', dateTime);

        fetch(editForm.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': csrfToken,
            },
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
            .catch(error => alert('An unexpected error occurred.'));
            
    });
});

function disableTimeSlots(takenSlots) {
    const timeInputs = document.querySelectorAll('input[name="edit_appointment_time"]');
    timeInputs.forEach(input => {
        input.disabled = takenSlots.includes(input.value);
    });
}
		</script>

	@endsection

@endsection