@extends('layouts.backend')
@section('title', 'Profile')
@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet"
    href="{{ asset('stisla/library/summernote/dist/summernote-bs4.css') }}">
@endpush
@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Profile</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">Profile</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    @include('layouts.alert')
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-12 col-lg-5">
                    <div class="card">
                        <div class="card-header">
                            <h4>Photo Profile</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('/') }}" method="POST" enctype="multipart/form-data" class="text-center">
                                @method('PUT')
                                @csrf
                                <div class="form-group">
                                    <img class="img-fluid img-circle mb-3" src="{{ asset('stisla/img/avatar/avatar-1.png') }}" alt="Image">
                                    <p>Image not available. Please upload!!</p>
                                    <label><strong>Upload Image</strong></label>
                                    <div class="custom-file">
                                        <input type="file" id="foto" name="foto" multiple class="custom-file-input form-control" accept="image/png, image/jpeg, image/jpg">
                                        <label class="custom-file-label" for="foto">Select image...</label>
                                    </div>
                                </div>
                                <button class="btn btn-primary">Upload</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-7">
                    <div class="card">
                        <form action="{{URL('/users/profile/'.Auth::user()->id)}}" method="post"
                            class="needs-validation"
                            novalidate="">
                            @csrf
                            @method('PUT')
                            <div class="card-header">
                                <h4>Data Profile</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6 col-12">
                                        <label>Name</label>
                                        <input type="text"
                                            class="form-control"
                                            name="name"
                                            value="{{ auth()->user()->name }}"
                                            required="">
                                        @error('name')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label>Phone</label>
                                        <input type="tel"
                                            class="form-control"
                                            name="phone"
                                            value="{{ auth()->user()->phone }}">
                                        @error('phone')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror    
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6 col-12">
                                        <label>Email</label>
                                        <input type="email"
                                            class="form-control"
                                            value="{{ auth()->user()->email }}"
                                            readonly>
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label>Roles</label>
                                        <input type="text"
                                            class="form-control"
                                            name="roles"
                                            value="{{ auth()->user()->roles }}"
                                            readonly>
                                        @error('roles')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <a href="{{URL('/users/changepass/'.Auth::user()->id)}}">Change Password</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('stisla/library/summernote/dist/summernote-bs4.js') }}"></script>
<!-- Page Specific JS File -->
@endpush