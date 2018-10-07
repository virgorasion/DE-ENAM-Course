<?php 

defined('BASEPATH')or exit('ERROR');

class MainController extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MainModel');
    }

    public function index()
    {
        $this->load->view('Login');
    }
    
    public function login()
    {
        $user = $this->input->post('username');
        $pass = md5($this->input->post('password'));
        $hakAkses = $this->input->post('hakAkse');
        $cek = "";
        if ($hakAkses == 1) {
            $cek = $this->MainModel->verif('tb_admin',$user, $pass, $hakAkses);
        } else if($hakAkses == 2){
            $cek = $this->MainModel->verif('tb_sekolah',$user,$pass, $hakAkses);
        }else if($hakAkses == 3){
            $cek = $this->MainModel->verif('tb_siswa',$user,$pass, $hakAkses);
        }else{
            $this->session->set_flashdata('msg', 'Akses tidak diketahui silahkan refresh halaman');
            redirect(site_url('MainController'));
        }

        if (count($cek) > 0) {
           foreach ($cek as $row)
            {                   
                $this->session->set_userdata("username",$row->username);
                $this->session->set_userdata("nama",$row->nama);
                $this->session->set_userdata("id",$row->id);
                redirect('Home');
            }
        }else{
                $this->session->set_flashdata('msg', 'Username/Password anda salah');
                redirect(site_url('MainController'));
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(site_url('MainController'));
    }

}