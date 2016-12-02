<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span><i class="icon-table"></i> Categories <a href="<?php echo base_url(); ?>categories/add" style="float:right;" class="btn">Add New</a></span>
                    </div>
                
                <input type='hidden' name='hiddenShowDataEntries' id='hiddenShowDataEntries' value='<?php echo ($per_page)?$per_page:5; ?>' />
                <input type='hidden' name='hiddenSearchResult' id='hiddenSearchResult' value='<?php echo ($searchResults)?$searchResults:""; ?>' />
                <input type='hidden' name='hiddenShowMeta' id='hiddenShowMeta' value='<?php echo ($meta)?$meta:"id"; ?>' />
                <input type='hidden' name='hiddenShowOrder' id='hiddenShowOrder' value='<?php echo ($order)?$order:"ASC"; ?>' />
                <input type='hidden' name='hiddenPage' id='hiddenPage' value='<?php echo ($page)?$page:1; ?>' />
                
                <div class="mws-panel-body no-padding">
						<div class="dataTables_wrapper">
                            <div class="dataTables_length"><label>Show <select size="1" name="showDataEntries" id="showDataEntries"><option value="10" <?php echo ($per_page == 10)?"selected":''; ?>>10</option><option value="25" <?php echo ($per_page == 25)?"selected":''; ?>>25</option><option value="50" <?php echo ($per_page == 50)?"selected":''; ?>>50</option><option value="100" <?php echo ($per_page == 100)?"selected":''; ?>>100</option><option value="300" <?php echo ($per_page == 300)?"selected":''; ?>>300</option><option value="500" <?php echo ($per_page == 500)?"selected":''; ?>>500</option><option value="1000" <?php echo ($per_page == 1000)?"selected":''; ?>>1000</option></select> entries</label></div>
                            <div class="dataTables_filter"><label>Search:<input type="search" id='searchResult' class="" value='<?php echo $searchResults ?>' placeholder='Enter Keyword...' autofocus='true'></label></div>
                            
                            <table class="mws-datatable-fn mws-table">
                            <thead>
                                <tr>
                                   
                                    <th width="30%">
                                        <a class="sortOrder" data-meta="category_name" data-order="ASC" data-title="Category Name" title="Sort Category Name ASC" style="cursor:pointer;"><i class="fa fa-caret-down"></i></a>
                                        Name
                                        <a class="sortOrder" data-meta="category_name" data-order="DESC" data-title="Category Name" title="Sort Category Name DESC" style="cursor:pointer;"><i class="fa fa-caret-up"></i></a>
                                    </th>
                                    
                                    <th width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if($recCount > 0) {
                                    foreach ($Query as $row) {

                                        $id = $row->id;
                                        /***Don't Alter these values***/
                                        $action_is_active = "status";
                                        $action_temp_delete = "temp_delete"; 
                                        $action_perm_delete = "perm_delete";
                                        $row_id = "row_".$id;
                                        /***Alter values as per need***/
                                        $req_page = "category_page";
                                        $column_status = "column_status";
                                        $column_action = "column_action";
                                        $url = site_url("categories/AjaxCall");

                                      /*  if($row->cat_status == 1){
                                            $chek = "<img src=". base_url().'assets/images/icons/accept.png'." title='Click here to deactivate this row' style='margin: 0px 12px;'>"; 
                                        } else {
                                            $chek = "<img src=". base_url().'assets/images/icons/delete.png'." title='Click here to activate this row' style='margin: 0px 12px;'>";
                                        } */

                                      //  $is_active = "<div id='".$column_status.$id."'><a href='javascript:ajax_call(".$id.", \"$action_is_active\", \"$req_page\", \"$column_status\", \"$url\", false)'>".$chek."</a></div>";
                                       // $is_delete = "<a href='javascript:ajax_call(".$id.", \"$action_perm_delete\", \"$req_page\", \"$column_action\", \"$url\", \"$row_id\")' onclick=\"return confirm('Are you sure, you want to delete this row permanently ? ');\" title='Click To Delete'><i class='fa fa-trash-o fa-lg'></i></a>";
                                    ?>
                                    <tr id="<?php echo $row_id ?>">
                                      
                                        <td><?php echo $row->name; ?></td>
                                        <td>
                                            
                                        </td>
                                    </tr>
                                    <?php } } else { ?>
                                    <tr>
                                        <td colspan='2'>No Result Founds!</td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>

                            
                                        <?php 
                                            $no_of_paginations = ceil($recCount / $per_page);
                                            echo getPagination($recCount, $no_of_paginations, $cur_page, $first_btn, $last_btn, $previous_btn, $next_btn);
                                        ?>
                                   
                        </div>
                        </div>
            </div>
