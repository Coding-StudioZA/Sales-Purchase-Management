 <div id="mws-footer">
            	Copyright Pak Traders Lahore 2010. All Rights Reserved.
            </div>


    <script src="<?php echo base_url(); ?>assets/js/libs/jquery.mousewheel.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/libs/jquery.placeholder.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/custom-plugins/fileinput.min.js"></script>

    <!-- jQuery-UI Dependent Scripts -->
    <script src="<?php echo base_url(); ?>assets/jui/js/jquery-ui-1.9.2.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/jui/jquery-ui.custom.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/jui/js/jquery.ui.touch-punch.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/jui/js/timepicker/jquery-ui-timepicker.min.js"></script>

    <!-- Plugin Scripts -->
    <script src="<?php echo base_url(); ?>assets/plugins/imgareaselect/jquery.imgareaselect.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/jgrowl/jquery.jgrowl-min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/validate/jquery.validate-min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/colorpicker/colorpicker-min.js"></script>

    <!-- Core Script -->
    <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/core/mws.js"></script>

    <!-- Themer Script (Remove if not needed) -->
    <script src="<?php echo base_url(); ?>assets/js/core/themer.js"></script>

    <!-- Demo Scripts (remove if not needed) -->
    <script src="<?php echo base_url(); ?>assets/js/demo/demo.widget.js"></script>

    <style> 
        .ui-dialog-title { display: none;}
        </style>
        
        
<div class="mws-panel grid_4">
                	
                    <div class="mws-panel-body" style="text-align: center; display: none">
                    	<div class="mws-panel-content">
                        
                            <div id="mws-form-dialog">
                                <form id="mws-validate" class="mws-form" method="POST" action="<?php echo base_url(); ?>admin/change_profile">
                                    <div id="mws-validate-error" class="mws-form-message error" style="display:none;"></div>
                                    <div class="mws-form-inline">
                                        <h3> Update User Profile</h3>
                                        <small style="color:red"> Your Changes will apply next time. </small><br>
                                        <small style="color:red"> If you don't want to change password leave EMPTY. </small>
                                        <br> <br>
                                        <div class="mws-form-row">
                                            <label class="mws-form-label">Name</label>
                                            <div class="mws-form-item">
                                                <input type="text" name="name" value="<?php echo $this->session->userdata('name'); ?>" class="">
                                            </div>
                                        </div>
                                        
                                        <div class="mws-form-row">
                                            <label class="mws-form-label">Username</label>
                                            <div class="mws-form-item">
                                                <input type="text" name="username" value="<?php echo $this->session->userdata('username'); ?>" class="">
                                            </div>
                                        </div>
                                        
                                        <div class="mws-form-row">
                                            <label class="mws-form-label">Password </label>
                                            <div class="mws-form-item">
                                                <input type="password" name="password" class="">
                                            </div>
                                        </div>
                                       
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>    	
                </div>
