<footer id="mainFooter" class=" animated-footer">
    <div class="container p-5 text-center">
        <div class="mx-auto w-50">
          

            <div class="bg-dark card p-5 shadow-lg">
                <div>
                    {{-- <h1 class="fw-bold text-white">BERIKAN SARAN UNTUK KAMI</h1> --}}
                    <p class=" text-white">Informasi Lebih Lanjut Mengenai Layanan Kami</p>
                </div>

                <div>

                    <img src="{{ asset('img/PengenalanAntarIn.png') }}" class="img-fluid">

                </div>    
             
            </div>
        </div>
    </div>
</footer>
<footer class="py-4 bg-dark">
    <div class="container px-5">
        <p class="m-0 text-center text-white">Copyright © Your Website 2024</p>
    </div>
</footer>
<style>
    .animated-footer {
        background: linear-gradient(to bottom, rgba(0, 123, 255, 0.5), rgba(0, 0, 0, 0.5));
        animation: gradientChange 6s infinite;
        transition: background 1s ease;
    }

    @keyframes gradientChange {
        0% {
            background: linear-gradient(to bottom, rgba(0, 123, 255, 0.5), rgba(0, 0, 0, 0.5));
        }
        50% {
            background: linear-gradient(to bottom, rgba(0, 0, 255, 0.5), rgba(0, 0, 0, 0.5));
        }
        100% {
            background: linear-gradient(to bottom, rgba(0, 123, 255, 0.5), rgba(0, 0, 0, 0.5));
        }
    }
</style>