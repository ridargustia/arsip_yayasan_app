<?php

use SebastianBergmann\Environment\Console;

defined('BASEPATH') or exit('No direct script access allowed');

class Arsip extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();

    $this->data['module'] = 'Home';

    $this->load->helper(array('highlight'));

    $this->load->model(array('Arsip_model', 'File_model', 'Rak_model', 'Baris_model', 'Kategori_model'));

    $this->data['company_data']      = $this->Company_model->company_profile();
    $this->data['footer']            = $this->Footer_model->footer();

    if (is_grandadmin()) {
      $this->data['get_all_instansi'] = $this->Instansi_model->get_all_active();
    } elseif (is_masteradmin()) {
      $this->data['get_all_cabang']   = $this->Cabang_model->get_all_by_instansi();
    } else {
      $this->data['get_all_divisi']   = $this->Divisi_model->get_all_by_cabang();
    }

    is_login_front();
    is_active_instansi_front();
  }

  function cari_arsip()
  {
    $this->data['page_title']       = 'Hasil Pencarian';

    $search_form  = $this->input->get('search_form');
    $instansi_id  = $this->input->get('instansi_id');
    $cabang_id    = $this->input->get('cabang_id');
    $divisi_id    = $this->input->get('divisi_id');

    $this->data['instansi']   = $this->Instansi_model->get_by_id($instansi_id);
    $this->data['cabang']     = $this->Cabang_model->get_by_id($cabang_id);
    $this->data['divisi']     = $this->Divisi_model->get_by_id($divisi_id);

    if (is_grandadmin()) {
      if ($search_form == NULL and $instansi_id == NULL) {
        $this->data['hasil_pencarian']  = $this->Arsip_model->get_all_front();
      }
      // jika form pencarian KOSONG dan CABANG DIISI
      elseif ($search_form == NULL and $instansi_id != NULL) {
        $this->data['hasil_pencarian']  = $this->Arsip_model->cari_all_arsip_by_instansi_with_searchFormNull_and_instansiIdNotNull($instansi_id);
      }
      // jika form pencarian DIISI dan CABANG KOSONG
      elseif ($search_form != NULL and $instansi_id == NULL) {
        $this->data['hasil_pencarian']  = $this->Arsip_model->cari_all_arsip_by_instansi_with_searchFormNotNull_and_instansiIdNull($search_form);
      }
      // jika form pencarian DIISI dan CABANG DIISI
      elseif ($search_form != NULL and $instansi_id != NULL) {
        $this->data['hasil_pencarian']  = $this->Arsip_model->cari_all_arsip_by_instansi_with_searchFormNotNull($search_form, $instansi_id);
      }
    } elseif (is_masteradmin()) {
      if ($search_form == NULL and $cabang_id == NULL) {
        $this->data['hasil_pencarian']  = $this->Arsip_model->get_all_by_instansi();
      }
      // jika form pencarian KOSONG dan CABANG DIISI
      elseif ($search_form == NULL and $cabang_id != NULL) {
        $this->data['hasil_pencarian']  = $this->Arsip_model->get_all_by_instansi_with_searchFormNull_and_cabangNotNull($cabang_id);
      }
      // jika form pencarian DIISI dan CABANG KOSONG
      elseif ($search_form != NULL and $cabang_id == NULL) {
        $this->data['hasil_pencarian']  = $this->Arsip_model->get_all_by_instansi_with_searchFormNotNull_and_cabangNull($search_form);
      }
      // jika form pencarian DIISI dan CABANG DIISI
      elseif ($search_form != NULL and $cabang_id != NULL) {
        $this->data['hasil_pencarian']  = $this->Arsip_model->get_all_by_instansi_with_searchFormNotNull_and_cabangNotNull($search_form, $cabang_id);
      }
    } else {
      if ($search_form == NULL and $divisi_id == NULL) {
        $this->data['hasil_pencarian']  = $this->Arsip_model->get_all_by_instansi();
      }
      // jika form pencarian KOSONG dan CABANG DIISI
      elseif ($search_form == NULL and $divisi_id != NULL) {
        $this->data['hasil_pencarian']  = $this->Arsip_model->get_all_by_instansi_with_searchFormNull_and_divisiNotNull($divisi_id);
      }
      // jika form pencarian DIISI dan CABANG KOSONG
      elseif ($search_form != NULL and $divisi_id == NULL) {
        $this->data['hasil_pencarian']  = $this->Arsip_model->get_all_by_instansi_with_searchFormNotNull_and_divisiNull($search_form);
      }
      // jika form pencarian DIISI dan CABANG DIISI
      elseif ($search_form != NULL and $divisi_id != NULL) {
        $this->data['hasil_pencarian']  = $this->Arsip_model->get_all_by_instansi_with_searchFormNotNull_and_divisiNotNull($search_form, $divisi_id);
      }
    }

    $this->load->view('front/arsip/hasil_pencarian', $this->data);
  }

  function detail($id)
  {
    $this->data['page_title']   = 'Detail Arsip';

    $this->data['detail_arsip']   = $this->Arsip_model->get_by_id_front($id);
    $this->data['file_upload']    = $this->File_model->get_by_arsip_id($id);

    $instansi                     = $this->Instansi_model->get_by_id($this->data['detail_arsip']->instansi_id);
    $this->data['instansiName']   = $instansi->instansi_name;

    $row = $this->data['detail_arsip'];

    if ($this->data['detail_arsip'] == TRUE) {
      if (is_masteradmin() && $row->instansi_id != $this->session->instansi_id) {
        $this->session->set_flashdata('message', '<div class="alert alert-danger">Anda tidak berhak melihat data orang lain</div>');
        redirect('home');
      } else {
        $this->data['arsip_files']  = $this->Arsip_model->get_files_id_result($this->uri->segment(3));

        $this->load->view('front/arsip/detail_arsip', $this->data);
      }
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-danger"><i class="fa fa-bullhorn"></i> Arsip yang Anda cari tidak ditemukan!</div>');
      redirect('home');
    }
  }

  function pdf_frame($id_arsip)
  {
    $this->data['arsip'] = $this->Arsip_model->get_by_id_front($id_arsip);
    $this->data['file_upload'] = $this->File_model->get_by_arsip_id($id_arsip);

    $this->load->view('front/arsip/pdf_frame', $this->data);
  }

  function ajax_preview_cover($id_arsip)
  {
    $this->data['id_arsip'] = $id_arsip;
    $this->data['file_upload'] = $this->Arsip_model->get_cover_by_id($id_arsip);

    $this->load->view('back/arsip/preview_cover', $this->data);
  }

  function form_telusur_arsip($id_arsip)
  {
    $this->data['page_title'] = 'Konfirmasi Pembayaran Arsip';
    $this->data['action']     = 'arsip/create_order';

    $this->data['arsip'] = $this->Arsip_model->get_by_id($id_arsip);
    $this->data['instansi'] = $this->Instansi_model->get_by_id($this->session->instansi_id);

    $this->data['arsip_id'] = [
      'name'          => 'arsip_id',
      'type'          => 'hidden',
    ];
    $this->data['user_id'] = [
      'name'          => 'user_id',
      'type'          => 'hidden',
    ];
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
    $this->data['address'] = [
      'name'          => 'address',
      'id'            => 'address',
      'class'         => 'form-control',
      'autocomplete'  => 'off',
      'required'      => '',
      'value'         => $this->form_validation->set_value('address'),
    ];

    $this->load->view('front/arsip/form_telusur_arsip', $this->data);
  }

  function create_order()
  {
    $this->form_validation->set_rules('name', 'Nama', 'trim|required');
    $this->form_validation->set_rules('email', 'Email', 'valid_email|required');
    $this->form_validation->set_rules('no_wa', 'No. WhatsApp', 'is_numeric|required');
    $this->form_validation->set_rules('address', 'Alamat', 'required');

    $this->form_validation->set_message('required', '{field} wajib diisi');
    $this->form_validation->set_message('valid_email', 'Format {field} salah');
    $this->form_validation->set_message('is_numeric', '{field} wajib berisi angka');

    $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

    if ($this->form_validation->run() === FALSE) {
      $this->form_telusur_arsip($this->input->post('arsip_id'));
    } else {
      if (!empty($_FILES['file_upload']['name'])) {
        $nmfile = strtolower(url_title($this->input->post('name'))) . date('YmdHis');

        $instansi = $this->Instansi_model->get_by_id($this->session->instansi_id);

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

          $this->form_telusur_arsip($this->input->post('arsip_id'));
        } else {
          $this->upload->data();

          $data = array(
            'name'              => $this->input->post('name'),
            'email'             => $this->input->post('email'),
            'no_wa'             => $this->input->post('no_wa'),
            'address'           => $this->input->post('address'),
            'user_id'           => $this->input->post('user_id'),
            'arsip_id'          => $this->input->post('arsip_id'),
            'instansi_id'       => $this->session->instansi_id,
            'cabang_id'         => $this->session->cabang_id,
            'divisi_id'         => $this->session->divisi_id,
            'bukti_tf'          => $this->upload->data('file_name'),
            'created_by'        => $this->session->username,
          );

          $this->Orders_model->insert($data);

          write_log();
        }
      }
      $this->session->set_flashdata('message', 'Sukses');
      redirect('arsip/form_telusur_arsip/' . $this->input->post('arsip_id'));
    }
  }
}
