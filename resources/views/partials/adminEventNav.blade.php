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
          <a href="/adminEvent/detail/{{ $event->event_id }}" class="nav-link {{ Request::is('adminEvent/detail*') ? 'active' : '' }}">
            <i class="nav-icon fas fa fa-paper-plane"></i>
            <p>
              Detail Perlombaan
            </p>
          </a>
        </li>

        <li class="nav-item {{ Request::is('adminEvent/information*', 'adminEvent/document*', 'adminEvent/category*', 'adminEvent/age*', 'adminEvent/competition*') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ Request::is('adminEvent/information*', 'adminEvent/document*', 'adminEvent/category*', 'adminEvent/age*', 'adminEvent/competition*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-id-card"></i>
            <p>
              Info Perlombaan
              <i class="right fas fa fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">

            <li class="nav-item">
              <a href="/adminEvent/information/{{ $event->event_id }}" class="nav-link {{ Request::is('adminEvent/information*') ? 'active' : '' }}">
                <i class="far fa-solid fa-info nav-icon"></i>
                <p>Informasi</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="/adminEvent/document/{{ $event->event_id }}" class="nav-link {{ Request::is('adminEvent/document*') ? 'active' : '' }}">
                <i class="far fa-solid fa-folder nav-icon"></i>
                <p>Dokumen</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="/adminEvent/category/{{ $event->event_id }}" class="nav-link {{ Request::is('adminEvent/category*') ? 'active' : '' }}">
                <i class="far fa-solid fa-cubes nav-icon"></i>
                <p>Pertandingan</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="/adminEvent/age/{{ $event->event_id }}" class="nav-link {{ Request::is('adminEvent/age*') ? 'active' : '' }}">
                <i class="far fa-solid fa-database nav-icon"></i>
                <p>Kategori Umur</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="/adminEvent/competition/{{ $event->event_id }}" class="nav-link {{ Request::is('adminEvent/competition*') ? 'active' : '' }}">
                <i class="far fa-solid fa-star nav-icon"></i>
                <p>Kompetisi</p>
              </a>
            </li>

          </ul>
        </li>

        <li class="nav-item {{ Request::is('adminPayment*', 'adminRegister*') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ Request::is('adminPayment*', 'adminRegister*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-clipboard-list"></i>
            <p>
              Pendaftaran
              <i class="right fas fa fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">

            <li class="nav-item">
              <a href="/adminPayment/{{ $event->event_id }}" class="nav-link {{ Request::is('adminPayment*') ? 'active' : '' }}">
                <i class="nav-icon fas fa fa-credit-card-alt""></i>
                <p>
                  Pembayaran
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="/adminRegister/{{ $event->event_id }}" class="nav-link {{ Request::is('adminRegister*') ? 'active' : '' }}">
                <i class="nav-icon fas fa fa-check-square""></i>
                <p>
                  Data Pendaftaran
                </p>
              </a>
            </li>

          </ul>
        </li>

        
        <li class="nav-item {{ Request::is('adminParticipant*', 'adminDraw*', 'adminBracket*', 'adminMatch*', 'adminMedal*', 'adminRecap*') ? 'menu-open' : '' }}">
          <a href="#" class="nav-link {{ Request::is('adminParticipant*', 'adminDraw*', 'adminBracket*', 'adminMatch*', 'adminMedal*', 'adminRecap*') ? 'active' : '' }}">
            <i class="nav-icon fas fa-hashtag"></i>
            <p>
              Pertandingan
              <i class="right fas fa fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">

            <li class="nav-item">
              <a href="/adminParticipant/{{ $event->event_id }}" class="nav-link {{ Request::is('adminParticipant*') ? 'active' : '' }}">
                <i class="nav-icon fas fa fa-users""></i>
                <p>
                  Daftar Peserta
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="/adminDraw/{{ $event->event_id }}" class="nav-link {{ Request::is('adminDraw*') ? 'active' : '' }}">
                <i class="nav-icon fas fa fa-random""></i>
                <p>
                  Pengundian
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="/adminBracket/{{ $event->event_id }}" class="nav-link {{ Request::is('adminBracket*') ? 'active' : '' }}">
                <i class="nav-icon fas fa fa-code-fork""></i>
                <p>
                  Bagan Tanding
                </p>
              </a>
            </li>
    
            <li class="nav-item">
              <a href="/adminMatch/{{ $event->event_id }}" class="nav-link {{ Request::is('adminMatch*') ? 'active' : '' }}">
                <i class="nav-icon fas fa fa-bolt""></i>
                <p>
                  Penilaian TGR
                </p>
              </a>
            </li>
    
            <li class="nav-item">
              <a href="/adminMedal/{{ $event->event_id }}" class="nav-link {{ Request::is('adminMedal*') ? 'active' : '' }}">
                <i class="nav-icon fas fa fa-trophy""></i>
                <p>
                  Perolehan Medali
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="/adminRecap/{{ $event->event_id }}" class="nav-link {{ Request::is('adminRecap*') ? 'active' : '' }}">
                <i class="nav-icon fas fa fa-star""></i>
                <p>
                  Rekapitulasi Medali
                </p>
              </a>
            </li>

          </ul>
        </li>
        



        <li class="nav-item">
          <a href="/adminEvent" class="nav-link">
              <i class="far fa-solid fa-arrow-left nav-icon"></i>
              <p>Kembali</p>
          </a>
        </li>
        {{-- <li class="nav-item">
          <a href="#" class="nav-link" id="logoutLink">
              <i class="far fa-solid fa-arrow-left nav-icon"></i>
              <p>Logout</p>
          </a>
        </li> --}}
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

