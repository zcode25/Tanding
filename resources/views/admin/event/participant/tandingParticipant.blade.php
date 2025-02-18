@extends('layouts/adminEvent')
@section('container')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-4">
              <h1 class="mb-2">Data Peserta</h1>
              <p>{{ $category->category_name }} / {{ $age->age_name }} / {{ $competition->gender }} / {{ $matchclass->class_name }} ({{ $matchclass->class_min }}Kg s/d {{ $matchclass->class_max }}Kg)</p>
          </div>
          <div class="col-sm-8">
              <div class="d-flex justify-content-end align-items-center">
                  <form action="/adminParticipant/participant/importTemplate" method="POST" enctype="multipart/form-data" class="d-flex align-items-center mr-2">
                      @csrf
                      <input type="hidden" name="event_id" value="{{ $event->event_id }}">
                      <input type="hidden" name="competition_id" value="{{ $competition->competition_id }}">
                      <input type="hidden" name="category_id" value="{{ $category->category_id }}">
                      <input type="hidden" name="age_id" value="{{ $age->age_id }}">
                      <input type="hidden" name="gender" value="{{ $competition->gender }}">
                      <input type="hidden" name="class_id" value="{{ $matchclass->class_id }}">
      
                      <div class="input-group @error('file') is-invalid @enderror">
                          <div class="custom-file">
                              <input type="file" class="custom-file-input @error('file') is-invalid @enderror" id="inputGroupFile04" name="file" aria-describedby="inputGroupFileAddon04">
                              <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                          </div>
                          <div class="input-group-append">
                              <button class="btn btn-dark" type="submit" name="submit" id="inputGroupFileAddon04">Upload</button>
                          </div>
                      </div>
                  </form>
      
                  <a href="/adminParticipant/participant/downloadTemplate" class="btn btn-success mr-2">Template</a>
                  {{-- <a href="/adminParticipant/tandingDraw/{{ $competition->competition_id }}/{{ $matchclass->class_id }}" class="btn btn-primary">Pengundian</a> --}}
              </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      

      <div class="row">
        <div class="col-xl-12">
          <!-- Horizontal Form -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data Atlet</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="/adminParticipant/tandingParticipant/store" method="POST" class="form-horizontal">
              @csrf
              <div class="card-body">
                  <div class="row">
                      <div class="col-xl-6">
                          <input type="hidden" name="event_id" value="{{ $event->event_id }}">
                          <input type="hidden" name="competition_id" value="{{ $competition->competition_id }}">
                          <input type="hidden" name="category_id" value="{{ $category->category_id }}">
                          <input type="hidden" name="age_id" value="{{ $age->age_id }}">
                          <input type="hidden" name="class_id" value="{{ $matchclass->class_id }}">
                          <input type="hidden" name="gender" value="{{ $competition->gender }}">
                          
                          @php
                              $athleteCount = match ($category->category_amount) {
                                  'Single' => 1,
                                  'Double' => 2,
                                  'Group' => 3,
                              };
                          @endphp

                          @for ($i = 0; $i < $athleteCount; $i++)
                              <div class="form-group">
                                  <label for="athlete_name_{{ $i }}" class="form-label">Nama Atlet {{ $i + 1 }} <span class="text-danger">*</span></label>
                                  <input type="text" class="form-control @error('athlete_name.'. $i) is-invalid @enderror" id="athlete_name_{{ $i }}" name="athlete_name[]" value="{{ old('athlete_name.'. $i) }}">
                                  @error('athlete_name.'. $i)
                                      <div class="invalid-feedback">{{ $message }}</div>
                                  @enderror
                              </div>
                          @endfor
                        </div>
                        <div class="col-xl-6">
                          
                          <div class="form-group">
                              <label for="contingent_name" class="form-label">Kontingen <span class="text-danger">*</span></label>
                              <input type="text" class="form-control @error('contingent_name') is-invalid @enderror" id="contingent_name" name="contingent_name" value="{{ old('contingent_name') }}">
                              @error('contingent_name') 
                                  <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                          </div>
                      </div>
                  </div>
              </div>
              <div class="card-footer">
                  <button type="submit" name="submit" class="btn btn-primary float-right">Simpan</button>
              </div>
          </form>
          
          
          </div>

          <!-- /.card -->
      </div>
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data Peserta</h3>
    
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
                  
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($participants as $index => $participant)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
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
                            <td>{{ $participant->category->category_name }}</td>
                            <td>{{ $participant->age->age_name }}</td>
                            <td>{{ $participant->gender }}</td>
                            @if ($category->category_type == 'Tanding')
                                <td>{{ $participant->matchclass->class_name }} ({{ $participant->matchclass->class_min }}Kg s/d {{ $participant->matchclass->class_max }}Kg)</td>
                            @endif
                            <td>
                              {{-- <a href="/adminParticipant/participant/edit/{{ $participant->participant_id }}" class="btn btn-primary btn-sm">Ubah<i class="fa fa-pencil ml-2" aria-hidden="true"></i></a> --}}
                              <a href="/adminParticipant/participant/destroy/{{ $participant->participant_id }}" class="btn btn-danger btn-sm" data-confirm-delete="true">Hapus<i class="fa fa-trash ml-2" aria-hidden="true"></i></a>
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

  <script>
    document.querySelector('.custom-file-input').addEventListener('change', function(e) {
      const fileName = e.target.files[0]?.name || 'Choose file';
      e.target.nextElementSibling.innerText = fileName;
    });
  </script>

  

@endsection