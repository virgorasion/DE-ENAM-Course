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
                ->where('id_siswa', 0)
                ->get()->result();
    }

    public function insertUserSiswa($table, $data, $nisn, $dataProgram)
    {
        $this->db->where('username', $data['username']);
        $query = $this->db->get($table);
        if ($query->num_rows() == 0) {
            //query untuk tambah siswa sekaligus update data program
            $this->db->insert($table, $data);
            $query = $this->db->select('id_siswa')->from($table)->where('nisn', $nisn)->get();
            $row = $query->row();
            $id_siswa = array('id_siswa' => $row->id_siswa);
            $this->db->update('tb_program',$id_siswa, $dataProgram); 
            return true;
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