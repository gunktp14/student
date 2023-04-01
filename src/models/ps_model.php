<?php

    class ps_model{

        private $dns;
        private $dbUser;
        private $dbPass;
        private $condb;

        function __construct(object $conf){
            $this->dns = $conf->dns;
            $this->dbUser = $conf->dbUser;
            $this->dbPass = $conf->dbPass;
            $this->connect();
        }

        public function connect(){
            try{
                $this->condb = new PDO($this->dns,$this->dbUser,$this->dbPass);
                // echo "connected to database successfully!";
            }catch(PDOException $err){
                echo "Have an error about : " . $err->getMessage();
                echo "<br>Error in line : " . $err->getLine();
            }
        }

        public function getAllproducts(){
            $sql = "SELECT * FROM `student_tb`";
            $query = $this->condb->prepare($sql);
            if($query->execute()){
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                return $result;
                return true;
            }else {
                return false;
            }
        }

        public function getphoneDetail($product_id){
            $sql = "SELECT * FROM `phone_tb` WHERE `product_id` = :product_id";
            $query = $this->condb->prepare($sql);
            $query->bindParam(':product_id',$product_id,PDO::PARAM_INT);
            if($query->execute()){
                $result = $query->fetch(PDO::FETCH_ASSOC);
                return $result;
                return true;
            }else {
                return false;
            }
        }

        public function search_keyword($keyword){
            $sql = "SELECT * FROM `student_tb` WHERE `name` LIKE '%$keyword%' ";
            $query = $this->condb->prepare($sql);
            if($query->execute()){
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                return $result;
                return true;
            }else {
                return false;
            }
        }

        public function addStudent($name,$student_id,$major,$number_id,$brith_day,$age,$img){
            $sql = "INSERT INTO `student_tb` (`name`, `student_id`, `major`, `number_id`, `brith_day`, `age`, `img`) VALUES (:name, :student_id, :major, :number_id, :brith_day, :age, :img);";
            $query = $this->condb->prepare($sql);
            $query->bindParam(':name',$name);
            $query->bindParam(':student_id',$student_id);
            $query->bindParam(':major',$major);
            $query->bindParam(':number_id',$number_id);
            $query->bindParam(':brith_day',$brith_day);
            $query->bindParam(':age',$age);
            $query->bindParam(':img',$img);
            if($query->execute()){
                return true;
            }else {
                return false;
            }
        }

        

        public function deleteStudent($student_id){
           $sql = "DELETE FROM student_tb WHERE student_id = :student_id";
           $query = $this->condb->prepare($sql);
           $query->bindParam(':student_id',$student_id);
           try{
            $query->execute();
            return true;
           }catch(Exception $err){
            return false;
           }
        }
        

        public function editStudent($name,$student_id,$major,$number_id,$brith_day,$age,$img){
            $sql = "UPDATE `student_tb` SET `name` = :name, `student_id` = :student_id, `major` = :major, `number_id` = :number_id, `brith_day` = :brith_day, `age` = :age, `img` = :img WHERE `student_tb`.`student_id` = :student_id;";
            $query = $this->condb->prepare($sql);
            $query->bindParam(':name',$name);
            $query->bindParam(':student_id',$student_id);
            $query->bindParam(':major',$major);
            $query->bindParam(':number_id',$number_id);
            $query->bindParam(':brith_day',$brith_day);
            $query->bindParam(':age',$age);
            $query->bindParam(':img',$img);
            if($query->execute()){
                return true;
            }else {
                return false;
            }
        }

        public function getDetail($student_id){
            $sql = "SELECT * FROM `student_tb` WHERE `student_id` = :student_id";
            $query = $this->condb->prepare($sql);
            $query->bindParam(':student_id',$student_id,PDO::PARAM_INT);
            if($query->execute()){
                $result = $query->fetch(PDO::FETCH_ASSOC);
                return $result;
                return true;
            }else {
                return false;
            }
        }


    }

?>