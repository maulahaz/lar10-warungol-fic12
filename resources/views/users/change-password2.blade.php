@extends('layouts.backend')
@section('title', 'Profile')
@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet"
    href="{{ asset('stisla/library/summernote/dist/summernote-bs4.css') }}">
<link rel="stylesheet"
    href="{{ asset('stisla/library/bootstrap-social/assets/css/bootstrap.css') }}">
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
            <div class="card card-primary">
    <div class="card-header">
        <h4>Change Password</h4>
    </div>
    <div class="card-body">
        <p class="text-muted">We will send a link to reset your password</p>
        <form method="POST">
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email"
                    type="email"
                    class="form-control"
                    name="email"
                    tabindex="1"
                    required
                    autofocus>
            </div>
            <div class="form-group">
                <label for="password">New Password</label>
                <input id="password"
                    type="password"
                    class="form-control pwstrength"
                    data-indicator="pwindicator"
                    name="password"
                    tabindex="2"
                    required>
                <div id="pwindicator"
                    class="pwindicator">
                    <div class="bar"></div>
                    <div class="label"></div>
                </div>
            </div>
            <div class="form-group">
                <label for="password-confirm">Confirm Password</label>
                <input id="password-confirm"
                    type="password"
                    class="form-control"
                    name="confirm-password"
                    tabindex="2"
                    required>
            </div>
            <div class="form-group">
                <button type="submit"
                    class="btn btn-primary btn-lg btn-block"
                    tabindex="4">
                Reset Password
                </button>
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