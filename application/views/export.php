<?php
defined('BASEPATH') or exit('No direct script access allowed');
?><!DOCTYPE html>
 <html lang="en">
 <head>
      <meta charset="utf-8">
      <title><?php echo $title ?></title>
      <style>
           ::selection { background-color: #E13300; color: white; }
           ::-moz-selection { background-color: #E13300; color: white; }
 
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
                border-collapse: collapse;
           }
           th, td {
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
           <p><a href="<?= site_url('ProgramCtrl/export_excel') ?>">Export ke Excel</a></p>
           <table border="1" width="100%">
                <tr>
                    <td colspan="4" rowspan="2" align="center"><h3><b>RENCANA KERJA DAN ANGGARAN</b> <br> <b>SATUAN KERJA PERANGKAT DAERAH</b></h3></td>
                    <td align="center"><b>KODE KEGIATAN</b></td>
                    <td rowspan="2" align="center"><b>Formulir <br> RKA-SKPD 2.2.1</b></td>
                </tr>
                <tr>
                    <td align="center"><b>(kode_kegiatan)</b></td>
                </tr>
                <tr>
                    <td colspan="6" align="center"><b>Pemerintah Provinsi Jawa Timur <br> 2018</b></td>
                </tr>
                <tr>
                    <td colspan="6"><b>
                        <table>
                            <tr>
                                <td>Instansi</td>
                                <td>:</td>
                                <td>(kode_instansi)</td>
                                <td>(nama_instansi)</td>
                            </tr>
                            <tr>
                                <td>Sasaran RPJMD</td>
                                <td>:</td>
                                <td colspan="2">(sasaran_program)</td>
                            </tr>
                            <tr>
                                <td>Program</td>
                                <td>:</td>
                                <td>(kode_program)</td>
                                <td>(nama_program)</td>
                            </tr>
                            <tr>
                                <td>Kegiatan</td>
                                <td>:</td>
                                <td>(kode_kegiatan)</td>
                                <td>(nama_kegiatan)</td>
                            </tr>
                            <tr>
                                <td>Lokasi Kegiatan</td>
                                <td>:</td>
                                <td colspan="2">(lokasi_kegiatan)</td>
                            </tr>
                            <tr>
                                <td>Sumber Dana</td>
                                <td>:</td>
                                <td colspan="2">(sumber_dana)</td>
                            </tr>
                        </table>
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
                    <td colspan="3">(uraian_indikator)</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Masukan</td>
                    <td colspan="3">(uraian_indikator)</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Keluaran</td>
                    <td colspan="3">(uraian_indikator)</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Hasil</td>
                    <td colspan="3">(uraian_indikator)</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="6">Kelompok Sasaran Kegiatan : (sasaran_kegiatan)</td>
                </tr>
                <tr>
                    <td colspan="6" align="center"><b>Rincian Rencana Kerja dan Anggaran <br> Program dan Per Kegiatan Satuan Kerja</b></td>
                </tr>
                <tr>
                    <td rowspan="2" style="width:200px; text-align:center;"><b>Kode Rekening</b></td>
                    <td rowspan="2" style="width:500px; text-align:center;"><b>Uraian</b></td>
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
                        <?=$data_kode?>
                    </td>
                    <td style="text-align:left:">
                        <?=$data_uraian?>
                    </td>
                    <td style="text-align:center">
                        <?=$data_volume?>
                    </td>
                    <td style="text-align:center:">
                        <?=$data_satuan?>
                    </td>
                    <td style="text-align:right;">
                        <?=$data_harga?>
                    </td>
                    <td style="text-align:right;">
                        <?= $data_jumlah?>
                    </td>
                </tr>
                <tr>
                    <td colspan="5" style="text-align:center;">Jumlah</td>
                    <td style="text-align:right;">(total)</td>
                </tr>
                <tr>
                    <td colspan="4">
                        <table>
                            <tr>
                                <td>Triwulan 1</td>
                                <td>Rp</td>
                                <td>(jumlah_semua_t1)</td>
                            </tr>
                            <tr>
                                <td>Triwulan 2</td>
                                <td>Rp</td>
                                <td>(jumlah_semua_t2)</td>
                            </tr>
                            <tr>
                                <td>Triwulan 3</td>
                                <td>Rp</td>
                                <td>(jumlah_semua_t3)</td>
                            </tr>
                            <tr>
                                <td>Triwulan 4</td>
                                <td>Rp</td>
                                <td>(jumlah_semua_t4)</td>
                            </tr>
                            <tr>
                                <td>Jumlah</td>
                                <td>Rp</td>
                                <td style="border:solid thin">(jumlah_semua_total_rek di rekening)</td>
                            </tr>
                        </table>
                    </td>
                    <td colspan="2">
                    <center>
                        <table>
                            <tr>
                                <td style="text-align:center;">(tempat dan tanggal)<br>(status_siswa)</td>
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
                                <td style="text-align:center;"><u><b>(nama_siswa)</b></u><br>(nis_siswa)</td>
                            </tr>
                        </table>
                    </center>
                    </td>
                </tr>
           </table>
      </main>
 </body>
 </html>