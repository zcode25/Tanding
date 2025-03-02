<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="adminDashboard" class="brand-link d-flex align-items-center">
    <i class="fas fa-trophy brand-image elevation-3" style="opacity: .8; font-size: 24px; margin-right: 10px;"></i>
    <span class="brand-text font-weight-light">Tanding</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image d-flex align-items-center">
        <i class="fas fa-user-circle nav-icon img-circle elevation-2" style="font-size: 2.5rem; color: white;"></i>
      </div>
      <div class="info d-flex flex-column justify-content-center ml-3">
        <p class="d-block text-white mb-0">{{ auth()->user()->name }}</p>
      </div>
    </div>


    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="/adminDashboard" class="nav-link {{ Request::is('adminDashboard*') ? 'active' : '' }}">
            <i class="nav-icon fas fa fa-tachometer-alt"></i>
            <p>
              Halaman Utama
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/adminEvent" class="nav-link {{ Request::is('adminEvent*') ? 'active' : '' }}">
            <i class="nav-icon fas fa fa-paper-plane"></i>
            <p>
              Perlombaan
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/adminContingent" class="nav-link {{ Request::is('adminContingent*') ? 'active' : '' }}">
            <i class="nav-icon fas fa fa-globe"></i>
            <p>
              Data Kontingen
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/adminAccount/{{ auth()->user()->id }}" class="nav-link {{ Request::is('adminAccount*') ? 'active' : '' }}">
            <i class="nav-icon fas fa fa-id-card"></i>
            <p>
              Akun Saya
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link" id="logoutLink">
              <i class="far fa-solid fa-arrow-left nav-icon"></i>
              <p>Logout</p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
  <div class="p-3">
    <h5>Title</h5>
    <p>Sidebar content</p>
  </div>
</aside>
<!-- /.control-sidebar -->

<script>
  document.getElementById('logoutLink').addEventListener('click', function(event) {
      event.preventDefault(); // Menghentikan link agar tidak langsung terjadi redirect

      Swal.fire({
          title: 'Apakah kamu yakin?',
          text: "Kamu akan keluar dari sistem.",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya, keluar dari sistem!',
          cancelButtonText: 'Batal'
      }).then((result) => {
          if (result.isConfirmed) {
              window.location.href = '/logout'; // Redirect ke URL logout
          }
      });
  });
</script>
