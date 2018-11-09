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
            $data['patokan'] = $this->ProgramModel->getPatokan();
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

    public function Hapus($idProgram, $idInstansi){
        $query = $this->ProgramModel->DeleteProgram('tb_program',$idProgram);
        if ($query == true) {
            $this->session->set_flashdata('msg', "Program berhasil dihapus");
            redirect('ProgramCtrl/index/'.$idInstansi);
        }else{
            $this->session->set_flashdata('msg', "Program gagal dihapus segera hubungi admin");
            redirect('ProgramCtrl/index/'.$idInstansi);
        }
    }

    private function GenerateKodeProgram($id)
    {
        $kode = "127.";
        $keygen = $kode.$id;
        return $keygen;
    }

    //==============================================================================>>
    // Coding untuk Box Kegiatan

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

    public function EditKegiatan()
    {
        $post = $this->input->post();
        $data = array(
            'kode_kegiatan' => htmlspecialchars("080.".$post['editKodeKegiatan']),
            'nama_kegiatan' => htmlspecialchars($post['editNamaKegiatan']),
            'keterangan' => htmlspecialchars($post['editKeterangan'])
        );
        $where = $post['idKegiatanEdit'];
        $kodeInstansi = $post['kodeInstansiEdit'];
        $kodeProgram = $post['kodeProgramEdit'];
        $query = $this->ProgramModel->EditKegiatan('tb_kegiatan',$data,$where);
        if ($query != null) {
            $this->session->set_flashdata('msgKegiatan', 'Berhasil menambah kegiatan');
            $this->session->set_flashdata('kodeProgram', $kodeProgram);
            redirect('ProgramCtrl/index/' . $kodeInstansi);
        } else {
            $this->session->set_flashdata('msgKegiatan', 'Gagal menambah kegiatan, segera hubungi admin');
            $this->session->set_flashdata('kodeProgram', $kodeProgram);
            redirect('ProgramCtrl/index/' . $kodeInstansi);
        }
    }

    public function HapusKegiatan($idKegiatan,$kodeProgram,$kodeInstansi)
    {
        $query = $this->ProgramModel->DeleteDataKegiatan('tb_kegiatan', $idKegiatan);
        if ($query != null) {
            $this->session->set_flashdata('msgKegiatan', 'Berhasil menambah kegiatan');
            $this->session->set_flashdata('kodeProgram', $kodeProgram);
            redirect('ProgramCtrl/index/' . $kodeInstansi);
        } else {
            $this->session->set_flashdata('msgKegiatan', 'Gagal menambah kegiatan, segera hubungi admin');
            $this->session->set_flashdata('kodeProgram', $kodeProgram);
            redirect('ProgramCtrl/index/' . $kodeInstansi);
        }
    }

    private function generateKodeKegiatan($id)
    {
        $kode = "080.";
        $keygen = $kode . $id;
        return $keygen;
    }

    //==============================================================================>>
    // Coding untuk menu tab Rekening

    public function DataAPIRekening($kodeKegiatan)
    {
        header('Content-Type: application/json');
        echo $this->ProgramModel->getAllRekening('tb_rekening', $kodeKegiatan);
    }

    public function TambahDataRekening()
    {
        $p = $this->input->post();
        $id = $this->generateKodeRekening($p['addKodeRek'],$p['addIdKegRekening']);
        $t1 = explode('.',$p['AddT1']);
        $r1 = implode('',$t1);
        $t2 = explode('.',$p['AddT2']);
        $r2 = implode('',$t2);
        $t3 = explode('.',$p['AddT3']);
        $r3 = implode('',$t3);
        $t4 = explode('.',$p['AddT4']);
        $r4 = implode('',$t4);
        $data = array(
            'kode_patokan' => $p['addKodeRek'],
            'kode_rekening' => $p['addKodeRek'] .".". $id,
            'kode_kegiatan' => $p['addIdKegRekening'],
            'uraian_rekening' => $p['AddNamaRek'],
            'triwulan_1' => $r1,
            'triwulan_2' => $r2,
            'triwulan_3' => $r3,
            'triwulan_4' => $r4
        );
        $kodeKeg = $p['addIdKegRekening'];
        $kodeIns = $p['addIdInsRekening'];
        $query = $this->ProgramModel->InsertDataRekening('tb_rekening', $data);
        if ($query != null) {
            $this->session->set_flashdata('msgRekening', 'Berhasil menambah rekening');
            $this->session->set_flashdata('kodeKegiatan', $kodeKeg);
            redirect('ProgramCtrl/index/' . $kodeIns);
        } else {
            $this->session->set_flashdata('msgRekening', 'Gagal menambah rekening, segera hubungi admin');
            $this->session->set_flashdata('kodeKegiatan', $kodeKeg);
            redirect('ProgramCtrl/index/' . $kodeIns);
        }
    }

    private function generateKodeRekening($kodePatokan,$kodeKegiatan)
    {
        $query = $this->db->select_max('kode_rekening')->from('tb_rekening')->where('kode_patokan',$kodePatokan)->where('kode_kegiatan',$kodeKegiatan)->get();
        $getRek = $query->row();
        $kodeRek = $getRek->kode_rekening;
        $potong = substr($kodeRek, 7);
        $res = $potong+1;
        $result = str_pad($res, 2, "0", STR_PAD_LEFT);
        return $result;
    }
    
}