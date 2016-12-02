<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Categories_model extends My_Model
{
	
	
	public function __construct()
	{
		parent::__construct();

	}
	protected $primary_key = "id";
    protected $_table = "categories";
	
	
	public function categories_count() {
        return $this->db->count_all("categories");
    }

    public function fetch_categories($limit, $start) {
        $this->db->limit($limit, $start);
		$this->db->order_by("id", "desc"); 
        $query = $this->db->get("categories");

        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
   }
	
	public function getCategoriesNames($term)
    {
	   	$this->db->select('name');
	    $this->db->like('name', $term, 'both');
   		$q = $this->db->get('categories');
		if($q->num_rows() > 0) {
			foreach (($q->result()) as $row) {
				$data[] = $row;
			}
				
			return $data; 
		}
    }
	
/////// Ajax Call 


public function lists($array = "", $type = "") {
        //echo "<pre>".print_r($array)."</pre>"; exit();
        $searchResults = $array['searchResults'];
        $meta = $array['meta'];
        $order = $array['order'];
        $per_page = $array['per_page'];
        $start = $array['start'];
        
        $this->db->select('*'); 
        if(isset($searchResults) && $searchResults != ""){
            $this->db->like('name', $searchResults, 'both');   
        }
        if ($type == "list") {
            $this->db->limit($per_page, $start);
            $this->db->order_by($meta, $order);
        }
        $query = $this->db->get('categories');
		//echo $this->db->last_query();
        return $query;
    }

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

}
