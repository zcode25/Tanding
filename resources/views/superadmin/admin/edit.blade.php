@extends('layouts/superadmin')
@section('container')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Supplier</h1>
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
                <h3 class="card-title">Form Update Admin</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="/superadminAdmin/update/{{ $admin->id }}" method="POST" class="form-horizontal">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $admin->name) }}">
                    @error('name') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $admin->email) }}">
                    @error('email') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                    <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $admin->phone) }}">
                    @error('phone') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('address') is-invalid @enderror" rows="3" id="address" name="address">{{ old('address', $admin->address) }}</textarea>
                    @error('address') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <a href="/superadminAdmin" class="btn btn-default">Cancel</a>
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