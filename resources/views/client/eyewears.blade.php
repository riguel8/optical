@include('template.client.header')

@include('template.client.navbar')
@include('template.client.sidebar')

<div class="page-wrapper">
    <div class="content" style="overflow-y: auto; height: calc(100vh - 60px);">
        <div class="row">
            <div class="col-lg-3 col-md-4">
                <!-- Filter Sidebar -->
                <div class="filter-sidebar">
                    <p>Filters</p>
                    <hr class="m-0 mb-2">

                    <form method="GET" action="{{ route('client.eyewears') }}">
                        <!-- Brand Filter -->
                        <div class="filter-group mb-2">
                            <p style="text-transform:uppercase; cursor: pointer;" class="filter-toggle d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#brandFilter" aria-expanded="false" aria-controls="brandFilter">
                                <strong>Brand</strong>
                                <span class="toggle-symbol">+</span>
                            </p>
                            <div class="collapse" id="brandFilter">
                                @foreach($brands as $brand)
                                    <a href="{{ route('client.eyewears', ['brand' => $brand->Brand]) }}" class="filter-link">
                                        <p style="margin: 0;">
                                            {{ $brand->Brand }}
                                        </p>
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        <!-- Frame Type Filter -->
                        <hr class="m-0 mb-2">
                        <div class="filter-group mb-2">
                            <p style="text-transform:uppercase; cursor: pointer;" class="filter-toggle d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#frameTypeFilter" aria-expanded="false" aria-controls="frameTypeFilter">
                                <strong>Frame Type</strong>
                                <span class="toggle-symbol">+</span>
                            </p>
                            <div class="collapse" id="frameTypeFilter">
                                @foreach($frameTypes as $frameType)
                                    <a href="{{ route('client.eyewears', ['frame_type' => $frameType->FrameType]) }}" class="filter-link">
                                        <p style="margin: 0;">
                                            {{ $frameType->FrameType }}
                                        </p>
                                    </a>
                                @endforeach
                            </div>
                        </div>


                        <!-- Frame Color Filter -->
                        <hr class="m-0 mb-2">
                        <div class="filter-group  mb-2">
                            <p style="text-transform:uppercase; cursor: pointer;" class="filter-toggle d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#frameColorFilter" aria-expanded="false" aria-controls="frameColorFilter">
                                <strong>Frame Color</strong>
                                <span class="toggle-symbol">+</span>
                            </p>
                            <div class="collapse" id="frameColorFilter">
                                @foreach($frameColors as $frameColor)
                                    <a href="{{ route('client.eyewears', ['frame_color' => $frameColor->FrameColor]) }}" class="filter-link">
                                        <p style="margin: 0;">{{ $frameColor->FrameColor }}</p>
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        <!-- Lens Material Filter -->
                        <hr class="m-0 mb-2">
                        <div class="filter-group  mb-2">
                            <p style="text-transform:uppercase; cursor: pointer;" class="filter-toggle d-flex justify-content-between align-items-center" data-toggle="collapse" data-target="#lensMaterialFilter" aria-expanded="false" aria-controls="lensMaterialFilter">
                                <strong>Lens Material</strong>
                                <span class="toggle-symbol">+</span>
                            </p>
                            <div class="collapse" id="lensMaterialFilter">
                                @foreach($lensMaterials as $lensMaterial)
                                    <a href="{{ route('client.eyewears', ['lens_material' => $lensMaterial->LensMaterial]) }}" class="filter-link">
                                        <p style="margin: 0;">{{ $lensMaterial->LensMaterial }}</p>
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <a href="{{ route('client.eyewears') }}" class="btn btn-outline-primary btn-sm mt-3">Reset Filters</a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-9 col-md-8">
                <div class="row">
                    <div class="col-sm-12">
                        <h2 style="text-transform:uppercase">Eyewear</h2>
                        <p style="font-size: 20px; color: #637381;">Available glasses you can customize based on what you need</p>
                    </div>
                </div>

                <!-- Eyewear Product Listing Section -->
                <div class="row eyewear-products mt-3">
                    @if($eyewearProducts->isEmpty())
                        <div class="col-12">
                            <p>No products found.</p>
                        </div>
                    @else
                        @foreach($eyewearProducts as $product)
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="productset flex-fill text-center">
                                <div class="productsetimg">
                                    <img src="{{ asset('storage/eyewears/' . $product->image) }}" alt="Eyewear" class="img-fluid">
                                </div>
                                <div class="productsetcontent">
                                    <h4>{{ $product->Brand }}&nbsp;{{ $product->Model }}</h4>
                                    <h6>₱{{ number_format($product->Price, 2) }}</h6>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@include('template.client.footer')
