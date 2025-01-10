@extends('template.staff.layout')

@section('content')

<div class="page-wrapper">
    <div class="content" style="overflow-y: auto; height: calc(100vh - 60px);">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Full details of a product</h3>
                    <ul class="breadcrumb">
                        <iconify-icon icon="eva:arrow-back-outline" width="18" height="18"></iconify-icon>
                        <li class="breadcrumb-item">
                            <a href="{{url("staff/eyewears")}}"  data-bs-toggle="tooltip" data-bs-placement="top" title="Back to eyewear list">Eyewear</a>
                        </li>
                        <li class="breadcrumb-item active">Product Details</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8 col-sm-12">
                <div class="card" style="height: 300px;"> 
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
                                <!-- <li>
                                    <h4><strong>Lens Material</strong></h4>
                                    <h6>{{ $eyewear->LensMaterial }}</h6>
                                </li>
                                <li>
                                    <h4><strong>Quantity</strong></h4>
                                    <h6>{{ $eyewear->QuantityAvailable }}</h6>
                                </li> -->
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
                <div class="card" style="height: 300px;"> 
                    <div class="card-body text-center" style="height: 100%;">
                        <div class="slider-product" style="height: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center;">
                        <h4 style="margin-top: 5px;"><strong>{{$eyewear->Brand}}</strong></h4>    
                            <img src="{{ asset('storage/eyewears/' . $eyewear->image) }}" alt="img" style="height: 80%; width: auto; object-fit: contain;">
                            <button class="btn btn-md btn-success w-100 edit-eyewear"  data-id="{{ $eyewear->EyewearID }}" data-bs-toggle="modal" data-bs-target="#editEyewear">
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
            <div class="modal-body" style="padding:30px;">
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
                                    <!-- <div class="mb-3">
                                        <div class="form-floating">
                                            <input class="form-control" type="number" id="edit_quantity_available" placeholder="Enter Quantity Available" name="QuantityAvailable" value="{{ old('QuantityAvailable') }}">
                                            <label for="edit_quantity_available">Quantity Available</label>
                                        </div>
                                    </div> -->
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <input class="form-control" type="text" id="edit_model" placeholder="Enter Model" name="Model" value="{{ old('Model') }}">
                                            <label for="edit_model">Model</label>
                                        </div>
                                    </div>
                                    <!-- <div class="mb-3">
                                        <div class="form-floating">
                                            <input class="form-control" type="text" id="edit_lens_material" placeholder="Enter Lens Material" name="LensMaterial" value="{{ old('LensMaterial') }}">
                                            <label for="edit_lens_material">Lens Material</label>
                                        </div>
                                    </div> -->
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

                            <div class="mt-auto d-flex justify-content-end gap-3">
                                <button class="btn btn-lg btn-submit w-100 me-2" type="submit">Update Changes</button>
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
        <script src="{{ asset('assets/js/staff/eyewear/edit-update.js') }}"></script>
    @endsection

@endsection