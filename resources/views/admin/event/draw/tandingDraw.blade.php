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
        {{-- <div class="col-xl-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Pengundian {{ $category_name }} / {{ $age_name }} / {{ $class_name }}</h3>
    
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
                </tr>
                </thead>
                <tbody>
                  @foreach ($registers as $index => $register)
                  <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                      <ul style="margin: 0; padding: 0;">
                        @foreach ($register->athletes as $athlete)
                            <li>{{ $athlete->athlete_name }} ({{ $athlete->athlete_gender }} - {{ $athlete->weight }}Kg)</li>
                        @endforeach
                      </ul>
                    </td>
                    <td>{{ $register->contingent->contingent_name ?? 'N/A' }}</td>
                  </tr>
                  @endforeach
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
        </div> --}}
        <div class="col-xl-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Pengundian {{ $category_name }} / {{ $age_name }} / {{ $class_name }}</h3>
    
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            
            <div class="card-body">
              <div class="text-center mb-3">
                @if (count($draws) > 0)
                <form action="/adminDraw/tandingDraw/reshuffle" method="POST" class="form-horizontal d-inline">
                  @csrf
                  <input type="hidden" id="event_id" name="event_id" value="{{ $event->event_id }}">
                  <input type="hidden" id="category_id" name="category_id" value="{{ $category_id }}">
                  <input type="hidden" id="age_id" name="age_id" value="{{ $age_id }}">
                  <input type="hidden" id="class_id" name="class_id" value="{{ $class_id }}">
                  <button type="submit" name="submit" class="btn btn-dark">Pengacakan Ulang Peserta <i class="fa fa-random ml-2" aria-hidden="true"></i></button>
                </form>
                @else
                <form action="/adminDraw/tandingDraw/store" method="POST" class="form-horizontal">
                  @csrf
                  <input type="hidden" id="event_id" name="event_id" value="{{ $event->event_id }}">
                  <input type="hidden" id="category_id" name="category_id" value="{{ $category_id }}">
                  <input type="hidden" id="age_id" name="age_id" value="{{ $age_id }}">
                  <input type="hidden" id="class_id" name="class_id" value="{{ $class_id }}">
                  <button type="submit" name="submit" class="btn btn-primary">Pangacakan Perserta <i class="fa fa-random ml-2" aria-hidden="true"></i></button>
                </form>
                @endif
                

                
              </div>
              
              <hr>

              <table class="table table-hover">
                <thead>
                <tr>
                  <th>No Undian</th>
                  <th>Atlet</th>
                  <th>Kontingen</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($draws as $index => $draw)
                  <tr>
                      <td>
                          <form action="/adminDraw/tandingDraw/update/{{ $draw->draw_id }}" method="POST">
                              @csrf
                              @method('PATCH')
                              <input 
                                  type="number"
                                  name="draw_number" 
                                  value="{{ $draw->draw_number }}" 
                                  style="width: 50px;" 
                              />
                              <button type="submit" class="btn btn-primary btn-sm">Save</button>
                          </form>
                      </td>
                      <td>
                          <ul style="margin: 0; padding: 0;">
                              @foreach ($draw->register->registerAthletes as $registerAthlete)
                                  @if ($registerAthlete->athlete)
                                      <li>
                                          {{ $registerAthlete->athlete->athlete_name ?? 'N/A' }} 
                                          ({{ $registerAthlete->athlete->athlete_gender ?? 'N/A' }} - 
                                          {{ $registerAthlete->athlete->weight ?? 'N/A' }}Kg)
                                      </li>
                                  @else
                                      <li>N/A</li>
                                  @endif
                              @endforeach
                          </ul>
                      </td>
                      <td>{{ $draw->register->contingent->contingent_name ?? 'N/A' }}</td>
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