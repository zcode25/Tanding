@extends('layouts/adminEvent')
@section('container')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-xl-12">
            <h1 class="mb-2">Pengundian Peserta</h1>
            <p>{{ $category->category_name }}</p>
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
              <h3 class="card-title">Pengundian Peserta</h3>
    
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
                  {{-- <th>Kategori Pertandingan</th> --}}
                  <th>Kategori Umur</th>
                  <th>Jenis Kelamin</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($groupedAges as $groupedAge)
                    <tr>
                      {{-- <td>{{ $groupedAge->first()->category->category_name }}</td> --}}
                      <td>{{ $groupedAge->age->age_name }}</td>
                      <td>{{ $groupedAge->gender }}</td>
                      <td class="py-0 align-middle">
                        @if ($category->category_type == 'Tanding' )
                        <a href="/adminDraw/tanding/{{ $groupedAge->competition_id }}"" class="btn btn-dark btn-sm">Detail<i class="fa fa-eye ml-2" aria-hidden="true"></i></a>
                        @else
                        <a href="/adminDraw/tgrDraw/{{ $groupedAge->competition_id }}"" class="btn btn-dark btn-sm">Detail<i class="fa fa-eye ml-2" aria-hidden="true"></i></a>
                        @endif
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