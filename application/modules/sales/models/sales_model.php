<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sales_model extends My_Model {

    public function __construct() {
        parent::__construct();
    }

    protected $primary_key = "id";
    protected $_table = "sales";

    public function get_all_sales($num, $offset) {
        $this->db->order_by("create_date", "DESC");
        $this->db->limit($num, $offset);
        $query = $this->db->get('sales');
        return $query->result();
    }

    public function insert_sales_items($data) {
        $this->db->insert_batch('sale_items', $data);
        return TRUE;
    }

    public function delete_details($id) {
        $this->db->where('sale_id', $id);
        $this->db->delete('sale_items');
        return TRUE;
    }

    public function update_details($id) {
        $this->db->where('sale_id', $id);
        $this->db->update('sale_items');
        return TRUE;
    }

    public function get_sales_items($id) {
        $this->db->select("*, s.quantity as sale_quantity");
        $this->db->where('s.sale_id', $id);
        $this->db->from("sale_items as s");
        $this->db->join("products as p", 'p.id = s.product_id', 'left');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_sale_detail($id) {
        $final_result = array();
        $this->db->where("id", $id);
        $query = $this->db->get("sales");
        foreach ($query->result() as $m => $val) {
            $final_result [$m]['bill_no'] = $val->bill_no;
            $final_result [$m]['order_date'] = $val->create_date;
            $final_result [$m]['credit_days'] = $val->credit_days;
            $final_result [$m]['total_tax'] = $val->total_tax;
            $final_result [$m]['total'] = $val->total;
            $final_result [$m]['discount'] = $val->inv_discount;
            $final_result [$m]['paid'] = $val->paid;
            $final_result [$m]['paid_by'] = $val->paid_by;
            $final_result [$m]['cheque_no'] = $val->cheque_no;
            $final_result [$m]['note'] = $val->note;
            $customer = $this->get_customer($val->customer_id);
            $final_result [$m]['customer_name'] = $customer->name;
            $final_result [$m]['customer_phone'] = $customer->phone;
            $final_result [$m]['customer_email'] = $customer->email;

            $final_result [$m]['items'] = array();
            $this->db->where('sale_id', $id);
            $this->db->select("*, s.quantity as sale_quantity");
            $this->db->from('sale_items as s');
            $this->db->join("products as p", "p.id = s.product_id", "left");
            $query1 = $this->db->get();
            foreach ($query1->result() as $n => $row1) {
                $final_result [$m]['items'][$n]['name'] = $row1->name;
                $final_result [$m]['items'][$n]['code'] = $row1->code;
                $final_result [$m]['items'][$n]['unit_price'] = $row1->unit_price;
                $final_result [$m]['items'][$n]['quantity'] = $row1->sale_quantity;
                $final_result [$m]['items'][$n]['total_price'] = $row1->sale_quantity * $row1->unit_price;
            }
        }
        return $final_result;
    }

    function get_customer($id) {
        $this->db->where('id', $id);
        $q = $this->db->get('customers');
        return $q->row();
    }

}
