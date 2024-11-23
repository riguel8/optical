@extends('template.admin.layout')

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

        <div class="card">
            <div class="card-body">
                <div class="table-top">
                    <div class="search-set">
                        <div class="search-input">
                            <a href="#" class="btn btn-searchset">
                                <img src="{{ asset('assets/img/icons/search-white.svg') }}" alt="img">
                            </a>
                        </div>
                    </div>
                    <div class="wordset">
                        <ul>
                            <li><a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img src="{{ asset('assets/img/icons/pdf.svg') }}" alt="img"></a></li>
                            <li><a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img src="{{ asset('assets/img/icons/excel.svg') }}" alt="img"></a></li>
                            <li><a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img src="{{ asset('assets/img/icons/printer.svg') }}" alt="img"></a></li>
                        </ul>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table datanew">
                        <thead>
                            <tr>
                                <th>Patient Name</th>
                                <th>Age</th>
                                <th>Prescription</th>
                                <th>Lens</th>
                                <th>Frame</th>
                                {{-- <th>Price</th> --}}
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($patients as $patient)
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

                                    {{-- <td class="{{ isset($patient->prescription) && $patient->prescription->Price ? '' : 'text-red' }}">
                                        {{ $patient->prescription->Price ?? 'N/A' }}
                                    </td> --}}
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
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal To Add Walk-in Patient  -->
<div class="modal fade" id="addPatient" tabindex="-1" aria-labelledby="addPatientLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form id="addPatientForm" action="{{ route('admin.patients.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addPatientLabel">Walk-in Patient</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Step Icons -->
                    <div class="step-icons">
                        <div class="icon step-1-icon active">
                            <i class="fas fa-user"></i><br>Patient Info
                        </div>
                        <div class="icon step-2-icon">
                            <i class="fas fa-clipboard-list"></i><br>Prescription
                        </div>
                        <div class="icon step-3-icon">
                            <i class="fas fa-dollar-sign"></i><br>Amount
                        </div>
                    </div>

                    <!-- Step 1 -->
                    <div class="step step-1">
                        <h6>Patient Information:</h6>
                        <div class="form-floating mb-3">
                            <input id="name" name="name" type="text" class="form-control" placeholder="Name" required>
                            <label for="name">Patient Name</label>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating">
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
                                <div class="form-floating">
                                    <input id="age" name="age" type="number" class="form-control" placeholder="Age" required>
                                    <label for="age">Age</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input id="contact" name="contact" type="tel" class="form-control" placeholder="Contact Number" required>
                                    <label for="contact">Contact Number</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input id="address" name="address" type="text" class="form-control" placeholder="Address" required>
                                    <label for="address">Address</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="step step-2 hidden">
                        <h6>Prescription Details</h6>
                        <div class="form-floating mb-3">
                            <select id="prescription" name="prescription" class="form-select" required>
                                <option value="" disabled selected>Select Prescription</option>
                                <option value="(OD) Right Eye & (OS) Left Eye">OD (Right Eye) & OS (Left Eye)</option>
                                <option value="(OU) Both Eyes">OU (Both Eyes)</option>
                            </select>
                            <label for="prescription">Prescription</label>
                        </div>
                        <div id="dynamicInputs" class="row mb-3 hidden"></div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating">
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
                                <div class="form-floating">
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
                        <div class="row mb-6">
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input id="frame" name="frame" type="text" class="form-control" placeholder="Frame">
                                    <label for="frame">Frame</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input id="add" name="add" type="text" class="form-control" placeholder="ADD">
                                    <label for="add">ADD</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input id="pd" name="pd" type="text" class="form-control" placeholder="PD">
                                    <label for="pd">PD</label>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="form-floating mb-3">
                            <input id="prescriptionDetails" name="prescriptionDetails" type="text" class="form-control" placeholder="Prescription Details" required>
                            <label for="prescriptionDetails">Prescription Details</label>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="step step-3 hidden">
                        <h6>Payment Details</h6>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input id="totalAmount" name="totalAmount" type="number" class="form-control" placeholder="Total Amount" step="0.01" required>
                                    <label for="totalAmount">Total Amount</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
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
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input id="balance" name="balance" type="number" class="form-control" placeholder="Balance" readonly>
                                    <label for="balance">Balance</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input id="status" name="status" type="text" class="form-control" placeholder="Status" readonly>
                                    <label for="status">Status</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Footer Buttons -->
                <div class="modal-footer justify-content-end">
                    <button type="button" class="btn btn-secondary prev-step hidden">Previous</button>
                    <button type="button" class="btn btn-primary next-step">Next</button>
                    <button type="submit" class="btn btn-success submit-form hidden">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>





<!-- Modal To Edit Patient -->
<div class="modal fade" id="editPatient" tabindex="-1" aria-labelledby="editPatientLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <form id="edit_addPatientForm" action="{{ route('admin.patients.update') }}" method="POST">
                @csrf
                <input type="hidden" id="edit_patientId" name="edit_patientId">
                <input type="hidden" id="edit_prescriptionId" name="edit_prescriptionId">
                <input type="hidden" id="edit_amountId" name="edit_amountId">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPatientLabel">Edit Patient</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Step Icons -->
                    <div class="step-icons">
                        <div class="icon edit_step-1-icon active">
                            <i class="fas fa-user"></i><br>Patient Info
                        </div>
                        <div class="icon edit_step-2-icon">
                            <i class="fas fa-clipboard-list"></i><br>Prescription
                        </div>
                        <div class="icon edit_step-3-icon">
                            <i class="fas fa-dollar-sign"></i><br>Amount
                        </div>
                    </div>

                    <!-- Step 1 -->
                    <div class="edit_step edit_step-1">
                        <h6>Patient Information:</h6>
                        <div class="form-floating mb-3">
                            <input id="edit_name" name="edit_name" type="text" class="form-control" placeholder="Name" required>
                            <label for="edit_name">Patient Name</label>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating">
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
                                <div class="form-floating">
                                    <input id="edit_age" name="edit_age" type="number" class="form-control" placeholder="Age" required>
                                    <label for="edit_age">Age</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input id="edit_contact" name="edit_contact" type="tel" class="form-control" placeholder="Contact Number" required>
                                    <label for="edit_contact">Contact Number</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input id="edit_address" name="edit_address" type="text" class="form-control" placeholder="Address" required>
                                    <label for="edit_address">Address</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="edit_step edit_step-2 hidden">
                        <h6>Prescription Details</h6>
                        <div class="form-floating mb-3">
                            <select id="edit_prescription" name="edit_prescription" class="form-select" required>
                                <option value="" disabled selected>Select Prescription</option>
                                <option value="(OD) Right Eye & (OS) Left Eye">OD (Right Eye) & OS (Left Eye)</option>
                                <option value="(OU) Both Eyes">OU (Both Eyes)</option>
                            </select>
                            <label for="edit_prescription">Prescription</label>
                        </div>
                        <div id="edit_dynamicInputs" class="row mb-3 hidden"></div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating">
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
                                <div class="form-floating">
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
                        <div class="row mb-6">
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input id="edit_frame" name="edit_frame" type="text" class="form-control" placeholder="Frame">
                                    <label for="edit_frame">Frame</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input id="edit_add" name="edit_add" type="text" class="form-control" placeholder="ADD">
                                    <label for="edit_add">ADD</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input id="edit_pd" name="edit_pd" type="text" class="form-control" placeholder="PD">
                                    <label for="edit_pd">PD</label>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="form-floating mb-3">
                            <input id="edit_prescriptionDetails" name="edit_prescriptionDetails" type="text" class="form-control" placeholder="Prescription Details" required>
                            <label for="edit_prescriptionDetails">Prescription Details</label>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="edit_step edit_step-3 hidden">
                        <h6>Payment Details</h6>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input id="edit_totalAmount" name="edit_totalAmount" type="number" class="form-control" placeholder="Total Amount" step="0.01" required>
                                    <label for="edit_totalAmount">Total Amount</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
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
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input id="edit_balance" name="edit_balance" type="number" class="form-control" placeholder="Balance" readonly>
                                    <label for="edit_balance">Balance</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input id="edit_status" name="edit_status" type="text" class="form-control" placeholder="Status" readonly>
                                    <label for="edit_status">Status</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Footer Buttons -->
                <div class="modal-footer justify-content-end">
                    <button type="button" class="btn btn-secondary edit_prev-step hidden">Previous</button>
                    <button type="button" class="btn btn-primary edit_next-step">Next</button>
                    <button type="submit" class="btn btn-success edit_submit-form hidden">Save Changes</button>
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
                <h4 style="text-align: center; width: 100%;" class="modal-title" id="viewPatientLabel">Patient Details</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
            </div>
            <div class="modal-body">
                <div class="productdetails" style="display: flex; flex-wrap: wrap; gap: 20px; justify-content: space-between;">
                    <ul class="product-bar" style="flex: 1; min-width: 250px;">
                        <li><h4><strong>Patient Name:</strong></h4><h6 id="viewpatientName"></h6></li>
                        <li><h4><strong>Age:</strong></h4><h6><span id="viewpatientAge"></span></h6></li>
                        <li><h4><strong>Gender:</strong></h4><h6><span id="viewpatientGender"></span></h6></li>
                        <li><h4><strong>Contact Number:</strong></h4><h6><span id="viewcontactNumber"></span></h6></li>
                        <li><h4><strong>Address:</strong></h4><h6><span id="viewpatientAddress"></span></h6></li>
                    </ul>

                    <ul style="flex: 1; min-width: 250px; padding-left: 20px; list-style-type: none; text-align: right;">
                        <li><h4><strong>Prescription:</strong></h4><h6><span id="viewprescriptionPrescription"></span></h6></li>
                        <li id="viewgradeRight" style="display: none;">
                            <h4><strong>OD (Right Eye):</strong></h4><h6><span id="viewprescriptionOD"></span></h6>
                        </li>
                        <li id="viewgradeLeft" style="display: none;">
                            <h4><strong>OS (Left Eye):</strong></h4><h6><span id="viewprescriptionOS"></span></h6>
                        </li>
                        <li id="viewgradeBoth" style="display: none;">
                            <h4><strong>OU (Both Eyes):</strong></h4><h6><span id="viewprescriptionOU"></span></h6>
                        </li>
                        <li><h4><strong>Lens:</strong></h4><h6><span id="viewprescriptionLens"></span></h6></li>
                        <li><h4><strong>Lens Type:</strong></h4><h6><span id="viewprescriptionLensType"></span></h6></li>
                        <li><h4><strong>Frame:</strong></h4><h6><span id="viewprescriptionFrame"></span></h6></li>
                        <li><h4><strong>ADD:</strong></h4><h6><span id="viewprescriptionADD"></span></h6></li>
                        <li><h4><strong>PD:</strong></h4><h6><span id="viewprescriptionPD"></span></h6></li>
                    </ul>
                </div>

                <div class="productdetails" style="margin-top: 20px;">
                    <ul class="product-bar" style="flex: 1; min-width: 250px;">
                        <li><h4><strong>Total Amount:</strong></h4><h6 id="viewtotalAmount"></h6></li>
                        <li><h4><strong>Deposited:</strong></h4><h6><span id="viewdeposit"></span></h6></li>
                        <li><h4><strong>Mode of Payment:</strong></h4><h6><span id="viewmodeOfPayment"></span></h6></li>
                        <li><h4><strong>Balance:</strong></h4><h6><span id="viewbalance"></span></h6></li>
                        <li><h4><strong>Status:</strong></h4><h6><span id="viewpaymentStatus"></span></h6></li>
                    </ul>
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


<!-- Script to view specific patient -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const viewButtons = document.querySelectorAll('.view-patient');
        viewButtons.forEach(button => {
            button.addEventListener('click', function () {
                const PatientId = this.getAttribute('data-id');
                fetch(`/admin/patients/${PatientId}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        document.getElementById('viewpatientName').textContent = data.patient.complete_name || '';
                        document.getElementById('viewpatientAge').textContent = data.patient.age || '';
                        document.getElementById('viewpatientGender').textContent = data.patient.gender || '';
                        document.getElementById('viewcontactNumber').textContent = data.patient.contact_number || '';
                        document.getElementById('viewpatientAddress').textContent = data.patient.address || '';
    
                        document.getElementById('viewprescriptionPrescription').textContent = data.prescription.prescription || 'Not Available';
                        if (data.prescription.prescription === 'OU') {
                            document.getElementById('viewgradeBoth').style.display = 'block';
                            document.getElementById('viewgradeRight').style.display = 'none';
                            document.getElementById('viewgradeLeft').style.display = 'none';
                            document.getElementById('viewprescriptionOU').textContent = data.prescription.OUgrade || 'Not Available';
                        } else {
                            document.getElementById('viewgradeBoth').style.display = 'none';
                            document.getElementById('viewgradeRight').style.display = 'block';
                            document.getElementById('viewgradeLeft').style.display = 'block';
                            document.getElementById('viewprescriptionOD').textContent = data.prescription.ODgrade || 'Not Available';
                            document.getElementById('viewprescriptionOS').textContent = data.prescription.OSgrade || 'Not Available';
                        }
                        document.getElementById('viewprescriptionLens').textContent = data.prescription.lens || 'Not Available';
                        document.getElementById('viewprescriptionLensType').textContent = data.prescription.lens_type || 'Not Available';
                        document.getElementById('viewprescriptionFrame').textContent = data.prescription.frame || 'Not Available';
                        document.getElementById('viewprescriptionADD').textContent = data.prescription.ADD || 'Not Available';
                        document.getElementById('viewprescriptionPD').textContent = data.prescription.PD || 'Not Available';
    
                        document.getElementById('viewtotalAmount').textContent = data.payment.total_amount || '';
                        document.getElementById('viewdeposit').textContent = data.payment.deposit || '';
                        document.getElementById('viewmodeOfPayment').textContent = data.payment.mode_of_payment || '';
                        document.getElementById('viewbalance').textContent = data.payment.balance || '';
                        document.getElementById('viewpaymentStatus').textContent = data.payment.status || '';
                    })
                    .catch(error => {
                        console.error('Error fetching patient details:', error);
                        alert('Error fetching data.');
                    });
            });
        });
    });
    </script>


<!-- Script for Walk-in Wizard Form Modal  -->
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const steps = document.querySelectorAll(".step");
        const icons = document.querySelectorAll(".step-icons .icon");
        const nextButton = document.querySelector(".next-step");
        const prevButton = document.querySelector(".prev-step");
        const submitButton = document.querySelector(".submit-form");
        const prescriptionSelect = document.getElementById("prescription");
        const dynamicInputs = document.getElementById("dynamicInputs");
        const modal = document.getElementById("addPatient");
        const form = document.getElementById("addPatientForm");
    
        let currentStep = 0;
    
        const showStep = (index) => {
            steps.forEach((step, i) => {
                step.classList.toggle("hidden", i !== index);
            });
    
            icons.forEach((icon, i) => {
                icon.classList.toggle("active", i === index);
            });
    
            prevButton.classList.toggle("hidden", index === 0);
            nextButton.classList.toggle("hidden", index === steps.length - 1);
            submitButton.classList.toggle("hidden", index !== steps.length - 1);
        };
    
        const validateStep = () => {
            const currentFields = steps[currentStep].querySelectorAll("[required]");
            for (const field of currentFields) {
                if (!field.value.trim()) {
                    field.classList.add("is-invalid");
                    return false;
                } else {
                    field.classList.remove("is-invalid");
                }
            }
            return true;
        };
    
        const updateDynamicInputs = () => {
            const prescription = prescriptionSelect.value;
            dynamicInputs.innerHTML = "";
            if (prescription === "(OD) Right Eye & (OS) Left Eye") {
                dynamicInputs.innerHTML = `
                    <div class="col-6">
                        <label for="od" class="form-label">OD (Right Eye)</label>
                        <input type="text" id="od" name="ODgrade" class="form-control" required>
                    </div>
                    <div class="col-6">
                        <label for="os" class="form-label">OS (Left Eye)</label>
                        <input type="text" id="os" name="OSgrade" class="form-control" required>
                    </div>
                `;
            } else if (prescription === "(OU) Both Eyes") {
                dynamicInputs.innerHTML = `
                    <div class="col-12">
                        <label for="ou" class="form-label">OU (Both Eyes)</label>
                        <input type="text" id="ou" name="OUgrade" class="form-control" required>
                    </div>
                `;
            }
            dynamicInputs.classList.toggle("hidden", !prescription);
        };
    
        const calculateBalance = () => {
            const total = parseFloat(document.getElementById("totalAmount").value) || 0;
            const deposit = parseFloat(document.getElementById("deposit").value) || 0;
            const balance = total - deposit;
            const statusInput = document.getElementById("status");
    
            document.getElementById("balance").value = balance.toFixed(2);
            if (balance > 0) {
                statusInput.value = "Partial";
            } else if (balance === 0) {
                statusInput.value = "Paid";
            } else if (balance === total) {
                statusInput.value = "Unpaid";
            }
        };
    
        nextButton.addEventListener("click", () => {
            if (!validateStep()) return;
            if (currentStep < steps.length - 1) {
                currentStep++;
                showStep(currentStep);
            }
        });
    
        prevButton.addEventListener("click", () => {
            if (currentStep > 0) {
                currentStep--;
                showStep(currentStep);
            }
        });
    
        prescriptionSelect.addEventListener("change", updateDynamicInputs);
        document.getElementById("totalAmount").addEventListener("input", calculateBalance);
        document.getElementById("deposit").addEventListener("input", calculateBalance);

        modal.addEventListener("hidden.bs.modal", () => {
        resetForm();
        });

        const resetForm = () => {
            form.reset();
            dynamicInputs.innerHTML = "";
            currentStep = 0; 
            showStep(currentStep);
        };
    
        showStep(currentStep);
    });
    </script>


    <!-- Script to Edit Patient -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const editModal = document.querySelector("#editPatient");
            if (!editModal) return;
    
            const steps = editModal.querySelectorAll(".edit_step");
            const icons = editModal.querySelectorAll(".step-icons .icon");
            const nextButton = editModal.querySelector(".edit_next-step");
            const prevButton = editModal.querySelector(".edit_prev-step");
            const submitButton = editModal.querySelector(".edit_submit-form");
            const prescriptionSelect = document.getElementById("edit_prescription");
            const dynamicInputs = document.getElementById("edit_dynamicInputs");
            const modal = document.getElementById("editPatient");
            const form = document.getElementById("edit_addPatientForm");
    
            let currentStep = 0;
    
            const showStep = (index) => {
                steps.forEach((step, i) => {
                    step.classList.toggle("hidden", i !== index);
                });
    
                icons.forEach((icon, i) => {
                    const iconClass = `edit_step-${i + 1}-icon`;
                    icon.classList.toggle("active", i === index);
                });
    
                prevButton.classList.toggle("hidden", index === 0);
                nextButton.classList.toggle("hidden", index === steps.length - 1);
                submitButton.classList.toggle("hidden", index !== steps.length - 1);
            };
    
            const validateStep = () => {
                const currentFields = steps[currentStep].querySelectorAll("[required]");
                for (const field of currentFields) {
                    if (!field.value.trim()) {
                        field.classList.add("is-invalid");
                        return false;
                    } else {
                        field.classList.remove("is-invalid");
                    }
                }
                return true;
            };
    
            const calculateBalance = () => {
                const total = parseFloat(document.getElementById("edit_totalAmount").value) || 0;
                const deposit = parseFloat(document.getElementById("edit_deposit").value) || 0;
                const balance = total - deposit;
                const statusInput = document.getElementById("edit_status");
    
                document.getElementById("edit_balance").value = balance.toFixed(2);
                if (balance > 0) {
                    statusInput.value = "Partial";
                } else if (balance === 0) {
                    statusInput.value = "Paid";
                } else if (balance === total) {
                    statusInput.value = "Unpaid";
                }
            };
    
            let currentOD = "";
            let currentOS = "";
            let currentOU = "";
    
            const updateDynamicInputs = () => {
                const prescription = prescriptionSelect.value;
    
                currentOD = document.getElementById("edit_od")?.value || currentOD;
                currentOS = document.getElementById("edit_os")?.value || currentOS;
                currentOU = document.getElementById("edit_ou")?.value || currentOU;
    
                dynamicInputs.innerHTML = "";
                if (prescription === "(OD) Right Eye & (OS) Left Eye") {
                    dynamicInputs.innerHTML = `
                        <div class="col-6">
                            <label for="edit_od" class="form-label">OD (Right Eye)</label>
                            <input type="text" id="edit_od" name="edit_ODgrade" class="form-control" required>
                        </div>
                        <div class="col-6">
                            <label for="edit_os" class="form-label">OS (Left Eye)</label>
                            <input type="text" id="edit_os" name="edit_OSgrade" class="form-control" required>
                        </div>
                    `;
                    document.getElementById("edit_od").value = currentOD;
                    document.getElementById("edit_os").value = currentOS;
                } else if (prescription === "(OU) Both Eyes") {
                    dynamicInputs.innerHTML = `
                        <div class="col-12">
                            <label for="edit_ou" class="form-label">OU (Both Eyes)</label>
                            <input type="text" id="edit_ou" name="edit_OUgrade" class="form-control" required>
                        </div>
                    `;
                    document.getElementById("edit_ou").value = currentOU;
                }
                dynamicInputs.classList.toggle("hidden", !prescription);
            };
    
            const fetchPatientData = (PatientID) => {
                fetch(`/admin/patients/edit/${PatientID}`)
                    .then((response) => response.json())
                    .then((data) => {
                        document.getElementById("edit_patientId").value = data.patient.PatientID || "";
                        document.getElementById("edit_prescriptionId").value = data.prescription.PrescriptionID || "";
                        document.getElementById("edit_amountId").value = data.amount.AmountID || "";
    
                        document.getElementById("edit_name").value = data.patient.complete_name || "";
                        document.getElementById("edit_gender").value = data.patient.gender || "";
                        document.getElementById("edit_age").value = data.patient.age || "";
                        document.getElementById("edit_contact").value = data.patient.contact_number || "";
                        document.getElementById("edit_address").value = data.patient.address || "";
    
                        document.getElementById("edit_prescription").value = data.prescription.Prescription || "";
                        currentOD = data.prescription.ODgrade || "";
                        currentOS = data.prescription.OSgrade || "";
                        currentOU = data.prescription.OUgrade || "";
                        updateDynamicInputs();
    
                        document.getElementById("edit_lens").value = data.prescription.Lens || "";
                        document.getElementById("edit_lensType").value = data.prescription.LensType || "";
                        document.getElementById("edit_frame").value = data.prescription.Frame || "";
                        document.getElementById("edit_add").value = data.prescription.ADD || "";
                        document.getElementById("edit_pd").value = data.prescription.PD || "";
                        document.getElementById("edit_prescriptionDetails").value = data.prescription.PrescriptionDetails || "";
    
                        document.getElementById("edit_totalAmount").value = data.amount.TotalAmount || "";
                        document.getElementById("edit_deposit").value = data.amount.Deposit || "";
                        document.getElementById("edit_modeOfPayment").value = data.amount.MOP || "";
                        document.getElementById("edit_balance").value = data.amount.Balance || "";
                        document.getElementById("edit_status").value = data.amount.Payment || "";
    
                        calculateBalance();
                    })
                    .catch((error) => {
                        console.error("Error fetching patient data:", error);
                    });
            };
    
            editModal.addEventListener("show.bs.modal", (event) => {
                const button = event.relatedTarget;
                const patientId = button.getAttribute("data-id");
                if (patientId) {
                    fetchPatientData(patientId);
                }
                showStep(currentStep);
            });
    
            nextButton.addEventListener("click", () => {
                if (!validateStep()) return;
                if (currentStep < steps.length - 1) {
                    currentStep++;
                    showStep(currentStep);
                }
            });
    
            prevButton.addEventListener("click", () => {
                if (currentStep > 0) {
                    currentStep--;
                    showStep(currentStep);
                }
            });
    
            prescriptionSelect.addEventListener("change", updateDynamicInputs);
            document.getElementById("edit_totalAmount").addEventListener("input", calculateBalance);
            document.getElementById("edit_deposit").addEventListener("input", calculateBalance);
    
            modal.addEventListener("hidden.bs.modal", () => {
                resetForm();
            });
    
            const resetForm = () => {
                form.reset();
                dynamicInputs.innerHTML = "";
                currentStep = 0;
                showStep(currentStep);
            };
    
            showStep(currentStep);
    
            form.addEventListener("submit", (e) => {
                e.preventDefault();
    
                if (!validateStep()) return;
    
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Patient details updated successfully.',
                    willClose: () => {
                        form.submit();
                    }
                });
            });
        });
    </script>



    @endsection

@endsection