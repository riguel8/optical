
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

