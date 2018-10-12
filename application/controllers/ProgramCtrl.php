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
            'hak_akses' => 3,
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

    public function DataEdit($id)
    {
        $data = $this->ProgramModel->APIEditInstansi('tb_instansi', $id);
        echo json_encode($data);
    }

    public function EditInstansi()
    {
        $tahun = $this->input->post('editTahun');
        $kodeInstansi = $this->input->post('editId');
        $namaInstansi = $this->input->post('editInstansi');
        $versi = $this->input->post('editVersi');
        $keterangan = $this->input->post('editKet');
        $user = $this->input->post('editUser');
        $pass = $this->input->post('editPass');
        $id = $this->input->post('mainID');

        if ($pass == null) {
            $data = array(
                'tahun' => $tahun,
                'kode_instansi' => $kodeInstansi,
                'nama_instansi' => $namaInstansi,
                'versi' => $versi,
                'keterangan' => $keterangan,
                'username' => $user,
            );
        }else{
            $data = array(
                'tahun' => $tahun,
                'kode_instansi' => $kodeInstansi,
                'nama_instansi' => $namaInstansi,
                'versi' => $versi,
                'keterangan' => $keterangan,
                'username' => $user,
                'password' => md5($pass)
            );
        }
        $this->ProgramModel->UpdateInstansi('tb_instansi',$data, $id);
        $this->session->set_flashdata('msg', 'Data berhasil diedit');
        redirect('ProgramCtrl');
    }

    public function Hapus($id)
    {
        $this->ProgramModel->DeleteInstansi('tb_instansi',$id);
        $this->session->set_flashdata('msg', 'Data Berhasil dihapus');
        redirect('ProgramCtrl');
    }

    //=========================================================================

    public function ProgramDetails($kode)
    {
        if ($_SESSION['username'] != null) {
            $data['kode'] = $kode;
            $data['data'] = $this->ProgramModel->DataProgramDetails($kode)->result();
            $this->load->view('v_programDetails', $data);
        } else {
            redirect('Auth');
        }
    }

    public function TambahProgram()
    {
        $kode = $this->input->post('addKodeProgram');
        $kodeProgram = $this->GenerateKodeProgram($kode);
        $namaProgram = $this->input->post('addNamaProgram');
        $plafon = $this->input->post('addPlafon');
        $idInstansi = $this->input->post('idInstansi');

        $data = array(
            'kode_instansi' => $idInstansi,
            'kode_program' => $kodeProgram,
            'nama_program' => $namaProgram,
            'plafon' => $plafon
        );

        $this->ProgramModel->InsertProgram('tb_program', $data);
        $this->session->set_flashdata('msg', 'Berhasil Menambahkan Program');
        redirect('ProgramCtrl/ProgramDetails/'.$idInstansi);
    }

    private function GenerateKodeInstansi($id)
    {
        $kode = "010.";
        $keygen = $kode.$id;
        return $keygen;
    }

    private function GenerateKodeProgram($id)
    {
        $kode = "127.";
        $keygen = $kode.$id;
        return $keygen;
    }
}
