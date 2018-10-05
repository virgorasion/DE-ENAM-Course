<?php

defined('BASEPATH')or exit('ERROR');

class Home extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('v_home');
    }
    
}
