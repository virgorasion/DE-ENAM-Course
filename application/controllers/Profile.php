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
            $this->load->view('v_profile');
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
}
