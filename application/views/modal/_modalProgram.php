<!-- Start Modal Tambah Program -->
<?php if ($_SESSION['hakAkses'] != 3) { ?>
<div class="modal fade" id="modal-tambah">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Tambah Program</h4>
			</div>
			<form id="formTambah" method="post" action="<?= site_url('ProgramCtrl/TambahProgram') ?>">
				<div class="modal-body">
					<div class="form-group">
						<label>Kode Program</label>
						<div class="input-group">
							<div class="input-group-addon">
								127.
							</div>
							<input required type="text" class="form-control" id="addKodeProgram" name="addKodeProgram" placeholder="9999"
							 aria-describedby="helpId">
						</div>
						<!-- /.input group -->
						<!-- <small id="helpId" class="text-muted"></small> -->
					</div>
					<div class="form-group">
						<label for="addNamaProgram">Nama Program</label>
						<input required type="text" name="addNamaProgram" id="addNamaProgram" class="form-control" placeholder="">
					</div>
					<div class="form-group">
						<label for="addPlafon">Plafon</label>
						<input type="text" name="addPlafon" id="addPlafon" class="form-control" placeholder="-">
					</div>
				</div>
				<input type="hidden" name="programIdTambah" id="programIdTambah" value="" />
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
<?php 
} ?>
<!-- /.modal -->

<!-- Start Modal Edit Program -->
<?php if ($_SESSION['hakAkses'] != 3) { ?>
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
				<input type="hidden" name="programIdEdit" id="programIdEdit" value="" />
				<input type="hidden" name="idInstansiEdit" id="idInstansiEdit" value="<?= $kodeInstansi ?>" />
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
<?php 
} ?>
<!-- /.modal -->

<!-- Start Modal Tambah Kegiatan -->
<div class="modal fade" id="modalTambahKegiatan">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Tambah Kegiatan</h4>
			</div>
			<form id="formTambahKegiatan" method="post" action="<?= site_url('ProgramCtrl/TambahKegiatan') ?>">
				<div class="modal-body">
					<div class="form-group">
						<label>Kode Program</label>
						<div class="input-group">
							<div class="input-group-addon">
								080.
							</div>
							<input required type="text" class="form-control" id="addKodeKegiatan" name="addKodeKegiatan" placeholder="9999"
							 aria-describedby="helpId">
						</div>
						<!-- /.input group -->
						<!-- <small id="helpId" class="text-muted"></small> -->
					</div>
					<div class="form-group">
						<label for="addNamaKegiatan">Nama Kegiatan</label>
						<input required type="text" name="addNamaKegiatan" id="addNamaKegiatan" class="form-control" placeholder="">
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

<!-- Start Modal Edit Kegiatan -->
<div class="modal fade" id="modalEditKegiatan">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Edit Kegiatan</h4>
			</div>
			<form id="formEditKegiatan" method="post" action="<?= site_url('ProgramCtrl/EditKegiatan') ?>">
				<div class="modal-body">
					<div class="form-group">
						<label>Kode Kegiatan</label>
						<div class="input-group">
							<div class="input-group-addon">
								080.
							</div>
							<input type="number" class="form-control" id="editKodeKegiatan" max-lenght="5" name="editKodeKegiatan"
							 placeholder="9999" aria-describedby="helpId">
						</div>
						<!-- /.input group -->
						<!-- <small id="helpId" class="text-muted"></small> -->
					</div>
					<div class="form-group">
						<label for="editNamaKegiatan">Nama Kegiatan</label>
						<input type="text" name="editNamaKegiatan" id="editNamaKegiatan" class="form-control" placeholder="">
					</div>
					<div class="form-group">
						<label for="editketerangan">Keterangan</label>
						<input type="text" name="editKeterangan" id="editKeterangan" class="form-control" placeholder="-">
					</div>
				</div>
				<input type="hidden" name="kodeInstansiEdit" id="kodeInstansiEdit" value="<?= $kodeInstansi ?>" />
				<input type="hidden" name="kodeProgramEdit" id="kodeProgramEdit" />
				<input type="hidden" name="idKegiatanEdit" id="idKegiatanEdit" value="" />
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

<?php if($_SESSION['hakAkses'] != 2){?>
<!-- Start Modal Action Rekening -->
<div class="modal fade" id="modalRekening">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Tambah Rekening</h4>
			</div>
			<form id="formActionRekening" method="post" action="<?= site_url('ProgramCtrl/ActionRekening') ?>">
				<div class="modal-body">
					<div class="form-group">
						<label for="addKodeRek">Jenis Pengeluaran</label>
						<select class="form-control" name="addKodeRek" id="addKodeRek">
							<?php foreach($patokan as $item){ ?>
							<option value="<?=$item->kode_patokan?>">
								<?=$item->nama?>
							</option>
							<?php } ?>
						</select>
					</div>
					<div class="form-group">
						<label for="AddNamaRek">Nama Uraian</label>
						<input type="text" name="addNamaRek" id="addNamaRek" class="form-control" placeholder="">
					</div>
					<div class="form-group">
						<label for="AddT1">T1</label>
						<input type="text" name="AddT1" id="AddT1" class="form-control inputMask" placeholder="-">
					</div>
					<div class="form-group">
						<label for="AddT2">T2</label>
						<input type="text" name="AddT2" id="AddT2" class="form-control inputMask" placeholder="-">
					</div>
					<div class="form-group">
						<label for="AddT3">T3</label>
						<input type="text" name="AddT3" id="AddT3" class="form-control inputMask" placeholder="-">
					</div>
					<div class="form-group">
						<label for="AddT4">T4</label>
						<input type="text" name="AddT4" id="AddT4" class="form-control inputMask" placeholder="-">
					</div>
				</div>
				<input type="hidden" name="actionTypeRekening" id="actionTypeRekening" value="" />
				<input type="hidden" name="IDRekening" id="IDRekening" value="" />
				<input type="hidden" name="KodeKegiatanRekening" id="KodeKegiatanRekening" value="" />
				<input type="hidden" name="KodeInstansiRekening" id="KodeInstansiRekening" value="" />
				<input type="hidden" name="KodeProgramRekening" id="KodeProgramRekening" value="" />
				<input type="hidden" name="KodeRekeningRekening" id="KodeRekeningRekening" value="" />
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

<?php if ($_SESSION['hakAkses'] != 2) { ?>
<!-- Start Modal Action Detail Rekening -->
<div class="modal fade" id="modalDetailRekening">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Edit Rekening</h4>
			</div>
			<form id="FormDetailRekening" class="form-horizontal" method="POST" action="<?=site_url('ProgramCtrl/TambahDetailRekening')?>">
				<div class="box-body">
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-2 control-label">Jenis</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="addJenis" name="addJenis" placeholder="Jenis">
						</div>
					</div>

					<div class="form-group">
						<label for="addKegiatan" class="col-sm-2 control-label">Kegiatan</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="addKegiatan" name="addKegiatan" placeholder="Kegiatan">
						</div>
					</div>
					<div class="form-group">
						<label for="addUraian" class="col-sm-2 control-label">Uraian</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="addUraian" name="addUraian" placeholder="Uraian">
						</div>
					</div>
					<div class="form-group">
						<label for="addSubUraian" class="col-sm-2 control-label">Sub Uraian</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="addSubUraian" name="addSubUraian" placeholder="Sub Uraian">
						</div>
					</div>
					<div class="form-group">
						<label for="addSasaran" class="col-sm-2 control-label">Sasaran</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="addSasaran" name="addSasaran" placeholder="Sasaran">
						</div>
					</div>
					<div class="form-group">
						<label for="addLokasi" class="col-sm-2 control-label">Lokasi</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="addLokasi" name="addLokasi" placeholder="Lokasi">
						</div>
					</div>
					<div class="form-group">
						<label for="addLokasi" class="col-sm-2 control-label">Dana</label>
						<div class="col-sm-4">
							<select class="form-control" name="addDana" id="addDana">
								<option value="1">APBD</option>
								<option value="2">APBN</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-2 control-label">Satuan</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="addSatuan" name="addSatuan" placeholder="Satuan">
						</div>
					</div>
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-2 control-label">Volume</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="addVolume" name="addVolume" placeholder="Volume">
						</div>
					</div>
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-2 control-label">Harga</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" id="addHarga" name="addHarga" placeholder="Harga">
						</div>
						<label for="inputEmail3" class="col-sm-1 control-label">Total</label>
						<div class="col-sm-4">
							<input type="text" class="form-control inputMask" id="addTotal" name="addTotal" placeholder="Total" readonly>
						</div>
					</div>
					<div class="form-group">
						<label for="addKeterangan" class="col-sm-2 control-label">Keterangan</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="addKeterangan" name="addKeterangan" placeholder="Keterangan">
						</div>
					</div>
				</div>
				<!-- /.box-body -->
				<div class="box-footer">
					<input type="hidden" id="KodeInstansiDetailRekening" name="KodeInstansiDetailRekening">
					<input type="hidden" id="KodeProgramDetailRekening" name="KodeProgramDetailRekening">
					<input type="hidden" id="KodeKegiatanDetailRekening" name="KodeKegiatanDetailRekening">
					<input type="hidden" id="KodeRekeningDetailRekening" name="KodeRekeningDetailRekening">
					<input type="hidden" id="MainIdDetailRekening" name="MainIdDetailRekening">
					<input type="hidden" id="actionTypeDetailRekening" name="actionTypeDetailRekening">
					<button type="submit" class="btn btn-default">Cancel</button>
					<button type="submit" class="btn btn-info pull-right">Submit</button>
				</div>
				<!-- /.box-footer -->
			</form>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php 
} ?>

<?php if ($_SESSION['hakAkses'] != 2) { ?>
<!-- Start Modal Action Detail Rekening -->
<div class="modal fade" id="modalIndikator">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Action Indikator</h4>
			</div>
			<form id="FormAddIndikator" class="form-horizontal" method="POST" action="<?= site_url('ProgramCtrl/TambahIndikator') ?>">
				<div class="box-body">
					<div class="form-group">
						<label for="inputEmail3" class="col-sm-2 control-label">Nomor</label>
						<div class="col-sm-2">
							<input type="number" class="form-control" id="addNomor" name="addNomor" placeholder="Nomor" value="1">
						</div>
						<label for="addJenisIndikator" class="col-sm-2 control-label">Jenis</label>
						<div class="col-sm-3">
							<select class="form-control" name="addJenisIndikator" id="addJenisIndikator">
								<option value="1">Capaian Program</option>
								<option value="2">Hasil</option>
								<option value="3">Pengaluaran</option>
								<option value="4">Masukan</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="addUraianIndikator" class="col-sm-2 control-label">Uraian</label>
						<div class="col-sm-9">
							<textarea name="addUraianIndikator" id="addUraianIndikator" class="form-control" rows="3" required="required"></textarea>
						</div>
					</div>
					<div class="form-group">
						<label for="addSatuanIndikator" class="col-sm-2 control-label">Satuan</label>
						<div class="col-sm-2">
							<input type="text" class="form-control" id="addSatuanIndikator" name="addSatuanIndikator" placeholder="Satuan">
						</div>
					</div>
					<div class="form-group">
						<label for="addTarget" class="col-sm-2 control-label">Target</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" id="addTarget" name="addTarget" placeholder="Target">
						</div>
					</div>
					<div class="form-group">
						<label for="addNilai" class="col-sm-2 control-label">Nilai</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" id="addNilai" name="addNilai" placeholder="Nilai">
						</div>
					</div>
				</div>
				<!-- /.box-body -->
				<div class="box-footer">
					<input type="hidden" id="KodeInstansiIndikator" name="KodeInstansiIndikator">
					<input type="hidden" id="KodeProgramIndikator" name="KodeProgramIndikator">
					<input type="hidden" id="KodeKegiatanIndikator" name="KodeKegiatanIndikator">
					<input type="hidden" id="MainIdIndikator" name="MainIdIndikator">
					<input type="hidden" id="actionTypeIndikator" name="actionTypeIndikator">
					<button type="submit" class="btn btn-default">Cancel</button>
					<button type="submit" class="btn btn-info pull-right">Submit</button>
				</div>
				<!-- /.box-footer -->
			</form>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php 
} ?>
