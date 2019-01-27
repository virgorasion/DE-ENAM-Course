<?php
defined("BASEPATH")or exit("ERROR");

/**
 * Author : Virgorasion
 */
class ProfileModel extends CI_controller
{
    public function getDataInstansi($kodeInstansi = NULL)
    {
        $this->datatables->select("kode_instansi,nama_instansi,versi,kota_lokasi as lokasi,tahun");
        $this->datatables->from("tb_instansi");
        if ($hakAkses == 2) {
            $this->datatables->where("tb_siswa.kode_instansi", $kodeInstansi);
        }
        function callback_button()
        {
            if ($total == $total_rinci) {
                return "label label-success";
            } else {
                return "label label-danger";
            }
        }
        $this->datatables->add_column(
            'view',
            '<center><a href="javascript:void(0)" class="view_data btn btn-info btn-xs" data-instansi="$1"><i class="fa fa-eye"></i></a></center>',
            'kode_instansi'
        );
        return $this->datatables->generate();
    }

    public function getDataSiswaCetak($hakAkses,$kodeInstansi = NULL)
    {
        $this->datatables->select("tb_siswa.id_siswa,tb_siswa.nisn,tb_siswa.nis,tb_siswa.nama,tb_instansi.nama_instansi,tb_instansi.kode_instansi,tb_program.nama_program,tb_program.kode_program");
        $this->datatables->from("tb_siswa");
        $this->datatables->join("tb_instansi","tb_instansi.kode_instansi = tb_siswa.kode_instansi");
        $this->datatables->join("tb_program","tb_program.kode_program = tb_siswa.kode_program and tb_program.kode_instansi = tb_siswa.kode_instansi");
        if ($hakAkses == 2) {
            $this->datatables->where("tb_siswa.kode_instansi", $kodeInstansi);
        }else if($hakAkses ==3){
            $this->datatables->where("tb_siswa.id_siswa", $_SESSION['id_siswa']);
            $this->datatables->where("tb_siswa.kode_instansi", $_SESSION['kode_instansi']);
        }
        $this->datatables->add_column(
            'view',
            '<center><a href="javascript:void(0)" class="view_data btn btn-info btn-xs" data-program="$1" data-instansi="$2"><i class="fa fa-eye"></i></a></center>',
            'kode_program,kode_instansi'
        );
        $this->datatables->add_column(
            'print',
            '<center><a href="javascript:void(0)" class="print_akb_pdf btn btn-danger btn-xs" data-program="$1" data-instansi="$2"><i class="fa fa-file-pdf-o"></i></a>
             <a href="javascript:void(0)" class="print_akb_excel btn btn-success btn-xs" data-program="$1" data-instansi="$2"><i class="fa fa-file-excel-o"></i></a></center>',
            'kode_program,kode_instansi'
        );
        // $this->datatables->group_by("tb_siswa.kode_program");
        return $this->datatables->generate();
    }
}
