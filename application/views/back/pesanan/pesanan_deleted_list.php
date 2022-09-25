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

            <div class="box box-primary">
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="dataTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="text-align: center">No</th>
                                    <th style="text-align: center">Nama Pemesan</th>
                                    <th style="text-align: center">Arsip</th>
                                    <th style="text-align: center">Divisi</th>
                                    <th style="text-align: center">Cabang</th>
                                    <?php if (is_grandadmin()) { ?>
                                        <th style="text-align: center">Instansi</th>
                                    <?php } ?>
                                    <th style="text-align: center">Pembayaran</th>
                                    <th style="text-align: center">Created By</th>
                                    <th style="text-align: center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($get_all_deleted as $data) {
                                    //TODO Status Pembayaran
                                    if ($data->is_paid == 0) {
                                        $is_paid = "<button class='btn btn-xs btn-danger'><i class='fa fa-remove'></i> Belum</button> ";
                                    } elseif ($data->is_paid == 1) {
                                        $is_paid = "<button class='btn btn-xs btn-success'><i class='fa fa-check'></i> Sudah</button> ";
                                    }

                                    //TODO action button
                                    $restore = '<a href="' . base_url('admin/pesanan/restore/' . $data->id_order) . '" class="btn btn-sm btn-primary" title="Restore Pesanan"><i class="fa fa-refresh"></i></a>';
                                    $delete = '<a href="' . base_url('admin/pesanan/delete_permanent/' . $data->id_order) . '" id="delete-button-permanent" class="btn btn-sm btn-danger" title="Hapus Permanen"><i class="fa fa-remove"></i></a>';
                                ?>
                                    <tr>
                                        <td style="text-align: center"><?php echo $no++ ?></td>
                                        <td style="text-align: center"><?php echo $data->name ?></td>
                                        <td style="text-align: center"><?php echo $data->arsip_name ?></td>
                                        <td style="text-align: center"><?php echo $data->divisi_name ?></td>
                                        <td style="text-align: center"><?php echo $data->cabang_name ?></td>
                                        <?php if (is_grandadmin()) { ?>
                                            <td style="text-align: center"><?php echo $data->instansi_name ?></td>
                                        <?php } ?>
                                        <td style="text-align: center"><?php echo $is_paid ?></td>
                                        <td style="text-align: center"><?php echo $data->created_by_orders ?></td>
                                        <td style="text-align: center"><?php echo $restore ?> <?php echo $delete ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
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
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>

</div>
<!-- ./wrapper -->

</body>

</html>