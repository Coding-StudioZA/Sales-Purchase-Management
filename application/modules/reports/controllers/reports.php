<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends Admin_Controller {
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->library('form_validation');
		$this->load->model('sales/sales_model');
		$this->load->model('report_model');
		$this->load->model('categories/categories_model');
		$this->load->model('customers/customers_model');
		$this->load->model('products/product_model');
		$this->load->model('suppliers/suppliers_model');


	}
	
	public function top_sales_items()
	{
		$data['product_sales'] = $this->report_model->product_sales();
		$data['content'] = "top_items";
		$this->load->view('layout' , $data);
	}
	public function sales_by_customer()
	{
		$data['product_sales'] = $this->report_model->sales_by_customer();
		$data['content'] = "sales_by_customer";
		$this->load->view('layout' , $data);
	}
	
	public function sales_by_item($id)
	{	
		$data['products'] = $this->product_model->get_all();
		$data['product_sales'] = $this->report_model->sales_by_item($id);
		$data['content'] = "sales_by_item";
		$this->load->view('layout' , $data);
	}
	
	public function customer_sales($id)
	{	
		$data['products'] = $this->customers_model->get_all();
		$data['product_sales'] = $this->report_model->customer_sales($id);
		$data['content'] = "customer_sales";
		$this->load->view('layout' , $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */