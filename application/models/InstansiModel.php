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
                ->where('id_siswa', NULL)
                ->get()->result();
    }

    public function UpdateInstansi($table,$data,$id)
    {
        $this->db->set($data);
        $this->db->where('id',$id);
        return $this->db->update($table);
    }

    public function InsertSiswa($table, $data, $nisn, $dataProgram){
        $this->db->where('username', $data['username']);
        $cekUsername = $this->db->get($table);
        $this->db->where('nisn', $data['nisn']);
        $cekNisn = $this->db->get($table);
        if ($cekUsername->num_rows() > 0) {
            return [false, "Username sudah digunakan !"] ;
        }elseif ($cekNisn->num_rows() > 0) {
            return [false, "NISN sudah digunakan !"];
        }else {
            //query untuk tambah siswa sekaligus update data program
            $this->db->insert($table, $data);
            $query = $this->db->select('id_siswa')->from($table)->where('nisn', $nisn)->get();
            $row = $query->row();
            $id_siswa = array('id_siswa' => $row->id_siswa);
            $this->db->update('tb_program',$id_siswa, $dataProgram); // ubah data tb_program menjadi milik siswa
            return array(true,"Berhasil menambah siswa");
        }
    }

    public function APIEditInstansi($table,$id)
    {
        return $this->db->get_where($table, array('id' => $id))->result();
    }

    public function InsertInstansi($table,$data,$kodeInstansi)
    {
        $this->db->where("kode_instansi",$kodeInstansi);
        $cekKode = $this->db->get($table);
        if ($cekKode->num_rows() > 0) {
            return [false,"Kode Instansi sudah dipakai"];
        }else{
            $this->db->insert($table,$data);
            return [true,"Instansi berhasil dibuat !"];
        }
    }

    public function DeleteInstansi($table,$id)
    {
        $this->db->delete($table, array('id' => $id));
        return $this->db->delete('tb_program', array('kode_instansi' => $id));
    }
    
}