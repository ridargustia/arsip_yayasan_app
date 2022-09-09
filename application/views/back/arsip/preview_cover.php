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
                    <iframe src="<?php echo base_url(); ?>arsip/pdf_frame/<?php echo $id_arsip ?>" width="100%" height="500px"></iframe>
                </center>
            </div>
        </div>
        <!-- /.modal-content -->
        <div class="modal-footer">

        </div>
    </div>
</div>