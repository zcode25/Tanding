@extends('layouts/superadmin')
@section('container')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Kontingen</h1>
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
          <h3 class="card-title">Data Kontingen</h3>

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
              <th>Nama Kontingen</th>
              <th>Provisi</th>
              <th>Kota</th>
              <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
              @foreach ($contingents as $contingent)
              <tr>
                <td>{{ $contingent->contingent_name }}</td>
                <td>{{ $provinces[$contingent->province] ?? 'Unknown Province' }}</td>
                <td>
                    @if (!empty($contingentCities[$contingent->contingent_id]))
                      @foreach ($contingentCities[$contingent->contingent_id] as $city)
                         {{ $city }}
                      @endforeach
                    @else
                        No Cities Available
                    @endif
                </td>
                <td class="py-0 align-middle">
                  <a href="/superadminContingent/detail/{{ $contingent->contingent_id }}" class="btn btn-dark btn-sm">Detail<i class="fa fa-eye ml-2" aria-hidden="true"></i></a>
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
    document.addEventListener("DOMContentLoaded", function () {
      const provinceSelect = document.getElementById('province');
      const citySelect = document.getElementById('city');

      // Load data provinsi
      fetch('/json/provinces.json')
          .then(response => response.json())
          .then(provinces => {
              Object.entries(provinces).forEach(([id, name]) => {
                  const option = document.createElement('option');
                  option.value = id;
                  option.textContent = name;
                  provinceSelect.appendChild(option);
              });
          });

      // Event listener untuk perubahan provinsi
      provinceSelect.addEventListener('change', function () {
          const provinceId = this.value;

          // Reset dropdown kota
          citySelect.innerHTML = '<option value="" disabled selected>Pilih Kota Kontingen</option>';

          if (provinceId) {
              // Load data kota berdasarkan ID provinsi
              const cityFileName = `kab-${provinceId}.json`; // File JSON sesuai format
              fetch(`/json/cities/${cityFileName}`)
                  .then(response => {
                      if (!response.ok) {
                          throw new Error('File kota tidak ditemukan');
                      }
                      return response.json();
                  })
                  .then(cities => {
                      Object.entries(cities).forEach(([id, name]) => {
                          const option = document.createElement('option');
                          option.value = id;
                          option.textContent = name;
                          citySelect.appendChild(option);
                      });
                  })
                  .catch(error => {
                      console.error('Error loading city data:', error);
                      alert('Data kota tidak ditemukan untuk provinsi yang dipilih.');
                  });
          }
      });
  });
  </script>

@endsection