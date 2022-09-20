<style>
    .modal {
        overflow: auto !important;
    }

    .fa-times {
        color: grey;
        font-size: 20px;
    }

    .fa-times:hover {
        color: red;
    }
</style>

<div class="box" style='max-width:80%;margin-left:10%;'>
    <div class="box-header with-border">
        <h3 class="box-title">Bukti Transfer</h3>
        <a href="#" class="pull-right" data-dismiss="modal"><i class='fa fa-times'></i></a>
    </div>
    <div class="box-body">
        <div class="modal-content" style="min-width: 100px;">
            <div class="modal-header" style='text-align:center'>
                <center>
                    <?php
                    $ext_file = explode(".", $pesanan->bukti_tf);
                    if ($ext_file[1] == "jpg" || $ext_file[1] == "PNG" || $ext_file[1] == "jpeg" || $ext_file[1] == "png") {
                    ?>
                        <img src="<?php echo base_url('assets/images/bukti_tf/' . $instansi->instansi_name . '/') . $pesanan->bukti_tf; ?>" width="100%">
                    <?php } elseif ($ext_file[1] == "pdf") { ?>
                        <iframe src="<?php echo base_url(); ?>admin/pesanan/pdf_frame/<?php echo $pesanan->id_order ?>" width="100%" height="1100px"></iframe>
                    <?php } ?>
                </center>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
</div>