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
          <div class="col-sm-6">
            <div class="float-sm-right">
              
              <a href="/superadminEvent/create" class="btn btn-primary">Create New</a>
        
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Event List</h3>

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
              <th>Event Name</th>
              <th>Date Created</th>
              <th>Event Description</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
              @foreach ($events as $event)
                <tr>
                  <td>{{ $event->event_name }}</td>
                  <td>{{ $event->created_at->format('Y-m-d') }}</td>
                  <td>{{ $event->event_desc }}</td>
                  <td>
                      <a href="/superadminEvent/edit/{{ $event->event_id }}" class="btn btn-primary btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                      <a href="/superadminEvent/detail/{{ $event->event_id }}" class="btn btn-dark btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></a>
                  </td>
                </tr>
              @endforeach
            </tfoot>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection