<?php
$this->load->view('template/_header');
$this->load->view('template/_nav');
?>
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
				if($_SESSION['hakAkses'] != 3){
					echo '
					<div class="form-group col-md-4">
					<a name="btnAdd" id="btnAdd" class="btn btn-primary" role="button">Tambah Data</a>
					</div>
					<br><br><br>';
				}
				?>
				<table id="demo-dt-selection" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>Tahun</th>
							<th>Kode</th>
							<th class="min-tablet">Unit</th>
							<th class="min-tablet">Versi</th>
							<th class="min-desktop">Keterangan</th>
							<th class="min-desktop">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						foreach($data as $item):
						$tgl = explode('-', $item->tanggal);
						$tahun = $tgl[2];
						?>
						<tr>
							<td id="tahun"><?= $tahun ?></td>
							<td id="kode"><?= $item->kode ?></td>
							<td id="unit"><?= $item->unit ?></td>
							<td id="versi"><?= $item->versi ?></td>
							<td id="keterangan"><?= $item->ket ?></td>
							<td>-</td>
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

	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php
$this->load->view('template/_footer');
$this->load->view('template/_js');
?>
<script>
	// Row selection (single row)
	// -----------------------------------------------------------------
	var rowSelection = $('#demo-dt-selection').DataTable({
		"responsive": true,
		"language": {
			"paginate": {
				"previous": '<i class="fa fa-angle-left"></i>',
				"next": '<i class="fa fa-angle-right"></i>'
			}
		}
	});
	$('#demo-dt-selection').on('click', 'tr', function () {
		var $item = $(this).closest('tr');
		var $kode = $item.find('#kode').text();
		// alert($kode+"asdasd");
		window.location = "<?= site_url('ProgramCtrl/ProgramDetails/') ?>"+ $kode;

	});

</script>