<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @package     Dashboard Module
 * @author      M Arfan 
 * @copyright   (c) 2015, CMS Development
 * @since       Version 0.1
 */
class Dashboard_model extends MY_Model {

    public function __construct() {
        parent::__construct();
    }

    public function count_sales($start_date = "", $end_date = "") {
        $this->db->select("SUM(total) as total_earning");
        $this->db->from('sales');
        if (!empty($start_date)) {
            $this->db->where('create_date >=', $start_date);
            $this->db->where('create_date <=', $end_date);
        }
        $query = $this->db->get();
        $row = $query->row();
        if (!empty($row->total_earning)) {
            return $row->total_earning;
        } else {
            return "0.00";
        }
    }
	
	
	public function count_purchase($start_date = "", $end_date = "") {
        $this->db->select("SUM(total) as total_earning");
        $this->db->from('purchases');
        if (!empty($start_date)) {
            $this->db->where('create_date >=', $start_date);
            $this->db->where('create_date <=', $end_date);
        }
        $query = $this->db->get();
        $row = $query->row();
        if (!empty($row->total_earning)) {
            return $row->total_earning;
        } else {
            return "0.00";
        }
    }

    public function product_sales() {
        $this->db->select("*, SUM(s.quantity) as Qty ,SUM(s.gross_total) as total_earning");
        $this->db->from('sale_items as s');
        $this->db->join("products as p", "p.id = s.product_id", "left");
        $this->db->order_by('Qty', "DESC");
        $this->db->distinct();
        $this->db->group_by('product_id');
        $query = $this->db->get();
        return $query->result();
    }

    public function product_sales_by_item($product_id) {
        $this->db->select("*");
        $this->db->from('sale_items as s');
        $this->db->join("products as p", "p.id = s.product_id", "left");
        $this->db->where('product_id', $product_id);
        $this->db->order_by('create_date', "DESC");
        $query = $this->db->get();
        return $query->result();
    }

    public function get_sales_by_month() {
         $sql = "SELECT DATE_FORMAT(create_date,'%M') as mon, create_date as dated, SUM(total) AS amount FROM `sales` WHERE create_date BETWEEN DATE_SUB(NOW(), INTERVAL 365 DAY) AND NOW() GROUP BY MONTH(create_date) ORDER BY create_date DESC";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function get_purchase_by_month() {
         $sql = "SELECT DATE_FORMAT(create_date,'%M') as mon, create_date as dated, SUM(total) AS amount FROM `purchases` WHERE create_date BETWEEN DATE_SUB(NOW(), INTERVAL 365 DAY) AND NOW() GROUP BY MONTH(create_date) ORDER BY create_date DESC";
        $query = $this->db->query($sql);
        return $query->result();
    }

}
