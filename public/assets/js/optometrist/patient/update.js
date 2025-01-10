
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
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        toastr.options = {
            closeButton: true,
            progressBar: true,
            positionClass: "toast-top-right", 
            timeOut: 3000,
            showMethod: "slideDown", 
            hideMethod: "slideUp",   
            showDuration: 300,     
            hideDuration: 200,      
            extendedTimeOut: 2000      
        };

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
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" id="edit_od" name="edit_ODgrade" class="form-control" placeholder="OD (Right Eye)" required>
                            <label for="edit_od" class="form-label">OD (Right Eye)</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" id="edit_os" name="edit_OSgrade" class="form-control"placeholder="OS (Left Eye)" required>
                            <label for="edit_os" class="form-label">OS (Left Eye)</label>
                        </div
                    </div>
                `;
                document.getElementById("edit_od").value = currentOD;
                document.getElementById("edit_os").value = currentOS;
            } else if (prescription === "(OU) Both Eyes") {
                dynamicInputs.innerHTML = `
                    <div class="col-12">
                        <div class="form-floating mb-3">
                            <input type="text" id="edit_ou" name="edit_OUgrade" class="form-control" placeholder="OU (Both Eyes)" required>
                            <label for="edit_ou" class="form-label">OU (Both Eyes)</label>
                        </div>
                    </div>
                `;
                document.getElementById("edit_ou").value = currentOU;
            }
            dynamicInputs.classList.toggle("hidden", !prescription);
        };

        const fetchPatientData = (PatientID) => {
            fetch(`/optometrist/patients/edit/${PatientID}`)
                .then((response) => response.json())
                .then((data) => {
                    document.getElementById("edit_patientId").value = data.patient.PatientID || "";
                    document.getElementById("edit_prescriptionId").value = data.prescription.PrescriptionID || "";
                    document.getElementById("edit_amountId").value = data.amount.AmountID || "";
                    document.getElementById("edit_appointmentId").value = data.appointment.AppointmentID || "";

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

        const formData = new FormData(form);

        fetch(form.action, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            body: formData,
        })
            .then((response) => response.json())
            .then(data => {
                if (data.status === 'success') {
                    toastr.success(data.message, 'Success!');
                    $('#editPatient').modal('hide');
                    
                    setTimeout(() => {
                        location.reload();
                    }, 3000);
                } else {
                    toastr.error(data.message, 'Error!');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                toastr.error('An unexpected error occurred', 'Error!');
            });
        });
    });
