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
        $this->load->model("product_image_model");
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

    public function image_form($id){
        //gelen id product_id
        $viewData = new stdClass();
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "image";
        $viewData->item=$this->product_model->get(["id"=>$id]);
        $viewData->items=$this->product_image_model->get_all(["product_id"=>$id],"rank ASC");


        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

    }

    public function image_upload($id){
        $file_name=seo(pathinfo($_FILES['file']['name'],PATHINFO_FILENAME)).".".pathinfo($_FILES['file']['name'],PATHINFO_EXTENSION);

        $config["allowed_types"]="jpg|jpeg|png";
        $config["upload_path"]="uploads/$this->viewFolder";
        $config["file_name"]=$file_name;



        /*
         * $config['max_size']   = '100';
         * $config['max_width']  = '1024';
         * $config['max_height'] = '768';
         */

       $this->load->library("upload",$config);

        $upload=$this->upload->do_upload("file");
        if ($upload){
            $uploaded=$this->upload->data("file_name");
            $this->product_image_model->add([
                "product_id"=>$id,
                "img_url"=>$uploaded,
                "rank"=>0,
                "isActive"=>0,
                "isCover"=>0,
                "createdAt"=>Date("Y-m-d H:i:s")

            ]);

        }else{
            echo "işlem başarısız";
        }


    }

    public function refresh_image_list($id){
        $viewData=new stdClass();
        $viewData->viewFolder=$this->viewFolder;
        $viewData->subViewFolder="image";
        $viewData->item=$this->product_model->get(["id"=>$id]);
        $viewData->items=$this->product_image_model->get_all(["product_id"=>$id]);

        $render=$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/render_elements/image_list_v",$viewData,true);
        echo $render;


    }


    public function isCoverSetter($id,$parent_id){

        if ($id){
            $isCover=$this->input->post("data")=="true" ? 1 : 0;

            $this->product_image_model->update([
                "id"=>$id,
                "product_id"=>$parent_id
            ],
                [
                    "isCover"=>$isCover
                ]);

            $this->product_image_model->update([
                "id !="=>$id,
                "product_id"=>$parent_id
            ],
                [
                    "isCover"=>0
                ]);
            $viewData=new stdClass();
            $viewData->viewFolder=$this->viewFolder;
            $viewData->subViewFolder="image";
            $viewData->item=$this->product_model->get(["id"=>$parent_id]);
            $viewData->items=$this->product_image_model->get_all(["product_id"=>$parent_id]);

            $render=$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/render_elements/image_list_v",$viewData,true);
            echo $render;


        }


    }

}
