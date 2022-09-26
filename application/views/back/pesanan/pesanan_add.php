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
                <li><a href="<?php echo base_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
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
                <div class="box-header with-border">
                    <h3 class="box-title">Arsip Yang Dipesan</h3>
                </div>
                <div class="box-body">
                    <?php if (is_grandadmin()) { ?>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group"><label>Instansi (*)</label>
                                    <?php echo form_dropdown('', $get_all_combobox_instansi, '', $instansi_id) ?>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group"><label>Cabang (*)</label>
                                    <?php echo form_dropdown('', array('' => '- Pilih Instansi Dulu -'), '', $cabang_id) ?>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group"><label>Divisi (*)</label>
                                    <?php echo form_dropdown('', array('' => '- Pilih Cabang Dulu -'), '', $divisi_id) ?>
                                </div>
                            </div>
                        </div>
                    <?php } elseif (is_masteradmin() or is_superadmin() or is_admin()) { ?>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group"><label>Cabang (*)</label>
                                    <?php echo form_dropdown('', $get_all_combobox_cabang, '', $cabang_id) ?>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group"><label>Divisi (*)</label>
                                    <?php echo form_dropdown('', array('' => '- Pilih Cabang Dulu -'), '', $divisi_id) ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="form-group"><label>Nama Arsip (*)</label>
                        <?php echo form_dropdown('', array('' => '- Pilih Divisi Dulu -'), '', $arsip_id) ?>
                    </div>
                </div>
            </div>

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">User Pemesan Arsip</h3>
                </div>
                <div class="box-body">
                    <?php if (is_grandadmin()) { ?>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group"><label>Instansi (*)</label>
                                    <?php echo form_dropdown('', $get_all_combobox_instansi, '', $instansi_id_pemesan) ?>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group"><label>Cabang (*)</label>
                                    <?php echo form_dropdown('', array('' => '- Pilih Instansi Dulu -'), '', $cabang_id_pemesan) ?>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group"><label>Divisi (*)</label>
                                    <?php echo form_dropdown('', array('' => '- Pilih Cabang Dulu -'), '', $divisi_id_pemesan) ?>
                                </div>
                            </div>
                        </div>
                    <?php } elseif (is_masteradmin() or is_superadmin() or is_admin()) { ?>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group"><label>Cabang (*)</label>
                                    <?php echo form_dropdown('', $get_all_combobox_cabang, '', $cabang_id_pemesan) ?>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group"><label>Divisi (*)</label>
                                    <?php echo form_dropdown('', array('' => '- Pilih Cabang Dulu -'), '', $divisi_id_pemesan) ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="form-group"><label>Nama Akun Pemesan</label>
                        <?php echo form_dropdown('', array('' => '- Pilih Divisi Dulu -'), '', $user_id) ?>
                    </div>
                    <div class="ajax-content" id="showR"></div>
                </div>
                <!-- /.box-body -->
            </div>

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Upload Bukti Transfer</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="file" name="file_upload" class="file-upload" required>
                                <p class="help-block">Ukuran maksimal 2Mb. Ekstensi file yang diijinkan: .jpg, .jpeg, .png, .pdf</p>
                            </div>
                        </div>
                    </div>
                </div>
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
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/') ?>datatables-bs/css/dataTables.bootstrap.min.css">
    <script src="<?php echo base_url('assets/plugins/') ?>datatables/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url('assets/plugins/') ?>datatables-bs/js/dataTables.bootstrap.min.js"></script>
    <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/') ?>select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/') ?>select2/dist/css/select2-flat-theme.min.css">
    <script src="<?php echo base_url('assets/plugins/') ?>select2/dist/js/select2.full.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();

            $("#arsip_id").select2({
                // placeholder: "- Silahkan Pilih Arsip -",
                // theme: "classic"
            });
        });

        // FORM ARSIP DIPESAN--------------------------
        function tampilCabang() {
            instansi_id = document.getElementById("instansi_id").value;
            $.ajax({
                url: "<?php echo base_url(); ?>admin/cabang/pilih_cabang/" + instansi_id + "",
                success: function(response) {
                    $("#cabang_id").html(response);
                },
                dataType: "html"
            });
            return false;
        }

        function tampilDivisi() {
            cabang_id = document.getElementById("cabang_id").value;
            $.ajax({
                url: "<?php echo base_url(); ?>admin/pesanan/pilih_divisi/" + cabang_id + "",
                success: function(response) {
                    $("#divisi_id").html(response);
                },
                dataType: "html"
            });
            return false;
        }

        function tampilArsip() {
            divisi_id = document.getElementById("divisi_id").value;
            $.ajax({
                url: "<?php echo base_url(); ?>admin/arsip/pilih_arsip/" + divisi_id + "",
                success: function(response) {
                    $("#arsip_id").html(response);
                },
                dataType: "html"
            });
            return false;
        }

        //FORM PEMESAN ARSIP------------------------------
        function tampilCabangPemesan() {
            instansi_id = document.getElementById("instansi_id_pemesan").value;
            $.ajax({
                url: "<?php echo base_url(); ?>admin/cabang/pilih_cabang/" + instansi_id + "",
                success: function(response) {
                    $("#cabang_id_pemesan").html(response);
                },
                dataType: "html"
            });
            return false;
        }

        function tampilDivisiPemesan() {
            cabang_id = document.getElementById("cabang_id_pemesan").value;
            $.ajax({
                url: "<?php echo base_url(); ?>admin/pesanan/pilih_divisi/" + cabang_id + "",
                success: function(response) {
                    $("#divisi_id_pemesan").html(response);
                },
                dataType: "html"
            });
            return false;
        }

        function tampilUserPemesan() {
            divisi_id = document.getElementById("divisi_id_pemesan").value;
            $.ajax({
                url: "<?php echo base_url(); ?>admin/auth/pilih_user/" + divisi_id + "",
                success: function(response) {
                    $("#user_id").html(response);
                },
                dataType: "html"
            });
            return false;
        }

        function tampilIdentitasPemesan() {
            user_id = document.getElementById("user_id").value;
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url(); ?>admin/auth/tampil_identitas/" + user_id + "",
                beforeSend: function() {
                    $('#showR').html('<center><h1><i class="fa fa-spin fa-spinner" /></h1></center>');
                },
                success: function(msg) {
                    $('#showR').html(msg);
                }
            });
        }
    </script>

</div>
<!-- ./wrapper -->

</body>

</html>