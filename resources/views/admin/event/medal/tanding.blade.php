@extends('layouts/adminEvent')
@section('container')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="mb-2">Perolehan Medali</h1>
            <p>{{ $category->category_name }} / {{ $age->age_name }} / {{ $competition->gender }}</p>
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
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Perolehan Medali</h3>
    
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
                  <th>Minimal Berat</th>
                  <th>Maksimal Berat</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($groupedClasses as $groupedClass)
                    <tr>
                      <td>{{ $groupedClass->class_name }}</td>
                      <td>{{ $groupedClass->class_min }}Kg</td>
                      <td>{{ $groupedClass->class_max }}Kg</td>
                      <td class="py-0 align-middle">
                        <a href="/adminMedal/tandingMedal/{{ $competition->competition_id }}/{{ $groupedClass->class_id }}" class="btn btn-dark btn-sm">Detail<i class="fa fa-eye ml-2" aria-hidden="true"></i></a>
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