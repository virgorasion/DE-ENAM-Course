<?php 

defined('BASEPATH')or exit('ERROR');

class ProgramCtrl extends CI_controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('ProgramModel');
        $this->load->library('datatables');
    }

    public function index($kodeInstansi)
    {
        if ($_SESSION['username'] != null) {
            $data['kode'] = $kodeInstansi;
            $data['data'] = $this->ProgramModel->DataProgram($kodeInstansi)->result();
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

        if ($_SESSION['akses'] == 'Admin') {
            $data = array(
                'kode_admin' => $_SESSION['kode_admin'],
                'kode_instansi' => $idInstansi,
                'kode_program' => $kodeProgram,
                'nama_program' => $namaProgram,
                'plafon' => $plafon
            );
        }else {
            $data = array(
                'kode_admin' => 0,
                'kode_instansi' => $idInstansi,
                'kode_program' => $kodeProgram,
                'nama_program' => $namaProgram,
                'plafon' => $plafon
            );
        }

        $this->ProgramModel->InsertProgram('tb_program', $data);
        $this->session->set_flashdata('msg', 'Berhasil Menambahkan Program');
        redirect('ProgramCtrl/index/' . $idInstansi);
    }

    public function EditProgram()
    {
        $post = $this->input->post();
        if ($_SESSION['akses'] == 'Admin') {
            $data = array(
                'kode_program' => $post['editKodeProgram'],
                'nama_program' => $post['editNamaProgram'],
                'plafon' => $post['editPlafon'],
                'kode_instansi' => $post['idInstansiEdit']
            );
        }else {
            $data = array(
                'kode_admin' => $_SESSION['kode_admin'],
                'kode_program' => $post['editKodeProgram'],
                'nama_program' => $post['editNamaProgram'],
                'plafon' => $post['editPlafon'],
                'kode_instansi' => $post['idInstansiEdit']
            );
        }
        $kodeInstansi = $post['idInstansiEdit'];
        $id = $post['programIdEdit'];
        $query = $this->ProgramModel->updateDataProgram('tb_program',$data,$id);
        if ($query != 0) {
            $this->session->set_flashdata('succ', 'Berhasil edit data program');
            redirect('ProgramCtrl/index/'.$kodeInstansi);
        }else{
            $this->session->set_flashdata('fail', 'Gagal edit data, segera hubungi admin');
            redirect('ProgramCtrl/index/' . $kodeInstansi);
        }
    }

    public function DataEditProgramInstansi($id)
    {
        $query = $this->ProgramModel->APIDataEditProgramInstansi('tb_program', $id)->result();

        echo json_encode($query);
    }

    private function GenerateKodeProgram($id)
    {
        $kode = "127.";
        $keygen = $kode.$id;
        return $keygen;
    }

    //==============================================================================>>

    public function DataTableApi($kodeInstansi,$kodeProgram)
    {
        header('Content-Type: application/json');
        echo $this->ProgramModel->getDataKegiatan($kodeInstansi, $kodeProgram);
    }

    public function TambahKegiatan()
    {
        $post = $this->input->post();
        $kodeKegiatan = $this->generateKodeKegiatan($post['addKodeKegiatan']);
        $data = array(
            'kode_instansi' => $post['kodeInstansi'],
            'kode_program' => $post['kodeProgram'],
            'kode_kegiatan' => $kodeKegiatan,
            'nama_kegiatan' => $post['addNamaKegiatan'],
            'keterangan' => $post['addKeterangan']
        );
        $query = $this->ProgramModel->insertKegiatan('tb_kegiatan',$data);
        $kodeInstansi = $post['kodeInstansi'];
        $kodeProgram = $post['kodeProgram'];

        if ($query != null) {
            $this->session->set_flashdata('msgKegiatan', 'Berhasil menambah kegiatan');
            $this->session->set_flashdata('kodeProgram', $kodeProgram);
            redirect('ProgramCtrl/index/'.$kodeInstansi);
        }else{
            $this->session->set_flashdata('msgKegiatan', 'Gagal menambah kegiatan, segera hubungi admin');
            $this->session->set_flashdata('kodeProgram', $kodeProgram);
            redirect('ProgramCtrl/index/'.$kodeInstansi);
        }
    }

    private function generateKodeKegiatan($id)
    {
        $kode = "080.";
        $keygen = $kode . $id;
        return $keygen;
    }
    
}