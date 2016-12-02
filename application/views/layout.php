<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--><html lang="en"><!--<![endif]-->

<?php echo $this->load->view('template/head'); ?>

<body>

	

	<?php echo $this->load->view('template/header'); ?>
	
    <!-- Start Main Wrapper -->
    <div id="mws-wrapper">
    
    	<?php echo $this->load->view('template/sidebar'); ?>
        <!-- Main Container Start -->
        <div id="mws-container" class="clearfix">
        <div class="container">
        	<!-- Inner Container Start -->
				<?php echo $this->load->view($content); ?>
            <!-- Inner Container End -->
		</div>
            <!-- Footer -->
            <?php echo $this->load->view('template/footer'); ?>
            
        </div>
        <!-- Main Container End -->
        
    </div>

    <!-- JavaScript Plugins -->
    
    <script src="<?php echo base_url(); ?>assets/js/libs/jquery.mousewheel.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/libs/jquery.placeholder.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/custom-plugins/fileinput.js"></script>
    
    <!-- jQuery-UI Dependent Scripts -->
    <script src="<?php echo base_url(); ?>assets/jui/js/jquery-ui-1.9.2.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/jui/jquery-ui.custom.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/jui/js/jquery.ui.touch-punch.js"></script>

    <!-- Plugin Scripts -->
  
    <!--[if lt IE 9]>
    <script src="js/libs/excanvas.min.js"></script>
    <![endif]-->
    <script src="<?php echo base_url(); ?>assets/plugins/flot/jquery.flot.min.js"></script>
  
   
    <script src="<?php echo base_url(); ?>assets/plugins/validate/jquery.validate-min.js"></script>
   
    <!-- Core Script -->

    <script src="<?php echo base_url(); ?>assets/js/core/mws.js"></script>

    <!-- Demo Scripts (remove if not needed) -->
    <script src="<?php echo base_url(); ?>assets/js/demo/demo.dashboard.js"></script>

</body>
</html>