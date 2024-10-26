@extends('template.ophthal.header')

@section('content') 
    <div class="page-wrapper">
        <div class="content" style="overflow-y: auto; height: calc(100vh - 60px);">
            <div class="row">
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <h2 class="uppercase"><strong>{{ session('name') }}</strong></h2>
                            <p style="font-size: 20px; color: #637381; ">Welcome to your account! Manage your personal information and appointments all in one place</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
