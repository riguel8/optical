document.addEventListener('DOMContentLoaded', function () {
    const addEyewearForm = document.getElementById('addEyewearForm');
    const addEyewearModal = document.getElementById('addeyewear');
    const imageInput = document.getElementById('image');
    const imgElement = document.getElementById('imagePreview');
    const imageNameElement = document.getElementById('imageName');

    toastr.options = {
        closeButton: true,
        progressBar: true,
        positionClass: "toast-top-right", 
        timeOut: 2000,
        showMethod: "slideDown", 
        hideMethod: "slideUp",   
        showDuration: 300,     
        hideDuration: 200,      
        extendedTimeOut: 1000      
    };
    addEyewearForm.onsubmit = function (event) {
        event.preventDefault();
        const formData = new FormData(this);

        fetch(window.storeEyewearRoute, { 
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': window.csrfToken 
            },
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                toastr.success(data.message, 'Success!');
                this.reset();
                $('#addeyewear').modal('hide');
                setTimeout(() => location.reload(), 2000);
            } else {
                toastr.error(data.message || 'An error occurred');
            }
            })
        .catch(error => {
            console.error('Error:', error);
            toastr.error('An unexpected error occurred');
        })
        .finally(() => {
            submitBtn.disabled = false;
        });
    };

    addEyewearModal.addEventListener('hidden.bs.modal', function () {
        addEyewearForm.reset();
        imgElement.src = window.uploadIconUrl; 
        imageNameElement.textContent = 'Drag and drop a file to upload';
    });

    imageInput.onchange = function (e) {
        const file = e.target.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function (event) {
                imgElement.src = event.target.result;
                imgElement.style.display = 'block';
                imageNameElement.textContent = file.name;
            };

            reader.readAsDataURL(file);
        } else {
            imgElement.style.display = 'none';
            imageNameElement.textContent = 'Drag and drop a file to upload';
        }
    };
});
