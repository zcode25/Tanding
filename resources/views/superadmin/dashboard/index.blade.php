@extends('layouts/superadmin')
@section('container')
    


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
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
          <div class="col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $countAdmin }}</h3>

                <p>Total Admin</p>
              </div>
              <div class="icon">
                <i class="fa-solid fa-user"></i>
              </div>
            </div>
          </div>
          <div class="col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ $countEvent }}</h3>

                <p>Total Event</p>
              </div>
              <div class="icon">
                <i class="fa-regular fa-paper-plane"></i>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xl-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Info Detail</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
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

  