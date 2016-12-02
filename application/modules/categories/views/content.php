<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/demo/demo.table.js"></script>
<div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span><i class="icon-table"></i> Categories <a href="<?php echo base_url(); ?>categories/add" style="float:right;" class="btn">Add New</a></span>
    </div>
    <div class="mws-panel-body no-padding">
        <table class=" mws-table">
            <thead>
                <tr>
                    <th>Sr.no</th>
                    <th>Name</th>
                    <th>Options</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($categories as $row) {
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $row->name; ?></td>

                        <td><a href="<?php echo base_url(); ?>categories/edit/<?php echo $row->id; ?>"> <i class="icol-pencil"> </i> </a>  <a href="javascript:void(0)" class="Delete" data-name="<?php echo $row->name; ?>" data-id="<?php echo $row->id; ?>" title="Delete" href="#"> <i class="icol-cancel"> </i> </a>  </td>
                    </tr>
                    <?php
                    $i = $i + 1;
                }
                ?>

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
    $(document).ready(function () {
        // Confirm Delete.
        $(".Delete").on('click', function () {
            var id = $(this).data("id");
            var form_data = {
                id: id
            };
            if (confirm("Are you sure you want to delete this?")) {
                $.ajax({
                    type: 'POST',
                    url: '<?php echo site_url("categories/delete"); ?>',
                    data: form_data,
                    success: function (msg) {
                        location.reload();
                    }
                });
            } else {
                return false;
            }
        });
    });
</script>