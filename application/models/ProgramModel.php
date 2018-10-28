<?php

class ProgramModel extends CI_model
{
    public function DataProgram($kode)
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

    public function updateDataProgram($table,$data,$where)
    {
        $this->db->where('id', $where);
        return $this->db->update($table, $data);
    }

    public function DeleteProgram($table,$idProgram)
    {
        return $this->db->delete($table, array('id'=> $idProgram));
    }

    public function getDataKegiatan($kodeInstansi, $kodeProgram)
    {
        $this->datatables->select('id,kode_instansi,kode_program,kode_kegiatan,nama_kegiatan,total_rekening,total_rinci,keterangan');
        $this->datatables->from('tb_kegiatan');
        $this->datatables->where('kode_instansi = "' . $kodeInstansi . '"');
        $this->datatables->where('kode_program = "' . $kodeProgram . '"');
        $this->datatables->add_column('action',
            '<a href="javascript:void(0)" class="edit_data btn btn-warning btn-xs" data-id="$1" data-program="$3" data-kode="$4" data-nama="$5" data-ket="$8"><i class="fa fa-pencil"></i></a> <a href="javascript:void(0)" class="delete_data btn btn-danger btn-xs" data-id="$1" data-nama="$5"><i class="fa fa-remove"></i></a>',
            'id,
            kode_instansi,
            kode_program,
            kode_kegiatan,
            nama_kegiatan,
            total_rekening,
            total_rinci,
            keterangan');
        return $this->datatables->generate();
    }

    public function DeleteDataKegiatan($table,$idKegiatan)
    {
        return $this->db->delete($table,array('id'=>$idKegiatan));
    }
    
    public function EditKegiatan($table,$data,$where)
    {
        $this->db->where('id', $where);
        return $this->db->update($table,$data);
    }

    public function insertKegiatan($table,$data)
    {
        return $this->db->insert($table,$data);
    }
}