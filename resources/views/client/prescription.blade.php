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

    <div class="modal fade" id="viewPatient" tabindex="-1" aria-labelledby="viewPatientLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 style="text-align: center; width: 100%;" class="modal-title" id="viewPatientLabel">Patient Details</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" >
                
                        <div class="invoice-box table-height" style="max-width: 100%; width: 100%;  margin:15px auto; padding: 0; font-size: 14px; line-height: 24px; color: #555;">
                            <table cellpadding="0" cellspacing="0" style="width: 100%; line-height: inherit; text-align: left;">
                                <tbody>
                                    <tr class="top">
                                        <td colspan="6" style="vertical-align: top;">
                                            <table style="width: 100%; line-height: inherit; text-align: left;">
                                            <tbody><tr>
                                                <td style="vertical-align: top; text-align: left; padding-bottom: 20px; border: 1px solid #ddd; border-radius: 5px; padding: 15px;">
                                                    <font style="vertical-align: inherit;margin-bottom:25px;"><font style="vertical-align: inherit;font-size:14px;color:#7367F0;font-weight:600;line-height: 35px;">Patient Info</font></font><br>
                                                    <font style="vertical-align: inherit;">Name: <font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;" id="viewpatientName"></font></font><br>
                                                    <font style="vertical-align: inherit;">Age: <font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"id="viewpatientAge"></font></font><br>
                                                    <font style="vertical-align: inherit;">Gender: <font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;" id="viewpatientGender"></font></font><br>
                                                    <font style="vertical-align: inherit;">Contact Number: <font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;" id="viewcontactNumber"></font></font><br>
                                                    <font style="vertical-align: inherit;">Address: <font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;" id="viewpatientAddress"></font></font><br>
                                                </td>
                                                <td style="padding: 5px; vertical-align: top; text-align: left; padding-bottom: 20px; border: 1px solid #ddd; border-radius: 5px; padding: 15px;">
                                                    <font style="vertical-align: inherit;margin-bottom:25px;"><font style="vertical-align: inherit;font-size:14px;color:#7367F0;font-weight:600;line-height: 35px; ">Prescription Info</font></font><br>
                                                    <font style="vertical-align: inherit;">Prescription: <font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;" id="viewprescriptionPrescription"></font></font><br>
                                                    <font style="vertical-align: inherit; display: none;" id="viewgradeRight">OD (Right Eye): <font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;" id="viewprescriptionOD"></font></font>
                                                    <font style="vertical-align: inherit; display: none;" id="viewgradeLeft">OS (LEFT Eye): <font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;" id="viewprescriptionOS"></font></font>
                                                    <font style="vertical-align: inherit; display: none;" id="viewgradeBoth">OU (BOTH Eye): <font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;" id="viewprescriptionOU"></font></font>
                                                    <font style="vertical-align: inherit;">Lens: <font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;" id="viewprescriptionLens"></font></font><br>
                                                    <font style="vertical-align: inherit;">Lens Type: <font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;" id="viewprescriptionLensType"></font></font><br>
                                                    <font style="vertical-align: inherit;">Frame: <font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;" id="viewprescriptionFrame"></font></font><br>
                                                    <font style="vertical-align: inherit;">ADD: <font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;" id="viewprescriptionADD"></font></font><br>
                                                    <font style="vertical-align: inherit;">PD: <font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;" id="viewprescriptionPD"></font></font><br>
                                                    <font style="vertical-align: inherit;">Payment Status: <font style="vertical-align: inherit;"><font class="rounded-pill bg-secondary badges badges-sm" style="vertical-align: inherit;font-size: 14px;color:white;font-weight: 400;" id="viewpaymentStatus"></font></font><br>
                                                </td>
                                            </tr>
                                        </tbody></table>
                                    </td>
                                </tr>
                            </tbody></table>

                            <div class="row">
                                <div class="col-lg-6 ">
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
                                <div class="col-lg-6 ">
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const viewButtons = document.querySelectorAll('.view-patient');
            viewButtons.forEach(button => {
                button.addEventListener('click', function () {
                    const prescriptionId = this.getAttribute('data-id');
                    fetch(`/client/prescription/${prescriptionId}`)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            // Fill in the patient details
                            document.getElementById('viewpatientName').textContent = data.patient.complete_name || '';
                            document.getElementById('viewpatientAge').textContent = data.patient.age || '';
                            document.getElementById('viewpatientGender').textContent = data.patient.gender || '';
                            document.getElementById('viewcontactNumber').textContent = data.patient.contact_number || '';
                            document.getElementById('viewpatientAddress').textContent = data.patient.address || '';

                            // Fill in the prescription details
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

                            // Payment details
                            document.getElementById('viewtotalAmount').textContent = data.payment.total_amount || '';
                            document.getElementById('viewdeposit').textContent = data.payment.deposit || '';
                            document.getElementById('viewmodeOfPayment').textContent = data.payment.mode_of_payment || '';
                            document.getElementById('viewbalance').textContent = data.payment.balance || '';

                            const paymentStatus = data.payment.status || '';
                            const paymentStatusBadge = document.getElementById('viewpaymentStatus');
                            paymentStatusBadge.textContent = paymentStatus;

                            paymentStatusBadge.classList.add('badge', 'badge-sm');

                            if (paymentStatus.toLowerCase() === 'paid') {
                                paymentStatusBadge.classList.remove('bg-warning', 'bg-danger');
                                paymentStatusBadge.classList.add('bg-success');
                            } else if (paymentStatus.toLowerCase() === 'partial') {
                                paymentStatusBadge.classList.remove('bg-success', 'bg-danger');
                                paymentStatusBadge.classList.add('bg-warning');
                            } else if (paymentStatus.toLowerCase() === 'unpaid') {
                                paymentStatusBadge.classList.remove('bg-success', 'bg-warning');
                                paymentStatusBadge.classList.add('bg-danger');
                            } else {
                                paymentStatusBadge.classList.remove('bg-success', 'bg-warning', 'bg-danger');
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
