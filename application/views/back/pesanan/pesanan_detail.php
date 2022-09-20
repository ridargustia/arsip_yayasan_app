<?php $this->load->view('front/template/meta'); ?>

<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->

<body class="hold-transition skin-blue layout-top-nav">
    <div class="wrapper">

        <?php $this->load->view('front/template/navbar'); ?>

        <div class="content-wrapper">
            <div class="container">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1><?php echo $page_title ?></h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#"> <?php echo $page_title ?></a></li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="box box-primary">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <?php
                                    $ext_file = explode(".", $detail_pesanan->bukti_tf);
                                    if ($ext_file[1] == "jpg" || $ext_file[1] == "PNG" || $ext_file[1] == "jpeg" || $ext_file[1] == "png") {
                                    ?>
                                        <img src="<?php echo base_url('assets/images/bukti_tf/' . $instansi->instansi_name . '/') . $detail_pesanan->bukti_tf; ?>" width="100%">
                                    <?php } elseif ($ext_file[1] == "pdf") { ?>
                                        <iframe src="<?php echo base_url() ?>admin/pesanan/pdf_frame/<?php echo $detail_pesanan->id_order ?>" width="100%" height="300px"></iframe>
                                    <?php } ?>
                                    <center>
                                        <a href="#" onclick="previewCover(<?php echo $detail_pesanan->id_order ?>)" title="Preview Cover" class="btn btn-success" style="width: 100%;">Lihat Bukti Transfer</a>
                                    </center>
                                </div>
                                <div class="col-sm-9">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td style="width:200px">Nama Pemesan Arsip</td>
                                                <td style="width:10px">:</td>
                                                <td class="text-left"><?php echo $detail_pesanan->name ?></td>
                                            </tr>
                                            <tr>
                                                <td style="width:200px">Email</td>
                                                <td style="width:10px">:</td>
                                                <td class="text-left"><?php echo $detail_pesanan->email ?></td>
                                            </tr>
                                            <tr>
                                                <td style="width:200px">No. Telephone/HP/WhatsApp</td>
                                                <td style="width:10px">:</td>
                                                <td class="text-left"><?php echo $detail_pesanan->no_wa ?></td>
                                            </tr>
                                            <tr>
                                                <td style="width:200px">Nama Arsip Dipinjam</td>
                                                <td style="width:10px">:</td>
                                                <td class="text-left"><?php echo $detail_pesanan->arsip_name ?></td>
                                            </tr>
                                            <tr>
                                                <td style="width:200px">No. Arsip</td>
                                                <td style="width:10px">:</td>
                                                <td class="text-left"><?php echo $detail_pesanan->no_arsip ?></td>
                                            </tr>
                                            <tr>
                                                <td style="width:200px">Biaya Telusur Arsip</td>
                                                <td style="width:10px">:</td>
                                                <td class="text-left"><?php echo $detail_pesanan->harga ?>,-</td>
                                            </tr>
                                            <tr>
                                                <td>Instansi</td>
                                                <td style="width:10px">:</td>
                                                <td class="text-left"><?php echo strtoupper($detail_pesanan->instansi_name) ?></td>
                                            </tr>
                                            <tr>
                                                <td>Cabang</td>
                                                <td style="width:10px">:</td>
                                                <td class="text-left"><?php echo $detail_pesanan->cabang_name ?></td>
                                            </tr>
                                            <tr>
                                                <td>Divisi</td>
                                                <td style="width:10px">:</td>
                                                <td class="text-left"><?php echo $detail_pesanan->divisi_name ?></td>
                                            </tr>
                                            <tr>
                                                <td>Dibuat Pada</td>
                                                <td style="width:10px">:</td>
                                                <td class="text-left"><?php echo datetime_indonesian($detail_pesanan->created_at) ?></td>
                                            </tr>
                                            <tr>
                                                <td>Dibuat Oleh</td>
                                                <td style="width:10px">:</td>
                                                <td class="text-left"><?php echo $detail_pesanan->created_by ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="<?php echo base_url('admin/pesanan') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>

                    <div class="modal fade" id="ModalPreview" role="dialog" style="min-width: 100%;margin-left:0px">
                        <div class="modal-dialog" style="min-width: 100%;">
                            <div id="dataPreview"></div>
                        </div><!-- /.modal-dialog -->
                    </div>
                </section>
                <!-- /.content -->
            </div>
            <!-- /.container -->
        </div>
        <!-- /.content-wrapper -->

        <?php $this->load->view('front/template/footer'); ?>

        <script>
            function previewCover(id) {
                $("#id").val(id);
                $('#ModalPreview').modal("show");
                loadPreview(id);
            }

            function loadPreview(id_order) {
                $.ajax({
                    url: "<?php echo base_url(); ?>admin/pesanan/ajax_preview_cover/" + id_order + "",
                    type: "GET",
                    async: true,
                    data: {

                    },
                    success: function(data) {
                        $('#dataPreview').html(data);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error adding / update data');
                    }
                });
            }
        </script>
</body>

</html>