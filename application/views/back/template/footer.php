  <footer class="main-footer">
    <?php echo $footer->content ?>
  </footer>

  <!-- jQuery 3 -->
  <script src="<?php echo base_url('assets/plugins/') ?>jquery/dist/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="<?php echo base_url('assets/plugins/') ?>jquery-ui/jquery-ui.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?php echo base_url('assets/plugins/') ?>bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- Slimscroll -->
  <script src="<?php echo base_url('assets/plugins/') ?>jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="<?php echo base_url('assets/plugins/') ?>fastclick/lib/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url('assets/template/back/') ?>dist/js/adminlte.min.js"></script>
  <!-- SweetAlert -->
  <script src="<?php echo base_url('assets/plugins/') ?>sweetalert/js/sweetalert2.all.min.js"></script>

  <script type="text/javascript">
    const flashData = $('.flash-data').data('flashdata');
    if (flashData === 'Sukses') {
      Swal.fire({
        title: flashData,
        text: 'Pembayaran berhasil dan Arsip sukses dikirim ke email terdaftar',
        icon: 'success',
        showClass: {
          popup: 'animate__animated animate__bounce'
        },
        hideClass: {
          popup: 'animate__animated animate__fadeOutUp'
        },
      });
    }

    $(document).on('click', '#delete-button', function(e) {
      e.preventDefault();
      const link = $(this).attr('href');

      Swal.fire({
        title: 'Apakah anda yakin?',
        text: "Data akan dihapus!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#00a65a',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus!'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location = link;
        }
      })
    });

    $(document).on('click', '#delete-button-permanent', function(e) {
      e.preventDefault();
      const link = $(this).attr('href');

      Swal.fire({
        title: 'Apakah anda yakin?',
        text: "Data akan dihapus secara permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#00a65a',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus!'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location = link;
        }
      })
    });
  </script>