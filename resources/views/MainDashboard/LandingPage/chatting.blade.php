



<style>
   
    .avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        border: 2px solid #e84118;
        padding: 2px;
        flex: none;
    }

    input:focus {
        outline: 0px !important;
        box-shadow: none !important;
    }

    .card-text {
        border: 2px solid #ddd;
        border-radius: 8px;
    }
</style>



  





<div class="d-flex justify-content-end fixed-bottom mb-3 me-3">
    <div class="d-flex justify-content-center " style="width: 100px">
    <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
        <img class="img-fluid " src="{{ asset('img/service.png') }}" alt="Service" >
    </button>
    </div>
</div>


<div class="modal fade" id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <div class="navbar navbar-expand p-0">
                    <ul class="navbar-nav me-auto align-items-center">
                        <li class="nav-item">
                            <a href="#!" class="nav-link">
                                <div class="position-relative"
                                    style="width:50px; height: 50px; border-radius: 50%; border: 2px solid #e84118; padding: 2px">
                                    <img src="https://nextbootstrap.netlify.app/assets/images/profiles/1.jpg"
                                        class="img-fluid rounded-circle" alt="">
                                    <span
                                        class="position-absolute bottom-0 start-100 translate-middle p-1 bg-success border border-light rounded-circle">
                                        <span class="visually-hidden">New alerts</span>
                                    </span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#!" class="nav-link text-white">Bot</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a href="#!" class="nav-link">
                                <i class="fas fa-phone-alt"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#!" class="nav-link">
                                <i class="fas fa-video"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#!" class="nav-link" data-bs-dismiss="modal">
                                <i class="fas fa-times"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="modal-body p-4 bg-dark" style="height: 500px; overflow: auto;">
                

                <form id="chatForm">
                    @csrf
                
                <div class="d-flex align-items-baseline mb-4">
                    <div class="position-relative avatar me-3">
                        <img src="https://nextbootstrap.netlify.app/assets/images/profiles/1.jpg"
                            class="img-fluid rounded-circle" alt="">
                        <span
                            class="position-absolute bottom-0 start-100 translate-middle p-1 bg-success border border-light rounded-circle">
                            <span class="visually-hidden">New alerts</span>
                        </span>
                    </div>
                    <div class="pe-2">
                        <div>
                            <div>
                  
                                <button type="submit" class="card card-text d-inline-block p-2 px-3 m-1" id="antarin" value="Apa Itu Antar In? ">Apa Itu Antar In?</button>
                                <button type="submit" class="card card-text d-inline-block p-2 px-3 m-1" id="antarin" value="Apa Fungsi Antar In? ">Apa Fungsi Antar In?</button>
                                {{-- <div class="card card-text d-inline-block p-2 px-3 m-1"  style="margin-top: -10px;"></div> --}}
                                <p id="messageDisplay" class="text-white"></p>
                            </div>
                        </div>
                        <div>
                            <div class="small">01:10PM</div>
                        </div>
                    </div>
                </div>
                </form>



                <div class="d-flex align-items-baseline text-end justify-content-end mb-4">
                    <div class="pe-2">
                        <div>
                            <div class="card card-text d-inline-block p-2 px-3 m-1">Sure</div>
                        </div>
                    </div>
                    <div class="position-relative avatar">
                        <img src="https://nextbootstrap.netlify.app/assets/images/profiles/2.jpg"
                            class="img-fluid rounded-circle" alt="">
                        <span
                            class="position-absolute bottom-0 start-100 translate-middle p-1 bg-success border border-light rounded-circle">
                            <span class="visually-hidden">New alerts</span>
                        </span>
                    </div>
                </div>


            </div>
            <div class="modal-footer bg-dark position-absolute w-100 bottom-0 m-0 p-1">
                <div class="input-group">
                    <div class="input-group-text bg-transparent border-0">
                        <button class="btn btn-light text-secondary">
                            <i class="bi bi-paperclip"></i>
                        </button>
                    </div>
                    <input type="text" class="form-control border-0 rounded" placeholder="Write a message...">

                    <div class="input-group-text bg-transparent border-0 gap-1">
                        <button class="btn btn-light text-secondary">
                            <i class="bi bi-send-fill"></i>
                        </button>
                    </div>

                    <div class="input-group-text bg-transparent border-0 gap-1">
                        <button class="btn btn-light text-secondary">
                            <i class="bi bi-emoji-smile-fill"></i>
                        </button>
                    </div>

                    <div class="input-group-text bg-transparent border-0 gap-1">
                        <button class="btn btn-light text-secondary">
                            <i class="bi bi-mic-fill"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

 

<script>
    document.getElementById('chatForm').addEventListener('submit', function(event) {
        event.preventDefault();
        let antarinInput = document.getElementById('antarin').value;
        fetch('{{ route('sendMessage') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
            },
            body: JSON.stringify({ antarin: antarinInput })
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('messageDisplay').innerText = data.message;
        })
        .catch(error => console.error('Error:', error));
    });
</script>