@extends('template.admin.header')

@section('content')

<div class="page-wrapper">
    <div class="content" style="overflow-y: auto; height: calc(100vh - 60px);">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Full details of a product</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url("admin/eyewears")}}">Eyewear</a></li>
                        <li class="breadcrumb-item active">Product Details</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8 col-sm-12">
                <div class="card" style="height: 400px;"> 
                    <div class="card-body d-flex flex-column"> 
                        <div class="productdetails" style="overflow-y: auto;"> 
                            <ul class="product-bar">
                                <li>
                                    <h4><strong>Brand</strong></h4>
                                    <h6>{{ $eyewear->Brand }}</h6>
                                </li>
                                <li>
                                    <h4><strong>Model</strong></h4>
                                    <h6>{{ $eyewear->Model }}</h6>
                                </li>
                                <li>
                                    <h4><strong>Frame Type</strong></h4>
                                    <h6>{{ $eyewear->FrameType }}</h6>
                                </li>
                                <li>
                                    <h4><strong>Frame Color</strong></h4>
                                    <h6>{{ $eyewear->FrameColor }}</h6>
                                </li>
                                <li>
                                    <h4><strong>Lens Type</strong></h4>
                                    <h6>{{ $eyewear->LensType }}</h6>
                                </li>
                                <li>
                                    <h4><strong>Lens Material</strong></h4>
                                    <h6>{{ $eyewear->LensMaterial }}</h6>
                                </li>
                                <li>
                                    <h4><strong>Quantity</strong></h4>
                                    <h6>{{ $eyewear->QuantityAvailable }}</h6>
                                </li>
                                <li>
                                    <h4><strong>Price</strong></h4>
                                    <h6>₱{{ number_format($eyewear->Price, 2) }}</h6>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 col-sm-12">
                <div class="card" style="height: 400px;"> 
                    <div class="card-body text-center" style="height: 100%;">
                        <div class="slider-product" style="height: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center;">
                        <h4 style="margin-top: 10px;"><strong>{{$eyewear->Brand}}</strong></h4>    
                        <img src="{{ asset('storage/eyewears/' . $eyewear->image) }}" alt="img" style="height: 80%; width: auto; object-fit: contain;">
                                <button class="btn btn-lg btn-submit w-100 edit-eyewear me-2"  data-id="{{ $eyewear->EyewearID }}" data-bs-toggle="modal" data-bs-target="#editEyewear">
                                    Edit
                                </button>               
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Eyewear Modal -->
<div class="modal fade" id="editEyewear" tabindex="-1" aria-labelledby="editEyewearLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editEyewearLabel">Edit Eyewear</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="" id="editEyewearForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row d-flex align-items-stretch">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Eyewear Image</label>
                                <div class="image-upload">
                                    <input id="edit_image" name="image" type="file" accept="image/*">
                                    <div class="image-uploads">
                                        <img src="{{ asset('assets/img/icons/upload.svg') }}" alt="Upload" id="edit_imagePreview"
                                            style="max-width: 100%; height: 200px; object-fit: contain; border-radius: 4px;">
                                        <h4 id="edit_imageName">Drag and drop a file to upload</h4>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 d-flex flex-column">
                            <input type="hidden" id="Eyewear_ID" name="EyewearID" value="">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <input class="form-control" type="text" id="edit_brand" placeholder="Enter Brand" name="Brand" value="{{ old('Brand') }}">
                                            <label for="edit_brand">Brand</label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <input class="form-control" type="text" id="edit_lens_type" placeholder="Enter Lens Type" name="LensType" value="{{ old('LensType') }}">
                                            <label for="edit_lens_type">Lens Type</label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <input class="form-control" type="text" id="edit_frame_type" placeholder="Enter Frame Type" name="FrameType" value="{{ old('FrameType')}}">
                                            <label for="edit_frame_type">Frame Type</label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <input class="form-control" type="number" id="edit_quantity_available" placeholder="Enter Quantity Available" name="QuantityAvailable" value="{{ old('QuantityAvailable') }}">
                                            <label for="edit_quantity_available">Quantity Available</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <input class="form-control" type="text" id="edit_model" placeholder="Enter Model" name="Model" value="{{ old('Model') }}">
                                            <label for="edit_model">Model</label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <input class="form-control" type="text" id="edit_lens_material" placeholder="Enter Lens Material" name="LensMaterial" value="{{ old('LensMaterial') }}">
                                            <label for="edit_lens_material">Lens Material</label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <input class="form-control" type="text" id="edit_frame_color" placeholder="Enter Frame Color" name="FrameColor" value="{{ old('FrameColor') }}">
                                            <label for="edit_frame_color">Frame Color</label>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="form-floating">
                                            <input class="form-control" type="number" id="edit_price" placeholder="Enter Price" name="Price" value="{{ old('Price') }}">
                                            <label for="edit_price">Price</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-auto d-flex justify-content-end gap-2">
                                <button class="btn btn-lg btn-submit w-100" type="submit">Update Changes</button>
                                <button class="btn btn-lg btn-cancel w-100" type="button" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> 

<style>
    .image-uploads {
        display: flex;
        flex-direction: column;
        align-items: center; 
        border: 1px dashed #ccc; 
        padding: 20px; 
        border-radius: 4px; 
    }
</style>


<script>
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
                            imagePreview.src = "";
                            imageName.textContent = "No image selected";
                        }
                    })
                    .catch(error => console.error('Error fetching Eyewear details:', error));
            });
        });

            document.getElementById("edit_image").addEventListener("change", function () {
            const file = this.files[0];
            const imagePreview = document.getElementById("edit_imagePreview");
            const imageName = document.getElementById("edit_imageName");

                if (file) {
                    imageName.textContent = file.name;
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        imagePreview.src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                } else {
                    imageName.textContent = "No image selected";
                    imagePreview.src = "";
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
</script>

@endsection
