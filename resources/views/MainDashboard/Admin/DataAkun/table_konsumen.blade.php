@extends('MainDashboard.Admin.DataAkun.index')

@section('DataPengguna')
<div class="card shadow-lg">
    <div class="card-body">
        <div class='mt-3 d-flex justify-content-between'>

            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center w-50 gap-2">
                    <li class="page-item">
                        <a class="page-link bg-primary text-white" href="#" tabindex="-1" aria-disabled="true">
                            <i class="bi bi-arrow-left-square-fill"></i>
                        </a>
                    </li>
                    <li class="page-item">
                        <form action="" method="GET" class="d-flex">
                            <input type="number" name="query" class="form-control me-2" aria-label="Page" value="{{ request('query', 1) }}">
                            <button class="page-link bg-primary text-white" type="submit">
                                <i class="bi bi-arrow-right-square-fill"></i>
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>

            <button class="card-title text-dark shadow-lg p-3 bg-dark text-white text-capitalize text-uppercase font-bold fs-4 w-5 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; border: 2px solid #0038ff;">
                <i class="bi bi-person-plus-fill"></i>
            </button>
        </div>

        <div class="input-group rounded mb-3" style="width: 20%;">
            <form action="{{ route('userData') }}" method="GET" class="d-flex gap-2">
                <input type="search" name="nama" class="form-control rounded shadow-sm py-2" placeholder="Search by Name" aria-label="Search" aria-describedby="search-addon" value="{{ request('nama') }}" />
                <button class="input-group-text border-0 bg-primary text-white" id="search-addon" type="submit">
                    <i class="bi bi-search"></i>
                </button>
            </form>
        </div>

        <div class="table-responsive rounded    ">

            <table class="table table-bordered w-100 text-center " >
                <thead class="table-dark text-white rounded-pill">
                    <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No.HP</th>
                    <th>Alamat</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($User as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->nama }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->nohp }}</td>
                    <td>{{ $user->alamat }}</td>
                    <td>{{ $user->role_id }}</td>
                    <td>
                        @include('MainDashboard.Admin.DataAkun.modal_konsumen')
                    </td>
                </tr>
                @endforeach
            </tbody>
            </table>
        </div>
    </div>
</div>

{{-- <script>
    $(function() {
        function fetchGeneral() {
            const searchValue = $('input[name="nama"]').val();
            const draw = 1;
            const start = 0;
            const length = 10;
            const orderColumn = 0;
            const orderDir = 'asc';
            // Add AJAX call or other logic here if needed
        }
    });

    function handleResponse(response) {
        const tbody = $('#general-table-body').empty();
        if (response.data && response.data.length) {
            $.each(response.data, function(index, role) {
                tbody.append(`
                <tr>
                    <td>${role.id}</td>
                    <td>${role.nama}</td>
                    <td>${role.email}</td>
                </tr>
                `);
            });
        }
    }
</script> --}}

@endsection