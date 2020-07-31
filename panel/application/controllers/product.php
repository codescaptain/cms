<?php
class Product extends CI_Controller
{
    public $viewFolder="";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder="product_v";
        /** Model Entegre Ettik */
        $this->load->model("product_model");
    }
    public function index(){
        $viewData=new stdClass();
        $viewData->viewFolder=$this->viewFolder;
        $viewData->subViewFolder="list";
        $items=$this->product_model->get_all();
        $viewData->items=$items;


        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index",$viewData);
    }
}
