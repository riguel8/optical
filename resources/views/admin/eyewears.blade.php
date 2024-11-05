@extends('template.admin.layout')

@section('content')

<div class="page-wrapper">
    <div class="content" style="overflow-y: auto; height: calc(100vh - 60px);">
        <div class="page-header">
            <div class="page-title">
                <h4>Eyewear</h4>
                <h6>Eyewear's Lists</h6>
            </div>
            <div class="page-btn">
                <a data-bs-target="#addeyewear" data-bs-toggle="modal" class="btn btn-added">
                    <img src="{{ asset("assets/img/icons/plus.svg") }}" alt="img">Add Product
                </a>
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
                                <th>#</th>
                                <!-- <th>Image</th> -->
                                <th>Brand</th>
                                <th>Model</th>
                                <th>Frame Type</th>
                                <!-- <th>Frame Color</th> -->
                                <th>Lens Type</th>
                                <!-- <th>Lens Material</th> -->
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($eyewears as $eyewear)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <!-- <td>
                                        @if ($eyewear->image)
                                            <img src="{{ asset('storage/eyewears/' . $eyewear->image) }}" class="object-cover rounded" width="40" height="40" />
                                        @else
                                            <span>No Image</span>
                                        @endif
                                    </td> -->
                                    <td>{{ $eyewear->Brand }}</td>
                                    <td>{{ $eyewear->Model }}</td>
                                    <td>{{ $eyewear->FrameType ?? 'N/A' }}</td>
                                    <!-- <td>{{ $eyewear->FrameColor ?? 'N/A' }}</td> -->
                                    <td>{{ $eyewear->LensType ?? 'N/A' }}</td>
                                    <!-- <td>{{ $eyewear->LensMaterial ?? 'N/A' }}</td> -->
                                    <td>{{ $eyewear->QuantityAvailable }}</td>
                                    <td>₱{{ number_format($eyewear->Price, 2) }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a class="me-3" href="{{ route('admin.view-details', $eyewear->EyewearID) }}">
                                                <img src="{{ asset('assets/img/icons/eye.svg') }}" alt="img" data-bs-toggle="tooltip" data-bs-placement="top" title="View Eyewear">
                                            </a>
                                            <a class="me-3" data-id="{{ $eyewear->EyewearID }}" href="#" data-bs-toggle="modal" data-bs-target="#editEyewear">
                                                <img src="{{ asset('assets/img/icons/edit.svg') }}" alt="img" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Eyewear">
                                            </a>
                                            <a class="me-3 btn-delete" data-id="{{ $eyewear->EyewearID }}" href="#" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                                <img src="{{ asset('assets/img/icons/delete.svg') }}" alt="img" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Eyewear">
                                            </a>
                                        </div>
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

<!-- Add Eyewear Modal -->
<div class="modal fade" id="addeyewear" tabindex="-1" aria-labelledby="addeyewearLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addeyewearLabel">New Eyewear</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addEyewearForm" method="POST" action="{{ route('admin.eyewears.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input class="form-control" type="text" id="brand" placeholder="Enter Brand" name="Brand" required>
                                <label for="brand">Brand</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input class="form-control" type="text" id="model" placeholder="Enter Model" name="Model" required>
                                <label for="model">Model</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input class="form-control" type="text" id="frame_type" placeholder="Enter Frame Type" name="FrameType">
                                <label for="frame_type">Frame Type</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input class="form-control" type="text" id="frame_color" placeholder="Enter Frame Color" name="FrameColor">
                                <label for="frame_color">Frame Color</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input class="form-control" type="text" id="lens_type" placeholder="Enter Lens Type" name="LensType">
                                <label for="lens_type">Lens Type</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input class="form-control" type="text" id="lens_material" placeholder="Enter Lens Material" name="LensMaterial">
                                <label for="lens_material">Lens Material</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input class="form-control" type="number" id="quantity_available" placeholder="Enter Quantity Available" name="QuantityAvailable" required>
                                <label for="quantity_available">Quantity Available</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input class="form-control" type="number" id="price" placeholder="Enter Price" name="Price" required>
                                <label for="price">Price</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-5">
                            <div class="form-group">
                                <label>Eyewear Image</label>
                                <div class="image-upload">
                                    <input id="image" name="image" type="file" accept="image/*">
                                    <div class="image-uploads">
                                        <img src="{{ asset('assets/img/icons/upload.svg') }}" alt="Upload" id="imagePreview"
                                            style="max-width: 100%; height: auto; object-fit: contain; border-radius: 4px;">
                                        <h4 id="imageName">Drag and drop a file to upload</h4>
                                    </div>
                                </div>
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

    #imagePreview {
        max-width: 150px; 
        max-height: 100px; 
        margin-bottom: 10px; 
    }
</style>


@section('scripts')

    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.bootstrap5.min.js') }}"></script>


    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const editButtons = document.querySelectorAll('.edit-eyewear');
        const editForm = document.querySelector('#editEyewear form');

        editButtons.forEach(button => {
            button.addEventListener('click', function () {
                const EyewearID = this.getAttribute('data-id');
                document.getElementById('eyewear_id').value = ID;

                // Set the form action dynamically
                editForm.action = `/admin/eyewears/update/${EyewearID}`;

                // Fetch the eyewear details and populate the form
                fetch(`/admin/eyewears/edit/${EyewearID}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('brand').value = data.eyewears.Brand;
                        document.getElementById('model').value = data.eyewears.Model;
                        document.getElementById('frame_type').value = data.eyewears.FrameType;
                        document.getElementById('frame_clor').value = data.eyewears.FrameColor;
                        document.getElementById('lens_type').value = data.eyewears.LensType;
                        document.getElementById('lens_material').value = data.eyewear.LensMaterial;
                        document.getElementById('quantity_available').value = data.eyewear.QuantityAvailable;
                        document.getElementById('price').value = data.eyewear.Price;
                    })
                    .catch(error => console.error('Error fetching eyewear details:', error));
            });
        });

        editForm.addEventListener('submit', function (e) {
            e.preventDefault();
            const formData = new FormData(this);

            fetch(editForm.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'X-HTTP-Method-Override': 'PUT'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.success);
                    // Optionally, close modal and refresh page
                } else {
                    alert(data.error || 'Error updating eyewear');
                }
            })
            .catch(error => console.error('Error updating eyewear:', error));
        });
    });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const imageInput = document.getElementById('image');
            const imgElement = document.getElementById('imagePreview');
            const imageNameElement = document.getElementById('imageName');

            imageInput.onchange = function(e) {
                const file = e.target.files[0]; 

                if (file) {
                    const reader = new FileReader();
                    
                    reader.onload = function(event) {
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
    
        const addEyewearModal = document.getElementById('addeyewear');
        addEyewearModal.addEventListener('hidden.bs.modal', function () {
            document.getElementById('addEyewearForm').reset(); 
            document.getElementById('imagePreview').src = "{{ asset('assets/img/icons/upload.svg') }}"; 
            document.getElementById('imageName').textContent = 'Drag and drop a file to upload'; 
        });

        // ADD SUCCESSFUL MODAL
    document.getElementById('addEyewearForm').onsubmit = function (event) {
        event.preventDefault();
        const formData = new FormData(this);

        fetch('{{ route("admin.eyewears.store") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
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
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An unexpected error occurred. Please try again.',
            });
        });
    };

        // DELETE MODAL
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.btn-delete');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault(); 
                const id = this.getAttribute('data-id'); 

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You won\'t be able to revert this!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ff9f43',
                    cancelButtonColor: '#dc3545',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/admin/eyewears/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}', 
                                'Accept': 'application/json',
                            },
                        })
                        .then(response => {
                            if (response.ok) {
                                Swal.fire(
                                    'Deleted!',
                                    'Eyewear has been deleted.',
                                    'success',
                                ).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire(
                                    'Error!',
                                    'There was a problem deleting the eyewear.',
                                    'error'
                                );
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                    }
                });
            });
        });
    });

    </script>

    <script>
        $(document).ready(function() {
            $('#editEyewearForm').on('submit', function(event) {
                event.preventDefault();

                const formData = new FormData(this); 

                $.ajax({
                    url: $(this).attr('action'), 
                    type: 'POST', 
                    data: formData, 
                    contentType: false, 
                    processData: false, 
                    success: function(response) {
                        if (response.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: response.message,
                                confirmButtonText: 'OK'
                            }).then(() => {
                                location.reload(); 
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: response.message,
                            });
                        }
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Something went wrong. Please try again.',
                        });
                    }
                });
            });
        });
    </script>



@endsection
@endsection
