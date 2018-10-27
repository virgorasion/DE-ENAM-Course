<?php   

defined('BASEPATH')or exit('ERROR');

class InstansiCtrl extends CI_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('InstansiModel');
    }

    public function index()
    {
        if ($_SESSION['username'] != null) {
            $data['data'] = $this->InstansiModel->DataProgram();
            $data['instansi'] = $this->InstansiModel->getDataInstansi();
            $this->load->view('v_instansi',$data);
        }else{
            redirect('Auth');
        }
    }

    public function TambahSiswa()
    {
        $post = $this->input->post();
        $data = array(
            'kode_instansi' => $post['addInstansiSiswa'],
            'kode_program' => $post['addProgramSiswa'],
            'nama' => $post['addNamaSiswa'],
            'hak_akses' => 3,
            'nis' => $post['addNisSiswa'],
            'nisn' => $post['addNisnSiswa'],
            'username' => $post['addUserSiswa'],
            'password' => md5($post['addPassSiswa']),
        );
        $nisn = $post['addNisnSiswa'];
        $dataProgram = array(
            'kode_instansi' => $post['addInstansiSiswa'],
            'kode_program' => $post['addProgramSiswa']
        );
        $query = $this->InstansiModel->insertUserSiswa('tb_siswa', $data, $nisn, $dataProgram);
        if ($query != false) {
            $this->session->set_flashdata('succ', 'Berhasil menambah siswa');
            redirect('InstansiCtrl');
        }else {
            $this->session->set_flashdata('fail', 'Username sudah dipakai');
            redirect('InstansiCtrl');
        }
    }

    public function getDataProgramAPI($idInstansi)
    {
        $query = $this->InstansiModel->getDataProgram('tb_program', $idInstansi);
        echo json_encode($query);
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
            'kode_admin' => $_SESSION['kode_admin'],
            'kode_instansi' => $kode,
            'nama_instansi' => $instansi,
            'versi' => $versi,
            'keterangan' => $ket,
            'username' => $user,
            'password' => md5($pass)
        );

        $this->InstansiModel->InsertInstansi('tb_instansi',$data);
        $this->session->set_flashdata('msg', 'Data berhasil ditambahkan');
        redirect('InstansiCtrl');
    }

    public function DataEdit($id)
    {
        $data = $this->InstansiModel->APIEditInstansi('tb_instansi', $id);
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
        $this->InstansiModel->UpdateInstansi('tb_instansi',$data, $id);
        $this->session->set_flashdata('msg', 'Data berhasil diedit');
        redirect('InstansiCtrl');
    }

    public function Hapus($id)
    {
        $this->InstansiModel->DeleteInstansi('tb_instansi',$id);
        $this->session->set_flashdata('msg', 'Data Berhasil dihapus');
        redirect('InstansiCtrl');
    }

    private function GenerateKodeInstansi($id)
    {
        $kode = "010.";
        $keygen = $kode . $id;
        return $keygen;
    }

}
