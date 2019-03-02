<?php $this->load->view('template/_header'); ?>
<link href="<?= base_url('assets/plugins/jquery-confirm/jquery-confirm.min.css') ?>" rel="stylesheet">
<?php $this->load->view('template/_nav'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			User Profile
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?=site_url('instansiCtrl')?>"><i class="fa fa-dashboard"></i> Instansi</a></li>
			<li class="active">User profile</li>
		</ol>
	</section>

	<?php if (@$_SESSION['fail'] != null) { ?>
		<div class="alert alert-danger alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4><i class="icon fa fa-ban"></i> Failed!</h4>
			<?= $_SESSION['fail'] ?>
		</div>
		<?php 
} ?>
		<?php if (@$_SESSION['succ'] != null) { ?>
		<div class="alert alert-success alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<h4><i class="icon fa fa-check"></i> Success! </h4>
			<?= $_SESSION['succ'] ?>
		</div>
		<?php 
} ?>

	<!-- Main content -->
	<section class="content">

		<div class="row">
			<div class="col-md-3">

				<!-- Profile Image Admin -->
				<?php if (@$_SESSION['hakAkses'] == 1) { ?>
				<div class="box box-primary">
					<div class="box-body box-profile">
						<img class="profile-user-img img-responsive img-circle" src="<?=base_url('assets/images/icon.jpeg')?>" alt="Empty.">

						<h3 class="profile-username text-center"><?=@$_SESSION['nama']?></h3>

						<p class="text-muted text-center">Administrator</p>

						<ul class="list-group list-group-unbordered">
							<li class="list-group-item">
								<b>Kode Admin</b> <a class="pull-right"><?=@$_SESSION['kode_admin']?></a>
							</li>
							<li class="list-group-item">
								<b>Username</b> <a class="pull-right"><?=@$_SESSION['username']?></a>
							</li>
							<li class="list-group-item">
								<b>Password </b> <button type="button" class="btnShowPasswordProfile btn btn-xs btn-default" title="Show Password"><i class="fa fa-eye"></i></button> <input style="text-align:right;border:none" readonly class="passwordProfile pull-right" type="password" value="<?= base64_decode(@$data[0]->password) ?>">
							</li>
						</ul>

						<a href="#" data-toggle="modal" data-target="#modalUbah" class="btn btn-primary btn-block"><b>Ubah</b></a>
					</div>
					<!-- /.box-body -->
				</div>
				<?php } ?>
				<!-- /.box -->

				<!-- Profile Image Instansi -->
				<?php if (@$_SESSION['hakAkses'] == 2) { ?>
				<div class="box box-primary">
					<div class="box-body box-profile">
						<img class="profile-user-img img-responsive img-circle" src="<?=base_url('assets/images/user.png')?>" alt="Empty.">

						<h3 class="profile-username text-center"><?=@$_SESSION['nama']?></h3>

						<p class="text-muted text-center">Instansi</p>

						<ul class="list-group list-group-unbordered">
							<li class="list-group-item">
								<b>Kode Instansi</b> <a class="pull-right"><?=@$_SESSION['kode_instansi']?></a>
							</li>
							<li class="list-group-item">
								<b>Kota</b> <a class="pull-right"><?=@$_SESSION['kota_lokasi']?></a>
							</li>
							<li class="list-group-item">
								<b>Username</b> <a class="pull-right"><?=@$_SESSION['username']?></a>
							</li>
							<li class="list-group-item">
								<b>Password </b> <button type="button" class="btnShowPasswordProfile btn btn-xs btn-default" title="Show Password"><i class="fa fa-eye"></i></button> <input style="text-align:right;border:none" readonly class="passwordProfile pull-right" type="password" value="<?= base64_decode(@$data[0]->password) ?>">
							</li>
						</ul>

						<a href="#" data-toggle="modal" data-target="#modalUbah" class="btn btn-primary btn-block"><b>Ubah</b></a>
					</div>
					<!-- /.box-body -->
				</div>
				<?php } ?>
				<!-- /.box -->

				<!-- Profile Image Siswa -->
				<?php if (@$_SESSION['hakAkses'] == 3) { ?>
				<div class="box box-primary">
					<div class="box-body box-profile">
						<img class="profile-user-img img-responsive img-circle" src="<?=base_url('assets/images/').@$data[0]->foto?>" alt="<?=base_url('assets/images/user.png')?>">
						<?= var_dump($data) ?>
						<h3 class="profile-username text-center"><?=@$_SESSION['nama']?></h3>

						<p class="text-muted text-center">Siswa</p>

						<ul class="list-group list-group-unbordered">
							<li class="list-group-item">
								<b>Instansi</b> <a class="pull-right"><?=@$data[0]->nama_instansi?></a>
							</li>
							<li class="list-group-item">
								<b>Program</b> <a class="pull-right"><?=@$data[0]->nama_program?></a>
							</li>
							<li class="list-group-item">
								<b>NIS</b> <a class="pull-right"><?=@$_SESSION['nis']?></a>
							</li>
							<li class="list-group-item">
								<b>NISN</b> <a class="pull-right"><?=@$_SESSION['nisn']?></a>
							</li>
							<li class="list-group-item">
								<b>Username</b> <a class="pull-right"><?=@$_SESSION['username']?></a>
							</li>
							<li class="list-group-item">
								<b>Password </b> <button type="button" class="btnShowPasswordProfile btn btn-xs btn-default" title="Show Password"><i class="fa fa-eye"></i></button> <input style="text-align:right;border:none" readonly class="passwordProfile pull-right" type="password" value="<?= base64_decode(@$data[0]->password) ?>">
							</li>
						</ul>
					</div>
					<!-- /.box-body -->
				</div>
				<?php } ?>
				<!-- /.box -->

			</div>
			<!-- /.col -->

			<!-- Box Tabs -->
			<?php if ($_SESSION['hakAkses'] != 3){ ?>
			<div class="col-md-9">
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs">
						<li id="tabRegister"><a href="#register" data-toggle="tab">Register</a></li>
						<li class="active" id="tabInstansi"><a href="#instansi" data-toggle="tab">Instansi</a></li>
						<li class="hidden" id="tabSiswa"><a href="#siswa" data-toggle="tab">Siswa</a></li>
					</ul>

					<div class="tab-content">

						<!-- Register -->
						<div class="active tab-pane" id="register">
							<table id="tableRegister" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th width="1%">No</th>
										<th>Nama</th>
										<th class="min-tablet">Instansi</th>
										<th class="min-tablet">Jurusan</th>
										<th class="min-desktop">NIS</th>
										<th class="min-desktop">NISN</th>
										<th class="min-desktop">Telpon</th>
										<th class="min-desktop">Username</th>
										<th class="min-desktop">Tambah</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>

						<!-- Instansi -->
						<div class="active tab-pane" id="instansi">
							<table id="tableInstansi" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>Kode</th>
										<th class="min-tablet">Nama</th>
										<th class="min-tablet">Kota</th>
										<th class="min-desktop">Tahun</th>
										<th class="min-desktop">Versi</th>
										<th class="min-desktop">Action</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
						
						<!-- Siswa -->
						<div class="tab-pane" id="siswa">
							<table id="tableSiswa" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>No.</th>
										<th class="min-tablet">Nama</th>
										<th class="min-tablet">NIS</th>
										<th class="min-desktop">NISN</th>
										<th class="min-desktop">HP</th>
										<?php if($_SESSION['hakAkses'] != 3){?>
										<th class="min-desktop">Action</th>
										<?php } ?>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
					<!-- /.tab-content -->
				</div>
				<!-- /.nav-tabs-custom -->
			</div>
			<?php } ?>
			<!-- /.col -->
		</div>
		<!-- /.row -->

		<!-- Start Modal Ubah Password -->
		<div class="modal fade" id="modalUbah">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Ubah Data</h4>
					</div>
					<form id="formUbah" method="post" action="<?= site_url('Profile/UbahData') ?>">
						<div class="modal-body">
							<div class="form-group">
								<label for="ubahUsername">Username</label>
								<input required type="text" name="ubahUsername" id="ubahUsername" class="form-control" value="<?=$_SESSION['username']?>">
							</div>
							<div class="form-group">
								<label for="ubahPassword">Password</label>
								<input type="text" name="ubahPassword" id="ubahPassword" class="form-control" placeholder="**************" value="">
								<small class="text-muted">Password Boleh Kosong </small>
							</div>
							
						</div>
						<input type="hidden" name="typeUser" id="typeUser" value="<?=$_SESSION['hakAkses']?>" />
						<input type="hidden" name="mainID" id="mainID" value="" />
						<div class="modal-footer">
							<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
							<button type="submit" class="btn btn-primary">Simpan</button>
						</div>
					</form>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
		<!-- /.modal -->

		<!-- Start Modal Tambah Siswa Registrasi -->
		<div class="modal fade" id="modalTambahSiswa">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Tambah Siswa</h4>
					</div>
					<form id="formTambahSiswa" method="post" action="<?= site_url('Profile/TambahSiswa') ?>">
						<div class="modal-body">
							<div class="form-group">
								<label for="addNama">Nama</label>
								<input required type="text" name="addNama" id="addNama" class="form-control">
							</div>

							 <div class="form-group">
								<label>Instansi</label>
								<select class="form-control select2" id="addInstansi" name="addInstansi" data-placeholder="Select a State"
										style="width: 100%;">
										<!-- Option diisi oleh JS -->
								</select>
							</div>

							<div class="form-group">
							  <label for="addProgram">Program</label>
							  <select class="form-control" name="addProgram" id="addProgram">
								<!-- Option Diisi oleh JS -->
							  </select>
							</div>

							<div class="form-group">
								<label for="addJurusan">Jurusan</label>
								<input required type="text" name="addJurusan" id="addJurusan" class="form-control">
							</div>

							<div class="form-group">
								<label for="addNis">Nis</label>
								<input required type="text" name="addNis" id="addNis" class="form-control">
							</div>
							
							<div class="form-group">
								<label for="addNisn">Nisn</label>
								<input required type="text" name="addNisn" id="addNisn" class="form-control">
							</div>
							
							<div class="form-group">
								<label for="addTelp">Telepon</label>
								<input required type="text" name="addTelp" id="addTelp" class="form-control">
							</div>
							
							<div class="form-group">
								<label for="addUsername">Username</label>
								<input required type="text" name="addUsername" id="addUsername" class="form-control">
							</div>

							<label for="addPassword">Passowrd</label>
							<div class="input-group input-group-sm">
								<input required type="password" id="addPassword" name="addPassword" class="form-control">
									<span class="input-group-btn">
									<button type="button" id="btnShowPassword" class="btn btn-info btn-flat"><i class="fa fa-eye"></i></button>
									</span>
							</div>

							<input type="hidden" id="foto" name="foto">
							<input type="hidden" id="idRegister" name="idRegister">
							
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
							<button type="submit" class="btn btn-primary">Simpan</button>
						</div>
					</form>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
		<!-- /.modal -->

		<!-- Start Modal Ubah Password -->
		<div class="modal fade" id="modalUbahSiswa">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Ubah Data</h4>
					</div>
					<form id="formUbahSiswa" method="post" action="<?= site_url('Profile/UbahDataSiswa') ?>">
						<div class="modal-body">
							<div class="form-group">
								<label for="ubahNama">Nama</label>
								<input required type="text" name="ubahNama" id="ubahNama" class="form-control">
							</div>
							<div class="form-group">
								<label for="ubahJurusan">Jurusan</label>
								<input required type="text" name="ubahJurusan" id="ubahJurusan" class="form-control">
							</div>
							<div class="form-group">
								<label for="ubahNope">Nomor HP</label>
								<input required type="text" name="ubahNope" id="ubahNope" class="form-control">
							</div>
							<div class="form-group">
								<label for="ubahPasswordSiswa">Password</label>
								<input type="password" name="ubahPasswordSiswa" id="ubahPasswordSiswa" class="form-control" placeholder="**************" value="">
								<small class="text-muted">Password Boleh Kosong </small>
							</div>
							
						</div>
						<input type="hidden" name="idSiswa" id="idSiswa" value="" />
						<div class="modal-footer">
							<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
							<button type="submit" class="btn btn-primary">Simpan</button>
						</div>
					</form>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
		<!-- /.modal -->

		<!-- Start Modal View Siswa -->
		<div class="modal fade" id="modalViewSiswa">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Tambah Siswa</h4>
					</div>
						<div class="modal-body">

						<img src="<?= base_url('assets/images/user.png')?>" class="img-circle" width="150" height="150" alt="Empty">
						<!-- TODO: Buat desain view Siswa -->

						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
							<button type="submit" class="btn btn-primary">Simpan</button>
						</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
		<!-- /.modal -->

	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php
$this->load->view('template/_footer');
$this->load->view('template/_js');
?>
<script src="<?= base_url('assets/plugins/jquery-confirm/jquery-confirm.min.js') ?>"></script>
<script src="<?=base_url('assets/bower_components/select2/dist/js/select2.min.js')?>"></script>
<script>
	var kodeInstansi = "";

	//Message Alert
	$(".alert-success").fadeTo(2000, 500).slideUp(500, function(){
	$(".alert-success").slideUp(500);
	});
	
	$("#addInstansi").select2();

	$.fn.dataTableExt.errMode = 'none';
	$.fn.dataTableExt.oApi.fnPagingInfo = function (oSettings) {
		return {
			"iStart": oSettings._iDisplayStart,
			"iEnd": oSettings.fnDisplayEnd(),
			"iLength": oSettings._iDisplayLength,
			"iTotal": oSettings.fnRecordsTotal(),
			"iFilteredTotal": oSettings.fnRecordsDisplay(),
			"iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
			"iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
		};
	};

	function funcTableRegister() {
		tableRegister = $("#tableRegister").DataTable({
			initComplete: function () {
				var api = this.api();
				$('#mytable_filter input')
					.off('.DT')
					.on('input.DT', function () {
						api.search(this.value).draw();
					});
			},
			oLanguage: {
				sProcessing: 'Loading....'
			},
			processing: true,
			serverSide: true,
			ajax: {
				"url": "<?= site_url('Profile/DataRegistrationAPI') ?>",
				"type": "POST"
			},
			columns: [
				{
					"data": null, "searchable": false, "sortable": false
				},
				{
					"data": "nama"
				},
				{
					"data": "instansi"
				},
				{
					"data": "jurusan"
				},
				{
					"data": "nis"
				},
				{
					"data": "nisn"
				},
				{
					"data": "no_telp"
				},
				{
					"data": "username"
				},
				{
					"data": "Action"
				}
			],
			order: [
				[1, 'asc']
			],
			rowCallback: function (row, data, iDisplayIndex) {
				var info = this.fnPagingInfo();
				var page = info.iPage;
				var length = info.iLength;
				var index = page * length + (iDisplayIndex + 1);
				$('td:eq(0)', row).html(index);
			}

		});
		return tableRegister;
	}

	function funcTableInstansi() {
		kodeInstansi = "<?=@$_SESSION['kode_instansi']?>";
		tableInstansi = $("#tableInstansi").DataTable({
			initComplete: function () {
				var api = this.api();
				$('#mytable_filter input')
					.off('.DT')
					.on('input.DT', function () {
						api.search(this.value).draw();
					});
			},
			oLanguage: {
				sProcessing: 'Loading....'
			},
			processing: true,
			serverSide: true,
			ajax: {
				"url": "<?= site_url('Profile/DataInstansiAPI/') ?>" + kodeInstansi,
				"type": "POST"
			},
			columns: [{
					"data": "kode_instansi"
				},
				{
					"data": "nama_instansi"
				},
				{
					"data": "lokasi"
				},
				{
					"data": "tahun"
				},
				{
					"data": "versi"
				},
				{
					"data": "view"
				}
			],
			order: [
				[1, 'asc']
			],
			rowCallback: function (row, data, iDisplayIndex) {
				var info = this.fnPagingInfo();
				var page = info.iPage;
				var length = info.iLength;
				var index = page * length + (iDisplayIndex + 1);
				$('td:eq(0)', row).html(index);
			}

		});
		return tableInstansi;
	}

	function funcTableSiswa(kode_instansi){
		tableSiswa = $("#tableSiswa").DataTable({
			initComplete: function () {
				var api = this.api();
				$('#mytable_filter input')
					.off('.DT')
					.on('input.DT', function () {
						api.search(this.value).draw();
					});
			},
			oLanguage: {
				sProcessing: 'Loading....'
			},
			processing: true,
			serverSide: true,
			ajax: {
				"url": "<?= site_url('Profile/DataSiswaAPI/') ?>" + kode_instansi,
				"type": "POST"
			},
			columns: [
				{
					"data": null,
					"orderable": false,
					"searchable": false
				},
				{
					"data": "nama"
				},
				{
					"data": "nis"
				},
				{
					"data": "nisn"
				},
				{
					"data": "nomor_hp"
				}
				<?php if($_SESSION['hakAkses'] != 3){?>
				,{
					"data": "action"
				}
				<?php } ?>
			],
			order: [
				[1, 'asc']
			],
			rowCallback: function (row, data, iDisplayIndex) {
				var info = this.fnPagingInfo();
				var page = info.iPage;
				var length = info.iLength;
				var index = page * length + (iDisplayIndex + 1);
				$('td:eq(0)', row).html(index);
			}

		});
		return tableSiswa;
	}

	funcTableInstansi();

	$("#tableInstansi").on("click", ".view_data", function () {
		var kode_instansi = $(this).data('instansi');

		$("#tabSiswa").removeClass("hidden");
		$("#tabSiswa").addClass("active");
		$("#siswa").addClass("active");
		$("#tabInstansi").removeClass("active");
		$("#instansi").removeClass("active");

		// console.log(kode_instansi);

		if (tableSiswa instanceof $.fn.dataTable.Api) {
			tableSiswa.destroy();
			funcTableSiswa(kode_instansi);
		}else{
			funcTableSiswa(kode_instansi);			
		}
	})

	$("#tabRegister").click(function(){
		if(tableRegister instanceof $.fn.dataTable.Api){
			tableRegister.destroy();
			funcTableRegister();
		}else{
			funcTableRegister();
		}
	})

	$("#tableRegister").on("click",".btn_add",function(){
		let id = $(this).data("id");
		let nama = $(this).data("nama");
		let instansi = $(this).data("instansi");
		let jurusan = $(this).data("jurusan");
		let nis = $(this).data("nis");
		let nisn = $(this).data("nisn");
		let telp = $(this).data("telp");
		let username = $(this).data("username");
		let img = $(this).data('foto');
		$("#modalTambahSiswa").modal('show');
	
		// Isi Select Option addInstansi
		$.ajax({
			url: "<?= site_url('Profile/NamaInstansiAPI') ?>",
			type: 'POST',
			success:function(result){
				// var data = JSON.parse(result);
				// console.log(result);
				var html = '';
				$.each(result, function(i){
					html += '<option value="'+result[i].kode_instansi+'">'+result[i].nama_instansi+'</option>';
					$('#addInstansi').html(html);
				})
			}
		}).done(function(){
			$(".select2-search__field").val(instansi);
		})

		$("#modalTambahSiswa").find("#idRegister").val(id);
		$("#modalTambahSiswa").find("#addNama").val(nama);
		$("#modalTambahSiswa").find("#addJurusan").val(jurusan);
		$("#modalTambahSiswa").find("#addNis").val(nis);
		$("#modalTambahSiswa").find("#addNisn").val(nisn);
		$("#modalTambahSiswa").find("#addTelp").val(telp);
		$("#modalTambahSiswa").find("#addUsername").val(username);
		$("#modalTambahSiswa").find("#foto").val(img);
	})

	// Isi Select Option addProgram
	$('#addInstansi').on('change', function(){
		var dataInstansi = $(this).val();
		console.log(dataInstansi);
		var url = "<?= site_url('InstansiCtrl/getDataProgramAPI/') ?>" + dataInstansi;
		$.ajax({
			url: url,
			type: 'POST',
			success:function(result){
				var data = JSON.parse(result);
				// console.log(data);
				var html = '';
				$.each(data, function(i){
					html += '<option value="'+data[i].kode_program+'">'+data[i].nama_program+'</option>';
					$('#addProgram').html(html);
				})
			}
		})
	})

	//Fungsi show Password (registrasi siswa)
	$("#btnShowPassword").click(function(){
		if ($("#addPassword").attr("type") == "password") {
			$("#addPassword").prop("type","text");
			$("#btnShowPassword").html("<i class='fa fa-eye-slash'></i>");
		}else{
			$("#addPassword").prop("type","password");
			$("#btnShowPassword").html("<i class='fa fa-eye'></i>");
		}
	})

	// Fungsi Show Password (Profile)
	$(".btnShowPasswordProfile").click(function(){
		if ($(".passwordProfile").attr("type") == "password") {
			$(".passwordProfile").prop("type", "text");
			$(".btnShowPasswordProfile").html("<i class='fa fa-eye-slash'></i>");
		}else{
			$(".passwordProfile").prop("type","password");
			$(".btnShowPasswordProfile").html("<i class='fa fa-eye-slash'></i>");
		}
	})

	// Fungsi Delete Siswa dari Table Siswa
	$("#tableSiswa").on("click",".btn-delete",function(){
		let id = $(this).data("id");
		let nama = $(this).data("nama");
		$.confirm({
			theme: 'supervan',
			title: 'Hapus Siswa Ini ?',
			content: 'Nama Siswa : ' + nama,
			autoClose: 'Cancel|10000',
			buttons: {
			Cancel: function () {},
			delete: {
				text: 'Delete',
				action: function () {
				window.location = "<?= site_url('Profile/hapus/') ?>" + id;
				}
			}
			}
		});
	})

	// Fungsi Edit Siswa dari Table Siswa
	$("#tableSiswa").on("click",".btn-edit",function(){
		let nama = $(this).data("nama");
		let nis = $(this).data("nis");
		let nisn = $(this).data("nisn");
		let nope = $(this).data("nope");
		let jurusan = $(this).data("jurusan");
		let id = $(this).data("id");

		$("#modalUbahSiswa").modal("show");
		$("#ubahNama").val(nama);
		$("#ubahNope").val(nope);
		$("#ubahJurusan").val(jurusan);
		$("#idSiswa").val(id);
	})

	// Fungsi Show modal View Siswa
	$("#tableSiswa").on("click",".btn-view",function(){
		$("#modalViewSiswa").modal("show");
	})

</script>
