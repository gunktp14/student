<?php

    include_once './src/config/conf.php';
    include_once './src/models/ps_model.php';

    class ps_controller{

        private $conf;
        private $ps_model;

        function __construct(){
            $this->conf = new config();
            $this->ps_model = new ps_model($this->conf);
        }

        public function list_phone_Page(){
            $result = $this->ps_model->getAllproducts();
            include './src/views/ps_list.php';

        }

        public function search_list_Page($keyword){
            $result = $this->ps_model->search_keyword($keyword);
            include './src/views/ps_list.php';
        }

        public function detail_phone_Page($product_id){    
            $result = $this->ps_model->getphoneDetail($product_id);
            include './src/views/ps_detail.php';

        }

        public function mvcHandler(){
            $Route = isset($_GET['route']) ? $_GET['route'] : NULL;
            switch($Route){
                case "detail":
                    $product_id = $_REQUEST['product_id'];
                    $this->detail_phone_Page($product_id);
                break; 
                case "search":
                    if(!empty($_POST['search_keyword'])){
                        $keyword = $_POST['search_keyword'];
                        $this->search_list_Page($keyword);
                    }else{
                        $this->list_phone_Page();
                    }
                break; 
                default:
                    $this->list_phone_Page();
                break;
            }
    }

}
?>