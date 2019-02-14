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
        if (@$_SESSION['username'] != null) {
            redirect(site_url('InstansiCtrl'));
        }else {
            $data['csrf'] = array(
                'token' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            );
            $this->load->view('LoginMember', $data);
        }
    }

    public function Admin()
    {
        if (@$_SESSION['username'] != null) {
            redirect(site_url('InstansiCtrl'));
        }else {
            $data['csrf'] = array(
                'token' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            );
            $this->load->view('LoginAdmin', $data);
        }
    }

    public function Registrasi()
    {
        if (!isset($_POST['submit'])) {
            $this->load->view("v_registrasi");
        }else {
            $post = $this->input->post();

            $config['upload_path'] = "./assets/images/";
            $config['allowed_types'] = "jpeg|jpg|png";
            $config['encrypt_name'] = TRUE;
            $config['max_size'] = 4096;
            $config['max_width'] = 800;
            $config['max_height'] = 1000;

            $this->load->library("upload", $config);

            if (!$this->upload->do_upload('foto')) {
                $error = array("error" => $this->upload->display_errors());
                $this->load->view("v_registrasi",$error);
            }else{
                $data = array(
                    "nama" => htmlspecialchars($post['nama']),
                    "instansi" => htmlspecialchars($post['instansi']),
                    "jurusan" => htmlspecialchars($post['jurusan']),
                    "nis" => htmlspecialchars($post['nis']),
                    "nisn" => htmlspecialchars($post['nisn']),
                    "no_telp" => htmlspecialchars($post['telpon']),
                    "username" => htmlspecialchars($post['username']),
                    "foto" => $this->upload->data("file_name"),
                    "waktu" => date("Y-m-d")
                );
                $query = $this->db->insert("tb_registrasi", $data);
    
                if ($query) {
                    //IKi lek bener melbu kene, dadi user e oleh informasi ngenteni di acc admin, keki redirect sisan tan
                    $this->load->view("Success");
                }else{
                    //lek salah melbu kene maneh
                    $this->load->view("v_registrasi");
                    $this->session->set_tempflashdata("msg","Terdapat kesalahan saat registrasi, hubungi admin !",5);
                }
            }
        }
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
            $cek = $this->MainModel->verif('tb_instansi',$user,$pass, $hakAkses);
            if(count($cek) > 0){
                foreach ($cek as $res) {
                    $this->session->set_userdata('hakAkses', $res->hak_akses);
                    $this->session->set_userdata('akses', "Instansi");
                    $this->session->set_userdata('versi', $res->versi);
                    $this->session->set_userdata('kota_lokasi', $res->kota_lokasi);
                    $this->session->set_userdata('tahun', $res->tahun);
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
                    $this->session->set_userdata('kode_instansi', $res->kode_instansi);
                    $this->session->set_userdata('kode_program', $res->kode_program);
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