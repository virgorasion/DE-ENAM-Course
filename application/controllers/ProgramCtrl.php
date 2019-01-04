<?php 

defined('BASEPATH')or exit('ERROR');

class ProgramCtrl extends CI_controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('ProgramModel');
        $this->load->library('datatables');
        //library untuk semua data ExportExcel
        $this->load->library("DataExcel");
    }

    public function index($kodeInstansi)
    {
        if ($_SESSION['username'] != null) {
            $data['kode'] = $kodeInstansi;
            $data['patokan'] = $this->ProgramModel->getPatokan();
            $data['data'] = $this->ProgramModel->DataProgram($kodeInstansi)->result();
            $this->load->view('v_programDetails', $data);
        } else {
            redirect('Auth');
        }
    }

    public function export_excel($kodeInstansi = "010.03",$kodeProgram = "127.01",$kodeKegiatan = "080.01")
    {
        $data['kodeInstansi'] = $kodeInstansi;
        $data['kodeProgram'] = $kodeProgram;
        $data['kodeKegiatan'] = $kodeKegiatan;
        $data['data_uraian'] = $this->dataexcel->getDataUraian($kodeInstansi, $kodeProgram, $kodeKegiatan);
        $data['data_kode'] = $this->dataexcel->getDataKode($kodeInstansi, $kodeProgram, $kodeKegiatan);
        $data['data_volume'] = $this->dataexcel->getDataVolume($kodeInstansi, $kodeProgram, $kodeKegiatan);
        $data['data_satuan'] = $this->dataexcel->getDataSatuan($kodeInstansi, $kodeProgram, $kodeKegiatan);
        $data['data_harga'] = $this->dataexcel->getDataHarga($kodeInstansi, $kodeProgram, $kodeKegiatan);
        $data['data_jumlah'] = $this->dataexcel->getDataJumlah($kodeInstansi, $kodeProgram, $kodeKegiatan);
        $data['data_instansi'] = $this->dataexcel->getDataInstansi($kodeInstansi, $kodeProgram, $kodeKegiatan);
        $data['data_program'] = $this->dataexcel->getDataProgram($kodeInstansi, $kodeProgram);
        $data['data_kegiatan'] = $this->dataexcel->getDataKegiatan($kodeInstansi, $kodeProgram, $kodeKegiatan);
        $data['data_indikator'] = $this->dataexcel->getDataIndikator($kodeInstansi, $kodeProgram);
        $data['data_triwulan'] = $this->dataexcel->getDataTriwulan($kodeInstansi, $kodeProgram, $kodeKegiatan);
        $data['data_siswa'] = $this->dataexcel->getDataSiswa($kodeInstansi, $kodeProgram);
        $this->load->view("export_excel",$data);
    }
    
    public function view_export($kodeInstansi, $kodeProgram, $kodeKegiatan)
    {
        $data['kodeInstansi'] = $kodeInstansi;
        $data['kodeProgram'] = $kodeProgram;
        $data['kodeKegiatan'] = $kodeKegiatan;
        $data['data_uraian'] = $this->dataexcel->getDataUraian($kodeInstansi, $kodeProgram, $kodeKegiatan);
        $data['data_kode'] = $this->dataexcel->getDataKode($kodeInstansi, $kodeProgram, $kodeKegiatan);
        $data['data_volume'] = $this->dataexcel->getDataVolume($kodeInstansi, $kodeProgram, $kodeKegiatan);
        $data['data_satuan'] = $this->dataexcel->getDataSatuan($kodeInstansi, $kodeProgram, $kodeKegiatan);
        $data['data_harga'] = $this->dataexcel->getDataHarga($kodeInstansi, $kodeProgram, $kodeKegiatan);
        $data['data_jumlah'] = $this->dataexcel->getDataJumlah($kodeInstansi, $kodeProgram, $kodeKegiatan);
        $data['data_instansi'] = $this->dataexcel->getDataInstansi($kodeInstansi, $kodeProgram, $kodeKegiatan);
        $data['data_program'] = $this->dataexcel->getDataProgram($kodeInstansi, $kodeProgram);
        $data['data_kegiatan'] = $this->dataexcel->getDataKegiatan($kodeInstansi, $kodeProgram,$kodeKegiatan);
        $data['data_indikator'] = $this->dataexcel->getDataIndikator($kodeInstansi, $kodeProgram);
        $data['data_triwulan'] = $this->dataexcel->getDataTriwulan($kodeInstansi,$kodeProgram,$kodeKegiatan);
        $data['data_siswa'] = $this->dataexcel->getDataSiswa($kodeInstansi,$kodeProgram);

        $this->load->view("export_excel", $data);
    }

    public function phpexcel($kodeInstansi = "010.03", $kodeProgram = "127.01", $kodeKegiatan = "080.01")
    {
        $date = date("Y");
        $kodeInstansi = $kodeInstansi;
        $kodeProgram = $kodeProgram;
        $kodeKegiatan = $kodeKegiatan;
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
        // echo $uraianLenght;
        // $encode = json_encode($data_uraian);
        // echo $encode;
        // $json = json_decode($encode);
        // var_dump($json);
        // $row = 26;
        // for ($array = 0; $array < $uraianLenght; $array++) {
        //     echo $row. " ".$data_kode[$array]." ## ";
        //     echo $row. " ".$data_uraian[$array]." ## ";
        //     echo $row. " ".$data_volume[$array]." ## ";
        //     echo $row. " ".$data_satuan[$array]." ## ";
        //     echo $row. " ".$data_harga[$array]." ## ";
        //     echo $row. " ".$data_jumlah[$array]." ## ";
        //     echo "<br>";
        //     $row++;
        // }
        // die();
                
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
        $sheet->setCellValue("A14", "Indikator & Tolok Ukur Kinerja Belanja Langsung");
        $sheet->getStyle("A14:T14")->applyFromArray($boderUniv);
        $sheet->getStyle("A15:C15")->applyFromArray($boderUniv);
        $sheet->getStyle("D15:M15")->applyFromArray($boderUniv);
        $sheet->getStyle("N15:P15")->applyFromArray($boderUniv);
        $sheet->getStyle("Q15:T15")->applyFromArray($boderUniv);
        $sheet->setCellValue("A15", "Indikator");
        $sheet->setCellValue("D15", "Uraian");
        $sheet->setCellValue("N15", "Nilai");
        $sheet->setCellValue("Q15", "Satuan");

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
        $sheet->setCellValue("A17", "Masukan");
        $masukan1 = (@$data_indikator['masukan'][0]['uraian'] != null) ? $data_indikator['masukan'][0]['uraian'] : "";
        $sheet->setCellValue("D17", $masukan1);
        $masukan2 = (@$data_indikator['masukan'][0]['target'] != null) ? $data_indikator['masukan'][0]['target'] : "";
        $sheet->setCellValue("N17", $masukan2);
        $masukan3 = (@$data_indikator['masukan'][0]['satuan'] != null) ? $data_indikator['masukan'][0]['satuan'] : "";
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
        $sheet->setCellValue("A20", "Kelompok Sasaran Kegiatan : " . $data_program[0]->sasaran);
//END content sasaran kegiatan

//content rincian rencana kerja
        $sheet->mergeCells("A21:T22");
        $sheet->getStyle('A21:T22')->getAlignment()->setWrapText(true)
            ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
        $sheet->setCellValue("A21", "Rincian Rencana Kerja dan Anggaran\nProgram dan Per Kegiatan Satuan Kerja Perangakat Daerah");
        $sheet->getStyle("A21:T22")->applyFromArray($boderHeader);

        $sheet->setCellValue("A23", "Kode Rekening");
        $sheet->getStyle("A23:C24")->applyFromArray($boderHeader);
        $sheet->mergeCells("A23:C23");
        $sheet->setCellValue("D23", "Uraian");
        $sheet->getStyle("D23:J24")->applyFromArray($boderHeader);
        $sheet->mergeCells("D23:J23");
        $sheet->getStyle("K23:Q24")->applyFromArray($boderHeader);
        $sheet->setCellValue("K23", "Rincian Perhitungan");
        $sheet->mergeCells("K23:Q23");
        $sheet->getStyle("K24:L24")->applyFromArray($boderHeader);
        $sheet->setCellValue("K24", "Volume");
        $sheet->getStyle("M24:N24")->applyFromArray($boderHeader);
        $sheet->setCellValue("M24", "Satuan");
        $sheet->getStyle("O24:Q24")->applyFromArray($boderHeader);
        $sheet->setCellValue("O24", "Harga Satuan");
        $sheet->getStyle("R23:T24")->applyFromArray($boderHeader);
        $sheet->setCellValue("R23", "Jumlah");
        $sheet->setCellValue("R24", "(RP)");
        $sheet->getStyle("A25:C25")->applyFromArray($boderHeader);
        $sheet->setCellValue("A25", "1");
        $sheet->getStyle("D25:J25")->applyFromArray($boderHeader);
        $sheet->setCellValue("D25", "2");
        $sheet->getStyle("K25:L25")->applyFromArray($boderHeader);
        $sheet->setCellValue("K25", "3");
        $sheet->getStyle("M25:N25")->applyFromArray($boderHeader);
        $sheet->setCellValue("M25", "4");
        $sheet->getStyle("O25:Q25")->applyFromArray($boderHeader);
        $sheet->setCellValue("O25", "5");
        $sheet->getStyle("R25:T25")->applyFromArray($boderHeader);
        $sheet->setCellValue("R25", "6");

        $row = 26;
        for ($array = 0; $array < $uraianLenght; $array++) {
            $sheet->setCellValue("A" . $row, $data_kode[$array]);
            $sheet->setCellValue("D" . $row, $data_uraian[$array]);
            $sheet->setCellValue("K" . $row, $data_volume[$array]);
            $sheet->setCellValue("M" . $row, $data_satuan[$array]);
            $sheet->setCellValue("O" . $row, $data_harga[$array]);
            $sheet->setCellValue("R" . $row, $data_jumlah[$array]);
            $row++;
        }
        $row = $row-2;
        $sheet->getStyle("A26:C$row")->applyFromArray($boderHeader);
        $sheet->getStyle("D26:J$row")->applyFromArray($boderHeader);
        $sheet->getStyle("K26:L$row")->applyFromArray($boderHeader);
        $sheet->getStyle("M26:N$row")->applyFromArray($boderHeader);
        $sheet->getStyle("O26:Q$row")->applyFromArray($boderHeader);
        $sheet->getStyle("R26:T$row")->applyFromArray($boderHeader);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Laporan_pencapaian.xlsx"');
        header('Cache-Control: max-age=0');

        // Save it as an sheet 2003 file
        $objWriter = IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        exit();

    }
    
    public function TableSiswaCetakAPI($hakAkses, $kodeInstansi)
    {
        header("Content-Type: application/json");
        echo $this->ProgramModel->getDataSiswaCetak($hakAkses, $kodeInstansi);
    }
    public function TableKegiatanCetakAPI($kodeInstansi, $kodeProgram)
    {
        header("Content-Type: application/json");
        echo $this->ProgramModel->getDataKegiatanCetak($kodeInstansi, $kodeProgram);
    }

    public function TambahProgram()
    {
        $kode = $this->input->post('addKodeProgram');
        $kodeProgram = str_replace(" ", "", $this->GenerateKodeProgram($kode));
        $namaProgram = $this->input->post('addNamaProgram');
        $jenisProgram = $this->input->post('addJenisProgram');
        $uraianProgram = $this->input->post('addUraianProgram');
        $sasaranProgram = $this->input->post('addSasaranProgram');
        $plafon = str_replace(".", "", $this->input->post('addPlafon'));
        $idInstansi = $this->input->post('idInstansi');
        if ($_SESSION['akses'] == 'Admin') {
            $data = array(
                'kode_admin' => $_SESSION['kode_admin'],
                'kode_instansi' => $idInstansi,
                'kode_program' => $kodeProgram,
                'jenis' => $jenisProgram,
                'uraian' => $uraianProgram,
                'sasaran' => $sasaranProgram,
                'nama_program' => $namaProgram,
                'plafon' => $plafon
            );
        } else {
            $data = array(
                'kode_admin' => 0,
                'kode_instansi' => $idInstansi,
                'kode_program' => $kodeProgram,
                'nama_program' => $namaProgram,
                'jenis' => $jenisProgram,
                'uraian' => $uraianProgram,
                'sasaran' => $sasaranProgram,
                'nama_program' => $namaProgram,
                'plafon' => $plafon
            );
        }

        $this->ProgramModel->ActionInsert('tb_program', $data);
        $this->session->set_flashdata('msg', 'Berhasil Menambahkan Program');
        redirect('ProgramCtrl/index/' . $idInstansi);
    }

    public function EditProgram()
    {
        $post = $this->input->post();
        $kodeProgram = "127." . str_replace(" ", "", $post['editKodeProgram']);
        if ($_SESSION['akses'] == 'Admin') {
            $data = array(
                'kode_program' => $kodeProgram,
                'nama_program' => $post['editNamaProgram'],
                'jenis' => $post['editJenisProgram'],
                'uraian' => $post['editUraianProgram'],
                'sasaran' => $post['editSasaranProgram'],
                'plafon' => str_replace(".", "", $post['editPlafon']),
                'kode_instansi' => $post['idInstansiEdit']
            );
        } else {
            $data = array(
                'kode_admin' => $_SESSION['kode_admin'],
                'kode_program' => $kodeProgram,
                'nama_program' => $post['editNamaProgram'],
                'jenis' => $post['editJenisProgram'],
                'uraian' => $post['editUraianProgram'],
                'sasaran' => $post['editSasaranProgram'],
                'plafon' => str_replace(".", "", $post['editPlafon']),
                'kode_instansi' => $post['idInstansiEdit']
            );
        }
        $kodeInstansi = $post['idInstansiEdit'];
        $id = $post['programIdEdit'];
        $query = $this->ProgramModel->updateDataProgram('tb_program', $data, $id);
        if ($query != 0) {
            $this->session->set_flashdata('succ', 'Berhasil edit data program');
            redirect('ProgramCtrl/index/' . $kodeInstansi);
        } else {
            $this->session->set_flashdata('fail', 'Gagal edit data, segera hubungi admin');
            redirect('ProgramCtrl/index/' . $kodeInstansi);
        }
    }

    public function DataEditProgramInstansi($id)
    {
        $query = $this->ProgramModel->APIDataEditProgramInstansi('tb_program', $id)->result();

        echo json_encode($query);
    }

    public function Hapus($idProgram, $idInstansi)
    {
        $query = $this->ProgramModel->DeleteProgram('tb_program', $idProgram);
        if ($query == true) {
            $this->session->set_flashdata('msg', "Program berhasil dihapus");
            redirect('ProgramCtrl/index/' . $idInstansi);
        } else {
            $this->session->set_flashdata('msg', "Program gagal dihapus segera hubungi admin");
            redirect('ProgramCtrl/index/' . $idInstansi);
        }
    }

    private function GenerateKodeProgram($id)
    {
        $kode = "127.";
        $keygen = $kode . $id;
        return $keygen;
    }

    //==============================================================================>>
    // Coding untuk Box Kegiatan

    //Datatable Kegiatan
    public function DataTableApi($kodeInstansi, $kodeProgram)
    {
        header('Content-Type: application/json');
        echo $this->ProgramModel->getDataKegiatan($kodeInstansi, $kodeProgram);
    }
    
    //Datatable Indikator
    public function tableIndikatorAPI($kodeInstansi, $kodeProgram)
    {
        header("Content-Type: application/json");
        echo $this->ProgramModel->getDataIndikator($kodeInstansi, $kodeProgram);
    }

    public function tablePenanggungJawabAPI($idSiswa)
    {
        $json = $this->ProgramModel->getDataPenanggungJawab($idSiswa);
        echo json_encode($json);
    }
    //Datatable Pembahasan
    public function tablePembahasanAPI($kodeInstansi, $kodeProgram)
    {
        header("Content-Type: application/json");
        echo $this->ProgramModel->getDataPembahasan($kodeInstansi, $kodeProgram);
    }
    
    //Get data ketika klik btn tambah pembahasan
    public function GetDataInsertPembahasanSatu($kode, $kodeInstansi, $kodeProgram)
    {
        $query = $this->ProgramModel->getDataInsert($kode, $kodeInstansi, $kodeProgram);
        echo json_encode($query);
    }
    //Get data ketika ubah select kegiatan
    public function GetDataInsertPembahasanDua($kode, $kodeInstansi, $kodeProgram)
    {
        $query = $this->ProgramModel->getDataInsert($kode, $kodeInstansi, $kodeProgram);
        echo json_encode($query);
    }
    //get data total_rekening setelah select kegiatan
    public function GetDataInsertPembahasanTiga($kode, $kodeInstansi, $kodeProgram, $kodeKegiatan)
    {
        $query = $this->ProgramModel->getDataInsert($kode, $kodeInstansi, $kodeProgram, $kodeKegiatan);
        echo json_encode($query);
    }
    //get data NamaRekening setelah select kegiatan
    public function GetDataInsertPembahasanEmpat($kode, $kodeInstansi, $kodeProgram, $kodeKegiatan)
    {
        $query = $this->ProgramModel->getDataInsert($kode, $kodeInstansi, $kodeProgram, $kodeKegiatan);
        echo json_encode($query);
    }
    //get data Triwulan setelah select rekening
    public function GetDataInsertPembahasanLima($kode, $kodeInstansi, $kodeProgram, $kodeKegiatan, $kodeRekening)
    {
        $query = $this->ProgramModel->getDataInsert($kode, $kodeInstansi, $kodeProgram, $kodeKegiatan, $kodeRekening);
        echo json_encode($query);
    }

    public function GetDataInfoKegiatan($kodeInstansi, $kodeProgram)
    {
        $query = $this->ProgramModel->getDataInfoKegiatan($kodeInstansi, $kodeProgram);
        echo json_encode($query);
    }


    public function TambahKegiatan()
    {
        $post = $this->input->post();
        $kodeKegiatan = str_replace(" ", "", $this->generateKodeKegiatan($post['addKodeKegiatan']));
        $data = array(
            'kode_instansi' => $post['kodeInstansi'],
            'kode_program' => $post['kodeProgram'],
            'kode_kegiatan' => $kodeKegiatan,
            'nama_kegiatan' => $post['addNamaKegiatan'],
            'keterangan' => $post['addKeterangan']
        );
        $query = $this->ProgramModel->ActionInsert('tb_kegiatan', $data);
        $kodeInstansi = $post['kodeInstansi'];
        $kodeProgram = $post['kodeProgram'];

        if ($query != null) {
            $this->session->set_flashdata('msgKegiatan', 'Berhasil menambah kegiatan');
            $this->session->set_flashdata('kodeProgram', $kodeProgram);
            redirect('ProgramCtrl/index/' . $kodeInstansi);
        } else {
            $this->session->set_flashdata('msgKegiatan', 'Gagal menambah kegiatan, segera hubungi admin');
            $this->session->set_flashdata('kodeProgram', $kodeProgram);
            redirect('ProgramCtrl/index/' . $kodeInstansi);
        }
    }

    public function ActionIndikator()
    {
        $p = $this->input->post();
        $kodeInstansi = $p['KodeInstansiIndikator'];
        $kodeProgram = $p['KodeProgramIndikator'];
        $MainID = $p['MainIdIndikator'];
        if ($p['actionTypeIndikator'] == "add") {
            $kode = $this->generateKodeIndikator($kodeInstansi, $kodeProgram);
            $data = array(
                'kode_indikator' => $kode,
                'kode_instansi' => $kodeInstansi,
                'kode_program' => $kodeProgram,
                'jenis' => $p['addJenisIndikator'],
                'uraian' => $p['addUraianIndikator'],
                'satuan' => $p['addSatuanIndikator'],
                'target' => $p['addTarget']
            );
            $query = $this->ProgramModel->ActionInsert("tb_indikator", $data);
        } elseif ($p['actionTypeIndikator'] == "edit") {
            $data = array(
                'jenis' => $p['addJenisIndikator'],
                'uraian' => $p['addUraianIndikator'],
                'target' => $p['addTarget'],
                'satuan' => $p['addSatuanIndikator']
            );
            $where = $MainID;
            $query = $this->ProgramModel->updateDataProgram("tb_indikator", $data, $where);
        } else {
            $this->session->set_flashdata('err', 'Terdapat kesalahan silahkan reload halaman saat ini !');
            $this->session->set_flashdata('kodeProgram', $kodeProgram);
            $this->session->set_flashdata('Indikator_Direct', "Direction");
            redirect('ProgramCtrl/index/' . $kodeInstansi);
        }
        if ($query != null) {
            $this->session->set_flashdata('succ', 'Berhasil menambah Indikator');
            $this->session->set_flashdata('kodeProgram', $kodeProgram);
            $this->session->set_flashdata('Indikator_Direct', "Direction");
            redirect('ProgramCtrl/index/' . $kodeInstansi);
        } else {
            $this->session->set_flashdata('err', 'Gagal menambah Indikator, segera hubungi admin');
            $this->session->set_flashdata('kodeProgram', $kodeProgram);
            $this->session->set_flashdata('Indikator_Direct', "Direction");
            redirect('ProgramCtrl/index/' . $kodeInstansi);
        }
    }

    public function ActionPembahasan()
    {
        $p = $this->input->post();
        $kodeInstansi = $p['KodeInstansiPembahasan'];
        $kodeProgram = $p['KodeProgramPembahasan'];
        $T1Rekening = str_replace(".", "", $p['addT1RekeningPembahasan']);
        $T2Rekening = str_replace(".", "", $p['addT2RekeningPembahasan']);
        $T3Rekening = str_replace(".", "", $p['addT3RekeningPembahasan']);
        $T4Rekening = str_replace(".", "", $p['addT4RekeningPembahasan']);
        $totalRekening = str_replace(".", "", $p['addTotalRekeningPembahasan']);
        if ($p['actionTypePembahasan'] == "add") {
            $data = array(
                'kode_pembahasan' => rand(0, 9999),
                'kode_instansi' => $p['KodeInstansiPembahasan'],
                'kode_program' => $p['KodeProgramPembahasan'],
                'kode_kegiatan' => $p['addNamaKegiatanPembahasan'],
                'kode_rekening' => $p['addNamaRekeningPembahasan'],
                'id_siswa' => $p['IdSiswaPembahasan'],
                'nama_siswa' => $p['addNamaPembahasan'],
                'plafon' => $p['addPlafonPembahasan'],
                'triwulan1_rekening' => $T1Rekening,
                'triwulan2_rekening' => $T2Rekening,
                'triwulan3_rekening' => $T3Rekening,
                'triwulan4_rekening' => $T4Rekening,
                'total_rekening' => $totalRekening,
                'triwulan1_pembahasan' => $p['addT1Pembahasan'],
                'triwulan2_pembahasan' => $p['addT2Pembahasan'],
                'triwulan3_pembahasan' => $p['addT3Pembahasan'],
                'triwulan4_pembahasan' => $p['addT4Pembahasan'],
                'nilai' => $p['addNilaiPembahasan'],
                'uraian' => $p['addUraianPembahasan']
            );
            $query = $this->ProgramModel->ActionInsert("tb_pembahasan", $data);
        } elseif ($p['actionTypePembahasan'] == "edit") {
            $data = array(
                'kode_kegiatan' => $p['addNamaKegiatanPembahasan'],
                'kode_rekening' => $p['addNamaRekeningPembahasan'],
                'triwulan1_rekening' => $T1Rekening,
                'triwulan2_rekening' => $T2Rekening,
                'triwulan3_rekening' => $T3Rekening,
                'triwulan4_rekening' => $T4Rekening,
                'total_rekening' => $totalRekening,
                'triwulan1_pembahasan' => $p['addT1Pembahasan'],
                'triwulan2_pembahasan' => $p['addT2Pembahasan'],
                'triwulan3_pembahasan' => $p['addT3Pembahasan'],
                'triwulan4_pembahasan' => $p['addT4Pembahasan'],
                'nilai' => $p['addNilaiPembahasan'],
                'uraian' => $p['addUraianPembahasan']
            );
            $where = $p['MainIdPembahasan'];
            $query = $this->ProgramModel->updateDataProgram("tb_pembahasan", $data, $where);
        } else {
            $this->session->set_flashdata('err', 'Terdapat kesalahan silahkan reload halaman saat ini !');
            $this->session->set_flashdata('kodeProgram', $kodeProgram);
            $this->session->set_flashdata('Pembahasan_Direct', "Direction");
            redirect('ProgramCtrl/index/' . $kodeInstansi);
        }
        if ($query != null) {
            $this->session->set_flashdata('succ', 'Berhasil menambah Pembahasan');
            $this->session->set_flashdata('kodeProgram', $kodeProgram);
            $this->session->set_flashdata('Pembahasan_Direct', "Direction");
            redirect('ProgramCtrl/index/' . $kodeInstansi);
        } else {
            $this->session->set_flashdata('err', 'Gagal menambah Pembahasan, segera hubungi admin');
            $this->session->set_flashdata('kodeProgram', $kodeProgram);
            $this->session->set_flashdata('Pembahasan_Direct', "Direction");
            redirect('ProgramCtrl/index/' . $kodeInstansi);
        }
    }


    public function EditKegiatan()
    {
        $post = $this->input->post();
        $data = array(
            'kode_kegiatan' => htmlspecialchars("080." . str_replace(" ", "", $post['editKodeKegiatan'])),
            'nama_kegiatan' => htmlspecialchars($post['editNamaKegiatan']),
            'keterangan' => htmlspecialchars($post['editKeterangan'])
        );
        $where = $post['idKegiatanEdit'];
        $kodeInstansi = $post['kodeInstansiEdit'];
        $kodeProgram = $post['kodeProgramEdit'];
        $query = $this->ProgramModel->EditKegiatan('tb_kegiatan', $data, $where);
        if ($query != null) {
            $this->session->set_flashdata('msgKegiatan', 'Berhasil menambah kegiatan');
            $this->session->set_flashdata('kodeProgram', $kodeProgram);
            redirect('ProgramCtrl/index/' . $kodeInstansi);
        } else {
            $this->session->set_flashdata('msgKegiatan', 'Gagal menambah kegiatan, segera hubungi admin');
            $this->session->set_flashdata('kodeProgram', $kodeProgram);
            redirect('ProgramCtrl/index/' . $kodeInstansi);
        }
    }

    public function HapusKegiatan($idKegiatan, $kodeProgram, $kodeInstansi)
    {
        $query = $this->ProgramModel->DeleteDataKegiatan('tb_kegiatan', $idKegiatan);
        if ($query != null) {
            $this->session->set_flashdata('msgKegiatan', 'Berhasil menambah kegiatan');
            $this->session->set_flashdata('kodeProgram', $kodeProgram);
            redirect('ProgramCtrl/index/' . $kodeInstansi);
        } else {
            $this->session->set_flashdata('msgKegiatan', 'Gagal menambah kegiatan, segera hubungi admin');
            $this->session->set_flashdata('kodeProgram', $kodeProgram);
            redirect('ProgramCtrl/index/' . $kodeInstansi);
        }
    }

    public function HapusIndikator($idIndikator, $kodeProgram, $kodeInstansi)
    {
        $query = $this->ProgramModel->DeleteDataKegiatan('tb_indikator', $idIndikator);
        if ($query != null) {
            $this->session->set_flashdata('succ', 'Berhasil Hapus Indikator');
            $this->session->set_flashdata('kodeProgram', $kodeProgram);
            $this->session->set_flashdata('Indikator_Direct', "Direction");
            redirect('ProgramCtrl/index/' . $kodeInstansi);
        } else {
            $this->session->set_flashdata('err', 'Gagal Hapus Indikator, segera hubungi admin');
            $this->session->set_flashdata('kodeProgram', $kodeProgram);
            $this->session->set_flashdata('Indikator_Direct', "Direction");
            redirect('ProgramCtrl/index/' . $kodeInstansi);
        }
    }

    public function HapusPembahasan($idPembahasan, $kodeProgram, $kodeInstansi)
    {
        $this->ProgramModel->DeleteDatakegiatan("tb_pembahasan", $idPembahasan);
        if ($query != null) {
            $this->session->set_flashdata('succ', 'Berhasil Hapus Pembahasan');
            $this->session->set_flashdata('kodeProgram', $kodeProgram);
            $this->session->set_flashdata('Pembahasan_Direct', "Direction");
            redirect('ProgramCtrl/index/' . $kodeInstansi);
        } else {
            $this->session->set_flashdata('err', 'Gagal Hapus Pembahasan, segera hubungi admin');
            $this->session->set_flashdata('kodeProgram', $kodeProgram);
            $this->session->set_flashdata('Pembahasan_Direct', "Direction");
            redirect('ProgramCtrl/index/' . $kodeInstansi);
        }
    }

    private function generateKodeKegiatan($id)
    {
        $kode = "080.";
        $keygen = $kode . $id;
        return $keygen;
    }
    private function generateKodeIndikator($kodeInstansi, $kodeProgram)
    {
        $sel = $this->db->select_max("kode_indikator")->from("tb_indikator")->where("kode_instansi", $kodeInstansi)->where("kode_program", $kodeProgram)->get();
        $result = $sel->row();
        $tambahRes = $result->kode_indikator;
        $potong = substr($tambahRes, -3);
        $hasil = $potong + 1;
        $kode = "1." . str_pad($hasil, 3, 0, STR_PAD_LEFT);
        return $kode;
    }

    //==============================================================================>>
    // Coding untuk menu tab Rekening

    public function DataAPIRekening($kodeInstansi, $kodeProgram, $kodeKegiatan)
    {
        header('Content-Type: application/json');
        echo $this->ProgramModel->getAllRekening('tb_rekening', $kodeInstansi, $kodeProgram, $kodeKegiatan);
    }

    public function ActionRekening()
    {
        $p = $this->input->post();

        $r1 = str_replace(".", "", $p['AddT1']);
        $r2 = str_replace(".", "", $p['AddT2']);
        $r3 = str_replace(".", "", $p['AddT3']);
        $r4 = str_replace(".", "", $p['AddT4']);
        $kodeInstansi = $p['KodeInstansiRekening'];
        $kodeProgram = $p['KodeProgramRekening'];
        $kodeKegiatan = $p['KodeKegiatanRekening'];
        if ($p['actionTypeRekening'] == "add") {
            $kodeRekening = $this->generateKodeRekening($p['addKodeRek'], $p['KodeKegiatanRekening'], $p['KodeProgramRekening'], $p['KodeInstansiRekening']);
            $data = array(
                'kode_patokan' => $p['addKodeRek'],
                'kode_instansi' => $p['KodeInstansiRekening'],
                'kode_program' => $p['KodeProgramRekening'],
                'kode_kegiatan' => $p['KodeKegiatanRekening'],
                'kode_rekening' => $kodeRekening,
                'uraian_rekening' => $p['addNamaRek'],
                'triwulan_1' => $r1,
                'triwulan_2' => $r2,
                'triwulan_3' => $r3,
                'triwulan_4' => $r4,
                'total' => $r1 + $r2 + $r3 + $r4
            );
            $query = $this->ProgramModel->ActionInsert('tb_rekening', $data);
        } else {
            $kodeRekening = $this->generateKodeRekening($p['addKodeRek'], $p['KodeKegiatanRekening'], $p['KodeProgramRekening'], $p['KodeInstansiRekening'], $p['KodeRekeningRekening']);
            $data = array(
                'kode_patokan' => $p['addKodeRek'],
                'kode_rekening' => $kodeRekening,
                'kode_instansi' => $p['KodeInstansiRekening'],
                'kode_program' => $p['KodeProgramRekening'],
                'kode_kegiatan' => $p['KodeKegiatanRekening'],
                'uraian_rekening' => $p['addNamaRek'],
                'triwulan_1' => $r1,
                'triwulan_2' => $r2,
                'triwulan_3' => $r3,
                'triwulan_4' => $r4,
                'total' => $r1 + $r2 + $r3 + $r4
            );
            $mainID = $p['IDRekening'];
            $query = $this->ProgramModel->EditDataRekening('tb_rekening', $data, $mainID);
        }
        $this->ProgramModel->SyncTotalRekening($kodeInstansi, $kodeProgram, $kodeKegiatan);
        if ($query != null) {
            $this->session->set_flashdata('succ', 'Berhasil menambah rekening');
            $this->session->set_flashdata('Rekening_Direct', "Direction");
            $this->session->set_flashdata('Rekening_KodeInstansi', $kodeInstansi);
            $this->session->set_flashdata('Rekening_KodeProgram', $kodeProgram);
            $this->session->set_flashdata('Rekening_KodeKegiatan', $kodeKegiatan);
            redirect('ProgramCtrl/index/' . $kodeInstansi);
        } else {
            $this->session->set_flashdata('fail', 'Gagal menambah rekening, segera hubungi admin');
            $this->session->set_flashdata('Rekening_Direct', "Direction");
            $this->session->set_flashdata('Rekening_KodeInstansi', $kodeInstansi);
            $this->session->set_flashdata('Rekening_KodeProgram', $kodeProgram);
            $this->session->set_flashdata('Rekening_KodeKegiatan', $kodeKegiatan);
            redirect('ProgramCtrl/index/' . $kodeInstansi);
        }
    }

    public function HapusRekening($idRekening, $kodeInstansi, $kodeProgram, $kodeKegiatan)
    {
        $query = $this->ProgramModel->DeleteDataRekening('tb_rekening', $idRekening);
        if ($query != null) {
            $this->session->set_flashdata('succ', 'Berhasil hapus rekening');
            $this->session->set_flashdata('Rekening_Direct', "Direction");
            $this->session->set_flashdata('Rekening_KodeInstansi', $kodeInstansi);
            $this->session->set_flashdata('Rekening_KodeProgram', $kodeProgram);
            $this->session->set_flashdata('Rekening_KodeKegiatan', $kodeKegiatan);
            redirect('ProgramCtrl/index/' . $kodeInstansi);
        } else {
            $this->session->set_flashdata('fail', 'Gagal hapus rekening, segera hubungi admin');
            $this->session->set_flashdata('Rekening_Direct', "Direction");
            $this->session->set_flashdata('Rekening_KodeInstansi', $kodeInstansi);
            $this->session->set_flashdata('Rekening_KodeProgram', $kodeProgram);
            $this->session->set_flashdata('Rekening_KodeKegiatan', $kodeKegiatan);
            redirect('ProgramCtrl/index/' . $kodeInstansi);
        }
    }


    private function generateKodeRekening($kodePatokan, $kodeKegiatan, $kodeProgram, $kodeInstansi, $kodeRekening = null)
    {
        if ($kodeRekening == "") {
            $query = $this->db->select_max('kode_rekening')->from('tb_rekening')
                ->where('kode_patokan', $kodePatokan)
                ->where('kode_kegiatan', $kodeKegiatan)
                ->where('kode_program', $kodeProgram)
                ->where('kode_instansi', $kodeInstansi)
                ->get();
            $getRek = $query->row();
            $kodeRek = $getRek->kode_rekening; // if(null):null ? 5.1.1.01
            $potong = substr($kodeRek, -2); // 01
            $tambah = $potong + 1; // 02
            $pad = str_pad($tambah, 2, "0", STR_PAD_LEFT); //02
            $result = $kodePatokan . "." . $pad;
            return $result;
        } else {
            $currentKode = substr($kodeRekening, 0, -2);
            $kodeID = substr($kodeRekening, -2);
            if ($kodePatokan == $currentKode) {
                $result = $kodePatokan;
                return $result;
            } else {
                $query = $this->db->select_max('kode_rekening')->from('tb_rekening')
                    ->where('kode_patokan', $kodePatokan)
                    ->where('kode_kegiatan', $kodeKegiatan)
                    ->where('kode_program', $kodeProgram)
                    ->where('kode_instansi', $kodeInstansi)
                    ->get();
                $getRek = $query->row();
                $kodeRek = $getRek->kode_rekening; // if(null):null ? 5.1.1.01
                $potong = substr($kodeRek, -2); // 01
                $tambah = $potong + 1; // 02
                $pad = str_pad($tambah, 2, "0", STR_PAD_LEFT); //02
                $result = $kodePatokan . "." . $pad;
                return $result;
            }
        }
    }

    //==============================================================================>>
    // Detail Rekening Code

    public function DataDetailRekening($kodeInstansi, $kodeRekening) //Json DetailRekekning
    {
        header("Content-Type: application/json");
        echo $this->ProgramModel->getDetailRekening("tb_detail_rekening", $kodeInstansi, $kodeRekening);
    }

    public function TambahDetailRekening()
    {
        $p = $this->input->post();
        $kodeInstansi = $p['KodeInstansiDetailRekening'];
        $kodeProgram = $p['KodeProgramDetailRekening'];
        $kodeKegiatan = $p['KodeKegiatanDetailRekening'];
        $kodeRekening = $p['KodeRekeningDetailRekening'];
        if ($p['actionTypeDetailRekening'] == "add") {
            $id = $this->generateKodeDetailRekening($kodeInstansi, $kodeProgram, $kodeKegiatan, $kodeRekening);
            $data = array(
                'kode_detail_rekening' => $p['KodeRekeningDetailRekening'] . "." . $id,
                'kode_instansi' => $kodeInstansi,
                'kode_program' => $kodeProgram,
                'kode_kegiatan' => $kodeKegiatan,
                'kode_rekening' => $kodeRekening,
                'jenis' => $p['addJenis'],
                'uraian' => $p['addUraian'],
                'sub_uraian' => $p['addSubUraian'],
                'sasaran' => $p['addSasaran'],
                'lokasi' => $p['addLokasi'],
                'dana' => $p['addDana'],
                'satuan' => $p['addSatuan'],
                'volume' => $p['addVolume'],
                'harga' => $p['addHarga'],
                'total' => str_replace(".", "", $p['addTotal']),
                'keterangan' => $p['addKeterangan']
            );
            $query = $this->ProgramModel->ActionInsert('tb_detail_rekening', $data);
        } else {
            $data = array(
                'jenis' => $p['addJenis'],
                'uraian' => $p['addUraian'],
                'sub_uraian' => $p['addSubUraian'],
                'sasaran' => $p['addSasaran'],
                'lokasi' => $p['addLokasi'],
                'dana' => $p['addDana'],
                'satuan' => $p['addSatuan'],
                'volume' => $p['addVolume'],
                'harga' => $p['addHarga'],
                'total' => str_replace(".", "", $p['addTotal']),
                'keterangan' => $p['addKeterangan']
            );
            $mainID = $p['MainIdDetailRekening'];
            $query = $this->ProgramModel->EditDataRekening("tb_detail_rekening", $data, $mainID);
        }
        //untuk update total_rinci di tb_rekening
        $this->ProgramModel->SyncTotalRinci($kodeInstansi, $kodeProgram, $kodeKegiatan, $kodeRekening);
        if ($query != null) {
            $this->session->set_flashdata('succ', 'Berhasil tambah detail');
            $this->session->set_flashdata('DetailRekening_Direct', "Direction");
            $this->session->set_flashdata('DetailRekening_KodeInstansi', $kodeInstansi);
            $this->session->set_flashdata('DetailRekening_KodeProgram', $kodeProgram);
            $this->session->set_flashdata('DetailRekening_KodeKegiatan', $kodeKegiatan);
            $this->session->set_flashdata('DetailRekening_KodeRekening', $kodeRekening);
            redirect('ProgramCtrl/index/' . $kodeInstansi);
        } else {
            $this->session->set_flashdata('fail', 'Gagal tambah detail, segera hubungi admin');
            $this->session->set_flashdata('DetailRekening_Direct', "Direction");
            $this->session->set_flashdata('DetailRekening_KodeInstansi', $kodeInstansi);
            $this->session->set_flashdata('DetailRekening_KodeProgram', $kodeProgram);
            $this->session->set_flashdata('DetailRekening_KodeKegiatan', $kodeKegiatan);
            $this->session->set_flashdata('DetailRekening_KodeRekening', $kodeRekening);
            redirect('ProgramCtrl/index/' . $kodeInstansi);
        }
    }

    public function HapusDetailRekening($mainID, $kodeInstansi, $kodeProgram, $kodeKegiatan, $kodeRekening)
    {
        $query = $this->ProgramModel->DeleteDataRekening("tb_detail_rekening", $mainID);
        //untuk update total_rekening di tb_instansi
        $this->ProgramModel->SyncTotalRinci($kodeInstansi, $kodeProgram, $kodeKegiatan, $kodeRekening);
        if ($query != null) {
            $this->session->set_flashdata('succ', 'Berhasil hapus detail');
            $this->session->set_flashdata('DetailRekening_Direct', "Direction");
            $this->session->set_flashdata('DetailRekening_KodeInstansi', $kodeInstansi);
            $this->session->set_flashdata('DetailRekening_KodeProgram', $kodeProgram);
            $this->session->set_flashdata('DetailRekening_KodeKegiatan', $kodeKegiatan);
            $this->session->set_flashdata('DetailRekening_KodeRekening', $kodeRekening);
            redirect('ProgramCtrl/index/' . $kodeInstansi);
        } else {
            $this->session->set_flashdata('fail', 'Gagal hapus detail, segera hubungi admin');
            $this->session->set_flashdata('DetailRekening_Direct', "Direction");
            $this->session->set_flashdata('DetailRekening_KodeInstansi', $kodeInstansi);
            $this->session->set_flashdata('DetailRekening_KodeProgram', $kodeProgram);
            $this->session->set_flashdata('DetailRekening_KodeKegiatan', $kodeKegiatan);
            $this->session->set_flashdata('DetailRekening_KodeRekening', $kodeRekening);
            redirect('ProgramCtrl/index/' . $kodeInstansi);
        }
    }


    public function ApiDataKegiatan($kodeKegiatan, $kodeInstansi)
    {
        $query = $this->db->select('nama_kegiatan')->from('tb_kegiatan')->where('kode_kegiatan', $kodeKegiatan)->where('kode_instansi', $kodeInstansi)->get()->result();
        echo json_encode($query);
    }


    public function generateKodeDetailRekening($kodeInstansi, $kodeProgram, $kodeKegiatan, $kodeRekening)
    {
        $query = $this->db->select_max('kode_detail_rekening')->from('tb_detail_rekening')
            ->where('kode_rekening', $kodeRekening)
            ->where('kode_program', $kodeProgram)
            ->where('kode_kegiatan', $kodeKegiatan)
            ->where('kode_instansi', $kodeInstansi)
            ->get();
        $getKode = $query->row();
        $KodeRek = $getKode->kode_detail_rekening; //if(null): null ? 5.1.1.01.01
        $potong = substr($KodeRek, -2); // if(null): 1 ? 2
        $tambah = $potong + 1;
        $result = str_pad($tambah, 2, "0", STR_PAD_LEFT); //01
        return $result;
    }

}
