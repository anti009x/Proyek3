
@extends('layouts.layout')

@section('template')

    <div class="wrapper">
        <aside id="sidebar">
            <div class="d-flex">
                <button class="toggle-btn" type="button">
                    <i class="lni lni-grid-alt"></i>
                </button>
                <div class="sidebar-logo">
                    <a href="#">AntarIn</a>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#user" aria-expanded="false" aria-controls="user">
                        <i class="lni lni-user"></i>
                        <span>Pengguna</span>
                    </a>
                    <ul id="user" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href={{route('admin')}} class="sidebar-link">Admin</a>
                        </li>

                        <li class="sidebar-item">
                            <a href={{route('konsumen')}} class="sidebar-link">Konsumen</a>
                        </li>

                        <li class="sidebar-item">
                            <a href={{route('kurir')}} class="sidebar-link">Kurir</a>
                        </li>
                        
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('DataAkun') }}" class="sidebar-link">
                        <i class="lni lni-agenda"></i>
                        <span>Data Akun</span>
                    </a>
                </li>
                {{-- <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse"
                        data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                        <i class="lni lni-protection"></i>
                        <span>Auth</span>
                    </a>
                    <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href={{route('login')}} class="sidebar-link">Login</a>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link">Register</a>
                        </li>
                    </ul>
                </li> --}}
             
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-popup"></i>
                        <span>Notification</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-cog"></i>
                        <span>Setting</span>
                    </a>
                </li>
            </ul>
            <div class="sidebar-footer">
                <a href={{route('logout')}} class="sidebar-link">
                    <i class="lni lni-exit"></i>
                    <span>Logout</span>
                </a>
            </div>
        </aside>
        <div class="main p-3">
            <div class="text-center">
                {{-- <h1>
                    Sidebar Bootstrap 5
                </h1>
                <h1>Hello</h1> --}}
                @yield('content')
            </div>
        </div>
    </div>
@endsection

