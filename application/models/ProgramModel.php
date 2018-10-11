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
                ->select('id','kode_program, kode_instansi, nama_program, plafon, total_rinci, total_rekening')
                ->from('tb_program')
                ->where('kode_instansi = "'.$kode.'" ')
                ->get();
    }

    public function APIEditInstansi($table,$id)
    {
        return $this->db->get_where($table, array('id' => $id))->result();
    }

    public function InsertInstansi($table,$data)
    {
        return $this->db->insert($table, $data);
    }

    public function DeleteInstansi($table,$id)
    {
        return $this->db->delete($table, array('id' => $id));
    }
}