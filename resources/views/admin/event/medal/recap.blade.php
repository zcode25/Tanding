@extends('layouts/adminEvent')
@section('container')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-xl-12">
            <h1>Rekapitulasi Medali</h1>
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
              <h3 class="card-title">Rekapitulasi Medali</h3>
    
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
                  <th>Kontingent</th>
                  <th>Emas</th>
                  <th>Perak</th>
                  <th>Perunggu</th>
                  <th>Total</th>
                </tr>
                </thead>
                <tbody>
                  @php $no = 1; @endphp
                  @foreach ($medals as $contingen => $data)
                      <tr>
                          <td>{{ $no++ }}</td>
                          <td>{{ $contingen }}</td>
                          <td>{{ $data['emas'] }}</td>
                          <td>{{ $data['perak'] }}</td>
                          <td>{{ $data['perunggu'] }}</td>
                          <td><strong>{{ $data['total'] }}</strong></td>
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