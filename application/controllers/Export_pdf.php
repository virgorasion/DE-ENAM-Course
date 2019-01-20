<?php
defined("BASEPATH") or exit("ERROR");

/**
 * Author: Virgorasion
 */
class Export_pdf extends CI_controller
{
    
    function __construct()
    {
        parent::__construct();
    }

    function Cover($kodeInstansi,$kodeProgram,$kodeKegiatan)
    {
        $data_siswa = $this->db->query("SELECT nisn,nis,nama,jurusan,nomor_hp FROM tb_siswa WHERE kode_instansi = $kodeInstansi AND kode_program = $kodeProgram")->result();
        $data_sekolah = $this->db->query("SELECT nama_instansi FROM tb_instansi WHERE kode_instansi = $kodeInstansi")->result();
        $data_program = $this->db->query("SELECT nama_program,plafon FROM tb_program WHERE kode_instansi = $kodeInstansi AND kode_program = $kodeProgram")->result();
        $data_kegiatan = $this->db->query("SELECT nama_kegiatan,lokasi FROM tb_kegiatan WHERE kode_instansi = $kodeInstansi AND kode_program = $kodeProgram AND kode_kegiatan = $kodeKegiatan")->result();
        function Terbilang($nilai) {
            $huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
            if ($nilai < 12) {
                return "" . $huruf[$nilai];
            } elseif ($nilai < 20) {
                return Terbilang($nilai - 10) . " Belas ";
            } elseif ($nilai < 100) {
                return Terbilang($nilai / 10) . " Puluh " . Terbilang($nilai % 10);
            } elseif ($nilai < 200) {
                return " Seratus " . Terbilang($nilai - 100);
            } elseif ($nilai < 1000) {
                return Terbilang($nilai / 100) . " Ratus " . Terbilang($nilai % 100);
            } elseif ($nilai < 2000) {
                return " Seribu " . Terbilang($nilai - 1000);
            } elseif ($nilai < 1000000) {
                return Terbilang($nilai / 1000) . " Ribu " . Terbilang($nilai % 1000);
            } elseif ($nilai < 1000000000) {
                return Terbilang($nilai / 1000000) . " Juta " . Terbilang($nilai % 1000000);
            }elseif ($nilai < 1000000000000) {
                return Terbilang($nilai / 1000000000) . " Milyar " . Terbilang($nilai % 1000000000);
            }elseif ($nilai < 100000000000000) {
                return Terbilang($nilai / 1000000000000) . " Trilyun " . Terbilang($nilai % 1000000000000);
            }elseif ($nilai <= 100000000000000) {
                return "Maaf Tidak Dapat di Proses Karena Jumlah nilai Terlalu Besar ";
            }
        }

        $pdf = new FPDF();
        $pdf->SetAuthor("D6 Course", true);
        $pdf->AddPage('L','LEGAL');
        $pdf->SetFont('Arial','B',16);
        $pdf->Image(base_url('Assets/images/icon.jpeg'),165,20,50,50);
        $pdf->SetY(70);
        $pdf->SetX(140);
        $pdf->Cell(40,10,"RENCANA KERJA DAN ANGGARAN",0,1); 
        $pdf->Cell(140);
        $pdf->Cell(40,7,"MUSTIKA GRAHA DE ENAM",0,1); 
        $pdf->Cell(170);
        $pdf->Cell(40,7,date("Y"),0,1);
        $pdf->Cell(155);
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(40,10,"BELANJA LANGSUNG",0,1);
        $pdf->Cell(100);
        $pdf->Cell(20,10,"NO. SK :");
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(20,10,"D6",1,0,"C");
        $pdf->Cell(20,10,"02",1,0,"C");
        $pdf->Cell(20,10,"06",1,0,"C");
        $pdf->Cell(20,10,"MGE",1,0,"C");
        $pdf->Cell(20,10,"92",1,0,"C");
        $pdf->Cell(20,10,"1",1,1,"C");
        //Program
        $pdf->SetX(70);
        $pdf->Cell(40,10,"PROGRAM");
        $pdf->Cell(5,10," : ",0,0,"C");
        $pdf->Cell(20,10,"(".$kodeProgram.")" ,0,0,"L");
        $pdf->Cell(30,10, @$data_program[0]->nama_program);
        $pdf->Ln(5);
        //KEGIATAN
        $pdf->SetX(70);
        $pdf->Cell(40,10,"KEGIATAN");
        $pdf->Cell(5,10," : ",0,0,"C");
        $pdf->Cell(20,10,"(".@$kodeKegiatan.")",0,0,"L");
        $pdf->Cell(30,10, @$data_kegiatan[0]->nama_kegiatan);
        $pdf->Ln(5);
        //LOKASI KEGIATAN
        $pdf->SetX(70);
        $pdf->Cell(40,10,"LOKASI KEGIATAN");
        $pdf->Cell(5,10," : ",0,0,"C");
        $pdf->Cell(30,10, @$data_kegiatan[0]->lokasi);
        $pdf->Ln(5);
        //JUMLAH ANGGARAN
        $pdf->SetX(70);
        $pdf->Cell(40,10,"JUMLAH ANGGARAN");
        $pdf->Cell(5,10," : ",0,0,"C");
        $pdf->Cell(30,10, "Rp ". number_format((double)@$data_program[0]->plafon,0,",","."));
        $pdf->Ln(5);
        //TERBILANG
        $pdf->SetX(70);
        $pdf->Cell(40,10,"TERBILANG");
        $pdf->Cell(5,10," : ",0,0,"C");
        $pdf->Cell(30,10,"(".Terbilang(@$data_program[0]->plafon).")");
        $pdf->Ln(10);

        //PENGGUNA ANGGARAN
        $pdf->SetX(70);
        $pdf->Cell(20,5,"PENGGUNA ANGGARAN",0,1);
        //NAMA SISWA
        $pdf->SetX(70);
        $pdf->Cell(40,5,"NAMA SISWA");
        $pdf->Cell(5,5," : ",0,0,"C");
        $pdf->Cell(30,5, @$data_siswa[0]->nama,0,1);
        //NO REG SIWA
        $pdf->SetX(70);
        $pdf->Cell(40,5,"NO REG SIWA");
        $pdf->Cell(5,5," : ",0,0,"C");
        $pdf->Cell(30,5, @$data_siswa[0]->nisn,0,1);
        //SEKOLAH
        $pdf->SetX(70);
        $pdf->Cell(40,5,"SEKOLAH");
        $pdf->Cell(5,5," : ",0,0,"C");
        $pdf->Cell(30,5, @$data_sekolah[0]->nama_instansi,0,1);
        //JURUSAN
        $pdf->SetX(70);
        $pdf->Cell(40,5,"JURUSAN");
        $pdf->Cell(5,5," : ",0,0,"C");
        $pdf->Cell(30,5, @$data_siswa[0]->jurusan,0,1);
        //NO HP
        $pdf->SetX(70);
        $pdf->Cell(40,5,"NO HP");
        $pdf->Cell(5,5," : ",0,0,"C");
        $pdf->Cell(30,5, @$data_siswa[0]->nomor_hp,0,1);

        $pdf->Output("I","Cover ".$data_siswa[0]->nama." ".$data_kegiatan[0]->nama_kegiatan);
    }

    function AKB($kodeInstansi,$kodeProgram){
        $data_siswa = $this->db->query("SELECT nis,nama FROM tb_siswa WHERE kode_instansi = $kodeInstansi AND kode_program = $kodeProgram")->result();
        $data_sekolah = $this->db->query("SELECT nama_instansi FROM tb_instansi WHERE kode_instansi = $kodeInstansi")->result();
        $data_program = $this->db->query("SELECT nama_program FROM tb_program WHERE kode_instansi = $kodeInstansi AND kode_program = $kodeProgram")->result();

        $pdf = new FPDF();
        $pdf->SetAuthor("D6 Course", true);
        $pdf->AddPage('L','LEGAL');
        $pdf->SetFont("Arial","B",12);
        $pdf->Cell(280,10,"MUSTIKA GRAHA DE ENAM",0,0,"C");
        $pdf->Ln(5);
        $pdf->Cell(280,10,"ANGGARAN KAS BELANJA",0,0,"C");
        $pdf->Ln(5);
        $pdf->Cell(280,10,date("Y"),0,0,"C");
        $pdf->Ln();

        //Nama Siswa
        $pdf->SetFont("Arial","",10);
        $pdf->SetX(20);
        $pdf->Cell(40,10,"Nama Siswa");
        $pdf->Cell(5,10,":");
        $pdf->Cell(30,10, @$data_siswa[0]->nama);
        $pdf->Ln(5);
        //PROGRAM
        $pdf->SetFont("Arial","",10);
        $pdf->SetX(20);
        $pdf->Cell(40,10,"PROGRAM");
        $pdf->Cell(5,10,":");
        $pdf->Cell(30,10, @$data_program[0]->nama_program);
        $pdf->Ln(5);
        //SEKOLAH
        $pdf->SetFont("Arial","",10);
        $pdf->SetX(20);
        $pdf->Cell(40,10,"SEKOLAH");
        $pdf->Cell(5,10,":");
        $pdf->Cell(30,10, @$data_sekolah[0]->nama_instansi);
        $pdf->Ln();

        //Data Table
        $header = array('Kode Rekening','Uraian','Anggaran Tahun Ini','Triwulan I','Triwulan II','Triwulan III','Triwulan IV');
        $width = array('35','85','40','30','30','30','30');
        $arrLenght = count($header);
        //Header
        for ($i=0; $i < $arrLenght; $i++) { 
            $pdf->Cell($width[$i],10,$header[$i],1,0,"C");
        }
        $pdf->Ln();
        $pdf->Cell(35,5,"1",1,0,"C");
        $pdf->Cell(85,5,"2",1,0,"C");
        $pdf->Cell(40,5,"3",1,0,"C");
        $pdf->Cell(30,5,'Rp',1,0,"C");
        $pdf->Cell(30,5,'Rp',1,0,"C");
        $pdf->Cell(30,5,'Rp',1,0,"C");
        $pdf->Cell(30,5,'Rp',1,0,"C");
        $pdf->Ln(5);
        //Data
        $data_kegiatan = $this->db->query("
        SELECT tb_kegiatan.kode_kegiatan,tb_kegiatan.nama_kegiatan,tb_kegiatan.total_rinci,
        (SELECT SUM(tb_rekening.triwulan_1) FROM tb_rekening WHERE tb_rekening.kode_instansi = tb_kegiatan.kode_instansi AND tb_rekening.kode_program = tb_kegiatan.kode_program AND tb_rekening.kode_kegiatan = tb_kegiatan.kode_kegiatan) AS T1,
        (SELECT SUM(tb_rekening.triwulan_2) FROM tb_rekening WHERE tb_rekening.kode_instansi = tb_kegiatan.kode_instansi AND tb_rekening.kode_program = tb_kegiatan.kode_program AND tb_rekening.kode_kegiatan = tb_kegiatan.kode_kegiatan) AS T2,
        (SELECT SUM(tb_rekening.triwulan_3) FROM tb_rekening WHERE tb_rekening.kode_instansi = tb_kegiatan.kode_instansi AND tb_rekening.kode_program = tb_kegiatan.kode_program AND tb_rekening.kode_kegiatan = tb_kegiatan.kode_kegiatan) AS T3,
        (SELECT SUM(tb_rekening.triwulan_4) FROM tb_rekening WHERE tb_rekening.kode_instansi = tb_kegiatan.kode_instansi AND tb_rekening.kode_program = tb_kegiatan.kode_program AND tb_rekening.kode_kegiatan = tb_kegiatan.kode_kegiatan) AS T4
        FROM `tb_kegiatan` WHERE tb_kegiatan.kode_instansi = $kodeInstansi AND tb_kegiatan.kode_program = $kodeProgram")->result();
        foreach ($data_kegiatan as $kegiatan) {
            $pdf->SetFont("Arial","B",12);
            $pdf->Cell(35,5,@$kegiatan->kode_kegiatan,1,0);
            $pdf->Cell(85,5,@$kegiatan->nama_kegiatan,1,0);
            $pdf->Cell(40,5,@$kegiatan->total_rinci,1,0,"R");
            $pdf->Cell(30,5,@$kegiatan->T1,1,0,"R");
            $pdf->Cell(30,5,@$kegiatan->T2,1,0,"R");
            $pdf->Cell(30,5,@$kegiatan->T3,1,0,"R");
            $pdf->Cell(30,5,@$kegiatan->T4,1,0,"R");
            $pdf->Ln(5);
            $data_rekening = $this->db->query("
            SELECT tb_rekening.kode_patokan,tb_rekening.kode_rekening,tb_patokan_rekening.nama,SUM(tb_rekening.total_rinci) AS total_rinci,
            SUM(tb_rekening.triwulan_1) AS T1,SUM(tb_rekening.triwulan_2) AS T2,
            SUM(tb_rekening.triwulan_3) AS T3,SUM(tb_rekening.triwulan_4) AS T4
            FROM tb_rekening INNER JOIN tb_patokan_rekening ON tb_patokan_rekening.kode_patokan = tb_rekening.kode_patokan
            WHERE tb_rekening.kode_instansi = $kodeInstansi AND tb_rekening.kode_program = $kodeProgram AND tb_rekening.kode_kegiatan = $kegiatan->kode_kegiatan
            GROUP BY tb_rekening.kode_patokan")->result();  
            foreach ($data_rekening as $rekening) {
                $pdf->SetFont("Arial","",10);
                $pdf->Cell(35,5,@$rekening->kode_patokan."  |  ".@$rekening->kode_rekening,1,0);
                $pdf->Cell(85,5,@$rekening->nama,1,0);
                $pdf->Cell(40,5,@$rekening->total_rinci,1,0,"R");
                $pdf->Cell(30,5,@$rekening->T1,1,0,"R");
                $pdf->Cell(30,5,@$rekening->T2,1,0,"R");
                $pdf->Cell(30,5,@$rekening->T3,1,0,"R");
                $pdf->Cell(30,5,@$rekening->T4,1,0,"R");
                $pdf->Ln(5);
            }
        }
        $pdf->SetX(212);
        $pdf->Cell(60,10,"Sidoarjo, ".date("d F Y"),0,1,"C");
        $pdf->SetX(222);
        $pdf->Cell(40,0,@$data_sekolah[0]->nama_instansi,0,1,"C");
        $pdf->Ln(20);
        $pdf->SetX(222);
        $pdf->Cell(40,0,@$data_siswa[0]->nama,0,1,"C");
        $pdf->Ln(5);
        $pdf->SetX(222);
        $pdf->Cell(40,0,@$data_siswa[0]->nis,0,1,"C");
        $pdf->Output("I","Anggaran Kas Belanja ".$data_siswa[0]->nama);
    }

    public function RKA($kodeInstansi,$kodeProgram,$kodeKegiatan)
    {
        $Instansi = $this->db->select("nama_instansi,versi")->from("tb_instansi")->where("kode_instansi",$kodeInstansi)->get()->result();
        $Program = $this->db->select("jenis,sasaran,nama_program,total_rinci")->from("tb_program")->where("kode_instansi",$kodeInstansi)->where("kode_program",$kodeProgram)->get()->result();
        $Kegiatan = $this->db->select("nama_kegiatan,total_rinci,total_rekening")->from("tb_kegiatan")->where("kode_instansi",$kodeInstansi)->where("kode_program",$kodeProgram)->where("kode_kegiatan",$kodeKegiatan)->get()->result();
        $indikatorCapaian = $this->db->select("uraian,satuan,target")->from("tb_indikator")->where("kode_instansi",$kodeInstansi)->where("kode_program",$kodeProgram)->where("jenis",1)->get()->result();
        $indikatorHasil = $this->db->select("uraian,satuan,target")->from("tb_indikator")->where("kode_instansi",$kodeInstansi)->where("kode_program",$kodeProgram)->where("jenis",2)->get()->result();
        $indikatorKeluaran = $this->db->select("uraian,satuan,target")->from("tb_indikator")->where("kode_instansi",$kodeInstansi)->where("kode_program",$kodeProgram)->where("jenis",3)->get()->result();
        $indikatorMasukan = $this->db->select("uraian,satuan,target")->from("tb_indikator")->where("kode_instansi",$kodeInstansi)->where("kode_program",$kodeProgram)->where("jenis",4)->get()->result();
        $T1 = $this->db->select("SUM(triwulan_1) as T1")->from("tb_rekening")->where("kode_instansi",$kodeInstansi)->where("kode_program",$kodeProgram)->where("kode_kegiatan",$kodeKegiatan)->get()->result();
        $T2 = $this->db->select("SUM(triwulan_2) as T2")->from("tb_rekening")->where("kode_instansi",$kodeInstansi)->where("kode_program",$kodeProgram)->where("kode_kegiatan",$kodeKegiatan)->get()->result();
        $T3 = $this->db->select("SUM(triwulan_3) as T3")->from("tb_rekening")->where("kode_instansi",$kodeInstansi)->where("kode_program",$kodeProgram)->where("kode_kegiatan",$kodeKegiatan)->get()->result();
        $T4 = $this->db->select("SUM(triwulan_4) as T4")->from("tb_rekening")->where("kode_instansi",$kodeInstansi)->where("kode_program",$kodeProgram)->where("kode_kegiatan",$kodeKegiatan)->get()->result();
        $Siswa = $this->db->select("nama,nis")->from("tb_siswa")->where("kode_instansi",$kodeInstansi)->where("kode_program",$kodeProgram)->get()->result();

        //Full 335,185
        $pdf = new FPDF();
        $pdf->SetAuthor("D6 Course", true);
        $pdf->AddPage('L','LEGAL');
        //Header
        $pdf->SetFont("Arial","B",12);
        $pdf->Cell(230,6,"RENCANA KERJA DAN ANGGARAN","TLR","0","C");
        $pdf->SetFont("Arial","B",10);
        $pdf->Cell(55,6,"KODE KEGIATAN","1","0","C");
        $pdf->Cell(50,6,"FORMULIR","TLR","1","C");
        $pdf->SetFont("Arial","B",12);
        $pdf->Cell(230,6,"SATUAN KERJA PERANGAKT DAERAH","LRB","0","C");
        $pdf->SetFont("Arial","B",10);
        $pdf->Cell(55,6,$kodeKegiatan,"1","0","C");
        $pdf->Cell(50,6,"RKA-SKPD 2.2.1","LRB","1","C");
        $pdf->SetFont("Arial","",11);
        $pdf->Cell(335,6,"Pemerintah Provinsi Jawa Timur","TLR",1,"C");
        $pdf->Cell(335,6,date("Y"),"BLR",1,"C");
        
        //Keterangan
        //Instansi
        $pdf->Cell(40,6,"Instansi","L",0);
        $pdf->Cell(3,6,":","0",0);
        $pdf->Cell(30,6,$kodeInstansi,"0",0,"L");
        $pdf->Cell(262,6,@$Instansi[0]->nama_instansi,"R",1);
        //Sasaran RPJMD
        $pdf->Cell(40,6,"Sasaran RPJMD","L",0);
        $pdf->Cell(3,6,":","0",0);
        $pdf->Cell(292,6,@$Program[0]->sasaran,"R",1,"L");
        //Program
        $pdf->Cell(40,6,"Program","L",0);
        $pdf->Cell(3,6,":","0",0);
        $pdf->Cell(30,6,$kodeProgram,"0",0,"L");
        $pdf->Cell(262,6,@$Program[0]->nama_program,"R",1);
        //Kegiatan
        $pdf->Cell(40,6,"Kegiatan","L",0);
        $pdf->Cell(3,6,":","0",0);
        $pdf->Cell(30,6,$kodeKegiatan,"0",0,"L");
        $pdf->Cell(262,6,@$Kegiatan[0]->nama_kegiatan,"R",1);
        $pdf->Cell(335,6,"","RL",1);
        //Lokasi Kegiatan
        $pdf->Cell(40,6,"Lokasi Kegiatan","L",0);
        $pdf->Cell(3,6,":","0",0);
        $pdf->Cell(292,6,"Jawa Timur","R",1,"L");

        //Sumber Dana
        $pdf->Cell(40,6,"Sumber Dana","L",0);
        $pdf->Cell(3,6,":","0",0);
        $pdf->Cell(292,6,$Instansi[0]->versi,"R",1,"L");

        //Indikator
        $pdf->SetFont("Arial","B",11);
        $pdf->Cell(335,6,"Indikator & Tolok Ukur Kinerjar Belanja Langsung",1,1,"C");

        //Data Indikator
        //Header
        $pdf->SetFont("Arial","B",11);
        $pdf->Cell(50,6,"Indikator",1,0,"C");
        $pdf->Cell(180,6,"Uraian",1,0,"C");
        $pdf->Cell(55,6,"Nilai",1,0,"C");
        $pdf->Cell(50,6,"Satuan",1,1,"C");
        //Capaian
        $pdf->SetFont("Arial","",11);
        $pdf->Cell(50,6,"Capaian",1,0,"L");
        $pdf->Cell(180,6,@$indikatorCapaian[0]->uraian,1,0,"L");
        $pdf->Cell(55,6,@$indikatorCapaian[0]->target,1,0,"C");
        $pdf->Cell(50,6,@$indikatorCapaian[0]->satuan,1,1,"C");
        //Masukan
        $pdf->Cell(50,6,"Masukan",1,0,"L");
        $pdf->Cell(180,6,@$indikatorMasukan[0]->uraian,1,0,"L");
        $pdf->Cell(55,6,@$indikatorMasukan[0]->target,1,0,"C");
        $pdf->Cell(50,6,@$indikatorMasukan[0]->satuan,1,1,"C");
        //Keluaran
        $pdf->Cell(50,6,"Keluaran",1,0,"L");
        $pdf->Cell(180,6,@$indikatorKeluaran[0]->uraian,1,0,"L");
        $pdf->Cell(55,6,@$indikatorKeluaran[0]->target,1,0,"C");
        $pdf->Cell(50,6,@$indikatorKeluaran[0]->satuan,1,1,"C");
        //Hasil
        $pdf->Cell(50,6,"Hasil",1,0,"L");
        $pdf->Cell(180,6,@$indikatorHasil[0]->uraian,1,0,"L");
        $pdf->Cell(55,6,@$indikatorHasil[0]->target,1,0,"C");
        $pdf->Cell(50,6,@$indikatorHasil[0]->satuan,1,1,"C");

        //Kelompok Sasaran
        $pdf->SetFont("Arial","B",11);
        $pdf->Cell(335,6,"Kelompok Sasaran Kegiatan : ".@$Program[0]->sasaran,1,1,"L");

        //Rincina Rencana Kerja
        $pdf->Cell(335,6,"Rincian Rencana Kerja dan Anggaran","TLR",1,"C");
        $pdf->Cell(335,6,"Program dan Per Kegiatan Satuan Kerja Perangkat Daerah","LR",1,"C");

        //Header Data Utama
        $pdf->Cell(50,6,"Kode Rekening","TLR",0,"C");
        $pdf->Cell(120,6,"Uraian","TLR",0,"C");
        $pdf->Cell(110,6,"Rincian Perhitungan",1,0,"C");
        $pdf->Cell(55,6,"Jumlah","TLR",1,"C");
        $pdf->Cell(50,6,"","BLR");
        $pdf->Cell(120,6,"","BLR");
        $pdf->Cell(30,6,"Volume","BLR",0,"C");
        $pdf->Cell(30,6,"Satuan","BLR",0,"C");
        $pdf->Cell(50,6,"Harga Satuan","BLR",0,"C");
        $pdf->Cell(55,6,"(Rp)","BLR",1,"C");
        $pdf->Cell(50,6,"1",1,0,"C");
        $pdf->Cell(120,6,"2",1,0,"C");
        $pdf->Cell(30,6,"3",1,0,"C");
        $pdf->Cell(30,6,"4",1,0,"C");
        $pdf->Cell(50,6,"5",1,0,"C");
        $pdf->Cell(55,6,"6",1,1,"C");
        //Data Utama
        $dataRekening = $this->db->query("SELECT kode_rekening,uraian_rekening,total,total_rinci FROM tb_rekening
                                            WHERE kode_instansi = $kodeInstansi
                                            AND kode_program = $kodeProgram
                                            AND kode_kegiatan = $kodeKegiatan")->result();
        foreach ($dataRekening as $rekening) {
            $pdf->SetFont("Arial","B",11);
            $pdf->Cell(50,6,@$rekening->kode_rekening,"LR",0,"C");
            $pdf->Cell(120,6,@$rekening->uraian_rekening,"LR",0,"C");
            $pdf->Cell(30,6,"","LR",0,"C");
            $pdf->Cell(30,6,"","LR",0,"C");
            $pdf->Cell(50,6,"","LR",0,"C");
            $pdf->Cell(55,6,@$rekening->total_rinci,"LR",1,"C");
            $dataDetail = $this->db->query("SELECT kode_detail_rekening,uraian,volume,satuan,harga,total FROM tb_detail_rekening
                                            WHERE kode_instansi = $kodeInstansi
                                            AND kode_program = $kodeProgram
                                            AND kode_kegiatan = $kodeKegiatan
                                            AND kode_rekening = '".@$rekening->kode_rekening."' ")->result();
            foreach ($dataDetail as $detail) {
                $pdf->SetFont("Arial","",11);
                $pdf->Cell(50,6,$detail->kode_detail_rekening,"LR",0,"C");
                $pdf->Cell(120,6,$detail->uraian,"LR",0,"C");
                $pdf->Cell(30,6,$detail->volume,"LR",0,"C");
                $pdf->Cell(30,6,$detail->satuan,"LR",0,"C");
                $pdf->Cell(50,6,$detail->harga,"LR",0,"C");
                $pdf->Cell(55,6,$detail->total,"LR",1,"C");
            }
                $pdf->Cell(50,6,"","LR",0,"C");
                $pdf->Cell(120,6,"","LR",0,"C");
                $pdf->Cell(30,6,"","LR",0,"C");
                $pdf->Cell(30,6,"","LR",0,"C");
                $pdf->Cell(50,6,"","LR",0,"C");
                $pdf->Cell(55,6,"","LR",1,"C");
        }
        //End Data Utama

        //Jumlah
        $pdf->SetFont("Arial","B",11);
        $pdf->Cell(280,6,"Jumlah",1,0,"C");
        $pdf->Cell(55,6,@$Kegiatan[0]->total_rinci,1,1,"R");

        //Rencana Penarikan Dana
        $pdf->Cell(335,6,"Rencana Penarikan Dana Per Triwulan :","LR",1);
        $pdf->SetFont("Arial","",11);
        //Triwulan 1
        $pdf->Cell(40,6,"Triwulan 1","L");
        $pdf->Cell(3,6,"Rp");
        $pdf->Cell(40,6,@$T1[0]->T1,0,0,"R");
        $pdf->Cell(150,6,"");
        //Tempat & Tanggal
        $pdf->Cell(102,6,"Sidoarjo, ".date("d F Y"),"R",1,"C");
        //Triwulan 2
        $pdf->Cell(40,6,"Triwulan 2","L");
        $pdf->Cell(3,6,"Rp");
        $pdf->Cell(40,6,@$T2[0]->T2,0,0,"R");
        $pdf->Cell(252,6,"","R",1);
        //Triwulan 3
        $pdf->Cell(40,6,"Triwulan 3","L");
        $pdf->Cell(3,6,"Rp");
        $pdf->Cell(40,6,@$T3[0]->T3,0,0,"R");
        $pdf->Cell(252,6,"","R",1);
        //Triwulan 4
        $pdf->Cell(40,6,"Triwulan 4","L");
        $pdf->Cell(3,6,"Rp");
        $pdf->Cell(40,6,@$T4[0]->T4,0,0,"R");
        $pdf->Cell(252,6,"+","R",1,"L");
        //Jumlah
        $pdf->SetFont("Arial","B",11);
        $pdf->Cell(40,6,"Jumlah","L");
        $pdf->Cell(3,6,"Rp");
        $pdf->Cell(40,6,@$Kegiatan[0]->total_rinci,"BT",0,"R");
        $pdf->Cell(252,6,"","R",1);

        //Nama & Nis
        $pdf->Cell(233,6,"","L");
        $pdf->Cell(102,6,@$Siswa[0]->nama,"R",1,"C");
        $pdf->SetFont("Arial","",11);
        $pdf->Cell(233,6,"","L");
        $pdf->Cell(102,6,@$Siswa[0]->nis,"R",1,"C");
        $pdf->Cell(335,6,"","LR",1);
        $pdf->Cell(335,6,"","BLR");


        $pdf->Output("I","Rencana Kerja dan Anggaran ".$Siswa[0]->nama);
    }

}
