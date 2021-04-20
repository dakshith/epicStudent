<?php
class Course extends Controller {
    public function __construct() {
        $this->studentModel = $this->model('CourseDetails');
        $this->pageModel = $this->model('Pagination');
    }

    public function index() {
		$courseDataCount = $this->studentModel->getCourse();
        $pages = $this->pageModel->Paginate($courseDataCount,3); 
        $courseData = $this->studentModel->getCurseByPage();
    	$data=[ 
    		'course'=>$courseData,
            'pages'=>$pages,
            'courseDataCount'=>$courseDataCount,
    	];
        $this->view('course/index',$data);

    }


         public function create() {
        if($_SERVER['REQUEST_METHOD']=='POST'){
            //print_r($_POST);exit; 
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            try  
            {  
                $data = [
                    'course_name' => trim($_POST['course_name']),
                    'detail' => trim($_POST['detail']), 
                ]; 

                $query=$this->studentModel->createCourse($data);  
                if ($query) {
                    //Redirect to the login page
                    header('location: ' . URLROOT . '/course');
                } else {
                    die('Something went wrong.');
                } 
            }  
            catch (Exception $e)   
            {     
                throw $e;  
            } 
            
        } 

    }


    public function update() {
        $id=$_GET['id'];
        if($_SERVER['REQUEST_METHOD']=='POST'){ 
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            try  
            {  
                $data = [
                    'course_name' => trim($_POST['course_name']),
                    'detail' => trim($_POST['detail']), 
                    'id'=>$id,
                ]; 

                $query=$this->studentModel->updateCourse($data);  
                if ($query) {
                    //Redirect to the login page
                    header('location: ' . URLROOT . '/course');
                } else {
                    die('Something went wrong.');
                } 
            }  
            catch (Exception $e)   
            {     
                throw $e;  
            } 
            
        }else{
            $data = $this->studentModel->getCoursedata($id);
 
            $this->view('course/update',$data);
        }

    }

    public function delete(){
        $id=$_GET['id'];
        if($id){
            
            $query=$this->studentModel->deleteCourse($id);  
                if ($query) {
                    //Redirect to the login page
                    header('location: ' . URLROOT . '/student');
                } else {
                    die('Something went wrong.');
                } 
        }
    }


}