<?php
class Subscription extends Controller {
    public function __construct() {
        $this->subscriptionModel = $this->model('SubscriptionDetails');
        $this->studentModel = $this->model('StudentDetails');
        $this->courseModel = $this->model('CourseDetails');
        $this->pageModel = $this->model('Pagination');
    }

    public function index($status='') {
		$subscriptionDataCount = $this->subscriptionModel->getSubscriptionDetails();
        $studentData = $this->studentModel->getUsers();
        $courseData = $this->courseModel->getCourse();

        $pages = $this->pageModel->Paginate($subscriptionDataCount,3); 
        $subscriptionData = $this->subscriptionModel->getSubscriptionDetailsByPage();

    	$data=[
    		'action'=>$status,
    		'subscription'=>$subscriptionData,
            'studentData'=>$studentData,
            'courseData'=>$courseData,
            'pages'=>$pages,
            'subscriptionDataCount'=>$subscriptionDataCount,
    	];
        $this->view('subscription/index',$data);

    }


         public function create() {
        if($_SERVER['REQUEST_METHOD']=='POST'){
            //print_r($_POST);exit; 
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            try  
            {  

                $query=$this->subscriptionModel->createSubscription($_POST);  
                if ($query) {
                    //Redirect to the login page
                    header('location: ' . URLROOT . '/subscription');
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

    public function appendFields(){
        $studentData = $this->studentModel->getUsers();
        $courseData = $this->courseModel->getCourse();
        $row=$_POST['step'];

        $statement='<div class="wrapper"id=row'.$row.'>
                        <div class="col-md-5">
                            <label for="username">Student:</label>
                            <select name="student[]" class="form-control" data-live-search="true" required="">
                            <option value="">Select a Student</option>';
                            foreach($studentData as $value)
                             {
                               
                               $statement.='<option value="'.$value->student_id.'">'.$value->first_name.' '.$value->last_name.'</option>';
                                        
                                         
                             } 
               
                    
                          
        $statement.='</select></div>
          <div class="col-md-5">
            <label for="username">Course:</label>
              <select name="course[]" class="form-control" data-live-search="true" required="">
                <option value="">Select a Course</option>';
                  foreach($courseData as $value)
                 { 
                
                   $statement.='<option value="'.$value->id.'">'.$value->course_name.'</option>';
                            
                            
                 } 
                          
            $statement.='</select>
        </div>
        <div class="col-md-2"><br>
          <a href="#" class="btn btn-danger remove-lnk" id="'.$row.'">Remove</a>
        </div> '; 
        echo $statement;
    }
}