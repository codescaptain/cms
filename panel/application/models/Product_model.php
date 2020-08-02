<?php

class Product_model extends CI_Model{
    public $tableName="products";

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param array
     */
    public function get($where=[])
    {
       return $this->db->where($where)->get($this->tableName)->row();
    }

    /**
     * @return array
     */
    public function get_all($where=[],$order="id DESC"){
        /** Veri tabanından tüm değerleri çektik */
        return $this->db->where($where)->order_by($order)->get($this->tableName)->result();
    }

    /**
     * @return boolean
     */
    public function add($data=[])
    {
        return $this->db->insert($this->tableName,$data);
    }

    /**
     * @return string
     */
    public function update($where=[],$data=[])
    {
        return $this->db->where($where)->update($this->tableName,$data);
    }

    /**
     * @return boolean
     */
    public function delete($where=[])
    {
        return $this->db->where($where)->delete($this->tableName);
    }
}
