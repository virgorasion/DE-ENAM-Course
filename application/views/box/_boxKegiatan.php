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
					<a href="#nav-tabs-kegiatan-1" data-toggle="tab">
						<i class="fa fa-history"></i> Info Kegiatan</a>
				</li>
				<li>
					<a href="#nav-tabs-kegiatan-2" data-toggle="tab">
						<i class="fa fa-edit"></i> Indikator</a>
				</li>
				<li>
					<a href="#nav-tabs-kegiatan-3" data-toggle="tab">
						<i class="fa fa-edit"></i> Penanggung Jawab</a>
				</li>
				<li class="active">
					<a href="#nav-tabs-kegiatan-4" data-toggle="tab">
						<i class="fa fa-edit"></i> Rincian Kegiatan</a>
				</li>
				<li>
					<a href="#nav-tabs-kegiatan-5" data-toggle="tab">
						<i class="fa fa-edit"></i> Pembahasan</a>
				</li>
			</ul>

			<!-- Tabs Content -->
			<div id="demo-bv-bsc-tabs" class="form-horizontal">
				<div class="tab-content">
					<!-- Start Info Kegiatan Tab -->
					<div class="tab-pane pad-btm fade " id="nav-tabs-kegiatan-1">
					</div>

					<!-- Start Indikator Tab -->
					<div class="tab-pane fade" id="nav-tabs-kegiatan-2">
						<?php if ($_SESSION['hakAkses'] != 2) { ?>
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div class="form-inline col-md-2">
								<br>
								<div class="form-group col-sm-4">
									<a name="btnAddIndikator" id="btnAddIndikator" class="btn btn-primary">Tambah
										Data</a>
								</div>
							</div>
						</div>
						<br><br>
						<hr>
						<?php 
						} ?>
						<table id="tableProgram" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>Jenis</th>
									<th>No.</th>
									<th>Uraian Indikator</th>
									<th>Target</th>
									<th>action</th>
								</tr>
							</thead>
							<!-- <tbody>
								<?php
									$no = 1;
									foreach ($data as $item) {
										if ($item->total_rekening != $item->total_rinci) {
											$class = "label label-danger";
										} else {
											$class = "label label-success";
										}
										?>
								<tr>
									<td id="jenisIndikator">
										<?= $item->jenis ?>
									</td>
									<td id="noIndikator">
										<?= $no ?>
									</td>
									<td id="uraianIndikator">
										<?= $item->uraian ?>
									</td>
									<td id="target">
										<?= $item->target ?>
									</td>
									<?php if ($_SESSION['hakAkses'] == 3) { ?>
									<td>
										<input type="hidden" id="idProgram" name="idProgram" value="<?= $item->id ?>" <?php if ($_SESSION['id_siswa']==$item->id_siswa
										&& $_SESSION['instansiSiswa'] == $item->kode_instansi &&
										$_SESSION['programSiswa'] == $item->kode_program) { ?>
										<a href="#">
											<span data-placement="top" data-toggle="tooltip" title="View"></span>
											<button class="btn btn-info btn-xs btnView" data-title="View" id="btnView">
												<span class="fa fa-eye"></span>
											</button>
										</a>
										<?php 
										} ?>
										<!-- <?php if ($_SESSION['id_siswa'] == $item->id_siswa && $_SESSION['instansiSiswa'] == $item->kode_instansi && $_SESSION['programSiswa'] == $item->kode_program) { ?>
												<a href="#">
													<span data-placement="top" data-toggle="tooltip" title="Edit"></span>
													<button class="btn btn-warning btn-xs btnEdit" data-title="Edit" id="btnEdit" data-toggle="modal" data-target="#modal-edit">
														<span class="fa fa-pencil"></span>
													</button>
												</a>
												<?php 
										} ?> -->
									</td>
									<?php 
									} ?>
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
									<?php 
									} ?>
								</tr>
								<?php $no++;
								} ?>
							</tbody> -->
						</table>
					</div>

					<!-- Start Penanggung Jawab Tab -->
					<div class="tab-pane fade" id="nav-tabs-kegiatan-3">
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

					<!-- Start Rincian Kegiatan Tab -->
					<div class="tab-pane fade in active" id="nav-tabs-kegiatan-4">
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
									<th>Uraian Kegiatan</th>
									<th>Keterangan</th>
									<th>Total Rek</th>
									<th>Tot. Rinci</th>
									<th>action</th>
								</tr>
							</thead>
							<tbody>
								<!-- Diisi oleh Ajax dari _programJS -->
							</tbody>
						</table>
					</div>

					<!-- Start Pembahasan Tab -->
					<div class="tab-pane fade" id="nav-tabs-kegiatan-5">
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
