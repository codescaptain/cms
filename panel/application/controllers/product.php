<?php

class Product extends CI_Controller
{
    public $viewFolder = "";

    public function __construct()
    {
        parent::__construct();
        $this->viewFolder = "product_v";
        /** Model Entegre Ettik */
        $this->load->model("product_model");
    }

    public function index()
    {
        $viewData = new stdClass();
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "list";
        $items = $this->product_model->get_all([],"rank ASC");
        $viewData->items = $items;


        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function new_form()
    {

        $viewData = new stdClass();
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "add";


        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }


    public function update_form($id)
    {

        $viewData = new stdClass();
        $items = $this->product_model->get(
            [
                "id" => $id

            ]
        );
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "update";
        $viewData->items = $items;


        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

    }

    public function update($id)
    {
        //validation çağrılır
        $this->load->library("form_validation");

        //Kurallar Yazılır
        $this->form_validation->set_rules("title", "Başlık", "required|trim", [
            "required" => "{field} alanını lütfen doldurun"
        ]);
        //Validasyom Başladı
        $validation = $this->form_validation->run();

        /**
         * @return boolean
         */
        if ($validation) {

            $update = $this->product_model->update([
                "id" =>$id
           ],
            [
                "title"=>$this->input->post("title"),
                "description"=>$this->input->post("description"),
                "url"=>seo($this->input->post("title"))

            ]);
            if ($update){
                //todo sweet alert eklenecek
                redirect(base_url("product"));
            }
            else{
                redirect(base_url("product"));
            }


        } else {

            $viewData = new stdClass();
            $items=$this->product_model->get(["id"=>$id]);
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "update";
            $viewData->form_error = true;
            $viewData->items=$items;
            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

        }


    }

    public function save()
    {
        $this->load->library("form_validation");

        //Kurallar Yazılır
        $this->form_validation->set_rules("title", "Başlık", "required|trim", [
            "required" => "{field} alanı boş bırakılamaz"
        ]);


        //form_valitation çalılır
        $validate = $this->form_validation->run();

        //True- False
        if ($validate) {
            $insert = $this->product_model->add([
                'title' => $this->input->post('title'),
                'url' => seo($this->input->post("title")),
                'description' => $this->input->post('description'),
                'rank' => 0,
                'isActive' => 1,
                'createdAt' => date("Y-m-d H:i:s")
            ]);
            if ($insert) {
                //todo Sweet Alert Eklenecek
                redirect(base_url("product"));
            } else {
                //todo Sweet Alert Eklenecek
                redirect(base_url("product"));
            }
        } else {
            $viewData = new stdClass();
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "add";
            $viewData->form_error = true;
            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);


        }

    }

    public function delete($id){
        $delete=$this->product_model->delete(["id"=>$id]);

        //todo Sweet Alert Eklenecek
        if ($delete){
            redirect(base_url("product"));
        }else{
            redirect(base_url("product"));
        }
    }

    public function isActiveSetter($id){

        if ($id){
            $isActive=$this->input->post("data")=="true" ? 1 : 0;

            $this->product_model->update([
                "id"=>$id
            ],
            [
                "isActive"=>$isActive
            ]);
        }


    }

    public function rankSetter(){
        $data=$this->input->post("data") ;
        parse_str($data,$order);
        $items=$order["ord"];
        foreach ($items as $rank => $id){
            $this->product_model->update(
                [
                    "id"=>$id,
                    "rank !=" => $rank
                ],
                [
                    "rank"=>$rank
                ]
            );
        }
    }
}
