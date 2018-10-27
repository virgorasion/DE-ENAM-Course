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
									<input type="hidden" id="idKegiatan" name="idKegiatan" value="<?= $item->id ?>" <a href="#">
									<span data-placement="top" data-toggle="tooltip" title="View"></span>
									<button class="btn btn-primary btn-xs btnView" data-title="View" id="btnView">
										<span class="fa fa-eye"></span>
									</button>
									</a>
									<a href="#">
										<span data-placement="top" data-toggle="tooltip" title="Edit"></span>
										<button class="btn btn-warning btn-xs btnEditKegiatan" data-title="Edit" id="btnEditKegiatan" data-toggle="modal"
										 data-target="#modalEditKegiatan">
											<span class="fa fa-pencil"></span>
										</button>
									</a>
								</td>
								<?php 
        } ?>
								<?php if ($_SESSION['hakAkses'] != 3) { ?>
								<td>
									<input type="hidden" id="idKegiatan" name="idKegiatan" value="<?= $item->id ?>" <a href="#">
									<span data-placement="top" data-toggle="tooltip" title="View"></span>
									<button class="btn btn-primary btn-xs btnView" data-title="View" id="btnView">
										<span class="fa fa-eye"></span>
									</button>
									</a>
									<a href="#">
										<span data-placement="top" data-toggle="tooltip" title="Edit"></span>
										<button class="btn btn-warning btn-xs btnEditKegiatan" data-title="Edit" id="btnEditKegiatan" data-toggle="modal"
										 data-target="#modalEditKegiatan">
											<span class="fa fa-pencil"></span>
										</button>
									</a>
								</td>
								<?php 
        } ?>

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
</div>
