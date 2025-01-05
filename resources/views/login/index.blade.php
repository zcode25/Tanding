@extends('layouts.login')
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
                  <h3>Tanding</h3>
                  <p>Welcome, please login.</p>
                  <hr>
                </div>
              </div>
              
              <div class="row">
                <div class="col">
                  <form action="{{ route('login.authenticate') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                      <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email Address" name="email" autocomplete="off">
                      @error('email') 
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="mb-3">
                      <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Password" name="password">
                      @error('password') 
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                    <div class="d-grid gap-2">
                      <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                  </form>
                  <div class="text-center mt-3">
                    <a href="/register" class="btn btn-link" style="text-decoration: none;">Don't have an account yet?</a>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> 
@endsection