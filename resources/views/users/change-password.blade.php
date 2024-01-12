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
            <div class="card card-primary">
                <div class="card-header">
                    <h4>Change Password</h4>
                </div>
                <div class="card-body">
                    <form action="{{URL('/users/changepass/'.Auth::user()->id)}}" method="POST">
                        @csrf
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="password">Current Password</label>
                                <input id="password"
                                    type="password"
                                    class="form-control pwstrength"
                                    data-indicator="pwindicator"
                                    name="current_password"
                                    tabindex="2"
                                    required>
                                <div id="pwindicator"
                                    class="pwindicator">
                                    <div class="bar"></div>
                                    <div class="label"></div>
                                </div>
                                @error('current_password')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror 
                            </div>
                            <div class="form-group">
                                <label for="new_password">New Password</label>
                                <input id="new_password"
                                    type="password"
                                    class="form-control pwstrength"
                                    data-indicator="pwindicator"
                                    name="password"
                                    tabindex="2"
                                    required>
                                @error('password')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror    
                                <div id="pwindicator"
                                    class="pwindicator">
                                    <div class="bar"></div>
                                    <div class="label"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">Confirm Password</label>
                                <input id="password_confirmation"
                                    type="password"
                                    class="form-control"
                                    name="password_confirmation"
                                    tabindex="2"
                                    required>
                                @error('password_confirmation')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror    
                            </div>
                            <div class="form-group">
                                <button type="submit"
                                    class="btn btn-primary"
                                    tabindex="4">
                                <i class="fas fa-save"></i> Save Changes
                                </button>
                                <a href="{{URL('/users/'.Auth::user()->id)}}" class="btn btn-outline-primary"><i class="fas fa-cancel"></i> Cancel</a>
                            </div>
                        </div>
                    </form>
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