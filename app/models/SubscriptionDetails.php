<?php
    class SubscriptionDetails {
        private $db;

        public function __construct() {
            $this->db = new Database;
        }

        public function getSubscriptionDetails(){
        	try{
                $this->db->query(" SELECT u.first_name, u.last_name, i.course_name FROM student_course_mapping p
 			JOIN student u on p.student_id=u.student_id
 			JOIN course i on p.course_id=i.id ORDER BY p.id DESC");
                $result = $this->db->resultSet();
                return $result;
            }catch(PDOException $exception){
                die('ERROR: ' . $exception->getMessage()); 
        	}
    	}

        public function getSubscriptionDetailsByPage() {
            try{
                if(isset($_GET['page']) && $_GET['page']>0)
                {
                  $page=$_GET['page'];
                }else{
                  $page = 1;
                }

                $limit = 3;

                $offset=($page-1)*$limit;
                $this->db->query("SELECT u.first_name, u.last_name, i.course_name FROM student_course_mapping p
            JOIN student u on p.student_id=u.student_id
            JOIN course i on p.course_id=i.id ORDER BY p.id DESC LIMIT $offset, $limit");
                $result = $this->db->resultSet();
                return $result;
            }catch(PDOException $exception){
                die('ERROR: ' . $exception->getMessage());
            }
        }

    	public function createSubscription($post){
    		try{
	    		foreach ($post['student'] as $key=>$value) {
	    			$this->db->query("INSERT INTO student_course_mapping (student_id,course_id) VALUES (:student_id, :course_id)");  
	                $this->db->bind("student_id",$value);  
	                $this->db->bind("course_id",$post['course'][$key]);   
	                $this->db->execute();
	    		} 
                return true; 
            }catch(PDOException $exception){
                die('ERROR: ' . $exception->getMessage()); 
        	}
    	}

    }