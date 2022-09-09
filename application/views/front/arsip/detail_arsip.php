<?php $this->load->view('front/template/meta'); ?>

<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->

<body class="hold-transition skin-blue layout-top-nav">
  <div class="wrapper">

    <?php $this->load->view('front/template/navbar'); ?>

    <div class="content-wrapper">
      <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>Detail Arsip</h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo base_url() ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"> Detail Arsip</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="box box-primary">
            <div class="box-body">
              <div class="row">
                <div class="col-sm-3">
                  <iframe src="<?php echo base_url() ?>arsip/pdf_frame/<?php echo $detail_arsip->id_arsip ?>" width="100%" height="300px"></iframe>
                  <center>
                    <a href="#" onclick="previewCover(<?php echo $detail_arsip->id_arsip ?>)" title="Preview Cover" class="btn btn-success" style="width: 100%;">Preview</a>
                  </center>
                </div>
                <div class="col-sm-9">
                  <table class="table">
                    <tbody>
                      <tr>
                        <td style="width:200px">Nomor Arsip</td>
                        <td style="width:10px">:</td>
                        <td class="text-left"><?php echo $detail_arsip->no_arsip ?></td>
                      </tr>
                      <tr>
                        <td>Instansi</td>
                        <td style="width:10px">:</td>
                        <td class="text-left"><?php echo $detail_arsip->instansi_name ?></td>
                      </tr>
                      <tr>
                        <td>Cabang</td>
                        <td style="width:10px">:</td>
                        <td class="text-left"><?php echo $detail_arsip->cabang_name ?></td>
                      </tr>
                      <tr>
                        <td>Divisi</td>
                        <td style="width:10px">:</td>
                        <td class="text-left"><?php echo $detail_arsip->divisi_name ?></td>
                      </tr>
                      <tr>
                        <td>Nama Arsip</td>
                        <td style="width:10px">:</td>
                        <td class="text-left"><?php echo $detail_arsip->arsip_name ?></td>
                      </tr>
                      <tr>
                        <td>Deskripsi Arsip</td>
                        <td style="width:10px">:</td>
                        <td class="text-left"><?php echo $detail_arsip->deskripsi_arsip ?></td>
                      </tr>
                      <tr>
                        <td>Lokasi Arsip</td>
                        <td style="width:10px">:</td>
                        <td class="text-left"><?php echo $detail_arsip->lokasi_name ?></td>
                      </tr>
                      <tr>
                        <td>Nomor Rak</td>
                        <td style="width:10px">:</td>
                        <td class="text-left"><?php echo $detail_arsip->rak_name ?></td>
                      </tr>
                      <tr>
                        <td>Nomor Baris</td>
                        <td style="width:10px">:</td>
                        <td class="text-left"><?php echo $detail_arsip->baris_name ?></td>
                      </tr>
                      <tr>
                        <td>Nomor Box</td>
                        <td style="width:10px">:</td>
                        <td class="text-left"><?php echo $detail_arsip->box_name ?></td>
                      </tr>
                      <tr>
                        <td>Nomor Map</td>
                        <td style="width:10px">:</td>
                        <td class="text-left"><?php echo $detail_arsip->map_name ?></td>
                      </tr>
                      <tr>
                        <td>Masa Retensi</td>
                        <td style="width:10px">:</td>
                        <td class="text-left"><?php echo $detail_arsip->masa_retensi ?></td>
                      </tr>
                      <tr>
                        <td>Dibuat Pada</td>
                        <td style="width:10px">:</td>
                        <td class="text-left"><?php echo $detail_arsip->waktu_dibuat ?></td>
                      </tr>
                      <tr>
                        <td>Dibuat Oleh</td>
                        <td style="width:10px">:</td>
                        <td class="text-left"><?php echo $detail_arsip->name ?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <a href="<?php echo base_url('home') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali ke halaman sebelumnya</a>

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

      function loadPreview(id_arsip) {
        // var url = "buku/ajax_label/" + id + "/";
        $.ajax({
          url: "<?php echo base_url(); ?>arsip/ajax_preview_cover/" + id_arsip + "",
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