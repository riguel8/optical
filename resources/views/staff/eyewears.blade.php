@extends('template.staff.header')

@section('content')

<div class="page-wrapper">
    <div class="content">
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
                                <th>Image</th>
                                <th>Brand</th>
                                <th>Model</th>
                                <th>Frame Type</th>
                                <th>Frame Color</th>
                                <th>Lens Type</th>
                                <th>Lens Material</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($eyewears as $eyewear)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <img src="{{ asset('storage/' . $eyewear->image) }}" alt="Eyewear Image" width="50"> <!-- Display Image -->
                                    </td>
                                    <td>{{ $eyewear->Brand }}</td>
                                    <td>{{ $eyewear->Model }}</td>
                                    <td>{{ $eyewear->FrameType ?? 'N/A' }}</td>
                                    <td>{{ $eyewear->FrameColor ?? 'N/A' }}</td>
                                    <td>{{ $eyewear->LensType ?? 'N/A' }}</td>
                                    <td>{{ $eyewear->LensMaterial ?? 'N/A' }}</td>
                                    <td>{{ $eyewear->QuantityAvailable }}</td>
                                    <td>₱{{ number_format($eyewear->Price, 2) }}</td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a class="me-3" href="#"><img src="{{ asset('assets/img/icons/eye.svg') }}" alt="img"></a>
                                            <a class="me-3" href="#"><img src="{{ asset('assets/img/icons/edit.svg') }}" alt="img"></a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center">
                                        <div class="alert alert-info">
                                            No eyewear records found. Please add some eyewear to get started!
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
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
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
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

                    <div class="modal-footer justify-content-end">
                        <button class="btn btn-sm btn-primary" type="submit">Save</button>
                        <button class="btn btn-sm btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
