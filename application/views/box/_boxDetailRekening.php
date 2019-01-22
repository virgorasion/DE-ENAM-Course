<!-- Default box -->
		<div id="boxDetailRekening" class="box hidden">
			<div class="box-header with-border">
				<h3 class="box-title">Detail Rekening</h3>

				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
						<i class="fa fa-minus"></i></button>
					<button type="button" class="btn btn-box-tool" id="btnHiddenBoxDetailRekening" title="Hidden">
						<i class="fa fa-times"></i></button>
				</div>
			</div>
			<div class="box-body">

				<?php
			if ($_SESSION['hakAkses'] != 2) { ?>
				<div class="form-group">
					<button id="btnTambahDetailRekening" type="button" class="btn btn-primary">Tambah</button>
				</div>
				<?php 
		} ?>
				<table id="tableDetailRekening" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>No</th>
							<th>Uraian</th>
							<th>Sub Uraian</th>
							<th>Satuan</th>
							<th>Volume</th>
							<th>Harga</th>
							<th>Total</th>
							<th>Ket</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						
					</tbody>
				</table>

			</div>
			<!-- /.box-body -->
		</div>
		<!-- /.box -->