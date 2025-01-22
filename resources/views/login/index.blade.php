@extends('layouts.login')
@section('container')
    <div class="container">
      <div class="row align-items-center justify-content-center" style="min-height: 100vh">
        <div class="col-xl-4 col-md-6">
          <div class="card">
            <div class="card-body p-4">
              <div class="row">
                <div class="col text-center">
                  <h3>Tanding</h3>
                  <p>Selamat datang, silakan masuk.</p>
                  {{-- <hr> --}}
                </div>
              </div>
              
              <div class="row">
                <div class="col">
                  <form action="{{ route('login.authenticate') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                      <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Alamat Email" name="email" autocomplete="off">
                      @error('email') 
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="mb-3">
                      <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Kata Sandi" name="password">
                      @error('password') 
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="d-grid gap-2">
                      <button type="submit" class="btn btn-primary">Masuk</button>
                    </div>
                  </form>
                  <div class="text-center mt-3">
                    <a href="/register" class="btn btn-link text-dark" style="text-decoration: none;">Belum memiliki akun?</a>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> 
@endsection