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
            $kodeInstansi = $kodeInstansi
            $data['kode'] = $kodeInstansi;
            $data['data'] = $this->ProgramModel->DataProgramDetails($kodeInstansi)->result();
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
        redirect('ProgramCtrl/index/' . $idInstansi);
    }

    public function EditProgram()
    {
        $post = $this->input->post();
        print_r($post);
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
        $data = array(
            'kode_instansi' => $post['kodeInstansi'],
            'kode_program' => $post['kodeProgram'],
            'kode_kegiatan' => $post['addKodeKegiatan'],
            'nama_kegiatan' => $post['addNamaKegiatan'],
            'keterangan' => $post['addKeterangan'],
            'total_rekening' => $post['addTotalRek'],
            'total_rinci' => $post['addTotalRinci']
        );
        $query = $this->ProgramModel->insertKegiatan('tb_kegiatan',$data);

        if ($query != null) {
            $this->session->set_flashdata('msgKegiatan', 'Berhasil menambah kegiatan');
            redirect('ProgramCtrl/'.$post['kode_instansi']);
        }else{
            $this->session->set_flashdata('msgKegiatan', 'Gagal menambah kegiatan, segera hubungi admin');
            redirect('ProgramCtrl/'.$post['kode_instansi']);
        }
    }
    
}