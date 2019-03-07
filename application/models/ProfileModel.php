<?php

/**
 * Author : Virgorasion
 */
class ProfileModel extends CI_model
{
    public function getDataInstansi($kodeInstansi = NULL)
    {
        $this->datatables->select("kode_instansi,nama_instansi,versi,kota_lokasi as lokasi,keterangan,tahun,username,password,foto");
        $this->datatables->from("tb_instansi");
        if (@$_SESSION['hakAkses'] == 2) {
            $this->datatables->where("kode_instansi", $kodeInstansi);
        }
        function callback_button($kode_instansi,$nama,$versi,$lokasi,$keterangan,$tahun,$username,$password,$foto)
        {
            if (@$_SESSION['kode_instansi'] == $kode_instansi && @$_SESSION['hakAkses'] == 2) {
                $btn = '<center><a href="javascript:void(0)" class="view_data btn btn-info btn-xs" data-instansi="'.$kode_instansi.'"><i class="fa fa-users"></i></a></center>';
                return $btn;
            }elseif (@$_SESSION['hakAkses'] == 1) {
                $pass = base64_decode($password);
                $btn = '<center>
                <a href="javascript:void(0)" class="view_data btn btn-info btn-xs" data-instansi="'.$kode_instansi.'" data-nama="'.$nama.'" data-versi="'.$versi.'" data-lokasi="'.$lokasi.'" data-keterangan="'.$keterangan.'" data-tahun="'.$tahun.'" data-username="'.$username.'" data-password="'.$pass.'" data-foto="'.$foto.'"><i class="fa fa-eye"></i></a>
                <a href="javascript:void(0)" class="view_siswa btn btn-primary btn-xs" data-instansi="'.$kode_instansi.'"><i class="fa fa-users"></i></a>
                <a href="javascript:void(0)" class="edit_data btn btn-warning btn-xs" data-instansi="'.$kode_instansi.'" data-nama="'.$nama.'" data-versi="'.$versi.'" data-lokasi="'.$lokasi.'" data-keterangan="'.$keterangan.'" data-tahun="'.$tahun.'" data-username="'.$username.'" data-password="'.$pass.'" data-foto="'.$foto.'"><i class="fa fa-pencil"></i></a>
                <a href="javascript:void(0)" class="delete_data btn btn-danger btn-xs" data-instansi="'.$kode_instansi.'" data-nama="'.$nama.'"><i class="fa fa-trash"></i></a></center>';
                return $btn;
            }
        }
        $this->datatables->add_column(
            'view',
            '$1',
            'callback_button(kode_instansi,nama_instansi,versi,lokasi,keterangan,tahun,username,password,foto)'
        );
        return $this->datatables->generate();
    }

    public function getDataRegistration()
    {
        $this->datatables->select("id,nama,instansi,jurusan,nis,nisn,no_telp,username,foto,DATE_FORMAT(waktu, '%d %M %Y') as waktu");
        $this->datatables->from("tb_registrasi");
        $this->datatables->add_column(
            'Action',
            '<center><a href="javascript:void(0)" class="btn_add btn btn-primary btn-xs" data-id="$1" data-nama="$2" data-instansi="$3" data-jurusan="$4" data-nis="$5" data-nisn="$6" data-telp="$7" data-username="$8" data-foto="$9"><i class="fa fa-plus-circle"></i></a>
            <a href="javascript:void(0)" class="btn_delete btn btn-danger btn-xs" data-id="$1" data-nama="$2"><i class="fa fa-trash"></i></a></center>',
            'id,nama,instansi,jurusan,nis,nisn,no_telp,username,foto'
        );
        return $this->datatables->generate();
    }

    public function getDataSiswa($kodeInstansi)
    {
        $this->datatables->select("tb_siswa.id_siswa,tb_siswa.nama,tb_siswa.nis,tb_siswa.nisn,tb_siswa.nomor_hp,tb_siswa.password,tb_siswa.jurusan,tb_instansi.nama_instansi,tb_siswa.foto,tb_siswa.username,tb_siswa.kode_instansi,tb_siswa.kode_program");
        $this->datatables->from("tb_siswa");
        $this->datatables->join("tb_instansi", "tb_instansi.kode_instansi = tb_siswa.kode_instansi");
        $this->datatables->where("tb_siswa.kode_instansi", $kodeInstansi);
        if (@$_SESSION['hakAkses'] != 3) {
            function callback_password($password)
            {
                $result = base64_decode($password);
                return $result;
            }
            $this->datatables->add_column(
                'action',
                '<center><a href="javascript:void(0)" class="btn-view btn btn-primary btn-xs" data-id="$1" data-nama="$2" data-nis="$3" data-nisn="$4" data-nope="$5" data-password="$6" data-jurusan="$7" data-instansi="$8" data-foto="$9" data-username="$10"><i class="fa fa-eye"></i></a>
                <a href="javascript:void(0)" class="btn-edit btn btn-warning btn-xs" data-id="$1" data-nama="$2" data-nis="$3" data-nisn="$4" data-nope="$5" data-password="$6" data-jurusan="$7" data-kodeInstansi="$11" data-username="$10" data-kodeProgram="$12"><i class="fa fa-pencil"></i></a>
                <a href="javascript:void(0)" class="btn-delete btn btn-danger btn-xs" data-id="$1" data-nama="$2"><i class="fa fa-remove"></i></a></center>',
                'id_siswa,nama,nis,nisn,nomor_hp,callback_password(password),jurusan,instansi,foto,username,kode_instansi,kode_program'
            );
        }
        return $this->datatables->generate();
    }

    public function getDataProgramAPI($kodeInstansi,$idSiswa)
    {
        return $this->db->select("nama_program,kode_program")->from("tb_program")->where("kode_instansi",$kodeInstansi)->where("id_siswa",0)->or_where("id_siswa",$idSiswa)->get()->result();
    }

    public function dataInstansi($kodeInstansi)
    {
        return $this->db->select('*')->from('tb_instansi')->where('kode_instansi', $kodeInstansi)->get()->result();
    }

    public function dataAdmin($kodeAdmin)
    {
        return $this->db->select('*')->from('tb_admin')->where('kode_admin', $kodeAdmin)->get()->result();
    }

    public function dataSiswa($idSiswa)
    {
        return $this->db->select('tb_siswa.password,tb_siswa.jurusan,tb_siswa.nomor_hp,tb_instansi.nama_instansi,tb_program.nama_program,tb_siswa.foto')
                        ->from('tb_siswa')
                        ->join("tb_instansi", "tb_instansi.kode_instansi = tb_siswa.kode_instansi")
                        ->join("tb_program", "tb_program.kode_program = tb_siswa.kode_program")
                        ->where('tb_siswa.id_siswa', $idSiswa)
                        ->where("tb_instansi.kode_instansi", @$_SESSION['kode_instansi'])
                        ->where("tb_program.kode_program", @$_SESSION['kode_program'])
                        ->get()->result();
    }

    public function getNamaInstansi()
    {
        return $this->db->select("kode_instansi,nama_instansi")->from("tb_instansi")->get()->result();
    }

    public function insertUserSiswa($table, $data, $nisn, $dataProgram,$id)
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
            $this->db->delete("tb_registrasi",$id);
            return true;
        }else{
            return false;
        }
    }

    public function editData($table,$data,$where)
    {
        return $this->db->update($table,$data,$where);
    }

    public function DeleteData($table,$data)
    {
        return $this->db->delete($table,$data);
    }
}
