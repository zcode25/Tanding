@extends('layouts/adminEvent')
@section('container')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Pendaftaran</h1>
          </div>
          <div class="col-sm-6">
            <div class="float-sm-right">
              <a href="/adminRegister/export/{{ $competition->competition_id }}" class="btn btn-success">Download Data Pendaftaran</a>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      

      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data Pendaftaran</h3>
    
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
                  <th>Atlet</th>
                  <th>Kontingen</th>
                  <th>Kategori Pertandingan</th>
                  <th>Kategori Umur</th>
                  <th>Jenis Kelamin</th>
                  @if ($category->category_type == 'Tanding')
                  <th>Kelas</th>
                  @endif
                  
                  @if (!isset($payment->status))
                  <th>Aksi</th>
                  @endif
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
                      <td class="py-0 align-middle">{{ $register->contingent->contingent_name ?? 'N/A' }}</td>
                      <td class="py-0 align-middle">{{ $register->category->category_name ?? 'N/A' }}</td>
                      <td class="py-0 align-middle">{{ $register->age->age_name ?? 'N/A' }}</td>
                      <td class="py-0 align-middle">{{ $register->gender ?? 'N/A' }}</td>
                      @if ($category->category_type == 'Tanding')
                        <td class="py-0 align-middle">{{ $register->matchClass->class_name }} ({{ $register->matchClass->class_min }}Kg s/d {{ $register->matchClass->class_max }}Kg)</td>
                      @endif
                      {{-- @if (!isset($payment->status)) --}}
                      <td class="py-0 align-middle">
                        <a href="/adminRegister/edit/{{ $register->register_id }}" class="btn btn-dark btn-sm">Detail <i class="fa fa-eye ml-2"></i></a>
                      </td>
                      {{-- @endif --}}
                     
                    </tr>
                    @endforeach
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



  

@endsection