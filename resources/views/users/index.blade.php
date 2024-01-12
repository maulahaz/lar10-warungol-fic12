@extends('layouts.backend')
@section('title', 'User List')
@push('style')
<!-- CSS Libraries -->
@endpush
@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>User List</h1>
            <div class="section-header-button">
                <a href="{{ route('users.create') }}" class="btn btn-primary">Add New</a>
            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item">User List</div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    @include('layouts.alert')
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>User List <?= ($isFiltered) ? ': Data Filtered' : ''?></h4>
                            <div class="card-header-form">
                                <form action="{{ url('users') }}" method="GET">
                                    <div class="input-group">
                                        <input type="text"
                                            class="form-control"
                                            name="search"
                                            placeholder="Search">
                                        <div class="input-group-btn">
                                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table-striped table">
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                    @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->created_at }}</td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ route('users.edit', $user->id) }}"
                                                    class="btn btn-info btn-icon">
                                                <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                    class="ml-2">
                                                    <input type="hidden" name="_method" value="DELETE" />
                                                    <input type="hidden" name="_token"
                                                        value="{{ csrf_token() }}" />
                                                    <button class="btn btn-danger btn-icon confirm-delete">
                                                    <i class="fas fa-times"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                            <div class="float-right mr-3">
                                {{ $users->withQueryString()->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('stisla/library/jquery-ui-dist/jquery-ui.min.js') }}"></script>
<!-- Page Specific JS File -->
<script src="{{ asset('stisla/js/page/components-table.js') }}"></script>
@endpush