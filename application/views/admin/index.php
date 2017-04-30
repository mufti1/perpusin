<h3>Daftar Buku</h3>
<!-- link modal add -->
<button type="button" id="btnAdd" class="btn btn-success" data-toggle="modal" data-target="#modalAdd">tambah buku</button>
<!-- table buat nampilin -->
<table class="table table-bordered table-responsive" style="margin-top: 20px;">
	<thead>
		<tr>
			<th>Kode Buku</th>
			<th>Judul Buku</th>
			<th>Pengarang Buku</th>
			<th>Tahun Terbit</th>
			<th>Penerbit</th>
			<th>Stok</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody id="showData">
		
	</tbody>
</table>
<!-- modal add -->
<div class="modal fade" id="modalAdd">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
				<h4 class="modal-title">Modal title</h4>
			</div>
			<div class="modal-body">
				<form id="bukuForm" method="post" action="">
					<fieldset class="form-group">
						<input type="hidden" class="form-control" name="kode_buku">
					</fieldset>
					<fieldset class="form-group">
						<label for="judul">Judul Buku</label>
						<input type="text" class="form-control" name="judul_buku" placeholder="Masukan Judul Buku">
					</fieldset>
					<fieldset class="form-group">
						<label for="pengarang">Pengarang</label>
						<input type="text" class="form-control" name="nama_pengarang" placeholder="Masukan Nama Pengarang">
					</fieldset>
					<fieldset class="form-group">
						<label for="tahun">Tahun Terbit</label>
						<input type="text" class="form-control" name="tahun_terbit" placeholder="Masukan Tahun Terbit">
					</fieldset>
					<fieldset class="form-group">
						<label for="tahun">Penerbit</label>
						<input type="text" class="form-control" name="penerbit" placeholder="Masukan Nama Penerbit">
					</fieldset>
					<fieldset class="form-group">
						<label for="tahun">Stok</label>
						<input type="text" class="form-control" name="stok" placeholder="Masukan Jumlah buku yang tersedia">
					</fieldset>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" id="btnSave" class="btn btn-primary">Save changes</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
	$(function(){
		showAll();
		//function tambah data
		//ambil url modal ketika buton modal di klik
		$('#btnAdd').click(function(){
			$('#bukuForm').attr('action','<?php echo base_url(); ?>admin/bukuAdd');
		});
		$('#btnSave').click(function(){
			var url = $('#bukuForm').attr('action');
			var data = $('#bukuForm').serialize();
			//validasi form
			var kode_buku = $('input[name=kode_buku]');
			var judul_buku = $('input[name=judul_buku]');
			var nama_pengarang = $('input[name=nama_pengarang]');
			var tahun_terbit = $('input[name=tahun_terbit]');
			var penerbit = $('input[name=penerbit]');
			var stok = $('input[name=stok]');
			var result = '';
			//jika formnya kosong maka menyala lanjutin ampe akhir -_-
			if(judul_buku.val()==''){
				judul_buku.parent().parent().addClass('has-error');
			}else{
				judul_buku.parent().parent().removeClass('has-error');
				result +='1';
			}
			if(nama_pengarang.val()==''){
				nama_pengarang.parent().parent().addClass('has-error');
			}else{
				nama_pengarang.parent().parent().removeClass('has-error');
				result +='2';
			}
			if(tahun_terbit.val()==''){
				tahun_terbit.parent().parent().addClass('has-error');
			}else{
				tahun_terbit.parent().parent().removeClass('has-error');
				result +='3';
			}
			if(penerbit.val()==''){
				penerbit.parent().parent().addClass('has-error');
			}else{
				penerbit.parent().parent().removeClass('has-error');
				result +='4';
			}
			if(stok.val()==''){
				stok.parent().parent().addClass('has-error');
			}else{
				stok.parent().parent().removeClass('has-error');
				result +='5';
			}
			//angka result didapat dari variabel result += ditulis ada berapa
			if(result=='12345'){
				$.ajax({
					type: 'ajax',
					method: 'post',
					url: url,
					data: data,
					async: false,
					dataType: 'json',
					success: function(response){
						if(response.success){
							$('#modalAdd').modal('hide');
							$('#bukuForm')[0].reset();
							showAll();
						}else{
							alert('tidak dapat menambah data, coba cek database anda')
						}
					},
					error: function(){
						alert('tidak bisa menambah data');
					}
				});
			}
		});
		//function
		function showAll(){
			$.ajax({
				type: 'ajax',
				url: '<?php echo base_url() ?>admin/showAll',
				async: false,
				dataType: 'json',
				success: function(data){
					var html = '';
					var i;
					for(i=0; i<data.length; i++){
						html +='<tr>'+
							'<td>'+data[i].kode_buku+'</td>'+
							'<td>'+data[i].judul_buku+'</td>'+
							'<td>'+data[i].nama_pengarang+'</td>'+
							'<td>'+data[i].tahun_terbit+'</td>'+
							'<td>'+data[i].penerbit+'</td>'+
							'<td>'+data[i].stok+'</td>'+
							'<td>'+
								'<a href="javascript:;" class="btn btn-info">Edit</a>'+
								'<a href="javascript:;" class="btn btn-danger">Delete</a>'+
							'</td>'+
						'</tr>';
					}
					$('#showData').html(html);
				},
				error: function(){
					alert('could not get data');
				}
			});
		}
	});
</script>