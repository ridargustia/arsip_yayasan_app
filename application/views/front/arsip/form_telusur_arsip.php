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
                            <h4><b><?php echo $arsip->harga ?>,00</b></h4>
                            <span>Silahkan transfer ke :</span>
                            <strong>
                                <span>Bank <?php echo $instansi->nama_bank ?></span>
                                <span>A.n. <?php echo $instansi->atas_nama_rek ?></span>
                                <span>No. Rekening <?php echo $instansi->no_rek ?></span>
                            </strong>
                        </div>
                    </div>

                    <?php echo form_open_multipart($action) ?>
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Form Data Diri</h3>
                        </div>
                        <div class="box-body">
                            <?php echo validation_errors() ?>
                            <p style="margin-bottom: 15px;">*Pastikan anda sudah mentransfer uang pembayaran sebelum melakukan konfirmasi dengan mengirim form di bawah ini.</p>
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
                                        <label class="control-label">No. Telephone/HP/WhatsApp *</label>
                                        <?php echo form_input($no_wa) ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Alamat *</label>
                                        <?php echo form_input($address) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                        <?php echo form_input($arsip_id, $arsip->id_arsip) ?>
                        <?php echo form_input($user_id, $this->session->id_users) ?>
                        <div class="box-footer">
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" name="button" class="btn btn-success" style="width: 100%; font-size: 15px;"><i class="fa fa-check"></i> Kirim Bukti Transfer</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php echo form_close() ?>

                    <a href="<?php echo base_url('home') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                </section>
                <!-- /.content -->
            </div>
        </div>

        <?php $this->load->view('front/template/footer'); ?>

</body>

</html>