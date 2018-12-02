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

        $this->ProgramModel->ActionInsert('tb_program', $data);
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
        $query = $this->ProgramModel->ActionInsert('tb_kegiatan',$data);
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

    public function ActionRekening()
    {
        $p = $this->input->post();
        $t1 = explode('.',$p['AddT1']);
        $r1 = implode('',$t1);
        $t2 = explode('.',$p['AddT2']);
        $r2 = implode('',$t2);
        $t3 = explode('.',$p['AddT3']);
        $r3 = implode('',$t3);
        $t4 = explode('.',$p['AddT4']);
        $r4 = implode('',$t4);
        $kodeInstansi = $p['KodeInstansiRekening'];
        $kodeProgram = $p['KodeProgramRekening'];
        $kodeKegiatan = $p['KodeKegiatanRekening'];
        if ($p['actionTypeRekening'] == "add") {
            $kodeRekening = $this->generateKodeRekening($p['addKodeRek'],$p['KodeKegiatanRekening'],$p['KodeProgramRekening'],$p['KodeInstansiRekening']);
            $data = array(
                'kode_patokan' => $p['addKodeRek'],
                'kode_instansi' => $p['KodeInstansiRekening'],
                'kode_program' => $p['KodeProgramRekening'],
                'kode_kegiatan' => $p['KodeKegiatanRekening'],
                'kode_rekening' => $kodeRekening,
                'uraian_rekening' => $p['addNamaRek'],
                'triwulan_1' => $r1,
                'triwulan_2' => $r2,
                'triwulan_3' => $r3,
                'triwulan_4' => $r4
            );
            $query = $this->ProgramModel->ActionInsert('tb_rekening', $data);
        }else{
            $kodeRekening = $this->generateKodeRekening($p['addKodeRek'], $p['KodeKegiatanRekening'], $p['KodeProgramRekening'], $p['KodeInstansiRekening'],$p['KodeRekeningRekening']);
            $data = array(
                'kode_patokan' => $p['addKodeRek'],
                'kode_rekening' => $kodeRekening,
                'kode_instansi' => $p['KodeInstansiRekening'],
                'kode_program' => $p['KodeProgramRekening'],
                'kode_kegiatan' => $p['KodeKegiatanRekening'],
                'uraian_rekening' => $p['addNamaRek'],
                'triwulan_1' => $r1,
                'triwulan_2' => $r2,
                'triwulan_3' => $r3,
                'triwulan_4' => $r4
            );
            $mainID = $p['IDRekening'];
            $query = $this->ProgramModel->EditDataRekening('tb_rekening', $data, $mainID);
        }
        if ($query != null) {
            $this->session->set_flashdata('succ', 'Berhasil menambah rekening');
            $this->session->set_flashdata('Rekening_Direct', "Direction");
            $this->session->set_flashdata('Rekening_KodeInstansi', $kodeInstansi);
            $this->session->set_flashdata('Rekening_KodeProgram', $kodeProgram);
            $this->session->set_flashdata('Rekening_KodeKegiatan', $kodeKegiatan);
            redirect('ProgramCtrl/index/' . $kodeInstansi);
        } else {
            $this->session->set_flashdata('fail', 'Gagal menambah rekening, segera hubungi admin');
            $this->session->set_flashdata('Rekening_Direct', "Direction");
            $this->session->set_flashdata('Rekening_KodeInstansi', $kodeInstansi);
            $this->session->set_flashdata('Rekening_KodeProgram', $kodeProgram);
            $this->session->set_flashdata('Rekening_KodeKegiatan', $kodeKegiatan);
            redirect('ProgramCtrl/index/' . $kodeInstansi);
        }
    }

    public function HapusRekening($idRekening, $kodeInstansi, $kodeProgram, $kodeKegiatan)
    {
        $query = $this->ProgramModel->DeleteDataRekening('tb_rekening', $idRekening);
        if ($query != null) {
            $this->session->set_flashdata('succ', 'Berhasil hapus rekening');
            $this->session->set_flashdata('Rekening_Direct', "Direction");
            $this->session->set_flashdata('Rekening_KodeInstansi', $kodeInstansi);
            $this->session->set_flashdata('Rekening_KodeProgram', $kodeProgram);
            $this->session->set_flashdata('Rekening_KodeKegiatan', $kodeKegiatan);
            redirect('ProgramCtrl/index/' . $kodeInstansi);
        } else {
            $this->session->set_flashdata('fail', 'Gagal hapus rekening, segera hubungi admin');
            $this->session->set_flashdata('Rekening_Direct', "Direction");
            $this->session->set_flashdata('Rekening_KodeInstansi', $kodeInstansi);
            $this->session->set_flashdata('Rekening_KodeProgram', $kodeProgram);
            $this->session->set_flashdata('Rekening_KodeKegiatan', $kodeKegiatan);
            redirect('ProgramCtrl/index/' . $kodeInstansi);
        }
    }
    

    private function generateKodeRekening($kodePatokan,$kodeKegiatan,$kodeProgram,$kodeInstansi,$kodeRekening = NULL)
    {
        if ($kodeRekening == "") {
            $query = $this->db->select_max('kode_rekening')->from('tb_rekening')
                                ->where('kode_patokan',$kodePatokan)
                                ->where('kode_kegiatan',$kodeKegiatan)
                                ->where('kode_program',$kodeProgram)
                                ->where('kode_instansi',$kodeInstansi)
                                ->get();
            $getRek = $query->row();
            $kodeRek = $getRek->kode_rekening; // if(null):null ? 5.1.1.01
            $potong = substr($kodeRek, -2); // 01
            $tambah = $potong+1; // 02
            $pad = str_pad($tambah, 2, "0", STR_PAD_LEFT); //02
            $result = $kodePatokan.".".$pad;
            return $result;
        }else {
            $currentKode = substr($kodeRekening, 0, -2);
            $kodeID = substr($kodeRekening, -2);
            if ($kodePatokan == $currentKode) {
                $result = $kodePatokan;
                return $result;
            } else {
                $query = $this->db->select_max('kode_rekening')->from('tb_rekening')
                    ->where('kode_patokan', $kodePatokan)
                    ->where('kode_kegiatan', $kodeKegiatan)
                    ->where('kode_program', $kodeProgram)
                    ->where('kode_instansi', $kodeInstansi)
                    ->get();
                $getRek = $query->row();
                $kodeRek = $getRek->kode_rekening; // if(null):null ? 5.1.1.01
                $potong = substr($kodeRek, -2); // 01
                $tambah = $potong + 1; // 02
                $pad = str_pad($tambah, 2, "0", STR_PAD_LEFT); //02
                $result = $kodePatokan . "." . $pad;
                return $result;
            }
        }
    }

    //==============================================================================>>
    // Detail Rekening Code

    public function DataDetailRekening($kodeRekening) //Json DetailRekekning
    {
        header("Content-Type: application/json");
        echo $this->ProgramModel->getDetailRekening("tb_detail_rekening",$kodeRekening);
    }

    public function TambahDetailRekening()
    {
        $p = $this->input->post();
        $kodeInstansi = $p['KodeInstansiDetailRekening'];
        $kodeProgram = $p['KodeProgramDetailRekening'];
        $kodeKegiatan = $p['KodeKegiatanDetailRekening'];
        $kodeRekening = $p['KodeRekeningDetailRekening'];
        if ($p['actionTypeDetailRekening'] == "add") {
            $id = $this->generateKodeDetailRekening($p['KodeRekeningDetailRekening'], $p['IdRekening']);
            $data = array(
                'kode_detail_rekening' => $p['KodeRekeningDetailRekening'] .".". $id,
                'kode_instansi' => $p['KodeInstansiDetailRekening'],
                'kode_program' => $p['KodeProgramDetailRekening'],
                'kode_kegiatan' => $p['KodeKegiatanDetailRekening'],
                'kode_rekening' => $p['KodeRekeningDetailRekening'],
                'jenis' => $p['addJenis'],
                'uraian' => $p['addUraian'],
                'sasaran' => $p['addSasaran'],
                'lokasi' => $p['addLokasi'],
                'dana' => $p['addDana']
            );
            $query = $this->ProgramModel->ActionInsert('tb_detail_rekening',$data);
        }else {
            $data = array(
                'jenis' => $p['addJenis'],
                'uraian' => $p['addUraian'],
                'sasaran' => $p['addSasaran'],
                'lokasi' => $p['addLokasi'],
                'dana' => $p['addDana']
            );
            $mainID = $p['MainIdDetailRekening'];
            $query = $this->ProgramModel->UpdateDetailRekening("tb_detail_rekening", $data, $mainID);
        }
        if ($query != null) {
            $this->session->set_flashdata('succ', 'Berhasil tambah detail');
            $this->session->set_flashdata('DetailRekening_Direct', "Direction");
            $this->session->set_flashdata('DetailRekening_KodeInstansi', $kodeInstansi);
            $this->session->set_flashdata('DetailRekening_KodeProgram', $kodeProgram);
            $this->session->set_flashdata('DetailRekening_KodeKegiatan', $kodeKegiatan);
            $this->session->set_flashdata('DetailRekening_KodeRekening', $kodeRekening);
            redirect('ProgramCtrl/index/' . $kodeInstansi);
        } else {
            $this->session->set_flashdata('fail', 'Gagal tambah detail, segera hubungi admin');
            $this->session->set_flashdata('DetailRekening_Direct', "Direction");
            $this->session->set_flashdata('DetailRekening_KodeInstansi', $kodeInstansi);
            $this->session->set_flashdata('DetailRekening_KodeProgram', $kodeProgram);
            $this->session->set_flashdata('DetailRekening_KodeKegiatan', $kodeKegiatan);
            $this->session->set_flashdata('DetailRekening_KodeRekening', $kodeRekening);
            redirect('ProgramCtrl/index/' . $kodeInstansi);
        }
    }

    public function HapusDetailRekening($mainID, $kodeInstansi, $kodeProgram, $kodeKegiatan, $kodeRekening)
    {
        $query = $this->ProgramModel->DeleteDataRekening("tb_detail_rekening", $mainID);
        if ($query != null) {
            $this->session->set_flashdata('succ', 'Berhasil hapus detail');
            $this->session->set_flashdata('DetailRekening_Direct', "Direction");
            $this->session->set_flashdata('DetailRekening_KodeInstansi', $kodeInstansi);
            $this->session->set_flashdata('DetailRekening_KodeProgram', $kodeProgram);
            $this->session->set_flashdata('DetailRekening_KodeKegiatan', $kodeKegiatan);
            $this->session->set_flashdata('DetailRekening_KodeRekening', $kodeRekening);
            redirect('ProgramCtrl/index/' . $kodeInstansi);
        } else {
            $this->session->set_flashdata('fail', 'Gagal hapus detail, segera hubungi admin');
            $this->session->set_flashdata('DetailRekening_Direct', "Direction");
            $this->session->set_flashdata('DetailRekening_KodeInstansi', $kodeInstansi);
            $this->session->set_flashdata('DetailRekening_KodeProgram', $kodeProgram);
            $this->session->set_flashdata('DetailRekening_KodeKegiatan', $kodeKegiatan);
            $this->session->set_flashdata('DetailRekening_KodeRekening', $kodeRekening);
            redirect('ProgramCtrl/index/' . $kodeInstansi);
        }
    }
    

    public function ApiDataKegiatan($kodeKegiatan,$kodeInstansi)
    {
        $query = $this->db->select('nama_kegiatan')->from('tb_kegiatan')->where('kode_kegiatan',$kodeKegiatan)->where('kode_instansi',$kodeInstansi)->get()->result();
        echo json_encode($query);
    }
    

    public function generateKodeDetailRekening($kodeRekening,$idRekening)
    {
        $query = $this->db->select_max('kode_detail_rekening')->from('tb_detail_rekening')->where('kode_rekening', $idRekening)->get();
        $getKode = $query->row();
        $KodeRek = $getKode->kode_detail_rekening; //if(null): null ? 5.1.1.01.01
        $potong = substr($KodeRek, 9); // if(null): 1 ? 2
        $tambah = $potong + 1;
        $result = str_pad($tambah, 2, "0", STR_PAD_LEFT); //01
        return $result;
    }
    
}
