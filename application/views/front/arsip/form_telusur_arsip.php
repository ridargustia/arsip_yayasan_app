<?php $this->load->view('front/template/meta'); ?>

<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->

<body class="hold-transition skin-blue layout-top-nav">
    <div class="wrapper">

        <?php $this->load->view('front/template/navbar'); ?>

        <div class="content-wrapper">
            <div class="container">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <ol class="breadcrumb">
                        <li><a href="<?php echo base_url('home') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#"> Form Telusur Arsip</a></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content" style="margin-top: 20px;">
                    <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('message') ?>"></div>

                    <div class="box box-primary box-solid">
                        <div class="box-header" style="text-align: center;">
                            <h3 class="box-title">Biaya Telusur Arsip</h3>
                        </div>
                        <div class="box-body" style="text-align: center;">
                            <h4><b><?php echo rupiah($arsip->harga) ?></b></h4>
                            <span>Silahkan transfer ke :</span>
                            <strong>
                                <span>Bank BSI</span>
                                <span>A.n. Yayasan</span>
                                <span>No. Rekening 824-329-323-2</span>
                            </strong>
                        </div>
                    </div>

                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Form Data Diri</h3>
                        </div>
                        <?php echo form_open_multipart($action) ?>
                        <div class="box-body">
                            <?php echo validation_errors() ?>
                            <p style="margin-bottom: 15px;">*Pastikan anda sudah mentransfer uang pembayaran sebelum mengisi form di bawah ini.</p>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Nama *</label>
                                        <?php echo form_input($name) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Email *</label>
                                        <?php echo form_input($email) ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">No. WhatsApp *</label>
                                        <?php echo form_input($no_wa) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Upload Bukti Transfer *</label>
                                        <input type="file" name="file_upload" class="file-upload" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php echo form_input($arsip_id, $arsip->id_arsip) ?>
                        <div class="box-footer">
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" name="button" class="btn btn-success" style="width: 100%; font-size: 15px;"><i class="fa fa-check"></i> Submit</button>
                                </div>
                            </div>
                        </div>
                        <?php echo form_close() ?>
                    </div>

                    <a href="<?php echo base_url('home') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                </section>
                <!-- /.content -->
            </div>
        </div>

        <?php $this->load->view('front/template/footer'); ?>

</body>

</html>