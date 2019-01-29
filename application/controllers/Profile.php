<?php
defined("BASEPATH")or exit("ERROR");

/**
 *  Author: Virgorasion
 */
class Profile extends CI_controller
{
    
    function __construct()
    {
        parent::__construct();
        $this->load->model("ProfileModel");
        $this->load->library("datatables");
    }

    public function index()
    {
        if (@$_SESSION['username'] != null) {
            $data = "";
            if ($_SESSION['hakAkses'] == 1) {
                $data = $this->ProfileModel->dataAdmin(@$_SESSION['kode_admin']);
            }elseif ($_SESSION['hakAkses'] == 2) {
                $data = $this->ProfileModel->dataInstansi(@$_SESSION['kode_instansi']);
            }elseif ($_SESSION['hakAkses'] == 3) {
                $data = $this->ProfileModel->dataSiswa(@$_SESSION['id_siswa']);
            }
            $data['data'] = $data;
            $this->load->view('v_profile',$data);
        }else {
            $data['csrf'] = array(
                'token' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            );
            $this->load->view('LoginMember', $data);
        }
    }

    public function DataInstansiAPI($kodeInstansi = NULL)
    {
        header("Content-Type: application/json");
        echo $this->ProfileModel->getDataInstansi($kodeInstansi);
    }

    public function DataSiswaAPI($kodeInstansi)
    {
        header("Content-Type: application/json");
        echo $this->ProfileModel->getDataSiswa($kodeInstansi);
    }

    public function UbahData()
    {
        $p = $this->input->post();
        $query = "";
        if ($p['ubahPassword'] == "") {
            if ($_SESSION['hakAkses'] == 1) {
                $data = array(
                    'username' => $p['ubahUsername']
                );
                $query = $this->db->update("tb_admin",$data,$_SESSION['id_admin']);
            }elseif ($_SESSION['hakAkses'] == 2) {
                $data = array(
                    'username' => $p['ubahUsername']
                );
                $query = $this->db->update("tb_instansi",$data,$_SESSION['kode_instansi']);
            }elseif ($_SESSION['hakAkses'] == 3) {
                $data = array(
                    'username' => $p['ubahUsername']
                );
                $query = $this->db->update("tb_siswa",$data,$_SESSION['id_siswa']);
            }
        }else {
            if ($_SESSION['hakAkses'] == 1) {
                $data = array(
                    'username' => $p['ubahUsername'],
                    'password' => md5($p['ubahPassword'])
                );
                $query = $this->db->update("tb_admin",$data,array('kode_admin' => $_SESSION['kode_admin']));
            }elseif ($_SESSION['hakAkses'] == 2) {
                $data = array(
                    'username' => $p['ubahUsername'],
                    'password' => md5($p['ubahPassword'])
                );
                $query = $this->db->update("tb_instansi",$data,array('kode_instansi' => $_SESSION['kode_instansi']));
            }elseif ($_SESSION['hakAkses'] == 3) {
                $data = array(
                    'username' => $p['ubahUsername'],
                    'password' => md5($p['ubahPassword'])
                );
                $query = $this->db->update("tb_siswa",$data,array('id_siswa' => $_SESSION['id_siswa']));
            }
        }
        if ($query) {
            $this->session->set_tempdata('succ', 'Berhasil Ubah Data Profile',5);
            redirect(site_url("Profile"));
        }else {
            $this->session->set_tempdata('fail', 'Gagal Ubah Data Profile, hubungi admin !',5);
            redirect(site_url("Profile"));
        }
    }
}
