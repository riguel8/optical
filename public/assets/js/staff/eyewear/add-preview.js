document.addEventListener('DOMContentLoaded', function () {
    const addEyewearForm = document.getElementById('addEyewearForm');
    const addEyewearModal = document.getElementById('addeyewear');
    const imageInput = document.getElementById('image');
    const imgElement = document.getElementById('imagePreview');
    const imageNameElement = document.getElementById('imageName');

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
        .catch(() => {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An unexpected error occurred. Please try again.',
            });
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
