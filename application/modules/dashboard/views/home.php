<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>

<!-- Panels Start -->

<div class="mws-panel grid_3">
    <div class="mws-panel-header">
        <span><i class="icon-book"></i> Sales Summary</span>
    </div>
    <div class="mws-panel-body no-padding">
        <ul class="mws-summary clearfix">
            <li>
                <span class="key"> Today Sale </span>
                <span class="val">
                    <span class="text-nowrap"><?php echo $today; ?></span>
                </span>
            </li>

            <li>
                <span class="key"> Yesterday Sale </span>
                <span class="val">
                    <span class="text-nowrap"><?php echo $yesterday; ?></span>
                </span>
            </li>

            <li>
                <span class="key"> Last 7 Days Sale </span>
                <span class="val">
                    <span class="text-nowrap"><?php echo $last_week; ?></span>
                </span>
            </li>

            <li>
                <span class="key"> Last 30 Days Sale </span>
                <span class="val">
                    <span class="text-nowrap"><?php echo $last_month; ?></span>
                </span>
            </li>

            <li>
                <span class="key"> Total Sales   </span>
                <span class="val">
                    <span class="text-nowrap"><?php echo $total_earning; ?></span>
                </span>
            </li>


        </ul>
    </div>
</div>

<div class="mws-panel grid_3">
    <div class="mws-panel-header">
        <span><i class="icon-book"></i> Purchase Summary</span>
    </div>
    <div class="mws-panel-body no-padding">
        <ul class="mws-summary clearfix">
            <li>
                <span class="key"> Today Sale </span>
                <span class="val">
                    <span class="text-nowrap"><?php echo $today_purchase; ?></span>
                </span>
            </li>

            <li>
                <span class="key"> Yesterday Sale </span>
                <span class="val">
                    <span class="text-nowrap"><?php echo $yesterday_purchase; ?></span>
                </span>
            </li>

            <li>
                <span class="key"> Last 7 Days Sale </span>
                <span class="val">
                    <span class="text-nowrap"><?php echo $last_week_purchase; ?></span>
                </span>
            </li>

            <li>
                <span class="key"> Last 30 Days Sale </span>
                <span class="val">
                    <span class="text-nowrap"><?php echo $last_month_purchase; ?></span>
                </span>
            </li>

            <li>
                <span class="key"> Total Sales   </span>
                <span class="val">
                    <span class="text-nowrap"><?php echo $total_earning_purchase	; ?></span>
                </span>
            </li>


        </ul>
    </div>
</div>

<div class="mws-panel grid_2">
    <div class="mws-panel-header">
        <span><i class="icon-book"></i> Website Summary</span>
    </div>
    <div class="mws-panel-body no-padding">
        <ul class="mws-summary clearfix">
            <li>
                <span class="key"> Total Sales </span>
                <span class="val">
                    <span class="text-nowrap"><?php echo $sales; ?></span>
                </span>
            </li>

            <li>
                <span class="key"> Total Customers </span>
                <span class="val">
                    <span class="text-nowrap"><?php echo $customers; ?></span>
                </span>
            </li>

            <li>
                <span class="key"> Total Products </span>
                <span class="val">
                    <span class="text-nowrap"><?php echo $products; ?></span>
                </span>
            </li>

            <li>
                <span class="key"> Total Suppliers </span>
                <span class="val">
                    <span class="text-nowrap"><?php echo $suppliers; ?></span>
                </span>
            </li>

            <li>
                <span class="key"> Today Categories   </span>
                <span class="val">
                    <span class="text-nowrap"><?php echo $categories; ?></span>
                </span>
            </li>


        </ul>
    </div>
</div>



<div class="mws-panel grid_8 mws-collapsible">
    <div class="mws-panel-header">
        <span><i class="icon-table"></i> Last 12 Month Sale/Purchase </span>
    </div>
    <div class="mws-panel-body no-padding">
        <table class="mws-table">

            <div class="visitors-chart">
                <div class="panel-heading">
                    <!--  <div class="pull-right"><a class="graph_by" data-id="365">Last 12 Month</a> </div>
                   <div class="pull-right"><a class="graph_by" data-id="30">Last 30 Days</a> &nbsp; | &nbsp; </div>
                    <div class="pull-right"><a class="graph_by" data-id="7">Last 7 Days</a> &nbsp; | &nbsp; </div> -->
                </div>
                <div class="panel-body">
                    <div id="flotchart1" style="display: block; width: 100%; max-width: 1100px; height: 415px; margin: 0 auto"></div>
                    <div id="flotchart2" style="display: none; width: 100%; max-width: 1100px; height: 415px; margin: 0 auto"></div>
                    <div id="flotchart3" style="display: none; width: 100%; max-width: 1100px; height: 415px; margin: 0 auto"></div>
                </div>

            </div>
        </table>
    </div>
</div>



<div class="mws-panel grid_8 mws-collapsible">
    <div class="mws-panel-header">
        <span><i class="icon-table"></i> Most Sales Items </span>
    </div>
    <div class="mws-panel-body no-padding">
        <table class="mws-table mws-datatable">
            <thead>
                <tr>
                    <th>Porduct Code</th>
                    <th>Product Name</th>
                    <th>Unit Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Option </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($product_sales as $row) { ?>
                    <tr>
                        <td><?php echo $row->code; ?></td>
                        <td><?php echo $row->name; ?></td>
                        <td><?php echo $row->unit_price; ?></td>
                        <td><?php echo $row->Qty; ?></td>
                        <td><?php echo $row->unit_price * $row->Qty; ?></td>
                        <td>
                            <span class="btn-group">
                                <a href="<?php echo base_url(); ?>reports/sales_by_item/<?php echo $row->product_id; ?>" class="btn btn-small"><i class="icon-eye-open"></i></a>

                            </span>
                        </td>
                    </tr>
                <?php } ?>

            </tbody>
        </table>
    </div>
</div>



<script type="text/javascript">
    $('.graph_by').on('click', function () {
        var id = $(this).attr("data-id");
        if (id == 7) {
            $('#flotchart1').show();
            $('#flotchart2').hide();
            $('#flotchart3').hide();
        }
        /* if (id == 30) {
         $('#flotchart1').hide();
         $('#flotchart2').show();
         $('#flotchart3').hide();
         }
         if (id == 365) {
         $('#flotchart1').hide();
         $('#flotchart2').hide();
         $('#flotchart3').show();
         } */
    });
    $(function () {
        $('#flotchart1').highcharts({
            chart: {
                type: 'line'
            },
            title: {
                text: 'Last 12 Month Sale/Purchase'
            },
            subtitle: {
                text: "<?php echo $this->session->userdata('name'); ?>"
            },
            credits: {
                enabled: false
            },
            xAxis: {
                categories: [
<?php
$year_name = array(date('F', strtotime(' 0 month')), date('F', strtotime(' -1 month')), date('F', strtotime(' -2 month')), date('F', strtotime(' -3 month')), date('F', strtotime(' -4 month')), date('F', strtotime(' -5 month')), date('F', strtotime(' -6 month')), date('F', strtotime(' -7 month')), date('F', strtotime(' -8 month')), date('F', strtotime(' -9 month')), date('F', strtotime(' -10 month')), date('F', strtotime(' -11 month')));
echo '"' . date('F') . '", ';
echo '"' . date('F', strtotime(' -1 month')) . '", ';
echo '"' . date('F', strtotime(' -2 month')) . '", ';
echo '"' . date('F', strtotime(' -3 month')) . '", ';
echo '"' . date('F', strtotime(' -4 month')) . '", ';
echo '"' . date('F', strtotime(' -5 month')) . '", ';
echo '"' . date('F', strtotime(' -6 month')) . '", ';
echo '"' . date('F', strtotime(' -7 month')) . '", ';
echo '"' . date('F', strtotime(' -8 month')) . '", ';
echo '"' . date('F', strtotime(' -9 month')) . '", ';
echo '"' . date('F', strtotime(' -10 month')) . '", ';
echo '"' . date('F', strtotime(' -11 month')) . '", ';
?>
                ]
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Sale'
                }
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: false
                }
            },
            series: [{
                    color: '#22BAA0',
                    name: 'Sales',
                    data: [
<?php
foreach ($sales_by_month as $key => $value) {

    $mon = $value->mon;
    $array_year2[$mon] = $value->amount;
}

foreach ($year_name as $key => $value) {
    if (array_key_exists($value, $array_year2)) {
        echo round($array_year2[$value], 2) . ', ';
    } else {
        echo '0.00, ';
    }
}
?>]
                }, {
                    color: '#7a6fbe',
                    name: 'Purchase',
                    data: [
<?php
foreach ($purchase_by_month as $key => $value) {

    $mon = $value->mon;
    $array_year2[$mon] = $value->amount;
}

foreach ($year_name as $key => $value) {
    if (array_key_exists($value, $array_year2)) {
        echo round($array_year2[$value], 2) . ', ';
    } else {
        echo '0.00, ';
    }
}
?>]
                }]
        });
    });
</script>
