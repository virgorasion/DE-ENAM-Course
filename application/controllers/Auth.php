<?php 

defined('BASEPATH')or exit('ERROR');

class Auth extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MainModel');
    }

    public function index()
    {
        $data['csrf'] = array(
            'token' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->load->view('LoginNew',$data);
    }

    public function test(){
        echo "asdasd";
    }

    public function login()
    {
        $user = $this->input->post('username');
        $pass = md5($this->input->post('password'));
        $hakAkses = $this->input->post('hakAkses');
        $cek = "";
        if ($hakAkses == 1) {
            $cek = $this->MainModel->verif('tb_admin',$user, $pass, $hakAkses);
            if(count($cek) > 0){
                foreach ($cek as $res) {
                    $this->session->set_userdata('hakAkses', $res->hak_akses);
                    $this->session->set_userdata('akses', "Admin");
                    $this->session->set_userdata('username', $res->username);
                    $this->session->set_userdata('nama', $res->nama);
                    $this->session->set_userdata('id', $res->id);
                    $this->session->set_userdata('kode_admin', $res->kode_admin);
                    redirect(site_url('InstansiCtrl'));
                }
            }else{
                $this->session->set_flashdata('msg', 'Username/Password anda salah');
                redirect(site_url('Auth'));
            }
        } else if($hakAkses == 2){
            $cek = $this->MainModel->verif('tb_instasi',$user,$pass, $hakAkses);
            if(count($cek) > 0){
                foreach ($cek as $res) {
                    $this->session->set_userdata('hakAkses', $res->hak_akses);
                    $this->session->set_userdata('akses', "Instansi");
                    $this->session->set_userdata('username', $res->username);
                    $this->session->set_userdata('nama', $res->nama_instansi);
                    $this->session->set_userdata('kode_instansi', $res->kode_instansi);
                    $this->session->set_userdata('id', $res->id);
                    redirect(site_url('InstansiCtrl'));
                }
            }else{
                $this->session->set_flashdata('msg', 'Username/Password anda salah');
                redirect(site_url('Auth'));
            }
        }else if($hakAkses == 3){
            $cek = $this->MainModel->verif('tb_siswa',$user,$pass, $hakAkses);
            if(count($cek) > 0){
                foreach ($cek as $res) {
                    $this->session->set_userdata('id_siswa', $res->id_siswa);
                    $this->session->set_userdata('hakAkses', $res->hak_akses);
                    $this->session->set_userdata('instansiSiswa', $res->kode_instansi);
                    $this->session->set_userdata('programSiswa', $res->kode_program);
                    $this->session->set_userdata('akses', "Siswa");
                    $this->session->set_userdata('nama', $res->nama);
                    $this->session->set_userdata('username', $res->username);
                    $this->session->set_userdata('nis', $res->nis);
                    $this->session->set_userdata('nisn', $res->nisn);
                    redirect(site_url('InstansiCtrl'));
                }
            }else{
                $this->session->set_flashdata('msg', 'Username/Password anda salah');
                redirect(site_url('Auth'));
            }
        }else{
            $this->session->set_flashdata('msg', 'Akses tidak diketahui silahkan refresh halaman');
            redirect(site_url('Auth'));
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(site_url('Auth'));
    }

}