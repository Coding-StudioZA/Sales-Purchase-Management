<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span>Add New Category</span>
                    </div>
					
                    <div class="mws-panel-body no-padding">
					<?php if($message) { echo "<div class=\"alert alert-error\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $message . "</div>"; } ?>
                    	<form class="mws-form" action="<?php echo base_url(); ?>categories/add" method="POST">
                    		<div class="mws-form-inline">
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">Name</label>
                    				<div class="mws-form-item">
                    					<input type="text" name="name" class="small" required="required" >
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