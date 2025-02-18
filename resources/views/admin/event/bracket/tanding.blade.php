@extends('layouts.adminEvent')

@section('container')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-4">
                    <h1 class="mb-2">Bagan Pertandingan</h1>
                    <p>{{ $category->category_name }} / {{ $age->age_name }} / {{ $competition->gender }} / {{ $matchclass->class_name }} ({{ $matchclass->class_min }}Kg s/d {{ $matchclass->class_max }}Kg)</p>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Bagan Pertandingan</h3>
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
                                    <th>Nomor Undian</th>
                                    <th>Atlet</th>
                                    <th>Kontingen</th>
                                    @if ($category->category_type == 'Tanding')
                                        <th>Kelas</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($participants as $participant)
                                    <tr>
                                        <td class="text-center">{{ $participant->draw_number ?? '-' }}</td>
                                        <td>
                                            @php
                                                $athletes = json_decode($participant->athlete_name, true);
                                            @endphp
                                            {{ is_array($athletes) ? implode(', ', $athletes) : $participant->athlete_name }}
                                        </td>
                                        <td>{{ $participant->contingent_name }}</td>
                                        @if ($category->category_type == 'Tanding')
                                            <td>{{ $participant->matchclass->class_name }} ({{ $participant->matchclass->class_min }}Kg s/d {{ $participant->matchclass->class_max }}Kg)</td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
              <div class="card">
                  <div class="card-header">
                      <h3 class="card-title">Bagan Pertandingan</h3>
                  </div>
                  <form action="/adminBracket/bracket/store" method="POST" class="form-horizontal">
                      @csrf
                      <input type="hidden" id="event_id" name="event_id" value="{{ $event->event_id }}">
                      <input type="hidden" id="competition_id" name="competition_id" value="{{ $competition->competition_id }}">
                      <input type="hidden" id="class_id" name="class_id" value="{{ $matchclass->class_id }}">
  
                      <div class="card-body">
                          <div class="form-group">
                              <label for="format">Format Bagan <span class="text-danger">*</span></label>
                              <select class="form-control @error('format') is-invalid @enderror" id="format" name="format">
                                <option value="" disabled selected>Pilih Format Bagan</option>
                                @foreach ($types as $type)
                                  <option value="{{ $type['type'] }}" {{ old('format') == $type['type'] ? 'selected' : '' }}>
                                      {{ $type['type'] }}
                                  </option>
                                @endforeach
                              </select>
                              @error('format')
                                  <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                          </div>
  
                          <div class="form-group">
                              <label for="total_participants">Total Peserta <span class="text-danger">*</span></label>
                              <input type="number" class="form-control @error('total_participants') is-invalid @enderror" id="total_participants" name="total_participants" value="{{ old('total_participants') }}">
                              @error('total_participants')
                                  <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                          </div>
  
                          <div class="form-group" id="pool-group" style="display: none;">
                              <label for="total_pools">Total Pool <span class="text-danger">*</span></label>
                              <input type="number" class="form-control @error('total_pools') is-invalid @enderror" id="total_pools" name="total_pools" value="{{ old('total_pools') }}">
                              @error('total_pools')
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
                    <h3 class="card-title">Bagan Pertandingan</h3>
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
                                <th>Format</th>
                                <th>Total Peserta</th>
                                <th>Total Pool</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($brackets as $bracket)
                            <tr>
                              <td>{{ $bracket->format }}</td>
                              <td>{{ $bracket->total_participants }}</td>
                              @if ($bracket->total_pools)
                                <td>{{ $bracket->total_pools }}</td>
                              @else
                                <td>-</td>
                              @endif
                              
                              <td class="py-0 align-middle">
                                <a href="/adminBracket/bracket/participant/{{ $bracket->bracket_id }}" class="btn btn-dark btn-sm">Detail<i class="fa fa-eye ml-2" aria-hidden="true"></i></a>
                                <a href="/adminBracket/bracket/destroy/{{ $bracket->bracket_id }}" class="btn btn-danger btn-sm" data-confirm-delete="true">Hapus<i class="fa fa-trash ml-2" aria-hidden="true"></i></a>
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                    </table>
                </div>
              </div>
            </div>

            
        </div>
    </section>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const formatSelect = document.getElementById("format");
        const poolGroup = document.getElementById("pool-group");

        function togglePoolInput() {
            poolGroup.style.display = formatSelect.value === "Pool" ? "block" : "none";
        }

        togglePoolInput();
        formatSelect.addEventListener("change", togglePoolInput);
    });
</script>
@endsection
