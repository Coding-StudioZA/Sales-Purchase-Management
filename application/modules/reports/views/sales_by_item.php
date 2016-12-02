 <script type="text/javascript">     
    function PrintDiv() {    
       var divToPrint = document.getElementById('divToPrint');
       var popupWin = window.open('', '_blank');
       popupWin.document.open();
       popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
        popupWin.document.close();
            }
			
	
 </script>
 
<div class="mws-panel-body no-padding">
                            <form class="mws-form" action="">
<div class="mws-form-inline">
<div class="mws-form-row">
                    				<label class="mws-form-label"><strong> Select Product</strong></label>
                    				 <select class="large" onchange="document.location.href=this.value">
									 <?php foreach($products as $pro) {  ?>
                                                <option value="<?php echo $pro->id; ?>" <?php if($pro->id == $this->uri->segment(3)) { echo "selected"; }  ?>><?php echo $pro->name . " (" . $pro->code . ") &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; ?></option>
                                                <?php } ?>
                                            </select>
                    			</div>
                    			</div>
								</form>
								
								<div style="float:right"> 
								<button type="button" class="btn btn-warning" onclick="PrintDiv();" style="margin-right:10px; margin-bottom:5px;"  > Print </button> 
								</div>
								</div>
                <div class="mws-panel grid_8 mws-collapsible">
				
                	<div class="mws-panel-header">
                    	<span><i class="icon-table"></i> Sales Invoice By Product </span>
                    </div>
                    <div class="mws-panel-body no-padding">
                        <table class="mws-table mws-datatable">
                            <thead>
                                <tr>
                                    <th>Date </th>
                                    <th>Product Name/Code</th>
                                    <th>Unit Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($product_sales as $row) { ?>
                                <tr>
                                    <td><?php echo date("d M Y" , strtotime($row->create_date)); ?></td>
                                    <td><?php echo $row->name. " / " . $row->code; ?></td>
                                    <td><?php echo $row->sale_price; ?></td>
                                    <td><?php echo $row->quantity; ?></td>
                                    <td><?php echo $row->sale_price * $row->quantity; ?></td>
                                   
                                </tr>
								<?php } ?>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
				
				
				
				
				
				<div class="mws-panel grid_8 mws-collapsible" style="display:none;" id="divToPrint">
				
                	<div class="mws-panel-header">
                    	<span><i class="icon-table"></i> Sales Invoice By Product </span>
                    </div>
                    <div class="mws-panel-body no-padding">
                        <table width="100%" class="mws-table mws-datatable">
                            <thead>
                                <tr>
                                    <td>Date </td>
                                    <td>Product Name/Code</td>
                                    <td>Unit Price</td>
                                    <td>Quantity</td>
                                    <td>Total</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($product_sales as $row) { ?>
                                <tr>
                                    <td><?php echo date("d M Y" , strtotime($row->create_date)); ?></td>
                                    <td><?php echo $row->product_name. " / " . $row->product_code; ?></td>
                                    <td><?php echo $row->unit_price; ?></td>
                                    <td><?php echo $row->quantity; ?></td>
                                    <td><?php echo $row->unit_price * $row->quantity; ?></td>
                                   
                                </tr>
								<?php } ?>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                