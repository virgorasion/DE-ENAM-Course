<?php 
$this->load->view('template/_header');
$this->load->view('template/_nav');
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Program <?= @$namaProgram ?>
        <small>it all starts here</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Title</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <!-- FORM VALIDATION ON TABS -->
				<!--===================================================-->
				<div class="tab-base">

					<!-- Nav tabs -->
					<ul class="nav nav-tabs">
						<li class="active">
							<a href="forms-validation.html#demo-bsc-tab-1" data-toggle="tab">
								<i class="fa fa-history"></i> Informasi</a>
						</li>
						<li>
							<a href="forms-validation.html#demo-bsc-tab-2" data-toggle="tab">
								<i class="fa fa-edit"></i> Tambah Data</a>
						</li>
					</ul>

					<!-- Tabs Content -->
					<div id="demo-bv-bsc-tabs" class="form-horizontal">
						<div class="tab-content">
							<div class="tab-pane pad-btm fade in active" id="demo-bsc-tab-1">
							<br>
								<?php
        if ($_SESSION['hakAkses'] != 3) {
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
											<th>Name</th>
											<th>Position</th>
											<th class="min-tablet">Office</th>
											<th class="min-tablet">Extn.</th>
											<th class="min-desktop">Start date</th>
											<th class="min-desktop">Salary</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>Tiger Nixon</td>
											<td>System Architect</td>
											<td>Edinburgh</td>
											<td>61</td>
											<td>2011/04/25</td>
											<td>$320,800</td>
										</tr>
										<tr>
											<td>Garrett Winters</td>
											<td>Accountant</td>
											<td>Tokyo</td>
											<td>63</td>
											<td>2011/07/25</td>
											<td>$170,750</td>
										</tr>
										<tr>
											<td>Ashton Cox</td>
											<td>Junior Technical Author</td>
											<td>San Francisco</td>
											<td>66</td>
											<td>2009/01/12</td>
											<td>$86,000</td>
										</tr>
										<tr>
											<td>Cedric Kelly</td>
											<td>Senior Javascript Developer</td>
											<td>Edinburgh</td>
											<td>22</td>
											<td>2012/03/29</td>
											<td>$433,060</td>
										</tr>
										<tr>
											<td>Airi Satou</td>
											<td>Accountant</td>
											<td>Tokyo</td>
											<td>33</td>
											<td>2008/11/28</td>
											<td>$162,700</td>
										</tr>
										<tr>
											<td>Brielle Williamson</td>
											<td>Integration Specialist</td>
											<td>New York</td>
											<td>61</td>
											<td>2012/12/02</td>
											<td>$372,000</td>
										</tr>
										<tr>
											<td>Herrod Chandler</td>
											<td>Sales Assistant</td>
											<td>San Francisco</td>
											<td>59</td>
											<td>2012/08/06</td>
											<td>$137,500</td>
										</tr>
										<tr>
											<td>Rhona Davidson</td>
											<td>Integration Specialist</td>
											<td>Tokyo</td>
											<td>55</td>
											<td>2010/10/14</td>
											<td>$327,900</td>
										</tr>
										<tr>
											<td>Colleen Hurst</td>
											<td>Javascript Developer</td>
											<td>San Francisco</td>
											<td>39</td>
											<td>2009/09/15</td>
											<td>$205,500</td>
										</tr>
									</tbody>
								</table>
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
						</div>
					</div>
				</div>
				<!--===================================================-->
				<!-- END FORM VALIDATION ON TABS -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          Footer
        </div>
        <!-- /.box-footer-->
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