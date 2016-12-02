<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span>Edit Customer</span>
                    </div>
					
                    <div class="mws-panel-body no-padding">
					<?php if($message) { echo "<div class=\"alert alert-error\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $message . "</div>"; } ?>
                    	<form class="mws-form" action="<?php echo base_url(); ?>customers/edit" method="POST">
                    		<div class="mws-form-inline">
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">Name</label>
                    				<div class="mws-form-item">
                    					<input type="text" value="<?php echo $customer->name; ?>" name="name" class="small" required="required" >
                    					<input type="hidden" value="<?php echo $customer->id; ?>" name="customer_id" class="small" >
                    				</div>
                    			</div>
								
								<div class="mws-form-row">
                    				<label class="mws-form-label">Email</label>
                    				<div class="mws-form-item">
                    					<input type="email" name="email" value="<?php echo $customer->email; ?>" class="small"  >
                    				</div>
                    			</div>
								
								<div class="mws-form-row">
                    				<label class="mws-form-label">Phone</label>
                    				<div class="mws-form-item">
                    					<input type="text" name="phone" value="<?php echo $customer->phone; ?>" class="small" pattern="[0-9]{7,15}" required="required" >
                    				</div>
                    			</div>
								
								<div class="mws-form-row">
                    				<label class="mws-form-label">	Address </label>
                    				<div class="mws-form-item">
                    					<input type="text" name="address" value="<?php echo $customer->address; ?>" class="small"  >
                    				</div>
                    			</div>
								
								<div class="mws-form-row">
                    				<label class="mws-form-label">	City </label>
                    				<div class="mws-form-item">
                    					<input type="text" name="city" value="<?php echo $customer->city; ?>" class="small"  >
                    				</div>
                    			</div>
								
								<div class="mws-form-row">
                    				<label class="mws-form-label">	State </label>
                    				<div class="mws-form-item">
                    					<input type="text" name="state" value="<?php echo $customer->state; ?>" class="small"  >
                    				</div>
                    			</div>
								
								<div class="mws-form-row">
                    				<label class="mws-form-label">	Postal Code </label>
                    				<div class="mws-form-item">
                    					<input type="text" name="postal_code" value="<?php echo $customer->postal_code; ?>" class="small"  >
                    				</div>
                    			</div>
								
								<div class="mws-form-row">
                    				<label class="mws-form-label">	Country </label>
                    				<div class="mws-form-item">
                    					<input type="text" name="country" value="<?php echo $customer->country; ?>" class="small"  >
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