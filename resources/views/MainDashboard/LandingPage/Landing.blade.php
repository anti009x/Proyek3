@extends('MainDashboard.Layout.main_template')

@section('dashboard')

    <header class="bg-dark py-5">

        <div class="container px-5">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active" style="height: 500px;">
                        <div class="row gx-5 justify-content-center h-100">
                            <div class="col-lg-6 align-self-center">
                                <div class="text-center my-5">
                                    {{-- <h1 class="display-6 fw-bolder text-white mb-2">SELAMAT DATANG DI SISTEM INFORMASI ADMINISTRATOR</h1> --}}
                                    <p class="lead text-white-50 mb-4">Kami disini menghadirkan tampilan Monitoring yang dapat membantu Administrator dalam mengelola Aplikasi dengan lebih mudah</p>
                                    <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
                                        <a class="btn btn-primary btn-lg px-4 me-sm-3" href="#features">Lihat Selengkap Nya</a>
                                        <a class="btn btn-outline-light btn-lg px-4" href="#!">Baca Panduan Disini !</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item" style="height: 500px;">
                        <div class="row gx-5 justify-content-center h-100">
                            <div class="col-lg-6 align-self-center">
                                <div class="text-center my-5">
                                    {{-- <i class="bi-alarm"></i> --}}
                                    {{-- <h1 class="display-6 fw-bolder text-white mb-2">FITUR TERBARU</h1> --}}
                                    <p class="lead text-white-50 mb-4">Kami telah menambahkan fitur terbaru untuk memudahkan Anda dalam mengelola data.</p>
                                    <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
                                        <a class="btn btn-primary btn-lg px-4 me-sm-3" href="#features">Lihat Selengkap Nya</a>
                                        <a class="btn btn-outline-light btn-lg px-4" href="#!">Baca Panduan Disini !</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item" style="height: 500px;">
                        <div class="row gx-5 justify-content-center h-100">
                            <div class="col-lg-6 align-self-center">
                                <div class="text-center my-5">
                                    {{-- <h1 class="display-6 fw-bolder text-white mb-2">PENGUMUMAN</h1> --}}
                                    <p class="lead text-white-50 mb-4">Jangan lewatkan pengumuman penting terkait sistem dan fitur terbaru.</p>
                                    <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
                                        <a class="btn btn-primary btn-lg px-4 me-sm-3" href="#features">Lihat Selengkap Nya</a>
                                        <a class="btn btn-outline-light btn-lg px-4" href="#!">Baca Panduan Disini !</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <div>
                @include('MainDashboard.LandingPage.chatting')
            </div>
        </div>
     
    
        
    </header>



    @include('MainDashboard.LandingPage.Mitra')
    @yield('status-indicator')

    @include('MainDashboard.LandingPage.Footer')



@endsection
