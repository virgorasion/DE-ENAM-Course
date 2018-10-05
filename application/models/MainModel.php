<?php

class MainModel extends CI_model
{
    public function verif($table,$user,$pass,$userType)
    {
        $login = "SELECT * FROM ".$table." WHERE username=".$this->db->escape($user)." AND password= ".$this->db->escape($pass)." AND hak_akses= ".$userType." ";
        return $this->db->query($login)->result();
    }
}