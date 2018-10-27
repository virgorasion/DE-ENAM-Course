<?php 
$this->load->view('template/_header');
$this->load->view('template/_nav');
?>
<?php $kodeInstansi = $kode; ?>
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
					<ul class="nav nav-tabs">
						<li>
							<a href="forms-validation.html#demo-bsc-tab-1" data-toggle="tab">
								<i class="fa fa-history"></i> Rekapitulasi</a>
						</li>
						<li class="active">
							<a href="forms-validation.html#demo-bsc-tab-2" data-toggle="tab">
								<i class="fa fa-edit"></i>Kegiatan</a>
						</li>
						<li>
							<a href="forms-validation.html#demo-bsc-tab-3" data-toggle="tab">
								<i class="fa fa-edit"></i> Cetak</a>
						</li>
						<li>
							<a href="forms-validation.html#demo-bsc-tab-4" data-toggle="tab">
								<i class="fa fa-edit"></i> Validasi</a>
						</li>
					</ul>

					<!-- Tabs Content -->
					<div id="demo-bv-bsc-tabs" class="form-horizontal">
						<div class="tab-content">
							<div class="tab-pane pad-btm fade " id="demo-bsc-tab-1">
							</div>
							<!-- Start Second Tab -->
							<div class="tab-pane fade in active" id="demo-bsc-tab-2">
								<?php if ($_SESSION['hakAkses'] != 3) { ?>
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<div class="form-inline col-md-2">
										<br>
										<div class="form-group col-sm-4">
											<a name="btnAdd" id="btnAdd" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah">Tambah Data</a>
										</div>
									</div>
								</div>
								<br><br>
								<hr>
								<?php } ?>
								<table id="datatable" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>No</th>
											<th>Kode</th>
											<th class="min-tablet">Nama Program</th>
											<th class="min-tablet">Plafon</th>
											<th class="min-desktop">Total Rek</th>
											<th class="min-desktop">Tot. Rinci</th>
											<th class="min-desktop">action</th>
										</tr>
									</thead>
									<tbody>
										<?php
									$no = 1;
									foreach ($data as $item) :
									?>
										<tr>
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
												<?= $item->plafon ?>
											</td>
											<td id="t_rek_program">
												<?= $item->total_rekening ?>
											</td>
											<td id="t_rinci_program">
												<?= $item->total_rinci ?>
											</td>
											<?php if($_SESSION['hakAkses'] == 3) { ?>
											<td>
												<input type="hidden" id="idProgram" name="idProgram" value="<?= $item->id ?>"
												<?php if ($_SESSION['id_siswa'] == $item->id_siswa && $_SESSION['instansiSiswa'] == $item->kode_instansi && $_SESSION['programSiswa'] == $item->kode_program) { ?>
												<a href="#">
													<span data-placement="top" data-toggle="tooltip" title="View"></span>
													<button class="btn btn-primary btn-xs btnView" data-title="View" id="btnView">
														<span class="fa fa-eye"></span>
													</button>
												</a>
												<?php } ?>
												<?php if ($_SESSION['id_siswa'] == $item->id_siswa && $_SESSION['instansiSiswa'] == $item->kode_instansi && $_SESSION['programSiswa'] == $item->kode_program) { ?>
												<a href="#">
													<span data-placement="top" data-toggle="tooltip" title="Edit"></span>
													<button class="btn btn-warning btn-xs btnEdit" data-title="Edit" id="btnEdit" data-toggle="modal" data-target="#modal-edit">
														<span class="fa fa-pencil"></span>
													</button>
												</a>
												<?php } ?>
											</td>
											<?php } ?>
											<?php if ($_SESSION['hakAkses'] != 3) { ?>
											<td>
												<input type="hidden" id="idProgram" name="idProgram" value="<?= $item->id ?>"
												<a href="#">
													<span data-placement="top" data-toggle="tooltip" title="View"></span>
													<button class="btn btn-primary btn-xs btnView" data-title="View" id="btnView">
														<span class="fa fa-eye"></span>
													</button>
												</a>
												<a href="#">
													<span data-placement="top" data-toggle="tooltip" title="Edit"></span>
													<button class="btn btn-warning btn-xs btnEdit" data-title="Edit" id="btnEdit" data-toggle="modal" data-target="#modal-edit">
														<span class="fa fa-pencil"></span>
													</button>
												</a>
											</td>
											<?php } ?>
										</tr>
										<?php $no++;
									endforeach; ?>
									</tbody>
								</table>
							</div>

							<!-- Start Second Tab -->
							<div class="tab-pane fade" id="demo-bsc-tab-3">
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

							<!-- Start Second Tab -->
							<div class="tab-pane fade" id="demo-bsc-tab-2">
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

		<!-- Box Kegiatan -->
		<div id="boxDetail" class="box hidden">
			<div class="box-header with-border">
				<h3 class="box-title">Table Kegiatan</h3>

				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
						<i class="fa fa-minus"></i></button>
					<button type="button" class="btn btn-box-tool" id="btnHidden" title="Hidden">
						<i class="fa fa-times"></i></button>
				</div>
			</div>
			<div class="box-body">
				<!-- FORM VALIDATION ON TABS -->
				<!--===================================================-->
				<div class="tab-base">

					<!-- Nav tabs -->
					<ul class="nav nav-tabs">
						<li>
							<a href="forms-validation.html#demo-bsc-tab-1" data-toggle="tab">
								<i class="fa fa-history"></i> Info Kegiatan</a>
						</li>
						<li>
							<a href="forms-validation.html#demo-bsc-tab-2" data-toggle="tab">
								<i class="fa fa-edit"></i> Indikator</a>
						</li>
						<li>
							<a href="forms-validation.html#demo-bsc-tab-3" data-toggle="tab">
								<i class="fa fa-edit"></i> Penanggung Jawab</a>
						</li>
						<li class="active">
							<a href="forms-validation.html#demo-bsc-tab-4" data-toggle="tab">
								<i class="fa fa-edit"></i> Rincian Kegiatan</a>
						</li>
						<li>
							<a href="forms-validation.html#demo-bsc-tab-5" data-toggle="tab">
								<i class="fa fa-edit"></i> Pembahasan</a>
						</li>
					</ul>

					<!-- Tabs Content -->
					<div id="demo-bv-bsc-tabs" class="form-horizontal">
						<div class="tab-content">
							<!-- Start First Tab -->
							<div class="tab-pane pad-btm fade " id="demo-bsc-tab-1">
							</div>

							<!-- Start Second Tab -->
							<div class="tab-pane fade" id="demo-bsc-tab-2">
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

							<!-- Start Third Tab -->
							<div class="tab-pane fade" id="demo-bsc-tab-3">
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

							<!-- Start Fourth Tab -->
							<div class="tab-pane fade in active" id="demo-bsc-tab-4">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<div class="form-inline col-md-2">
										<br>
										<div class="form-group col-sm-4">
											<a name="btnAddKegiatan" id="btnAddKegiatan" class="btn btn-primary">Tambah Data</a>
										</div>
									</div>
								</div>
								<br><br>
								<hr>
								<table id="tableKegiatan" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>No</th>
											<th>Kode</th>
											<th class="min-tablet">Uraian Kegiatan</th>
											<th class="min-tablet">Keterangan</th>
											<th class="min-desktop">Total Rek</th>
											<th class="min-desktop">Tot. Rinci</th>
											<th class="min-desktop">action</th>
										</tr>
									</thead>
									<tbody>
									
											<?php if ($_SESSION['hakAkses'] == 3) { ?>
											<td>
												<input type="hidden" id="idKegiatan" name="idKegiatan" value="<?= $item->id ?>"
												<a href="#">
													<span data-placement="top" data-toggle="tooltip" title="View"></span>
													<button class="btn btn-primary btn-xs btnView" data-title="View" id="btnView">
														<span class="fa fa-eye"></span>
													</button>
												</a>
												<a href="#">
													<span data-placement="top" data-toggle="tooltip" title="Edit"></span>
													<button class="btn btn-warning btn-xs btnEdit" data-title="Edit" id="btnEdit" data-toggle="modal" data-target="#modal-edit">
														<span class="fa fa-pencil"></span>
													</button>
												</a>
											</td>
											<?php } ?>
											<?php if ($_SESSION['hakAkses'] != 3) { ?>
											<td>
												<input type="hidden" id="idKegiatan" name="idKegiatan" value="<?= $item->id ?>"
												<a href="#">
													<span data-placement="top" data-toggle="tooltip" title="View"></span>
													<button class="btn btn-primary btn-xs btnView" data-title="View" id="btnView">
														<span class="fa fa-eye"></span>
													</button>
												</a>
												<a href="#">
													<span data-placement="top" data-toggle="tooltip" title="Edit"></span>
													<button class="btn btn-warning btn-xs btnEdit" data-title="Edit" id="btnEdit" data-toggle="modal" data-target="#modal-edit">
														<span class="fa fa-pencil"></span>
													</button>
												</a>
											</td>
											<?php } ?>

									</tbody>
								</table>
							</div>

							<!-- Start Fiveth Tab -->
							<div class="tab-pane fade" id="demo-bsc-tab-5">
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
			<div class="box-footer">
				Footer
			</div>
			<!-- /.box-footer-->
		</div>
		<!-- End Box Program Details -->

		<?php if ($_SESSION['hakAkses'] != 3) { ?>
		<!-- Start Modal Tambah Program -->
		<div class="modal fade" id="modal-tambah">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Edit Program</h4>
					</div>
					<form id="formTambah" method="post" action="<?= site_url('ProgramCtrl/TambahProgram') ?>">
						<div class="modal-body">
							<div class="form-group">
								<label>Kode Program</label>
								<div class="input-group">
									<div class="input-group-addon">
										127.
									</div>
									<input type="text" class="form-control" id="addKodeProgram" name="addKodeProgram" placeholder="9999"
									 aria-describedby="helpId">
								</div>
								<!-- /.input group -->
								<!-- <small id="helpId" class="text-muted"></small> -->
							</div>
							<div class="form-group">
								<label for="addNamaProgram">Nama Program</label>
								<input type="text" name="addNamaProgram" id="addNamaProgram" class="form-control" placeholder="">
							</div>
							<div class="form-group">
								<label for="editPlafon">Plafon</label>
								<input type="text" name="addPlafon" id="addPlafon" class="form-control" placeholder="-">
							</div>
						</div>
						<input type="hidden" name="mainID" id="mainID" value="" />
						<input type="hidden" name="idInstansi" id="idInstansi" value="<?= $kodeInstansi ?>" />
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

		<?php if ($_SESSION['hakAkses'] != 3) { ?>
		<!-- Start Modal Edit Program -->
		<div class="modal fade" id="modal-edit">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Edit Program</h4>
					</div>
					<form id="formEdit" method="post" action="<?= site_url('ProgramCtrl/EditProgram') ?>">
						<div class="modal-body">
							<div class="form-group">
								<label>Kode Program</label>
								<div class="input-group">
									<div class="input-group-addon">
										127.
									</div>
									<input type="text" class="form-control" id="editKodeProgram" name="editKodeProgram" placeholder="9999"
									 aria-describedby="helpId">
								</div>
								<!-- /.input group -->
								<!-- <small id="helpId" class="text-muted"></small> -->
							</div>
							<div class="form-group">
								<label for="editNamaProgram">Nama Program</label>
								<input type="text" name="editNamaProgram" id="editNamaProgram" class="form-control" placeholder="">
							</div>
							<div class="form-group">
								<label for="editPlafon">Plafon</label>
								<input type="text" name="editPlafon" id="editPlafon" class="form-control" placeholder="-">
							</div>
						</div>
						<input type="hidden" name="mainID" id="mainID" value="" />
						<input type="hidden" name="idInstansi" id="idInstansi" value="<?= $kodeInstansi ?>" />
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

		<!-- Start Modal Tambah Kegiatan -->
		<div class="modal fade" id="modalTambahKegiatan">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Tambah Kegiatan</h4>
					</div>
					<form id="formTambah" method="post" action="<?= site_url('ProgramCtrl/TambahKegiatan') ?>">
						<div class="modal-body">
							<div class="form-group">
								<label>Kode Program</label>
								<div class="input-group">
									<div class="input-group-addon">
										080.
									</div>
									<input type="text" class="form-control" id="addKodeKegiatan" name="addKodeKegiatan" placeholder="9999"
									 aria-describedby="helpId">
								</div>
								<!-- /.input group -->
								<!-- <small id="helpId" class="text-muted"></small> -->
							</div>
							<div class="form-group">
								<label for="addNamaKegiatan">Nama Kegiatan</label>
								<input type="text" name="addNamaKegiatan" id="addNamaKegiatan" class="form-control" placeholder="">
							</div>
							<div class="form-group">
								<label for="addketerangan">Keterangan</label>
								<input type="text" name="addKeterangan" id="addKeterangan" class="form-control" placeholder="-">
							</div>
						</div>
						<input type="hidden" name="kodeInstansi" id="kodeInstansi" value="<?= $kodeInstansi ?>" />
						<input type="hidden" name="kodeProgram" id="kodeProgram" value="" />
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
		
		<?php if ($_SESSION['hakAkses'] != 3) { ?>
		<!-- Start Modal Edit Kegiatan -->
		<div class="modal fade" id="modalEditKegiatan">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Edit Program</h4>
					</div>
					<form id="formTambah" method="post" action="<?= site_url('ProgramCtrl/TambahProgram') ?>">
						<div class="modal-body">
							<div class="form-group">
								<label>Kode Program</label>
								<div class="input-group">
									<div class="input-group-addon">
										127.
									</div>
									<input type="text" class="form-control" id="addKodeKegiatan" name="addKodeKegiatan" placeholder="9999"
									 aria-describedby="helpId">
								</div>
								<!-- /.input group -->
								<!-- <small id="helpId" class="text-muted"></small> -->
							</div>
							<div class="form-group">
								<label for="addNamaKegiatan">Nama Program</label>
								<input type="text" name="addNamaKegiatan" id="addNamaKegiatan" class="form-control" placeholder="">
							</div>
							<div class="form-group">
								<label for="editPlafon">Plafon</label>
								<input type="text" name="addPlafon" id="addPlafon" class="form-control" placeholder="-">
							</div>
						</div>
						<input type="hidden" name="mainID" id="mainID" value="" />
						<input type="hidden" name="idInstansi" id="idInstansi" value="<?= $kodeInstansi ?>" />
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

	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php 
$this->load->view('template/_footer');
$this->load->view('template/_js');
?>
<script src="<?= base_url('assets/plugins/input-mask/jquery.inputmask.bundle.js') ?>"></script>
<script>
	var kodeProgram = "";
	var kodeInstansi = "";
	var table = "";
    // Setup datatables
    $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
    {
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

	function tableKegiatan(kodeProgram) {
		$('#boxDetail').fadeIn(1000);
		$('#boxDetail').removeClass('hidden');
		kodeInstansi = "<?= $kodeInstansi; ?>";
		// console.log(kodeProgram);
		table = $("#tableKegiatan").DataTable({
			initComplete: function() {
				var api = this.api();
				$('#mytable_filter input')
					.off('.DT')
					.on('input.DT', function() {
						api.search(this.value).draw();
				});
			},
				oLanguage: {
				sProcessing: 'Loading....'
			},
				processing: true,
				serverSide: true,
				ajax: {"url": "<?= site_url('ProgramCtrl/dataTableApi/') ?>"+kodeInstansi+"/"+kodeProgram, "type": "POST"},
					columns: [
						{
							"data": null,
							"orderable": false,
							"searchable": false
						},
						{"data": "kode_kegiatan"},
						{"data": "nama_kegiatan"},
						{"data": "keterangan"},
						{"data": "total_rekening", render: $.fn.dataTable.render.number(',', '.', '')},
						{"data": "total_rinci", render: $.fn.dataTable.render.number(',', '.', '')},
						{"data": "action", "orderable": false, "searchable": false}
					],
			order: [[1, 'asc']],
			rowCallback: function(row, data, iDisplayIndex) {
				var info = this.fnPagingInfo();
				var page = info.iPage;
				var length = info.iLength;
				var index = page * length + (iDisplayIndex + 1);
				$('td:eq(0)', row).html(index);
			}

		});
		// end setup datatables	
	return table;
	}

	// Row selection (single row)
	// -----------------------------------------------------------------
	var rowSelection = $('#datatable').DataTable({
		"columnDefs": [{
			width: 750,
			targets: 2
		}],
		"responsive": true,
		"language": {
			"paginate": {
				"previous": '<i class="fa fa-angle-left"></i>',
				"next": '<i class="fa fa-angle-right"></i>'
			}
		}
	});

	<?php if (@$_SESSION['kodeProgram'] != null) { ?>
		kodeProgram = "<?= @$_SESSION['kodeProgram']; ?>";
		tableKegiatan(kodeProgram);
	<?php } ?>

	$('#datatable').on('click', '#btnView', function () {
		if ($('#boxDetail').hasClass('hidden')) {
			var $item = $(this).closest('tr');
			kodeProgram = $.trim($item.find('#kode_program').text());
			// console.log(kodeProgram);
			tableKegiatan(kodeProgram);
		}else {
			$('#boxDetail').fadeOut(1000);
			$('#boxDetail').addClass('hidden');
			table.destroy();
		}
	});

	$('#btnHidden').click(function(){
		$('#boxDetail').fadeOut(1000);
		$('#boxDetail').addClass('hidden');
		table.destroy();
	});

	$('#datatable').on('click','#btnEdit',function(){
		var $item = $(this).closest('tr');
		var id = $item.find('#idProgram').val();
		var url = "<?= site_url('ProgramCtrl/DataEditProgramInstansi/') ?>"+id;
		$.ajax({
			url: url,
			type: 'POST',
			success:function (result) {
				var data = JSON.parse(result);
				// console.log(data[0].tahun);
				$('#mainID').val(id);
				$('#editKodeProgram').val(data[0].kode_program);
				$('#editNamaProgram').val(data[0].nama_program);
				$('#editPlafon').val(data[0].plafon);
			}
		});
	})

	$('#datatable').on('click', '#btnDelete', function () {
      var $item = $(this).closest("tr");
      var $nama = $item.find("#unit").text();
      console.log($nama);
      // $item.find("input[id$='no']").val();
      // alert("hai");
      $.confirm({
        theme: 'supervan',
        title: 'Hapus Data Ini ?',
        content: 'Instansi ' + $nama,
        autoClose: 'Cancel|10000',
        buttons: {
          Cancel: function () {},
          delete: {
            text: 'Delete',
            action: function () {
              window.location = "<?= site_url('InstansiCtrl/Hapus/') ?>" + $item.find("#idInstansi").val();
            }
          }
        }
      });
    });

	$('#btnAddKegiatan').click(function(){
		$('#modalTambahKegiatan').modal('show');
		$('#kodeProgram').val(kodeProgram);
	})

	$('#addPlafon,#editPlafon, .inputMask').inputmask('decimal', {
		digits: 2,
		placeholder: "0",
		digitsOptional: true,
		radixPoint: ",",
		groupSeparator: ".",
		autoGroup: true,
		rightAlign: false
		// prefix: "Rp "
	});

</script>
