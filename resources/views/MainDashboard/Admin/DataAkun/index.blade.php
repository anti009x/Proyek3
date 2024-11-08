@extends('MainDashboard.Layout.main_template')

@section('sidebar')
<div class="d-flex" id="wrapper">
    <div class="border-end bg-dark text-white vh-100" id="sidebar-wrapper" style="width: 300px; border-left: 1px solid #0038ff;">
        <img src="{{ asset('img/kurir.png') }}" alt="Admin Dashboard Image" class="img-fluid">

        <div class="list-group list-group-flush">
      
    
                <a href="#submenu2" data-bs-toggle="collapse" class="list-group-item list-group-item-action bg-dark text-white p-3" style="border-bottom: 1px solid #0038ff;" >
                    <i class="bi bi-person-badge-fill me-2"></i>Users <i class="bi bi-opencollective ms-2"></i>
                </a>
                <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('pengguna') }}">
                            <i class="bi bi-person-fill me-2"></i>Pengguna
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('admin') }}">
                            <i class="bi bi-person-lock me-2"></i>Admin
                        </a>
                    </li>
                    <li class="nav-item" style="border-bottom: 1px solid #0038ff;">
                        <a class="nav-link text-white" href="{{ route('kurir') }}">
                            <i class="bi bi-person-fill-up me-2"></i>Kurir
                        </a>
                    </li>
                </ul>
       
            <a class="list-group-item list-group-item-action bg-dark text-white p-3" style="border-bottom: 1px solid #0038ff;" href="#!">
                <i class="bi bi-lightning-fill me-2"></i>Shortcuts
            </a>
            <a class="list-group-item list-group-item-action bg-dark text-white p-3" style="border-bottom: 1px solid #0038ff;" href="#!">
                <i class="bi bi-graph-up me-2"></i>Overview
            </a>
            <a class="list-group-item list-group-item-action bg-dark text-white p-3" style="border-bottom: 1px solid #0038ff;" href="#!">
                <i class="bi bi-calendar-event-fill me-2"></i>Events
            </a>
            <a class="list-group-item list-group-item-action bg-dark text-white p-3" style="border-bottom: 1px solid #0038ff;" href="#!">
                <i class="bi bi-person-fill me-2"></i>Profile
            </a>
            <a class="list-group-item list-group-item-action bg-dark text-white p-3" style="border-bottom: 1px solid #0038ff;" href="{{ route('ServerStatus') }}">
                <i class="bi bi-info-circle-fill me-2"></i>Status
            </a>

      

            
        </div>
    </div>
    <!-- Page content-->
    <div class="container-fluid py-5">
        
        
        @yield('DataPengguna')
        {{-- @yield('ServerStatus') --}}


            @yield('status-indicator')
 
    </div>
</div>
@endsection