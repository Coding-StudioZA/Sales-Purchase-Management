<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span>Add New Customer</span>
                    </div>
					
                    <div class="mws-panel-body no-padding">
					<?php if($message) { echo "<div class=\"alert alert-error\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $message . "</div>"; } ?>
                    	<form class="mws-form" action="<?php echo base_url(); ?>customers/add" method="POST">
                    		<div class="mws-form-inline">
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">Name</label>
                    				<div class="mws-form-item">
                    					<input type="text" name="name" class="small" required="required" >
                    				</div>
                    			</div>
								
								<div class="mws-form-row">
                    				<label class="mws-form-label">Email</label>
                    				<div class="mws-form-item">
                    					<input type="email" name="email" class="small" >
                    				</div>
                    			</div>
								
								<div class="mws-form-row">
                    				<label class="mws-form-label">Phone</label>
                    				<div class="mws-form-item">
                    					<input type="text" name="phone" class="small" pattern="[0-9]{7,15}" required="required" >
                    				</div>
                    			</div>
								
								<div class="mws-form-row">
                    				<label class="mws-form-label">	Address </label>
                    				<div class="mws-form-item">
                    					<input type="text" name="address" class="small"  >
                    				</div>
                    			</div>
								
								<div class="mws-form-row">
                    				<label class="mws-form-label">	City </label>
                    				<div class="mws-form-item">
                    					<input type="text" name="city" class="small"  >
                    				</div>
                    			</div>
								
								<div class="mws-form-row">
                    				<label class="mws-form-label">	State </label>
                    				<div class="mws-form-item">
                    					<input type="text" name="state" class="small"  >
                    				</div>
                    			</div>
								
								<div class="mws-form-row">
                    				<label class="mws-form-label">	Postal Code </label>
                    				<div class="mws-form-item">
                    					<input type="text" name="postal_code" class="small"  >
                    				</div>
                    			</div>
								
								<div class="mws-form-row">
                    				<label class="mws-form-label">	Country </label>
                    				<div class="mws-form-item">
                    					<input type="text" name="country" class="small"  >
                    				</div>
                    			</div>
								
								<div class="mws-form-row">
                    				<label class="mws-form-label">	Company </label>
                    				<div class="mws-form-item">
                    					<input type="text" name="company" class="small"  >
                    				</div>
                    			</div>
							
                    		</div>
                    		<div class="mws-button-row">
                    			<input type="submit" value="Submit" class="btn btn-danger">
                    			<input type="reset" value="Reset" class="btn ">
                    		</div>
                    	</form>
                    </div>    	
                </div>