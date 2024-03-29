@extends('layouts.backend')
@section('title', 'Order')
@push('style')
<!-- CSS Libraries -->
@endpush
@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Order</h1>
            <div class="section-header-button">
                {{-- <a href="{{ route('order.create') }}" class="btn btn-primary">Add New</a> --}}
            </div>
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
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Order <?= ($isFiltered) ? ': Data Filtered' : ''?></h4>
                            <div class="card-header-form">
                                <form action="{{ url('order') }}" method="GET">
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
                                        <th>Trans. Date</th>
                                        <th>Customer</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Shipping Name</th>
                                        <th>Action</th>
                                    </tr>
                                    <!--  -->
                                    <?php $no = 1; ?>
                                    @foreach ($dtOrders as $row)
                                    <tr>
                                        <td>{{($dtOrders->currentPage() - 1)  * $dtOrders->perPage() + $loop->iteration}}</td>
                                        <td>{{ $row->created_at }}</td>
                                        <td>{{ $row->user->name }}</td>
                                        <td>{{ $row->total_cost }}</td>
                                        <td>{{ $row->status }}</td>
                                        <td>{{ $row->shipping_service }}</td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ route('order.edit', $row->id) }}"
                                                    class="btn btn-info btn-icon" data-toggle="tooltip" data-placement="top" title data-original-title="Update Shipment">
                                                <i class="fas fa-truck-fast"></i>
                                                </a>
                                                <a href="#" data-id="{{$row->id}}" class="btn btn-danger btn-icon ml-2 swal-confirm">
                                                    <i class="fas fa-times"></i>
                                                    <form action="{{ route('order.destroy', $row->id) }}" method="POST" id="delete_data_{{$row->id}}">
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
                                {{ $dtOrders->withQueryString()->links() }}
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