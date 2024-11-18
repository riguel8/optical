@extends('template.admin.layout')

@section('content')
<div class="page-wrapper">
    <div class="content" style="overflow-y: auto; height: calc(100vh - 60px);">
        <!-- Header and Breadcrumbs -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">System Information</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Settings</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') 

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
								<label><strong>Carousel Image (Section)</strong></label>
								<div class="image-upload">
									<input type="file">
								    <div class="image-uploads">
										<img src="{{ asset('assets/img/icons/upload.svg') }}" alt="img">
										<h4>Drag and drop a file to upload</h4>
								    </div>
								</div>
							</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label><strong>About (Section)</strong></label>
                                <textarea id="summernote" name="about" class="form-control">{{ $systemInfo->about ?? '' }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
								<label>Images</label>
								<div class="image-upload">
									<input type="file">
								    <div class="image-uploads">
										<img src="{{ asset('assets/img/icons/upload.svg') }}" alt="img">
										<h4>Drag and drop a file to upload</h4>
								    </div>
								</div>
							</div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                                <label class="mb-2"><strong>Services (Section)</strong></label>
                                <div class="form-floating mb-2">
                                    <input class="form-control" type="text" placeholder="Service Name" name="service_name" required>
                                    <label>Service Name</label>
                                </div>
                                <div class="form-floating mb-5">
                                    <textarea class="form-control" placeholder="Leave a description here" id="floatingTextarea2" style="height: 100px"></textarea>
                                    <label for="floatingTextarea2">Description</label>
                                </div>
                        </div>
                    </div>

                    <div class="row">
                            <label class="mb-2"><strong>Ophthalmologists (Section)</strong></label>
                            <div class="col-lg-4 col-sm-12 col-12">
                                        <div class="form-group">
                                            <div class="image-upload image-upload-new">
                                                <input type="file">
                                                <div class="image-uploads">
                                                    <img src="{{asset("assets/img/icons/upload.svg")}}" alt="img">
                                                    <h4>Drag and drop a file to upload</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8 col-sm-12 col-12">
                                        <div class="form-floating mb-2">
                                            <input class="form-control" type="text" placeholder="Service Name" name="service_name" required>
                                            <label>Ophthalmologists Name</label>
                                        </div>
                                        <div class="form-floating mb-2">
                                            <textarea class="form-control" placeholder="Leave a description here" id="floatingTextarea2" style="height: 100px"></textarea>
                                            <label for="floatingTextarea2">Description</label>
                                        </div>
                                    </div>
                                    
                                </div>

                    <!-- Submit Button -->
                    <div class="text-right mt-4">
                        <button type="submit" class="btn btn-primary">Update System Information</button>
                    </div>
                </form>
                <!-- Form End -->
            </div>
        </div>
    </div>
</div>

    @section('scripts')
    <script src="{{ asset('assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
    @endsection
@endsection
