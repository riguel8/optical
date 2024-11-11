@extends('template.admin.header')

@section('content')

<div class="page-wrapper">
    <div class="content" style="overflow-y: auto; height: calc(100vh - 60px);">
        <div class="page-header">
            <div class="page-title">
                <h4>Patients</h4>
                <h6>Patient Lists</h6>
            </div>
            <div class="page-btn">
                {{-- <a data-bs-target="#addPatient" data-bs-toggle="modal" class="btn btn-added">
                    <img src="{{ asset("assets/img/icons/plus.svg")}}" alt="img">Add Patient
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

                                    <td class="{{ isset($patient->prescription) && $patient->prescription->Price ? '' : 'text-red' }}">
                                        {{ $patient->prescription->Price ?? 'N/A' }}
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($patient->created_at)->format('F-j-Y') }}</td>
                                    <td>
                                        <a class="me-3 view-patient" href="#" data-id="{{ $patient->PatientID }}" data-bs-toggle="modal" data-bs-target="#viewPatient">
                                            <img src="{{ asset('assets/img/icons/eye.svg') }}" alt="img" data-bs-toggle="tooltip" data-bs-placement="top" title="View Patient">
                                        </a>
                                        <a class="me-3 edit-patient" href="#" data-id="{{ $patient->PatientID }}" data-bs-toggle="modal" data-bs-target="#Patient">
                                            <img src="{{ asset('assets/img/icons/add-pres.png') }}" alt="img" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Patient">
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
    
    


    <!-- Modal to Edit Specific Patient -->
    <div class="modal fade" id="Patient" tabindex="-1" aria-labelledby="patientLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="patientLabel">Patient Prescription</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="" id="editPatientForm">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="patient_id" name="patientID" value="">

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="editpatientName">Patient Name:</label>
                                <input type="text" class="form-control" id="editpatientName" name="editpatientName">
                            </div>
                            <div class="col-md-3">
                                <label for="editage">Age:</label>
                                <input type="number" class="form-control" id="editage" name="editage">
                            </div>
                            <div class="col-md-3">
                                <label for="edit_floatingSelect">Gender:</label>
                                <select name="editgender" class="form-control" id="edit_floatingSelect" required>
                                    <option value="" disabled selected>Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="editaddress">Address:</label>
                                <input type="text" class="form-control" id="editaddress" name="editaddress" >
                            </div>
                            <div class="col-md-6">
                                <label for="editcontactnumber">Contact Number:</label>
                                <input type="text" class="form-control" id="editcontactnumber" name="editcontactnumber">
                            </div>
                        </div>
    
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select name="editprescription" class="form-select" id="editprescription" required>
                                        <option value="" disabled selected>Select Prescription</option>
                                        <option value="(OD) Right Eye">(OD) Right Eye</option>
                                        <option value="(OS) Left Eye">(OS) Left Eye</option>
                                        <option value="(OU) Both Eyes">(OU) Both Eyes</option>
                                    </select>
                                    <label for="editprescription">Prescription</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select name="editlens" class="form-select" id="editlens" required>
                                        <option value="" disabled selected>Select Lens</option>
                                        <option value="SINGLE VISION">SINGLE VISION</option>
                                        <option value="DOUBLE VISION">DOUBLE VISION</option>
                                        <option value="PROGRESSIVE">PROGRESSIVE</option>
                                        <option value="NEAR VISION">NEAR VISION</option>
                                    </select>
                                    <label for="editlens">Lens</label>
                                </div>
                            </div>
                        </div>
    
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input class="form-control" type="text" id="editframe" name="editframe" placeholder="Enter Frame" required>
                                    <label for="editframe">Frame</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input class="form-control" type="number" id="editprice" name="editprice" placeholder="Enter Price" required>
                                    <label for="editprice">Price</label>
                                </div>
                            </div>
                        </div>
    
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <textarea style="height: 100px" class="form-control" id="editprescriptionDetails" name="editPrescriptionDetails" placeholder="Enter Prescription Details" rows="3" required></textarea>
                                    <label for="editprescriptionDetails">Prescription Details</label>
                                </div>
                            </div>
                        </div>
    
                        <div class="modal-footer justify-content-end">
                            <button class="btn btn-sm btn-primary" type="submit">Update Changes</button>
                            <button class="btn btn-sm btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    




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
                        console.log('Fetching details for Patient ID:', PatientId);

                        fetch(`/admin/patients/${PatientId}`)
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


    <!-- Script to Edit and Save Changes Patient/Prescription -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const editButtons = document.querySelectorAll('.edit-patient');
            const editForm = document.querySelector('#editPatientForm');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            editButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const PatientID = this.getAttribute('data-id');
                    document.getElementById('patient_id').value = PatientID;
                    editForm.action = `/admin/patients/update/${PatientID}`;

                    console.log(editForm.action);

                    fetch(`/admin/patients/edit/${PatientID}`)
                        .then(response => response.json())
                        .then(data => {
                            document.getElementById('editpatientName').value = data.patient.complete_name;
                            document.getElementById('editage').value = data.patient.age;
                            document.getElementById('edit_floatingSelect').value = data.patient.gender;
                            document.getElementById('editaddress').value = data.patient.address;
                            document.getElementById('editcontactnumber').value = data.patient.contact_number;

                            if (data.prescription) {
                                document.getElementById('editprescription').value = data.prescription.prescription;
                                document.getElementById('editlens').value = data.prescription.lens;
                                document.getElementById('editframe').value = data.prescription.frame;
                                document.getElementById('editprice').value = data.prescription.price;
                                document.getElementById('editprescriptionDetails').value = data.prescription.details;
                            } else {
                                document.getElementById('editprescription').value = '';
                                document.getElementById('editlens').value = '';
                                document.getElementById('editframe').value = '';
                                document.getElementById('editprice').value = '';
                                document.getElementById('editprescriptionDetails').value = '';
                            }
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


    @endsection

@endsection




<!-- add patient modal -->
{{-- <div class="modal fade" id="addPatient" tabindex="-1" aria-labelledby="addPatientLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPatientLabel">New Patient</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form >
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input class="form-control" type="text" id="complete_name" placeholder="Enter Patients Name" name="complete_name" required>
                                <label for="complete_name">Patient Name</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input class="form-control" type="number" id="age" placeholder="Enter Age" name="age" required>
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
                                <select name="gender" class="form-select" id="gender" required>
                                    <option value="" disabled selected>Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
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
                                <input class="form-control" type="tel" id="contact_number" placeholder="Enter contact number" name="contact_number" required>
                                <label for="contact_number">Contact Number</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input class="form-control" type="text" id="address" placeholder="Enter address" name="address" required>
                                <label for="address">Address</label>
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

