@extends('layouts/adminEvent')
@section('container')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-4">
              <h1 class="mb-2">Penilaian TGR</h1>
              <p>{{ $category->category_name }} / {{ $age->age_name }} / {{ $competition->gender }}</p>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      

      <div class="row">
        <div class="col-xl-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Penilaian TGR</h3>
    
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
                        <th>No Undian</th>
                        <th>Atlet</th>
                        <th>Kontingen</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($participants as $index => $participant)
                        <tr>
                          <td id="draw-{{ $participant->participant_id }}" class="text-center">
                            {{ $participant->draw_number ?? '-' }}
                          </td>
                            <td>
                                @php
                                    $athletes = json_decode($participant->athlete_name, true);
                                @endphp
                                @if (is_array($athletes))
                                    {{ implode(', ', $athletes) }}
                                @else
                                    {{ $participant->athlete_name }}
                                @endif
                            </td>
                            <td>{{ $participant->contingent_name }}</td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
        <div class="col-xl-6">
          <div class="card">
            <div class="card-header">
                <h3 class="card-title">Bagan Pertandingan</h3>
            </div>
            <form action="/adminMatch/tgrMatch/store" method="POST" class="form-horizontal">
                @csrf
                <input type="hidden" id="event_id" name="event_id" value="{{ $event->event_id }}">
                <input type="hidden" id="competition_id" name="competition_id" value="{{ $competition->competition_id }}">

                <div class="card-body">

                    <div class=" form-group">
                      <label for="participant_id" class="form-label">Peserta <span class="text-danger">*</span></label>
                      <select class="form-control select2bs4 @error('participant_id') is-invalid @enderror" id="participant_id" name="participant_id" data-placeholder="Pilih Peserta">
                        <option value=""></option>  
                        @foreach ($participants as $participant)
                          @php
                            $athletes = json_decode($participant->athlete_name, true);
                          @endphp
                          @if (old('participant_id') == $participant->participant_id)
                            <option value="{{ $participant->participant_id }}" selected>{{ $participant->draw_number ?? '-' }} - {{ is_array($athletes) ? implode(', ', $athletes) : $participant->athlete_name }} - {{ $participant->contingent_name }}</option>
                          @else
                            <option value="{{ $participant->participant_id }}">{{ $participant->draw_number ?? '-' }} - {{ is_array($athletes) ? implode(', ', $athletes) : $participant->athlete_name }} - {{ $participant->contingent_name }}</option>
                          @endif
                        @endforeach
                      </select>
                      @error('participant_id') 
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>

                    <div class="form-group">
                        <label for="value">Nilai <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('value') is-invalid @enderror" id="value" name="value" value="{{ old('value') }}">
                        @error('value')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                      <label for="champion">Juara <span class="text-danger">*</span></label>
                      <input type="number" class="form-control @error('champion') is-invalid @enderror" id="champion" name="champion" champion="{{ old('champion') }}">
                      @error('champion')
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                  </div>

                    <div class="d-grid gap-2">
                        <button type="submit" name="submit" class="btn btn-primary btn-block">Tambah</button>
                    </div>
                </div>
            </form>
          </div>
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Urutan TGR</h3>
    
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
                        <th>No Undian</th>
                        <th>Atlet</th>
                        <th>Kontingen</th>
                        <th>Nilai</th>
                        <th>Juara</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($matchtgrs as $index => $matchtgr)
                        <tr>
                          <form action="/adminMatch/tgrMatch/update/{{ $matchtgr->matchtgr_id }}" method="POST">
                            @csrf
                              <td class="text-center">
                                {{ $matchtgr->participant->draw_number ?? '-' }}
                              </td>
                              <td>
                                  @php
                                      $athletes = json_decode($matchtgr->participant->athlete_name, true);
                                  @endphp
                                  @if (is_array($athletes))
                                      {{ implode(', ', $athletes) }}
                                  @else
                                      {{ $matchtgr->participant->athlete_name }}
                                  @endif
                              </td>
                              <td>{{ $matchtgr->participant->contingent_name }}</td>
                              <td><input type="text" class="form-control @error('value') is-invalid @enderror" id="value" name="value" value="{{ old('value', $matchtgr->value) }}" style="width: 80px;"></td>
                              <td><input type="text" class="form-control @error('champion') is-invalid @enderror" id="champion" name="champion" value="{{ old('champion', $matchtgr->champion) }}" style="width: 80px;"></td>
                              <td class="py-0 align-middle">
                                <button type="submit" name="submit" class="btn btn-primary btn-sm">Simpan</button>
                                <a href="/adminMatch/tgrMatch/destroy/{{ $matchtgr->matchtgr_id }}" class="btn btn-danger btn-sm" data-confirm-delete="true">Hapus<i class="fa fa-trash ml-2" aria-hidden="true"></i></a>
                              </td>    
                          </form>
                        </tr>
                    @endforeach
                </tbody>
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