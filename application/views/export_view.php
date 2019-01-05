<?php
defined('BASEPATH') or exit('No direct script access allowed');
?><!DOCTYPE html>
 <html lang="en">
 <head>
      <meta charset="utf-8">
      <title>asd</title>
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
           <p><a href="<?= site_url('Export/Excel/').$kodeInstansi.'/'.$kodeProgram.'/'.$kodeKegiatan ?>">Export ke Excel</a></p>
           <table border="1" width="100%">
                <tr>
                    <td colspan="4" rowspan="2" align="center"><h3><b>RENCANA KERJA DAN ANGGARAN</b> <br> <b>SATUAN KERJA PERANGKAT DAERAH</b></h3></td>
                    <td align="center"><b>KODE KEGIATAN</b></td>
                    <td rowspan="2" align="center"><b>Formulir <br> RKA-SKPD 2.2.1</b></td>
                </tr>
                <tr>
                    <td align="center"><b><?=$kodeKegiatan?></b></td>
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
                                <td>(<?=$kodeInstansi?>)</td>
                                <td><?=(@$data_instansi[0]->nama_instansi != NULL) ? $data_instansi[0]->nama_instansi : "Kosong" ;?></td>
                            </tr>
                            <tr>
                                <td>Sasaran RPJMD</td>
                                <td>:</td>
                                <td colspan="2"><?=(@$data_program[0]->sasaran != NULL) ? $data_program[0]->sasaran : "Kosong" ;?></td>
                            </tr>
                            <tr>
                                <td>Program</td>
                                <td>:</td>
                                <td>(<?=$kodeProgram?>)</td>
                                <td><?=(@$data_program[0]->nama_program != NULL) ? $data_program[0]->nama_program : "Kosong" ;?></td>
                            </tr>
                            <tr>
                                <td>Kegiatan</td>
                                <td>:</td>
                                <td>(<?=$kodeKegiatan?>)</td>
                                <td><?=(@$data_kegiatan[0]->nama_kegiatan != NULL) ? $data_kegiatan[0]->nama_kegiatan : "Kosong" ;?></td>
                            </tr>
                            <tr>
                                <td>Lokasi Kegiatan</td>
                                <td>:</td>
                                <td colspan="2">Jawa Timur</td>
                            </tr>
                            <tr>
                                <td>Sumber Dana</td>
                                <td>:</td>
                                <td colspan="2"><?=(@$data_instansi[0]->versi != NULL) ? $data_instansi[0]->versi : "Kosong" ;?></td>
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
                    <td colspan="3"><?= (@$data_indikator['capaian'][0]->uraian != null) ? $data_indikator['capaian'][0]->uraian : "Kosong"; ?></td>
                    <td><?= (@$data_indikator['capaian'][0]->target != null) ? $data_indikator['capaian'][0]->target : "Kosong"; ?></td>
                    <td><?= (@$data_indikator['capaian'][0]->satuan != null) ? $data_indikator['capaian'][0]->satuan : "Kosong"; ?></td>
                </tr>
                <tr>
                    <td>Masukan</td>
                    <td colspan="3"><?= (@$data_indikator['masukan'][0]->uraian != null) ? $data_indikator['masukan'][0]->uraian : "Kosong"; ?></td>
                    <td><?= (@$data_indikator['masukan'][0]->target != null) ? $data_indikator['masukan'][0]->target : "Kosong"; ?></td>
                    <td><?= (@$data_indikator['masukan'][0]->satuan != null) ? $data_indikator['masukan'][0]->satuan : "Kosong"; ?></td>
                </tr>
                <tr>
                    <td>Keluaran</td>
                    <td colspan="3"><?= (@$data_indikator['keluaran'][0]->uraian != null) ? $data_indikator['keluaran'][0]->uraian : "Kosong"; ?></td>
                    <td><?= (@$data_indikator['keluaran'][0]->target != null) ? $data_indikator['keluaran'][0]->target : "Kosong"; ?></td>
                    <td><?= (@$data_indikator['keluaran'][0]->satuan != null) ? $data_indikator['keluaran'][0]->satuan : "Kosong"; ?></td>
                </tr>
                <tr>
                    <td>Hasil</td>
                    <td colspan="3"><?= (@$data_indikator['hasil'][0]->uraian != null) ? $data_indikator['hasil'][0]->uraian : "Kosong"; ?></td>
                    <td><?= (@$data_indikator['hasil'][0]->target != null) ? $data_indikator['hasil'][0]->target : "Kosong"; ?></td>
                    <td><?= (@$data_indikator['hasil'][0]->satuan != null) ? $data_indikator['hasil'][0]->satuan : "Kosong"; ?></td>
                </tr>
                <tr>
                    <td colspan="6">Kelompok Sasaran Kegiatan : <?=(@$data_program[0]->sasaran != NULL) ? $data_program[0]->sasaran : "Kosong" ;?></td>
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
                        <?php 
                            $lenght = count($data_kode);
                            for ($i=0; $i < $lenght ; $i++) {
                                if ($data_kode[$i] != "") {
                                    echo $data_kode[$i];
                                } else {
                                    echo "<br>";
                                }
                                echo "<br>";
                            }
                        ?>
                    </td>
                    <td style="text-align:left:">
                        <?php 
                            $lenght = count($data_uraian);
                            for ($i=0; $i < $lenght ; $i++) {
                                if ($data_uraian[$i] != "") {
                                    echo $data_uraian[$i];
                                } else {
                                    echo "<br>";
                                }
                                echo "<br>";
                            }
                        ?>
                    </td>
                    <td style="text-align:center">
                        <?php 
                            $lenght = count($data_volume);
                            for ($i=0; $i < $lenght ; $i++) {
                                if ($data_volume[$i] != "") {
                                    echo $data_volume[$i];
                                } else {
                                    echo "<br>";
                                }
                                echo "<br>";
                            }
                        ?>
                    </td>
                    <td style="text-align:center:">
                        <?php 
                            $lenght = count($data_satuan);
                            for ($i=0; $i < $lenght ; $i++) {
                                if ($data_satuan[$i] != "") {
                                    echo $data_satuan[$i];
                                } else {
                                    echo "<br>";
                                }
                                echo "<br>";
                            }
                        ?>
                    </td>
                    <td style="text-align:right;">
                        <?php 
                            $lenght = count($data_harga);
                            for ($i=0; $i < $lenght ; $i++) {
                                if ($data_harga[$i] != "") {
                                    echo $data_harga[$i];
                                } else {
                                    echo "<br>";
                                }
                                echo "<br>";
                            }
                        ?>
                    </td>
                    <td style="text-align:right;">
                        <b><?= ($data_kegiatan[0]->total_rinci != null) ? number_format((double)$data_kegiatan[0]->total_rinci, 0, ",", ".") : 0; ?></b><br>
                        <?php 
                            $lenght = count($data_harga);
                            for ($i=0; $i < $lenght; $i++) {
                                if ($data_harga[$i] != "") {
                                    echo $data_harga[$i];
                                } else {
                                    echo "<br>";
                                }
                                echo "<br>";
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="5" style="text-align:center;">Jumlah</td>
                    <td style="text-align:right;"><?= ($data_kegiatan[0]->total_rinci != null) ? number_format((double)$data_kegiatan[0]->total_rinci, 0, ",", ".") : 0; ?></td>
                </tr>
                <tr>
                    <td colspan="4">
                        <table>
                            <tr>
                                <td>Triwulan 1</td>
                                <td>Rp</td>
                                <td><?=(@$data_triwulan['T1'][0]->triwulan != NULL) ? number_format((double)$data_triwulan['T1'][0]->triwulan,0,",",".") : 0 ;?></td>
                            </tr>
                            <tr>
                                <td>Triwulan 2</td>
                                <td>Rp</td>
                                <td><?= (@$data_triwulan['T2'][0]->triwulan != NULL) ? number_format((double)$data_triwulan['T2'][0]->triwulan,0,",",".") : 0; ?></td>
                            </tr>
                            <tr>
                                <td>Triwulan 3</td>
                                <td>Rp</td>
                                <td><?= (@$data_triwulan['T3'][0]->triwulan != NULL) ? number_format((double)$data_triwulan['T3'][0]->triwulan,0,",",".") : 0; ?></td>
                            </tr>
                            <tr>
                                <td>Triwulan 4</td>
                                <td>Rp</td>
                                <td><?= (@$data_triwulan['T4'][0]->triwulan != NULL) ? number_format((double)$data_triwulan['T4'][0]->triwulan,0,",",".") : 0; ?></td>
                            </tr>
                            <tr>
                                <td>Jumlah</td>
                                <td>Rp</td>
                                <td style="border:solid thin"><?= ($data_kegiatan[0]->total_rekening != NULL) ? number_format((double)$data_kegiatan[0]->total_rekening,0,",",".") : 0; ?></td>
                            </tr>
                        </table>
                    </td>
                    <td colspan="2">
                    <center>
                        <table>
                            <tr>
                                <td style="text-align:center;">Surabaya, <?=date("d-M-Y")?><br>(status_siswa)</td>
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
                                <td style="text-align:center;"><u><b><?=$data_siswa[0]->nama?></b></u><br><?=$data_siswa[0]->nis?></td>
                            </tr>
                        </table>
                    </center>
                    </td>
                </tr>
           </table>
      </main>
 </body>
 </html>