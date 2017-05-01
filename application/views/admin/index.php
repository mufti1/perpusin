<h3>Daftar Buku</h3>
<!-- alert untuk sukses menambah data -->
<div class="alert alert-success" style="display: none;">
	
</div>
<!-- link modal add -->
<button type="button" id="btnAdd" class="btn btn-success" >tambah buku</button>
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
<!-- modal -->
<div class="modal fade" id="modalAdd">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
				<h4 class="modal-title">Modal Title<h4>
			</div>
			<div class="modal-body">
				<form id="bukuForm" method="" action="">
				<!-- inputan dua untuk mengambil nilai edit dan delete, trus satunya add -->
					<fieldset class="form-group">
						<input type="hidden" class="form-control" name="kode_buku">
					</fieldset>
					<fieldset class="form-group">
						<input type="hidden" class="form-control" name="id_buku">
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
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
				<button type="button" id="btnSave" class="btn btn-primary">Simpan</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="modal fade" id="modalDelete">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
				<h4 class="modal-title">Konfirmasi menghapus</h4>
			</div>
			<div class="modal-body">
				<p>Anda yakin untuk menghapus data ini?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
				<button type="button" class="btn btn-danger" id="btnDelete">Ya</button>
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
			$('#modalAdd').modal('show');
			$('#modalAdd').find('.modal-title').text('Tambah Buku');
			$('#bukuForm').attr('action','<?php echo base_url(); ?>admin/bukuAdd');
		});
		$('#btnSave').click(function(){
			var url = $('#bukuForm').attr('action');
			var data = $('#bukuForm').serialize();
			//validasi form
			var kode_buku = $('input[name=id_buku]');
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
							if(response.type == 'add'){
								var type = 'menambah'
							}else if(response.type == 'update'){
								var type = 'mengupdate'
							}
							$('.alert-success').html('Berhasil '+type+' data').fadeIn().delay(1000).fadeOut('slow');
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
		//function edit data 
		$('#showData').on('click', '.item-edit', function(){
			var kode_buku =$(this).attr('data');
			$('#modalAdd').modal('show');
			$('#modalAdd').find('.modal-title').text('Edit Data');
			$('#bukuForm').attr('action','<?php echo base_url() ?>admin/updateBuku');
			$.ajax({
				type: 'ajax',
				method: 'get',
				data: {kode_buku: kode_buku},
				url: '<?php echo base_url() ?>admin/editBuku',
				async: false,
				dataType: 'json',
				success: function(data){
					$('input[name=kode_buku]').val(data.kode_buku);
					$('input[name=judul_buku]').val(data.judul_buku);
					$('input[name=nama_pengarang]').val(data.nama_pengarang);
					$('input[name=tahun_terbit]').val(data.tahun_terbit);
					$('input[name=penerbit]').val(data.penerbit);
					$('input[name=stok]').val(data.stok);
				},
				error: function(){
					alert('tidak dapat mengedit data');
				}
			});
		});
		//function delete
		$('#showData').on('click', '.item-delete', function(){
			var kode_buku =$(this).attr('data');
			$('#modalDelete').modal('show');
			//prevent previous handler
			$('#btnDelete').unbind().click(function(){
				$.ajax({
					type: 'ajax',
					method: 'get',
					async: false,
					url: '<?php echo base_url(); ?>admin/deleteBuku',
					data:{kode_buku: kode_buku},
					dataType: 'json',
					success: function(response){
						if(response.success){
							$('#modalDelete').modal('hide');
							$('.alert-success').html('Berhasil menghapus data').fadeIn().delay(1000).fadeOut('slow');
							showAll();
						}else{
							alert('Error');
						}
					},
					error: function(){
						alert('Gagal menghapus');
					}
				})
			});
		});
		//function tampil
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
						'<a href="javascript:;" class="btn btn-info item-edit" data="'+data[i].kode_buku+'">Edit</a>'+
						'<a href="javascript:;" class="btn btn-danger item-delete" data="'+data[i].kode_buku+'">Delete</a>'+
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