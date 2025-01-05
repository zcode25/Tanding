@extends('layouts.register')
@section('container')
    <div class="container">
      <div class="row align-items-center justify-content-center" style="min-height: 100vh">
        <div class="col-xl-4 col-md-6">
          <div class="row">
            <div class="col">
              @if (session()->has('loginError'))  
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  {{ session('loginError') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              @endif
            </div>
          </div>
          <div class="card">
            <div class="card-body p-4">
              <div class="row">
                <div class="col text-center">
                  <h3>Register</h3>
                  <hr>
                </div>
              </div>
              
              <div class="row">
                <div class="col">
                  <form action="/register/store" method="POST">
                    @csrf
                    <div class="mb-3">
                      <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Name" name="name" autocomplete="off">
                      @error('name') 
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="mb-3">
                      <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email Address" name="email" autocomplete="off">
                      @error('email') 
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="mb-3">
                      <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" placeholder="Phone" name="phone" autocomplete="off">
                      @error('phone') 
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="mb-3">
                      <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" placeholder="Address" name="address" autocomplete="off">
                      @error('address') 
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="mb-3">
                      <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password" name="password">
                      @error('password') 
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                    <hr>
                    <div class="mb-3">
                      <input type="text" class="form-control @error('kontingen_name') is-invalid @enderror" id="kontingen_name" placeholder="Kontingen Name" name="kontingen_name" autocomplete="off">
                      @error('kontingen_name') 
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="mb-3">
                      {{-- <label for="province" class="form-label">Province</label> --}}
                      <select class="form-select @error('province') is-invalid @enderror" id="province" name="province">
                        <option value="" disabled selected>Select a Province Kontingen</option>
                        <!-- Options akan diisi secara dinamis -->
                      </select>
                      @error('province') 
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="mb-3">
                      <select class="form-select @error('city') is-invalid @enderror" id="city" name="city">
                        <option value="" disabled selected>Select a City Kontingen</option>
                        <!-- Options akan diisi secara dinamis -->
                      </select>
                      @error('city') 
                          <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                  </div>

                    <div class="d-grid gap-2">
                      <button type="submit" name="submit" class="btn btn-primary">Register</button>
                    </div>
                  </form>
                  <div class="text-center mt-3">
                    <a href="/login" class="btn btn-link" style="text-decoration: none;">Already an account?</a>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> 

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
            citySelect.innerHTML = '<option value="" disabled selected>Select a City Kontingen</option>';

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