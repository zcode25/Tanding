@extends('layouts/adminEvent')
@section('container')
    


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Event Information</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xl-6">
            <!-- Horizontal Form -->

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Form Competition Event</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="/adminEvent/competition/store" method="POST" class="form-horizontal">
                @csrf
                <input type="hidden" id="event_id" name="event_id" value="{{ $event->event_id }}">
                <div class="card-body">
                  <div class=" form-group">
                    <label for="competition_type" class="form-label">Competition Type <span class="text-danger">*</span></label>
                    <select class="form-control select2bs4 @error('competition_type') is-invalid @enderror" id="competition_type" name="competition_type" data-placeholder="Select a Competition Type">
                      <option value=""></option>
                      @foreach ($competition_types as $competition_type)
                        @if (old('competition_type') == $competition_type['type'])
                          <option value="{{ $competition_type['type'] }}" selected>{{ $competition_type['type'] }}</option>
                        @else
                          <option value="{{ $competition_type['type'] }}">{{ $competition_type['type'] }}</option>
                        @endif
                      @endforeach
                    </select>
                    @error('status') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class=" form-group">
                    <label for="age_group" class="form-label">Age Group <span class="text-danger">*</span></label>
                    <select class="form-control select2bs4 @error('age_group') is-invalid @enderror" id="age_group" name="age_group" data-placeholder="Select a Competition Type">
                      <option value=""></option>
                      @foreach ($age_groups as $age_group)
                        @if (old('age_group') == $age_group['type'])
                          <option value="{{ $age_group['type'] }}" selected>{{ $age_group['type'] }}</option>
                        @else
                          <option value="{{ $age_group['type'] }}">{{ $age_group['type'] }}</option>
                        @endif
                      @endforeach
                    </select>
                    @error('age_group') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class=" form-group">
                    <label for="gender" class="form-label">Gender <span class="text-danger">*</span></label>
                    <select class="form-control select2bs4 @error('gender') is-invalid @enderror" id="gender" name="gender" data-placeholder="Select a Competition Type">
                      <option value=""></option>
                      @foreach ($genders as $gender)
                        @if (old('gender') == $gender['type'])
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
                    <label for="price" class="form-label">Price <span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') }}">
                    @error('price') 
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="d-grid gap-2">
                    <button type="submit" name="submit" class="btn btn-primary btn-block">Add</button>
                  </div>

                  <hr>

                  <table class="table table-sm">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Competition type</th>
                        <th>Age Group</th>
                        <th>Gender</th>
                        <th>Price</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php
                          $i = 1;
                      @endphp
                      @foreach ($competitions as $competition)
                      <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ $competition->competition_type }}</td>
                        <td>{{ $competition->age_group }}</td>
                        <td>{{ $competition->gender }}</td>
                        <td>Rp {{ number_format($competition->price, 0, ',', '.') }}</td>
                        <td>
                          {{-- <a href="{{ asset('storage/' . $document->document) }}" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-download" aria-hidden="true"></i></a> --}}
                          <a href="/adminEvent/competition/destroy/{{ $competition->competition_id }}" class="btn btn-danger btn-sm" data-confirm-delete="true"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
    
                  
                </div>
                <!-- /.card-body -->
                {{-- <div class="card-footer">
                  <button type="submit" name="submit" class="btn btn-primary float-right">Save</button>
                </div> --}}
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

  <script>
    document.querySelector('.custom-file-input').addEventListener('change', function(e) {
      const fileName = e.target.files[0]?.name || 'Choose file';
      e.target.nextElementSibling.innerText = fileName;
    });
  </script>

</script>

  @endsection

  