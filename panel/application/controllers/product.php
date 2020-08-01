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

    public function new_form(){

        $viewData=new stdClass();
        $viewData->viewFolder=$this->viewFolder;
        $viewData->subViewFolder="add";


        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index",$viewData);
    }

    public function save(){
        $this->load->library("form_validation");

        //Kurallar Yazılır
        $this->form_validation->set_rules("title","Başlık","required|trim", [
            "required"=>"{field} alanı boş bırakılamaz"
        ]);


        //form_valitation çalılır
        $validate=$this->form_validation->run();

        //True- False
        if ($validate){
            echo    "Kayıt başladıı";
        }
        else{
            echo validation_errors();
        }

    }
}
