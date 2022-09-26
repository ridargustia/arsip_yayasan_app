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
                    $ext_file = explode(".", $file_upload->file_upload);
                    if ($ext_file[1] == "jpg" || $ext_file[1] == "PNG" || $ext_file[1] == "jpeg" || $ext_file[1] == "png") {
                    ?>
                        <img src="<?php echo base_url('assets/file_arsip/' . $file_upload->instansi_name . '/') . $file_upload->file_upload; ?>" width="100%">
                    <?php } elseif ($ext_file[1] == "pdf") { ?>
                        <iframe src="<?php echo base_url(); ?>arsip/pdf_frame/<?php echo $id_arsip ?>" width="100%" height="1050px"></iframe>
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