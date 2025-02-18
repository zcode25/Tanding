@extends('layouts/adminEvent')
@section('container')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Daftar Peserta</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        @php
              $i = 1;
          @endphp
          @foreach ($register->athletes as $athlete)
        <div class="col-xl-6">
          <!-- Horizontal Form -->
          
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Detail Atlet {{ $i++ }}</h3>
            </div>
            <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-xl-6">
                    <div class="mb-3">
                      <p class="mb-2 font-weight-bold">Nama Atlet</p>
                      <p>{{ $athlete->athlete_name }}</p>
                    </div>
                    <div class="mb-3">
                      <p class="mb-2 font-weight-bold">Jenis Kelamin</p>
                      <p>{{ $athlete->athlete_gender }}</p>
                    </div>
                    <div class="mb-3">
                      <p class="mb-2 font-weight-bold">Tanggal Lahir </p>
                      <p>{{ $athlete->date_birth }}</p>
                    </div>
                    <div class="mb-3">
                      <p class="mb-2 font-weight-bold">Tempat Lahir </p>
                      <p>{{ $athlete->place_birth }}</p>
                    </div>
                    <div class="mb-3">
                      <p class="mb-2 font-weight-bold">Nomor Induk Kependudukan (NIK) </p>
                      <p>{{ $athlete->nik }}</p>
                    </div>
                  </div>
                  <div class="col-xl-6">
                    <div class="mb-3">
                      <p class="mb-2 font-weight-bold">Berat Badan </p>
                      <p>{{ $athlete->weight }}</p>
                    </div>
                    <div class="mb-3">
                      <p class="mb-2 font-weight-bold">Tinggi Badan </p>
                      <p>{{ $athlete->height }}</p>
                    </div>
                    <div class="mb-3">
                      <p class="mb-2 font-weight-bold">Nama Sekolah </p>
                      <p>{{ $athlete->school_name }}</p>
                    </div>
                    <div class="mb-3">
                      <p class="mb-2 font-weight-bold">Foto Atlet </p>
                      @if ($athlete->athlete_photo)
                        <img class="w-full h-auto rounded-lg mt-3" src="{{ asset('storage/' . $athlete->athlete_photo) }}" alt="Photo" width="100">
                      @else
                        <img class="w-full h-auto rounded-lg mt-3" src="{{ asset('img/profile.png') }}" alt="Default photo" width="100">
                      @endif
                    </div>
                  </div>
                </div>
                
                
              </div>
             
              <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
         @endforeach

      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection