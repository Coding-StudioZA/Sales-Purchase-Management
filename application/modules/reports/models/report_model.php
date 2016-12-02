<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @package     Report Module
 * @author      M Arfan 
 * @copyright   (c) 2015, CMS Development
 * @since       Version 0.1
 */
class Report_model extends MY_Model {


    public function __construct() {
        parent::__construct();
    }


   
   public function product_sales() { 
		$this->db->select("*, SUM(s.quantity) as Qty ,SUM(s.gross_total) as total_earning");
		$this->db->from('sale_items as s');
		$this->db->join("products as p" , "p.id = s.product_id" , "left");
		
		$this->db->order_by('Qty' , "DESC");
		$this->db->distinct();
		$this->db->group_by('product_id');
		$query = $this->db->get();
		return $query->result();
   }
   
    public function sales_by_customer() { 
		$this->db->select("*, SUM(i.quantity) as Qty , i.unit_price as sale_price ,SUM(i.gross_total) as total_earning");
		$this->db->from('sales as s');
		$this->db->join('sale_items as i', "i.sale_id = s.id" , 'left');
		$this->db->order_by('Qty' , "DESC");
		$this->db->distinct();
		$this->db->group_by('s.customer_id');
		$query = $this->db->get();
		return $query->result();
   }
   
    public function customer_sales($id) { 
		$this->db->select("i.* , p.name , i.unit_price as sale_price , p.code");
		$this->db->from('sales as s');
		$this->db->join('sale_items as i', "i.sale_id = s.id" , 'left');
		$this->db->join("products as p" , "p.id = i.product_id" , "left");
		$this->db->order_by('i.create_date' , "DESC");
		$this->db->where('s.customer_id' , $id); 
		$query = $this->db->get();
		return $query->result();
   }
   
   public function sales_by_item($product_id) { 
		$this->db->select("s.* , s.unit_price as sale_price , p.name , p.code");
		$this->db->from('sale_items as s');
		$this->db->join("products as p" , "p.id = s.product_id" , "left");
		$this->db->where('s.product_id' , $product_id);
		$this->db->order_by('create_date' , "DESC");
		$query = $this->db->get();
		return $query->result();	
   }

}
