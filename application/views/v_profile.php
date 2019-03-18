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
	<?php } ?>
	<?php if (@$_SESSION['succ'] != null) { ?>
	<div class="alert alert-success alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<h4><i class="icon fa fa-check"></i> Success! </h4>
		<?= $_SESSION['succ'] ?>
	</div>
	<?php } ?>
	<?php if (@$error != null) { ?>
	<div class="alert alert-danger alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<h4><i class="icon fa fa-check"></i> Failed! </h4>
		<div><?= @$error ?></div>
		<div><?= @$name ?></div>
	</div>
	<?php } ?>

	<!-- Main content -->
	<section class="content">

		<div class="row">
			<div class="col-md-3">

				<!-- Profile Image Admin -->
				<?php if (@$_SESSION['hakAkses'] == 1) { ?>
				<div class="box box-primary">
					<div class="box-body box-profile">
						<img class="profile-user-img img-responsive img-circle foto" src="<?=base_url('assets/images/').$_SESSION['foto']?>" alt="Empty.">

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
						<img class="profile-user-img img-responsive img-circle foto" src="<?=base_url('assets/images/user.png')?>" alt="Empty.">

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
						<img class="profile-user-img img-responsive img-circle foto" src="<?=base_url('assets/images/').@$data[0]->foto?>" alt="<?=base_url('assets/images/user.png')?>">
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

		<!-- Start Modal Edit Password -->
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
							<center>
								<img src="" class="img-circle RegistrasiFoto" width="150" height="150" alt="Empty">
							</center><br><br>
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

		<?php if($_SESSION['hakAkses'] == 1) { ?>
		<!-- Start Modal Edit Siswa -->
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
								<input type="text" name="ubahNamaSiswa" id="ubahNamaSiswa" class="form-control">
							</div>
							<!-- Tekan kene seng nyar -->
							<div class="form-group">
								<label>Instansi</label>
								<select class="form-control" id="ubahInstansiSiswa" name="ubahInstansiSiswa">
									<!-- Diisi Ajax -->
								</select>
							</div>
							<div class="form-group">
								<label for="ubahNama">Program</label>
								<select class="form-control" id="ubahProgramSiswa" name="ubahProgramSiswa">
									<!-- Diisi Ajax -->
								</select>
							</div>
							<div class="form-group">
								<label for="ubahJurusanSiswa">Jurusan</label>
								<input type="text" name="ubahJurusanSiswa" id="ubahJurusanSiswa" class="form-control">
							</div>
							<div class="form-group">
								<label>NIS</label>
								<input type="text" class="form-control" id="ubahNisSiswa" name="ubahNisSiswa">
							</div>
							<div class="form-group">
								<label>NISN</label>
								<input type="text" class="form-control" id="ubahNisnSiswa" name="ubahNisnSiswa">
							</div>
							<div class="form-group">
								<label for="ubahNopeSiswa">Nomor HP</label>
								<input type="text" name="ubahNopeSiswa" id="ubahNopeSiswa" class="form-control">
							</div>
							<div class="form-group">
								<label>Username</label>
								<input type="text" class="form-control" id="ubahUsernameSiswa" name="ubahUsernameSiswa" readonly>
							</div>

							<label for="ubahPasswordSiswa">Passowrd</label>
							<div class="input-group input-group-sm">
								<input required type="password" id="ubahPasswordSiswa" name="ubahPasswordSiswa" class="passwordProfile form-control">
									<span class="input-group-btn">
									<button type="button" class="btnShowUbahPasswordSiswa btn btn-info btn-flat"><i class="fa fa-eye"></i></button>
									</span>
							</div>
						</div>
						<input type="hidden" name="idSiswa" id="idSiswa" value="" />
						<input type="hidden" name="oldKodeProgram" id="oldKodeProgram" value="" />
						<input type="hidden" name="oldKodeInstansi" id="oldKodeInstansi" value="" />
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
		<?php } ?>

		<?php if($_SESSION['hakAkses'] == 1) { ?>
		<!-- Start Modal Edit Instansi -->
		<div class="modal fade" id="modalEditInstansi">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Edit Instansi</h4>
					</div>
					<form class="form-horizontal" action="<?=site_url("Profile/ubahDataInstansi")?>" method="post" enctype="multipart/form-data">
						<div class="modal-body">
							<center>
								<img src="" id="editFotoInstansi" class="img-circle" width="150" height="150" alt="Empty">
								<!-- <input type="file" name="editFotoInstansi" id="editFotoInstansi" class="hidden"> -->
							</center><br><br>
							
							<div class="form-group">
								<label class="col-sm-2 control-label">Kode Instansi</label>
									<div class="col-sm-9">
										<input type="text" name="editKodeInstansi" id="editKodeInstansi" class="form-control" readonly>
									</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Nama Instansi</label>
									<div class="col-sm-9">
										<input type="text" name="editNamaInstansi" id="editNamaInstansi" class="form-control">
									</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Versi</label>
									<div class="col-sm-9">
										<input type="text" name="editVersiInstansi" id="editVersiInstansi" class="form-control">
									</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Lokasi</label>
									<div class="col-sm-9">
										<input type="text" name="editLokasiInstansi" id="editLokasiInstansi" class="form-control">
									</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Keterangan</label>
									<div class="col-sm-9">
										<input type="text" name="editKeteranganInstansi" id="editKeteranganInstansi" class="form-control">
									</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Tahun</label>
									<div class="col-sm-9">
										<input type="text" name="editTahunInstansi" id="editTahunInstansi" class="form-control">
									</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Username</label>
									<div class="col-sm-9">
										<input type="text" name="editUsernameInstansi" id="editUsernameInstansi" class="form-control" readonly>
									</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">Password</label>
									<div class="col-sm-9">
										<input type="text" name="editPasswordInstansi" id="editPasswordInstansi" class="form-control">
									</div>
							</div>
							
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
		<?php } ?>

		<!-- Start Modal View Siswa -->
		<div class="modal fade" id="modalView">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="modalTitle"></h4>
					</div>
					<form class="form-horizontal">
						<div class="modal-body" id="viewModalBody">
							<!-- Data diisi Ajax -->
						</div>
					</form>
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
						</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
		<!-- /.modal -->

		<!-- Start Modal Change Image Profile -->
		<div class="modal fade" id="modalEditFoto">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title"> Ganti Foto Profile</h4>
					</div>
					<form action="<?=site_url('Profile/GantiFotoProfile')?>" method="POST" enctype="multipart/form-data" class="form-horizontal">
						<div class="modal-body">
							<input type="file" id="foto" name="foto">
							<div class="row">
								<img class="img-responsive">
							</div>
						</div>
						
						<input type="hidden" name="hakAkses" id="hakAkses" value="<?=$_SESSION['hakAkses']?>">
						<input type="hidden" name="idUser" id="idUser" value="<?=$_SESSION['id'] == NULL ? $_SESSION['id_siswa'] : $_SESSION['id'] ?>">						
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
<script src="<?= base_url('assets/plugins/jquery-confirm/jquery-confirm.min.js') ?>"></script>
<script src="<?= base_url('assets/bower_components/select2/dist/js/select2.min.js')?>"></script>
<?php
$this->load->view("js/_profileJS");
?>