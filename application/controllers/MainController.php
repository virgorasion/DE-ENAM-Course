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
        $this->load->view('Login');
    }
    
    public function verification()
    {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $user = $this->input->post('username');
        $pass = $this->input->post('password');
        if($this->form_validation->run() != false ){
            echo "Succes";
        }else{
            $this->load->view('login');
        }
        
    }
}