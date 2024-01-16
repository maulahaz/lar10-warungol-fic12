@extends('layouts.backend')
<?php $pageTitle = !empty($dtCategory) ? 'Edit Category' : 'Add Category' ?>
@section('title', $pageTitle)
@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet" href="{{ asset('stisla/library/bootstrap-daterangepicker/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ asset('stisla/library/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('stisla/library/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('stisla/library/selectric/public/selectric.css') }}">
<link rel="stylesheet" href="{{ asset('stisla/library/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('stisla/library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
@endpush
@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Category Forms</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Category</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    @include('layouts.alert')
                </div>
            </div>
            <div class="card">
                @if (!empty($dtCategory))
                <form action="{{ route('category.update', $dtCategory) }}" method="POST" id="frm_update" enctype="multipart/form-data">
                    @method('PUT')
                    @else
                <form action="{{ route('category.store') }}" method="POST" id="frm_create" enctype="multipart/form-data">
                    @endif
                    @csrf
                    <div class="card-header">
                        <h4>{{$pageTitle}}</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text"
                                class="form-control @error('name')
                                is-invalid
                                @enderror"
                                name="name" value="{{ !empty($dtCategory) ? $dtCategory->name : old('name') }}">
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <input type="text"
                                class="form-control @error('description')
                                is-invalid
                                @enderror"
                                name="description" value="{{ !empty($dtCategory) ? $dtCategory->description : old('description') }}">
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Picture</label>
                            <input type="file" name="picture"
                                class="form-control @error('picture')
                                is-invalid
                                @enderror">
                            @error('picture')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            @if(!empty($dtCategory) && $dtCategory->picture)
                            <img src="{{ asset('uploads/product/'.$dtCategory->picture) }}" class="img-fluid border mt-3 p-1" width="200px"/>
                            @else
                            <p>No image found</p>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer text-left">
                        <button class="btn btn-primary"><i class="fa fa-paper-plane"></i> Submit</button>
                        <a href="{{ url('category') }}" class="btn btn-outline-primary"><i class="fas fa-cancel"></i> Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
@push('scripts')
@endpush