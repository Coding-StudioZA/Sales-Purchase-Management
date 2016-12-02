<div class="mws-panel-body no-padding" >

    <div class="mws-panel grid_8" style="background-color:#FFF">
        <div class="mws-panel-header">
            <span>Purchase Detail</span>
        </div>
        <?php foreach ($purchase_detail as $row) { ?>
            <div class="grid_5">
                <h3> Bill Number : <?php echo $row['bill_no']; ?> </h3>
                <h5> Order Date: <?php echo date("d M Y", strtotime($row['order_date'])); ?> </h4>
                    <h4> Paid: <?php echo $row['paid'] . " ( " . $row['paid_by'] . " " . $row['cheque_no'] . ")"; ?> </h4>
            </div>

            <div class="grid_3" >
                <h3> Customer Name : <?php echo $row['supplier_name']; ?> </h3>
                <h5> Phone : <?php echo $row['supplier_phone']; ?> </h5>
                <h5> Email : <?php echo $row['supplier_email']; ?> </h5>
            </div>
            <table class="mws-datatable-fn mws-table">
                <thead>
                    <tr>
                        <th colspan=5 style="font-size:20px;"> Products </th>
                    </tr>

                </thead>
                <tbody>
                    <tr>
                        <td>Product Code</td>
                        <td>Product Name</td>
                        <td>Unit Price</td>
                        <td>Quantity</td>
                        <td>Total</td>
                    </tr>	
                    <?php $total = 0;
                    foreach ($row['items'] as $row1) { ?>
                        <tr>
                            <td> <?php echo $row1['code']; ?></td>
                            <td> <?php echo $row1['name']; ?></td>
                            <td><?php echo $row1['unit_price']; ?></td>
                            <td><?php echo $row1['quantity']; ?></td>
                            <td><?php echo $row1['quantity'] * $row1['unit_price']; ?></td>
                        </tr>
        <?php $total = $total + ( $row1['quantity'] * $row1['unit_price']);
    } ?>

                    <tr>
                        <td colspan=3  > <span style="float:right"> Total </span> </td>
                        <th colspan=2><?php echo $total; ?></th>
                    </tr>	

                    <tr>
                        <td colspan=3  > <span style="float:right">  Tax</span> </td>
                        <th colspan=2><?php echo $row['total_tax']; ?></th>
                    </tr>	

                    <tr>
                        <td colspan=3  > <span style="float:right">Discount</span> </td>
                        <th colspan=2><?php echo $row['discount']; ?></th>
                    </tr>

                    <tr>
                        <td colspan=3  > <span style="float:right"> Total Amount</span> </td>
                        <th colspan=2><?php echo $row['total']; ?></th>
                    </tr>


<?php } ?>

            </tbody>
        </table>
    </div>

</div>









<div class="mws-panel grid_8">

    <div class="mws-panel-body no-padding">


    </div>
</div>
