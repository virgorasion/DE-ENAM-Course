<?php $this->load->view('template/_header'); ?>
<link href="<?= base_url('assets/plugins/bootstrap-validator/bootstrapValidator.min.css') ?>" rel="stylesheet">
<link href="<?= base_url('assets/plugins/bootstrap-select/bootstrap-select.min.css') ?>" rel="stylesheet">
<link href="<?= base_url('assets/plugins/jquery-confirm/jquery-confirm.min.css') ?>" rel="stylesheet">
<?php $this->load->view('template/_nav'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Instansi
			<small></small>
		</h1>
	</section>

	<!-- Main content -->
	<section class="content">

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

		<!-- Default box -->
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title">Tabel Instansi</h3>

				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
						<i class="fa fa-minus"></i></button>
				</div>
			</div>
			<div class="box-body">

				<?php
				if($_SESSION['hakAkses'] == 1){ ?>
				<div class="form-group">
					<button id="addBtn" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahInstansi">Tambah
						Instansi</button>
					<button id="addBtn" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahSiswa">Tambah
						Siswa</button>
				</div>
				<?php } ?>
				<?php if($_SESSION['hakAkses'] == 2){ ?>
				<div class="form-group">
					<button id="addBtn" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahSiswa">Tambah
						Siswa</button>
				</div>
				<?php } ?>
				<table id="datatable" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>Tahun</th>
							<th>Kode</th>
							<th class="min-tablet">Nama Instansi</th>
							<th class="min-tablet">Versi</th>
							<th class="min-desktop">Keterangan</th>
							<th class="min-desktop">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						foreach($data as $item):
						$tgl = explode('-', $item->tahun);
						$tahun = $tgl[0];
						?>
						<tr>
							<td id="tahun">
								<?= $tahun ?>
							</td>
							<td id="kode">
								<?= $item->kode_instansi ?>
							</td>
							<td id="unit">
								<?= $item->nama_instansi ?>
							</td>
							<td id="versi">
								<?= $item->versi ?>
							</td>
							<td id="keterangan">
								<?= $item->keterangan ?>
							</td>
							<?php if($_SESSION['hakAkses'] == 1) { ?>
							<td>
								<input type="hidden" name="idInstansi" id="idInstansi" class="form-control" value="<?= $item->id ?>">
								<a href="#">
									<span data-placement="top" data-toggle="tooltip" title="View"></span>
									<button class="btn btn-primary btn-xs btnView" data-title="View" id="btnView">
										<span class="fa fa-eye"></span>
									</button>
								</a>
								<a href="#">
									<span data-placement="top" data-toggle="tooltip" title="Edit"></span>
									<button class="btn btn-warning btn-xs btnEdit" data-toggle="modal" data-target="#modalEditInstansi" data-title="Edit"
									 id="btnEdit">
										<span class="fa fa-pencil"></span>
									</button>
								</a>
								<a href="#">
									<span data-placement="top" data-toggle="tooltip" title="Delete"></span>
									<button class="btn btn-danger btn-xs btnDelete" data-title="Delete" id="btnDelete">
										<span class="fa fa-remove"></span>
									</button>
								</a>
							</td>
							<?php } ?>
							<?php if ($_SESSION['hakAkses'] == 2) { ?>
							<td>
								<input type="hidden" name="idInstansi" id="idInstansi" class="form-control" value="<?= $item->id ?>">
								<?php if ($_SESSION['kode_instansi'] == $item->kode_instansi) { ?>
								<a href="#">
									<span data-placement="top" data-toggle="tooltip" title="View"></span>
									<button class="btn btn-primary btn-xs btnView" data-title="View" id="btnView">
										<span class="fa fa-eye"></span>
									</button>
								</a>
								<?php } ?>
							</td>
							<?php } ?>
							<?php if ($_SESSION['hakAkses'] == 3) { ?>
							<td>
								<?php if ($_SESSION['kode_instansi'] == $item->kode_instansi) { ?>
								<a href="#">
									<span data-placement="top" data-toggle="tooltip" title="View"></span>
									<button class="btn btn-primary btn-xs btnView" data-title="View" id="btnView">
										<span class="fa fa-eye"></span>
									</button>
								</a>
								<?php } ?>
							</td>
							<?php } ?>
						</tr>
						<?php
						endforeach;
						?>
					</tbody>
				</table>

			</div>
			<!-- /.box-body -->
		</div>
		<!-- /.box -->

		<?php $this->load->view('modal/_modalInstansi', $instansi) ?>

	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php
$this->load->view('template/_footer');
$this->load->view('template/_js');
?>
<script src="<?= base_url('assets/plugins/bootstrap-validator/bootstrapValidator.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/bootstrap-select/bootstrap-select.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/jquery-confirm/jquery-confirm.min.js') ?>"></script>
<!-- <script src="<?= base_url('assets/main_assets/js/_instansiJS.js')?>"></script> -->
<?php $this->load->view('js/_instansiJS') ?>
