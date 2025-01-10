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

    toastr.options = {
        closeButton: true,
        progressBar: true,
        positionClass: "toast-bottom-right", 
        timeOut: 3000,
        showMethod: "fadeIn", 
        hideMethod: "fadeOut",   
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
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="text" id="od" name="ODgrade" class="form-control" placeholder="OD (Right Eye)" required>
                        <label for="od" class="form-label">OD (Right Eye)</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="text" id="os" name="OSgrade" class="form-control" placeholder="OS (Left Eye)" required>
                        <label for="os" class="form-label">OS (Left Eye)</label>
                    </div>
                </div>
            `;
        } else if (prescription === "(OU) Both Eyes") {
            dynamicInputs.innerHTML = `
                <div class="col-md-12">
                    <div class="form-floating mb-3">
                        <input type="text" id="ou" name="OUgrade" class="form-control" placeholder="OU (Both Eyes)" required>
                        <label for="ou" class="form-label">OU (Both Eyes)</label>
                    </div>
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

    $(document).ready(function() {
        $('#addPatientForm').submit(function(e) {
            e.preventDefault(); 

            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: 'json',
                success: (data) => {
                    if (data.status === 'success') {
                        toastr.success(data.message, 'Success!');
                        $('#addPatient').modal('hide');
                        resetForm();
                        setTimeout(() => location.reload(), 3000);
                    } else {
                        toastr.error(data.message || 'An error occurred.', 'Error');
                    }
                },
                error: (xhr) => {
                    toastr.error(xhr.responseJSON?.message || 'An unexpected error occurred.', 'Error');
                }
            });
        });
    });
});
