@extends('layouts/superadmin')
@section('container')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Category</h1>
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
                <h3 class="card-title">Form Create Category</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="/superadminCategory/update/{{ $category->category_id }}" method="POST" class="form-horizontal">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="category_name" class="form-label">Category Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('category_name') is-invalid @enderror" id="category_name" name="category_name" value="{{ old('category_name', $category->category_name) }}">
                    @error('category_name') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class=" form-group">
                    <label for="category_type" class="form-label">Category Type <span class="text-danger">*</span></label>
                    <select class="form-control select2bs4 @error('category_type') is-invalid @enderror" id="category_type" name="category_type" data-placeholder="Select a category type">
                      <option value=""></option>
                      @foreach ($types as $type)
                        @if (old('type', $category->category_type) == $type['type'])
                          <option value="{{ $type['type'] }}" selected>{{ $type['type'] }}</option>
                        @else
                          <option value="{{ $type['type'] }}">{{ $type['type'] }}</option>
                        @endif
                      @endforeach
                    </select>
                    @error('status') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class=" form-group">
                    <label for="category_amount" class="form-label">Category Amount <span class="text-danger">*</span></label>
                    <select class="form-control select2bs4 @error('category_amount') is-invalid @enderror" id="category_amount" name="category_amount" data-placeholder="Select a category amount">
                      <option value=""></option>
                      @foreach ($amounts as $amount)
                        @if (old('category_amount', $category->category_amount) == $amount['type'])
                          <option value="{{ $amount['type'] }}" selected>{{ $amount['type'] }}</option>
                        @else
                          <option value="{{ $amount['type'] }}">{{ $amount['type'] }}</option>
                        @endif
                      @endforeach
                    </select>
                    @error('category_amount') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <a href="/superadminCategory" class="btn btn-default">Cancel</a>
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