<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pesanan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->data['module'] = 'Pesanan';

        $this->data['company_data']             = $this->Company_model->company_profile();
        $this->data['layout_template']          = $this->Template_model->layout();
        $this->data['skins_template']           = $this->Template_model->skins();
        $this->data['footer']                   = $this->Footer_model->footer();

        $this->data['btn_submit'] = 'Save';
        $this->data['btn_reset']  = 'Reset';
        $this->data['btn_add']    = 'Tambah Data';
        $this->data['add_action'] = base_url('admin/pesanan/create');

        is_login();

        if (is_pegawai()) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Anda tidak berhak masuk ke halaman sebelumnya</div>');
            redirect('admin/dashboard');
        }

        if ($this->uri->segment(2) != NULL) {
            menuaccess_check();
        } elseif ($this->uri->segment(3) != NULL) {
            submenuaccess_check();
        }
    }

    function index()
    {
        //TODO Tampilkan data (GET)
    }

    function create()
    {
        //TODO Tampilkan form tambah (POST)
        $this->data['page_title'] = 'Tambah Data ' . $this->data['module'];
        $this->data['action']     = 'admin/pesanan/create_action';

        if (is_grandadmin()) {
            $this->data['get_all_combobox_instansi']     = $this->Instansi_model->get_all_combobox();
        } elseif (is_masteradmin() or is_superadmin() or is_admin()) {
            $this->data['get_all_combobox_cabang']       = $this->Cabang_model->get_all_combobox_by_instansi($this->session->instansi_id);
        }

        $this->data['arsip_id'] = [
            'name'          => 'arsip_id',
            'id'            => 'arsip_id',
            'class'         => 'form-control',
            'autocomplete'  => 'off',
            'required'      => '',
        ];
        $this->data['instansi_id'] = [
            'name'          => 'instansi_id',
            'id'            => 'instansi_id',
            'class'         => 'form-control',
            'onChange'      => 'tampilCabang()',
            'required'      => '',
        ];
        $this->data['cabang_id'] = [
            'name'          => 'cabang_id',
            'id'            => 'cabang_id',
            'class'         => 'form-control',
            'onChange'      => 'tampilDivisi()',
            'required'      => '',
        ];
        $this->data['divisi_id'] = [
            'name'          => 'divisi_id',
            'id'            => 'divisi_id',
            'class'         => 'form-control',
            'onChange'      => 'tampilArsip()',
            'required'      => '',
        ];
        $this->data['instansi_id_pemesan'] = [
            'name'          => 'instansi_id_pemesan',
            'id'            => 'instansi_id_pemesan',
            'class'         => 'form-control',
            'onChange'      => 'tampilCabangPemesan()',
            'required'      => '',
        ];
        $this->data['cabang_id_pemesan'] = [
            'name'          => 'cabang_id_pemesan',
            'id'            => 'cabang_id_pemesan',
            'class'         => 'form-control',
            'onChange'      => 'tampilDivisiPemesan()',
            'required'      => '',
        ];
        $this->data['divisi_id_pemesan'] = [
            'name'          => 'divisi_id_pemesan',
            'id'            => 'divisi_id_pemesan',
            'class'         => 'form-control',
            'onChange'      => 'tampilUserPemesan()',
            'required'      => '',
        ];
        $this->data['user_id'] = [
            'name'          => 'user_id',
            'id'            => 'user_id',
            'class'         => 'form-control',
            'onChange'      => 'tampilIdentitasPemesan()',
            'required'      => '',
        ];

        $this->load->view('back/pesanan/pesanan_add', $this->data);
    }

    function pilih_divisi()
    {
        $this->data['divisi'] = $this->Divisi_model->get_divisi_by_cabang_combobox($this->uri->segment(4));
        $this->load->view('back/divisi/v_divisi', $this->data);
    }
}
