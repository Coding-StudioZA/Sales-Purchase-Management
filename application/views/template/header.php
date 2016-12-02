<div id="mws-header" class="clearfix">
    
    	<!-- Logo Container -->
    	<div id="mws-logo-container">
        
        	<!-- Logo Wrapper, images put within this wrapper will always be vertically centered -->
        	<div id="mws-logo-wrap">
            	Pak Traders
			</div>
        </div>
        
        <!-- User Tools (notifications, logout, profile, change password) -->
        <div id="mws-user-tools" class="clearfix">
            
            <!-- User Information and functions section -->
            <div id="mws-user-info" class="mws-inset">
            
            	<!-- User Photo -->
            	<div id="mws-user-photo">
                    <a href="#" id="mws-form-dialog-mdl-btn" ><img src="<?php echo base_url(); ?>assets/example/profile.jpg" alt="User Photo"> </a>
                </div>
                
                <!-- Username and Functions -->
                <div id="mws-user-functions">
                    <div id="mws-username">
                        Hello, <?php echo $this->session->userdata('username'); ?>
                    </div>
                    <ul>
                    	<!--<li><a href="#">Profile</a></li>
                        <li><a href="#">Change Password</a></li> -->
                        <li><a href="<?php echo base_url(); ?>admin/logout">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>