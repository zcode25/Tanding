@extends('layouts/adminEvent')
@section('container')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-xl-12">
            <h1>Perolehan Medali</h1>
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
                  <th>Pertandingan</th>
                  <th>Tipe Pertandingan</th>
                  <th>Jumlah Pertandingan</th>
                  <th>Aksi</th>    

                </tr>
                </thead>
                <tbody>
                  @foreach ($groupedCompetitions as $groupedCompetition)
                        @php
                            $firstCompetition = $groupedCompetition->first(); // Ambil elemen pertama dari grup
                            $categoryName = $firstCompetition->category->category_name ?? null;
                            $categoryType = $firstCompetition->category->category_type ?? null;
                            $categoryAmount = $firstCompetition->category->category_amount ?? null;
                            $categoryCount = $categoryCounts[$categoryName] ?? 0; // Ambil jumlah dari categoryCounts atau default 0
                        @endphp
                    
                        @if ($firstCompetition)
                          <tr>
                              <td>{{ $categoryName }}</td>
                              <td>{{ $categoryType }}</td>
                              <td>{{ $categoryAmount }}</td>
                              <td class="py-0 align-middle">
                                <a href="/adminMedal/detail/{{ $firstCompetition->competition_id }}" class="btn btn-dark btn-sm">
                                    Detail <i class="fa fa-eye ml-2" aria-hidden="true"></i>
                                </a>
                              </td>
                          </tr>
                        @endif
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