@extends('layouts/user')
@section('container')
    


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Halaman Utama</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3>{{ $countAthlete }}</h3>

                <p>Jumlah Atlet</p>
              </div>
              <div class="icon">
                <i class="fa-solid fa-users"></i>
              </div>
            </div>
          </div>
          <div class="col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ count($informations) }}</h3>

                <p>Jumlah Event</p>
              </div>
              <div class="icon">
                <i class="fa-regular fa-paper-plane"></i>
              </div>
            </div>
          </div>
        </div>
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
                <div class="col-md-2">
                  @if ($banner)
                      <img class="img-fluid" src="{{ asset('storage/' . $banner->banner_img) }}" alt="{{ $information->title }}">
                  @else
                      <img class="img-fluid" src="{{ asset('img/screen.jpg') }}" alt="Default Banner">
                  @endif
                </div>
                <div class="col-md-10 d-flex align-items-center">
                  <div class="card-body">
                    <h3 class="mb-3">{{ $information->title }}</h3>
                    <p class="text-md">{!! $information->description !!}</p>
                    <div class="mt-8">
                      @foreach ($documents as $document)
                        <a href="{{ asset('storage/' . $document->document) }}" target="_blank" class="btn btn-dark">Download {{ $document->document_name }} <i class="fa fa-download ml-2" aria-hidden="true"></i></a>
                      @endforeach
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endforeach
          
        </div>


        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  @endsection

  