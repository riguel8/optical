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

        <section class="comp-section comp-cards">
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
                        </ul>
                    </div>
                </div>
            <div class="row">
                @foreach ($eyewears as $eyewear)
                <div class="col-12 col-sm-6 col-lg-3 d-flex">
                    <div class="card flex-fill bg-white">
                        @if ($eyewear->image)
                            <img alt="Card Image" 
                                src="{{ asset('storage/eyewears/' . $eyewear->image) }}" 
                                class="card-img-top img-fluid d-block w-100" 
                                style="height: 150px; object-fit: cover;">
                        @else
                            <div class="d-flex justify-content-center align-items-center" 
                                style="height: 200px; background-color: #f8f9fa;">
                                <span class="text-muted">No Image</span>
                            </div>
                        @endif
                        <div class="card-header text-center">
                            <h5 class="card-title mb-0">{{ $eyewear->Brand }}</h5>
                        </div>
                        <div class="card-body text-center">
                            <p class="card-text" style="height: 40px; overflow: hidden;">{{ $eyewear->Model }}</p>
                            <p class="card-text text-danger" style="height: 30px;">₱{{ number_format($eyewear->Price, 2) }}</p>

                            <div class="d-flex justify-content-center">
                            <a class="me-3" href="{{ route('admin.view-details', $eyewear->EyewearID) }}">
                                            <img src="{{ asset('assets/img/icons/eye.svg') }}" alt="img" data-bs-toggle="tooltip" data-bs-placement="top" title="View Eyewear">
                                        </a>
                                        <a class="me-3 edit-eyewear" data-id="{{ $eyewear->EyewearID }}" href="#" data-bs-toggle="modal" data-bs-target="#editEyewear">
                                            <img src="{{ asset('assets/img/icons/edit.svg') }}" alt="img" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Eyewear">
                                        </a>
                                        <a class="btn-delete" data-id="{{ $eyewear->EyewearID }}" href="#" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                            <img src="{{ asset('assets/img/icons/delete.svg') }}" alt="img" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Eyewear">
                                        </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        <!-- <section class="comp-section comp-cards">
            <div class="row">
                @foreach ($eyewears as $eyewear)
                <div class="col-12 col-sm-6 col-lg-4 d-flex">
                    <div class="card flex-fill bg-white">
                        @if ($eyewear->image)
                            <img alt="Card Image" src="{{ asset('storage/eyewears/' . $eyewear->image) }}" 
                                class="card-img-top img-fluid d-block w-100" 
                                style="max-width: 100%; max-height: 150px; height: auto; object-fit: cover;">
                        @else
                            <span class="d-block text-center py-3">No Image</span>
                        @endif
                        <div class="card-header text-center">
                            <h5 class="card-title mb-0">{{ $eyewear->Brand }}</h5>
                        </div>
                        <div class="card-body text-center">
                            <p class="card-text">{{ $eyewear->Model }}</p>
                            <p class="card-text text-danger">₱{{ number_format($eyewear->Price, 2) }}</p>
                            <div class="d-flex justify-content-between">
                                <a class="btn btn-sm btn-outline-info flex-fill mx-1" href="{{ route('admin.view-details', $eyewear->EyewearID) }}">View</a>
                                <a class="btn btn-sm btn-outline-success flex-fill mx-1 edit-eyewear" data-id="{{ $eyewear->EyewearID }}" href="#" data-bs-toggle="modal" data-bs-target="#editEyewear">Edit</a>
                                <a class="btn btn-sm btn-outline-danger flex-fill mx-1 btn-delete" data-id="{{ $eyewear->EyewearID }}" 
                                href="#" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section> -->

        <!-- <div class="card">
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
                                <th>Image</th>
                                <th>Brand</th>
                                <th>Model</th>
                                <th>Frame Type</th>
                                <th>Lens Type</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($eyewears as $eyewear)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if ($eyewear->image)
                                            <img src="{{ asset('storage/eyewears/' . $eyewear->image) }}" class="object-cover rounded" width="40" height="40" />
                                        @else
                                            <span>No Image</span>
                                        @endif
                                    </td>
                                    <td>{{ $eyewear->Brand }}</td>
                                    <td>{{ $eyewear->Model }}</td>
                                    <td>{{ $eyewear->FrameType ?? 'N/A' }}</td>
                                    <td>{{ $eyewear->LensType ?? 'N/A' }}</td>
                                    <td>{{ $eyewear->QuantityAvailable }}</td>
                                    <td>₱{{ number_format($eyewear->Price, 2) }}</td>
                                    <td>
                                        <a class="me-3" href="{{ route('admin.view-details', $eyewear->EyewearID) }}">
                                            <img src="{{ asset('assets/img/icons/eye.svg') }}" alt="img" data-bs-toggle="tooltip" data-bs-placement="top" title="View Eyewear">
                                        </a>
                                        <a class="me-3 edit-eyewear" data-id="{{ $eyewear->EyewearID }}" href="#" data-bs-toggle="modal" data-bs-target="#editEyewear">
                                            <img src="{{ asset('assets/img/icons/edit.svg') }}" alt="img" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Eyewear">
                                        </a>
                                        <a class="me-3 btn-delete" data-id="{{ $eyewear->EyewearID }}" href="#" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                            <img src="{{ asset('assets/img/icons/delete.svg') }}" alt="img" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Eyewear">
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div> -->

<!-- Add Eyewear Modal -->
<div class="modal fade" id="addeyewear" tabindex="-1" aria-labelledby="addeyewearLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
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
                    <div class="row d-flex align-items-stretch">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label>Eyewear Image</label>
                                <div class="image-upload" onclick="document.getElementById('image').click()">
                                    <input id="image" name="image" type="file" accept="image/*" onchange="previewImage(event)">
                                    <div class="image-uploads" id="imagePreviewContainer">
                                        <img src="{{ asset('assets/img/icons/upload.svg') }}" alt="Upload" id="imagePreview"
                                            style="max-width: 100%; height: 200px; object-fit: contain; border-radius: 4px;">
                                        <p id="imageName">Drag and drop a file to upload or click to select</p>
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
                                            <input class="form-control" type="text" id="brand" placeholder="Enter Brand" name="Brand" required>
                                            <label for="brand">Brand</label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <input class="form-control" type="text" id="lens_type" placeholder="Enter Lens Type" name="LensType">
                                            <label for="lens_type">Lens Type</label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <input class="form-control" type="text" id="frame_type" placeholder="Enter Frame Type" name="FrameType">
                                            <label for="frame_type">Frame Type</label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <input class="form-control" type="number" id="quantity_available" placeholder="Enter Quantity Available" name="QuantityAvailable" required>
                                            <label for="quantity_available">Quantity Available</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <input class="form-control" type="text" id="model" placeholder="Enter Model" name="Model" required>
                                            <label for="model">Model</label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <input class="form-control" type="text" id="lens_material" placeholder="Enter Lens Material" name="LensMaterial">
                                            <label for="lens_material">Lens Material</label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <input class="form-control" type="text" id="frame_color" placeholder="Enter Frame Color" name="FrameColor">
                                            <label for="frame_color">Frame Color</label>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="form-floating">
                                            <input class="form-control" type="number" id="price" placeholder="Enter Price" name="Price" required>
                                            <label for="price">Price</label>
                                        </div>
                                    </div>
                                </div>   
                            </div>   

                            <div class="mt-auto d-flex justify-content-end gap-3">
                                <button class="btn btn-lg btn-submit w-100 me-2" type="submit">Save</button>
                                <button class="btn btn-lg btn-cancel w-100" type="button" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </div> 
                    </div>
                </form>
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
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label>Eyewear Image</label>
                                <div class="image-upload" onclick="document.getElementById('edit_image').click()">
                                    <input id="edit_image" name="image" type="file" accept="image/*">
                                    <div class="image-uploads" id="imagePreviewContainer">
                                        <img src="{{ asset('assets/img/icons/upload.svg') }}" alt="Upload" id="edit_imagePreview"
                                            style="max-width: 100%; height: 200px; object-fit: contain; border-radius: 4px;">
                                        <p id="edit_imageName">Drag and drop a file to upload or click to select</p>
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


    @section('scripts')
        <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>    
        <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/js/dataTables.bootstrap5.min.js') }}"></script>

        <script src="{{ asset('assets/js/admin/eyewear/add-preview.js') }}"></script>
        <script src="{{ asset('assets/js/admin/eyewear/edit-update.js') }}"></script>
        <script>
            window.storeEyewearRoute = "{{ route('admin.eyewears.store') }}";
            window.uploadIconUrl = "{{ asset('assets/img/icons/upload.svg') }}";
        </script>
        <!-- <script src="{{ asset('assets/js/admin/eyewear/delete.js') }}"></script> -->
        <script>
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
    @endsection
@endsection
