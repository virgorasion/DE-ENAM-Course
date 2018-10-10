<?php 

class ProgramModel extends CI_model
{
    public function DataProgram()
    {
        return $this->db->get('tb_instansi')->result();
    }

    public function DataProgramDetails($kode)
    {
        return $this->db
                ->select('kode_program, kode_instansi, nama_program, plafon, total_rinci, total_rekening')
                ->from('tb_program')
                ->where('kode_instansi = "'.$kode.'" ')
                ->get();
    }
}