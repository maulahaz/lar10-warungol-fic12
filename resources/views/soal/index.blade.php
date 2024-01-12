@extends('layouts.backend')
@section('title', 'Bank Soal')
@push('style')
<!-- CSS Libraries -->
@endpush
@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Bank Soal</h1>
            <div class="section-header-button">
                <a href="{{ route('soal.create') }}" class="btn btn-primary">Add New</a>
            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Bank Soal</div>
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
                            <h4>Bank Soal <?= ($isFiltered) ? ': Data Filtered' : ''?></h4>
                            <div class="card-header-form">
                                <form action="{{ url('soal') }}" method="GET">
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
                                        <th>id</th>
                                        <th>Soal</th>
                                        <th>Opsi A</th>
                                        <th>Opsi B</th>
                                        <th>Opsi C</th>
                                        <th>Opsi D</th>
                                        <th>Action</th>
                                    </tr>
                                    <!--  -->
                                    <?php $no = 1; ?>
                                    @foreach ($soals as $soal)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{ $soal->pertanyaan }}</td>
                                        <td><?= ($soal->jawaban == "a") ? '<i class="fa fa-check-square" style="color:green"></i> '.$soal->opsi_a : $soal->opsi_a ?></td>
                                        <td><?= ($soal->jawaban == "b") ? '<i class="fa fa-check-square" style="color:green"></i> '.$soal->opsi_b : $soal->opsi_b ?></td>
                                        <td><?= ($soal->jawaban == "c") ? '<i class="fa fa-check-square" style="color:green"></i> '.$soal->opsi_c : $soal->opsi_c ?></td>
                                        <td><?= ($soal->jawaban == "d") ? '<i class="fa fa-check-square" style="color:green"></i> '.$soal->opsi_d : $soal->opsi_d ?></td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ route('soal.edit', $soal->id) }}"
                                                    class="btn btn-info btn-icon">
                                                <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="#" data-id="{{$soal->id}}" class="btn btn-danger btn-icon ml-2 swal-confirm">
                                                    <i class="fas fa-times"></i>
                                                    <form action="{{ route('soal.destroy', $soal->id) }}" method="POST" id="delete_data_{{$soal->id}}">
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
                                {{ $soals->withQueryString()->links() }}
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