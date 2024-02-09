@extends('layouts.backend')
<?php $pageTitle = !empty($dtOrder) ? 'Edit Order' : 'Add Order' ?>
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
            <h1>Order Forms</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Order</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    @include('layouts.alert')
                </div>
            </div>
            <div class="card">
                @if (!empty($dtOrder))
                <form action="{{ route('order.update', $dtOrder) }}" method="POST" id="frm_update" enctype="multipart/form-data">
                    @method('PUT')
                    @else
                <form action="{{ route('order.store') }}" method="POST" id="frm_create" enctype="multipart/form-data">
                    @endif
                    @csrf
                    <div class="card-header">
                        <h4>{{$pageTitle}}</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Shipment Number(Resi)</label>
                            <input type="text"
                                class="form-control @error('shipping_resi')
                                is-invalid
                                @enderror"
                                name="shipping_resi" value="{{ !empty($dtOrder) ? $dtOrder->shipping_resi : old('shipping_resi') }}">
                            @error('shipping_resi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Status</label>
                            <?php //$optShipmentStatus = [1=>'Yes', 0=>'No']?>
                            <select name="status" id="status" class="form-control  col-sm-4 @error('status')
                                is-invalid
                                @enderror">
                                <option value="" holder>--Please select--</option>
                                @foreach($optShipmentStatus as $key => $value)
                                <option value="<?= $key ?>" @if(!empty($dtOrder) && $dtOrder->status == $key) selected @endif><?= $value ?></option>
                                @endforeach
                            </select>
                            @error('status')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Notes</label>
                            <textarea class="form-control @error('notes')
                                is-invalid
                                @enderror" name="notes" id="notes" rows="3" placeholder="Notes">{{ !empty($dtProduct) ? $dtProduct->notes : old('notes') }}</textarea>
                            @error('notes')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Shipment Proof</label>
                            <input type="file" name="shipping_resi_picture"
                                class="form-control col-sm-4 @error('shipping_resi_picture')
                                is-invalid
                                @enderror">
                            @error('shipping_resi_picture')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            @if(!empty($dtOrder) && $dtOrder->shipping_proof)
                            <img src="{{ asset('uploads/order/'.$dtOrder->shipping_proof) }}" class="img-fluid border mt-3 p-1" width="200px"/>
                            @else
                            <p>No image found</p>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer text-left">
                        <button class="btn btn-primary"><i class="fa fa-paper-plane"></i> Submit</button>
                        <a href="{{ url('order') }}" class="btn btn-outline-primary"><i class="fas fa-cancel"></i> Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
@push('scripts')
@endpush