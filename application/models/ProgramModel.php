<?php 

class ProgramModel extends CI_model
{
    public function DataProgram()
    {
        return $this->db->get('tb_instansi')->result();
    }

    public function UpdateInstansi($table,$data,$id)
    {
        $this->db->set($data);
        $this->db->where('id',$id);
        return $this->db->update($table);
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
        $this->db->delete($table, array('id' => $id));
        return $this->db->delete('tb_program', array('kode_instansi' => $id));
    }

    //===================================================================================\\

    public function DataProgramDetails($kode)
    {
        return $this->db
            ->select('*')
            ->from('tb_program')
            ->where('kode_instansi = "' . $kode . '" ')
            ->get();
    }

    public function APIDataEditProgramInstansi($table,$id)
    {
        return $this->db->get_where($table, array('id' => $id));
    }

    public function InsertProgram($table,$data)
    {
        return $this->db->insert($table,$data);
    }
}