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
        $lokasi = $this->input->post('addLokasi');
        $ket = $this->input->post('Ket');
        $user = $this->input->post('addUser');
        $pass = $this->input->post('addPass');

        $data = array(
            'tahun' => $tahun,
            'hak_akses' => 2,
            'kode_admin' => $_SESSION['kode_admin'],
            'kode_instansi' => $kode,
            'nama_instansi' => $instansi,
            'versi' => $versi,
            'kota_lokasi' => $lokasi,
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
        $lokasi = $this->input->post('editLokasi');
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
                'kota_lokasi' => $lokasi,
                'keterangan' => $keterangan,
                'username' => $user,
            );
        }else{
            $data = array(
                'tahun' => $tahun,
                'kode_instansi' => $kodeInstansi,
                'nama_instansi' => $namaInstansi,
                'versi' => $versi,
                'kota_lokasi' => $lokasi,
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
