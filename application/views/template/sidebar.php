<!-- Necessary markup, do not remove -->
		<div id="mws-sidebar-stitch"></div>
		<div id="mws-sidebar-bg"></div>
        
        <!-- Sidebar Wrapper -->
        <div id="mws-sidebar">
        
            <!-- Hidden Nav Collapse Button -->
            <div id="mws-nav-collapse">
                <span></span>
                <span></span>
                <span></span>
            </div>
            
        	<!-- Searchbox -->
        	<div id="mws-searchbox" class="mws-inset">
            	<form action="#">
                	<input type="text" class="mws-search-input" placeholder="Search...">
                    <button type="submit" class="mws-search-submit"><i class="icon-search"></i></button>
                </form>
            </div>
            
            <!-- Main Navigation -->
            <div id="mws-navigation">
                <ul>
                    <li <?php if($this->uri->segment(1) == "" ) {  ?>class="active" <?php } ?>><a href="<?php echo base_url(); ?>"><i class="icon-home"></i> Dashboard</a></li>
                    <li <?php if($this->uri->segment(1) == "categories" ) {  ?>class="active" <?php } ?>><a href="<?php echo base_url(); ?>categories"><i class="icon-th-list"></i> Categories</a></li>
                    <li <?php if($this->uri->segment(1) == "products" ) { ?>class="active" <?php } ?>><a href="<?php echo base_url(); ?>products"><i class="icon-database"></i> Products</a></li>
                    <li <?php if($this->uri->segment(1) == "customers" ) { ?>class="active" <?php } ?>><a href="<?php echo base_url(); ?>customers"><i class="icon-users"></i> Customers</a></li>
                    <li <?php if($this->uri->segment(1) == "suppliers" ) { ?>class="active" <?php } ?>><a href="<?php echo base_url(); ?>suppliers"><i class="icon-users"></i> Suppliers</a></li>
                    <li <?php if($this->uri->segment(1) == "sales" ) { ?>class="active" <?php } ?>><a href="<?php echo base_url(); ?>sales"><i class="icon-shopping-cart"></i> Sales</a></li>
                    <li <?php if($this->uri->segment(1) == "purchases" ) { ?>class="active" <?php } ?>><a href="<?php echo base_url(); ?>purchases"><i class="icon-shopping-cart"></i> Purchases</a></li>
					
					<li>
                        <a href="#" <?php if($this->uri->segment(1) == "reports" ) { ?>class="active" <?php } ?>><i class="icon-list-2"></i> Reports</a>
                        <ul>
                            <li><a href="<?php echo base_url(); ?>reports/top_sales_items">Sales by Items</a></li>
                            <li><a href="<?php echo base_url(); ?>reports/sales_by_customer">Sales by Customers</a></li>
                          
                        </ul>
                    </li>
                    
                </ul>
            </div>         
        </div>