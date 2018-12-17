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

    public function ActionInsert($table,$data)
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
        $this->datatables->select('id,kode_instansi,kode_program,kode_kegiatan,nama_kegiatan,total_rekening,keterangan,total_rinci as tot_rinci, FORMAT(total_rinci,0) as total_rinci');
        $this->datatables->from('tb_kegiatan');
        $this->datatables->where('kode_instansi = "' . $kodeInstansi . '"');
        $this->datatables->where('kode_program = "' . $kodeProgram . '"');
        //kode untuk mengubah label jika total & rinci tidak sama
        function callback_label($total, $total_rinci)
        {
            if ($total == $total_rinci) {
                return "label label-success";
            } else {
                return "label label-danger";
            }
        }
        $this->datatables->add_column(
            'total_rinci',
            '<center><span class="$2" style="font-size:12px">$1</span></center>',
            'total_rinci,
            callback_label(tot_rekening,total_rinci)'
        );
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

    public function SyncTotalRekening($kodeInstansi,$kodeProgram,$kodeKegiatan)
    {
        $this->db->trans_start();
        $selRekening = $this->db->query("select SUM(total) as total from tb_rekening 
                                            where kode_instansi = $kodeInstansi
                                            and kode_program = $kodeProgram
                                            and kode_kegiatan = $kodeKegiatan");
        $row = $selRekening->row();
        $this->db->query("update tb_kegiatan set total_rekening = ".$row->total."
                            where kode_instansi = $kodeInstansi
                            and kode_program = $kodeProgram
                            and kode_kegiatan = $kodeKegiatan");

        $selKegiatan = $this->db->query("select SUM(total_rekening) as total from tb_kegiatan
                                            where kode_instansi = $kodeInstansi
                                            and kode_program = $kodeProgram");
        $row = $selKegiatan->row();
        $this->db->query("update tb_program set total_rekening = ".$row->total."
                            where kode_instansi = $kodeInstansi
                            and kode_program = $kodeProgram ");
        $this->db->trans_complete();
    }
    
    //==============================================================================>>
    // Coding untuk menu tab Rekening

    public function getAllRekening($table,$kodeInstansi,$kodeProgram,$kodeKegiatan)
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
                                    tb_rekening.total,
                                    tb_rekening.total_rinci as tot_rinci,
                                    FORMAT(tb_rekening.total_rinci,0) as total_rinci');
        $this->datatables->from('tb_rekening');
        $this->datatables->join('tb_instansi', 'tb_instansi.kode_instansi = tb_rekening.kode_instansi');
        $this->datatables->join('tb_program', 'tb_program.kode_program = tb_rekening.kode_program');
        $this->datatables->join('tb_kegiatan', 'tb_kegiatan.kode_kegiatan = tb_rekening.kode_kegiatan');
        $this->datatables->where('tb_rekening.kode_instansi', $kodeInstansi);
        $this->datatables->where('tb_rekening.kode_program', $kodeProgram);
        $this->datatables->where('tb_rekening.kode_kegiatan', $kodeKegiatan);
        //kode untuk mengubah label jika total & rinci tidak sama
        function callback_label($total,$total_rinci){
            if ($total == $total_rinci) {
                return "label label-success";
            }else{
                return "label label-danger";
            }
        }
        $this->datatables->add_column('total_rinci',
        '<center><span class="$2" style="font-size:12px">$1</span></center>',
        'total_rinci,
        callback_label(total,tot_rinci)');
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
        $this->datatables->group_by("tb_rekening.id");
        return $this->datatables->generate();
    }

    public function getPatokan()
    {
        return $this->db->select('*')->from('tb_patokan_rekening')->get()->result();
    }
    
    // Dipakai untuk edit rekening & detail rekening
    public function EditDataRekening($table, $data, $id)
    {
        return $this->db->update($table,$data, array('id' => $id)); //Edit Rekening gabung dengan Detail Rekening
    }

    // Dipakai untuk edit rekening & detail rekening
    public function DeleteDataRekening($table, $id)
    {
        return $this->db->delete($table, array('id' => $id)); //Delete Rekening gabung dengan Detail Rekening
    }
    
    //==============================================================================>>
    // Detail Rekening Code

    public function getDetailRekening($table,$kodeInstansi,$kodeRekening)
    {
        $this->datatables->select("tb_detail_rekening.id,
                                    tb_detail_rekening.jenis,
                                    tb_detail_rekening.uraian,
                                    tb_detail_rekening.sub_uraian,
                                    tb_detail_rekening.sasaran,
                                    tb_detail_rekening.lokasi,
                                    tb_detail_rekening.satuan,
                                    tb_detail_rekening.dana,
                                    tb_detail_rekening.volume,
                                    tb_detail_rekening.harga,
                                    tb_detail_rekening.total,
                                    tb_detail_rekening.keterangan");
        $this->datatables->from('tb_detail_rekening');
        $this->datatables->join('tb_instansi', 'tb_instansi.kode_instansi = tb_detail_rekening.kode_instansi');
        $this->datatables->join('tb_rekening', 'tb_rekening.kode_rekening = tb_detail_rekening.kode_rekening');
        $this->datatables->where('tb_detail_rekening.kode_instansi',$kodeInstansi);
        $this->datatables->where('tb_detail_rekening.kode_rekening',$kodeRekening);
        $this->datatables->add_column('action',
            '<a href="javascript:void(0)" class="edit_data btn btn-warning btn-xs" data-id="$1" data-jenis="$2" data-uraian="$3" data-suburaian="$4" data-sasaran="$5" data-lokasi="$6" data-dana="$8" data-satuan="$7" data-volume="$9" data-harga="$10" data-total="$11" data-ket="$12"><i class="fa fa-pencil"></i></a> 
            <a href="javascript:void(0)" class="delete_data btn btn-danger btn-xs" data-id="$1" data-uraian="$5"><i class="fa fa-remove"></i></a>',
            'id,
            jenis,
            uraian,
            sub_uraian,
            lokasi,
            sasaran,
            satuan,
            dana,
            volume,
            harga,
            total,
            keterangan');
        $this->datatables->group_by("tb_detail_rekening.id");
        return $this->datatables->generate();
    }

    public function SyncTotalRinci($kodeInstansi,$kodeProgram,$kodeKegiatan,$kodeRekening)
    {
        //Fungsi: update total_rinci rekening
        $this->db->trans_start();
        $selDetail = $this->db->query("select SUM(total) as total from tb_detail_rekening 
                                        where kode_instansi = $kodeInstansi
                                        and kode_program = $kodeProgram
                                        and kode_kegiatan = $kodeKegiatan
                                        and kode_rekening = '".$kodeRekening."' ");
        $row = $selDetail->row();
        $this->db->query("update tb_rekening set total_rinci = " . $row->total . " 
                                where kode_instansi = $kodeInstansi
                                and kode_program = $kodeProgram
                                and kode_kegiatan = $kodeKegiatan
                                and kode_rekening = '" . $kodeRekening . "'");

        $selRekening = $this->db->query("select SUM(total_rinci) as total from tb_rekening
                                        where kode_instansi = $kodeInstansi
                                        and kode_program = $kodeProgram
                                        and kode_kegiatan = $kodeKegiatan");
        $row = $selRekening->row();
        $this->db->query("update tb_kegiatan set total_rinci = " . $row->total . " 
                                where kode_instansi = $kodeInstansi
                                and kode_program = $kodeProgram
                                and kode_kegiatan = $kodeKegiatan");

        $selKegiatan = $this->db->query("select SUM(total_rinci) as total from tb_kegiatan 
                                        where kode_instansi = $kodeInstansi
                                        and kode_program = $kodeProgram");
        $row = $selKegiatan->row();
        $this->db->query("update tb_program set total_rinci = " . $row->total . " 
                                where kode_instansi = $kodeInstansi
                                and kode_program = $kodeProgram");
        
        $this->db->trans_complete();

        if ($this->db->trans_status() == false) {
            log_message();
        }else{
            // $row = array(
            //     'resultDetail' => $selDetail->row(),
            //     'resultRekening' => $selRekening->row(),
            //     'resultKegiatan' => $selKegiatan->row()
            // );
            // $this->db->trans_start();
            // $this->db->query("update tb_rekening set total_rinci = ".$row['resultDetail']->total." 
            //                     where kode_instansi = $kodeInstansi
            //                     and kode_program = $kodeProgram
            //                     and kode_kegiatan = $kodeKegiatan
            //                     and kode_rekening = '" . $kodeRekening . "'");
            // $this->db->query("update tb_kegiatan set total_rinci = " . $row['resultRekening']->total . " 
            //                     where kode_instansi = $kodeInstansi
            //                     and kode_program = $kodeProgram
            //                     and kode_kegiatan = $kodeKegiatan");
            // $this->db->query("update tb_program set total_rinci = " . $row['resultKegiatan']->total . " 
            //                     where kode_instansi = $kodeInstansi
            //                     and kode_program = $kodeProgram");
            // $this->db->trans_complete();
        }

        // $selDetail = $this->db->select("SUM(tb_detail_rekening.total) as total")
        //     ->from("tb_detail_rekening")
        //     ->where("tb_detail_rekening.kode_instansi", $kodeInstansi)
        //     ->where("tb_detail_rekening.kode_program", $kodeProgram)
        //     ->where("tb_detail_rekening.kode_kegiatan", $kodeInstansi)
        //     ->where("tb_detail_rekening.kode_rekening", $kodeRekening)
        //     ->get();
        // $resDetail = $sel->row();
        // $totalDetail = $res->total;
        // $data = array(
        //     'total_rinci' => $totalDetail
        // );
        // $where = array(
        //     'tb_rekening.kode_rekening' => $kodeRekening,
        //     'tb_rekening.kode_instansi' => $kodeInstansi
        // );
        // $update = $this->db->update("tb_rekening", $data, $where);

    }
    
    
}