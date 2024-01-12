@extends('layouts.backend')
<?php $pageTitle = !empty($soal) ? 'Edit Soal' : 'Add Soal' ?>
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
            <h1>Soal Forms</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Soal</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    @include('layouts.alert')
                </div>
            </div>
            <div class="card">
                @if (!empty($soal))
                <form action="{{ route('soal.update', $soal) }}" method="POST" id="frm_update" >
                    @method('PUT')
                    @else
                <form action="{{ route('soal.store') }}" method="POST" id="frm_create">
                    @endif
                    @csrf
                    <div class="card-header">
                        <h4>{{$pageTitle}}</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Pertanyaan</label>
                            <input type="text"
                                class="form-control @error('pertanyaan')
                                is-invalid
                                @enderror"
                                name="pertanyaan" value="{{ !empty($soal) ? $soal->pertanyaan : old('pertanyaan') }}">
                            @error('pertanyaan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Kategori</label>
                            <div class="selectgroup w-100">
                                <label class="selectgroup-item">
                                <input type="radio" name="kategori" value="Numeric" class="selectgroup-input"
                                    checked="">
                                <span class="selectgroup-button">Numerik</span>
                                </label>
                                <label class="selectgroup-item">
                                <input type="radio" name="kategori" value="Verbal" class="selectgroup-input">
                                <span class="selectgroup-button">Verbal</span>
                                </label>
                                <label class="selectgroup-item">
                                <input type="radio" name="kategori" value="Logika" class="selectgroup-input">
                                <span class="selectgroup-button">Logika</span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Opsi A</label>
                            <input type="text"
                                class="form-control @error('opsi_a')
                                is-invalid
                                @enderror"
                                name="opsi_a" value="{{ !empty($soal) ? $soal->opsi_a : old('opsi_a') }}">
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Opsi B</label>
                            <input type="text"
                                class="form-control @error('opsi_b')
                                is-invalid
                                @enderror"
                                name="opsi_b" value="{{ !empty($soal) ? $soal->opsi_b : old('opsi_b') }}">
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Opsi C</label>
                            <input type="text"
                                class="form-control @error('opsi_c')
                                is-invalid
                                @enderror"
                                name="opsi_c" value="{{ !empty($soal) ? $soal->opsi_c : old('opsi_c') }}">
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Opsi D</label>
                            <input type="text"
                                class="form-control @error('opsi_d')
                                is-invalid
                                @enderror"
                                name="opsi_d" value="{{ !empty($soal) ? $soal->opsi_d : old('opsi_d') }}">
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Jawaban</label>
                            <div class="selectgroup w-100">
                                <label class="selectgroup-item">
                                <input type="radio" name="jawaban" value="a" class="selectgroup-input"
                                    checked="">
                                <span class="selectgroup-button">A</span>
                                </label>
                                <label class="selectgroup-item">
                                <input type="radio" name="jawaban" value="b" class="selectgroup-input">
                                <span class="selectgroup-button">B</span>
                                </label>
                                <label class="selectgroup-item">
                                <input type="radio" name="jawaban" value="c" class="selectgroup-input">
                                <span class="selectgroup-button">C</span>
                                </label>
                                <label class="selectgroup-item">
                                <input type="radio" name="jawaban" value="d" class="selectgroup-input">
                                <span class="selectgroup-button">D</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-left">
                        <button class="btn btn-primary"><i class="fa fa-paper-plane"></i> Submit</button>
                        <a href="{{ url('soal') }}" class="btn btn-outline-primary"><i class="fas fa-cancel"></i> Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
@push('scripts')
@endpush