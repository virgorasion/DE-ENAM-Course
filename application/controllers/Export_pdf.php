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
        $this->load->library("DataExcel");
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
        $pdf->AddPage('L','A4');
        $pdf->SetFont('Arial','B',16);
        $pdf->Image(base_url('Assets/images/icon.jpeg'),135,20,30,30);
        $pdf->SetY(50);
        $pdf->SetX(100);
        $pdf->Cell(40,10,"RENCANA KERJA DAN ANGGARAN",0,1); 
        $pdf->Cell(100);
        $pdf->Cell(40,10,"MUSTIKA GRAHA DE ENAM",0,1); 
        $pdf->Cell(130);
        $pdf->Cell(40,10,date("Y"),0,1);
        $pdf->Cell(115);
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(40,10,"BELANJA LANGSUNG",0,1);
        $pdf->Cell(70);
        $pdf->Cell(20,10,"NO. SK :");
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(20,10,"D6",1,0,"C");
        $pdf->Cell(20,10,"02",1,0,"C");
        $pdf->Cell(20,10,"06",1,0,"C");
        $pdf->Cell(20,10,"MGE",1,0,"C");
        $pdf->Cell(20,10,"92",1,0,"C");
        $pdf->Cell(20,10,"1",1,1,"C");
        //Program
        $pdf->SetX(30);
        $pdf->Cell(20,10,"PROGRAM");
        $pdf->SetX(80);
        $pdf->Cell(5,10," : ",0,0,"C");
        $pdf->Cell(20,10,"(".$kodeProgram.")" ,0,0,"L");
        $pdf->Cell(30,10, @$data_program[0]->nama_program);
        $pdf->Ln(5);
        //KEGIATAN
        $pdf->SetX(30);
        $pdf->Cell(20,10,"KEGIATAN");
        $pdf->SetX(80);
        $pdf->Cell(5,10," : ",0,0,"C");
        $pdf->Cell(20,10,"(".@$kodeKegiatan.")",0,0,"L");
        $pdf->Cell(30,10, @$data_kegiatan[0]->nama_kegiatan);
        $pdf->Ln(5);
        //LOKASI KEGIATAN
        $pdf->SetX(30);
        $pdf->Cell(20,10,"LOKASI KEGIATAN");
        $pdf->SetX(80);
        $pdf->Cell(5,10," : ",0,0,"C");
        $pdf->Cell(30,10, @$data_kegiatan[0]->lokasi);
        $pdf->Ln(5);
        //JUMLAH ANGGARAN
        $pdf->SetX(30);
        $pdf->Cell(20,10,"JUMLAH ANGGARAN");
        $pdf->SetX(80);
        $pdf->Cell(5,10," : ",0,0,"C");
        $pdf->Cell(30,10, "Rp ". number_format((double)@$data_program[0]->plafon,0,",","."));
        $pdf->Ln(5);
        //TERBILANG
        $pdf->SetX(30);
        $pdf->Cell(20,10,"TERBILANG");
        $pdf->SetX(80);
        $pdf->Cell(5,10," : ",0,0,"C");
        $pdf->Cell(30,10,"(".Terbilang(@$data_program[0]->plafon).")");
        $pdf->Ln(10);

        //PENGGUNA ANGGARAN
        $pdf->SetX(30);
        $pdf->Cell(20,10,"PENGGUNA ANGGARAN");
        $pdf->SetX(80);
        $pdf->Ln(5);
        //NAMA SISWA
        $pdf->SetX(30);
        $pdf->Cell(20,10,"NAMA SISWA");
        $pdf->SetX(80);
        $pdf->Cell(5,10," : ",0,0,"C");
        $pdf->Cell(30,10, @$data_siswa[0]->nama);
        $pdf->Ln(5);
        //NO REG SIWA
        $pdf->SetX(30);
        $pdf->Cell(20,10,"NO REG SIWA");
        $pdf->SetX(80);
        $pdf->Cell(5,10," : ",0,0,"C");
        $pdf->Cell(30,10, @$data_siswa[0]->nisn);
        $pdf->Ln(5);
        //SEKOLAH
        $pdf->SetX(30);
        $pdf->Cell(20,10,"SEKOLAH");
        $pdf->SetX(80);
        $pdf->Cell(5,10," : ",0,0,"C");
        $pdf->Cell(30,10, @$data_sekolah[0]->nama_instansi);
        $pdf->Ln(5);
        //JURUSAN
        $pdf->SetX(30);
        $pdf->Cell(20,10,"JURUSAN");
        $pdf->SetX(80);
        $pdf->Cell(5,10," : ",0,0,"C");
        $pdf->Cell(30,10, @$data_siswa[0]->jurusan);
        $pdf->Ln(5);
        //NO HP
        $pdf->SetX(30);
        $pdf->Cell(20,10,"NO HP");
        $pdf->SetX(80);
        $pdf->Cell(5,10," : ",0,0,"C");
        $pdf->Cell(30,10, @$data_siswa[0]->nomor_hp);
        $pdf->Ln(5);

        $pdf->Output();
    }

    function AKB($kodeInstansi,$kodeProgram){
        $data_siswa = $this->db->query("SELECT nis,nama FROM tb_siswa WHERE kode_instansi = $kodeInstansi AND kode_program = $kodeProgram")->result();
        $data_sekolah = $this->db->query("SELECT nama_instansi FROM tb_instansi WHERE kode_instansi = $kodeInstansi")->result();
        $data_program = $this->db->query("SELECT nama_program FROM tb_program WHERE kode_instansi = $kodeInstansi AND kode_program = $kodeProgram")->result();

        $pdf = new FPDF();
        $pdf->AddPage('L','A4');
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
        $pdf->Output();
    }

    function test($kodeInstansi = "010.03",$kodeProgram = "127.01",$kodeKegiatan = "080.01")
    {
        $data_kegiatan = $this->db->query("SELECT tb_kegiatan.kode_kegiatan,tb_kegiatan.nama_kegiatan,tb_kegiatan.total_rinci,
            (SELECT SUM(tb_rekening.triwulan_1) FROM tb_rekening WHERE tb_rekening.kode_instansi = $kodeInstansi AND tb_rekening.kode_program = $kodeProgram AND tb_rekening.kode_kegiatan = $kodeKegiatan) AS T1,
            (SELECT SUM(tb_rekening.triwulan_2) FROM tb_rekening WHERE tb_rekening.kode_instansi = $kodeInstansi AND tb_rekening.kode_program = $kodeProgram AND tb_rekening.kode_kegiatan = $kodeKegiatan) AS T2,
            (SELECT SUM(tb_rekening.triwulan_3) FROM tb_rekening WHERE tb_rekening.kode_instansi = $kodeInstansi AND tb_rekening.kode_program = $kodeProgram AND tb_rekening.kode_kegiatan = $kodeKegiatan) AS T3,
            (SELECT SUM(tb_rekening.triwulan_4) FROM tb_rekening WHERE tb_rekening.kode_instansi = $kodeInstansi AND tb_rekening.kode_program = $kodeProgram AND tb_rekening.kode_kegiatan = $kodeKegiatan) AS T4
            FROM `tb_kegiatan` WHERE tb_kegiatan.kode_instansi = $kodeInstansi AND tb_kegiatan.kode_program = $kodeProgram ")->result();

        var_dump($data_kegiatan);
    }
}
