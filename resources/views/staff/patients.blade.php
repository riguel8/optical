@extends('template.staff.layout')

@section('content')

<div class="page-wrapper">
    <div class="content" style="overflow-y: auto; height: calc(100vh - 60px);">
        <div class="page-header">
            <div class="page-title">
                <h4>Patients</h4>
                <h6>Patient Lists</h6>
            </div>
            <div class="page-btn">
                <a data-bs-target="#addPatient" data-bs-toggle="modal" class="btn btn-added" data-context="add-patient">
                    <img src="{{ asset("assets/img/icons/plus.svg")}}" alt="img">Walk-in Patient
                </a>
            </div>
        </div>

        <section class="comp-section">
			<div class="card bg-white">

				<div class="card-body">
					<ul class="nav nav-tabs nav-tabs-solid nav-justified">
						<li class="nav-item"><a class="nav-link active" href="#solid-justified-tab1" data-bs-toggle="tab">Scheduled Appointment</a></li>
						<li class="nav-item"><a class="nav-link" href="#solid-justified-tab2" data-bs-toggle="tab">Recorded Prescriptions</a></li>
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
										<a class="btn-archive text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Archive Patient">
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
                                            <th>Patient Name</th>
                                            <th>Age</th>
                                            <th>Prescription</th>
                                            <th>Lens</th>
                                            <th>Frame</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($patients as $patient)
										    @if ($patient->appointments !== null && $patient->appointments->Status == 'Confirmed')
                                            <tr>
                                                <td>{{ $patient->complete_name}}</td>
                                                <td>{{ $patient->age}}</td>

                                                <td class="{{ isset($patient->prescription) && $patient->prescription->Prescription ? '' : 'text-red' }}">
                                                    {{ $patient->prescription->Prescription ?? 'No Prescription Yet' }}
                                                </td>
                                                
                                                <td class="{{ isset($patient->prescription) && $patient->prescription->Lens ? '' : 'text-red' }}">
                                                    {{ $patient->prescription->Lens ?? 'No Lens Yet' }}
                                                </td>

                                                <td class="{{ isset($patient->prescription) && $patient->prescription->Frame ? '' : 'text-red' }}">
                                                    {{ $patient->prescription->Frame ?? 'No Frame Yet' }}
                                                </td>

                                                <td class="{{ isset($patient->appointments) && $patient->appointments->Status ? '' : 'text-red' }}">
                                                    <span class="bg-success badges">{{ $patient->appointments->Status ?? 'N/A' }}</span>
                                                </td>

                                                <td>{{ \Carbon\Carbon::parse($patient->created_at)->format('F-j-Y') }}</td>
                                                <td>
                                                    <a class="me-3 view-patient" href="#" data-id="{{ $patient->PatientID }}" data-bs-toggle="modal" data-bs-target="#viewPatient">
                                                        <img src="{{ asset('assets/img/icons/eye.svg') }}" alt="img" data-bs-toggle="tooltip" data-bs-placement="top" title="View Patient">
                                                    </a>
                                                    <a class="me-3 prescription edit-patient-btn" href="#" data-id="{{ $patient->PatientID }}" data-bs-toggle="modal" data-bs-target="#editPatient"  data-context="edit-patient">
                                                        <img src="{{ asset('assets/img/icons/add-pres.png') }}" alt="img" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Prescription">
                                                    </a>
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
                                            <th>Patient Name</th>
                                            <th>Age</th>
                                            <th>Prescription</th>
                                            <th>Lens</th>
                                            <th>Frame</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($patients as $patient)
                                            @if ($patient->prescription !== null && $patient->prescription->PresStatus == 'Completed')
                                            <tr>
                                                <td>{{ $patient->complete_name}}</td>
                                                <td>{{ $patient->age}}</td>

                                                <td class="{{ isset($patient->prescription) && $patient->prescription->Prescription ? '' : 'text-red' }}">
                                                    {{ $patient->prescription->Prescription ?? 'No Prescription Yet' }}
                                                </td>
                                                
                                                <td class="{{ isset($patient->prescription) && $patient->prescription->Lens ? '' : 'text-red' }}">
                                                    {{ $patient->prescription->Lens ?? 'No Lens Yet' }}
                                                </td>

                                                <td class="{{ isset($patient->prescription) && $patient->prescription->Frame ? '' : 'text-red' }}">
                                                    {{ $patient->prescription->Frame ?? 'No Frame Yet' }}
                                                </td>

                                                <td class="{{ isset($patient->prescription) && $patient->prescription->PresStatus ? '' : 'text-red' }}">
                                                    <span class="bg-primary badges">{{ $patient->prescription->PresStatus ?? 'N/A' }}</span>
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($patient->created_at)->format('F-j-Y') }}</td>
                                                <td>
                                                    <a class="me-3 view-patient" href="#" data-id="{{ $patient->PatientID }}" data-bs-toggle="modal" data-bs-target="#viewPatient">
                                                        <img src="{{ asset('assets/img/icons/eye.svg') }}" alt="img" data-bs-toggle="tooltip" data-bs-placement="top" title="View Patient">
                                                    </a>
                                                    <a class="me-3 prescription edit-patient-btn" href="#" data-id="{{ $patient->PatientID }}" data-bs-toggle="modal" data-bs-target="#editPatient"  data-context="edit-patient">
                                                        <img src="{{ asset('assets/img/icons/add-pres.png') }}" alt="img" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Prescription">
                                                    </a>
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


<!-- Modal To Add Walk-in Patient  -->
<div class="modal fade" id="addPatient" tabindex="-1" aria-labelledby="addPatientLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form id="addPatientForm" action="{{ route('staff.patients.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addPatientLabel">Walk-in Patient</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="padding: 30px;">
                    <!-- Step Icons -->
                    <div class="step-icons">
                        <div class="icon step-1-icon active">
                            <i class="fas fa-user"></i><br>
                            <span class="fs-6">Patient Information</span>
                        </div>
                        <div class="icon step-2-icon">
                            <i class="fas fa-clipboard-list"></i><br>
                            <span class="fs-6">Prescription</span>
                        </div>
                        <div class="icon step-3-icon">
                            <i class="fas fa-dollar-sign"></i><br>
                            <span class="fs-6">Amount</span>
                        </div>
                    </div>

                    <!-- Step 1 -->
                    <div class="step step-1">
                        <div class="form-floating mb-3">
                            <input id="name" name="name" type="text" class="form-control" placeholder="Name" required>
                            <label for="name">Patient Name</label>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating  mb-3">
                                    <select id="gender" name="gender" class="form-select" required>
                                        <option value="" disabled selected>Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                    </select>
                                    <label for="gender">Gender</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating  mb-3">
                                    <input id="age" name="age" type="number" class="form-control" placeholder="Age" required>
                                    <label for="age">Age</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating  mb-3">
                                    <input id="contact" name="contact" type="tel" class="form-control" placeholder="Contact Number" required>
                                    <label for="contact">Contact Number</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating  mb-3">
                                    <input id="address" name="address" type="text" class="form-control" placeholder="Address" required>
                                    <label for="address">Address</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="step step-2 hidden">
                        <div class="form-floating mb-3">
                            <select id="prescription" name="prescription" class="form-select" required>
                                <option value="" disabled selected>Select Prescription</option>
                                <option value="(OD) Right Eye & (OS) Left Eye">OD (Right Eye) & OS (Left Eye)</option>
                                <option value="(OU) Both Eyes">OU (Both Eyes)</option>
                            </select>
                            <label for="prescription">Prescription</label>
                        </div>
                        <div id="dynamicInputs" class="row hidden"></div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating  mb-3">
                                    <select id="lens" name="lens" class="form-select">
                                        <option value="" disabled selected>Select Lens</option>
                                        <option value="SINGLE VISION">Single Vision</option>
                                        <option value="DOUBLE VISION">Double Vision</option>
                                        <option value="PROGRESSIVE">Progressive</option>
                                        <option value="NEAR VISION">Near Vision</option>
                                    </select>
                                    <label for="lens">Lens</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <select id="lensType" name="lensType" class="form-select">
                                        <option value="" disabled selected>Select Lens Type</option>
                                        <option value="Ordinary">Ordinary</option>
                                        <option value="Anti-Rad">Anti-Rad</option>
                                        <option value="Photochromic">Photochromic</option>
                                    </select>
                                    <label for="lensType">Lens Type</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-floating  mb-3">
                                    <input id="frame" name="frame" type="text" class="form-control" placeholder="Frame">
                                    <label for="frame">Frame</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating  mb-3">
                                    <input id="add" name="add" type="text" class="form-control" placeholder="ADD">
                                    <label for="add">ADD</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating  mb-3">
                                    <input id="pd" name="pd" type="text" class="form-control" placeholder="PD">
                                    <label for="pd">PD</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <input id="prescriptionDetails" name="prescriptionDetails" type="text" class="form-control" placeholder="Prescription Details" required>
                            <label for="prescriptionDetails">Prescription Details</label>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="step step-3 hidden">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating  mb-3">
                                    <input id="totalAmount" name="totalAmount" type="number" class="form-control" placeholder="Total Amount" step="0.01" required>
                                    <label for="totalAmount">Total Amount</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating  mb-3">
                                    <input id="deposit" name="deposit" type="number" class="form-control" placeholder="Deposit" step="0.01" required>
                                    <label for="deposit">Deposit</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <select id="modeOfPayment" name="modeOfPayment" class="form-select" required>
                                <option value="" disabled selected>Select Payment Method</option>
                                <option value="Cash">Cash</option>
                                <option value="Card">Card</option>
                                <option value="Gcash">Gcash</option>
                            </select>
                            <label for="modeOfPayment">Mode of Payment</label>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input id="balance" name="balance" type="number" class="form-control" placeholder="Balance" readonly>
                                    <label for="balance">Balance</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input id="status" name="status" type="text" class="form-control" placeholder="Status" readonly>
                                    <label for="status">Status</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Footer Buttons -->
                    <div class="mt-auto d-flex justify-content-between gap-3">
                        <div class="d-flex align-items-start">
                            <button type="button" class="btn btn-secondary prev-step hidden">Previous</button>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-primary next-step">Next</button>
                            <button type="submit" class="btn btn-success submit-form hidden">Submit</button>
                        </div>
                    </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal To Edit Patient -->
<div class="modal fade" id="editPatient" tabindex="-1" aria-labelledby="editPatientLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form id="edit_addPatientForm" action="{{ route('staff.patients.update') }}" method="POST">
                @csrf
                <input type="hidden" id="edit_patientId" name="edit_patientId">
                <input type="hidden" id="edit_prescriptionId" name="edit_prescriptionId">
                <input type="hidden" id="edit_amountId" name="edit_amountId">
                <input type="hidden" id="edit_appointmentId" name="edit_appointmentId">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPatientLabel">Edit Patient</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="padding: 30px;">
                    <!-- Step Icons -->
                    <div class="step-icons">
                        <div class="icon edit_step-1-icon active">
                            <i class="fas fa-user"></i><br>
                            <span class="fs-6">Patient Information</span>
                        </div>
                        <div class="icon edit_step-2-icon">
                            <i class="fas fa-clipboard-list"></i><br>
                            <span class="fs-6">Prescription</span>
                        </div>
                        <div class="icon edit_step-3-icon">
                            <i class="fas fa-dollar-sign"></i><br>
                            <span class="fs-6">Amount</span>
                        </div>
                    </div>

                    <!-- Step 1 -->
                    <div class="edit_step edit_step-1">
                        <div class="form-floating mb-3">
                            <input id="edit_name" name="edit_name" type="text" class="form-control" placeholder="Name" required>
                            <label for="edit_name">Patient Name</label>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <select id="edit_gender" name="edit_gender" class="form-select" required>
                                        <option value="" disabled selected>Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                    </select>
                                    <label for="edit_gender">Gender</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input id="edit_age" name="edit_age" type="number" class="form-control" placeholder="Age" required>
                                    <label for="edit_age">Age</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input id="edit_contact" name="edit_contact" type="tel" class="form-control" placeholder="Contact Number" required>
                                    <label for="edit_contact">Contact Number</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input id="edit_address" name="edit_address" type="text" class="form-control" placeholder="Address" required>
                                    <label for="edit_address">Address</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="edit_step edit_step-2 hidden">
                        <div class="form-floating mb-3">
                            <select id="edit_prescription" name="edit_prescription" class="form-select" required>
                                <option value="" disabled selected>Select Prescription</option>
                                <option value="(OD) Right Eye & (OS) Left Eye">OD (Right Eye) & OS (Left Eye)</option>
                                <option value="(OU) Both Eyes">OU (Both Eyes)</option>
                            </select>
                            <label for="edit_prescription">Prescription</label>
                        </div>
                        <div id="edit_dynamicInputs" class="row hidden"></div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <select id="edit_lens" name="edit_lens" class="form-select">
                                        <option value="" disabled selected>Select Lens</option>
                                        <option value="SINGLE VISION">Single Vision</option>
                                        <option value="DOUBLE VISION">Double Vision</option>
                                        <option value="PROGRESSIVE">Progressive</option>
                                        <option value="NEAR VISION">Near Vision</option>
                                    </select>
                                    <label for="edit_lens">Lens</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <select id="edit_lensType" name="edit_lensType" class="form-select">
                                        <option value="" disabled selected>Select Lens Type</option>
                                        <option value="Ordinary">Ordinary</option>
                                        <option value="Anti-Rad">Anti-Rad</option>
                                        <option value="Photochromic">Photochromic</option>
                                    </select>
                                    <label for="edit_lensType">Lens Type</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <input id="edit_frame" name="edit_frame" type="text" class="form-control" placeholder="Frame">
                                    <label for="edit_frame">Frame</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <input id="edit_add" name="edit_add" type="text" class="form-control" placeholder="ADD">
                                    <label for="edit_add">ADD</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating mb-3">
                                    <input id="edit_pd" name="edit_pd" type="text" class="form-control" placeholder="PD">
                                    <label for="edit_pd">PD</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <input id="edit_prescriptionDetails" name="edit_prescriptionDetails" type="text" class="form-control" placeholder="Prescription Details" required>
                            <label for="edit_prescriptionDetails">Prescription Details</label>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="edit_step edit_step-3 hidden">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input id="edit_totalAmount" name="edit_totalAmount" type="number" class="form-control" placeholder="Total Amount" step="0.01" required>
                                    <label for="edit_totalAmount">Total Amount</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input id="edit_deposit" name="edit_deposit" type="number" class="form-control" placeholder="Deposit" step="0.01" required>
                                    <label for="edit_deposit">Deposit</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-floating mb-3">
                            <select id="edit_modeOfPayment" name="edit_modeOfPayment" class="form-select" required>
                                <option value="" disabled selected>Select Payment Method</option>
                                <option value="Cash">Cash</option>
                                <option value="Card">Card</option>
                                <option value="Gcash">Gcash</option>
                            </select>
                            <label for="edit_modeOfPayment">Mode of Payment</label>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input id="edit_balance" name="edit_balance" type="number" class="form-control" placeholder="Balance" readonly>
                                    <label for="edit_balance">Balance</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input id="edit_status" name="edit_status" type="text" class="form-control" placeholder="Status" readonly>
                                    <label for="edit_status">Status</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Footer Buttons -->
                    <div class="mt-auto d-flex justify-content-between gap-3">
                        <div class="d-flex align-items-start">
                            <button type="button" class="btn btn-secondary edit_prev-step hidden">Previous</button>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-primary edit_next-step">Next</button>
                            <button type="submit" class="btn btn-success edit_submit-form hidden">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
    
    

 <!-- Modal to View Specific Patient -->
<div class="modal fade" id="viewPatient" tabindex="-1" aria-labelledby="viewPatientLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title w-100" id="viewPatientLabel">Patient Prescription</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body p-3 p-md-4">
                <div class="prescription-box border rounded p-3 p-md-4">
                    <!-- Patient Info Section -->
                    <h5 class="text-primary fw-bold border-bottom pb-2 mb-4">Patient Information</h5>
                    <div class="row mb-5">
                        <div class="col-md-6">
                            <p class="mb-0">Name: <strong><span id="viewpatientName"></span></strong></p>
                            <p class="mb-0">Age: <strong><span id="viewpatientAge"></span></strong></p>
                            <p class="mb-0">Gender: <strong><span id="viewpatientGender"></span></strong></p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-0">Contact Number: <strong><span id="viewcontactNumber"></span></strong></p>
                            <p class="mb-0">Address: <strong><span id="viewpatientAddress"></span></strong></p>
                        </div>
                    </div>

                    <!-- Prescription Details Section -->
                    <h5 class="text-primary fw-bold border-bottom pb-2 mt-3 mb-4">Prescription Details</h5>
                    <div class="table-responsive mb-4">
                        <table class="table table-bordered text-center">
                            <thead class="table-light">
                                <tr>
                                    <th>Prescription</th>
                                    <th>Right Eye (OD)</th>
                                    <th>Left Eye (OS)</th>
                                    <th>ADD</th>
                                    <th>PD</th>
                                    <th>Both Eyes (OU)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong><span id="viewprescriptionPrescription"></span></strong></td>
                                    <td><strong><span id="viewprescriptionOD"></span></strong></td>
                                    <td><strong><span id="viewprescriptionOS"></span></strong></td>
                                    <td><strong><span id="viewprescriptionADD"></span></strong></td>
                                    <td><strong><span id="viewprescriptionPD"></span></strong></td>
                                    <td><strong><span id="viewprescriptionOU"></span></strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Lens and Frame Details -->
                    <div class="row text-center mb-5">
                        <div class="col-md-4">
                            <p>Lens: <strong><span id="viewprescriptionLens"></span></strong> </p>
                        </div>
                        <div class="col-md-4">
                            <p>Lens Type: <strong><span id="viewprescriptionLensType"></span></strong> </p>
                        </div>
                        <div class="col-md-4">
                            <p>Frame: <strong><span id="viewprescriptionFrame"></span></strong> </p>
                        </div>
                    </div>

                    <!-- Payment Details Section -->
                    <h5 class="d-flex justify-content-between align-items-center text-primary fw-bold border-bottom pb-2 mb-4">
                        Payment Information
                        <span class="bg-success badges" id="viewpaymentStatus"></span>
                    </h5>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="total-order w-100 max-widthauto m-auto mb-4">
                                <ul>
                                    <li>
                                        <h4>Total Amount</h4>
                                        <h5>₱<span id="viewtotalAmount"></span></h5>
                                    </li>
                                    <li>
                                        <h4>Deposit</h4>
                                        <h5 id="viewdeposit"></h5>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="total-order w-100 max-widthauto m-auto mb-4">
                                <ul>
                                    <li>
                                        <h4>Mode of Payment</h4>
                                        <h5 id="viewmodeOfPayment"></h5>
                                    </li>
                                    <li class="total">
                                        <h4>Balance</h4>
                                        <h5>₱<span id="viewbalance"></span></h5>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Footer Section -->
                    <!-- <div class="text-center border-top pt-3">
                        <p class="text-muted"><em>This prescription is generated electronically and does not require a signature.</em></p>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>


<style>
    /* Hide and Unhide Input in Modal (Grade) */
    .hidden { 
        display: none; 
        }
    .step-icons {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
        }
    .step-icons .icon {
        flex: 1;
        text-align: center;
        font-size: 24px;
        color: #ccc;
        }
    .step-icons .icon.active {
        color: #ff9900;
        font-weight: bold;
        }
    
    </style>

    

    @section('scripts')
        <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/js/dataTables.bootstrap5.min.js') }}"></script>
        <script src="{{ asset('assets/js/staff/patient/create-walk-in.js') }}"></script>
        <script src="{{ asset('assets/js/staff/patient/update.js') }}"></script>
        <script src="{{ asset('assets/js/staff/patient/view.js') }}"></script>

    @endsection

@endsection