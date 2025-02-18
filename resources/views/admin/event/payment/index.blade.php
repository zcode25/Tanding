@extends('layouts/adminEvent')
@section('container')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pembayaran</h1>
          </div>
          <div class="col-sm-6">
            <div class="float-sm-right">
              
              {{-- <a href="/superadminEvent/create" class="btn btn-primary">Create New</a> --}}
        
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
          <h3 class="card-title">Daftar Pembayaran</h3>

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
              <th>Tanggal Pembayaran</th>
              <th>Nama Official</th>
              <th>Kontingen</th>
              <th>Metode Pembayaran</th>
              <th>Biaya Perndafataran</th>
              {{-- <th>Bukti Transfer</th> --}}
              <th>Status</th>
              <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
              @foreach ($payments as $payment)
                  <tr>
                    <td>{{ $payment->created_at }}</td>
                    <td>{{ $payment->contingent->user->name }}</td>
                    <td>{{ $payment->contingent->contingent_name }}</td>
                    <td>{{ $payment->paymentmethod->bank_name }} - {{ $payment->paymentmethod->account_number }} - {{ $payment->paymentmethod->account_holder }}</td>
                    <td>Rp {{  number_format($payment->amount, 0, ',', '.') }}</td>
                    <td>{{ $payment->status }}</td>
                    <td class="py-0 align-middle">
                        <a href="/adminPayment/detail/{{ $payment->payment_id }}" class="btn btn-dark btn-sm">Detail<i class="fa fa-eye ml-2" aria-hidden="true"></i></a>
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