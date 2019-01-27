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
    }

    public function index()
    {
        if ($_SESSION['username'] != null) {
            $this->load->view('v_profile');
        }else {
            $data['csrf'] = array(
                'token' => $this->security->get_csrf_token_name(),
                'hash' => $this->security->get_csrf_hash()
            );
            $this->load->view('LoginMember', $data);
        }
    }
}
