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
				<div style="float:right"> 
								<button type="button" class="btn btn-warning" onclick="PrintDiv();" style="margin-right:10px; margin-bottom:5px;"  > Print </button> 
								</div>
								</div>
                <div class="mws-panel grid_8 mws-collapsible">
				
                	<div class="mws-panel-header">
                    	<span><i class="icon-table"></i> Most Sales Items By Customers </span>
                    </div>
                    <div class="mws-panel-body no-padding">
                        <table class="mws-table mws-datatable">
                            <thead>
                                <tr>
                                    <th>Customer Name</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Option </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($product_sales as $row) { ?>
                                <tr>
                                    <td><?php echo $row->customer_name; ?></td>
                                    <td><?php echo $row->Qty; ?></td>
                                    <td><?php echo $row->total_earning; ?></td>
                                    <td>
                                        <span class="btn-group">
                                            <a href="<?php echo base_url(); ?>reports/customer_sales/<?php echo $row->customer_id; ?>" class="btn btn-small"><i class="icon-eye-open"></i></a>
                                           
                                        </span>
                                    </td>
                                </tr>
								<?php } ?>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                
				
				
				
				
				
				
				
				 <div class="mws-panel grid_8 mws-collapsible" style="display:none;" id="divToPrint">
                	<div class="mws-panel-header">
                    	<span><i class="icon-table"></i> Most Sales Items </span>
                    </div>
                    <div class="mws-panel-body no-padding">
                        <table width="100%" class="mws-table mws-datatable">
                            <thead>
                                <tr>
                                    <td>Customer Name</td>
                                    <td>Quantity</td>
                                    <td>Total</td>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($product_sales as $row) { ?>
                                <tr>
                                    <td><?php echo $row->customer_name; ?></td>
                                    <td><?php echo $row->Qty; ?></td>
                                    <td><?php echo $row->total_earning; ?></td>
                                  
                                </tr>
								<?php } ?>
                                
                            </tbody>
                        </table>
                    </div>
                </div>