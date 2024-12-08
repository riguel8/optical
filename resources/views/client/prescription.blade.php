@extends('template.client.layout')

@section('content') 
<div class="page-wrapper cardhead">
    <div class="content" style="overflow-y: auto; height: calc(100vh - 60px);">

        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Prescription</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url("client/dashboard") }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Prescription List</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            @php
                $completedPrescriptions = $prescriptions;
            @endphp

            @if ($completedPrescriptions->isEmpty())
                <div class="col-12">
                    <div class="alert-info px-4 py-2 text-center text-sm text-gray-500">
                        {{ __('No completed prescriptions available yet.') }}
                    </div>
                </div>
            @else
                @foreach ($completedPrescriptions as $prescription)
                    <div class="col-md-4 col-sm-6">
                        <div class="ribbon-wrapper card">
                            <div class="card-body">
                                <div class="ribbon ribbon-info">
                                    {{ $prescription->patient->complete_name ?? 'Unknown Patient' }}
                                </div>
                                <div class="view-btn">
                                    <a class="me-3 view-patient" href="#" data-id="{{ $prescription->PrescriptionID }}" data-bs-toggle="modal" data-bs-target="#viewPatient">
                                        <!-- <iconify-icon icon="material-symbols:ophthalmology-outline-rounded" width="24" height="24" data-bs-toggle="tooltip" data-bs-placement="top" title="View Details"></iconify-icon> -->
                                        <img src="{{ asset('assets/img/icons/eye.svg') }}" alt="img" data-bs-toggle="tooltip" data-bs-placement="top" title="View Details">
                                    </a>
                                </div>
                                <p>
                                    <strong>Age: </strong> {{ $prescription->patient->age ?? 'N/A' }}<br>
                                    <strong>Gender: </strong> {{ ucfirst($prescription->patient->gender ?? 'N/A') }}<br>
                                    <strong>Contact: </strong> {{ $prescription->patient->contact_number ?? 'N/A' }}<br>
                                    <strong>Address: </strong> {{ $prescription->patient->address ?? 'N/A' }}<br>
                                    <hr>
                                    <strong>Prescription: </strong> {{ $prescription->Prescription ?? 'Not Available' }}<br>
                                    <strong>Lens Type: </strong> {{ $prescription->LensType ?? 'Not Available' }}<br>
                                    <hr>
                                    <strong>Date: </strong> {{ $prescription->created_at->format('M d, Y H:i') ?? 'N/A' }}<br>
                                    <strong>Status: </strong>{{ $prescription->PresStatus ?? 'N/A' }}<br>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
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
                    <div class="text-center border-top pt-3">
                        <p class="text-muted"><em>This prescription is generated electronically and does not require a signature.</em></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>


<style>
   
   .ribbon-info {
        background-color: #0d6efd; /* Blue color */
    }

    /* Card body styles */
    .card-body p {
        margin: 0 0 5px;
        font-size: 14px;
    }

    .card-body h5 {
        margin-top: 15px;
        font-weight: bold;
        font-size: 16px;
    }

    .card-body hr {
        margin: 10px 0;
        border-top: 1px solid #ddd;
    }
    .view-btn {
        position: absolute;
        top: 15px;
        right: 10px;
        z-index: 1;
    }

    .view-btn .btn {
        font-size: 12px;
        padding: 10px 10px;
    }
</style>

    @section('scripts')

    <!-- Script to view specific patient -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const viewButtons = document.querySelectorAll('.view-patient');
        viewButtons.forEach(button => {
            button.addEventListener('click', function () {
                const PatientId = this.getAttribute('data-id');
                fetch(`/client/prescription/${PatientId}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        const setTextContent = (id, value) => {
                            const element = document.getElementById(id);
                            element.textContent = value || 'Not Available';
                            element.style.color = value ? '' : 'red';
                        };

                        setTextContent('viewpatientName', data.patient.complete_name);
                        setTextContent('viewpatientAge', data.patient.age);
                        setTextContent('viewpatientGender', data.patient.gender);
                        setTextContent('viewcontactNumber', data.patient.contact_number);
                        setTextContent('viewpatientAddress', data.patient.address);

                        setTextContent('viewprescriptionPrescription', data.prescription.prescription);
                        setTextContent('viewprescriptionOD', data.prescription.ODgrade);
                        setTextContent('viewprescriptionOS', data.prescription.OSgrade);
                        setTextContent('viewprescriptionADD', data.prescription.ADD);
                        setTextContent('viewprescriptionPD', data.prescription.PD);
                        setTextContent('viewprescriptionOU', data.prescription.OUgrade);

                        setTextContent('viewprescriptionLens', data.prescription.lens);
                        setTextContent('viewprescriptionLensType', data.prescription.lens_type);
                        setTextContent('viewprescriptionFrame', data.prescription.frame);

                        setTextContent('viewtotalAmount', data.payment.total_amount);
                        setTextContent('viewdeposit', data.payment.deposit);
                        setTextContent('viewmodeOfPayment', data.payment.mode_of_payment);
                        setTextContent('viewbalance', data.payment.balance);

                        const paymentStatus = data.payment.status || '';
                        const paymentStatusBadge = document.getElementById('viewpaymentStatus');
                        paymentStatusBadge.textContent = paymentStatus;
                        paymentStatusBadge.className = 'badge'; // Reset classes

                        switch(paymentStatus.toLowerCase()) {
                            case 'paid':
                                paymentStatusBadge.classList.add('bg-success');
                                break;
                            case 'partial':
                                paymentStatusBadge.classList.add('bg-warning');
                                break;
                            case 'unpaid':
                                paymentStatusBadge.classList.add('bg-danger');
                                break;
                            default:
                                paymentStatusBadge.classList.add('bg-secondary');
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching patient details:', error);
                        alert('Error fetching data.');
                    });
            });
        });
    });
</script>

    
    @endsection
@endsection
