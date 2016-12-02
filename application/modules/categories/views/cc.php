<script type="text/javascript">
    window.showEntries = 10;
    window.page = 1;
    window.pageUrlLoad = "<?php echo site_url("categories/AjaxList"); ?>";
</script>
<script src="<?php echo base_url(); ?>assets/plugins/ajax-datatable-custom/blockUI.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/ajax-datatable-custom/adminPanel.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/ajax-datatable-custom/adminCommonFunction.js"></script>

<!-- Inner Container Start -->
<div class="container">
    <div id="ajax_message_jgrowl"></div>
    
    <!-- Panels Start -->
    <div id="loadPageData">
        <div id="ajaxloader"><img src="<?php echo base_url(); ?>assets/plugins/ajax-datatable-custom/img/bigloader.gif" /></div>
    </div>
    
    <div id="loadPageDataAddForm" style="display: none;">
        <div id="ajaxloader"></div>
    </div>
    
    <div id="loadPageDataEditForm" style="display: none;">
        <div id="ajaxloader"></div>
    </div>
    <!-- Panels End -->

</div>