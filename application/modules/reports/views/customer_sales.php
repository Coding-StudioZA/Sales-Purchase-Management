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
                            <form class="mws-form" action="#">
<div class="mws-form-inline">
<div class="mws-form-row">
                    				<label class="mws-form-label"><strong> Select Customer</strong></label>
                    				 <select id="customer_name" class="large" onchange="document.location.href=this.value">
									 <?php foreach($products as $pro) {  ?>
                                                <option value="<?php echo $pro->id; ?>" <?php if($pro->id == $this->uri->segment(3)) { echo "selected"; }  ?>><?php echo $pro->name ." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; ?></option>
                                                <?php if($pro->id == $this->uri->segment(3)) { $c_name = $pro->name; }  } ?>
                                            </select>
                    			</div>
                    			</div>
								</form>
								
								<div style="float:right"> 
								<button type="button" class="btn btn-warning" onclick="PrintDiv();" style="margin-right:10px; margin-bottom:5px;"  > Print </button> 
								</div>
								
								</div>
                <div class="mws-panel grid_8 mws-collapsible" >
				
                	<div class="mws-panel-header">
                    	 <span id="c_name"> Sales Invoice By Customer <?php echo $c_name; ?> </span>
                    </div>
                    <div class="mws-panel-body no-padding">
                        <table class="mws-table mws-datatable">
                            <thead>
                                <tr>
                                    <th width="20%">Date </th>
                                    <th width="25%">Product Name/Code</th>
                                    <th width="15%">Unit Price</th>
                                    <th width="15%">Quantity</th>
                                    <th width="25%" >Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($product_sales as $row) { ?>
                                <tr>
                                    <td width="20%"><?php echo date("d M Y" , strtotime($row->create_date)); ?></td>
                                    <td width="25%"><?php echo $row->name. " / " . $row->code; ?></td>
                                    <td width="15%"><?php echo $row->sale_price; ?></td>
                                    <td width="15%"><?php echo $row->quantity; ?></td>
                                    <td width="25%"><?php echo $row->sale_price * $row->quantity; ?></td>
                                  
                                </tr>
								<?php } ?>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
				
				
				
				 <div class="mws-panel grid_8 mws-collapsible" style="display:none;" id="divToPrint">
				
                	<div class="mws-panel-header">
                    	 <span id="c_name"> Sales Invoice By Customer <u> <?php echo $c_name;  ?></u> </span>
                    </div>
                    <div class="mws-panel-body no-padding">
                        <table width="100%" class="mws-table mws-datatable">
                            <thead>
                                <tr>
                                    <td width="20%">Date </td>
                                    <td width="25%">Product Name/Code</td>
                                    <td width="15%">Unit Price</td>
                                    <td width="15%">Quantity</td>
                                    <td width="25%" >Total</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($product_sales as $row) { ?>
                                <tr>
                                    <td width="20%"><?php echo date("d M Y" , strtotime($row->create_date)); ?></td>
                                    <td width="25%"><?php echo $row->product_name. " / " . $row->product_code; ?></td>
                                    <td width="15%"><?php echo $row->unit_price; ?></td>
                                    <td width="15%"><?php echo $row->quantity; ?></td>
                                    <td width="25%"><?php echo $row->unit_price * $row->quantity; ?></td>
                                  
                                </tr>
								<?php } ?>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                