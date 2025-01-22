@extends('layouts/adminEvent')
@section('container')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Pengundian</h1>
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
      

      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Pengundian {{ $category_name }} / {{ $age_name }}</h3>
    
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
                  <th>Kelas</th>
                  <th>Jenis Kelamin</th>
                  <th>Minimal Berat</th>
                  <th>Maksimal Berat</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($groupedClasses as $groupedClass)
                    <tr>
                      <td>{{ $groupedClass->first()->matchClass->class_name }}</td>
                      <td>{{ $groupedClass->first()->matchClass->class_gender }}</td>
                      <td>{{ $groupedClass->first()->matchClass->class_min }}Kg</td>
                      <td>{{ $groupedClass->first()->matchClass->class_max }}Kg</td>
                      <td class="py-0 align-middle">
                        <a href="/adminDraw/tandingDraw/{{ $groupedClass->first()->register_id }}" class="btn btn-dark btn-sm">Detail<i class="fa fa-eye ml-2" aria-hidden="true"></i></a>
                      </td>
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