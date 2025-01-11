@extends('layouts/superadmin')
@section('container')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Age Group</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xl-6">
            <!-- Horizontal Form -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Form Create Age Group</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="/superadminAge/store" method="POST" class="form-horizontal">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="age_name" class="form-label">Age Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('age_name') is-invalid @enderror" id="age_name" name="age_name" value="{{ old('age_name') }}">
                    @error('age_name') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>


                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <a href="/superadminAge" class="btn btn-default">Cancel</a>
                  <button type="submit" name="submit" class="btn btn-primary float-right">Save</button>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
            <!-- /.card -->
        </div>
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection