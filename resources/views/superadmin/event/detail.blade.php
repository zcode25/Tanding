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
              <h3 class="card-title">Event Detail</h3>
            </div>
            <!-- /.card-header -->
              <div class="card-body">
                <div class="mb-3">
                  <p class="mb-2 font-weight-bold">Event Name</p>
                  <p>{{ $event->event_name }}</p>
                </div>
                <div class="mb-3">
                  <p class="mb-2 font-weight-bold">Event Description</p>
                  <p>{{ $event->event_desc }}</p>
                </div>
                <div class="mb-3">
                  <p class="mb-2 font-weight-bold">Event Date</p>
                  <p>{{ $event->created_at->format('Y-m-d') }}</p>
                </div>
                <div class="mb-3">
                  <p class="mb-2 font-weight-bold">Event Status</p>
                  <p>{{ $event->event_status }}</p>
                </div>
              </div>
              <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <div class="col-xl-6">
            <!-- Horizontal Form -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Form Select Admin</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="/superadminEvent/admin/store/" method="POST" class="form-horizontal">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <input type="hidden" id="event_id" name="event_id" value="{{ $event->event_id }}">
                    <label for="user_id" class="form-label">Admin <span class="text-danger">*</span></label>
                    <select class="form-control select2bs4" id="user_id" name="user_id" data-placeholder="Select a Admin">
                      <option value=""></option>
                      @foreach ($admins as $admin)
                          @if (old('admin_id') == $admin->id)
                              <option value="{{ $admin->id }}" selected>{{ $admin->name }}</option>
                              @else
                              <option value="{{ $admin->id }}">{{ $admin->name }}</option>
                          @endif
                      @endforeach
                    </select>
                  </div>
                  <div class="d-grid gap-2">
                    <button type="submit" name="submit" class="btn btn-primary btn-block">Add</button>
                  </div>
                  <hr>
                  {{-- @php
                      dd(count($assetProcurementDevices))
                  @endphp --}}
                  {{-- @if (count($assetProcurementDevices) > 0) --}}
                  <table class="table table-sm">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Admin</th>
                        <th>Email Address</th>
                        <th>Phone</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php
                          $i = 1;
                      @endphp
                      @foreach ($administrators as $administrator)
                      <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $administrator->user->name }}</td>
                        <td>{{ $administrator->user->email }}</td>
                        <td>{{ $administrator->user->phone }}</td>
                        <td>
                          <a href="/superadminEvent/admin/destroy/{{ $administrator->administrator_id }}" class="btn btn-danger btn-sm" data-confirm-delete="true"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  {{-- @else
                    <p class="text-center">No data available in table</p>
                  @endif --}}
                  
                </div>
              </form>
                <!-- /.card-body -->
                <div class="card-footer">
                  <a href="/superadminEvent" class="btn btn-default">Back</a>
                  {{-- <a href="/assetProcurement/save/" class="btn btn-success float-right">Save</a> --}}
                </div>
                <!-- /.card-footer -->
            </div>
            <!-- /.card -->
        </div>
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection