document.addEventListener('DOMContentLoaded', function () {
    const editButtons = document.querySelectorAll('.edit-eyewear');
    const editForm = document.querySelector('#editEyewearForm');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');


    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            const EyewearID = this.getAttribute('data-id');
            document.getElementById('Eyewear_ID').value = EyewearID;
            editForm.action = `/admin/eyewears/update/${EyewearID}`;
            
            fetch(`/admin/eyewears/edit/${EyewearID}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('edit_brand').value = data.Brand;
                    document.getElementById('edit_model').value = data.Model;
                    document.getElementById('edit_frame_type').value = data.FrameType;
                    document.getElementById('edit_frame_color').value = data.FrameColor;
                    document.getElementById('edit_lens_type').value = data.LensType;
                    document.getElementById('edit_lens_material').value = data.LensMaterial;
                    document.getElementById('edit_quantity_available').value = data.QuantityAvailable;
                    document.getElementById('edit_price').value = data.Price;

                    const imagePreview = document.getElementById("edit_imagePreview");
                    const imageName = document.getElementById("edit_imageName");
                    if (data.image) {
                        imagePreview.src = `/storage/eyewears/${data.image}`;
                        imageName.textContent = data.image;
                    } else {
                        imagePreview.src = "{{ asset('assets/img/icons/upload.svg') }}";
                        imageName.textContent = "No image selected";
                    }
                })
                .catch(error => console.error('Error fetching Eyewear details:', error));
        });
    });

        const imageInput = document.getElementById('edit_image');
        const imgElement = document.getElementById('edit_imagePreview');
        const imageNameElement = document.getElementById('edit_imageName');

        imageInput.addEventListener('change', function (event) {
            const file = event.target.files[0];
            
            if (file) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    imgElement.src = e.target.result; 
                    imgElement.style.display = 'block'; 
                    imageNameElement.textContent = file.name; 
                };

                reader.readAsDataURL(file); 
            } else {
                imgElement.src = "{{ asset('assets/img/icons/upload.svg') }}";
                imageNameElement.textContent = "No image selected"; 
            }
        });

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