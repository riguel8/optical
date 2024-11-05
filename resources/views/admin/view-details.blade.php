@extends('template.admin.header')

@section('content')

<div class="page-wrapper">
    <div class="content" style="overflow-y: auto; height: calc(100vh - 60px);">
        <div class="page-header">
            <div class="page-title">
                <h4>Product Details</h4>
                <h6>Full details of a product</h6>
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
                                    <img src="{{ asset('storage/eyewears/' . $eyewear->image) }}" alt="img" style="height: 80%; width: auto; object-fit: contain;"> <!-- Set image to 80% of the card height -->
                                    <h4 style="margin-top: 10px;"><strong>{{$eyewear->Brand}}</strong></h4>
                                </div>
                    
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
