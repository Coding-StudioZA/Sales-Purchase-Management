<script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/js/demo/demo.table.js"></script>

<script type="text/javascript">
    $(function () {
        //$("body").on("click", "#sendformlightbox", function(){
        //    $("#formsubmit").submit();
        //});
        
        $("body").on("click", '.view_sale', function(){
            var value_id = $(this).attr('id');
            var form_data = {
                id: value_id
            };
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url("purchases/get_sale"); ?>',
                data: form_data,
                success: function (msg) {
                    var obj = $.parseJSON(msg);
                    $("#edit_category_id").val(obj['category_id']);
                }
            });
			  $('#myModal').modal('show');
            
        });

        $("body").on("click", "#add_new", function(){
            $("#edit_category_id").val('');
            $("#edit_category_name").val('');
            $("#edit_order_by").val('');
            $("#edit_slug").val('');
            $("#edit_cat_image").val('');
            $("#edit_cat_image_ext").val('');
        });
    });
</script>

<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span><i class="icon-table"></i> Purchases <a href="<?php echo base_url(); ?>purchases/add" style="float:right; margin-top: 0px" class="btn">Add New</a></span>
                    </div>
                    <div class="mws-panel-body no-padding">
                        <table class="mws-table">
                            <thead>
                                <tr>
                                    <th>Bill #</th>
                                    <th>Supplier Name</th>
                                    <th>Total Amount</th>
                                    <th>Total Paid</th>
                               
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>
								<?php foreach($purchases as $row) {  ?>
                                <tr>
                                    
                                    <td> <?php echo $row->bill_no; ?></td>
                                    <td><?php echo $row->supplier_name; ?></td>
                                    <td><?php echo $row->total; ?></td>
                                    <td><?php echo $row->paid . " (" .$row->paid_by.")"; ?></td>
                                   
                                    <td><a href="<?php echo base_url(); ?>purchases/edit/<?php echo $row->id; ?>"> <i class="icol-pencil"> </i> </a>  <a href="javascript:void(0)" class="Delete" data-name="<?php echo $row->bill_no; ?>" data-id="<?php echo $row->id; ?>" title="Delete" href="#"> <i class="icol-cancel"> </i> </a> 
									<a href="<?php echo base_url(); ?>purchases/view/<?php echo $row->id; ?>" id="<?php echo $row->id; ?>"> <i class="icol-eye"> </i> </a>
                                            
                                           
									</td>
                                </tr>
								<?php } ?>
                               
                            </tbody>
                        </table>
						
						
						
                    </div>
                </div>
				
				<div id="pagination" style="font-size:25px; float:right">
<ul class="tsc_pagination">
				<?php echo $this->pagination->create_links(); ?>
				</ul>
				</div>
<script>
    $(document).ready(function(){
        // Confirm Delete.
        $(".Delete").on('click',function() { 
            var id = $(this).data("id");
             var form_data = {
                id: id
            };
             if(confirm("Are you sure you want to delete this?")){
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo site_url("purchases/delete"); ?>',
                        data: form_data,
                        success: function(msg) {
                             location.reload();
                        }
                    });
             } else { 
                 return false;
             }
        }); 
    });
</script>

<style>
	#myModal { 
		display:none;
	}
</style>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>