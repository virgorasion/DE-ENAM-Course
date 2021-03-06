<?php

defined('BASEPATH')or exit('ERROR');

class DataExcel
{
    private $ci;

    public function __construct()
    {
        $this->ci =& get_instance();
    }

    public function getDataInstansi($kodeInstansi)
    {
        $query = $this->setDataInstansi($kodeInstansi);
        return $query;
    }
    
    public function getDataSiswa($kodeInstansi,$kodeProgram)
    {
        $query = $this->setDataSiswa($kodeInstansi,$kodeProgram);
        return $query;
    }
    
    public function getDataKegiatan($kodeInstansi,$kodeProgram,$kodeKegiatan)
    {
        $query = $this->setDataKegiatan($kodeInstansi,$kodeProgram,$kodeKegiatan);
        return $query;
    }

    public function getDataProgram($kodeInstansi,$kodeProgram)
    {
        $query = $this->setDataProgram($kodeInstansi,$kodeProgram);
        return $query;
    }
       
    public function getDataUraian($kodeInstansi, $kodeProgram, $kodeKegiatan)
    {
        $rekening = $this->setDataRekening($kodeInstansi, $kodeProgram, $kodeKegiatan);
        $data = array();
        foreach ($rekening as $item) {
            $data[] = $item->uraian_rekening;
            $detail = $this->setDataDetailRekening($kodeInstansi,$kodeProgram,$kodeKegiatan, $item->kode_rekening);
            foreach ($detail as $item) {
                $data[] = $item->uraian;
            }
            $data[] = " ";
        }
        return $data;
    }

    public function getDataIndikator($kodeInstansi, $kodeProgram)
    {
        $query = array(
            "capaian" => $this->setDataIndikator1($kodeInstansi, $kodeProgram),
            "hasil" => $this->setDataIndikator2($kodeInstansi, $kodeProgram),
            "keluaran" => $this->setDataIndikator3($kodeInstansi, $kodeProgram),
            "masukan" => $this->setDataIndikator4($kodeInstansi, $kodeProgram)
        );
        return $query;
    }

    public function getDataTriwulan($kodeInstansi,$kodeProgram,$kodeKegiatan)
    {
        $query = array(
            'T1' => $this->setDataTriwulan1($kodeInstansi,$kodeProgram,$kodeKegiatan),
            'T2' => $this->setDataTriwulan2($kodeInstansi,$kodeProgram,$kodeKegiatan),
            'T3' => $this->setDataTriwulan3($kodeInstansi,$kodeProgram,$kodeKegiatan),
            'T4' => $this->setDataTriwulan4($kodeInstansi,$kodeProgram,$kodeKegiatan)
        );
        return $query;
    }

    private function setDataInstansi($kodeInstansi)
    {
        return $this->ci->db->select("nama_instansi,versi,kota_lokasi")->from("tb_instansi")->where("kode_instansi",$kodeInstansi)->get()->result();
    }
    
    private function setDataKegiatan($kodeInstansi,$kodeProgram,$kodeKegiatan)
    {
        return $this->ci->db->select("nama_kegiatan,total_rinci,total_rekening")->from("tb_kegiatan")
                        ->where("kode_instansi",$kodeInstansi)
                        ->where("kode_program",$kodeProgram)
                        ->where("kode_kegiatan",$kodeKegiatan)
                        ->get()->result();
    }
    
    private function setDataProgram($kodeInstansi,$kodeProgram)
    {
        return $this->ci->db->select("nama_program,plafon,total_rinci,total_rekening,jenis,uraian,sasaran,id_siswa")->from("tb_program")
                            ->where("kode_instansi",$kodeInstansi)
                            ->where("kode_program",$kodeProgram)
                            ->get()->result();
    }
    
    private function setDataIndikator1($kodeInstansi,$kodeProgram)
    {
        return $this->ci->db->select("uraian,satuan,nilai")->from("tb_indikator")
                            ->where("kode_instansi",$kodeInstansi)
                            ->where("kode_program",$kodeProgram)
                            ->where("jenis",1)
                            ->get()->result_array();
    }
    private function setDataIndikator2($kodeInstansi,$kodeProgram)
    {
        return $this->ci->db->select("uraian,satuan,nilai")->from("tb_indikator")
                            ->where("kode_instansi",$kodeInstansi)
                            ->where("kode_program",$kodeProgram)
                            ->where("jenis",2)
                            ->get()->result_array();
    }
    private function setDataIndikator3($kodeInstansi,$kodeProgram)
    {
        return $this->ci->db->select("uraian,satuan,nilai")->from("tb_indikator")
                            ->where("kode_instansi",$kodeInstansi)
                            ->where("kode_program",$kodeProgram)
                            ->where("jenis",3)
                            ->get()->result_array();
    }
    private function setDataIndikator4($kodeInstansi,$kodeProgram)
    {
        return $this->ci->db->select("uraian,satuan,nilai")->from("tb_indikator")
                            ->where("kode_instansi",$kodeInstansi)
                            ->where("kode_program",$kodeProgram)
                            ->where("jenis",4)
                            ->get()->result_array();
    }
    private function setDataTriwulan1($kodeInstansi,$kodeProgram,$kodeKegiatan)
    {
        return $this->ci->db->select("SUM(triwulan_1) as triwulan")->from("tb_rekening")
                            ->where("kode_instansi",$kodeInstansi)
                            ->where("kode_program",$kodeProgram)
                            ->where("kode_kegiatan",$kodeKegiatan)
                            ->get()->result();
    }
    private function setDataTriwulan2($kodeInstansi,$kodeProgram,$kodeKegiatan)
    {
        return $this->ci->db->select("SUM(triwulan_2) as triwulan")->from("tb_rekening")
                            ->where("kode_instansi",$kodeInstansi)
                            ->where("kode_program",$kodeProgram)
                            ->where("kode_kegiatan",$kodeKegiatan)
                            ->get()->result();
    }
    private function setDataTriwulan3($kodeInstansi,$kodeProgram,$kodeKegiatan)
    {
        return $this->ci->db->select("SUM(triwulan_3) as triwulan")->from("tb_rekening")
                            ->where("kode_instansi",$kodeInstansi)
                            ->where("kode_program",$kodeProgram)
                            ->where("kode_kegiatan",$kodeKegiatan)
                            ->get()->result();
    }
    private function setDataTriwulan4($kodeInstansi,$kodeProgram,$kodeKegiatan)
    {
        return $this->ci->db->select("SUM(triwulan_4) as triwulan")->from("tb_rekening")
                            ->where("kode_instansi",$kodeInstansi)
                            ->where("kode_program",$kodeProgram)
                            ->where("kode_kegiatan",$kodeKegiatan)
                            ->get()->result();
    }
    private function setDataSiswa($kodeInstansi,$kodeProgram)
    {
        return $this->ci->db->select("nama,nis")->from("tb_siswa")
                            ->where("kode_instansi",$kodeInstansi)
                            ->where("kode_program",$kodeProgram)
                            ->get()->result();
    }
}