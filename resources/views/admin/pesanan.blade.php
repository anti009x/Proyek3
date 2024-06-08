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
						<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Employee</span></a>
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
						<th>Nama Paket</th>
						<th>Harga Paket</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
			
				
				@foreach ($PilihanPaket as $paket)
					<tr>
						<td>
							<span class="custom-checkbox">
								<input type="checkbox" id="checkbox{{ $paket->id }}" name="options[]" value="{{ $paket->id }}" class="checkbox">
								<label for="checkbox{{ $paket->id }}"></label>
							</span>
						</td>
						<td>{{ $paket->Nama_Paket }}</td>
						<td>{{ $paket->Harga_Paket }}</td>
						<td>
							<a href="#editEmployeeModal{{ $paket->id }}" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
							<a href="#deleteEmployeeModal{{ $paket->id }}" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
						</td>
					</tr> 
				@endforeach
				</tbody>
			</table>
			<div class="clearfix">
				<div class="hint-text">Showing <b>{{ $PilihanPaket->firstItem() }}</b> out of <b>{{ $PilihanPaket->total() }}</b> entries</div>
				<div class="pagination">
					{{ $PilihanPaket->links('pagination::bootstrap-4') }}
				</div>
			</div>
		</div>
	</div>        

</div>


<!-- Edit Modal HTML -->
<div id="addEmployeeModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="{{ route('pilihanpaket.store') }}" method="POST">
				@csrf
				<div class="modal-header">						
					<h4 class="modal-title">Add Employee</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<div class="form-group">
						<label>Nama Paket</label>
						<input type="tex	t" class="form-control" name="Nama_Paket" required>
					</div>
					<div class="form-group">
						<label>Harga Paket</label>
						<input type="text" class="form-control" name="Harga_Paket" required>
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
@foreach ($PilihanPaket as $paket)
    <!-- Modal -->
    <div id="editEmployeeModal{{ $paket->id }}" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('pilihanpaket.update', ['id' => $paket->id]) }}">
                    @method('PUT')
                    @csrf
                    <div class="modal-header">						
                        <h4 class="modal-title">Edit Paket</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">					
                        <div class="form-group">
                            <label>Nama Paket</label>
                            <input type="text" class="form-control" name="Nama_Paket" value="{{ $paket->Nama_Paket }}" required>
                        </div>
                        <div class="form-group">
                            <label>Harga Paket</label>
                            <input type="text" class="form-control" name="Harga_Paket" value="{{ $paket->Harga_Paket }}" required>
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
@foreach ($PilihanPaket as $paket)
<div id="deleteEmployeeModal{{ $paket->id }}" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="POST" action="{{ route('pilihanpaket.delete', ['id' => $paket->id]) }}">
                @csrf
                @method('DELETE')
				<div class="modal-header">						
					<h4 class="modal-title">Delete Employee</h4>
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


