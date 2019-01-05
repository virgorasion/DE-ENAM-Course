<?php

defined('BASEPATH')or exit('ERROR');

class Export extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library("DataExcel");
    }

    public function Excel($kodeInstansi, $kodeProgram, $kodeKegiatan)
    {
        $date = date("Y");
        $data_uraian = $this->dataexcel->getDataUraian($kodeInstansi, $kodeProgram, $kodeKegiatan);
        $data_kode = $this->dataexcel->getDataKode($kodeInstansi, $kodeProgram, $kodeKegiatan);
        $data_volume = $this->dataexcel->getDataVolume($kodeInstansi, $kodeProgram, $kodeKegiatan);
        $data_satuan = $this->dataexcel->getDataSatuan($kodeInstansi, $kodeProgram, $kodeKegiatan);
        $data_harga = $this->dataexcel->getDataHarga($kodeInstansi, $kodeProgram, $kodeKegiatan);
        $data_jumlah = $this->dataexcel->getDataJumlah($kodeInstansi, $kodeProgram, $kodeKegiatan);
        $data_instansi = $this->dataexcel->getDataInstansi($kodeInstansi, $kodeProgram, $kodeKegiatan);
        $data_program = $this->dataexcel->getDataProgram($kodeInstansi, $kodeProgram);
        $data_kegiatan = $this->dataexcel->getDataKegiatan($kodeInstansi, $kodeProgram, $kodeKegiatan);
        $data_indikator = $this->dataexcel->getDataIndikator($kodeInstansi, $kodeProgram);
        $data_triwulan = $this->dataexcel->getDataTriwulan($kodeInstansi, $kodeProgram, $kodeKegiatan);
        $data_siswa = $this->dataexcel->getDataSiswa($kodeInstansi, $kodeProgram);
        $uraianLenght = count($data_uraian);

        $this->load->library("phpexcel");
        $this->load->library("PHPExcel/iofactory");

        $objPHPExcel = new PHPExcel();
        $sheet = $objPHPExcel->getActiveSheet();
        $sheet->setShowGridlines(false);

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
        $bold = array(
            'font' => array(
                'bold' => true
            )
        );
        $jumlah = array(
            'borders' => array(
                'top' => array(
                    'style' => PHPexcel_Style_Border::BORDER_THICK
                ),
                'bottom' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THICK
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
        $sheet->setCellValue('A4', 'SATUAN KERJA PERANGKAT DAERAH');
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
        $sheet->setCellValue("O3", "KODE KEGIATAN");
        $sheet->setCellValue("O4", "$kodeKegiatan");
        $sheet->setCellValue("R3", "FORMULIR");
        $sheet->setCellValue("R4", "RKA-SKPD 2.2.1");
        //End content header

        //set content pemerintah provinsi
        $sheet->mergeCells("A5:T6");
        $sheet->setCellValue("A5", "Pemerintah Provinsi Jawa Timur\n" . date('Y'));
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
        $sheet->setCellValue("A7", "Instansi");
        $sheet->setCellValue("C7", ":");
        $sheet->setCellValue("D7", "$kodeInstansi");
        $namaInstansi = (@$data_instansi[0]->nama_instansi != null) ? $data_instansi[0]->nama_instansi : ' Kosong ';
        $sheet->setCellValue("E7", "$namaInstansi");
        $sheet->setCellValue("A8", "Sasaran RPJMD");
        $sheet->setCellValue("C8", ":");
        $namaSasaran = (@$data_program[0]->sasaran != null) ? $data_program[0]->sasaran : 'Kosong';
        $sheet->setCellValue("D8", "$namaSasaran");
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
        $sheet->getStyle('A14')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //center row judul tolok ukur
        $sheet->getStyle('A15')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //center row Indikator
        $sheet->getStyle('D15')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //center row Uraian
        $sheet->getStyle('N15')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //center row Nilai
        $sheet->getStyle('Q15')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //center row Satuan
        $sheet->setCellValue("A14", "Indikator & Tolok Ukur Kinerja Belanja Langsung");
        $sheet->getStyle("A14:T14")->applyFromArray($boderHeader); //style row judul tolok ukur
        $sheet->mergeCells("A14:T14"); //merge for row judul tolok ukur
        $sheet->getStyle("A15:C15")->applyFromArray($boderHeader); //style row Indikator
        $sheet->mergeCells("A15:C15"); //merge for row Indikator
        $sheet->getStyle("D15:M15")->applyFromArray($boderHeader); //style row Uraian
        $sheet->mergeCells("D15:M15"); //merge for row Uraian
        $sheet->getStyle("N15:P15")->applyFromArray($boderHeader); //style row Nilai
        $sheet->mergeCells("N15:P15"); //merge for row Nilai
        $sheet->getStyle("Q15:T15")->applyFromArray($boderHeader); //style row Satuan
        $sheet->mergeCells("Q15:T15"); //merge for row Satuan
        $sheet->setCellValue("A15", "Indikator");
        $sheet->setCellValue("D15", "Uraian");
        $sheet->setCellValue("N15", "Nilai");
        $sheet->setCellValue("Q15", "Satuan");

        $sheet->getStyle("A16:C16")->applyFromArray($boderUniv);
        $sheet->getStyle("D16:M16")->applyFromArray($boderUniv); //style row uraian
        $sheet->mergeCells("D16:M16"); //merge row uraian
        $sheet->getStyle("N16:P16")->applyFromArray($boderUniv); //style row target
        $sheet->mergeCells("N16:P16"); //merge row target
        $sheet->getStyle("N16:P16")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //center row target
        $sheet->getStyle("Q16:T16")->applyFromArray($boderUniv); //style row satuan
        $sheet->mergeCells("Q16:T16"); //merge row satuan
        $sheet->getStyle("Q16:T16")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //center row satuan
        $sheet->setCellValue("A16", "Capaian");
        $sheet->setCellValue("D16", @$data_indikator['capaian'][0]['uraian']);
        $sheet->setCellValue("N16", @$data_indikator['capaian'][0]['target']);
        $sheet->setCellValue("Q16", @$data_indikator['capaian'][0]['satuan']);

        $sheet->getStyle("A17:C17")->applyFromArray($boderUniv);
        $sheet->getStyle("D17:M17")->applyFromArray($boderUniv); //style row uraian
        $sheet->mergeCells("D17:M17"); //merge row uraian
        $sheet->getStyle("N17:P17")->applyFromArray($boderUniv); //style row target
        $sheet->mergeCells("N17:P17"); //merge row target
        $sheet->getStyle("N17:P17")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //center row target
        $sheet->getStyle("Q17:T17")->applyFromArray($boderUniv); //style row satuan
        $sheet->mergeCells("Q17:T17"); //merge row satuan
        $sheet->getStyle("Q17:T17")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //center row satuan
        $sheet->setCellValue("A17", "Masukan");
        $sheet->setCellValue("D17", @$data_indikator['masukan'][0]['uraian']);
        $sheet->setCellValue("N17", @$data_indikator['masukan'][0]['target']);
        $sheet->setCellValue("Q17", @$data_indikator['masukan'][0]['satuan']);

        $sheet->getStyle("A18:C18")->applyFromArray($boderUniv);
        $sheet->getStyle("D18:M18")->applyFromArray($boderUniv); //style row uraian
        $sheet->mergeCells("D18:M18"); //merge row uraian
        $sheet->getStyle("N18:P18")->applyFromArray($boderUniv); //style row target
        $sheet->mergeCells("N18:P18"); //merge row target
        $sheet->getStyle("N18:P18")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //center row target
        $sheet->getStyle("Q18:T18")->applyFromArray($boderUniv); //style row satuan
        $sheet->mergeCells("Q18:T18"); //merge row satuan
        $sheet->getStyle("Q18:T18")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //center row satuan
        $sheet->setCellValue("A18", "Keluaran");
        $sheet->setCellValue("D18", @$data_indikator['keluaran'][0]['uraian']);
        $sheet->setCellValue("N18", @$data_indikator['keluaran'][0]['target']);
        $sheet->setCellValue("Q18", @$data_indikator['keluaran'][0]['satuan']);

        $sheet->getStyle("A19:C19")->applyFromArray($boderUniv);
        $sheet->getStyle("D19:M19")->applyFromArray($boderUniv); //style row uraian
        $sheet->mergeCells("D19:M19"); //merge row uraian
        $sheet->getStyle("N19:P19")->applyFromArray($boderUniv); //style row target
        $sheet->mergeCells("N19:P19"); //merge row target
        $sheet->getStyle("N19:P19")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //center row target
        $sheet->getStyle("Q19:T19")->applyFromArray($boderUniv); //style row satuan
        $sheet->mergeCells("Q19:T19"); //merge row satuan
        $sheet->getStyle("Q19:T19")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //center row satuan
        $sheet->setCellValue("A19", "Hasil");
        $sheet->setCellValue("D19", @$data_indikator['hasil'][0]['uraian']);
        $sheet->setCellValue("N19", @$data_indikator['hasil'][0]['target']);
        $sheet->setCellValue("Q19", @$data_indikator['hasil'][0]['satuan']);
        //END Content Indikator

        //content sasaran kegiatan
        $sheet->mergeCells("A20:T20");
        $sheet->getStyle("A20:T20")->applyFromArray($boderHeader);
        $sheet->setCellValue("A20", "Kelompok Sasaran Kegiatan : " . $data_program[0]->sasaran);
        //END content sasaran kegiatan

        //content rincian rencana kerja
        $sheet->mergeCells("A21:T22");
        $sheet->getStyle('A21:T22')->getAlignment()->setWrapText(true)
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $sheet->setCellValue("A21", "Rincian Rencana Kerja dan Anggaran\nProgram dan Per Kegiatan Satuan Kerja Perangakat Daerah");
        $sheet->getStyle("A21:T22")->applyFromArray($boderHeader);

        $sheet->mergeCells("A23:C23");
        $sheet->getStyle("A23:C23")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //center row Kode Rekening
        $sheet->setCellValue("A23", "Kode Rekening");
        $sheet->getStyle("A23:C24")->applyFromArray($boderHeader);
        $sheet->setCellValue("D23", "Uraian");
        $sheet->getStyle("D23:J24")->applyFromArray($boderHeader);
        $sheet->mergeCells("D23:J23");
        $sheet->getStyle("D23:J23")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //center row Uraian
        $sheet->getStyle("K23:Q24")->applyFromArray($boderHeader);
        $sheet->setCellValue("K23", "Rincian Perhitungan");
        $sheet->mergeCells("K23:Q23");
        $sheet->getStyle("K23:Q23")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //center row Rincian Perhitungan
        $sheet->getStyle("K24:L24")->applyFromArray($boderHeader);
        $sheet->mergeCells("K24:L24");
        $sheet->getStyle("K24:L24")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //center row volume
        $sheet->setCellValue("K24", "Volume");
        $sheet->getStyle("M24:N24")->applyFromArray($boderHeader);
        $sheet->mergeCells("M24:N24");
        $sheet->getStyle("M24:N24")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //center row satuan
        $sheet->setCellValue("M24", "Satuan");
        $sheet->getStyle("O24:Q24")->applyFromArray($boderHeader);
        $sheet->mergeCells("O24:Q24");
        $sheet->getStyle("O24:Q24")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //center row harga satuan
        $sheet->setCellValue("O24", "Harga Satuan");
        $sheet->getStyle("R23:T24")->applyFromArray($boderHeader);
        $sheet->getStyle("R23:T24")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //center row jumlah
        $sheet->mergeCells("R23:T23");
        $sheet->setCellValue("R23", "Jumlah");
        $sheet->mergeCells("R24:T24");
        $sheet->setCellValue("R24", "(RP)");

        $sheet->mergeCells("A25:C25");
        $sheet->getStyle("A25:C25")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //center row 1
        $sheet->getStyle("A25:C25")->applyFromArray($boderHeader);
        $sheet->setCellValue("A25", "1");
        $sheet->mergeCells("D25:J25");
        $sheet->getStyle("D25:J25")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //center row 2
        $sheet->getStyle("D25:J25")->applyFromArray($boderHeader);
        $sheet->setCellValue("D25", "2");
        $sheet->mergeCells("K25:L25");
        $sheet->getStyle("K25:L25")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //center row 3
        $sheet->getStyle("K25:L25")->applyFromArray($boderHeader);
        $sheet->setCellValue("K25", "3");
        $sheet->mergeCells("M25:N25");
        $sheet->getStyle("M25:N25")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //center row 4
        $sheet->getStyle("M25:N25")->applyFromArray($boderHeader);
        $sheet->setCellValue("M25", "4");
        $sheet->mergeCells("O25:Q25");
        $sheet->getStyle("O25:Q25")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //center row 5
        $sheet->getStyle("O25:Q25")->applyFromArray($boderHeader);
        $sheet->setCellValue("O25", "5");
        $sheet->mergeCells("R25:T25");
        $sheet->getStyle("R25:T25")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //center row 6
        $sheet->getStyle("R25:T25")->applyFromArray($boderHeader);
        $sheet->setCellValue("R25", "6");

        $row = 26; //untuk mengatur cell posisi data
        //looping data rincian rencana kerja
        for ($array = 0; $array < $uraianLenght; $array++) {
            $sheet->mergeCells("A$row:C$row");
            $sheet->setCellValue("A" . $row, $data_kode[$array]); //data kode rekening & detail
            $sheet->getStyle("A$row:Q$row")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); //left data kode
            $sheet->mergeCells("D$row:J$row");
            $sheet->setCellValue("D" . $row, $data_uraian[$array]); //data uraian
            $sheet->mergeCells("K$row:L$row");
            $sheet->setCellValue("K" . $row, $data_volume[$array]); //data volume
            $sheet->getStyle("K$row:L$row")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //center data volume
            $sheet->mergeCells("M$row:N$row");
            $sheet->setCellValue("M" . $row, $data_satuan[$array]); //data stauan
            $sheet->getStyle("M$row:N$row")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //center data satuan
            $sheet->mergeCells("O$row:Q$row");
            $sheet->setCellValue("O" . $row, $data_harga[$array]); //data harga
            $sheet->getStyle("O$row:Q$row")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //right data harga
            $sheet->mergeCells("R$row:T$row");
            $sheet->setCellValue("R" . $row, $data_jumlah[$array]); //data jumlah rekening & detail
            $sheet->getStyle("R$row:T$row")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //rigth data jumlah
            $row++;
        }
        //border untuk area data uraian dan sekitarnya
        $row--;
        $sheet->getStyle("A26:C$row")->applyFromArray($boderUniv);
        $sheet->getStyle("D26:J$row")->applyFromArray($boderUniv);
        $sheet->getStyle("K26:L$row")->applyFromArray($boderUniv);
        $sheet->getStyle("M26:N$row")->applyFromArray($boderUniv);
        $sheet->getStyle("O26:Q$row")->applyFromArray($boderUniv);
        $sheet->getStyle("R26:T$row")->applyFromArray($boderUniv);

        //content data jumlah
        $row++;
        $sheet->mergeCells("A$row:Q$row"); //merge data "jumlah"
        $sheet->mergeCells("R$row:T$row"); //merga data "total_rinci"
        $sheet->getStyle("A$row:Q$row")->applyFromArray($boderHeader); //style data "jumlah"
        $sheet->getStyle("R$row:T$row")->applyFromArray($boderHeader); // style data "total_rinci"
        $sheet->setCellValue("A$row", "Jumlah");
        $sheet->getStyle("A$row:Q$row")->getAlignment()
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $sheet->setCellValue("R$row", number_format((double)$data_kegiatan[0]->total_rinci, 0, ",", ","));

        //content data Triwulan
        $row++;
        $sheet->mergeCellS("A$row:F$row");
        $sheet->setCellValue("A$row", "Rencana Penarikan Dana Per Triwulan :");
        $sheet->getStyle("A$row")->applyFromArray($bold);
        $bts = $row + 9; //batas akhir border
        $sheet->getStyle("A$row:T$bts")->applyFromArray($boderUniv);
        $row++;
        for ($i = 1; $i < 5; $i++) {
            //triwulan 1-4
            $sheet->mergeCells("A$row:B$row");
            $sheet->setCellValue("A$row", "Triwulan $i");
            $sheet->setCellValue("C$row", "Rp");
            $sheet->mergeCells("D$row:F$row");
            $sheet->setCellValue("D$row", number_format((double)@$data_triwulan['T' . $i][0]->triwulan, 0, ",", ","));
            $sheet->getStyle("D$row:F$row")->getAlignment()
                ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
            $row++;
        }
        $row--;
        $sheet->setCellValue("G$row", "+");
        $row++;
        //jumlah
        $sheet->mergeCells("A$row:B$row");
        $sheet->getStyle("A$row")->applyFromArray($bold);//style bold "Jumlah"
        $sheet->setCellValue("A$row", "Jumlah");
        $sheet->setCellValue("C$row", "Rp");
        $sheet->getStyle("C$row")->applyFromArray($bold); //style bold "Rp"
        $sheet->mergeCells("D$row:F$row");
        $sheet->setCellValue("D$row", number_format((double)@$data_kegiatan[0]->total_rekening, 0, ",", ","));
        $sheet->getStyle("D$row:F$row")->applyFromArray($jumlah);
        //nama siswa & nis
        $row++;
        $sheet->mergeCells("O$row:T$row");
        $sheet->setCellValue("O$row", @$data_siswa[0]->nama); //data siswa
        $sheet->getStyle("O$row")->applyFromArray(array('font' => array('bold' => true, 'underline' => 'single'))); //style bold & italic siswa
        $sheet->getStyle("O$row:T$row")->getAlignment()
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $row++;
        $sheet->mergeCells("O$row:T$row");
        $sheet->setCellValue("O$row", @$data_siswa[0]->nis);// data nis siswa
        $sheet->getStyle("O$row:T$row")->getAlignment()
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //tanggal & tanda tangan
        $row = $row - 6;
        $date = date("d F Y");
        $sheet->mergeCells("O$row:T$row");
        $sheet->setCellValue("O$row", "Sidoarjo, $date"); // data tempat & tanggal
        $sheet->getStyle("O$row:T$row")->getAlignment()
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Laporan_pencapaian.xlsx"');
        header('Cache-Control: max-age=0');

        // Save it as an sheet 2003 file
        $objWriter = IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        exit();

    }
    
}