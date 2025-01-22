@extends('layouts/superadmin')
@section('container')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Kategori Umur</h1>
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
                <h3 class="card-title">Data Kategori Umur</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="/superadminAge/class/store" method="POST" class="form-horizontal">
                @csrf
                <input type="hidden" id="age_id" name="age_id" value="{{ $age->age_id }}">
                <div class="card-body">
                  <div class="form-group">
                    <label for="class_name" class="form-label">Kelas <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('class_name') is-invalid @enderror" id="class_name" name="class_name" value="{{ old('class_name') }}">
                    @error('class_name') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class=" form-group">
                    <label for="class_gender" class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                    <select class="form-control select2bs4 @error('class_gender') is-invalid @enderror" id="class_gender" name="class_gender" data-placeholder="Pilih Jenis Kelamin">
                      <option value=""></option>
                      @foreach ($genders as $gender)
                        @if (old('class_gender') == $gender['type'])
                          <option value="{{ $gender['type'] }}" selected>{{ $gender['type'] }}</option>
                        @else
                          <option value="{{ $gender['type'] }}">{{ $gender['type'] }}</option>
                        @endif
                      @endforeach
                    </select>
                    @error('gender') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="class_min" class="form-label">Minimal (Kg) <span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error('class_min') is-invalid @enderror" id="class_min" name="class_min" value="{{ old('class_min') }}">
                    @error('class_min') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="class_max" class="form-label">Maksimal (Kg) <span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error('class_max') is-invalid @enderror" id="class_max" name="class_max" value="{{ old('class_max') }}">
                    @error('class_max') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>


                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  {{-- <a href="/superadminAge" class="btn btn-default">Cancel</a> --}}
                  <button type="submit" name="submit" class="btn btn-primary float-right">Simpan</button>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
            <!-- /.card -->
        </div>
        <div class="col-xl-6">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Daftar Kelas</h3>
    
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
                  <th>Kelas</th>
                  <th>Jenis Kelamin</th>
                  <th>Minimal</th>
                  <th>Maksimal</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($classes as $class)
                    <tr>
                      <td>{{ $class->class_name }}</td>
                      <td>{{ $class->class_gender }}</td>
                      <td>{{ $class->class_min }} Kg</td>
                      <td>{{ $class->class_max }} Kg</td>
                      <td>
                          <a href="/superadminAge/class/destroy/{{ $class->class_id }}" class="btn btn-danger btn-sm" data-confirm-delete="true">Hapus<i class="fa fa-trash ml-2" aria-hidden="true"></i></a>
                      </td>
                    </tr>
                  @endforeach
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection