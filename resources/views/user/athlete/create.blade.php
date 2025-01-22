@extends('layouts/user')
@section('container')
    


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Data Atlet</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xl-12">
            <!-- Horizontal Form -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Atlet</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="/userAthlete/store" method="POST" class="form-horizontal"  enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="row">
                    <div class="col-xl-6">
                      <div class="form-group">
                        <label for="athlete_name" class="form-label">Nama Atlet <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('athlete_name') is-invalid @enderror" id="athlete_name" name="athlete_name" value="{{ old('athlete_name') }}">
                        @error('athlete_name') 
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
    
                      <div class=" form-group">
                        <label for="athlete_gender" class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                        <select class="form-control select2bs4 @error('athlete_gender') is-invalid @enderror" id="athlete_gender" name="athlete_gender" data-placeholder="Pilih Jenis Kelamin">
                          <option value=""></option>
                          @foreach ($genders as $gender)
                            @if (old('athlete_gender') == $gender['type'])
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
                        <label for="date_birth" class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('date_birth') is-invalid @enderror" id="date_birth" name="date_birth" value="{{ old('date_birth') }}">
                        @error('date_birth') 
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
    
                      <div class="form-group">
                        <label for="place_birth" class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('place_birth') is-invalid @enderror" id="place_birth" name="place_birth" value="{{ old('place_birth') }}">
                        @error('place_birth') 
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
    
                      <div class="form-group">
                        <label for="nik" class="form-label">Nomor Induk Kependudukan (NIK) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nik') is-invalid @enderror" id="nik" name="nik" value="{{ old('nik') }}">
                        @error('nik') 
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                    <div class="col-xl-6">
                      <div class="form-group">
                        <label for="weight" class="form-label">Berat Badan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('weight') is-invalid @enderror" id="weight" name="weight" value="{{ old('weight') }}">
                        @error('weight') 
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                      
                      <div class="form-group">
                        <label for="height" class="form-label">Tinggi Badan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('height') is-invalid @enderror" id="height" name="height" value="{{ old('height') }}">
                        @error('height') 
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
    
                      <div class="form-group">
                        <label for="school_name" class="form-label">Nama Sekolah <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('school_name') is-invalid @enderror" id="school_name" name="school_name" value="{{ old('school_name') }}">
                        @error('school_name') 
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
    
                      <div class=" form-group">
                        <label for="age_id" class="form-label">Kategori Umur <span class="text-danger">*</span></label>
                        <select class="form-control select2bs4 @error('age_id') is-invalid @enderror" id="age_id" name="age_id" data-placeholder="Pilih Kategori Umur">
                          <option value=""></option>
                          @foreach ($ages as $age)
                            @if (old('age_id') == $age->age_id)
                              <option value="{{ $age->age_id }}" selected>{{ $age->age_name }}</option>
                            @else
                              <option value="{{ $age->age_id }}">{{ $age->age_name }}</option>
                            @endif
                          @endforeach
                        </select>
                        @error('age_id') 
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
    
                      <div class="form-group">
                        <label class="form-label">Foto Atlet</label>
                        <div class="input-group  @error('athlete_photo') is-invalid @enderror">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input @error('athlete_photo') is-invalid @enderror" id="inputGroupFile04" name="athlete_photo" aria-describedby="inputGroupFileAddon04">
                            <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                          </div>
                        </div>
                        @error('athlete_photo')
                          <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                      </div>
                    </div>
                  </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  {{-- <a href="/superadminAdmin" class="btn btn-default">Cancel</a> --}}
                  <button type="submit" name="submit" class="btn btn-primary float-right">Simpan</button>
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

  <script>
    document.querySelector('.custom-file-input').addEventListener('change', function(e) {
      const fileName = e.target.files[0]?.name || 'Choose file';
      e.target.nextElementSibling.innerText = fileName;
    });
  </script>



  @endsection

  