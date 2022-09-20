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
        is_read();

        //TODO Tampilkan data (GET)
        $this->data['page_title'] = 'Data ' . $this->data['module'];

        if (is_grandadmin()) {
            $this->data['get_all'] = $this->Orders_model->get_all();
        } elseif (is_masteradmin() or is_superadmin() or is_admin()) {
            $this->data['get_all'] = $this->Orders_model->get_all_by_instansi();
        }

        $this->load->view('back/pesanan/pesanan_list', $this->data);
    }

    function create()
    {
        is_create();

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

    function create_action()
    {
        $this->form_validation->set_rules('email', 'Email', 'valid_email|required');
        $this->form_validation->set_rules('no_wa', 'No. Telephone/HP/WhatsApp', 'is_numeric|required');

        $this->form_validation->set_message('required', '{field} wajib diisi');
        $this->form_validation->set_message('valid_email', 'Format {field} salah');
        $this->form_validation->set_message('is_numeric', '{field} wajib berisi angka');

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

        if ($this->form_validation->run() === FALSE) {
            $this->create();
        } else {
            $user = $this->Auth_model->get_by_id($this->input->post('user_id'));

            if (!empty($_FILES['file_upload']['name'])) {
                $nmfile = strtolower(url_title($user->name)) . date('YmdHis');

                $instansi = $this->Instansi_model->get_by_id($user->instansi_id);

                $config['upload_path']      = './assets/images/bukti_tf/' . $instansi->instansi_name;

                if (!is_dir($config['upload_path'])) {
                    mkdir($config['upload_path'], 0777, TRUE);
                }

                $config['allowed_types']    = 'jpg|jpeg|png|pdf';
                $config['max_size']         = 2048; // 2Mb
                $config['file_name']        = $nmfile;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('file_upload')) {
                    $error = array('error' => $this->upload->display_errors());
                    $this->session->set_flashdata('message', '<div class="alert alert-danger">' . $error['error'] . '</div>');

                    $this->create();
                } else {
                    $this->upload->data();

                    $data = array(
                        'name'              => $user->name,
                        'email'             => $this->input->post('email'),
                        'no_wa'             => $this->input->post('no_wa'),
                        'user_id'           => $this->input->post('user_id'),
                        'arsip_id'          => $this->input->post('arsip_id'),
                        'instansi_id'       => $user->instansi_id,
                        'cabang_id'         => $user->cabang_id,
                        'divisi_id'         => $user->divisi_id,
                        'bukti_tf'          => $this->upload->data('file_name'),
                        'created_by'        => $this->session->username,
                    );

                    $this->Orders_model->insert($data);

                    write_log();
                }
            }

            $this->session->set_flashdata('message', '<div class="alert alert-success">Data berhasil disimpan</div>');
            redirect('admin/pesanan');
        }
    }

    function update($id)
    {
        is_update();

        $this->data['pesanan'] = $this->Orders_model->get_by_id($id);
        $this->data['data_arsip'] = $this->Arsip_model->get_by_id($this->data['pesanan']->arsip_id);
        $this->data['instansi'] = $this->Instansi_model->get_by_id($this->data['pesanan']->instansi_id);

        if ($this->data['pesanan']) {
            //TODO Tampilkan form tambah (PATCH/PUT)
            $this->data['page_title'] = 'Update Data ' . $this->data['module'];
            $this->data['action']     = 'admin/pesanan/update_action';

            if (is_grandadmin()) {
                $this->data['get_all_combobox_instansi']     = $this->Instansi_model->get_all_combobox();
                $this->data['get_all_combobox_cabang']       = $this->Cabang_model->get_all_combobox_by_instansi($this->data['data_arsip']->instansi_id);
                $this->data['get_all_combobox_divisi']       = $this->Divisi_model->get_all_combobox_by_cabang($this->data['data_arsip']->cabang_id);
                $this->data['get_all_combobox_pemesan_cabang']       = $this->Cabang_model->get_all_combobox_by_instansi($this->data['pesanan']->instansi_id);
                $this->data['get_all_combobox_pemesan_divisi']       = $this->Divisi_model->get_all_combobox_by_cabang($this->data['pesanan']->cabang_id);
            } elseif (is_masteradmin() or is_superadmin() or is_admin()) {
                $this->data['get_all_combobox_cabang']       = $this->Cabang_model->get_all_combobox_by_instansi($this->data['pesanan']->instansi_id);
                $this->data['get_all_combobox_divisi']       = $this->Divisi_model->get_all_combobox_by_cabang($this->data['pesanan']->cabang_id);
            }

            $this->data['get_all_combobox_arsip']       = $this->Arsip_model->get_all_combobox_by_divisi($this->data['data_arsip']->divisi_id);
            $this->data['get_all_combobox_user']       = $this->Auth_model->get_all_combobox_pemesan_by_divisi($this->data['pesanan']->divisi_id);

            $this->data['id_order'] = [
                'name'          => 'id_order',
                'type'          => 'hidden',
            ];
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
            $this->data['email'] = [
                'name'          => 'email',
                'id'            => 'email',
                'class'         => 'form-control',
                'required'      => '',
            ];
            $this->data['no_wa'] = [
                'name'          => 'no_wa',
                'id'            => 'no_wa',
                'class'         => 'form-control',
                'required'      => '',
            ];

            $this->load->view('back/pesanan/pesanan_edit', $this->data);
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Data tidak ditemukan</div>');
            redirect('admin/pesanan');
        }
    }

    function update_action()
    {
        $this->form_validation->set_rules('email', 'Email', 'valid_email|required');
        $this->form_validation->set_rules('no_wa', 'No. Telephone/HP/WhatsApp', 'is_numeric|required');

        $this->form_validation->set_message('required', '{field} wajib diisi');
        $this->form_validation->set_message('valid_email', 'Format {field} salah');
        $this->form_validation->set_message('is_numeric', '{field} wajib berisi angka');

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

        if ($this->form_validation->run() === FALSE) {
            $this->update($this->input->post('id_order'));
        } else {
            $user = $this->Auth_model->get_by_id($this->input->post('user_id'));

            if (is_grandadmin()) {
                $instansi_id = $this->input->post('instansi_id_pemesan');
                $cabang_id = $this->input->post('cabang_id_pemesan');
                $divisi_id = $this->input->post('divisi_id_pemesan');
            } elseif (is_masteradmin() or is_superadmin() or is_admin()) {
                $instansi_id = $this->session->instansi_id;
                $cabang_id = $this->input->post('cabang_id_pemesan');
                $divisi_id = $this->input->post('divisi_id_pemesan');
            }

            if (!empty($_FILES['file_upload']['name'])) {
                $nmfile = strtolower(url_title($user->name)) . date('YmdHis');

                $instansi = $this->Instansi_model->get_by_id($user->instansi_id);
                $pesanan = $this->Orders_model->get_by_id($this->input->post('id_order'));

                $config['upload_path']      = './assets/images/bukti_tf/' . $instansi->instansi_name;

                if (!is_dir($config['upload_path'])) {
                    mkdir($config['upload_path'], 0777, TRUE);
                }

                $dir = "./assets/images/bukti_tf/" . $instansi->instansi_name . "/" . $pesanan->bukti_tf;

                if (is_file($dir)) {
                    unlink($dir);
                }

                $config['allowed_types']    = 'jpg|jpeg|png|pdf';
                $config['max_size']         = 2048; // 2Mb
                $config['file_name']        = $nmfile;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('file_upload')) {
                    $error = array('error' => $this->upload->display_errors());
                    $this->session->set_flashdata('message', '<div class="alert alert-danger">' . $error['error'] . '</div>');

                    $this->update($this->input->post('id_order'));
                } else {
                    $this->upload->data();

                    $data = array(
                        'name'            => $user->name,
                        'email'           => $this->input->post('email'),
                        'no_wa'           => $this->input->post('no_wa'),
                        'user_id'         => $this->input->post('user_id'),
                        'arsip_id'        => $this->input->post('arsip_id'),
                        'instansi_id'     => $instansi_id,
                        'cabang_id'       => $cabang_id,
                        'divisi_id'       => $divisi_id,
                        'bukti_tf'        => $this->upload->data('file_name'),
                        'modified_by'     => $this->session->username,
                    );

                    $this->Orders_model->update($this->input->post('id_order'), $data);

                    write_log();
                }
            } else {
                $data = array(
                    'name'            => $user->name,
                    'email'           => $this->input->post('email'),
                    'no_wa'           => $this->input->post('no_wa'),
                    'user_id'         => $this->input->post('user_id'),
                    'arsip_id'        => $this->input->post('arsip_id'),
                    'instansi_id'     => $instansi_id,
                    'cabang_id'       => $cabang_id,
                    'divisi_id'       => $divisi_id,
                    'modified_by'     => $this->session->username,
                );

                $this->Orders_model->update($this->input->post('id_order'), $data);

                write_log();
            }

            $this->session->set_flashdata('message', '<div class="alert alert-success">Data berhasil disimpan</div>');
            redirect('admin/pesanan');
        }
    }

    function delete($id)
    {
        is_delete();

        $delete = $this->Orders_model->get_by_id($id);

        if ($delete) {
            $data = array(
                'is_delete'     => '1',
                'deleted_by'    => $this->session->username,
                'deleted_at'    => date('Y-m-d H:i:a'),
            );

            $this->Orders_model->soft_delete($id, $data);

            write_log();

            $this->session->set_flashdata('message', '<div class="alert alert-success">Data berhasil dihapus</div>');
            redirect('admin/pesanan');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Data tidak ditemukan</div>');
            redirect('admin/pesanan');
        }
    }

    function deleted_list()
    {
        is_restore();

        $this->data['page_title'] = 'Recycle Bin ' . $this->data['module'];

        if (is_grandadmin()) {
            $this->data['get_all_deleted'] = $this->Orders_model->get_all_deleted();
        } elseif (is_masteradmin() or is_superadmin() or is_admin()) {
            $this->data['get_all_deleted'] = $this->Orders_model->get_all_deleted_by_instansi();
        }

        $this->load->view('back/pesanan/pesanan_deleted_list', $this->data);
    }

    function delete_permanent($id)
    {
        is_delete();

        $delete = $this->Orders_model->get_by_id($id);

        if ($delete) {
            $this->Orders_model->delete($id);

            write_log();

            $this->session->set_flashdata('message', '<div class="alert alert-success">Data berhasil dihapus permanen</div>');
            redirect('admin/pesanan/deleted_list');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Data tidak ditemukan</div>');
            redirect('admin/pesanan');
        }
    }

    function restore($id)
    {
        is_restore();

        $row = $this->Orders_model->get_by_id($id);

        if ($row) {
            $data = array(
                'is_delete'     => '0',
                'deleted_by'    => NULL,
                'deleted_at'    => NULL,
            );

            $this->Orders_model->update($id, $data);

            write_log();

            $this->session->set_flashdata('message', '<div class="alert alert-success">Data berhasil dikembalikan</div>');
            redirect('admin/pesanan/deleted_list');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Data tidak ditemukan</div>');
            redirect('admin/pesanan');
        }
    }

    function pilih_divisi()
    {
        $this->data['divisi'] = $this->Divisi_model->get_divisi_by_cabang_combobox($this->uri->segment(4));
        $this->load->view('back/divisi/v_divisi', $this->data);
    }

    function pdf_frame($id)
    {
        $this->data['pesanan'] = $this->Orders_model->get_by_id($id);
        $this->data['instansi'] = $this->Instansi_model->get_by_id($this->data['pesanan']->instansi_id);

        $this->load->view('back/pesanan/pdf_frame', $this->data);
    }
}
