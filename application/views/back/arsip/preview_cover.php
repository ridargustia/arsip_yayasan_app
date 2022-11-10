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
        <h3 class="box-title">Preview Arsip</h3>
        <a href="#" class="pull-right" data-dismiss="modal"><i class='fa fa-times'></i></a>
    </div>
    <div class="box-body">
        <div class="modal-content" style="min-width: 100px;">
            <div class="modal-header" style='text-align:center'>
                <center>
                    <?php
                    $ext_file = explode(".", $arsip->file_upload);
                    $countArray = count($ext_file) - 1;

                    if ($ext_file[$countArray] == "jpg" || $ext_file[$countArray] == "PNG" || $ext_file[$countArray] == "jpeg" || $ext_file[$countArray] == "png") {
                    ?>
                        <img src="<?php echo base_url('assets/file_arsip/' . $arsip->instansi_name . '/') . $arsip->cover; ?>" width="100%">
                    <?php } elseif ($ext_file[$countArray] == "pdf") { ?>
                        <iframe src="<?php echo base_url(); ?>arsip/pdf_frame/<?php echo $id_arsip ?>" width="100%" height="500px"></iframe>
                    <?php } ?>
                </center>
            </div>
        </div>
        <!-- /.modal-content -->
        <div class="modal-footer">
            <a href="<?php echo base_url('arsip/form_telusur_arsip/' . $id_arsip); ?>" class="btn btn-success"><i class="fa fa-send"></i> Telusur Arsip</a>
        </div>
    </div>
</div>