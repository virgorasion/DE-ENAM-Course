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

    public function getDataKegiatan($kodeInstansi, $kodeProgram)
    {
        $this->datatables->select('*');
        $this->datatables->from('tb_kegiatan');
        $this->datatables->where('kode_instansi = "' . $kodeInstansi . '"');
        $this->datatables->where('kode_program = "' . $kodeProgram . '"');
        $this->datatables->add_column(
            'action',
            '<a href="javascript:void(0)" class="edit_data btn btn-warning btn-xs" data-id="$1" data-kode="$2" data-nama="$3"><i class="fa fa-pencil"></i></a> <a href="javascript:void(0)" class="delete_data btn btn-danger btn-xs" data-tanggal="$4" data-id="$7"><i class="fa fa-remove"></i></a>',
            'id,
            kode_kegiatan,
            nama_kegiatan,
            total_rekening,
            total_rinci,
            keterangan');
        return $this->datatables->generate();
    }

    public function insertKegiatan($table,$data)
    {
        return $this->db->insert($table,$data);
    }
}