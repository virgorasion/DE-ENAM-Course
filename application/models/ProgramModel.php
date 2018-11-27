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
            '<a href="javascript:void(0)" class="view_data btn btn-info btn-xs" data-kegiatan="$4" data-program="$3" data-instansi="$2" data-nama="$5"><i class="fa fa-eye"></i></a> 
            <a href="javascript:void(0)" class="edit_data btn btn-warning btn-xs" data-id="$1" data-program="$3" data-kode="$4" data-nama="$5" data-ket="$8"><i class="fa fa-pencil"></i></a> 
            <a href="javascript:void(0)" class="delete_data btn btn-danger btn-xs" data-id="$1" data-nama="$5"><i class="fa fa-remove"></i></a>',
            'id,
            kode_instansi,
            kode_program,
            kode_kegiatan,
            nama_kegiatan,
            total_rekening,
            total_rinci,
            keterangan');
        return $this->datatables->generate();
        // <a href="javascript:void(0)" class="view btn btn-primary btn-xs" data-id="$1"><i class="fa fa-eye"></i></a>
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
    
    //==============================================================================>>
    // Coding untuk menu tab Rekening

    public function getAllRekening($table,$kodeKegiatan)
    {
        $this->datatables->select('tb_rekening.id,
                                    tb_rekening.kode_patokan,
                                    tb_rekening.kode_rekening,
                                    tb_rekening.uraian_rekening,
                                    tb_rekening.triwulan_1,
                                    tb_rekening.triwulan_2,
                                    tb_rekening.triwulan_3,
                                    tb_rekening.triwulan_4,
                                    tb_kegiatan.kode_kegiatan,
                                    (tb_rekening.triwulan_1+tb_rekening.triwulan_2+tb_rekening.triwulan_3+tb_rekening.triwulan_4) as total,
                                    tb_rekening.total_rinci');
        $this->datatables->from('tb_rekening');
        $this->datatables->join('tb_kegiatan', 'tb_kegiatan.kode_kegiatan = tb_rekening.kode_kegiatan');
        $this->datatables->where('tb_rekening.kode_kegiatan', $kodeKegiatan);
        $this->datatables->add_column(
            'action',
            '<a href="javascript:void(0)" class="view_data btn btn-info btn-xs" data-id="$1" data-kodeRek="$3" data-kodeKeg="$9"><i class="fa fa-eye"></i></a>
            <a href="javascript:void(0)" class="edit_data btn btn-warning btn-xs" data-id="$1" data-rekening="$3" data-patokan="$2" data-uraian="$4" data-t1="$5" data-t2="$6" data-t3="$7" data-t4="$8"><i class="fa fa-pencil"></i></a> 
            <a href="javascript:void(0)" class="delete_data btn btn-danger btn-xs" data-id="$1" data-nama="$4"><i class="fa fa-remove"></i></a>',
            'id,
            kode_patokan,
            kode_rekening,
            uraian_rekening,
            triwulan_1,
            triwulan_2,
            triwulan_3,
            triwulan_4,
            kode_kegiatan');
        return $this->datatables->generate();
    }

    public function InsertDataRekening($table,$data)
    {
        return $this->db->insert($table,$data);
    }
    
    public function getPatokan()
    {
        return $this->db->select('*')->from('tb_patokan_rekening')->get()->result();
    }
    
    public function EditDataRekening($table, $data, $id)
    {
        return $this->db->update($table,$data, array('id' => $id));
    }

    public function DeleteDataRekening($table, $id)
    {
        return $this->db->delete($table, array('id' => $id));
    }
    
    //==============================================================================>>
    // Detail Rekening Code

    public function getDetailRekening($table,$idRekening,$kodeRekening,$kodeKegiatan)
    {
        $this->datatables->select("tb_detail_rekening.*");
        $this->datatables->from('tb_detail_rekening');
        $this->datatables->join('tb_rekening', 'tb_rekening.id = tb_detail_rekening.id_rekening');
        $this->datatables->where('tb_detail_rekening.id_rekening',$idRekening);
        $this->datatables->add_column('action',
            '<a href="javascript:void(0)" class="view_data btn btn-info btn-xs" data-id="$1" data-kodeRekening="$3" data-kodeKeg="$9"><i class="fa fa-eye"></i></a>
            <a href="javascript:void(0)" class="edit_data btn btn-warning btn-xs" data-id="$1" data-rekening="$3" data-patokan="$2" data-uraian="$4" data-t1="$5" data-t2="$6" data-t3="$7" data-t4="$8"><i class="fa fa-pencil"></i></a> 
            <a href="javascript:void(0)" class="delete_data btn btn-danger btn-xs" data-id="$1" data-nama="$4"><i class="fa fa-remove"></i></a>',
            'id,
            kode_detail_rekening,
            tb_detail_rekening.id_rekening,
            jenis,
            uraian,
            sub_uraian,
            sasaran');
        return $this->datatables->generate();
    }
    

}