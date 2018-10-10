<?php

defined('BASEPATH')or exit('ERROR');

class ProgramCtrl extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ProgramModel');
    }

    public function index()
    {
        if ($_SESSION['username'] != null) {
            $data['data'] = $this->ProgramModel->DataProgram();
            $this->load->view('v_home',$data);
        }else{
            redirect('Auth');
        }
    }

    public function ProgramDetails($kode)
    {
        if ($_SESSION['username'] != null) {
            $this->load->view('v_homeDetails',$kode);
        }else{
            redirect('Auth');
        }
    }
    
}
