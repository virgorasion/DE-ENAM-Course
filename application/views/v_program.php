<?php $this->load->view('template/_header'); ?>
<link href="<?= base_url('assets/plugins/bootstrap-validator/bootstrapValidator.min.css') ?>" rel="stylesheet">
<link href="<?= base_url('assets/plugins/jquery-confirm/jquery-confirm.min.css') ?>" rel="stylesheet">
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
				if($_SESSION['hakAkses'] == 1){ ?>
					<div class="form-group col-md-4">
					<button id="addBtn" type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-tambah">Tambah Instansi</button>
					</div>
					<br><br><br>
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
									<button class="btn btn-warning btn-xs btnEdit" data-toggle="modal" data-target="#modal-edit" data-title="Edit" id="btnEdit">
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
								<input type="hidden" name="idInstansi" id="idInstansi" class="form-control" value="<?= $item->id ?>">x
								<a href="#">
									<span data-placement="top" data-toggle="tooltip" title="View"></span>
									<button class="btn btn-primary btn-xs btnView" data-title="View" id="btnView">
									<span class="fa fa-eye"></span>
									</button>
								</a>
								<a href="#">
									<span data-placement="top" data-toggle="tooltip" title="Edit"></span>
									<button class="btn btn-warning btn-xs btnEdit" data-toggle="modal" data-target="#modal-edit" data-title="Edit" id="btnEdit">
									<span class="fa fa-pencil"></span>
									</button>
								</a>
							</td> 
							<?php } ?>
							<?php if ($_SESSION['hakAkses'] == 3) { ?>
							<td>
									<a href="#">
									<span data-placement="top" data-toggle="tooltip" title="View"></span>
									<button class="btn btn-primary btn-xs btnView" data-title="View" id="btnView">
									<span class="fa fa-eye"></span>
									</button>
								</a>
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
		
		<?php if ($_SESSION['hakAkses'] != 3) { ?>
		<!-- Start Modal -->
		<div class="modal fade" id="modal-tambah">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Tambah Instansi</h4>
					</div>
					<form id="formTambah" method="post" action="<?= site_url('ProgramCtrl/TambahInstansi') ?>">
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
		<div class="modal fade" id="modal-edit">
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

	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php
$this->load->view('template/_footer');
$this->load->view('template/_js');
?>
<script src="<?= base_url('assets/plugins/bootstrap-validator/bootstrapValidator.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/jquery-confirm/jquery-confirm.min.js') ?>"></script>
<script>
	// Row selection (single row)
	// -----------------------------------------------------------------
	var rowSelection = $('#datatable').DataTable({
		"responsive": true,
		"language": {
			"paginate": {
				"previous": '<i class="fa fa-angle-left"></i>',
				"next": '<i class="fa fa-angle-right"></i>'
			}
		}
	});
	var faIcon = {
		valid: 'fa fa-check-circle fa-lg text-success',
		invalid: 'fa fa-times-circle fa-lg',
		validating: 'fa fa-refresh'
	}
	$('#datatable').on('click', '#btnView', function () {
		var $item = $(this).closest('tr');
		var $kode = $item.find('#kode').text();
		// alert($kode+"asdasd");
		window.location = "<?= site_url('ProgramCtrl/ProgramDetails/') ?>" + $kode;

	});

	$('#datatable').on('click','#btnEdit',function(){
		var $item = $(this).closest('tr');
		var id = $item.find('#idInstansi').val();
		var url = "<?= site_url('ProgramCtrl/DataEdit/') ?>"+id;
		$.ajax({
			url: url,
			type: 'POST',
			success:function (result) {
				var data = JSON.parse(result);
				// console.log(data[0].tahun);
				$('#mainID').val(id);
				$('#editUser').val(data[0].username);
				$('#editTahun').val(data[0].tahun);
				$('#editId').val(data[0].kode_instansi);
				$('#editInstansi').val(data[0].nama_instansi);
				$('#editVersi').val(data[0].versi);
				$('#editKet').val(data[0].keterangan);
			}
		});
	})


	$('#formTambah').bootstrapValidator({
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

	$('#formEdit').bootstrapValidator({
		message: 'Kolom tidak boleh kosong',
		feedbackIcons: faIcon,
		fields: {
			editPass: {
				validators: {
					identical: {
						field: 'passConfirmEdit',
						message: 'The password and its confirm are not the same'
					}
				}
			},
			passConfirmEdit: {
				validators: {
					identical: {
						field: 'editPass',
						message: 'The password and its confirm are not the same'
					}
				}
			}
		}
	});

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
              window.location = "<?= site_url('ProgramCtrl/Hapus/') ?>" + $item.find("#idInstansi").val();
            }
          }
        }
      });
    });


</script>
