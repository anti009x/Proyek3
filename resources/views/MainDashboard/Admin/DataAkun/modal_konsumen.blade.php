<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editEmployeeModal{{ $user->id }}"><i class="bi bi-pencil-square"></i></button>
<button class="btn btn-danger"><i class="bi bi-trash"></i></button>

    <!-- Modal -->
    <div id="editEmployeeModal{{ $user->id }}" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="POST" action="{{ route('user.update', ['id' => $user->id]) }}">
                    @method('PUT')
                    @csrf
                    <div class="modal-header bg-primary text-white">						
                        <h4 class="modal-title">Edit User</h4>
    
                    </div>
                    <div class="modal-body">					
                        <div class="form-group">
                            <input type="text" class="form-control mb-2   text-center"  placeholder="Nama User" disabled >
                        
                            <input type="text" class="form-control" name="nama" value="{{ $user->nama }}" required>
                             
                 
                            
                            
          
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control mb-2 mt-2  text-center"  placeholder="Email" disabled >
                            <input type="email" class="form-control" name="email" value="{{ $user->email }}" required>
                        </div>
						<div class="form-group">
                            <input type="text" class="form-control mb-2 mt-2  text-center"  placeholder="Nohp" disabled >
                            <input type="text" class="form-control" name="nohp" value="{{ $user->nohp }}" required>
                        </div>
						<div class="form-group">
                            <input type="text" class="form-control mb-2 mt-2  text-center"  placeholder="Alamat" disabled >
                            <input type="text" class="form-control" name="alamat" value="{{ $user->alamat }}" required>
                        </div>
						<div class="form-group">
                            <input type="text" class="form-control mb-2 mt-2  text-center"  placeholder="Role" disabled >
							<select class="form-control" name="role" required>
								<option value="1" {{ $user->role == 1 ? 'selected' : '' }}>Admin</option>
								<option value="2" {{ $user->role == 2 ? 'selected' : '' }}>User</option>
								<option value="3" {{ $user->role == 3 ? 'selected' : '' }}>Kurir</option>
							</select>
                        </div>
						<div class="form-group">
                            <input type="text" class="form-control mb-2 mt-2  text-center"  placeholder="Gaji" disabled >
                            <input type="number" class="form-control" name="gaji" value="{{ $user->gaji }}" required>
                        </div>
						<div class="form-group">
                            <input type="text" class="form-control mb-2 mt-2  text-center"  placeholder="Password" disabled >
                            <input type="password" class="form-control" name="password" value="{{ $user->password }}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>