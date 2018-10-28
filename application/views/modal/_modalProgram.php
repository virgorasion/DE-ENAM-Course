<!-- Start Modal Tambah Program -->
<?php if ($_SESSION['hakAkses'] != 3) { ?>
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
							<input type="text" class="form-control" id="editKodeKegiatan" name="editKodeKegiatan" placeholder="9999"
							 aria-describedby="helpId">
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
				<input type="hidden" name="kodeProgramEdit" id="kodeProgramEdit" value="" />
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