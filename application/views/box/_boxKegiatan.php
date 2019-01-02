<div id="boxKegiatan" class="box hidden">
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
				<li id="tabInfoKegiatan">
					<a href="#nav-tabs-kegiatan-1" data-toggle="tab">
						<i class="fa fa-history"></i> Info Program</a>
				</li>
				<li id="tabIndikatorKegiatan">
					<a href="#nav-tabs-kegiatan-2" data-toggle="tab">
						<i class="fa fa-edit"></i> Indikator</a>
				</li>
				<li id="tabPenanggungJawabKegiatan">
					<a href="#nav-tabs-kegiatan-3" data-toggle="tab">
						<i class="fa fa-edit"></i> Penanggung Jawab</a>
				</li>
				<li id="tabKegiatan" class="active">
					<a href="#nav-tabs-kegiatan-4" data-toggle="tab">
						<i class="fa fa-edit"></i> Rincian Kegiatan</a>
				</li>
				<li id="tabPembahasanKegiatan">
					<a href="#nav-tabs-kegiatan-5" data-toggle="tab">
						<i class="fa fa-edit"></i> Pembahasan</a>
				</li>
			</ul>

			<!-- Tabs Content -->
			<div id="demo-bv-bsc-tabs" class="form-horizontal">
				<div class="tab-content">

					<!-- Start Info Kegiatan Tab -->
					<div class="tab-pane pad-btm fade" id="nav-tabs-kegiatan-1">
						<table class="table" id="tableInfo">
							<tr>
								<td style="font-size:17px;width:300px">Jenis</td>
								<td style="font-size:17px;width:5px">:</td>
								<td style="font-size:17px" id="InfoJenis"></td>
							</tr>
							<tr>
								<td style="font-size:17px">Kode Kegiatan</td>
								<td style="font-size:17px">:</td>
								<td style="font-size:17px" id="InfoKodeKegiatan"></td>
							</tr>
							<tr>
								<td style="font-size:17px">Nama Kegiatan</td>
								<td style="font-size:17px">:</td>
								<td style="font-size:17px" id="InfoNamaKegiatan"></td>
							</tr>
							<tr>
								<td style="font-size:17px">Uraian</td>
								<td style="font-size:17px">:</td>
								<td style="font-size:17px" id="InfoUraian"></td>
							</tr>
							<tr>
								<td style="font-size:17px">Sasaran</td>
								<td style="font-size:17px">:</td>
								<td style="font-size:17px" id="InfoSasaran"></td>
							</tr>
							<tr>
								<td style="font-size:17px">Plafon</td>
								<td style="font-size:17px">:</td>
								<td style="font-size:17px" id="InfoPlafon"></td>
							</tr>
						</table>
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
						<table id="tableIndikator" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>Jenis</th>
									<th>No.</th>
									<th>Uraian Indikator</th>
									<th>Target</th>
									<th>action</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>
					</div>

					<!-- Start Penanggung Jawab Tab -->
					<div class="tab-pane fade" id="nav-tabs-kegiatan-3">
						<table class="table" id="tablePJ">
							<tr>
								<td style="font-size:17px;width:300px">NISN</td>
								<td style="font-size:17px;width:5px">:</td>
								<td style="font-size:17px" id="nisnPJSiswa"></td>
							</tr>
							<tr>
								<td style="font-size:17px;width:300px">NIS</td>
								<td style="font-size:17px;width:5px">:</td>
								<td style="font-size:17px" id="nisPJSiswa"></td>
							</tr>
							<tr>
								<td style="font-size:17px">Nama</td>
								<td style="font-size:17px">:</td>
								<td style="font-size:17px" id="namaPJSiswa"></td>
							</tr>
							<tr>
								<td style="font-size:17px">Nama User</td>
								<td style="font-size:17px">:</td>
								<td style="font-size:17px" id="userPJSiswa"></td>
							</tr>
							<tr>
								<td style="font-size:17px">Instansi</td>
								<td style="font-size:17px">:</td>
								<td style="font-size:17px" id="instansiPJSiswa"></td>
							</tr>
							<tr>
								<td style="font-size:17px">Program</td>
								<td style="font-size:17px">:</td>
								<td style="font-size:17px" id="programPJSiswa"></td>
							</tr>
						</table>
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
						<?php if ($_SESSION['hakAkses'] == 1) { ?>
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div class="form-inline col-md-2">
								<br>
								<?php if ($_SESSION['hakAkses'] == 1) { ?>
								<div class="form-group col-sm-4">
									<a name="btnAddPembahasan" id="btnAddPembahasan" class="btn btn-primary">Tambah Pembahasan</a>
								</div>
								<?php 
						} ?>
							</div>
						</div>
						<br><br>
						<hr>
						<?php } ?>
						<table id="tablePembahasan" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>No.</th>
									<th>Nama Siswa</th>
									<th>Instansi</th>
									<th>Plafon</th>
									<th>T1</th>
									<th>T2</th>
									<th>T3</th>
									<th>T4</th>
									<th>Nilai</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>
					</div>

				</div>
			</div>
		</div>
		<!--===================================================-->
		<!-- END FORM VALIDATION ON TABS -->
	</div>
	<!-- /.box-body -->
</div>
