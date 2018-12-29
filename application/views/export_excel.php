<?php

// header("Content-type: application/vnd-ms-excel");

// header("Content-Disposition: attachment; filename=pencapaian_siswa.xls");

// header("Pragma: no-cache");

// header("Expires: 0");

?>
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
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :
			&nbsp; (kode_kegiatan) &nbsp; (nama_kegiatan) <br>
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
		<td>
        <?php 
            $count = count($count_rekening);
            foreach ($count_rekening as $item) {
                echo $item->kode_rekening."<br>";
                foreach ($rekening as $rek) {
                    $rek->uraian;
                }
            }
        ?>
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
