<?php if ($_SESSION['hakAkses'] != 3) { ?>
<!-- Start Modal -->
<div class="modal fade" id="modalTambahInstansi">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Instansi</h4>
            </div>
            <form id="formTambah" method="post" action="<?= site_url('InstansiCtrl/TambahInstansi') ?>">
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
<?php } ?>

<?php if ($_SESSION['hakAkses'] != 3) { ?>
<!-- Start Modal -->
<div class="modal fade" id="modalEditInstansi">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Instansi</h4>
            </div>
            <form id="formEdit" method="post" action="<?= site_url('ProgramCtrl/EditInstansi') ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editTahun">Tahun</label>
                        <input type="text" name="editTahun" id="editTahun" class="form-control" placeholder="2018" autofocus>
                    </div>
                    <div class="form-group">
                        <label>Kode Instansi</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                010.
                            </div>
                            <input type="text" class="form-control" id="editId" name="editId" placeholder="9999" aria-describedby="helpId">
                        </div>
                        <!-- /.input group -->
                        <!-- <small id="helpId" class="text-muted"></small> -->
                    </div>
                    <div class="form-group">
                        <label for="editInstansi">Nama Instansi</label>
                        <input type="text" name="editInstansi" id="editInstansi" class="form-control" placeholder="ex : SMKN 2 Surabaya">
                    </div>
                    <div class="form-group">
                        <label for="editVersi">Versi</label>
                        <input type="text" name="editVersi" id="editVersi" class="form-control" placeholder="-">
                    </div>
                    <div class="form-group">
                        <label for="editKet">Keterangan</label>
                        <textarea class="form-control" name="editKet" id="editKet" rows="3" placeholder="Keterangan"></textarea>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="editUser">Username</label>
                        <input type="text" name="editUser" id="editUser" class="form-control" placeholder="Virgorasion">
                    </div>
                    <div class="form-group">
                        <label for="editPass">Password</label>
                        <input type="password" name="editPass" id="editPass" class="form-control" placeholder="********">
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword">Confirmasi Password</label>
                        <input type="password" name="passConfirmEdit" id="passConfirmEdit" class="form-control" placeholder="********">
                    </div>
                </div>
                <input type="hidden" name="mainID" id="mainID" value=""/>
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

<?php if ($_SESSION['hakAkses'] == 1) { ?>
<!-- Start Modal -->
<div class="modal fade" id="modalTambahSiswa">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Siswa</h4>
            </div>
            <form id="formTambahSiswa" method="post" action="<?= site_url('InstansiCtrl/TambahSiswa') ?>">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="addNamaSiswa">Nama</label>
                        <input type="text" name="addNamaSiswa" id="addNamaSiswa" class="form-control" placeholder="M Nur Fauzan W" autofocus required>
                    </div>
                    <div class="form-group">
                      <label for="addInstansiSiswa">Instansi</label>
                      <select class="form-control" name="addInstansiSiswa" id="addInstansiSiswa">
                        <option>- Pilih Instansi -</option>
                        <?php foreach($instansi as $item) { ?>
                        <option value="<?= $item->kode_instansi ?>"> <?= $item->nama_instansi ?> </option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group">
                        <label for="addNisSiswa">NIS</label>
                        <input type="number" name="addNisSiswa" id="addNisSiswa" max-lenght="5" class="form-control" placeholder="13234" required>
                    </div>
                    <div class="form-group">
                        <label for="addNisnSiswa">NISN</label>
                        <input type="number" name="addNisnSiswa" id="addNisnSiswa" class="form-control" placeholder="0008096617" required>
                    </div>
                    <div class="form-group">
                      <label for="addProgramSiswa">Program</label>
                      <select class="form-control" name="addProgramSiswa" id="addProgramSiswa">
                      </select>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="addUserSiswa">Username</label>
                        <input type="text" name="addUserSiswa" id="addUserSiswa" class="form-control" placeholder="Virgorasion" required>
                    </div>
                    <div class="form-group">
                        <label for="addPassSiswa">Password</label>
                        <input type="password" name="addPassSiswa" id="addPassSiswa" class="form-control" placeholder="********" required>
                    </div>
                    <div class="form-group">
                        <label for="confPassSiswa">Confirmasi Password</label>
                        <input type="password" name="confPassSiswa" id="confPassSiswa" class="form-control" placeholder="********" required>
                    </div>
                </div>
                <input type="hidden" name="mainIdSiswa" id="mainIdSiswa" value=""/>
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
<?php 
} ?>