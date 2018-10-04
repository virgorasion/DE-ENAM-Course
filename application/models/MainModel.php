<?php

class MainModel extends CI_model
{
    public function verif($table,$user,$pass)
    {
        $login = "SELECT * FROM ".$table." WHERE username=".$this->db->escape($user)." AND password= ".$this->db->escape($pass)." ";
        return $this->db->query($login)->result();
    }
}