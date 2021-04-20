<?php
class Student extends Controller {
    public function __construct() {
        $this->studentModel = $this->model('StudentDetails');

        $this->pageModel = $this->model('Pagination');
    }

    public function index() { 

		$studentDataCount = $this->studentModel->getUsers();
		$pages = $this->pageModel->Paginate($studentDataCount,3); 
        $studentData = $this->studentModel->getUsersByPage();
        
    	$data=[ 
    		'student'=>$studentData,
    		'pages'=>$pages,
            'studentDataCount'=>$studentDataCount,
    	];
        $this->view('student/index',$data);

    }


     public function create() {
    	if($_SERVER['REQUEST_METHOD']=='POST'){
    		//print_r($_POST);exit; 
    		$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    		try  
            {  
            	$data = [
	                'firstname' => trim($_POST['firstname']),
	                'lastname' => trim($_POST['lastname']),
	                'dob' => trim($_POST['dob']),
	                'contact' => trim($_POST['contact']),
	            ]; 

            	$query=$this->studentModel->createUser($data);  
            	if ($query) {
                    //Redirect to the login page
                    header('location: ' . URLROOT . '/student');
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
	                'firstname' => trim($_POST['firstname']),
	                'lastname' => trim($_POST['lastname']),
	                'dob' => trim($_POST['dob']),
	                'contact' => trim($_POST['contact']),
	                'id'=>$id,
	            ]; 

            	$query=$this->studentModel->updateUser($data);  
            	if ($query) {
                    //Redirect to the login page
                    header('location: ' . URLROOT . '/student');
                } else {
                    die('Something went wrong.');
                } 
            }  
            catch (Exception $e)   
            {     
                throw $e;  
            } 
    		
    	}else{
    		$data = $this->studentModel->getStudent($id);
 
    		$this->view('student/update',$data);
    	}

    }

    public function delete(){
    	$id=$_GET['id'];
    	if($id){
    		
    		$query=$this->studentModel->deleteUser($id);  
            	if ($query) {
                    //Redirect to the login page
                    header('location: ' . URLROOT . '/student');
                } else {
                    die('Something went wrong.');
                } 
    	}
    }


}