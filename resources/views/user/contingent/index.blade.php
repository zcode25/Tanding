@extends('layouts/user')
@section('container')
    


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Contingent</h1>
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
                <h3 class="card-title">Form Contingent</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="/userContingent/update/{{ $contingent->contingent_id }}" method="POST" class="form-horizontal">
                @csrf
                <div class="card-body">
                    <!-- Contingent Name -->
                    <div class="form-group">
                        <label for="contingent_name" class="form-label">Contingent Name <span class="text-danger">*</span></label>
                        <input 
                            type="text" 
                            class="form-control @error('contingent_name') is-invalid @enderror" 
                            id="contingent_name" 
                            name="contingent_name" 
                            value="{{ old('contingent_name', $contingent->contingent_name ?? '') }}" 
                            required>
                        @error('contingent_name') 
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
            
                    <!-- Province -->
                    <div class="form-group">
                        <label for="province" class="form-label">Province <span class="text-danger">*</span></label>
                        <select 
                            name="province" 
                            id="province" 
                            class="form-control @error('province') is-invalid @enderror" 
                            required>
                            <option value="" disabled selected>Select a Province</option>
                            @foreach ($provinces as $id => $name)
                                <option 
                                    value="{{ $id }}" 
                                    {{ old('province', $contingent->province ?? '') == $id ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                        @error('province') 
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
            
                    <!-- City -->
                    <div class="form-group">
                        <label for="city" class="form-label">City <span class="text-danger">*</span></label>
                        <select 
                            name="city" 
                            id="city" 
                            class="form-control @error('city') is-invalid @enderror" 
                            required>
                            <option value="" disabled selected>Select a City</option>
                            @foreach ($cities as $id => $name)
                                <option 
                                    value="{{ $id }}" 
                                    {{ old('city', $contingent->city ?? '') == $id ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                        @error('city') 
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            
                <!-- Submit Button -->
                <div class="card-footer">
                    <button type="submit" name="submit" class="btn btn-primary float-right">Save</button>
                </div>
            </form>
            
            </div>

            <!-- /.card -->
        </div>
        <div class="col-xl-6">
          <!-- Horizontal Form -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Form User</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="/userContingent/user/update/{{ $user->id }}" method="POST" class="form-horizontal">
              @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}">
                  @error('name') 
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                  <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}">
                  @error('email') 
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                  <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $user->phone) }}">
                  @error('phone') 
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                  <textarea class="form-control @error('address') is-invalid @enderror" rows="3" id="address" name="address">{{ old('address', $user->address) }}</textarea>
                  @error('address') 
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>

              </div>
              <!-- /.card-body -->
              <div class="card-footer">
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

  {{-- <script>
    document.getElementById('province').addEventListener('change', function () {
    const provinceId = this.value;
    const citySelect = document.getElementById('city');

    // Clear existing options
    citySelect.innerHTML = '<option value="" disabled selected>Select a City</option>';

    if (provinceId) {
        fetch(`/api/cities/${provinceId}`)
            .then(response => response.json())
            .then(data => {
                data.forEach(city => {
                    const option = document.createElement('option');
                    option.value = city.id;
                    option.textContent = city.name;
                    citySelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error fetching cities:', error));
    }
  });
  </script> --}}

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const provinceSelect = document.getElementById('province');
      const citySelect = document.getElementById('city');

      // Load data provinsi
      fetch('/json/provinces.json')
          .then(response => response.json())
          .then(provinces => {
              Object.entries(provinces).forEach(([id, name]) => {
                  const option = document.createElement('option');
                  option.value = id;
                  option.textContent = name;
                  provinceSelect.appendChild(option);
              });
          });

      // Event listener untuk perubahan provinsi
      provinceSelect.addEventListener('change', function () {
          const provinceId = this.value;

          // Reset dropdown kota
          citySelect.innerHTML = '<option value="" disabled selected>Select a City Continget</option>';

          if (provinceId) {
              // Load data kota berdasarkan ID provinsi
              const cityFileName = `kab-${provinceId}.json`; // File JSON sesuai format
              fetch(`/json/cities/${cityFileName}`)
                  .then(response => {
                      if (!response.ok) {
                          throw new Error('File kota tidak ditemukan');
                      }
                      return response.json();
                  })
                  .then(cities => {
                      Object.entries(cities).forEach(([id, name]) => {
                          const option = document.createElement('option');
                          option.value = id;
                          option.textContent = name;
                          citySelect.appendChild(option);
                      });
                  })
                  .catch(error => {
                      console.error('Error loading city data:', error);
                      alert('Data kota tidak ditemukan untuk provinsi yang dipilih.');
                  });
          }
      });
  });
  </script>


  @endsection

  