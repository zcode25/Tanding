@extends('layouts/superadmin')
@section('container')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Admin</h1>
          </div>
          <div class="col-sm-6">
            <div class="float-sm-right">
              
              <a href="/superadminAdmin/create" class="btn btn-primary">Create New</a>
        
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
          <h3 class="card-title">Admin List</h3>

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
              <th>Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Address</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody>
              @foreach ($admins as $admin)
              <tr>
                <td>{{ $admin->name }}</td>
                <td>{{ $admin->email }}</td>
                <td>{{ $admin->phone }}</td>
                <td>{{ $admin->address }}</td>
                
                <td class="py-0 align-middle">
                    <a href="/superadminAdmin/edit/{{ $admin->id }}" class="btn btn-primary btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                    <a href="/superadminAdmin/destroy/{{ $admin->id }}" class="btn btn-danger btn-sm" data-confirm-delete="true"><i class="fa fa-trash" aria-hidden="true"></i></a>
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