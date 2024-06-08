$(document).ready(function(){
	// Activate tooltip
	$('[data-toggle="tooltip"]').tooltip();
	
	// Select/Deselect checkboxes
	var checkbox = $('table tbody input[type="checkbox"]');
	$("#selectAll").click(function(){
		if(this.checked){
			checkbox.each(function(){
				this.checked = true;                        
			});
		} else{
			checkbox.each(function(){
				this.checked = false;                        
			});
		} 
	});
	checkbox.click(function(){
		if(!this.checked){
			$("#selectAll").prop("checked", false);
		}
	});
});

// function setupEditModal(paketId, namaPaket, hargaPaket) {
//     var form = document.getElementById('editForm');
//     form.action = form.action.replace('PLACEHOLDER_ID', paketId);
//     form.elements['Nama_Paket'].value = namaPaket;
//     form.elements['Harga_Paket'].value = hargaPaket;
// }

// $(document).ready(function() {
//     $('.edit').click(function() {
//         var id = $(this).data('id');
//         var nama = $(this).data('nama');
//         var harga = $(this).data('harga');

//         $('#editEmployeeModal form').attr('action', '{{ route("pilihanpaket.update", ["id" => ""]) }}' + id);
//         $('#editEmployeeModal [name="Nama_Paket"]').val(nama);
//         $('#editEmployeeModal [name="Harga_Paket"]').val(harga);
//     });
// });

