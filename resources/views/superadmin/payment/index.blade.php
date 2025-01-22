@extends('layouts/superadmin')
@section('container')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Metode Pembayaran</h1>
          </div>
          <div class="col-sm-6">
            <div class="float-sm-right">
              
              <a href="/superadminPayment/create" class="btn btn-primary">Tambah Data<i class="fa fa-plus ml-2" aria-hidden="true"></i></a>
        
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Daftar Metode Pembayaran</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <table id="example1" class="table table-hover">
            <thead>
            <tr>
              <th>Nama Bank</th>
              <th>Nomor Rekening</th>
              <th>Pemilik Rekening</th>
              <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
              @foreach ($payments as $payment)
                <tr>
                  <td>{{ $payment->bank_name }}</td>
                  <td>{{ $payment->account_number }}</td>
                  <td>{{ $payment->account_holder }}</td>
                  <td>
                      <a href="/superadminPayment/edit/{{ $payment->paymentmethod_id }}" class="btn btn-primary btn-sm">Ubah<i class="fa fa-pencil ml-2" aria-hidden="true"></i></a>
                      <a href="/superadminPayment/destroy/{{ $payment->paymentmethod_id }}" class="btn btn-danger btn-sm" data-confirm-delete="true">Hapus<i class="fa fa-trash ml-2" aria-hidden="true"></i></a>
                  </td>
                </tr>
              @endforeach
            </tfoot>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection