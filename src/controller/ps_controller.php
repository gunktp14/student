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

        public function list_student(){
            $student_id = $_POST['student_id'];
            include './src/views/ps_list.php';

        }

        public function delete_student(){
            $student_id = $_POST['student_id'];
            include './src/views/ps_list.php';

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

                case"add": 
                    if(isset($_POST['submit_add'])){
                        $name = $_POST['name'];
                        $student_id = $_POST['student_id'];
                        $major = $_POST['major']; 
                        $number_id = $_POST['number_id'];
                        $brith_day = $_POST['brith_day'];
                        $age = $_POST['age'];
                        $img = $_POST['img'];
                        $result = $this->ps_model->addStudent($name,$student_id,$major,$number_id,$brith_day,$age,$img); 
                            if($result === true){

                                $this->list_phone_Page();
                            }else{  
                                echo "Loop 2";
                                $this->list_phone_Page();
                            }
                    }else{
                        echo "Loop 1";
                        $this->list_phone_Page();
                    }
                break;

                case"delete":
                    $student_id = isset($_GET['student_id']) ? $_GET['student_id']: NULL ;
                    if($student_id !== NULL){
                        $this->ps_model->deleteStudent($student_id);
                        $this->list_phone_Page(); 
                    }else{
                        $_SESSION['error'] = "เกิดข้อผิดพลาดในการลบ";
                    }
                break;

                case"edit":
                    $student_id = isset($_POST['student_id']) ? $_POST['student_id']: NULL ;
                    if($student_id !== NULL){
                        $name = $_POST['name'];
                        $student_id = $_POST['student_id'];
                        $major = $_POST['major']; 
                        $number_id = $_POST['number_id'];
                        $brith_day = $_POST['brith_day'];
                        $age = $_POST['age'];
                        $img = $_POST['img'];
                        $this->ps_model->editStudent($name,$student_id,$major,$number_id,$brith_day,$age,$img);
                        $this->list_phone_Page();
                    }else{
                        $_SESSION['error'] = "เกิดข้อผิดพลาดในการเเก้ไข";
                    }
                break;
                default:
                    $this->list_phone_Page();
                break;
            }
    }

}
?>