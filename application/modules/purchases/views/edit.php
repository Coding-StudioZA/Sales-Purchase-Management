<script src="<?php echo base_url(); ?>assets/js/jquery-ui/jquery-ui.js"></script>
<script>
  $(function() {
    $("#datepicker" ).datepicker();
  
      $("#datepicker" ).datepicker( "option", "dateFormat", "yy-m-d" );

  });
  </script>
<script type="text/javascript">
    $(document).ready(function(){
		//var p_ids = $("#p_ids").val();
		//$("#purchase_footer").hide();
		$("body").on("change" , "#product_id" , function() {
			$("#purchase_footer").show();
			product_id = $('#product_id').val();
			var form_data = {
				product_id : product_id
			};
			
			var total_qty = parseInt($("#qty_"+product_id).val());
			var price = parseInt($("#price_"+product_id).val());
			if(total_qty > 0) { 
				var quantity = total_qty + 1;
				 $("#qty_"+product_id).val(quantity);
				 $("#toatlprice_"+product_id).val(quantity * price);
				 $("#product_id").val('');
				 get_total_price();
			} else { 
				p_ids.push(product_id);
				$("#p_ids").val(p_ids.join());
				$.ajax({
					type: 'POST',
					url: '<?php echo site_url("purchases/add_product_ajax"); ?>',
					data:form_data,
					success: function(msg) {
					   $("#new_product").append(msg);
					   $("#product_id").val('');
					   get_total_price();
					}
				});
			}
			
			
			
		});
		
		$("body").on("change" , ".change_qty" , function() {
			var product_id = $(this).attr('data-id');
			var total_qty = parseInt($("#qty_"+product_id).val());
			var price = parseInt($("#price_"+product_id).val());
			$("#toatlprice_"+product_id).val(total_qty * price);
			get_total_price();
		});
		
		function get_total_price() { 
			  var pro_ids = $("#p_ids").val();
				var final_amount = 0;
				 pro_ids = pro_ids.split(',');
				$.each(pro_ids, function( index, value ) {
					var t_price =  parseFloat($("#toatlprice_"+value).val());
					final_amount = parseFloat(final_amount + t_price);
				});
				
				var tax =  parseFloat($("#tax").val());
				var discount =  parseFloat($("#discount").val());
				final_amount = parseFloat(final_amount + tax - discount);
				$("#final_price").val(final_amount);
		}
		
		$("body").on("change" , "#tax , #discount" , function() {
			get_total_price();
		});
		//$("#check_n").hide();
		$("body").on("change" , "#payment_method" , function() {
			var payment_value = $("#payment_method").val();
			if(payment_value == "cheque") { 
				$("#check_n").show();
			} else { 
				$("#check_n").hide();
			}
		});
		
	});
</script>

<style>
	.mws-form-label{ 
		font-weight:bold;
	}
</style>


<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span>Edit Purchase</span>
                    </div>
					
                    <div class="mws-panel-body no-padding">
						<?php echo $this->session->flashdata('success_message'); ?>
                    	<form class="mws-form" action="<?php echo base_url(); ?>purchases/edit/<?php echo $purchase->id; ?>" method="POST">
                    		<div class="mws-form-row">
								<div class="mws-form-cols">
                                    <div class="mws-form-col-2-8">
                                        <label class="mws-form-label">Bill Number</label>
                                        <div class="mws-form-item">
                                            <input type="text" name="bill_no" id="bill_no" required placeholder="Bill Number" value="<?php echo $purchase->bill_no; ?>">
                                        </div>
                                    </div>
                                    <div class="mws-form-col-2-8">
                                        <label class="mws-form-label">Date</label>
                                        <div class="mws-form-item">
                                             <input type="text" name="date" class="datepicker" id="datepicker"  placeholder="<?php echo date("Y-m-d" , strtotime($purchase->create_date)); ?>" value="<?php echo date("Y-m-d" , strtotime($purchase->create_date)); ?>">
                                        </div>
                                    </div>
									
									 <div class="mws-form-col-2-8">
                                        <label class="mws-form-label">Credit Days</label>
                                        <div class="mws-form-item">
                                            <input type="text" name="credit_days" value="<?php echo $purchase->credit_days; ?>" min=0 id="credit_days" required placeholder="Credit Days" >
                                        </div>
                                    </div>
									
                                    <div class="mws-form-col-2-8">
                                        <label class="mws-form-label">Suppliers</label>
                                        <div class="mws-form-item">
                                        <select name="supplier_id" id="supplier_id" required>
											<option value=""> Select Supplier </option> 
											<?php foreach($suppliers as $customer) { ?>
                    						<option value="<?php echo $customer->id; ?>" <?php if($purchase->supplier_id == $customer->id) { echo "selected"; } ?>><?php echo $customer->name; ?></option>
											<?php } ?>
                    					</select>
                                        </div>
                                    </div>
									
                                </div>
								
								<br />
								
								<div class="mws-form-cols">
                                  
                                    <div class="mws-form-col-3-8">
                                        <label class="mws-form-label">Product</label>
                                        <div class="mws-form-item">
                                        <select name="product_id" id="product_id"  onchange="">
											<option value=""> Select Product </option> 
											<?php foreach($products as $product) { ?>
                    						<option value="<?php echo $product->id; ?>"><?php echo $product->name . "(".$product->size.")"; ?></option>
											<?php } ?>
                    					</select>
                                        </div>
                                    </div>
									<div class="mws-form-col-1-8">
                                        <label class="mws-form-label">Paid Amount</label>
										<div class="mws-form-item">
											<input type="number" value="<?php echo $purchase->paid; ?>" id="paid" name="paid" />
										</div>
									</div>
									
									<div class="mws-form-col-1-8">
                                        <label class="mws-form-label">Payment Type</label>
										<div class="mws-form-item">
										<select name="payment_method" id="payment_method"  onchange="">
											<option value="cash" <?php if($purchase->paid_by == "cash") { echo "selected"; } ?>> Cash </option>
											<option value="cheque" <?php if($purchase->paid_by == "cheque") { echo "selected"; } ?>> Cheque </option>
										</select>
										</div>
									</div>
									<?php if($purchase->cheque_no) {  ?>
									<div class="mws-form-col-3-8" id="check_n">
                                        <label class="mws-form-label">Cheque #</label>
										<div class="mws-form-item">
											<input type="text" value="<?php echo $purchase->cheque_no; ?>" id="cheque_no" name="cheque_no" />
										</div>
									</div>
									<?php } ?>
									
                                </div>
								<br />
					<div class="mws-form-cols">	
					 <label class="mws-form-label">Invoice Items</label>
						<div class="mws-panel-body no-padding">
                        <table class="mws-table">
                            <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Item</th>
                                    <th>Quantity</th>
                                    <th>Packing</th>
                                    <th>Price Per Unit</th>
                                    <th> Total Price</th>
                                </tr>
                            </thead>
                            <tbody id="new_product">
								<?php $i =0; $p_ids = []; foreach($purchase_items as $row)  {  ?>
									<tr>
									<td> <?php echo  $row->code; ?> </td>
									<td><?php echo $row->name; ?> 
									</td><td><input type='number' class='change_qty' data-id='<?php echo $row->product_id; ?>' value='<?php echo $row->purchase_quantity; ?>' min=1 id='qty_<?php echo $row->product_id; ?>' name='qty_<?php echo  $row->product_id; ?>'> 
									<input type='hidden' name='product_ids[]' value='<?php echo $row->product_id; ?>'> </td>
									<td> <?php echo $row->unit; ?> </td>
									<td> <input type='text' width='5%' readonly value='<?php echo $row->unit_price; ?>' min=1 id='price_<?php echo $row->product_id; ?>' ></td>
									<td> <input type='text' width='5%' readonly value='<?php echo $row->unit_price * $row->purchase_quantity; ?>' min=1 id='toatlprice_<?php echo  $row->product_id; ?>' ></td>
									</tr>
								<?php $p_ids[$i] = $row->product_id; $i = $i+1; } 
									
									$product_data = implode(',' , $p_ids);
									//print_r($product_data);
								?>
                                
							</tbody>
							<br />
							<thead id="purchase_footer" >
								<tr>
									<th> </th>
									<th> </th>
									<th> </th>
									<th> </th>
									<th> </th>
									<th> </th>
								</tr>
								
								<tr>
									
									<th colspan=5> Tax </th>
									<th> <input type="text"  min=0 name="tax" value="<?php echo $purchase->total_tax; ?>" id="tax" style="" /> </th>
								</tr>
								
								<tr>
									
									<th colspan=5> Discount </th>
									<th> <input type="text" value="<?php echo $purchase->inv_discount; ?>"  min=0 name="discount" id="discount" style="" /> </th>
								</tr>
								
								
								<tr>
									
									<th colspan=5> Total Price </th>
									<th> <input type="text" readonly value="<?php echo $purchase->total; ?>" name="final_price" id="final_price" style="" /> </th>
								</tr>
							</thead>
						</table>
						<input type="hidden" value="<?php echo $product_data; ?>" id="p_ids">
						</div>
						<br />
					</div>
							<div class="mws-form-cols">
                                    <div class="mws-form-col-8-8">
                                        <label class="mws-form-label">Note </label>
                                        <div class="mws-form-item">
                                            <textarea name="note" > <?php echo $purchase->note; ?> </textarea>
                                        </div>
                                    </div>
                                    
                                </div>
							
							
                    		</div>
                    		<div class="mws-button-row">
                    			<input type="submit" value="Update" class="btn btn-success">
                    		</div>
                    	</form>
                    </div>    	
                </div>
				