@extends('layouts/superadmin')
@section('container')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Event</h1>
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
                <h3 class="card-title">Form Edit Event</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="/superadminEvent/update/{{ $event->event_id }}" method="POST" class="form-horizontal">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="event_name" class="form-label">Event Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('event_name') is-invalid @enderror" id="event_name" name="event_name" value="{{ old('event_name', $event->event_name) }}">
                    @error('event_name') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="event_desc" class="form-label">Event Description <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('event_desc') is-invalid @enderror" rows="3" id="event_desc" name="event_desc">{{ old('event_desc', $event->event_desc) }}</textarea>
                    @error('event_desc') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <a href="/superadminEvent" class="btn btn-default">Cancel</a>
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