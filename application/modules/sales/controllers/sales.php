<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sales extends Admin_Controller {

    function __construct() {
        parent::__construct();

        $this->load->library('form_validation');
        $this->load->model('sales_model');
        $this->load->model('customers/customers_model');
        $this->load->model('products/product_model');
    }

    function add_product_ajax() {
        $product_id = $this->input->post('product_id');
        $row = $this->product_model->get($product_id);

        $html = "<tr><td>" . $row->code . "</td><td>" . $row->name
                . "</td><td><input type='number' class='change_qty' data-id='" . $row->id . "' value='1' min=1 id='qty_" . $row->id . "' name='qty_" . $row->id . "'> <input type='hidden' name='product_ids[]' value='" . $row->id . "'> </td>"
                . "<td>" . $row->size . "</td>"
                . "<td> <input type='text' width='5%' readonly value='" . $row->price . "' min=1 id='price_" . $row->id . "' ></td>"
                . "<td> <input type='text' width='5%' readonly value='" . $row->price . "' min=1 id='toatlprice_" . $row->id . "' ></td>"
                . "</tr>";

        echo $html;
    }

    function index() {


        $this->load->library('pagination');
        $config['base_url'] = base_url() . '/sales/index';
        $config['total_rows'] = count($this->sales_model->get_all());
        $config['per_page'] = 25;
        $config['num_links'] = 4;
        $config['uri_segment'] = 3;

        $config['full_tag_open'] = '<div class="pagination">';
        $config['full_tag_close'] = '</div> ';

        $config['next_link'] = "Next";
        $config['prev_link'] = "Previous";

        $config['cur_tag_open'] = '<a style="color:#000">';
        $config['cur_tag_close'] = '</a>';
        $this->pagination->initialize($config);

        $data['sales'] = $this->sales_model->get_all_sales($config['per_page'], $this->uri->segment(3));
        $data['content'] = "content";
        $this->load->view('layout', $data);
    }

    function add() {

        //validate form input
        $this->form_validation->set_rules('bill_no', "Bill #", 'required|xss_clean');
        $this->form_validation->set_rules('date', "Date", 'required|xss_clean');
        $this->form_validation->set_rules('customer_id', "customer", 'required|is_natural_no_zero|xss_clean');
        $this->form_validation->set_rules('note', "Note", 'xss_clean');

        $quantity = "quantity";
        $product = "product";
        $unit_price = "unit_price";
        $tax_rate = "tax_rate";
        $sl = "serial";
        $dis = "discount";

        if ($this->form_validation->run() == true) {

            $product_ids = $this->input->post('product_ids');
            $product = array();

            if (!empty($product_ids)) {

                $date = $this->input->post('date');
                $bill_no = $this->input->post('bill_no');
                $customer_id = $this->input->post('customer_id');
                $customer_details = $this->customers_model->get($customer_id);
                $customer_name = $customer_details->name;
                $note = $this->input->post('note');
                $payment_method = $this->input->post('payment_method');
                $total_paid = $this->input->post('paid');
                $total_tax = $this->input->post('tax');
                $final_price = $this->input->post('final_price');
                $inv_discount = $this->input->post('discount');
                $credit_days = $this->input->post('credit_days');
                $cheque_no = $this->input->post('cheque_no');


                $data = array(
                    'bill_no' => $bill_no,
                    'customer_id' => $customer_id,
                    'customer_name' => $customer_name,
                    'note' => $note,
                    'paid_by' => $payment_method,
                    'paid' => $total_paid,
                    'total_tax' => $total_tax,
                    'total' => $final_price,
                    'inv_discount' => $inv_discount,
                    'credit_days' => $credit_days,
                    'cheque_no' => $cheque_no,
                    'create_date' => $date
                );


                $insert_id = $this->sales_model->insert($data);

                foreach ($product_ids as $key => $id) {
                    $product_detail = $this->product_model->get($id);
                    $quantity = $this->input->post("qty_" . $id);
                    $product[] = array(
                        "sale_id" => $insert_id,
                        "quantity" => $quantity,
                        "product_id" => $id,
                        "product_code" => $product_detail->code,
                        "product_name" => $product_detail->name,
                        "product_unit" => $product_detail->unit,
                        "unit_price" => $product_detail->price,
                        "gross_total" => $product_detail->price * $quantity,
                        "create_date" => $date
                    );
                }

                $this->sales_model->insert_sales_items($product);

                $this->session->set_flashdata('success_message', "Customer Added Successfully!");
                redirect("sales", 'refresh');
            } else {
                $this->session->set_flashdata('success_message', "Must Select at least 1 product");
                redirect("sales", 'refresh');
            }
        } else { //display the create customer form
            $data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));

            $data['bill_no'] = array('bill_no' => 'bill_no',
                'id' => 'bill_no',
                'type' => 'text',
                'value' => $this->form_validation->set_value('name'),
            );

            $data['customers'] = $this->customers_model->get_all();
            $data['products'] = $this->product_model->get_all();
            $data['content'] = "add";
            $this->load->view('layout', $data);
        }
    }

    function edit($id = NULL) {


        //validate form input
        $this->form_validation->set_rules('bill_no', "Bill #", 'required|xss_clean');
        $this->form_validation->set_rules('customer_id', "customer", 'required|is_natural_no_zero|xss_clean');
        $this->form_validation->set_rules('note', "Note", 'xss_clean');

      

        if ($this->form_validation->run() == true) {

            $product_ids = $this->input->post('product_ids');
            $product = array();

            if (!empty($product_ids)) {

                $date = $this->input->post('date');
                $bill_no = $this->input->post('bill_no');
                $customer_id = $this->input->post('customer_id');
                $customer_details = $this->customers_model->get($customer_id);
                $customer_name = $customer_details->name;
                $note = $this->input->post('note');
                $payment_method = $this->input->post('payment_method');
                $total_paid = $this->input->post('paid');
                $total_tax = $this->input->post('tax');
                $final_price = $this->input->post('final_price');
                $inv_discount = $this->input->post('discount');
                $credit_days = $this->input->post('credit_days');
                $cheque_no = $this->input->post('cheque_no');


                $data = array(
                    'bill_no' => $bill_no,
                    'customer_id' => $customer_id,
                    'customer_name' => $customer_name,
                    'note' => $note,
                    'paid_by' => $payment_method,
                    'paid' => $total_paid,
                    'total_tax' => $total_tax,
                    'total' => $final_price,
                    'inv_discount' => $inv_discount,
                    'credit_days' => $credit_days,
                    'cheque_no' => $cheque_no
                );
                if (!empty($date)) {
                    $data['create_date'] = $date;
                }


                $this->sales_model->update($id, $data);
                $this->sales_model->delete_details($id);

                foreach ($product_ids as $key => $p_id) {
                    $product_detail = $this->product_model->get($p_id);
                    $quantity = $this->input->post("qty_" . $p_id);
                    $product[] = array(
                        "sale_id" => $id,
                        "quantity" => $quantity,
                        "product_id" => $p_id,
                        "product_code" => $product_detail->code,
                        "product_name" => $product_detail->name,
                        "product_unit" => $product_detail->unit,
                        "unit_price" => $product_detail->price,
                        "gross_total" => $product_detail->price * $quantity,
                        "create_date" => date("Y-m-d h:i:s")
                    );
                }

                $this->sales_model->insert_sales_items($product);

                $this->session->set_flashdata('success_message', "Customer Added Successfully!");
                redirect("sales", 'refresh');
            } else {
                $this->session->set_flashdata('success_message', "Must Select at least 1 product");
                redirect("sales", 'refresh');
            }
        } else { //display the create customer form
            $data['message'] = (validation_errors() ? validation_errors() : $this->session->flashdata('message'));

            $data['bill_no'] = array('bill_no' => 'bill_no',
                'id' => 'bill_no',
                'type' => 'text',
                'value' => $this->form_validation->set_value('name'),
            );

            $data['sale'] = $this->sales_model->get($id);
            $data['sale_items'] = $this->sales_model->get_sales_items($id);

            //echo "<pre>";
            //pr/int_r( $this->sales_model->get_sales_items($id)); exit;
            $data['customers'] = $this->customers_model->get_all();
            $data['products'] = $this->product_model->get_all();
            $data['content'] = "edit";
            $this->load->view('layout', $data);
        }
    }

    public function delete() {
        $id = $this->input->post('id');
        if ($id) {
            $this->sales_model->delete($id);
            $this->sales_model->delete_details($id);
        } else {
            return FALSE;
        }
    }

    function view($id) {
        $data["sale_detail"] = $this->sales_model->get_sale_detail($id);
        $data['content'] = "view";
        $this->load->view('layout', $data);
    }

    function suggestions() {
        $term = $this->input->get('term', TRUE);

        if (strlen($term) < 2)
            break;

        $rows = $this->sales_model->getCustomerNames($term);

        $json_array = array();
        foreach ($rows as $row)
            array_push($json_array, $row->name);

        echo json_encode($json_array);
    }

}
