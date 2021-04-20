<?php
    class CourseDetails {
        private $db;

        public function __construct() {
            $this->db = new Database;
        }
 
        public function getCourse() {
            try{
                $this->db->query("SELECT * FROM course ORDER BY id DESC");
                $result = $this->db->resultSet();
                return $result;
            }catch(PDOException $exception){
                die('ERROR: ' . $exception->getMessage());
            }
        }

        public function getCurseByPage() {
            try{
                if(isset($_GET['page']) && $_GET['page']>0)
                {
                  $page=$_GET['page'];
                }else{
                  $page = 1;
                }

                $limit = 3;

                $offset=($page-1)*$limit;
                $this->db->query("SELECT * FROM course ORDER BY id DESC LIMIT $offset, $limit");
                $result = $this->db->resultSet();
                return $result;
            }catch(PDOException $exception){
                die('ERROR: ' . $exception->getMessage());
            }
        }


        public function getCoursedata($id){
            try{
                $this->db->query("SELECT * FROM course WHERE id=:id");
                $this->db->bind("id",$id); 
                $result = $this->db->single();
                return $result;
            }catch(PDOException $exception){
                die('ERROR: ' . $exception->getMessage());
            }
        }

         public function createCourse($post)  
        {  
            try  
            {       
                $this->db->query("INSERT INTO course (course_name,detail) VALUES (:course_name, :detail)");  
                $this->db->bind("course_name",$post['course_name']);  
                $this->db->bind("detail",$post['detail']);   
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


        public function updateCourse($post)  
        {   
            try  
            {         

                $this->db->query("UPDATE  course SET course_name=:course_name,detail=:detail WHERE id=:id");

                $this->db->bind("course_name",$post['course_name']);  
                $this->db->bind("detail",$post['detail']); 
                $this->db->bind("id",$post['id']); 
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


        public function deleteCourse($id){
            try{
                $this->db->query("DELETE FROM course WHERE id=:id");
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
    }