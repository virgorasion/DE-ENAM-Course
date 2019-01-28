<?php

/**
 * Author : Virgorasion
 */
class ProfileModel extends CI_model
{
    public function getDataInstansi($kodeInstansi = NULL)
    {
        $this->datatables->select("kode_instansi,nama_instansi,versi,kota_lokasi as lokasi,tahun");
        $this->datatables->from("tb_instansi");
        if (@$_SESSION['hakAkses'] == 2) {
            $this->datatables->where("kode_instansi", $kodeInstansi);
        }
        function callback_button($kode_instansi)
        {
            if (@$_SESSION['kode_instansi'] == $kode_instansi && @$_SESSION['hakAkses'] == 2) {
                $btn = '<center><a href="javascript:void(0)" class="view_data btn btn-info btn-xs" data-instansi="'.$kode_instansi.'"><i class="fa fa-eye"></i></a></center>';
                return $btn;
            }elseif (@$_SESSION['hakAkses'] == 1) {
                $btn = '<center><a href="javascript:void(0)" class="view_data btn btn-info btn-xs" data-instansi="'.$kode_instansi.'"><i class="fa fa-eye"></i></a></center>';
                return $btn;
            }
        }
        $this->datatables->add_column(
            'view',
            '$1',
            'callback_button(kode_instansi)'
        );
        return $this->datatables->generate();
    }

    public function getDataSiswa($kodeInstansi)
    {
        $this->datatables->select("nama,nis,nisn,nomor_hp");
        $this->datatables->from("tb_siswa");
        $this->datatables->where("kode_instansi", $kodeInstansi);
        return $this->datatables->generate();
    }
}
