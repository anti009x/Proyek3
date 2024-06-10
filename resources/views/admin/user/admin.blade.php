@extends('admin.admin')

@section('content')



<div class="container-xl">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						{{-- <h2>Manage <b>Pesanan</b></h2> --}}
					</div>
					<div class="col-sm-6">
						<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Tambah Akun Admin</span></a>
						{{-- <a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Delete</span></a>						 --}}
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>
							<span class="custom-checkbox">
								<input type="checkbox" id="selectAll" name="selectAll" onclick="toggleSelectAll(this)">
								<label for="selectAll"></label>
							</span>
						</th>
						<th>Nama User</th>
						<th>Email</th>
						<th>Nohp</th>
						<th>Alamat</th>
						<th>Role</th>
			
						<th>Password</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
			
				
				@foreach ($User as $user)
					<tr>
						<td>
							<span class="custom-checkbox">
								<input type="checkbox" id="checkbox{{ $user->id }}" name="options[]" value="{{ $user->id }}" class="checkbox">
								<label for="checkbox{{ $user->id }}"></label>
							</span>
						</td>
						<td>{{ $user->nama }}</td>
						<td>{{ $user->email }}</td>
						<td>{{ $user->nohp }}</td>
						<td>{{ $user->alamat }}</td>
						<td>{{ $user->role_id }}</td>
						<td>{{ $user->password }}</td>
						<td>
							<a href="#editEmployeeModal{{ $user->id }}" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
							<a href="#deleteEmployeeModal{{ $user->id }}" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
						</td>
					</tr> 
				@endforeach
				</tbody>
			</table>
			<div class="clearfix">
			<div class="hint-text">Showing <b>{{ $User->first() ? $User->first()->id : 'N/A' }}</b> out of <b>{{ $User->count() }}</b> entries</div>
				<div class="pagination">
					{{ $User->links('pagination::bootstrap-4')}}
				</div>
			</div>
		</div>
	</div>        

</div>


<!-- Edit Modal HTML -->
<div id="addEmployeeModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="{{ route('user.store') }}" method="POST">
				@csrf
				<div class="modal-header">						
					<h4 class="modal-title">Tambah Akun Admin</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<div class="form-group">
						<label>Nama User</label>
						<input type="text" class="form-control" name="nama" required>
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="text" class="form-control" name="email" required>
					</div>
					<div class="form-group">
						<label>Nohp</label>
						<input type="text" class="form-control" name="nohp" required>
					</div>
					<div class="form-group">
						<label>Alamat</label>
						<input type="text" class="form-control" name="alamat" required>
					</div>
					<div class="form-group">
						<label>Role</label>
						<select class="form-control" name="role_id" required>
							<option value="1">Admin</option>
							<option value="2">User</option>
							<option value="3">Kurir</option>
						</select>
					</div>
		
					<div class="form-group">
						<label>Password</label>
						<input type="text" class="form-control" name="password" required>
					</div>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-success" value="Add">
				</div>
			</form>
		</div>
	</div>
</div>
@foreach ($User as $user)
    <!-- Modal -->
    <div id="editEmployeeModal{{ $user->id }}" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('user.update', ['id' => $user->id]) }}">
                    @method('PUT')
                    @csrf
                    <div class="modal-header">						
                        <h4 class="modal-title">Edit User</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">					
                        <div class="form-group">
                            <label>Nama Paket</label>
                            <input type="text" class="form-control" name="nama" value="{{ $user->nama }}" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" name="email" value="{{ $user->email }}" required>
                        </div>
						<div class="form-group">
                            <label>Nohp</label>
                            <input type="text" class="form-control" name="nohp" value="{{ $user->nohp }}" required>
                        </div>
						<div class="form-group">
                            <label>Alamat</label>
                            <input type="text" class="form-control" name="alamat" value="{{ $user->alamat }}" required>
                        </div>
						<div class="form-group">
                            <label>Role</label>
							<select class="form-control" name="role" required>
								<option value="1">Admin</option>
								<option value="2">User</option>
								<option value="3">Kurir</option>
							</select>
                        </div>
						<div class="form-group">
                            <label>Gaji</label>
                            <input type="text" class="form-control" name="gaji" value="{{ $user->gaji }}" required>
                        </div>
						<div class="form-group">
                            <label>Password</label>
                            <input type="text" class="form-control" name="password" value="{{ $user->password }}" required>
                        </div>
						<div class="form-group">
                            <label>Password</label>
                            <input type="text" class="form-control" name="password" value="{{ $user->password }}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-info" value="Save">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
<!-- Delete Modal HTML -->
@foreach ($User as $user)
<div id="deleteEmployeeModal{{ $user->id }}" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="POST" action="{{ route('user.delete', ['id' => $user->id]) }}">
                @csrf
                @method('DELETE')
				<div class="modal-header">						
					<h4 class="modal-title">Delete User</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<p>Are you sure you want to delete these Records?</p>
					<p class="text-warning"><small>This action cannot be undone.</small></p>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-danger" value="Delete">
				</div>
			</form>
		</div>
	</div>
</div>
@endforeach

@endsection


