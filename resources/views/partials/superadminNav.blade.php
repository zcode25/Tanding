<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="superadminDashboard" class="brand-link d-flex align-items-center">
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
          <a href="/superadminDashboard" class="nav-link {{ Request::is('superadminDashboard*') ? 'active' : '' }}">
            <i class="nav-icon fas fa fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/superadminAdmin" class="nav-link {{ Request::is('superadminAdmin*') ? 'active' : '' }}">
            <i class="nav-icon fas fa fa-user"></i>
            <p>
              Admin
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/superadminEvent" class="nav-link {{ Request::is('superadminEvent*') ? 'active' : '' }}">
            <i class="nav-icon fas fa fa-paper-plane"></i>
            <p>
              Event
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
          title: 'Are you sure?',
          text: "You will be logged out.",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, log me out!'
      }).then((result) => {
          if (result.isConfirmed) {
              window.location.href = '/logout'; // Redirect ke URL logout
          }
      });
  });
</script>
