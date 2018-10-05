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
        $data['csrf'] = array(
            'token' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->load->view('Login', $data);
    }
    
    public function login()
    {
        $user = $this->input->post('username');
        $pass = md5($this->input->post('password'));
        $userType = $this->input->post('userType');
        $cek = "";
        if ($userType == 1) {
            $cek = $this->MainModel->verif('login_admin',$user, $pass, $userType);
        } else if($userType == 2){
            $cek = $this->MainModel->verif('login_sekolah',$user,$pass, $userType);
        }else if($userType == 3){
            $cek = $this->MainModel->verif('login_siswa',$user,$pass, $userType);
        }else{
            $data['msg'] = "Error, Silahkan Refresh Halaman";
                $this->load->view('login', $data);
        }

        if (count($cek) > 0) {
           foreach ($cek as $row)
            {                   
                $this->session->set_userdata("username",$row->username);
                $this->session->set_userdata("nama",$row->nama);
                $this->session->set_userdata("id",$row->id);
                redirect(site_url('Home'));
            }
        }else{
                $data['msg'] = "Username/Password Salah";
                $this->index();
            }
    }
}