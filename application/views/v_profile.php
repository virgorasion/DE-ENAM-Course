<?php $this->load->view('template/_header'); ?>
<link href="<?= base_url('assets/plugins/bootstrap-validator/bootstrapValidator.min.css') ?>" rel="stylesheet">
<link href="<?= base_url('assets/plugins/bootstrap-select/bootstrap-select.min.css') ?>" rel="stylesheet">
<link href="<?= base_url('assets/plugins/jquery-confirm/jquery-confirm.min.css') ?>" rel="stylesheet">
<?php $this->load->view('template/_nav'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			User Profile
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="#">Examples</a></li>
			<li class="active">User profile</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">

		<div class="row">
			<div class="col-md-3">

				<!-- Profile Image -->
				<div class="box box-primary">
					<div class="box-body box-profile">
						<img class="profile-user-img img-responsive img-circle" src="../../dist/img/user4-128x128.jpg" alt="User profile picture">

						<h3 class="profile-username text-center">Nina Mcintire</h3>

						<p class="text-muted text-center">Software Engineer</p>

						<ul class="list-group list-group-unbordered">
							<li class="list-group-item">
								<b>Followers</b> <a class="pull-right">1,322</a>
							</li>
							<li class="list-group-item">
								<b>Following</b> <a class="pull-right">543</a>
							</li>
							<li class="list-group-item">
								<b>Friends</b> <a class="pull-right">13,287</a>
							</li>
						</ul>

						<a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->

			</div>
			<!-- /.col -->
			<div class="col-md-9">
				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#activity" data-toggle="tab">Activity</a></li>
						<li><a href="#timeline" data-toggle="tab">Timeline</a></li>
					</ul>

					<div class="tab-content">
						<div class="active tab-pane" id="activity">
							<table id="tableInstansi" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th>Kode</th>
										<th class="min-tablet">Nama</th>
										<th class="min-tablet">Kota</th>
										<th class="min-desktop">Tahun</th>
										<th class="min-desktop">Versi</th>
										<th class="min-desktop">Action</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
						<!-- /.tab-pane -->
						<div class="tab-pane" id="timeline">

						</div>
						<!-- /.tab-pane -->

					</div>
					<!-- /.tab-content -->
				</div>
				<!-- /.nav-tabs-custom -->
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->

	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php
$this->load->view('template/_footer');
$this->load->view('template/_js');
?>
<script>
    tableInstansi = $("#tableInstansi").DataTable({
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
				ajax: {"url": "<?= site_url('ProgramCtrl/dataTableApi/') ?>"+kodeInstansi+"/"+kodeProgram+"/"+idSiswa, "type": "POST"},
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
						{"data": "total_rinci", "orderabel": false, "searchable": false},
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
</script>