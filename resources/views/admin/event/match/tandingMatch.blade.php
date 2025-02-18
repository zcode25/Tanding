@extends('layouts/adminEvent')
@section('container')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="mb-2">Pertandingan</h1>
            <p>{{ $category_name }} / {{ $age_name }} / {{ $class_name }}</p>
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
              <h3 class="card-title">Data Pertandingan</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="/adminMatch/tandingMatch/store" method="POST" class="form-horizontal">
            @csrf
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <input type="hidden" id="event_id" name="event_id" value="{{ $event->event_id }}">
                    <input type="hidden" id="category_id" name="category_id" value="{{ $category_id }}">
                    <input type="hidden" id="age_id" name="age_id" value="{{ $age_id }}">
                    <input type="hidden" id="class_id" name="class_id" value="{{ $class_id }}">

                    <div class="form-group">
                      <label for="match_date" class="form-label">Tanggal Pertandingan <span class="text-danger">*</span></label>
                      <input type="date" class="form-control @error('match_date') is-invalid @enderror" id="match_date" name="match_date" value="{{ old('match_date') }}">
                      @error('match_date') 
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="party_number" class="form-label">Nomor Partai <span class="text-danger">*</span></label>
                      <input type="number" class="form-control @error('party_number') is-invalid @enderror" id="party_number" name="party_number" value="{{ old('party_number') }}">
                      @error('party_number') 
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
    
                    
                  </div>
                  <div class="col">
                    <div class="form-group">
                      <label for="blue_corner" class="form-label">Sudut Biru <span class="text-danger">*</span></label>
                      <select class="form-control select2bs4 @error('blue_corner') is-invalid @enderror" id="blue_corner" name="blue_corner" data-placeholder="Pilih Sudut Biru">
                          <option value=""></option>
                          @foreach ($drawAthlets as $draw)
                              @php
                                  $athletes = $draw->register->registerAthletes->map(function($registerAthlete) {
                                      return $registerAthlete->athlete->athlete_name ?? 'N/A';
                                  })->join(', ');
                              @endphp
                              @if (old('blue_corner') == $draw->draw_id)
                                  <option value="{{ $draw->draw_id }}" selected>
                                      ({{ $draw->draw_number }}) {{ $athletes }} - {{ $draw->register->contingent->contingent_name ?? 'N/A' }} 
                                  </option>
                              @else
                                  <option value="{{ $draw->draw_id }}">
                                      ({{ $draw->draw_number }}) {{ $athletes }} - {{ $draw->register->contingent->contingent_name ?? 'N/A' }}
                                  </option>
                              @endif
                          @endforeach
                      </select>
                      @error('blue_corner') 
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="red_corner" class="form-label">Sudut Merah <span class="text-danger">*</span></label>
                      <select class="form-control select2bs4 @error('red_corner') is-invalid @enderror" id="red_corner" name="red_corner" data-placeholder="Pilih Sudut Merah">
                          <option value=""></option>
                          @foreach ($drawAthlets as $draw)
                              @php
                                  $athletes = $draw->register->registerAthletes->map(function($registerAthlete) {
                                      return $registerAthlete->athlete->athlete_name ?? 'N/A';
                                  })->join(', ');
                              @endphp
                              @if (old('red_corner') == $draw->draw_id)
                                  <option value="{{ $draw->draw_id }}" selected>
                                      {{ $draw->draw_number }} - ({{ $athletes }}) - {{ $draw->register->contingent->contingent_name ?? 'N/A' }} 
                                  </option>
                              @else
                                  <option value="{{ $draw->draw_id }}">
                                      {{ $draw->draw_number }} - ({{ $athletes }}) - {{ $draw->register->contingent->contingent_name ?? 'N/A' }}
                                  </option>
                              @endif
                          @endforeach
                      </select>
                      @error('red_corner') 
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="col">
                    <div class=" form-group">
                      <label for="match_round" class="form-label">Babak Pertandingan <span class="text-danger">*</span></label>
                      <select class="form-control select2bs4 @error('match_round') is-invalid @enderror" id="match_round" name="match_round" data-placeholder="Pilih Babak Pertandingan">
                        <option value=""></option>
                        @foreach ($match_rounds as $match_round)
                          @if (old('match_round') == $match_round['match_round'])
                            <option value="{{ $match_round['match_round'] }}" selected>{{ $match_round['match_round'] }}</option>
                          @else
                            <option value="{{ $match_round['match_round'] }}">{{ $match_round['match_round'] }}</option>
                          @endif
                        @endforeach
                      </select>
                      @error('match_round') 
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                </div>

                {{-- <div class="d-grid gap-2">
                  <button type="submit" name="submit" class="btn btn-primary btn-block">Tambah</button>
                </div> --}}

              
              
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" name="submit" class="btn btn-primary float-right">Simpan</button>
              </div>
            </form>
            <!-- /.card-footer -->
          </div>
          {{-- <div class="card">
            <div class="card-header">
              <h3 class="card-title">Daftar Undian</h3>
    
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            
            <div class="card-body">

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
                      <td>{{ $draw->draw_number }}</td>
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
          </div> --}}
        </div>

        <div class="col-xl-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Daftar Pertandingan</h3>
    
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
                    <th>Tanggal</th>
                    <th class="bg-primary">Sudut Biru</th>
                    <th class="bg-dark">Partai</th>
                    <th class="bg-danger">Sudut Merah</th>
                    <th class="bg-green">Babak</th>
                    <th>Pemenang</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($matchtandings as $matchtanding)
                      <tr>
                        <form action="/adminMatch/tandingMatch/update/{{ $matchtanding->matchtanding_id }}" method="POST">
                          @csrf
                            <td>
                                <input type="date" class="form-control" name="match_date" value="{{ $matchtanding->match_date }}"/>
                            </td>
                            <td class="py-0 align-middle">
                              @foreach ($matchtanding->blueCorner->register->registerAthletes as $registerAthlete)
                                @if ($registerAthlete->athlete)
                                  ({{ $matchtanding->blueCorner->draw_number }})
                                  {{ $registerAthlete->athlete->athlete_name ?? 'N/A' }} -
                                  {{ $registerAthlete->athlete->contingent->contingent_name ?? 'N/A' }}
                                @else
                                  N/A
                                @endif
                              @endforeach
                            </td>
                            <td class="py-0 align-middle text-center">{{ $matchtanding->party_number }}</td>
                            <td class="py-0 align-middle">
                              @foreach ($matchtanding->redCorner->register->registerAthletes as $registerAthlete)
                                @if ($registerAthlete->athlete)
                                  ({{ $matchtanding->redCorner->draw_number }})
                                  {{ $registerAthlete->athlete->athlete_name ?? 'N/A' }} -
                                  {{ $registerAthlete->athlete->contingent->contingent_name ?? 'N/A' }}
                                @else
                                  N/A
                                @endif
                              @endforeach
                            </td>
                            
                            <td class="py-0 align-middle">{{ $matchtanding->match_round }}</td>
                            <td>
                              <select class="form-control @error('winner') is-invalid @enderror" id="winner" name="winner">
                                  <option value="" disabled selected>Pilih Pemenang</option>
                                  
                                  {{-- Atlet Blue Corner --}}
                                  @if ($matchtanding->blueCorner && $matchtanding->blueCorner->register)
                                      @foreach ($matchtanding->blueCorner->register->registerAthletes as $registerAthlete)
                                          @if ($registerAthlete->athlete)
                                              <option value="{{ $matchtanding->blue_corner }}" 
                                                  {{ old('winner', $matchtanding->winner) == $matchtanding->blue_corner ? 'selected' : '' }}>
                                                  ({{ $matchtanding->blueCorner->draw_number }})
                                                  {{ $registerAthlete->athlete->athlete_name ?? 'N/A' }} -
                                                  {{ $registerAthlete->athlete->contingent->contingent_name ?? 'N/A' }}
                                              </option>
                                          @endif
                                      @endforeach
                                  @endif
                          
                                  {{-- Atlet Red Corner --}}
                                  @if ($matchtanding->redCorner && $matchtanding->redCorner->register)
                                      @foreach ($matchtanding->redCorner->register->registerAthletes as $registerAthlete)
                                          @if ($registerAthlete->athlete)
                                              <option value="{{ $matchtanding->red_corner }}" 
                                                  {{ old('winner', $matchtanding->winner) == $matchtanding->red_corner ? 'selected' : '' }}>
                                                  ({{ $matchtanding->redCorner->draw_number }})
                                                  {{ $registerAthlete->athlete->athlete_name ?? 'N/A' }} -
                                                  {{ $registerAthlete->athlete->contingent->contingent_name ?? 'N/A' }}
                                              </option>
                                          @endif
                                      @endforeach
                                  @endif
                              </select>
                              @error('winner') 
                                  <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                          </td>
                          <td class="py-0 align-middle">
                              <button type="submit" name="submit" class="btn btn-primary btn-sm">Simpan</button>
                              <a href="/adminMatch/tandingMatch/destroy/{{ $matchtanding->matchtanding_id }}" data-confirm-delete="true" class="btn btn-danger btn-sm">Hapus</a>
                          </td>
                        </form>
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