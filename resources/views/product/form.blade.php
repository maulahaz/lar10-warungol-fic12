@extends('layouts.backend')
<?php $pageTitle = !empty($dtProduct) ? 'Edit Product' : 'Add Product' ?>
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
            <h1>Product Forms</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Product</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    @include('layouts.alert')
                </div>
            </div>
            <div class="card">
                @if (!empty($dtProduct))
                <form action="{{ route('product.update', $dtProduct) }}" method="POST" id="frm_update" enctype="multipart/form-data">
                    @method('PUT')
                    @else
                <form action="{{ route('product.store') }}" method="POST" id="frm_create" enctype="multipart/form-data">
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
                                name="name" value="{{ !empty($dtProduct) ? $dtProduct->name : old('name') }}">
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control @error('description')
                                is-invalid
                                @enderror" name="description" id="description" rows="10" placeholder="Description">{{ !empty($dtProduct) ? $dtProduct->description : old('description') }}</textarea>
                            @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Category</label>
                            <?php $optCategId = [1=>'Yes', 0=>'No']?>
                            <select name="category_id" id="category_id" class="form-control @error('category_id')
                                is-invalid
                                @enderror">
                                <option value="" holder>--Please select--</option>
                                @foreach($optCategId as $key => $value)
                                <option value="<?= $key ?>" @if(!empty($dtProduct) && $dtProduct->category_id == $key) selected @endif><?= $value ?></option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="number"
                                class="form-control @error('price')
                                is-invalid
                                @enderror"
                                name="price" value="{{ !empty($dtProduct) ? $dtProduct->price : old('price') }}">
                            @error('price')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Stock</label>
                            <input type="number"
                                class="form-control @error('stock')
                                is-invalid
                                @enderror"
                                name="stock" value="{{ !empty($dtProduct) ? $dtProduct->stock : old('stock') }}">
                            @error('stock')
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
                            @if(!empty($dtProduct) && $dtProduct->picture)
                            <img src="{{ asset('uploads/product/'.$dtProduct->picture) }}" class="img-fluid border mt-3 p-1" width="200px"/>
                            @else
                            <p>No image found</p>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer text-left">
                        <button class="btn btn-primary"><i class="fa fa-paper-plane"></i> Submit</button>
                        <a href="{{ url('product') }}" class="btn btn-outline-primary"><i class="fas fa-cancel"></i> Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
@push('scripts')
@endpush