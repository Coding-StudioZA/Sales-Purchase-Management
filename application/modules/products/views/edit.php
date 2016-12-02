<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span>Edit Product</span>
                    </div>
					
                    <div class="mws-panel-body no-padding">
					<?php if($message) { echo $message; } ?>
                    	<form class="mws-form" action="<?php echo base_url(); ?>products/edit" method="POST">
                    		<div class="mws-form-inline">
							
							<div class="mws-form-row">
                    				<label class="mws-form-label">Code</label>
                    				<div class="mws-form-item">
                    					<input type="text" name="code" value="<?php echo $product->code; ?>" class="small" required="required" >
                    				</div>
                    			</div>
								
                    			<div class="mws-form-row">
                    				<label class="mws-form-label">Name</label>
                    				<div class="mws-form-item">
                    					<input type="text" name="name" value="<?php echo $product->name; ?>" class="small" required="required" >
                    					<input type="hidden" name="product_id" value="<?php echo $product->id; ?>" class="small"  >
                    				</div>
                    			</div>
								
								<div class="mws-form-row">
                    				<label class="mws-form-label">Unit</label>
                    				<div class="mws-form-item">
                    					<input type="text" name="unit" value="<?php echo $product->unit; ?>" class="small" required="required" >
                    				</div>
                    			</div>
								
								<div class="mws-form-row">
                    				<label class="mws-form-label">Size</label>
                    				<div class="mws-form-item">
                    					<input type="size" name="size" value="<?php echo $product->size; ?>" class="small" required="required" >
                    				</div>
                    			</div>
								
								<div class="mws-form-row">
                    				<label class="mws-form-label">Price per Unit</label>
                    				<div class="mws-form-item">
                    					<input type="text" name="price" value="<?php echo $product->price; ?>" class="small" required="required" >
                    				</div>
                    			</div>
								<div class="mws-form-row">
                    				<label class="mws-form-label">Purchase Price</label>
                    				<div class="mws-form-item">
                    					<input type="number" value="<?php echo $product->purchase_price; ?>" name="purchase_price" class="small" required="required" >
                    				</div>
                    			</div>
								
								<div class="mws-form-row">
                    				<label class="mws-form-label">Category</label>
                    				<div class="mws-form-item">
                    					<select name="category_id">
											<option value="" > Select Category </option>
											<?php foreach($categories as $list) { ?>
												<option value="<?php echo $list->id; ?>" <?php if($product->category_id == $list->id) { ?>  selected <?php } ?>> <?php echo $list->name; ?> </option>
											<?php } ?>
										</select>	
                    				</div>
                    			</div>
								
								<div class="mws-form-row">
                    				<label class="mws-form-label">	Quantity </label>
                    				<div class="mws-form-item">
                    					<input type="text" value="<?php echo $product->quantity; ?>" name="quantity" class="small" required="required" >
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