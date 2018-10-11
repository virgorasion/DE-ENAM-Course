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
            $this->load->view('v_program',$data);
        }else{
            redirect('Auth');
        }
    }

    public function ProgramDetails($kode)
    {
        if ($_SESSION['username'] != null) {
            $data['data'] = $this->ProgramModel->DataProgramDetails($kode)->result();
            $this->load->view('v_programDetails',$data);
        }else{
            redirect('Auth');
        }
    }

    public function TambahInstansi()
    {
        $tahun = $this->input->post('addTahun');
        $id = $this->input->post('addId');
        $kode = $this->GenerateKodeInstansi($id);
        $instansi = $this->input->post('addInstansi');
        $versi = $this->input->post('addVersi');
        $ket = $this->input->post('Ket');
        $user = $this->input->post('addUser');
        $pass = $this->input->post('addPass');

        $data = array(
            'tahun' => $tahun,
            'kode_instansi' => $kode,
            'nama_instansi' => $instansi,
            'versi' => $versi,
            'keterangan' => $ket,
            'username' => $user,
            'password' => md5($pass)
        );

        $this->ProgramModel->InsertInstansi('tb_instansi',$data);
        $this->session->set_flashdata('msg', 'Data berhasil ditambahkan');
        redirect('ProgramCtrl');
    }

    private function GenerateKodeInstansi($id)
    {
        $kode = "010.";
        $keygen = $kode.$id;
        return $keygen;
    }

    public function DataEdit($id)
    {
        $data = $this->ProgramModel->APIEditInstansi('tb_instansi',$id);
        echo json_encode($data);
    }
    
}
