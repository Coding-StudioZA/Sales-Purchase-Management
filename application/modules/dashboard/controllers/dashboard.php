<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends Admin_Controller {

    function __construct() {
        parent::__construct();

        $this->load->library('form_validation');
        $this->load->model('sales/sales_model');
        $this->load->model('dashboard_model');
        $this->load->model('categories/categories_model');
        $this->load->model('customers/customers_model');
        $this->load->model('products/product_model');
        $this->load->model('suppliers/suppliers_model');
    }

    public function index() {
        $now = date('Y-m-d');
        $now = $now . " 23:59:00";
        $yersterday = date('Y-m-d', strtotime('- 1 day'));
        $last_month = date('Y-m-d h:i:s', strtotime('- 1 month'));
        $last_2month = date('Y-m-d h:i:s', strtotime('- 2 month'));
        $today_date = $yersterday . " 23:59:59";
        $this_month_start = date('Y-m-d h:i:s', strtotime('first day of this month'));
        $previous_month_start = date('Y-m-d h:i:s', strtotime('first day of previous month'));
        $last_week = date('Y-m-d h:i:s', strtotime('- 1 week'));
        $last_month = date('Y-m-d h:i:s', strtotime('- 1 month'));


        $data['today'] = $this->dashboard_model->count_sales($today_date, $now);
        $data['today_purchase'] = $this->dashboard_model->count_purchase($today_date, $now);
        $data['yesterday'] = $this->dashboard_model->count_sales($yersterday, $today_date);
        $data['yesterday_purchase'] = $this->dashboard_model->count_purchase($yersterday, $today_date);
        $data['last_week_purchase'] = $this->dashboard_model->count_purchase($last_week, $now);
        $data['last_week'] = $this->dashboard_model->count_sales($last_week, $now);
        $data['last_month_purchase'] = $this->dashboard_model->count_purchase($last_month, $now);
        $data['last_month'] = $this->dashboard_model->count_sales($last_month, $now);
        $data['total_earning_purchase'] = $this->dashboard_model->count_purchase();
        $data['total_earning'] = $this->dashboard_model->count_sales();
        $data['sales'] = count($this->sales_model->get_all());
        $data['customers'] = count($this->customers_model->get_all());
        $data['products'] = count($this->product_model->get_all());
        $data['suppliers'] = count($this->suppliers_model->get_all());
        $data['categories'] = count($this->categories_model->get_all());
        $data['product_sales'] = $this->dashboard_model->product_sales();
        
        $data['purchase_by_month'] = $this->dashboard_model->get_purchase_by_month();
        $data['sales_by_month'] = $this->dashboard_model->get_sales_by_month();
        
        $data['content'] = "home";
        $this->load->view('layout', $data);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */