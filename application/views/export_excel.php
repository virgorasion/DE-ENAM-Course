<?php

// header("Content-type: application/vnd-ms-excel");

// header("Content-Disposition: attachment; filename=pencapaian_siswa.xls");

?>
<style>
.str{ mso-number-format:\@; }
</style>
<table border="1" width="100%">
	<tr>
		<td colspan="4" rowspan="2" align="center">
			<h3><b>RENCANA KERJA DAN ANGGARAN</b> <br> <b>SATUAN KERJA PERANGKAT DAERAH</b></h3>
		</td>
		<td align="center"><b>KODE KEGIATAN</b></td>
		<td rowspan="2" align="center"><b>Formulir <br> RKA-SKPD 2.2.1</b></td>
	</tr>
	<tr>
		<td align="center" class="str"><b>
				<?= $kodeKegiatan ?></b></td>
	</tr>
	<tr>
		<td colspan="6" align="center"><b>Pemerintah Provinsi Jawa Timur <br> 2018</b></td>
	</tr>
	<tr>
		<td colspan="6">
			Instansi
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			:&nbsp; (
			<?= $kodeInstansi ?>) &nbsp;
			<?= (@$data_instansi[0]->nama_instansi != null) ? $data_instansi[0]->nama_instansi : "Kosong"; ?> <br>
			Sasaran RPJMD &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp; (sasaran_program) <br>
			Program
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			: &nbsp; (
			<?= $kodeProgram ?>) &nbsp;
			<?= (@$data_program[0]->nama_program != null) ? $data_program[0]->nama_program : "Kosong"; ?> <br>
			Kegiatan
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :
			&nbsp; (
			<?= $kodeKegiatan ?>) &nbsp;
			<?= (@$data_kegiatan[0]->nama_kegiatan != null) ? $data_kegiatan[0]->nama_kegiatan : "Kosong"; ?> <br>
			Lokasi Kegiatan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp; Jawa Timur <br>
			Sumber Dana &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp;
			<?= (@$data_instansi[0]->versi != null) ? $data_instansi[0]->versi : "Kosong"; ?> <br>
		</td>
	</tr>
	<tr>
		<td colspan="6" align="center"><b>Indikator & Tolor Ukur Kinerja Belanja Langsung</b></td>
	</tr>
	<tr>
		<td><b>Indikator</b></td>
		<td colspan="3"><b>Tolok Ukur Kinerja</b></td>
		<td><b>Nilai</b></td>
		<td><b>Satuan</b></td>
	</tr>
	<tr>
		<td>Capaian Program</td>
		<td colspan="3">
			<?= (@$data_indikator['capaian'][0]->uraian != null) ? $data_indikator['capaian'][0]->uraian : "Kosong"; ?>
		</td>
		<td align="left">
			<?= (@$data_indikator['capaian'][0]->target != null) ? $data_indikator['capaian'][0]->target : "Kosong"; ?>
		</td>
		<td>
			<?= (@$data_indikator['capaian'][0]->satuan != null) ? $data_indikator['capaian'][0]->satuan : "Kosong"; ?>
		</td>
	</tr>
	<tr>
		<td>Masukan</td>
		<td colspan="3">
			<?= (@$data_indikator['masukan'][0]->uraian != null) ? $data_indikator['masukan'][0]->uraian : "Kosong"; ?>
		</td>
		<td align="left">
			<?= (@$data_indikator['masukan'][0]->target != null) ? $data_indikator['masukan'][0]->target : "Kosong"; ?>
		</td>
		<td>
			<?= (@$data_indikator['masukan'][0]->satuan != null) ? $data_indikator['masukan'][0]->satuan : "Kosong"; ?>
		</td>
	</tr>
	<tr>
		<td>Keluaran</td>
		<td colspan="3">
			<?= (@$data_indikator['keluaran'][0]->uraian != null) ? $data_indikator['keluaran'][0]->uraian : "Kosong"; ?>
		</td>
		<td align="left">
			<?= (@$data_indikator['keluaran'][0]->target != null) ? $data_indikator['keluaran'][0]->target : "Kosong"; ?>
		</td>
		<td>
			<?= (@$data_indikator['keluaran'][0]->satuan != null) ? $data_indikator['keluaran'][0]->satuan : "Kosong"; ?>
		</td>
	</tr>
	<tr>
		<td>Hasil</td>
		<td colspan="3">
			<?= (@$data_indikator['hasil'][0]->uraian != null) ? $data_indikator['hasil'][0]->uraian : "Kosong"; ?>
		</td>
		<td align="left">
			<?= (@$data_indikator['hasil'][0]->target != null) ? $data_indikator['hasil'][0]->target : "Kosong"; ?>
		</td>
		<td>
			<?= (@$data_indikator['hasil'][0]->satuan != null) ? $data_indikator['hasil'][0]->satuan : "Kosong"; ?>
		</td>
	</tr>
	<tr>
		<td colspan="6"><b>Kelompok Sasaran Kegiatan :
			<?= (@$data_program[0]->sasaran != null) ? $data_program[0]->sasaran : "Kosong"; ?></b>
		</td>
	</tr>
	<tr>
		<td colspan="6" align="center"><b>Rincian Rencana Kerja dan Anggaran <br> Program dan Per Kegiatan Satuan Kerja</b></td>
	</tr>
	<tr>
		<td rowspan="2" style="width:200px; text-align:center;"><b>Kode Rekening</b></td>
		<td rowspan="2" style="width:700px; text-align:center;"><b>Uraian</b></td>
		<td colspan="3" style="text-align:center;"><b>Rincian Perhitungan</b></td>
		<td rowspan="2" style="text-align:center;"><b>Jumlah</b></td>
	</tr>
	<tr style="text-align:center;">
		<td><b>Volume</b></td>
		<td><b>Satuan</b></td>
		<td><b>Harga Satuan</b></td>
	</tr>
	<tr style="text-align:center;">
		<td><b>1</b></td>
		<td><b>2</b></td>
		<td><b>3</b></td>
		<td><b>4</b></td>
		<td><b>5</b></td>
		<td><b>6</b></td>
	</tr>
	<tr>
		<td style="text-align:left">
			<?= $data_kode ?>
		</td>
		<td align="left">
			<b>BELANJA LANGSUNG</b><br>
			<?= $data_uraian ?>
		</td>
		<td style="text-align:center">
			<?= $data_volume ?>
		</td>
		<td align="center">
			<?= $data_satuan ?>
		</td>
		<td align="left" style="padding-left:10px">
			<?= $data_harga ?>
		</td>
		<td style="text-align:right;">
			<b>
				<?= ($data_kegiatan[0]->total_rinci != null) ? number_format((double)$data_kegiatan[0]->total_rinci, 0, ",", ".") : 0; ?></b><br>
			<?= $data_jumlah ?>
		</td>
	</tr>
	<tr>
		<td colspan="5" style="text-align:center;">Jumlah</td>
		<td style="text-align:right;">
			<?= ($data_kegiatan[0]->total_rinci != null) ? number_format((double)$data_kegiatan[0]->total_rinci, 0, ",", ".") : 0; ?>
		</td>
	</tr>
	<tr>
		<td colspan="4">
			<table>
				<tr>
					<td>Triwulan 1</td>
					<td>Rp</td>
					<td>
						<?= (@$data_triwulan['T1'][0]->triwulan != null) ? number_format((double)$data_triwulan['T1'][0]->triwulan, 0, ",", ".") : 0; ?>
					</td>
				</tr>
				<tr>
					<td>Triwulan 2</td>
					<td>Rp</td>
					<td>
						<?= (@$data_triwulan['T2'][0]->triwulan != null) ? number_format((double)$data_triwulan['T2'][0]->triwulan, 0, ",", ".") : 0; ?>
					</td>
				</tr>
				<tr>
					<td>Triwulan 3</td>
					<td>Rp</td>
					<td>
						<?= (@$data_triwulan['T3'][0]->triwulan != null) ? number_format((double)$data_triwulan['T3'][0]->triwulan, 0, ",", ".") : 0; ?>
					</td>
				</tr>
				<tr>
					<td>Triwulan 4</td>
					<td>Rp</td>
					<td>
						<?= (@$data_triwulan['T4'][0]->triwulan != null) ? number_format((double)$data_triwulan['T4'][0]->triwulan, 0, ",", ".") : 0; ?>
					</td>
				</tr>
				<tr>
					<td>Jumlah</td>
					<td>Rp</td>
					<td style="border:solid thin">
						<?= ($data_kegiatan[0]->total_rekening != null) ? number_format((double)$data_kegiatan[0]->total_rekening, 0, ",", ".") : 0; ?>
					</td>
				</tr>
			</table>
		</td>
		<td colspan="2">
			<center>
				<table>
					<tr>
						<td style="text-align:center;">Surabaya,
							<?= date("d-M-Y") ?><br>(status_siswa)</td>
					</tr>
					<tr>
						<td></td>
					</tr>
					<tr>
						<td></td>
					</tr>
					<tr>
						<td></td>
					</tr>
					<tr>
						<td></td>
					</tr>
					<tr>
						<td style="text-align:center;"><u><b>
									<?= $data_siswa[0]->nama ?></b></u><br>
							<?= $data_siswa[0]->nis ?>
						</td>
					</tr>
				</table>
			</center>
		</td>
	</tr>
</table>
