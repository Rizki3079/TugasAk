@extends('layouts.dashboardAdmin')
@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Pembeli</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Pembeli</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    {{-- <h3 class="card-title">Bordered Table</h3> --}}
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <button class="btn btn-md btn-primary"></button>
                    <table class="table table-bordered">
                      <thead>
                          <tr>
                              <th style="width: 10px">No</th>
                              <th>Nama Pembeli</th>
                              <th>Tanggal Kunjungan</th>
                              <th>Jumlah Tiket</th>
                              <th>Kode Promo</th>
                              <th>Total Harga</th>
                              <th>Status</th>
                              <th>Aksi</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($tickets as $index => $data)
                          <tr>
                              <td>{{ $index + 1 }}</td>
                              <td>{{ $data->user->name ?? 'Tidak Diketahui' }}</td>
                              <td>{{ $data->visit_date }}</td>
                              <td>{{ $data->ticket_count }}</td>
                              <td>{{ $data->promo_code }}</td>
                              <td>{{ $data->total_price }}</td>
                              <td>{{ $data->status }}</td>
                              <td>
                                  <div class="btn-list">
                                      <a href="#" class="btn btn-md btn-warning"><i class="fa fa-edit"></i></a>
                                      <a href="#" class="btn btn-md btn-danger btn-delete"><i class="fa fa-trash"></i></a>
                                  </div>
                              </td>
                          </tr>
                          @endforeach
                      </tbody>
                  </table>
                  
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-right">
                      <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                      <li class="page-item"><a class="page-link" href="#">1</a></li>
                      <li class="page-item"><a class="page-link" href="#">2</a></li>
                      <li class="page-item"><a class="page-link" href="#">3</a></li>
                      <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                    </ul>
                  </div>
                </div>
    </section>
    <!-- /.content -->
@endsection