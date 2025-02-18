@extends('layouts/superadmin')
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
          <div class="col-sm-6 text-right">
            <a href="/superadminContingent/export/{{ $contingent->contingent_id }}" class="btn btn-success">
              Download Data Atlet
            </a>
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
              <th>Tempat Lahir</th>
              <th>Kategori Umur</th>
              <th>Nama Sekolah</th>
              <th>Berat Badan</th>
              <th>Tinggi Badan</th>
              {{-- <th>Aksi</th> --}}
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
                <td class="py-0 align-middle">{{ $athlete->place_birth }}</td>
                <td class="py-0 align-middle">{{ $athlete->age->age_name }}</td>
                <td class="py-0 align-middle">{{ $athlete->school_name }}</td>
                <td class="py-0 align-middle">{{ $athlete->weight }} Kg</td>
                <td class="py-0 align-middle">{{ $athlete->height }} Kg</td>
                
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

  {{-- <script>
    document.querySelector('.custom-file-input').addEventListener('change', function(e) {
      const fileName = e.target.files[0]?.name || 'Choose file';
      e.target.nextElementSibling.innerText = fileName;
    });
  </script> --}}

@endsection