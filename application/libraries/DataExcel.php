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

    public function getDataKode($kodeInstansi, $kodeProgram, $kodeKegiatan)
    {
        $rekening = $this->setDataRekening($kodeInstansi, $kodeProgram, $kodeKegiatan);
        $data = "";
        foreach ($rekening as $item) {
            $data .= "<b>" . $item->kode_rekening . "</b><br>";
            $detail = $this->setDataDetailRekening($kodeInstansi, $kodeProgram, $kodeKegiatan, $item->kode_rekening);
            foreach ($detail as $item) {
                $data .= $item->kode_detail_rekening . "<br>";
            }
            $data .= "<br>";
        }
        return $data;
    }

    public function getDataVolume($kodeInstansi, $kodeProgram, $kodeKegiatan)
    {
        $rekening = $this->setDataRekening($kodeInstansi, $kodeProgram, $kodeKegiatan);
        $data = "";
        foreach ($rekening as $item) {
            $data .= "<b>" . "" . "</b><br>";
            $detail = $this->setDataDetailRekening($kodeInstansi, $kodeProgram, $kodeKegiatan, $item->kode_rekening);
            foreach ($detail as $item) {
                $data .= $item->volume . "<br>";
            }
            $data .= "<br>";
        }
        return $data;
    }
    
    public function getDataSatuan($kodeInstansi, $kodeProgram, $kodeKegiatan)
    {
        $rekening = $this->setDataRekening($kodeInstansi, $kodeProgram, $kodeKegiatan);
        $data = "";
        foreach ($rekening as $item) {
            $data .= "<b>" . "" . "</b><br>";
            $detail = $this->setDataDetailRekening($kodeInstansi, $kodeProgram, $kodeKegiatan, $item->kode_rekening);
            foreach ($detail as $item) {
                $data .= $item->satuan . "<br>";
            }
            $data .= "<br>";
        }
        return $data;
    }
    
    public function getDataHarga($kodeInstansi, $kodeProgram, $kodeKegiatan)
    {
        $rekening = $this->setDataRekening($kodeInstansi, $kodeProgram, $kodeKegiatan);
        $data = "";
        foreach ($rekening as $item) {
            $data .= "<b>" . "" . "</b><br>";
            $detail = $this->setDataDetailRekening($kodeInstansi, $kodeProgram, $kodeKegiatan, $item->kode_rekening);
            foreach ($detail as $item) {
                $data .= number_format((double)$item->harga, 0, ".", ",") . "<br>";
            }
            $data .= "<br>";
        }
        return $data;
    }
    
    public function getDataJumlah($kodeInstansi, $kodeProgram, $kodeKegiatan)
    {
        $rekening = $this->setDataRekening($kodeInstansi, $kodeProgram, $kodeKegiatan);
        $data = "";
        foreach ($rekening as $item) {
            $data .= "<b>" . number_format((double)$item->total_rinci, 0, ".", ",") . "</b><br>";
            $detail = $this->setDataDetailRekening($kodeInstansi, $kodeProgram, $kodeKegiatan, $item->kode_rekening);
            foreach ($detail as $item) {
                $data .= number_format((double)$item->harga, 0, ".", ",") . "<br>";
            }
            $data .= "<br>";
        }
        return $data;
    }
    
    private function setDataRekening($kodeInstansi,$kodeProgram,$kodeKegiatan)
    {
        return $this->ci->db->select('kode_rekening,uraian_rekening,total,total_rinci')->from("tb_rekening")
            ->where("kode_instansi", $kodeInstansi)
            ->where("kode_program", $kodeProgram)
            ->where("kode_kegiatan", $kodeKegiatan)
            ->get()->result();
    }

    private function setDataDetailRekening($kodeInstansi,$kodeProgram,$kodeKegiatan,$kodeRekening)
    {
        return $this->ci->db->select("kode_detail_rekening,uraian,volume,satuan,harga")->from("tb_detail_rekening")
            ->where("kode_instansi", $kodeInstansi)
            ->where("kode_program", $kodeProgram)
            ->where("kode_kegiatan", $kodeKegiatan)
            ->where("kode_rekening", $kodeRekening)
            ->get()->result();
    }
    
}