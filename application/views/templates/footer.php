<!-- jQuery -->
<script src="<?php echo base_url('plugins') ?>/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url('plugins') ?>/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
	$.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url('plugins') ?>/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<!-- Sparkline -->
<script src="<?php echo base_url('plugins') ?>/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="<?php echo base_url('plugins') ?>/jqvmap/jquery.vmap.min.js"></script>
<script src="<?php echo base_url('plugins') ?>/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url('plugins') ?>/moment/moment.min.js"></script>
<script src="<?php echo base_url('plugins') ?>/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo base_url('plugins') ?>/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?php echo base_url('plugins') ?>/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo base_url('plugins') ?>/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('dist') ?>/js/adminlte.js"></script>

<script>
	$(document).ready(function() {
		setTimeout(() => {
			$('.alert').slideUp(1000, () => {
				$('.alert').hide();
			});
		}, 2000);
	});
</script>

</html>
