@extends('layouts/superadmin')
@section('container')
    


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Halaman Utama</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-3">
            <!-- small box -->
            <div class="small-box bg-dark">
              <div class="inner">
                <h3>{{ $countAdmin }}</h3>

                <p>Jumlah Admin</p>
              </div>
              <div class="icon">
                <i class="fa-solid fa-user"></i>
              </div>
            </div>
          </div>
          <div class="col-3">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3>{{ $countContingent }}</h3>

                <p>Jumlah Kontingen</p>
              </div>
              <div class="icon">
                <i class="fa-solid fa-globe"></i>
              </div>
            </div>
          </div>
          <div class="col-3">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{ $countAthlete }}</h3>

                <p>Jumlah Atlet</p>
              </div>
              <div class="icon">
                <i class="fa-solid fa-users"></i>
              </div>
            </div>
          </div>
          <div class="col-3">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ $countEvent }}</h3>

                <p>Jumlah Perlombaan</p>
              </div>
              <div class="icon">
                <i class="fa-regular fa-paper-plane"></i>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xl-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Sistem Informasi Pencak Silat</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                  <p>
                    Sistem Informasi Pencak Silat adalah platform digital yang dirancang untuk mempermudah pengelolaan berbagai aspek dalam kegiatan pencak silat. Dengan fitur yang lengkap, sistem ini memberikan solusi modern untuk memanajemen event, data atlet, serta komunikasi antar pihak yang terlibat.
                </p>
        
                <p>Fitur Utama</p>
                <ul>
                    <li><strong>Manajemen Pengguna</strong> <br> Login, logout, dan pengelolaan admin untuk memonitor aktivitas sistem.</li>
                    <li><strong>Manajemen Atlet</strong> <br> Registrasi akun, pengelolaan data atlet, pendaftaran peserta, dan approval data.</li>
                    <li><strong>Manajemen Event</strong> <br> Mengatur informasi event, membuka/menutup pendaftaran, melihat status event, mengelola jadwal, dan bagan pertandingan.</li>
                    <li><strong>Komunikasi dan Laporan</strong> <br> Kirim informasi via WhatsApp, lihat rekapitulasi medali, dan akses invoice terkait.</li>
                </ul>
                </div>
                <!-- /.card-body -->
            </div>
          </div>
          <div class="col-xl-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Daftar Perlombaan (Active)</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-hover">
                    <thead>
                    <tr>
                      <th>Nama Perlombaan</th>
                      <th>Tanggal Dibuat</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach ($events as $event)
                        <tr>
                          <td>{{ $event->event_name }}</td>
                          <td>{{ $event->created_at->format('Y-m-d') }}</td>
                        </tr>
                      @endforeach
                    </tfoot>
                  </table>
                </div>
                <!-- /.card-body -->
            </div>
          </div>
        </div>

        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  @endsection

  