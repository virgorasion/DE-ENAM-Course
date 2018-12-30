<?php

defined('BASEPATH')or exit('ERROR');

class DataExcel
{
    private $ci;

    public function __construct()
    {
        $this->ci =& get_instance();
    }

    public function getDataUraian($kodeInstansi, $kodeProgram, $kodeKegiatan)
    {
        $rekening = $this->setDataRekening($kodeInstansi, $kodeProgram, $kodeKegiatan);
        $data = "";
        foreach ($rekening as $item) {
            $data .= "<b>" . $item->uraian_rekening . "</b><br>";
            $detail = $this->setDataDetailRekening($kodeInstansi,$kodeProgram,$kodeKegiatan, $item->kode_rekening);
            foreach ($detail as $item) {
                $data .= $item->uraian . "<br>";
            }
            $data .= "<br>";
        }
        return $data;
    }

    private function setDataRekening($kodeInstansi,$kodeProgram,$kodeKegiatan)
    {
        return $this->ci->db->select('kode_rekening,uraian_rekening')->from("tb_rekening")
            ->where("kode_instansi", $kodeInstansi)
            ->where("kode_program", $kodeProgram)
            ->where("kode_kegiatan", $kodeKegiatan)
            ->get()->result();
    }

    private function setDataDetailRekening($kodeInstansi,$kodeProgram,$kodeKegiatan,$kodeRekening)
    {
        return $this->ci->db->select("uraian")->from("tb_detail_rekening")
            ->where("kode_instansi", $kodeInstansi)
            ->where("kode_program", $kodeProgram)
            ->where("kode_kegiatan", $kodeKegiatan)
            ->where("kode_rekening", $kodeRekening)
            ->get()->result();
    }
    
}