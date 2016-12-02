<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Purchase_model extends My_Model {

    public function __construct() {
        parent::__construct();
    }

    protected $primary_key = "id";
    protected $_table = "purchases";

    public function get_all_purchases($num, $offset) {
		$this->db->select("p.* , s.name as supplier_name");
		$this->db->from('purchases as p');
		$this->db->join('suppliers as s' , 's.id = p.supplier_id' , 'left');
        $this->db->order_by("create_date", "DESC");
        $this->db->limit($num, $offset);
        $query = $this->db->get();
        return $query->result();
    }

    public function insert_purchases_items($data) {
        $this->db->insert_batch('purchase_items', $data);
        return TRUE;
    }

    public function delete_details($id) {
        $this->db->where('purchase_id', $id);
        $this->db->delete('purchase_items');
        return TRUE;
    }

    public function update_details($id) {
        $this->db->where('purchase_id', $id);
        $this->db->update('purchase_items');
        return TRUE;
    }

    public function get_purchases_items($id) {
        $this->db->select("*, pi.quantity as purchase_quantity");
        $this->db->where('pi.purchase_id', $id);
        $this->db->from("purchase_items as pi");
        $this->db->join("products as p", 'p.id = pi.product_id', 'left');
        $query = $this->db->get();

        return $query->result();
    }

    public function get_purchase_detail($id) {
        $final_result = array();
        $this->db->where("id", $id);
        $query = $this->db->get("purchases");
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
            $customer = $this->get_supplier($val->supplier_id);
            $final_result [$m]['supplier_name'] = $customer->name;
            $final_result [$m]['supplier_phone'] = $customer->phone;
            $final_result [$m]['supplier_email'] = $customer->email;

            $final_result [$m]['items'] = array();
            $this->db->where('purchase_id', $id);
            $this->db->select("*, s.quantity as purchase_quantity");
            $this->db->from('purchase_items as s');
            $this->db->join("products as p", "p.id = s.product_id", "left");
            $query1 = $this->db->get();
            foreach ($query1->result() as $n => $row1) {
                $final_result [$m]['items'][$n]['name'] = $row1->name;
                $final_result [$m]['items'][$n]['code'] = $row1->code;
                $final_result [$m]['items'][$n]['unit_price'] = $row1->unit_price;
                $final_result [$m]['items'][$n]['quantity'] = $row1->purchase_quantity;
                $final_result [$m]['items'][$n]['total_price'] = $row1->purchase_quantity * $row1->unit_price;
            }
        }
        return $final_result;
    }

    function get_supplier($id) {
        $this->db->where('id', $id);
        $q = $this->db->get('suppliers');
        return $q->row();
    }

}
