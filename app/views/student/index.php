 <?php include_once dirname(__FILE__)."/../layout/mainlayout.php";  ?>
 <html lang="en">
 
<body>



<div class="container ">
<div class="row"> 
 
<div class="col-xs-12 col-md-4"> 
<div class="panel panel-default credit-card-box">
<div class="panel-heading"> 
<h3 class="panel-title display-td " >Registration Form</h3>                   
</div>
<div class="panel-body"> 
<form method="POST" action="Student/create"> 
  <label for="username">First Name:</label>
  <input type="text" id="fname" class="form-control" name="firstname" required><br/><br/> 

  <label for="username">Last Name:</label>
  <input type="text" id="lname" class="form-control" name="lastname" required><br/><br/>

  <label for="username">DOB (MM/DD/YYYY):</label>
  <input type="text" id="datepicker" class="form-control"name="dob" required><br/><br/>

  <label for="username">Contact Number:</label>
  <input type="tel" id="contact" class="form-control" name="contact" maxlength="10" minlength="10" required><br/><br/>

  <div class="col-md-12 text-center">
      <input class="btn btn-primary" value="Register Now" type="submit" name="btn-save">
    </div>
</form>

</div>
</div>             


</div>            

<div class="col-xs-12 col-md-8">
 
    <table border="1" width="100%" align="center">
    <tr>
    	<th colspan="5" class="text-center">Registered Students</th>
    </tr>
    <tr>
    <th>First Name</th>
    <th>Last Name</th>
    <th>DOB</th>
    <th>Contact</th>
    <th>Actions</th>
    </tr>
    <?php
 if($data){
 foreach($data['student'] as $value)
 {
   ?>
            <tr>
            <td><?php echo $value->first_name; ?></td>
            <td><?php echo $value->last_name; ?></td>
            <td><?php echo $value->dob; ?></td>
            <td><?php echo $value->contact; ?></td>
            <td><a class="btn btn-success btn-xs" href="student/update?id=<?= $value->student_id ?>">Edit</a> <a class="btn btn-danger btn-xs" href="student/delete?id=<?= $value->student_id ?>">Delete</a></td>
            </tr>
            <?php
 } 
if(isset($_GET['page']))
{
  $link=$_GET['page'];
}
else
{
  $link = 1;
}
     echo '<ul class="pagination">';
     if($link > 1)
                  { 
                    echo '<li><a href="Student?page='.($link - 1).'">Previous</a></li>';  
                  }
 foreach($data['pages'] as $key=>$page){
  if(($key+1) == $link){
                      
    $active = "active"; 
  }else{
                      
    $active = "";
  }
    echo '<li class="page-item '.$active.' ">
                        <a class="page-link" href="Student?page='.$page.'">'.$page.'</a> 
                        </li>';
 }
 if(ceil(count($data['studentDataCount']) / 3) > $link)
  { 
    echo '<li><a href="Student?page='.($link + 1).'">Next</a></li>';    
  }
 echo '</ul>';
  }else{ ?>
  	<tr>
    	<th colspan="5" class="text-center">No Data Found!</th>
    </tr>
 <?php } ?>
    </table>



    </div>

</div>
</div>

 
    
</body>
</body>
</html>

<script type="text/javascript">
   $(function() {
$( "#datepicker" ).datepicker();
});
</script>