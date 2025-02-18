@extends('layouts/adminEvent')
@section('container')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-4">
              <h1 class="mb-2">Pengundian Peserta</h1>
              <p>{{ $category->category_name }} / {{ $age->age_name }} / {{ $competition->gender }}</p>
          </div>
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
                        <th>Nomor Undian</th>
                        <th>Atlet</th>
                        <th>Kontingen</th>
                        <th>Kategori Pertandingan</th>
                        <th>Kategori Umur</th>
                        <th>Jenis Kelamin</th>
                        @if ($category->category_type == 'Tanding')
                        <th>Kelas</th>
                        @endif
                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($participants as $index => $participant)
                        <tr>
                          <td id="draw-{{ $participant->participant_id }}" class="text-center h5 text-bold">
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
                            <td>{{ $participant->category->category_name }}</td>
                            <td>{{ $participant->age->age_name }}</td>
                            <td>{{ $participant->gender }}</td>
                            @if ($category->category_type == 'Tanding')
                                <td>{{ $participant->matchclass->class_name }} - {{ $participant->matchclass->class_gender }} ({{ $participant->matchclass->class_min }}Kg s/d {{ $participant->matchclass->class_max }}Kg)</td>
                            @endif
                        </tr>
                    @endforeach
                    <button id="draw-button" class="btn btn-primary">Pengundian Peserta <i class="fa fa-random ml-2" aria-hidden="true"></i></button>
                    <button id="save-button" class="btn btn-dark ml-2" disabled>Simpan</button>
                    <a href="/adminDraw/draw/tgrExport/{{ $competition->competition_id }}" class="btn btn-success ml-2">Download</a>
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

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
      let drawCount = 0; 
      let drawResults = {}; // Menyimpan hasil drawing sementara
      
      $(document).ready(function() {
          $('#draw-button').click(function() {
              // if (drawCount >= 3) {
              //     alert("Maksimal drawing 3 kali!");
              //     return;
              // }
  
              let participants = @json($participants);
              let shuffled = shuffleArray(participants);
              drawResults = {}; // Reset hasil drawing sementara
              
              // Animasikan setiap row
              let i = 1;
              shuffled.forEach((participant, index) => {
                  let participantId = participant.participant_id;
                  let drawCell = $(`#draw-${participantId}`);
                  let isDrawnCell = $(`#is_drawn-${participantId}`);
  
                  // Animasi Rolling Number
                  let counter = 0;
                  let interval = setInterval(() => {
                      drawCell.text(Math.floor(Math.random() * 100)); // Acak angka sementara
                      counter++;
                      if (counter > 10) {
                          clearInterval(interval);
                          drawCell.text(i); // Set nilai akhir
                          drawResults[participantId] = i; // Simpan hasil sementara
                          i++;
                      }
                  }, 100);
                  
                  isDrawnCell.text('Yes'); // Update status draw
              });
  
              drawCount++;
              $('#save-button').prop('disabled', false); // Aktifkan tombol Save
          });
  
          $('#save-button').click(function() {
              $.ajax({
                  url: "{{ route('draw.save') }}",
                  method: "POST",
                  data: {
                      _token: "{{ csrf_token() }}",
                      results: drawResults
                  },
                  success: function(response) {
                      // Use SweetAlert for success message
                      Swal.fire({
                          icon: 'success',
                          title: 'Drawing berhasil disimpan!',
                          text: 'Hasil undian telah berhasil disimpan.',
                          confirmButtonText: 'OK'
                      }).then(function() {
                          // Reload the page after SweetAlert is closed
                          window.location.reload();
                      });
                      $('#save-button').prop('disabled', true);
                  },
                  error: function() {
                      // Use SweetAlert for error message
                      Swal.fire({
                          icon: 'error',
                          title: 'Terjadi kesalahan!',
                          text: 'Coba lagi nanti.',
                          confirmButtonText: 'OK'
                      });
                  }
              });
          });
  
      });
  
      function shuffleArray(array) {
          let shuffled = array.slice();
          for (let i = shuffled.length - 1; i > 0; i--) {
              let j = Math.floor(Math.random() * (i + 1));
              [shuffled[i], shuffled[j]] = [shuffled[j], shuffled[i]];
          }
          return shuffled;
      }
  </script>
  

@endsection