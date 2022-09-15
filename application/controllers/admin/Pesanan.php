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
        } elseif (is_masteradmin()) {
            $this->data['get_all_combobox_cabang']       = $this->Cabang_model->get_all_combobox_by_instansi($this->session->instansi_id);
        } elseif (is_superadmin()) {
            $this->data['get_all_combobox_divisi']       = $this->Divisi_model->get_all_combobox_by_cabang($this->session->cabang_id);
        }

        $this->data['name'] = [
            'name'          => 'name',
            'id'            => 'name',
            'class'         => 'form-control',
            'autocomplete'  => 'off',
            'required'      => '',
            'value'         => $this->form_validation->set_value('name'),
        ];
        $this->data['email'] = [
            'name'          => 'email',
            'id'            => 'email',
            'class'         => 'form-control',
            'autocomplete'  => 'off',
            'required'      => '',
            'value'         => $this->form_validation->set_value('email'),
        ];
        $this->data['no_wa'] = [
            'name'          => 'no_wa',
            'id'            => 'no_wa',
            'class'         => 'form-control',
            'autocomplete'  => 'off',
            'required'      => '',
            'value'         => $this->form_validation->set_value('no_wa'),
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
            'required'      => '',
        ];

        $this->load->view('back/pesanan/pesanan_add', $this->data);
    }
}
