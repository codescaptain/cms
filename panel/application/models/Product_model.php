<?php

class Product_model extends CI_Model{
    public $tableName="products";

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all(){
        /** Veri tabanından tüm değerleri çektik */
        return $this->db->get($this->tableName)->result();
    }

    /**
     * @return boolean
     */
    public function add($data=[])
    {
        return $this->db->insert($this->tableName,$data);
    }
}
