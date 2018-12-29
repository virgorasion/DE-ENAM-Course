<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>
		<?php echo $title ?>
	</title>
	<style>
		::selection {
			background-color: #E13300;
			color: white;
		}

		::-moz-selection {
			background-color: #E13300;
			color: white;
		}

		body {
			background-color: #fff;
			margin: 20px;
			font: 13px/20px normal Helvetica, Arial, sans-serif;
			color: #4F5155;
		}

		main {
			width: 97%;
			padding: 20px;
			background-color: white;
			min-height: 300px;
			border-radius: 5px;
			box-shadow: 0 0 8px #D0D0D0;
		}

		table {
			border-top: solid thin #000;
			border-collapse: collapse;
		}

		th,
		td {
			border-top: border-top: solid thin #000;
			padding: 6px 12px;
		}

		a {
			color: #003399;
			background-color: transparent;
			font-weight: normal;
		}

	</style>
</head>

<body>
	<main>
		<h1>Laporan Excel</h1>
		<p><a href="<?php echo base_url('c_excel/export_excel') ?>">Export ke Excel</a></p>
		<table border="1" width="100%">
			<tr>
				<td colspan="4" rowspan="2" align="center">RENCANA KERJA DAN ANGGARAN <br> SATUAN KERJA PERANGKAT DAERAH</td>
				<td align="center">KODE KEGIATAN</td>
				<td rowspan="2" align="center">Formulir <br> RKA-SKPD 2.2.1</td>
			</tr>
			<tr>
				<td align="center">(kode_kegiatan)</td>
			</tr>
			<tr>
				<td colspan="6" align="center">Pemerintah Provinsi Jawa Timur <br> 2018</td>
			</tr>
			<tr>
				<td colspan="6">
					Instansi
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					:&nbsp; (kode_instansi) &nbsp; (Nama_instansi) <br>
					Sasaran RPJMD &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp; (sasaran_program) <br>
					Program
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					: &nbsp; (kode_program) &nbsp; (nama_program) <br>
					Kegiatan
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					: &nbsp; (kode_kegiatan) &nbsp; (nama_kegiatan) <br>
					Lokasi Kegiatan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp; Jawa Timur <br>
					Sumber Dana &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : &nbsp; Empty. <br>
				</td>
			</tr>
			<tr>
				<td colspan="6" align="center">Indikator & Tolor Ukur Kinerja Belanja Langsung</td>
			</tr>
			<tr>
				<td>Indikator</td>
				<td colspan="3">Tolok Ukur Kinerja</td>
				<td>Nilai</td>
				<td>Satuan</td>
			</tr>
			<tr>
				<td>Capaian Program</td>
				<td colspan="3">(uraian_program)</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>Masukan</td>
				<td colspan="3">(uraian_program)</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>Keluaran</td>
				<td colspan="3">(uraian_program)</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td>Hasil</td>
				<td colspan="3">(uraian_program)</td>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td colspan="6">Kelompok Sasaran Kegiatan : (sasaran_kegiatan)</td>
			</tr>
			<tr>
				<td colspan="6" align="center">Rincian Rencana Kerja dan Anggaran <br> Program dan Per Kegiatan Satuan Kerja</td>
			</tr>
			<tr>
				<td rowspan="2">Kode Rekening</td>
				<td rowspan="2">Uraian</td>
				<td colspan="3">Rincian Perhitungan</td>
				<td rowspan="2">Jumlah</td>
			</tr>
			<tr>
				<td>Volume</td>
				<td>Satuan</td>
				<td>Harga Satuan</td>
			</tr>
			<tr>
				<td>1</td>
				<td>2</td>
				<td>3</td>
				<td>4</td>
				<td>5</td>
				<td>6</td>
			</tr>
			<tr>
				<td>(kode_rekening)</td>
				<td id="test">
					
				</td>
				<td>(volume)</td>
				<td>(satuan)</td>
				<td>(harga_satuan)</td>
				<td>(jumlah)</td>
			</tr>
			<tr>
				<td colspan="5">Jumlah</td>
				<td>(total)</td>
			</tr>
			<tr>
				<td colspan="6">
					Rencana Penarikan Dana Per Triwulan :<br>
					Triwulan I &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Rp &nbsp;&nbsp;&nbsp;&nbsp; (jumlah_t1)<br>
					Triwulan II &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Rp &nbsp;&nbsp;&nbsp;&nbsp; (jumlah_t2)<br>
					Triwulan III &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Rp &nbsp;&nbsp;&nbsp;&nbsp; (jumlah_t3)<br>
					Triwulan IV &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Rp &nbsp;&nbsp;&nbsp;&nbsp; (jumlah_t4)<br>
				</td>
			</tr>
		</table>
	</main>
</body>

</html>
<?php $this->load->view('template/_js'); ?>
<script>
$.ajax({
		url: "<?= site_url('ProgramCtrl/data_excel') ?>",
		type: "POST",
		success:function(result){
			var data = JSON.parse(result);
            console.log(data);
            $("#test").html(data);
		}
	})
</script>