@extends('template.ophthal.layout')

@section('content') 

<div class="page-wrapper">
    <div class="content"  style="overflow-y: auto; height: calc(100vh - 60px);">
        <div class="page-header">
            <div class="page-title">
                <h4>Patients</h4>
                <h6>Patient Lists</h6>
            </div>
            <div class="page-btn">
                {{-- <a data-bs-target="#createPrescription" data-bs-toggle="modal" class="btn btn-added">
                    <img src="{{ asset("assets/img/icons/plus.svg")}}" alt="img">Create Prescription
                </a> --}}
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
                                <th>Price</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($patients as $patient)
                                <tr>
                                    <td>{{ $patient->complete_name }}</td>
                                    <td>{{ $patient->age }}</td>
                        
                                    <td class="{{ isset($patient->prescription) && $patient->prescription->Prescription ? '' : 'text-red' }}">
                                        {{ $patient->prescription->Prescription ?? 'No Prescription Yet' }}
                                    </td>
                                    
                                    <td class="{{ isset($patient->prescription) && $patient->prescription->Lens ? '' : 'text-red' }}">
                                        {{ $patient->prescription->Lens ?? 'No Lens Yet' }}
                                    </td>
                        
                                    <td class="{{ isset($patient->prescription) && $patient->prescription->Frame ? '' : 'text-red' }}">
                                        {{ $patient->prescription->Frame ?? 'No Frame Yet' }}
                                    </td>
                        
                                    <td class="{{ isset($patient->prescription) && $patient->prescription->Price ? '' : 'text-red' }}">
                                        {{ $patient->prescription->Price ?? 'N/A' }}
                                    </td>
                        
                                    <td>{{ \Carbon\Carbon::parse($patient->created_at)->format('F j, Y') }}</td>
                                    
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a class="me-3 view-patient" href="#" data-id="{{ $patient->PatientID }}" data-bs-toggle="modal" data-bs-target="#viewPatient">
                                                <img src="{{ asset('assets/img/icons/eye.svg') }}" alt="img" data-bs-toggle="tooltip" data-bs-placement="top" title="View Patient">
                                            </a>                                          
                                            <a class="me-3 prescription" href="#" 
                                            data-id="{{ $patient->PatientID}}" 
                                            data-name="{{ $patient->complete_name }}" 
                                            data-age="{{ $patient->age }}" 
                                            data-gender="{{ $patient->gender }}" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#Prescription">
                                            <img src="{{ asset('assets/img/icons/add-pres.png') }}" alt="Prescription">
                                         </a>
                                        </div>
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


<!-- Add Prescription Modal-->
<div class="modal fade" id="Prescription" tabindex="-1" aria-labelledby="prescriptionLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="prescriptionLabel">New Prescription</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('ophthal.patients.storePrescription', ['PrescriptionID' => $prescription->PrescriptionID ?? '']) }}" method="POST">
                    @csrf
                    @if (isset($prescription) && $prescription->PrescriptionID)
                        @method('PUT')
                    @endif
                    <input type="hidden" name="PrescriptionID" id="edit_PrescriptionID"> 
                    <input type="hidden" name="PatientID" id="patientID">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="edit_patientName" name="edit_patientName" required readonly>
                                <label for="edit_patientName">Patient Name:</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating">
                            <input type="number" class="form-control" id="edit_age" name="edit_age" required readonly>
                            <label for="edit_age">Age:</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating">
                            <input type="text" class="form-control" id="edit_gender" name="edit_gender" required readonly>
                            <label for="edit_gender">Gender:</label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select name="edit_prescription" class="form-select" id="edit_prescription" required>
                                    <option value="" disabled selected>Select Prescription</option>
                                    <option value="(OD) Right Eye">(OD) Right Eye</option>
                                    <option value="(OS) Left Eye">(OS) Left Eye</option>
                                    <option value="(OU) Both Eyes">(OU) Both Eyes</option>
                                </select>
                                <label for="edit_prescription">Prescription</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select name="edit_lens" class="form-select" id="edit_lens" required>
                                    <option value="" disabled selected>Select Lens</option>
                                    <option value="SINGLE VISION">SINGLE VISION</option>
                                    <option value="DOUBLE VISION">DOUBLE VISION</option>
                                    <option value="PROGRESSIVE">PROGRESSIVE</option>
                                    <option value="NEAR VISION">NEAR VISION</option>
                                </select>
                                <label for="edit_lens">Lens</label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input class="form-control" type="text" id="edit_frame" name="edit_frame" placeholder="Enter Frame" required>
                                <label for="edit_frame">Frame</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input class="form-control" type="number" id="edit_price" name="edit_price" placeholder="Enter Price" required>
                                <label for="edit_price">Price</label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="form-floating">
                                <textarea style="height: 100px" class="form-control" id="edit_prescriptionDetails" name="edit_PrescriptionDetails" placeholder="Enter Prescription Details" rows="3" required></textarea>
                                <label for="edit_prescriptionDetails">Prescription Details</label>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 d-flex justify-content-end gap-2">
                        <button class="btn btn-lg btn-submit col-md-3" type="submit">Save</button>
                        <button class="btn btn-lg btn-cancel col-md-3" type="button" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
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
                        <li>
                            <h4><strong>Patient Name:</strong></h4>
                            <h6 id="patientName"></h6>
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
                    </ul>

                    <ul style="flex: 1; min-width: 250px; padding-left: 20px; list-style-type: none; text-align: right;">
                        <li>
                            <h4><strong>Prescription:</strong></h4>
                            <h6><span id="prescriptionPrescription"></span></h6>
                        </li>
                        <li>
                            <h4><strong>Lens:</strong></h4>
                            <h6><span id="prescriptionLens"></span></h6>
                        </li>
                        <li>
                            <h4><strong>Frame:</strong></h4>
                            <h6><span id="prescriptionFrame"></span></h6>
                        </li>
                        <li>
                            <h4><strong>Details:</strong></h4>
                            <h6><span id="prescriptionDetails"></span></h6>
                        </li>
                        <li>
                            <h4><strong>Price:</strong></h4>
                            <h6><span id="prescriptionPrice"></span></h6>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
  




@section('scripts')
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.bootstrap5.min.js') }}"></script>


<!-- Script to fetch data for edit and submit -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    const prescriptionModal = document.getElementById('Prescription');

    prescriptionModal.addEventListener('show.bs.modal', function(event) {
        const button = event.relatedTarget;
        const patientID = button.getAttribute('data-id');

        console.log('Modal triggered for patient ID:', patientID);

        fetch(`/ophthal/patients/edit/${patientID}`)
            .then(response => response.json())
            .then(data => {
                console.log('Fetched data:', data);

                if (data.patient) {
                    document.getElementById('patientID').value = data.patient.PatientID;
                    document.getElementById('edit_patientName').value = data.patient.complete_name;
                    document.getElementById('edit_age').value = data.patient.age;
                    document.getElementById('edit_gender').value = data.patient.gender;

                    document.getElementById('edit_prescription').value = data.prescription?.Prescription || '';
                    document.getElementById('edit_lens').value = data.prescription?.Lens || '';
                    document.getElementById('edit_frame').value = data.prescription?.Frame || '';
                    document.getElementById('edit_price').value = data.prescription?.Price || '';
                    document.getElementById('edit_prescriptionDetails').value = data.prescription?.PrescriptionDetails || '';

                    document.getElementById('edit_PrescriptionID').value = data.prescription?.PrescriptionID || '';
                } else {
                    console.error("No patient data found.");
                }
            })
            .catch(error => console.error('Error fetching patient data:', error));
    });

    // Form submission handling
    const editForm = document.querySelector("form");
    editForm.addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);
        fetch(editForm.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
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


<!-- Script to view specific patient -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const viewButtons = document.querySelectorAll('.view-patient');
        viewButtons.forEach(button => {
            button.addEventListener('click', function () {
                const PatientId = this.getAttribute('data-id');
                console.log('Fetching details for Patient ID:', PatientId);

                fetch(`/ophthal/patients/${PatientId}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        document.getElementById('patientName').textContent = data.patient.complete_name || '';
                        document.getElementById('patientAge').textContent = data.patient.age || '';
                        document.getElementById('patientGender').textContent = data.patient.gender || '';
                        document.getElementById('contactNumber').textContent = data.patient.contact_number || '';
                        document.getElementById('patientAddress').textContent = data.patient.address || '';

                        document.getElementById('prescriptionPrescription').textContent = data.prescription.prescription || 'Not Available';
                        document.getElementById('prescriptionLens').textContent = data.prescription.lens || 'Not Available';
                        document.getElementById('prescriptionFrame').textContent = data.prescription.frame || 'Not Available';
                        document.getElementById('prescriptionDetails').textContent = data.prescription.details || 'Not Available';
                        document.getElementById('prescriptionPrice').textContent = data.prescription.price || 'Not Available';
                    })
                    .catch(error => {
                        console.error('Error fetching appointment details:', error);
                        alert('Error fetching patient data.');
                    });
            });
        });
    });
</script>
        


    @endsection   
    
@endsection
















<!-- Add Patient Modal -->
{{-- <div class="modal fade" id="createPrescription" tabindex="-1" aria-labelledby="addPatientLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPatientLabel">New Prescription</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('ophthal.storePrescription') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <select class="form-select" id="patientSelect" name="PatientID" required>
                                    <option value="" disabled selected>Select Patient</option>
                                    @foreach ($patients as $patient)
                                        <option value="{{ $patient->PatientID }}" data-name="{{ $patient->complete_name }}" data-age="{{ $patient->age }}" data-gender="{{ $patient->gender }}" data-cnum="{{ $patient->contact_number }}" data-address="{{ $patient->address }}">{{ $patient->complete_name }}</option>
                                    @endforeach
                                </select>
                                <label for="patientSelect">Patient</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input class="form-control" type="number" id="age" placeholder="Enter Age" name="age" required readonly>
                                <label for="age">Age</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <select name="prescription" class="form-select" id="prescription" required>
                                    <option value="" disabled selected>Select Prescription</option>
                                    <option value="(OD) Right Eye">(OD) Right Eye</option>
                                    <option value="(OS) Left Eye">(OS) Left Eye</option>
                                    <option value="(OU) Both Eyes">(OU) Both Eyes</option>
                                </select>
                                <label for="prescription">Prescription</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input class="form-control" type="text" id="gender" placeholder="Gender" name="gender" required readonly>
                                <label for="gender">Gender</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <select name="lens" class="form-select" id="lens" required>
                                    <option value="" disabled selected>Select Lens</option>
                                    <option value="SINGLE VISION">SINGLE VISION</option>
                                    <option value="DOUBLE VISION">DOUBLE VISION</option>
                                    <option value="PROGRESSIVE">PROGRESSIVE</option>
                                    <option value="NEAR VISION">NEAR VISION</option>
                                </select>
                                <label for="lens">Lens</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input class="form-control" type="text" id="frame" placeholder="Enter Frame" name="frame" required>
                                <label for="frame">Frame</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input class="form-control" type="number" id="price" placeholder="Enter Price" name="price" required>
                                <label for="price">Price</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input type="datetime-local" class="form-control" id="date" name="date" required>
                                <label for="date">Date</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input class="form-control" type="tel" id="contact_number" placeholder="Enter contact number" name="contact_number" required readonly>
                                <label for="contact_number">Contact Number</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input class="form-control" type="text" id="address" placeholder="Enter address" name="address" required readonly>
                                <label for="address">Address</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="form-floating">
                                <textarea style="height: 100px" class="form-control" id="prescriptionDetails" placeholder="Enter Prescription Details" name="PrescriptionDetails" rows="3" required></textarea>
                                <label for="prescriptionDetails">Prescription Details</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-end">
                        <button class="btn btn-sm btn-primary" type="submit">Save</button>
                        <button class="btn btn-sm btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> --}}