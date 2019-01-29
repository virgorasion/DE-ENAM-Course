<?php $this->load->view('template/_header'); ?>
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
								<b>Password</b> <a class="pull-right"><?=str_replace(substr(@$data[0]->password,0,20),'***********',substr(@$data[0]->password,0,20))?></a>
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
								<b>Password</b> <a class="pull-right"><?=str_replace(substr(@$data[0]->password,0,20),'***********',substr(@$data[0]->password,0,20))?></a>
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
						<img class="profile-user-img img-responsive img-circle" src="<?=base_url('assets/images/user.png')?>" alt="Empty.">

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
								<b>Password</b> <a class="pull-right"><?=str_replace(substr(@$data[0]->password,0,20),'***********',substr(@$data[0]->password,0,20))?></a>
							</li>
						</ul>

						<a href="#" data-toggle="modal" data-target="#modalUbah" class="btn btn-primary btn-block"><b>Ubah</b></a>
					</div>
					<!-- /.box-body -->
				</div>
				<?php } ?>
				<!-- /.box -->

			</div>
			<!-- /.col -->
			<?php if ($_SESSION['hakAkses'] != 3){ ?>
			<div class="col-md-9">
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs">
						<li class="active" id="tabInstansi"><a href="#instansi" data-toggle="tab">Instansi</a></li>
						<li class="hidden" id="tabSiswa"><a href="#siswa" data-toggle="tab">Siswa</a></li>
					</ul>

					<div class="tab-content">
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
						<!-- /.tab-pane -->
						<div class="tab-pane" id="siswa">
							<table id="tableSiswa" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>No.</th>
										<th class="min-tablet">Nama</th>
										<th class="min-tablet">NIS</th>
										<th class="min-desktop">NISN</th>
										<th class="min-desktop">HP</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
						<!-- /.tab-pane -->

					</div>
					<!-- /.tab-content -->
				</div>
				<!-- /.nav-tabs-custom -->
			</div>
			<?php } ?>
			<!-- /.col -->
		</div>
		<!-- /.row -->

		<!-- Start Modal Tambah Program -->
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

	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php
$this->load->view('template/_footer');
$this->load->view('template/_js');
?>
<script>
	var kodeInstansi = "";

	//Message Alert
	$(".alert-success").fadeTo(2000, 500).slideUp(500, function(){
	$(".alert-success").slideUp(500);
	});


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

</script>
