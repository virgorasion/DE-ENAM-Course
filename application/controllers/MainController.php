<?php 

defined('BASEPATH')or exit('ERROR');

class MainController extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['csrf'] = array(
            'token' => $this->security->get_csrf_token_name(),
            'hash' => $this->security->get_csrf_hash()
        );
        $this->load->view('Login', $data);
    }
    
    public function verification()
    {
        csrf_verify();
        $user = $this->input->post('username');
        $pass = $this->input->post('password');
        $userType = $this->input->post('userType');
        if ($userType == 1) {
            $cek = $this->MainModel->verif('login_admin',$user, $password);
        } else if($userType == 2){
            $cek = $this->MainModel->verif('sekolah_login',$user,$password);
        }else if($userType == 3){
            $cek = $this->MainModel->verif('siswa_login',$user,$password);
        }else{
            $data['msg'] = "Error, Silahkan Refresh Halaman";
                $this->load->view('login', $data);
        }

        die(var_dump($cek));

        if (count($cek) > 0) {
           foreach ($cek as $row)
            {                   
                $this->session->set_userdata("username",$row->username);
                $this->session->set_userdata("nama",$row->nama);
                $this->session->set_userdata("id",$row->id_admin);
                $this->session->set_userdata("menu",$this->generatemenu());
                $this->set_hak_akses();
                redirect(site_url('Home'));
            }
        }else{
                $data['msg'] = "Username/Password Salah";
                $this->load->view('login', $data);
            }
    }
}