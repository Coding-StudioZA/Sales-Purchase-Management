<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product_model extends My_Model {

    public function __construct() {
        parent::__construct();
    }

    protected $primary_key = "id";
    protected $_table = "products";

    public function products_count() {
        return $this->db->count_all("products");
    }

    public function fetch_products($limit, $start) {
        $this->db->limit($limit, $start);
        $this->db->order_by("id", "desc");
        $query = $this->db->get("products");

        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }

}
