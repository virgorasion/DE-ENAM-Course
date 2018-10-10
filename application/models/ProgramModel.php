<?php 

class ProgramModel extends CI_model
{
    public function DataProgram()
    {
        return $this->db->get('tb_program')->result();
    }

    public function DataProgramDetails()
    {

    }
}