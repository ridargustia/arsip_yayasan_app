<?php $this->load->view('back/template/meta'); ?>
<div class="wrapper">

  <?php $this->load->view('back/template/navbar'); ?>
  <?php $this->load->view('back/template/sidebar'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><?php echo $page_title ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><?php echo $module ?></li>
        <li class="active"><?php echo $page_title ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <?php if ($this->session->flashdata('message')) {
        echo $this->session->flashdata('message');
      } ?>

      <?php echo validation_errors() ?>
      <?php echo form_open_multipart($action) ?>
      <div class="box box-primary">
        <div class="box-body">
          <div class="form-group"><label>Nama Instansi</label>
            <?php if (is_grandadmin()) { ?>
              <?php echo form_input($instansi_name, $instansi->instansi_name) ?>
              <br>
            <?php } else {
              echo $instansi->instansi_name ?>
            <?php } ?>
          </div>
          <div class="form-group"><label>Alamat</label>
            <?php echo form_textarea($instansi_address, $instansi->instansi_address) ?>
          </div>
          <div class="form-group"><label>No. HP / Telpon</label>
            <?php echo form_input($instansi_phone, $instansi->instansi_phone) ?>
          </div>
          <?php if (is_grandadmin()) { ?>
            <div class="form-group"><label>Aktif Sampai</label>
              <?php echo form_input($active_date, $instansi->active_date) ?>
            </div>
          <?php } ?>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group"><label>Nama Bank</label>
                <?php echo form_dropdown('', $nama_bank_value, $instansi->nama_bank, $nama_bank) ?>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group"><label>Atas Nama Rekening (*)</label>
                <?php echo form_input($atas_nama_rek, $instansi->atas_nama_rek) ?>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group"><label>No. Rekening (*)</label>
                <?php echo form_input($no_rek, $instansi->no_rek) ?>
              </div>
            </div>
          </div>
          <div class="form-group"><label>Logo Saat Ini</label>
            <p><img width="250px" src="<?php echo base_url('assets/images/instansi/' . $instansi->instansi_img_thumb) ?>" /></p>
          </div>
          <div class="form-group"><label>Logo Baru</label>
            <input type="file" name="photo" id="photo" onchange="photoPreview(this,'preview')" />
            <p class="help-block">Maximum file size 2Mb</p>
            <b>Preview</b><br>
            <img id="preview" width="250px" />
          </div>

        </div>
        <?php echo form_input($id_instansi, $instansi->id_instansi) ?>
        <div class="box-footer">
          <button type="submit" name="button" class="btn btn-success"><i class="fa fa-save"></i> <?php echo $btn_submit ?></button>
          <button type="reset" name="button" class="btn btn-danger"><i class="fa fa-refresh"></i> <?php echo $btn_reset ?></button>
        </div>
        <!-- /.box-body -->
      </div>
      <?php echo form_close() ?>
      <!-- /.box -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php $this->load->view('back/template/footer'); ?>

  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/') ?>bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <script src="<?php echo base_url('assets/plugins/') ?>bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

  <script type="text/javascript">
    $('#active_date').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd',
      zIndexOffset: 9999,
      todayHighlight: true,
    });

    function photoPreview(photo, idpreview) {
      var gb = photo.files;
      for (var i = 0; i < gb.length; i++) {
        var gbPreview = gb[i];
        var imageType = /image.*/;
        var preview = document.getElementById(idpreview);
        var reader = new FileReader();
        if (gbPreview.type.match(imageType)) {
          //jika tipe data sesuai
          preview.file = gbPreview;
          reader.onload = (function(element) {
            return function(e) {
              element.src = e.target.result;
            };
          })(preview);
          //membaca data URL gambar
          reader.readAsDataURL(gbPreview);
        } else {
          //jika tipe data tidak sesuai
          alert("Tipe file tidak sesuai. Gambar harus bertipe .png, .gif atau .jpg.");
        }
      }
    }
  </script>

</div>
<!-- ./wrapper -->

</body>

</html>