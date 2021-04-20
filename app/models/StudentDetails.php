<?php
    class StudentDetails {
        private $db;

        public function __construct() {
            $this->db = new Database;
        }
 
        public function getUsers() {
            try{
                $this->db->query("SELECT * FROM Student ORDER BY student_id DESC");
                $result = $this->db->resultSet();
                return $result;
            }catch(PDOException $exception){
                die('ERROR: ' . $exception->getMessage());
            }
        }

        public function getUsersByPage() {
            try{
                if(isset($_GET['page']) && $_GET['page']>0)
                {
                  $page=$_GET['page'];
                }else{
                  $page = 1;
                }

                $limit = 3;

                $offset=($page-1)*$limit;
                $this->db->query("SELECT * FROM Student ORDER BY student_id DESC LIMIT $offset, $limit");
                $result = $this->db->resultSet();
                return $result;
            }catch(PDOException $exception){
                die('ERROR: ' . $exception->getMessage());
            }
        }


        public function getStudent($id){
            try{
                $this->db->query("SELECT * FROM Student WHERE student_id=:id");
                $this->db->bind("id",$id); 
                $result = $this->db->single();
                return $result;
            }catch(PDOException $exception){
                die('ERROR: ' . $exception->getMessage());
            }
        }


        public function deleteUser($id){
            try{
                $this->db->query("DELETE FROM student WHERE student_id=:id");
                $this->db->bind("id",$id); 
                if($this->db->execute()){
                    return true;
                }else{
                    return false;
                }
            }catch(PDOException $exception){
                die('ERROR: ' . $exception->getMessage());
            }
        }

        public function createUser($post)  
        {  
            try  
            {       
                $this->db->query("INSERT INTO student (first_name,last_name,dob,contact) VALUES (:first_name, :last_name, :dob, :contact)");  
                $this->db->bind("first_name",$post['firstname']);  
                $this->db->bind("last_name",$post['lastname']);  
                $this->db->bind("dob",$post['dob']);  
                $this->db->bind("contact",$post['contact']);  
                if($this->db->execute()){
                    return true;
                }else{
                    return false;
                }
             
   
            }  
            catch (Exception $e)   
            {      
                throw $e;  
            }  
        }  



        public function updateUser($post)  
        {   
            try  
            {         

                $this->db->query("UPDATE  student SET first_name=:first_name,last_name=:last_name,dob=:dob,contact=:contact WHERE student_id=:student_id");

                $this->db->bind("first_name",$post['firstname']);  
                $this->db->bind("last_name",$post['lastname']);  
                $this->db->bind("dob",$post['dob']);  
                $this->db->bind("contact",$post['contact']);  
                $this->db->bind("student_id",$post['id']); 
                if($this->db->execute()){
                    return true;
                }else{
                    return false;
                }
             
   
            }  
            catch (Exception $e)   
            {      
                throw $e;  
            }  
        }  
        
    }