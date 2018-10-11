<?php $this->load->view('template/_header'); ?>
<link href="<?= base_url('assets/plugins/bootstrap-validator/bootstrapValidator.min.css') ?>" rel="stylesheet">
<?php $this->load->view('template/_nav'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Program
			<small></small>
		</h1>
	</section>

	<!-- Main content -->
	<section class="content">

		<!-- Default box -->
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title">Tabel Program</h3>

				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
						<i class="fa fa-minus"></i></button>
				</div>
			</div>
			<div class="box-body">

				<?php
				if($_SESSION['hakAkses'] == 1){
					echo '
					<div class="form-group col-md-4">
					<button id="addBtn" type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">Tambah Instansi</button>
					</div>
					<br><br><br>';
				}
				?>
				<table id="demo-dt-selection" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
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
							<?php if($_SESSION['hakAkses'] == 1) echo'
							<td>
								<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">Launch Default Modal</button>
							</td>
							';?>
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

		<!-- Start Modal -->
		<div class="modal fade" id="modal-default">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Default Modal</h4>
					</div>
					<form id="addInstani" method="post" action="<?= site_url('ProgramCtrl/TambahInstansi') ?>">
						<div class="modal-body">
							<div class="form-group">
								<label for="addTahun">Tahun</label>
								<input type="text" name="addTahun" id="addTahun" class="form-control" placeholder="2018" autofocus>
							</div>
							<div class="form-group">
								<label>Kode Instansi</label>
								<div class="input-group">
									<div class="input-group-addon">
										010.
									</div>
									<input type="text" class="form-control" id="addId" name="addId" placeholder="9999" aria-describedby="helpId">
								</div>
								<!-- /.input group -->
								<!-- <small id="helpId" class="text-muted"></small> -->
							</div>
							<div class="form-group">
								<label for="addInstansi">Nama Instansi</label>
								<input type="text" name="addInstansi" id="addInstansi" class="form-control" placeholder="ex : SMKN 2 Surabaya">
							</div>
							<div class="form-group">
								<label for="addVersi">Versi</label>
								<input type="text" name="addVersi" id="addVersi" class="form-control" placeholder="-">
							</div>
							<div class="form-group">
								<label for="addKet">Keterangan</label>
								<textarea class="form-control" name="addKet" id="addKet" rows="3" placeholder="Keterangan"></textarea>
							</div>
							<hr>
							<div class="form-group">
								<label for="addUser">Username</label>
								<input type="text" name="addUser" id="addUser" class="form-control" placeholder="Virgorasion">
							</div>
							<div class="form-group">
								<label for="addPass">Password</label>
								<input type="password" name="addPass" id="addPass" class="form-control" placeholder="********">
							</div>
							<div class="form-group">
								<label for="confirmPassword">Confirmasi Password</label>
								<input type="password" name="confirmPassword" id="confirmPassword" class="form-control" placeholder="********">
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

	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php
$this->load->view('template/_footer');
$this->load->view('template/_js');
?>
<script src="<?= base_url('assets/plugins/bootstrap-validator/bootstrapValidator.min.js') ?>"></script>
<script>
	// Row selection (single row)
	// -----------------------------------------------------------------
	var rowSelection = $('#demo-dt-selection').DataTable({
		"responsive": true,
		"language": {
			"paginate": {
				"previous": '<i class="fa fa-angle-left"></i>',
				"next": '<i class="fa fa-angle-right"></i>'
			}
		}
	});
	$('#demo-dt-selection').on('click', 'tr', function () {
		var $item = $(this).closest('tr');
		var $kode = $item.find('#kode').text();
		// alert($kode+"asdasd");
		window.location = "<?= site_url('ProgramCtrl/ProgramDetails/') ?>" + $kode;

	});

	var faIcon = {
		valid: 'fa fa-check-circle fa-lg text-success',
		invalid: 'fa fa-times-circle fa-lg',
		validating: 'fa fa-refresh'
	}

	$('#addInstani').bootstrapValidator({
		message: 'This value is not valid',
		feedbackIcons: faIcon,
		fields: {
		addPass: {
			validators: {
				notEmpty: {
					message: 'The password is required and can\'t be empty'
				},
				identical: {
					field: 'confirmPassword',
					message: 'The password and its confirm are not the same'
				}
			}
		},
		confirmPassword: {
			validators: {
				notEmpty: {
					message: 'The confirm password is required and can\'t be empty'
				},
				identical: {
					field: 'addPass',
					message: 'The password and its confirm are not the same'
				}
			}
		}
	}
	});

</script>
