



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
    <div class="d-flex justify-content-center" style="width: 100px">
        <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
            <img class="img-fluid" src="{{ asset('img/service.png') }}" alt="Service">
        </button>
    </div>
</div>

<div class="modal fade" id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header bg-dark">
                <!-- Navbar Content -->
                <div class="navbar navbar-expand p-0">
                    <ul class="navbar-nav me-auto align-items-center">
                        <li class="nav-item">
                            <a href="#!" class="nav-link">
                                <div class="position-relative" style="width:50px; height: 50px; border-radius: 50%; border: 2px solid #e84118; padding: 2px">
                                    <img src="{{ asset('img/service.png') }}" class="img-fluid rounded-circle" alt="">
                                    <span class="position-absolute bottom-0 start-100 translate-middle p-1 bg-success border border-light rounded-circle">
                                        <span class="visually-hidden">New alerts</span>
                                    </span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#!" class="nav-link text-white">[ - BOT - ]</a>
                        </li>
                        <li class="nav-item">
                            <span id="channelDisplay" class="nav-link text-white text-center"></span>
                            <input type="hidden" id="channel" name="channel">
                        </li>
                        <li class="nav-item">
                            <a href="#!" class="nav-link text-white" id="clearChatData"><i class="bi bi-trash-fill"></i></a>
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

            <!-- Modal Body -->
            <div class="modal-body p-4 bg-dark" style="height: 500px; overflow: auto;" id="chatHistoryContainer">
                <form id="chatForm">
                    @csrf

                    <!-- User Message Section -->
                    <div class="d-flex align-items-baseline mb-4">
                        <div class="position-relative avatar me-3">
                            <img src="{{ asset('img/service.png') }}" class="img-fluid rounded-circle" alt="">
                            <span class="position-absolute bottom-0 start-100 translate-middle p-1 bg-success border border-light rounded-circle">
                                <span class="visually-hidden">New alerts</span>
                            </span>
                        </div>
                        <div class="pe-2 w-100">
                            <div>
                                <div class="d-flex flex-column w-100">
                                    <button type="button" class="card card-text d-inline-block p-2 px-3 m-1" onclick="submitForm('Apa Itu Antar In?')">Apa Itu Antar In?</button>
                                    <button type="button" class="card card-text d-inline-block p-2 px-3 m-1" onclick="submitForm('Apa Fungsi Antar In?')">Apa Fungsi Antar In?</button>
                                    <button type="button" class="card card-text d-inline-block p-2 px-3 m-1" onclick="submitForm('Diskusi Dengan Developer')">Diskusi Dengan Developer</button>
                                </div>
                            </div>
                            <div>
                                <p id="messageDisplay" type="hidden" class="text-white text-center mt-2"></p>
                            </div>
                        </div>
                    </div>
                </form>

                {{-- <!-- Developer Message Section -->
                <div class="d-flex align-items-baseline text-end justify-content-end mb-4">
                    <div class="pe-2">
                        <div class="card card-text d-inline-block p-2 px-3 m-1">Developer Telah Join Kedalam Channel</div>
                    </div>
                    <div class="position-relative avatar">
                        <img src="https://nextbootstrap.netlify.app/assets/images/profiles/2.jpg" class="img-fluid rounded-circle" alt="">
                        <span class="position-absolute bottom-0 start-100 translate-middle p-1 bg-success border border-light rounded-circle">
                            <span class="visually-hidden">New alerts</span>
                        </span>
                    </div>
                </div> --}}
            </div>

            <!-- Modal Footer -->
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
// Utility function to get cookie by name
function getCookie(name) {
    const match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
    return match ? decodeURIComponent(match[2]) : null;
}

// Function to render chat history
function renderChatHistory(history) {
    const chatContainer = document.getElementById('chatHistoryContainer');
    chatContainer.innerHTML = ''; // Clear existing messages



    const formHTML = `
        <form id="chatForm">
            @csrf
            <div class="d-flex align-items-baseline mb-4">
                <div class="position-relative avatar me-3">
                    <img src="{{ asset('img/service.png') }}" class="img-fluid rounded-circle" alt="">
                    <span class="position-absolute bottom-0 start-100 translate-middle p-1 bg-success border border-light rounded-circle">
                        <span class="visually-hidden">New alerts</span>
                    </span>
                </div>
                <div class="pe-2 w-100">
                    <div>
                        <div class="d-flex flex-column w-100">
                            <button type="button" class="card card-text d-inline-block p-2 px-3 m-1" onclick="submitForm('Apa Itu Antar In?')">Apa Itu Antar In?</button>
                            <button type="button" class="card card-text d-inline-block p-2 px-3 m-1" onclick="submitForm('Apa Fungsi Antar In?')">Apa Fungsi Antar In?</button>
                            <button type="button" class="card card-text d-inline-block p-2 px-3 m-1" onclick="submitForm('Diskusi Dengan Developer')">Diskusi Dengan Developer</button>
                        </div>
                    </div>
                    <div>
                        <p id="messageDisplay" type="hidden" class="text-white text-center mt-2"></p>
                    </div>
                </div>
            </div>
        </form>
    `;
    chatContainer.insertAdjacentHTML('beforeend', formHTML);

        // Re-render the form and developer message
        history.forEach(entry => {
        const userMessage = document.createElement('div');
        userMessage.classList.add('d-flex', 'align-items-baseline', 'mb-5');
        userMessage.style.marginTop = '-40px'; // Added margin top minus
    
        userMessage.innerHTML = `
            <div class="position-relative avatar me-3">
                <img src="{{ asset('img/service.png') }}" class="img-fluid rounded-circle" alt="">
                <span class="position-absolute bottom-0 start-100 translate-middle p-1 bg-success border border-light rounded-circle">
                    <span class="visually-hidden">New alerts</span>
                </span>
            </div>
            <div class="pe-2 w-100">
                <div class="card card-text d-inline-block p-2 px-3 m-1 bg-primary text-white">
                    <strong>Anda:</strong> ${entry.question}
                </div>
                <div class="card card-text d-inline-block p-2 px-3 m-1 bg-secondary text-white">
                    <strong>Bot:</strong> ${entry.response}
                </div>
                
            </div>
        `;
        chatContainer.appendChild(userMessage);
    });
}

// Function to submit form
function submitForm(antarinInput) {
    const messageDisplay = document.getElementById('messageDisplay');
    const channelDisplay = document.getElementById('channelDisplay');
    const channelInput = document.getElementById('channel');
    const clearChatData = document.getElementById('clearChatData');

    // Optional: Show loading
    messageDisplay.innerText = 'Sedang memproses...';

    fetch('{{ route('sendMessage') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
        },
        body: JSON.stringify({ antarin: antarinInput, channel: channelInput.value })
    })
    .then(response => response.json())
    .then(data => {
        if (data.message && data.channel) {
            // messageDisplay.innerText = data.message;
            // channelDisplay.innerText = data.channel;
            channelInput.value = data.channel;
            getChatHistory(); // Update chat history
        } else {
            throw new Error('Invalid response data');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        messageDisplay.innerText = 'Terjadi kesalahan saat mengirim pesan.';
    });
}

// Function to get chat history from backend
function getChatHistory() {
    fetch('{{ route('getChatData') }}', {
        method: 'GET',
        headers: {
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.history && data.channel) {
            document.getElementById('channelDisplay').innerText = data.channel;
            document.getElementById('channel').value = data.channel;
            renderChatHistory(data.history);
        } else {
            throw new Error('Invalid response data');
        }
    })
    .catch(error => {
        console.error('Error fetching chat history:', error);
    });
}

// Function to delete chat history and channel
function deleteChatData() {
    fetch('{{ route('deleteCookie') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.message) {
            console.log(data.message);
            getChatHistory(); // Update chat history
        } else {
            throw new Error('Invalid response data');
        }
    })
    .catch(error => {
        console.error('Error deleting chat data:', error);
    });
}

// Event listener to load chat history when modal is opened
document.getElementById('exampleModalCenter').addEventListener('shown.bs.modal', function () {
    getChatHistory();
});

// Event listener to delete chat data when "Hapus Chat" is clicked
document.getElementById('clearChatData').addEventListener('click', function () {
    deleteChatData();
});
</script>