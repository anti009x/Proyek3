@section('navbar')
<div class="d-flex flex-column">
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">
    <div class="container-fluid">
    
      <a class="navbar-brand text-bold d-flex align-items-center" href="#">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-box-arrow-right me-2" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z"/>
              <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
          </svg>
          <span class="text-bold">Monitoring Sistem AntarIn</span>
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ route('admin.dashboard') }}">
              <i class="bi bi-house-fill me-1"></i>Home
            </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="menuDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-list-ul me-1"></i>Pilih Menu
            </a>
            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="menuDropdown">
              {{-- <li><a class="dropdown-item" href="{{ route('admin.konsumen') }}"><i class="bi bi-book-fill me-2"></i>Data Akun</a></li> --}}
              {{-- <li><a class="dropdown-item" href="{{ route('DataAkun') }}"><i class="bi bi-book-fill me-2"></i>Data Akun</a></li> --}}
              <li><a class="dropdown-item" href="{{ route('ServerStatus') }}"><i class="bi bi-book-fill me-2"></i>Server Status</a></li>
              <li><a class="dropdown-item" href="{{ route('admin.profile') }}"><i class="bi bi-person-fill me-2"></i>Profile</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#"><i class="bi bi-gear-fill me-2"></i>Settings</a></li>
            </ul>
          </li>
        </ul>
        {{-- <form class="d-flex ms-3" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-light" type="submit">
            <i class="bi bi-search"></i>
          </button>
        </form> --}}
        <!-- Notification Button -->
        <button type="button" class="btn btn-outline-light ms-3" data-bs-toggle="modal" data-bs-target="#changeLogModal">
          <i class="bi bi-bell-fill"></i>
        </button>
      </div>
    </div>
  </nav>

  <!-- Modal -->
  <div class="modal fade" id="changeLogModal" tabindex="-1" aria-labelledby="changeLogModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content bg-dark text-white">
        <div class="modal-header">
          <h5 class="modal-title" id="changeLogModalLabel">Change Log</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <ul>
            <li>Version 1.0.2 - Enhanced UI and fixed layout issues.</li>
            <li>Version 1.0.1 - Fixed minor bugs and improved performance.</li>
            <li>Version 1.0.0 - Initial release with core features.</li>
          </ul>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection