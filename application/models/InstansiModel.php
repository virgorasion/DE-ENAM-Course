<?php 

class InstansiModel extends CI_model
{
    public function DataProgram()
    {
        return $this->db->get('tb_instansi')->result();
    }

    public function getDataInstansi()
    {
        return $this->db->select('kode_instansi,nama_instansi')->from('tb_instansi')->get()->result();
    }

    public function getDataProgram($table,$where)
    {
        return $this->db->select('kode_program,nama_program')
                ->from($table)
                ->where('kode_instansi',$where)
                ->get()->result();
    }

    public function insertUserSiswa($table, $data)
    {
        $this->db->where('username', $data['username']);
        $query = $this->db->get($table);
        if ($query->num_rows() == 0) {
            return $this->db->insert($table, $data);
        }else{
            return false;
        }
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
    
}