@extends('layouts/user')
@section('container')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Perlombaan - {{ $information->title }}</h1>
          </div>
          {{-- <div class="col-sm-6">
            <div class="float-sm-right">

            </div>
          </div> --}}
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->

      <div class="invoice p-3 mb-3">
        <!-- title row -->
        <div class="row mb-4">
          <div class="col-12">
            <h4>
              <i class="fas fa-globe"></i> Tanding
              @if (isset($payment->status))
                <small class="float-right">Date: {{ $payment->created_at->toDateString() }}</small>
              @else
                <small class="float-right">Date: {{ now()->toDateString() }}</small>
              @endif
            </h4>
          </div>
          <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info mb-4">
          <div class="col-xl-4 invoice-col">
            Dari
            <address>
              <strong>Admin</strong><br>
              Semarang, Jawa Tengah<br>
              Telepon: 081234567890<br>
              Email: info@tanding.com
            </address>
          </div>
          <!-- /.col -->
          <div class="col-xl-4 invoice-col">
            Untuk
            <address>
              <strong>{{ $contingent->user->name }} ({{ $contingent->contingent_name }})</strong><br>
              {{ $contingent->user->address }}<br>
              Telepon: {{ $contingent->user->phone }}<br>
              Email: {{ $contingent->user->email }}
            </address>
          </div>
          <!-- /.col -->
          <div class="col-xl-3 invoice-col text-center">
            @if (isset($payment->status))
              @if ($payment->status == 'Pending')
              <p class="bg-primary rounded-pill h5 p-3"><strong>Menunggu Konfirmasi</strong></p>
              @elseif ($payment->status == 'Approve')
                <p class="bg-success rounded-pill h5 p-3"><strong>Pembayaran Diterima</strong></p>
              @elseif ($payment->status == 'Reject')
                <p class="bg-danger rounded-pill h5 p-3"><strong>Status Pembayaran: Reject</strong></p>
              @endif
            @endif
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Table row -->
        <div class="row mb-4">
          <div class="col-12 table-responsive">
            <table class="table table-striped">
              <thead>
              <tr>
                <th>No</th>
                <th>Atlet</th>
                <th>Kategori Pertandingan</th>
                <th>Kategori Umur</th>
                <th>Jenis Kelamin</th>
                <th>Kelas</th>
                <th>Harga</th>
              </tr>
              </thead>
              <tbody>
                @foreach ($registers as $index => $register)
                  <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                      <ul style="margin: 0; padding: 0; list-style-type: none;">
                        @foreach ($register->athletes as $athlete)
                            <li style="position: relative; padding-left: 15px;">
                                <span style="position: absolute; left: 0;">-</span> {{ $athlete->athlete_name }}
                            </li>
                        @endforeach
                      </ul>
                    </td>
                    <td>{{ $register->category->category_name ?? 'N/A' }}</td>
                    <td>{{ $register->age->age_name ?? 'N/A' }}</td>
                    <td>{{ $register->gender ?? 'N/A' }}</td>
                    @if (isset($register->matchClass))
                      <td>{{ $register->matchClass->class_name }} ({{ $register->matchClass->class_min }}Kg s/d {{ $register->matchClass->class_max }}Kg)</td>
                    @else
                      <td>-</td>
                    @endif
                    <td>Rp {{  number_format($register->price, 0, ',', '.') }}</td>
                  </tr>
                  @endforeach
              </tfoot>
            </table>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
          <!-- accepted payments column -->
          <div class="col-6">
            <p class="lead">Metode Pembayaran:</p>
            <div class="row">
                @foreach ($paymentmethods as $paymentmethod)
                <div class="col-6 mb-3">
                    <div class="p-3">
                        <p class="text-dark well well-sm shadow-none">
                            <strong>{{ $paymentmethod->bank_name }}</strong><br>
                            Nomor Rekening: <strong><br>{{ $paymentmethod->account_number }}</strong><br>
                            Atas Nama: <strong><br>{{ $paymentmethod->account_holder }}</strong>
                        </p>
                    </div>
                </div>
                @endforeach
            </div>
          </div>
          <!-- /.col -->
          <div class="col-6">

            <div class="table-responsive">
              <table class="table text-right">
                <tr>
                  <th style="width:50%">Subtotal:</th>
                  <td class="pr-5">Rp {{  number_format($totalPrice, 0, ',', '.') }}</td>
                </tr>
                <tr>
                  <th>Kode Unik:</th>
                  <td class="pr-5">Rp {{  number_format($uniqueCode, 0, ',', '.') }}</td>
                </tr>
                <tr>
                  <th>Total:</th>
                  <td class="pr-5"><strong>Rp {{  number_format($totalPayment, 0, ',', '.') }} </strong></td>
                </tr>
              </table>
            </div>
          </div>
          <div class="col-12 text-right p-3">
            <a href="/userEvent/register/payment/invoice/{{ $event->event_id }}" target="_blank" class="btn btn-success">Cetak Invoice</a>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- this row will not appear when printing -->
        
      </div>

      @if (!isset($payment->status))
      <div class="row">
        <div class="col-xl-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Pembayaran</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="/userEvent/register/payment/store/{{ $event->event_id }}" method="POST" enctype="multipart/form-data"  class="form-horizontal">
              @csrf
              <input type="hidden" id="event_id" name="event_id" value="{{ $event->event_id }}">
              <input type="hidden" id="contingent_id" name="contingent_id" value="{{ $contingent->contingent_id }}">
              <input type="hidden" id="amount" name="amount" value="{{ $totalPayment }}">
              <input type="hidden" id="status" name="status" value="Pending">
              <div class="card-body">
                <div class="form-group">
                  <label for="name" class="form-label">Nama <span class="text-danger">*</span></label>
                  <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $contingent->user->name }}" readonly>
                  @error('name') 
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="name" class="form-label">Kontingen <span class="text-danger">*</span></label>
                  <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $contingent->contingent_name }}" readonly>
                  @error('name') 
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="phone" class="form-label">No WhatsApp <span class="text-danger">*</span></label>
                  <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ $contingent->user->phone }}" readonly>
                  @error('phone') 
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="email" class="form-label">Alamat Email <span class="text-danger">*</span></label>
                  <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $contingent->user->email }}" readonly>
                  @error('email') 
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class=" form-group">
                  <label for="paymentmethod_id" class="form-label">Metode Pembayaran <span class="text-danger">*</span></label>
                  <select class="form-control select2bs4 @error('paymentmethod_id') is-invalid @enderror" id="paymentmethod_id" name="paymentmethod_id" data-placeholder="Pilih Metode Pembayaran">
                    <option value=""></option>
                    @foreach ($paymentmethods as $paymentmethod)
                      @if (old('paymentmethod_id') == $paymentmethod->paymentmethod_id)
                        <option value="{{ $paymentmethod->paymentmethod_id }}" selected>{{ $paymentmethod->bank_name }} - {{ $paymentmethod->account_number }} - {{ $paymentmethod->account_holder }}</option>
                      @else
                        <option value="{{ $paymentmethod->paymentmethod_id }}">{{ $paymentmethod->bank_name }}  - {{ $paymentmethod->account_number }} - {{ $paymentmethod->account_holder }}</option>
                      @endif
                    @endforeach
                  </select>
                  @error('paymentmethod_id') 
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                  <label class="form-label">Bukti Transfer <span class="text-danger">*</span></label>
                  <div class="input-group  @error('payment_proof') is-invalid @enderror">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input @error('payment_proof') is-invalid @enderror" id="inputGroupFile04" name="payment_proof" aria-describedby="inputGroupFileAddon04">
                      <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                    </div>
                  </div>
                  @error('payment_proof')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>     
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" name="submit" class="btn btn-primary float-right">Bayar</button>
              </div>
              <!-- /.card-footer -->
            </form>
          </div>
        </div>
      </div>
      @endif

      @if (isset($payment->status))
      <div class="row">
        <div class="col-xl-4">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Bukti Transfer</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <div class="card-body">
            
              <div class="image-container mb-3">
                <img src="{{ asset('storage/' . $payment->payment_proof) }}" class="img-fluid" alt="Image">
              </div>

            </div>

          </div>
        </div>
      </div>
      @endif
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script>
    document.querySelector('.custom-file-input').addEventListener('change', function(e) {
      const fileName = e.target.files[0]?.name || 'Choose file';
      e.target.nextElementSibling.innerText = fileName;
    });
  </script>

  

@endsection