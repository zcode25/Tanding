@extends('layouts/user')
@section('container')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Atlet</h1>
          </div>
          <div class="col-sm-6">
            <div class="float-sm-right">

              <div class="d-flex align-items-center">
                <form action="/userAthlete/import" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="input-group  @error('banner_img') is-invalid @enderror">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input @error('banner_img') is-invalid @enderror" id="inputGroupFile04"name="file" aria-describedby="inputGroupFileAddon04">
                      <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                    </div>
                    <div class="input-group-append">
                      <button class="btn btn-dark" type="submit" name="submit" id="inputGroupFileAddon04">Upload</button>
                    </div>
                  </div>
                </form>
  
                <a href="/userAthlete/template" class="btn btn-dark ml-2"> Template Excel</a>
                <a href="/userAthlete/create" class="btn btn-primary ml-2">Tambah Data</a>
              </div>
  
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
          <h3 class="card-title">Daftar Atlet</h3>

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
              <th>No</th>
              <th>Foto</th>
              <th>Nama</th>
              <th>NIK</th>
              <th>Jenis Kelamin</th>
              <th>Tanggal Lahir</th>
              <th>Kategori Umur</th>
              <th>Nama Sekolah</th>
              <th>Berat Badan</th>
              <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
              @php
                  $i = 1
              @endphp
              @foreach ($athletes as $athlete)
              <tr>
                <td class="py-0 align-middle">{{ $i++ }}</td>
                <td>
                  @if ($athlete->athlete_photo)
                    <img class="w-full h-auto rounded-lg" src="{{ asset('storage/' . $athlete->athlete_photo) }}" alt="Photo" width="50">
                  @else
                    <img class="w-full h-auto rounded-lg" src="{{ asset('img/profile.png') }}" alt="Default photo" width="50">
                  @endif
                </td>
                <td class="py-0 align-middle">{{ $athlete->athlete_name }}</td>
                <td class="py-0 align-middle">{{ $athlete->nik }}</td>
                <td class="py-0 align-middle">{{ $athlete->athlete_gender }}</td>
                <td class="py-0 align-middle">{{ $athlete->date_birth }}</td>
                <td class="py-0 align-middle">{{ $athlete->age->age_name }}</td>
                <td class="py-0 align-middle">{{ $athlete->school_name }}</td>
                <td class="py-0 align-middle">{{ $athlete->weight }} Kg</td>
                
                <td class="py-0 align-middle">
                    <a href="/userAthlete/edit/{{ $athlete->athlete_id }}" class="btn btn-primary btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                    <a href="/userAthlete/destroy/{{ $athlete->athlete_id }}" class="btn btn-danger btn-sm" data-confirm-delete="true"><i class="fa fa-trash" aria-hidden="true"></i></a>
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

  <script>
    document.querySelector('.custom-file-input').addEventListener('change', function(e) {
      const fileName = e.target.files[0]?.name || 'Choose file';
      e.target.nextElementSibling.innerText = fileName;
    });
  </script>

@endsection