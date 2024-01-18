@extends('layouts.backend')
@section('title', 'Product')
@push('style')
<!-- CSS Libraries -->
@endpush
@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Product</h1>
            <div class="section-header-button">
                <a href="{{ route('product.create') }}" class="btn btn-primary">Add New</a>
            </div>
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
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Product <?= ($isFiltered) ? ': Data Filtered' : ''?></h4>
                            <div class="card-header-form">
                                <form action="{{ url('product') }}" method="GET">
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
                                        <th>No.</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Price</th>
                                        <th>Stock</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                    <!--  -->
                                    <?php $no = 1; ?>
                                    @foreach ($dtProducts as $row)
                                    <tr>
                                        <td>{{($dtProducts->currentPage() - 1)  * $dtProducts->perPage() + $loop->iteration}}</td>
                                        <td>{{ $row->name }}</td>
                                        <td>{{ $row->category->name }}</td>
                                        <td>{{ $row->price }}</td>
                                        <td>{{ $row->stock }}</td>
                                        <td>{{ $row->created_at }}</td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ route('product.edit', $row->id) }}"
                                                    class="btn btn-info btn-icon">
                                                <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="#" data-id="{{$row->id}}" class="btn btn-danger btn-icon ml-2 swal-confirm">
                                                    <i class="fas fa-times"></i>
                                                    <form action="{{ route('product.destroy', $row->id) }}" method="POST" id="delete_data_{{$row->id}}">
                                                        <input type="hidden" name="_method" value="DELETE" />
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                                    </form>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </table>
                            </div>
                            <div class="float-right mr-3">
                                {{ $dtProducts->withQueryString()->links() }}
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
<script src="{{ asset('stisla') }}/library/sweetalert/dist/sweetalert.min.js"></script>
@endpush
@push('after-scripts')
<script>
    $(".swal-confirm").click(function(e) {
       var id = e.currentTarget.dataset.id;
       swal({
           title: 'Are you sure?',
           text: 'Once deleted, you will not be able to recover this data!',
           icon: 'warning',
           buttons: true,
           dangerMode: true,
         })
         .then((willDelete) => {
           if (willDelete) {
               swal('Poof!, Data successfully deleted!', {
                 icon: 'success',
               });
               $(`#delete_data_${id}`).submit();
           }
         });
     });
</script>
@endpush