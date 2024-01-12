@extends('layouts.auth')
@section('title', 'Register')
@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet"
    href="{{ asset('stisla/library/selectric/public/selectric.css') }}">
@endpush
@section('main')
<div class="card card-primary">
    <div class="card-header">
        <h4>Register</h4>
    </div>
    <div class="card-body">
        <form action="{{route('register')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input id="name"
                    type="text"
                    class="form-control @error('name') is-invalid @enderror"
                    name="name" value="{{old('name')}}">
                @error('name')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror    
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email"
                    type="email"
                    class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{old('email')}}">
                @error('email')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label>Phone</label>
                <input type="text"
                    class="form-control @error('phone') is-invalid @enderror" 
                    name="phone" value="{{old('phone')}}">
                @error('phone')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="row">
                <div class="form-group col-6">
                    <label for="password"
                        class="d-block">Password</label>
                    <input id="password"
                        type="password"
                        class="form-control pwstrength @error('password') is-invalid @enderror" 
                        data-indicator="pwindicator"
                        name="password">
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
                <div class="form-group col-6">
                    <label for="password_confirmation"
                        class="d-block">Repeat Password</label>
                    <input id="password_confirmation"
                        type="password"
                        class="form-control @error('password_confirmation') is-invalid @enderror"
                        name="password_confirmation">
                    @error('password_confirmation')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror    
                </div>
            </div>
            <div class="form-group">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox"
                        name="terms"
                        class="custom-control-input @error('terms') is-invalid @enderror"
                        id="terms">
                    <label class="custom-control-label"
                        for="terms">I agree with the terms and conditions</label>
                </div>
            </div>
            <div class="form-group">
                <button type="submit"
                    class="btn btn-primary btn-lg btn-block">
                Register
                </button>
            </div>
            
        </form>

    </div>
</div>
<div class="text-muted mt-3 text-center">
    <a href="{{route('login')}}">I have registered</a>
</div>
@endsection
@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('stisla/library/selectric/public/jquery.selectric.min.js') }}"></script>
<script src="{{ asset('stisla/library/jquery.pwstrength/jquery.pwstrength.min.js') }}"></script>
<!-- Page Specific JS File -->
<script src="{{ asset('stisla/js/page/auth-register.js') }}"></script>
@endpush