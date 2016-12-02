<script src="<?php echo base_url(); ?>assets/js/jquery-ui/jquery-ui.js"></script>
<script>
  $(function() {
    $("#datepicker" ).datepicker();
  
      $("#datepicker" ).datepicker( "option", "dateFormat", "yy-m-d" );

  });
  </script>
<script type="text/javascript">
    $(document).ready(function(){
		var p_ids = [];
		$("#sale_footer").hide();
		$("body").on("change" , "#product_id" , function() {
			$("#sale_footer").show();
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
				final_amount = parseFloat(final_amount - tax - discount);
				$("#final_price").val(final_amount);
		}
		
		$("body").on("change" , "#tax , #discount" , function() {
			get_total_price();
		});
		$("#check_n").hide();
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
                    	<span>Add New Purchase</span>
                    </div>
					
                    <div class="mws-panel-body no-padding">
						<?php echo $this->session->flashdata('success_message'); ?>
                    	<form class="mws-form" action="<?php echo base_url(); ?>purchases/add" method="POST">
                    		<div class="mws-form-row">
								<div class="mws-form-cols">
                                    <div class="mws-form-col-2-8">
                                        <label class="mws-form-label">Bill Number</label>
                                        <div class="mws-form-item">
                                            <input type="text" name="bill_no" id="bill_no" required placeholder="Bill Number">
                                        </div>
                                    </div>
                                    <div class="mws-form-col-2-8">
                                        <label class="mws-form-label">Date</label>
                                        <div class="mws-form-item">
                                             <input type="text" name="date" class="datepicker" id="datepicker" required placeholder="Date">
                                        </div>
                                    </div>
									
									
									 <div class="mws-form-col-2-8">
                                        <label class="mws-form-label">Credit Days</label>
                                        <div class="mws-form-item">
                                            <input type="text" name="credit_days" value="0" min=0 id="credit_days" required placeholder="Credit Days">
                                        </div>
                                    </div>
									
                                    <div class="mws-form-col-2-8">
                                        <label class="mws-form-label">Supplier</label>
                                        <div class="mws-form-item">
                                        <select name="supplier_id" id="supplier_id" required>
											<option value=""> Select Supplier </option> 
											<?php foreach($suppliers as $customer) { ?>
                    						<option value="<?php echo $customer->id; ?>"><?php echo $customer->name; ?></option>
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
											<?php  foreach($products as $product) { ?>
                    						<option value="<?php echo $product->id; ?>"><?php echo $product->name . "(".$product->size.")"; ?></option>
											<?php } ?>
                    					</select>
                                        </div>
                                    </div>
									<div class="mws-form-col-1-8">
                                        <label class="mws-form-label">Paid Amount</label>
										<div class="mws-form-item">
											<input type="number"  id="paid" name="paid" />
										</div>
									</div>
									
									<div class="mws-form-col-1-8">
                                        <label class="mws-form-label">Payment Type</label>
										<div class="mws-form-item">
										<select name="payment_method" id="payment_method"  onchange="">
											<option value="cash" > Cash </option>
											<option value="cheque" > Cheque </option>
										</select>
										</div>
									</div>
									
									<div class="mws-form-col-3-8" id="check_n">
                                        <label class="mws-form-label">Cheque #</label>
										<div class="mws-form-item">
											<input type="text" value="" id="cheque_no" name="cheque_no" />
										</div>
									</div>
									
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
                                
							</tbody>
							<br />
							<thead id="sale_footer" >
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
									<th> <input type="text" value="0" min=0 name="tax" id="tax" style="" /> </th>
								</tr>
								
								<tr>
									
									<th colspan=5> Discount </th>
									<th> <input type="text" value="0" min=0 name="discount" id="discount" style="" /> </th>
								</tr>
								
								
								<tr>
									
									<th colspan=5> Total Price </th>
									<th> <input type="text" readonly name="final_price" id="final_price" style="" /> </th>
								</tr>
							</thead>
						</table>
						<input type="hidden" id="p_ids">
						</div>
						<br />
					</div>
							<div class="mws-form-cols">
                                    <div class="mws-form-col-8-8">
                                        <label class="mws-form-label">Note </label>
                                        <div class="mws-form-item">
                                            <textarea name="note" > </textarea>
                                        </div>
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