<?php

defined('BASEPATH')or exit('ERROR');

class Export_excel extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library("DataExcel");
    }

    public function RKA($kodeInstansi, $kodeProgram, $kodeKegiatan)
    {
        $date = date("Y");
        $data_instansi = $this->dataexcel->getDataInstansi($kodeInstansi, $kodeProgram, $kodeKegiatan);
        $data_program = $this->dataexcel->getDataProgram($kodeInstansi, $kodeProgram);
        $data_kegiatan = $this->dataexcel->getDataKegiatan($kodeInstansi, $kodeProgram, $kodeKegiatan);
        $data_indikator = $this->dataexcel->getDataIndikator($kodeInstansi, $kodeProgram);
        $data_triwulan = $this->dataexcel->getDataTriwulan($kodeInstansi, $kodeProgram, $kodeKegiatan);
        $data_siswa = $this->dataexcel->getDataSiswa($kodeInstansi, $kodeProgram);

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

        $sheet->getPageSetup()
            ->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        $sheet->getPageSetup()
            ->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);

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

        $row = 27; //untuk mengatur cell posisi data
        $sheet->mergeCells("D26:J26");
        $sheet->setCellValue("D26", "BELANJA LANGSUNG"); //data kode rekening & detail [Khusus]
        $sheet->mergeCells("R26:T26");
        $sheet->setCellValue("R26", number_format((double)$data_kegiatan[0]->total_rinci, 0, ",", ",")); //data jumlah rekening & detail [Khusus]
        $sheet->getStyle("R26:T26")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //rigth data jumlah

        //looping data rincian rencana kerja
        $data_rekening = $this->db->select('kode_rekening,uraian_rekening,total,total_rinci')->from("tb_rekening")
                ->where("kode_instansi", $kodeInstansi)
                ->where("kode_program", $kodeProgram)
                ->where("kode_kegiatan", $kodeKegiatan)
                ->order_by("kode_rekening", "ASC")
                ->get()->result();
        foreach ($data_rekening as $rekening) {
            //data kode rekening & detail
            $sheet->mergeCells("A$row:C$row");
            $sheet->getStyle("A$row:C$row")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); //left data kode
            $sheet->getStyle("A$row:C$row")->applyFromArray($bold); 
            $sheet->setCellValue("A" . $row, $rekening->kode_rekening);
            
            //data uraian
            $sheet->mergeCells("D$row:J$row");
            $sheet->getStyle("D$row:J$row")->applyFromArray($bold); 
            $sheet->setCellValue("D" . $row, $rekening->uraian_rekening);

            //data jumlah rekening & detail
            $sheet->mergeCells("R$row:T$row");
            $sheet->getStyle("R$row:T$row")->applyFromArray($bold);
            $sheet->getStyle("R$row:T$row")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //rigth data jumlah
            $sheet->setCellValue("R" . $row, $rekening->total_rinci); 
            $row++;
            //Data detail rekening            
            $detailRekening = $this->db->select("kode_detail_rekening,uraian,volume,satuan,harga,total")->from("tb_detail_rekening")
                    ->where("kode_instansi", $kodeInstansi)
                    ->where("kode_program", $kodeProgram)
                    ->where("kode_kegiatan", $kodeKegiatan)
                    ->where("kode_rekening", $rekening->kode_rekening)
                    ->get()->result();
            foreach ($detailRekening as $detail) {
                //data kode rekening & detail
                $sheet->mergeCells("A$row:C$row");
                $sheet->getStyle("A$row:C$row")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); //left data kode
                $sheet->getStyle("A$row:C$row")->applyFromArray($bold); 
                $sheet->setCellValue("A" . $row, $detail->kode_detail_rekening);
                
                //data Uraian
                $sheet->mergeCells("D$row:J$row");
                $sheet->getStyle("D$row:J$row")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); //left data kode
                $sheet->setCellValue("D" . $row, $detail->uraian);

                //data Volume
                $sheet->mergeCells("K$row:L$row");
                $sheet->getStyle("K$row:L$row")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //left data kode
                $sheet->setCellValue("K" . $row, $detail->volume);

                //data kode Satuan
                $sheet->mergeCells("M$row:N$row");
                $sheet->getStyle("M$row:N$row")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); //left data kode
                $sheet->setCellValue("M" . $row, $detail->satuan);

                //data Harga Satuan
                $sheet->mergeCells("O$row:Q$row");
                $sheet->getStyle("O$row:Q$row")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //left data kode
                $sheet->setCellValue("O" . $row, $detail->harga);

                //data kode rekening & detail
                $sheet->mergeCells("R$row:T$row");
                $sheet->getStyle("R$row:T$row")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); //left data kode
                $sheet->setCellValue("R" . $row, $detail->total);
                $row++;
            }
            $row = $row+2;
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
        $sheet->setCellValue("O$row", $data_instansi[0]->kota_lokasi.", ".$date); // data tempat & tanggal
        $sheet->getStyle("O$row:T$row")->getAlignment()
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Laporan '.$data_siswa[0]->nama.'.xlsx"');
        header('Cache-Control: max-age=0');

        // Save it as an sheet 2003 file
        $objWriter = IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        exit();
    }

    public function AKB($kodeInstansi,$kodeProgram)
    {
        $data_instansi = $this->dataexcel->getDataInstansi($kodeInstansi);
        $data_program = $this->dataexcel->getDataProgram($kodeInstansi, $kodeProgram);
        $data_siswa = $this->dataexcel->getDataSiswa($kodeInstansi, $kodeProgram);


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

        $sheet->getPageSetup()
            ->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        $sheet->getPageSetup()
            ->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_LEGAL);
        
        //Header
        $sheet->mergeCells("G1:J1");
        $sheet->mergeCells("G2:J2");
        $sheet->mergeCells("G3:J3");
        //Header - Data
        $sheet->SetCellValue("G1", "MUSTIKA GRAHA DE ENAM");
        $sheet->getStyle("G1:J1")->applyFromArray($bold);
        $sheet->SetCellValue("G2", "ANGGARAN KAS BELANJA");
        $sheet->getStyle("G2:J2")->applyFromArray($bold);
        $sheet->SetCellValue("G3", date("Y"));
        $sheet->getStyle("G3:J3")->applyFromArray($bold);

        //Header - Style
        $sheet->getStyle('G1:J1')->getAlignment()
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $sheet->getStyle('G2:J2')->getAlignment()
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $sheet->getStyle('G3:J3')->getAlignment()
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        //End Header

        //Keterangan Siswa
        $sheet->mergeCells("B5:C5");
        $sheet->mergeCells("B6:C6");
        $sheet->mergeCells("B7:C7");
        $sheet->getColumnDimension("D")->setWidth("3");
        //Nama Siswa
        $sheet->setCellValue("B5","Nama Siswa");
        $sheet->setCellValue("D5",":");
        $sheet->setCellValue("E5", $data_siswa[0]->nama);
        //Program
        $sheet->setCellValue("B6", "PROGRAM");
        $sheet->setCellValue("D6", ":");
        $sheet->SetCellValue("E6", $data_program[0]->nama_program);
        //Sekolah
        $sheet->setCellValue("B7", "Sekolah");
        $sheet->setCellValue("D7", ":");
        $sheet->setCellValue("E7", $data_instansi[0]->nama_instansi);
        //End Keterangan Siswa

        //Table AKB
        $sheet->mergeCells("A9:B9");
        $sheet->mergeCells("C9:G9");
        $sheet->mergeCells("H9:I9");
        $sheet->mergeCells("J9:K9");
        $sheet->mergeCells("L9:M9");
        $sheet->mergeCells("N9:O9");
        $sheet->mergeCells("P9:Q9");
        $sheet->mergeCells("A10:B10");
        $sheet->mergeCells("C10:G10");
        $sheet->mergeCells("H10:I10");
        $sheet->mergeCells("J10:K10");
        $sheet->mergeCells("L10:M10");
        $sheet->mergeCells("N10:O10");
        $sheet->mergeCells("P10:Q10");
        $sheet->getColumnDimension("I")->setWidth("10");
        //Style Header
        $sheet->getStyle('A9:B9')->getAlignment()
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $sheet->getStyle('A9:B9')->applyFromArray($boderHeader);
        $sheet->getStyle('C9:G9')->getAlignment()
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $sheet->getStyle('C9:G9')->applyFromArray($boderHeader);
        $sheet->getStyle('H9:I9')->getAlignment()
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $sheet->getStyle('H9:I9')->applyFromArray($boderHeader);
        $sheet->getStyle('J9:K9')->getAlignment()
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $sheet->getStyle('J9:K9')->applyFromArray($boderHeader);
        $sheet->getStyle('L9:M9')->getAlignment()
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $sheet->getStyle('L9:M9')->applyFromArray($boderHeader);
        $sheet->getStyle('N9:O9')->getAlignment()
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $sheet->getStyle('N9:O9')->applyFromArray($boderHeader);
        $sheet->getStyle('P9:Q9')->getAlignment()
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $sheet->getStyle('P9:Q9')->applyFromArray($boderHeader);
        //Style Type
        $sheet->getStyle('A10:B10')->getAlignment()
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $sheet->getStyle('A10:B10')->applyFromArray($boderUniv);
        $sheet->getStyle('C10:G10')->getAlignment()
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $sheet->getStyle('C10:G10')->applyFromArray($boderUniv);
        $sheet->getStyle('H10:I10')->getAlignment()
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $sheet->getStyle('H10:I10')->applyFromArray($boderUniv);
        $sheet->getStyle('J10:K10')->getAlignment()
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $sheet->getStyle('J10:K10')->applyFromArray($boderUniv);
        $sheet->getStyle('L10:M10')->getAlignment()
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $sheet->getStyle('L10:M10')->applyFromArray($boderUniv);
        $sheet->getStyle('N10:O10')->getAlignment()
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $sheet->getStyle('N10:O10')->applyFromArray($boderUniv);
        $sheet->getStyle('P10:Q10')->getAlignment()
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $sheet->getStyle('P10:Q10')->applyFromArray($boderUniv);
        //Header Table
        $sheet->setCellValue("A9","Kode Rekening");
        $sheet->setCellValue("C9","Uraian");
        $sheet->setCellValue("H9","Anggaran Tahun Ini");
        $sheet->setCellValue("J9","Triwulan I");
        $sheet->setCellValue("L9","Triwulan II");
        $sheet->setCellValue("N9","Triwulan III");
        $sheet->setCellValue("P9","Triwulan IV");
        //Data Type
        $sheet->setCellValue("A10","1");
        $sheet->setCellValue("C10","2");
        $sheet->setCellValue("H10","3");
        $sheet->setCellValue("J10","Rp");
        $sheet->setCellValue("L10","Rp");
        $sheet->setCellValue("N10","Rp");
        $sheet->setCellValue("P10","Rp");
        //Data Table
        $dataTableKegiatan = $this->db->query("
        SELECT tb_kegiatan.kode_kegiatan,tb_kegiatan.nama_kegiatan,tb_kegiatan.total_rinci,
        (SELECT SUM(tb_rekening.triwulan_1) FROM tb_rekening WHERE tb_rekening.kode_instansi = tb_kegiatan.kode_instansi AND tb_rekening.kode_program = tb_kegiatan.kode_program AND tb_rekening.kode_kegiatan = tb_kegiatan.kode_kegiatan) AS T1,
        (SELECT SUM(tb_rekening.triwulan_2) FROM tb_rekening WHERE tb_rekening.kode_instansi = tb_kegiatan.kode_instansi AND tb_rekening.kode_program = tb_kegiatan.kode_program AND tb_rekening.kode_kegiatan = tb_kegiatan.kode_kegiatan) AS T2,
        (SELECT SUM(tb_rekening.triwulan_3) FROM tb_rekening WHERE tb_rekening.kode_instansi = tb_kegiatan.kode_instansi AND tb_rekening.kode_program = tb_kegiatan.kode_program AND tb_rekening.kode_kegiatan = tb_kegiatan.kode_kegiatan) AS T3,
        (SELECT SUM(tb_rekening.triwulan_4) FROM tb_rekening WHERE tb_rekening.kode_instansi = tb_kegiatan.kode_instansi AND tb_rekening.kode_program = tb_kegiatan.kode_program AND tb_rekening.kode_kegiatan = tb_kegiatan.kode_kegiatan) AS T4
        FROM `tb_kegiatan` WHERE tb_kegiatan.kode_instansi = $kodeInstansi AND tb_kegiatan.kode_program = $kodeProgram")->result();
        $row = 11;
        foreach ($dataTableKegiatan as $kegiatan) {
            $sheet->mergeCells("A$row:B$row");
            $sheet->getStyle("A$row:B$row")->applyFromArray($boderHeader);
            $sheet->setCellValue("A$row",@$kegiatan->kode_kegiatan);
            $sheet->mergeCells("C$row:G$row");
            $sheet->getStyle("C$row:G$row")->applyFromArray($boderHeader);
            $sheet->setCellValue("C$row",@$kegiatan->nama_kegiatan);
            $sheet->mergeCells("H$row:I$row");
            $sheet->getStyle("H$row:I$row")->applyFromArray($boderHeader);
            $sheet->setCellValue("H$row",@$kegiatan->total_rinci);
            $sheet->mergeCells("J$row:K$row");
            $sheet->getStyle("J$row:K$row")->applyFromArray($boderHeader);
            $sheet->setCellValue("J$row",@$kegiatan->T1);
            $sheet->mergeCells("L$row:M$row");
            $sheet->getStyle("L$row:M$row")->applyFromArray($boderHeader);
            $sheet->setCellValue("L$row",@$kegiatan->T2);
            $sheet->mergeCells("N$row:O$row");
            $sheet->getStyle("N$row:O$row")->applyFromArray($boderHeader);
            $sheet->setCellValue("N$row",@$kegiatan->T4);
            $sheet->mergeCells("P$row:Q$row");
            $sheet->getStyle("P$row:Q$row")->applyFromArray($boderHeader);
            $sheet->setCellValue("P$row",@$kegiatan->T4);
            $dataTableRekening = $this->db->query("
            SELECT tb_rekening.kode_patokan,tb_rekening.kode_rekening,tb_patokan_rekening.nama,SUM(tb_rekening.total_rinci) AS total_rinci,
            SUM(tb_rekening.triwulan_1) AS T1,SUM(tb_rekening.triwulan_2) AS T2,
            SUM(tb_rekening.triwulan_3) AS T3,SUM(tb_rekening.triwulan_4) AS T4
            FROM tb_rekening INNER JOIN tb_patokan_rekening ON tb_patokan_rekening.kode_patokan = tb_rekening.kode_patokan
            WHERE tb_rekening.kode_instansi = $kodeInstansi AND tb_rekening.kode_program = $kodeProgram AND tb_rekening.kode_kegiatan = $kegiatan->kode_kegiatan
            GROUP BY tb_rekening.kode_patokan")->result();
            $row++;
            foreach ($dataTableRekening as $rekening) {
                $sheet->mergeCells("A$row:B$row");
                $sheet->getStyle("A$row:B$row")->applyFromArray($boderUniv);
                $sheet->setCellValue("A$row",@$rekening->kode_patokan."  |  ".@$rekening->kode_rekening);
                $sheet->mergeCells("C$row:G$row");
                $sheet->getStyle("C$row:G$row")->applyFromArray($boderUniv);
                $sheet->setCellValue("C$row",$rekening->nama);
                $sheet->mergeCells("H$row:I$row");
                $sheet->getStyle("H$row:I$row")->applyFromArray($boderUniv);
                $sheet->setCellValue("H$row",$rekening->total_rinci);
                $sheet->mergeCells("J$row:K$row");
                $sheet->getStyle("J$row:K$row")->applyFromArray($boderUniv);
                $sheet->setCellValue("J$row",$rekening->T1);
                $sheet->mergeCells("L$row:M$row");
                $sheet->getStyle("L$row:M$row")->applyFromArray($boderUniv);
                $sheet->setCellValue("L$row",$rekening->T2);
                $sheet->mergeCells("N$row:O$row");
                $sheet->getStyle("N$row:O$row")->applyFromArray($boderUniv);
                $sheet->setCellValue("N$row",$rekening->T4);
                $sheet->mergeCells("P$row:Q$row");
                $sheet->getStyle("P$row:Q$row")->applyFromArray($boderUniv);
                $sheet->setCellValue("P$row",$rekening->T4);
                $row++;
            }
        }
        //End Data Table

        //Tempat, Tanggal
        $row++;
        $sheet->mergeCells("N$row:P$row");
        $sheet->getStyle("N$row:P$row")->getAlignment()
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $date = date("d F Y");
        $sheet->setCellValue("N$row", $data_instansi[0]->kota_lokasi.", ".$date);
        //Nama Instansi
        $row++;
        $sheet->mergeCells("N$row:P$row");
        $sheet->getStyle("N$row:P$row")->getAlignment()
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $sheet->setCellValue("N$row", $data_instansi[0]->nama_instansi);
        //Nama Siswa
        $row = $row+4; 
        $sheet->mergeCells("N$row:P$row");
        $sheet->getStyle("N$row:P$row")->getAlignment()
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $sheet->setCellValue("N$row", $data_siswa[0]->nama);
        $sheet->getStyle("N$row")->applyFromArray(array('font' => array('bold' => true, 'underline' => 'single'))); //style bold & italic siswa
        //NIS
        $row++;
        $sheet->mergeCells("N$row:P$row");
        $sheet->getStyle("N$row:P$row")->getAlignment()
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $sheet->setCellValue("N$row", $data_siswa[0]->nis);



        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Anggaran Kas Belanja '.$data_siswa[0]->nama.'.xlsx"');
        header('Cache-Control: max-age=0');

        // Save it as an sheet 2003 file
        $objWriter = IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        exit();
    }
    
}