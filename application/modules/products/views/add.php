<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span>Add New Product</span>
                    </div>
					
                    <div class="mws-panel-body no-padding">
					<?php if($message) { echo $message; } ?>
                    	<form class="mws-form" action="<?php echo base_url(); ?>products/add" method="POST">
                    		<div class="mws-form-inline">
							
							<div class="mws-form-row">
                    				<label class="mws-form-label">Code</label>
                    				<div class="mws-form-item">
                    					<input type="text" name="code" class="small" required="required" >
                    				</div>
                    			</div>
								
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">Name</label>
                    				<div class="mws-form-item">
                    					<input type="text" name="name" class="small" required="required" >
                    				</div>
                    			</div>
								
								
								
								<div class="mws-form-row">
                    				<label class="mws-form-label">Size</label>
                    				<div class="mws-form-item">
                    					<input type="text" name="size" value="5kg" class="small" required="required" >
                    				</div>
                    			</div>
								
							
								
								<div class="mws-form-row">
                    				<label class="mws-form-label">Price per Unit</label>
                    				<div class="mws-form-item">
                    					<input type="number" name="price" class="small" required="required" >
                    				</div>
                    			</div>
								
								<div class="mws-form-row">
                    				<label class="mws-form-label">Purchase Price</label>
                    				<div class="mws-form-item">
                    					<input type="number" name="purchase_price" class="small" required="required" >
                    				</div>
                    			</div>
								
								<div class="mws-form-row">
                    				<label class="mws-form-label">Category</label>
                    				<div class="mws-form-item">
                    					<select name="category_id">
											<option value=""> Select Category </option>
											<?php foreach($categories as $list) { ?>
												<option value=" <?php echo $list->id; ?>"> <?php echo $list->name; ?> </option>
											<?php } ?>
										</select>	
                    				</div>
                    			</div>
								
								<div class="mws-form-row">
                    				<label class="mws-form-label">	Quantity </label>
                    				<div class="mws-form-item">
                    					<input type="number" name="quantity" class="small" required="required" >
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