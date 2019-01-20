<?php $this->load->view('template/_header'); ?>
<link href="<?= base_url('assets/plugins/jquery-confirm/jquery-confirm.min.css') ?>" rel="stylesheet">
<?php $this->load->view('template/_nav'); ?>
<?php 
$dataModal['kodeInstansi'] = $kode;
$dataModal['hakAkses'] = $_SESSION['hakAkses'];
$dataModal['patokan'] = $patokan;
 ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Program
			<?= @$namaProgram ?>
			<small>it all starts here</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="<?=site_url('InstansiCtrl')?>"><i class="fa fa-dashboard"></i> Instansi</a></li>
			<li><a href="#">Program</a></li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">

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

		<!-- Box Program -->
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title">Table Program</h3>

				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
						<i class="fa fa-minus"></i></button>
					<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
						<i class="fa fa-times"></i></button>
				</div>
			</div>
			<div class="box-body">
				<!-- FORM VALIDATION ON TABS -->
				<!--===================================================-->
				<div class="tab-base">

					<!-- Nav tabs -->
					<ul class="nav nav-tabs" id="tab-nav">
						<li id="tabRekapProgram" class="tabRekapitulasi">
							<a href="#nav-tab-program-1" data-toggle="tab">
								<i class="fa fa-history"></i> Rekapitulasi</a>
						</li>
						<li id="tabProgram" class="tabProgram active">
							<a href="#nav-tab-program-2" data-toggle="tab">
								<i class="fa fa-edit"></i>Program</a>
						</li>
						<li id="tabKodeRekening" class="tabKodeRekening hidden">
							<a href="#nav-tab-program-3" data-toggle="tab">
								<i class="fa fa-edit"></i>Kode Rekening</a>
						</li>
						<li id="tabCetakProgram" class="tabCetak">
							<a href="#nav-tab-program-4" data-toggle="tab">
								<i class="fa fa-edit"></i> Cetak</a>
						</li>
						<li id="tabValidaiProgram" class="tabValidasi">
							<a href="#nav-tab-program-5" data-toggle="tab">
								<i class="fa fa-edit"></i> Validasi</a>
						</li>
					</ul>

					<!-- Tabs Content -->
					<div id="demo-bv-bsc-tabs" class="form-horizontal">
						<div class="tab-content">

							<!-- Start Rekapitulasi Tab -->
							<div class="tab-pane pad-btm fade" id="nav-tab-program-1">
							</div>

							<!-- Start Program Tab -->
							<div class="tab-pane fade in active" id="nav-tab-program-2">
								<?php if ($_SESSION['hakAkses'] != 3) { ?>
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<div class="form-inline col-md-2">
										<br>
										<div class="form-group col-sm-4">
											<a name="btnAdd" id="btnAdd" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah">Tambah
												Data</a>
										</div>
									</div>
								</div>
								<br><br>
								<hr>
								<?php } ?>
								<table id="tableProgram" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>No</th>
											<th>Kode</th>
											<th>Nama Program</th>
											<th>Plafon</th>
											<th>Total Rek</th>
											<th>Tot. Rinci</th>
											<th>action</th>
										</tr>
									</thead>
									<tbody>
										<?php
									$no = 1;
									foreach ($data as $item) {
										if ($item->total_rinci != $item->plafon) {
											$class = "label label-danger";
										}else{
											$class = "label label-success";
										}
										if ($item->total_rekening != $item->plafon) {
											$alert = "label label-danger";
										}else {
											$alert = "label label-success";
										}
									?>
										<tr>
											<input type="hidden" id="idSiswa" name="idSiswa" value="<?= $item->id_siswa ?>">
											<td id="no">
												<?= $no ?>
											</td>
											<td id="kode_program">
												<?= $item->kode_program ?>
											</td>
											<td id="nama_program">
												<?= $item->nama_program ?>
											</td>
											<td id="plafon">
												<?= number_format((double)$item->plafon,0,".",","); ?>
											</td>
											<td id="t_rek_program">
												<span class="<?= $alert ?>" style="font-size:12px">
													<?= number_format((double)$item->total_rekening, 0, ".", ","); ?></span>
											</td>
											<td id="t_rinci_program" align="center">
												<span class="<?=$class?>" style="font-size:12px">
													<?= number_format((double)$item->total_rinci,0,".",","); ?></span>
											</td>
											<?php if($_SESSION['hakAkses'] == 3) { ?>
											<td>
												<input type="hidden" id="idProgram" name="idProgram" value="<?= $item->id ?>">
												<?php if ($_SESSION['id_siswa']==$item->id_siswa && $_SESSION['instansiSiswa'] == $item->kode_instansi && $_SESSION['programSiswa'] == $item->kode_program) { ?>
												<a href="#">
													<span data-placement="top" data-toggle="tooltip" title="View"></span>
													<button class="btn btn-info btn-xs btnView" data-title="View" id="btnView">
														<span class="fa fa-eye"></span>
													</button>
												</a>
												<?php } ?>
												<!-- <?php if ($_SESSION['id_siswa'] == $item->id_siswa && $_SESSION['instansiSiswa'] == $item->kode_instansi && $_SESSION['programSiswa'] == $item->kode_program) { ?>
												<a href="#">
													<span data-placement="top" data-toggle="tooltip" title="Edit"></span>
													<button class="btn btn-warning btn-xs btnEdit" data-title="Edit" id="btnEdit" data-toggle="modal" data-target="#modal-edit">
														<span class="fa fa-pencil"></span>
													</button>
												</a>
												<?php } ?> -->
											</td>
											<?php } ?>
											<?php if ($_SESSION['hakAkses'] != 3) { ?>
											<td>
												<input type="hidden" id="idProgram" name="idProgram" value="<?= $item->id ?>" <a href="#">
												<span data-placement="top" data-toggle="tooltip" title="View"></span>
												<button class="btn btn-primary btn-xs btnView" data-title="View" id="btnView">
													<span class="fa fa-eye"></span>
												</button>
												</a>
												<a href="#">
													<span data-placement="top" data-toggle="tooltip" title="Edit"></span>
													<button class="btn btn-warning btn-xs btnEdit" data-title="Edit" id="btnEdit" data-toggle="modal"
													 data-target="#modal-edit">
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
										</tr>
										<?php $no++; }?>
									</tbody>
								</table>
							</div>

							<!-- Start Kode Rekening Tab -->
							<div class="tab-pane fade in" id="nav-tab-program-3">
								<?php if ($_SESSION['hakAkses'] != 2) { ?>
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<div class="form-inline col-md-2">
										<br>
										<div class="form-group col-sm-4">
											<a name="btnAddRekening" id="btnAddRekening" class="btn btn-primary">Tambah Data</a>
										</div>
									</div>
								</div>
								<br><br>
								<hr>
								<?php } ?>
								<table id="tableRekening" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>Kode</th>
											<th class="min-tablet">Nama Uraian</th>
											<th class="min-tablet">T1</th>
											<th class="min-desktop">T2</th>
											<th class="min-desktop">T3</th>
											<th class="min-desktop">T4</th>
											<th class="min-desktop">Total</th>
											<th class="min-desktop">Tot. Rinci</th>
											<th class="min-desktop">Action</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>

							<!-- Start Cetak Tab -->
							<div class="tab-pane fade" id="nav-tab-program-4">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<h4><b>Data Siswa</b></h4>
								</div>
								<table id="tableSiswaCetak" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>NISN</th>
											<th>NIS</th>
											<th>Nama</th>
											<th>Instansi</th>
											<th>Program</th>
											<th class="text-center">View</th>
											<th class="text-center">Print AKB</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
								<div id="kegiatanCetak" style="display:none">
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
										<h4><b>Data Kegiatan Siswa</b></h4>
									</div>
									<table id="tableKegiatanCetak" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
										<thead>
											<tr>
												<th>No</th>
												<th>Kode</th>
												<th>Uraian Kegiatan</th>
												<th>Keterangan</th>
												<th>Total Rek.</th>
												<th>Tot. Rinci</th>
												<th class="text-center">Print RKA</th>
												<th class="text-center">Print Cover</th>
											</tr>
										</thead>
										<tbody>
											<div id="tableKegiatanCetak_processing" class="dataTables_processing" style="display: none;">Loading....</div>
										</tbody>
									</table>
								</div>
							</div>

							<!-- Start Validasi Tab -->
							<div class="tab-pane fade" id="nav-tab-program-5">
								<h4 class="mar-btm text-thin">Tambah Data</h4>
								<hr>
								<form action="<?php echo site_url('kas_ctrl/tambah'); ?>" method="POST">
									<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
									<div class="form-group">
										<label class="col-lg-3 control-label">Nama :</label>
										<div class="col-lg-7">
											<input type="text" class="form-control" name="addNama" placeholder="Nama">
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-3 control-label">Kategori</label>
										<div class="col-lg-7">
											<select class="form-control" name="addKategori" id="addKategori">
												<option value="6">Donatur Tetap</option>
												<option value="7">Donatur Tidak Tetap</option>
												<option value="8">Infaq</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-3 control-label">Tanggal :</label>
										<div class="col-lg-7">
											<input type="text" class="form-control datepicker" name="addTanggal" placeholder="Tanggal" autocomplete="off">
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-3 control-label">Jumlah</label>
										<div class="col-lg-7">
											<input type="text" class="form-control inputMask" name="addJumlah" placeholder="Jumlah">
										</div>
									</div>
									<div class="col-lg-7 col-lg-offset-3">
										<input type="submit" value="Submit" class="btn btn-flat btn-primary">
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!--===================================================-->
				<!-- END FORM VALIDATION ON TABS -->
			</div>
			<!-- /.box-body -->
		</div>
		<!-- End Box Program -->

	<div class="modal fade" id="modalLoading" tabindex="-1" role="dialog" aria-labelledby="myModal-label" aria-hidden="true">
      <div class="modal-dialog">
          <div class="text-center" style="margin-top:50%">
            <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
          </div>
      </div>
    </div>

		<!-- Box Kegiatan -->
		<?php $this->load->view('box/_boxKegiatan') ?>
		<!-- End Box Program Details -->

		<!-- Box DetailRekening -->
		<?php $this->load->view('box/_boxDetailRekening') ?>
		<!-- End Box DetailRekening -->

		<!-- Modal Program & Modal Kegiatan -->
		<?php $this->load->view('modal/_modalProgram', $dataModal) ?>
		<!-- End Modal Program & Modal Kegiatan -->

	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php 
$this->load->view('template/_footer');
$this->load->view('template/_js');
?>
<script src="<?= base_url('assets/plugins/input-mask/jquery.inputmask.bundle.js') ?>"></script>
<script src="<?= base_url('assets/plugins/jquery-confirm/jquery-confirm.min.js') ?>"></script>
<!-- Select2 -->
<script src="<?= base_url('assets/bower_components/select2/dist/js/select2.full.min.js') ?>"></script>
<?php $this->load->view('js/_programJS', $dataModal) ?>
