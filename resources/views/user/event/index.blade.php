@extends('layouts/user')
@section('container')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Perlombaan</h1>
          </div>
          <div class="col-sm-6">
            <div class="float-sm-right">

            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="row">
        @foreach ($informations as $information)
        @php
            $banner = $information->event->banners->first();
            $documents = $information->event->documents;
            $competitions = $information->event->competitions;
        @endphp
        <div class="col-xl-12">
          <div class="card mb-3">
            <div class="row no-gutters">
              <div class="col-md-4">
                @if ($banner)
                    <img class="img-fluid" src="{{ asset('storage/' . $banner->banner_img) }}" alt="{{ $information->title }}">
                @else
                    <img class="img-fluid" src="{{ asset('img/screen.jpg') }}" alt="Default Banner">
                @endif
              </div>
              <div class="col-md-8 d-flex align-items-center">
                <div class="card-body">
                  <h3 class="mb-3">{{ $information->title }}</h3>
                  <p class="card-text text-md">{!! $information->description !!}</p>
                  <div class="mt-8">
                    @foreach ($documents as $document)
                      <a href="{{ asset('storage/' . $document->document) }}" target="_blank" class="btn btn-dark">Download {{ $document->document_name }} <i class="fa fa-download ml-2" aria-hidden="true"></i></a>
                    @endforeach
                  </div>
                  <div class="mt-4">
                    <h4 class="text-md font-weight-bold text-dark mb-3">Tanggal Pendaftaran</h4>
                    <ul class="list-unstyled">
                        <li class="border pt-2 pr-4 pl-4 rounded">
                            <div class="row">
                                <div class="col-md-6">
                                    <p>Buka Pendaftaran: <strong>{{ $information->open_reg }}</strong></p>
                                </div>
                                <div class="col-md-6">
                                    <p>Mulai Pertandingan: <strong>{{ $information->start_match }}</strong></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <p>Tutup Pendaftaran: <strong>{{ $information->close_reg }}</strong></p>
                                </div>
                                <div class="col-md-6">
                                    <p>Akhir Pertandingan: <strong>{{ $information->end_match }}</strong></p>
                                </div>
                            </div>
                        </li>
                    </ul>
                  </div>
                  <div class="mt-4">
                    @if (now()->toDateString() >= $information->open_reg && now()->toDateString() <= $information->close_reg)
                        <a href="/userEvent/register/{{ $information->event_id }}" class="btn btn-primary btn-block">Daftar Event</a>
                    @elseif (now()->toDateString()  < $information->open_reg)
                        <p class="text-muted text-center">Pendaftaran Belum Dibuka</p>
                    @elseif (now()->toDateString()  > $information->close_reg)
                        <p class="text-muted text-center">Pendaftaran Sudah Ditutup</p>
                    @endif
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endforeach
        
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection