<?php
$this->load->library("phpexcel");
$this->load->library("PHPExcel/iofactory");

$objPHPExcel = new PHPExcel();
$sheet = $objPHPExcel->getActiveSheet();
$sheet->setShowGridlines(true);

//Styling Border
$boderHeader = array(
    'borders' => array(
        'outline' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array('rgb' => '000000')
        )
    ),
    'font' => array(
        'bold' => true,
    )
);
$boderUniv = array(
    'borders' => array(
        'outline' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN
        )
    )
);

//MergeCellsHeader
$sheet->mergeCells('A3:N3');
$sheet->mergeCells('A4:N4');
$sheet->mergeCells('A3:A4');
$sheet->mergeCells("O3:Q3");//merge kode kegiatan
$sheet->mergeCells("O4:Q4");
$sheet->mergeCells("O3:O4");
$sheet->mergeCells("R3:T3");//merge formulir
$sheet->mergeCells("R4:T4");
//END Merger Cell header

//Set content Header
$sheet->setCellValue('A3', 'RENCANA KERJA DAN ANGGARAN');
$sheet->setCellValue('A4','SATUAN KERJA PERANGKAT DAERAH');
$sheet->getStyle('A3:A4')->getAlignment()
->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
$sheet->getStyle('O3:Q4')->getAlignment()
->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
$sheet->getStyle('R3:T4')->getAlignment()
->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
$sheet->getStyle("A3:N4")->applyFromArray($boderHeader);
$sheet->getStyle("O3:Q3")->applyFromArray($boderHeader);
$sheet->getStyle("O4:Q4")->applyFromArray($boderHeader);
$sheet->getStyle("R3:T4")->applyFromArray($boderHeader);
$sheet->setCellValue("O3","KODE KEGIATAN");
$sheet->setCellValue("O4", "$kodeKegiatan" );
$sheet->setCellValue("R3","FORMULIR");
$sheet->setCellValue("R4","RKA-SKPD 2.2.1");
//End content header

//set content pemerintah provinsi
$sheet->mergeCells("A5:T6");
$sheet->setCellValue("A5","Pemerintah Provinsi Jawa Timur\n".date('Y'));
$sheet->getStyle("A5")->getAlignment()->setWrapText(true);
$sheet->getStyle("A5:T6")->applyFromArray($boderUniv);
$sheet->getStyle('A5:T6')->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
//END content

//set content info
$sheet->getStyle('A3:A4')->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
$sheet->getStyle('D9')->getAlignment()
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
$sheet->getStyle("A7:T13")->applyFromArray($boderUniv);
$sheet->getColumnDimension("C")->setWidth("3");
$sheet->getColumnDimension("D")->setWidth("10");
$sheet->setCellValue("A7","Instansi");
$sheet->setCellValue("C7",":");
$sheet->setCellValue("D7","$kodeInstansi");
$namaInstansi = (@$data_instansi[0]->nama_instansi != null) ? $data_instansi[0]->nama_instansi : ' Kosong ';
$sheet->setCellValue("E7","$namaInstansi");
$sheet->setCellValue("A8", "Sasaran RPJMD");
$sheet->setCellValue("C8",":");
$namaSasaran = (@$data_program[0]->sasaran != null) ? $data_program[0]->sasaran : 'Kosong';
$sheet->setCellValue("D8","$namaSasaran");
$sheet->setCellValue("A9", "Program");
$sheet->setCellValue("C9", ":");
$sheet->setCellValue("D9", "$kodeProgram");
$namaProgram = (@$data_program[0]->nama_program != null) ? $data_program[0]->nama_program : 'Kosong';
$sheet->setCellValue("E9", "$namaProgram");
$sheet->setCellValue("A10", "Kegiatan");
$sheet->setCellValue("C10", ":");
$sheet->setCellValue("D10", "$kodeKegiatan");
$namaKegiatan = (@$data_kegiatan[0]->nama_kegiatan != null) ? $data_kegiatan[0]->nama_kegiatan : 'Kosong';
$sheet->setCellValue("E10", "$namaKegiatan");
$sheet->setCellValue("A12", "Lokasi Kegiatan");
$sheet->setCellValue("C12", ":");
$sheet->setCellValue("D12", "Jawa Timur");
$sheet->setCellValue("A13", "Sumber Dana");
$sheet->setCellValue("C13", ":");
$versi = (@$data_instansi[0]->versi != null) ? $data_instansi[0]->versi : 'Kosong';
$sheet->setCellValue("D13", "$versi");
//END content info

//content indikator
$sheet->mergeCells("A14:T14");
$sheet->getStyle('A14')->getAlignment()
->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
$sheet->getStyle('A15')->getAlignment()
->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
$sheet->getStyle('D15')->getAlignment()
->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
$sheet->getStyle('N15')->getAlignment()
->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
$sheet->getStyle('Q15')->getAlignment()
->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
$sheet->setCellValue("A14","Indikator & Tolok Ukur Kinerja Belanja Langsung");
$sheet->getStyle("A14:T14")->applyFromArray($boderUniv);
$sheet->getStyle("A15:C15")->applyFromArray($boderUniv);
$sheet->getStyle("D15:M15")->applyFromArray($boderUniv);
$sheet->getStyle("N15:P15")->applyFromArray($boderUniv);
$sheet->getStyle("Q15:T15")->applyFromArray($boderUniv);
$sheet->setCellValue("A15","Indikator");
$sheet->setCellValue("D15","Uraian");
$sheet->setCellValue("N15","Nilai");
$sheet->setCellValue("Q15","Satuan");

$sheet->getStyle("A16:C16")->applyFromArray($boderUniv);
$sheet->getStyle("D16:M16")->applyFromArray($boderUniv);
$sheet->getStyle("N16:P16")->applyFromArray($boderUniv);
$sheet->getStyle("Q16:T16")->applyFromArray($boderUniv);
$sheet->setCellValue("A16", "Capaian");
$capaian1 = (@$data_indikator['capaian'][0]['uraian'] != null) ? $data_indikator['capaian'][0]['uraian'] : "";
$sheet->setCellValue("D16", $capaian1);
$capaian2 = (@$data_indikator['capaian'][0]['target'] != null) ? $data_indikator['capaian'][0]['target'] : "";
$sheet->setCellValue("N16", $capaian2);
$capaian3 = (@$data_indikator['capaian'][0]['satuan'] != null) ? $data_indikator['capaian'][0]['satuan'] : "";
$sheet->setCellValue("Q16", $capaian3);

$sheet->getStyle("A17:C17")->applyFromArray($boderUniv);
$sheet->getStyle("D17:M17")->applyFromArray($boderUniv);
$sheet->getStyle("N17:P17")->applyFromArray($boderUniv);
$sheet->getStyle("Q17:T17")->applyFromArray($boderUniv);
$sheet->setCellValue("A17","Masukan");
$masukan1 = (@$data_indikator['masukan'][0]['uraian'] != NULL) ? $data_indikator['masukan'][0]['uraian'] : "" ;
$sheet->setCellValue("D17", $masukan1);
$masukan2 = (@$data_indikator['masukan'][0]['target'] != NULL) ? $data_indikator['masukan'][0]['target'] : "" ;
$sheet->setCellValue("N17", $masukan2);
$masukan3 = (@$data_indikator['masukan'][0]['satuan'] != NULL) ? $data_indikator['masukan'][0]['satuan'] : "" ;
$sheet->setCellValue("Q17", $masukan3);

$sheet->getStyle("A18:C18")->applyFromArray($boderUniv);
$sheet->getStyle("D18:M18")->applyFromArray($boderUniv);
$sheet->getStyle("N18:P18")->applyFromArray($boderUniv);
$sheet->getStyle("Q18:T18")->applyFromArray($boderUniv);
$sheet->setCellValue("A18", "Keluaran");
$keluaran1 = (@$data_indikator['keluaran'][0]['uraian'] != null) ? $data_indikator['keluaran'][0]['uraian'] : "";
$sheet->setCellValue("D18", $keluaran1);
$keluaran2 = (@$data_indikator['keluaran'][0]['target'] != null) ? $data_indikator['keluaran'][0]['target'] : "";
$sheet->setCellValue("N18", $keluaran2);
$keluaran3 = (@$data_indikator['keluaran'][0]['satuan'] != null) ? $data_indikator['keluaran'][0]['satuan'] : "";
$sheet->setCellValue("Q18", $keluaran3);

$sheet->getStyle("A19:C19")->applyFromArray($boderUniv);
$sheet->getStyle("D19:M19")->applyFromArray($boderUniv);
$sheet->getStyle("N19:P19")->applyFromArray($boderUniv);
$sheet->getStyle("Q19:T19")->applyFromArray($boderUniv);
$sheet->setCellValue("A19", "Hasil");
$hasil1 = (@$data_indikator['hasil'][0]['uraian'] != null) ? $data_indikator['hasil'][0]['uraian'] : "";
$sheet->setCellValue("D19", $hasil1);
$hasil2 = (@$data_indikator['hasil'][0]['target'] != null) ? $data_indikator['hasil'][0]['target'] : "";
$sheet->setCellValue("N19", $hasil2);
$hasil3 = (@$data_indikator['hasil'][0]['satuan'] != null) ? $data_indikator['hasil'][0]['satuan'] : "";
$sheet->setCellValue("Q19", $hasil3);
//END Content Indikator

//content sasaran kegiatan
$sheet->mergeCells("A20:T20");
$sheet->getStyle("A20:T20")->applyFromArray($boderUniv);
$sheet->setCellValue("A20","Kelompok Sasaran Kegiatan : ". $data_program[0]->sasaran);
//END content sasaran kegiatan

//content rincian rencana kerja
$sheet->mergeCells("A21:T22");
$sheet->getStyle('A21:T22')->getAlignment()->setWrapText(true)
    ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
$sheet->setCellValue("A21","Rincian Rencana Kerja dan Anggaran\nProgram dan Per Kegiatan Satuan Kerja Perangakat Daerah");
$sheet->getStyle("A21:T22")->applyFromArray($boderHeader);

$sheet->setCellValue("A23","Kode Rekening");
$sheet->getStyle("A23:C24")->applyFromArray($boderHeader);
$sheet->mergeCells("A23:C23");
$sheet->setCellValue("D23","Uraian");
$sheet->getStyle("D23:J24")->applyFromArray($boderHeader);
$sheet->mergeCells("D23:J23");
$sheet->getStyle("K23:Q24")->applyFromArray($boderHeader);
$sheet->setCellValue("K23","Rincian Perhitungan");
$sheet->mergeCells("K23:Q23");
$sheet->getStyle("K24:L24")->applyFromArray($boderHeader);
$sheet->setCellValue("K24","Volume");
$sheet->getStyle("M24:N24")->applyFromArray($boderHeader);
$sheet->setCellValue("M24","Satuan");
$sheet->getStyle("O24:Q24")->applyFromArray($boderHeader);
$sheet->setCellValue("O24","Harga Satuan");
$sheet->getStyle("R23:T24")->applyFromArray($boderHeader);
$sheet->setCellValue("R23","Jumlah");
$sheet->setCellValue("R24","(RP)");
$sheet->getStyle("A25:C25")->applyFromArray($boderHeader);
$sheet->setCellValue("A25","1");
$sheet->getStyle("D25:J25")->applyFromArray($boderHeader);
$sheet->setCellValue("D25","2");
$sheet->getStyle("K25:L25")->applyFromArray($boderHeader);
$sheet->setCellValue("K25","3");
$sheet->getStyle("M25:N25")->applyFromArray($boderHeader);
$sheet->setCellValue("M25","4");
$sheet->getStyle("O25:Q25")->applyFromArray($boderHeader);
$sheet->setCellValue("O25","5");
$sheet->getStyle("R25:T25")->applyFromArray($boderHeader);
$sheet->setCellValue("R25","6");


header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Laporan_pencapaian.xlsx"');
header('Cache-Control: max-age=0');

// Save it as an sheet 2003 file
$objWriter = IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit();
