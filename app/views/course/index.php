 <?php include_once dirname(__FILE__)."/../layout/mainlayout.php";  ?>
<html lang="en">
 
<body>



<div class="container ">
<div class="row"> 
 
<div class="col-xs-12 col-md-4">


<!-- CREDIT CARD FORM STARTS HERE -->
<div class="panel panel-default credit-card-box">
  <div class="panel-heading"> 
  <h3 class="panel-title display-td " >Create Course</h3>                   
  </div>
    <div class="panel-body"> 
      <form method="POST" action="Course/create"> 
        <label for="username">Course Name:</label>
        <input type="text" id="fname" class="form-control" name="course_name" required><br/><br/> 

        <label for="username">Course Detail:</label>
        <textarea  id="lname" class="form-control" name="detail" required></textarea><br/><br/>

        <div class="col-md-12 text-center">
      	  <input class="btn btn-primary" value="Create" type="submit" name="btn-save">
      	</div>
      </form>

    </div>
  </div>            
 


</div>            

<div class="col-xs-12 col-md-8">
 
<table border="1" width="100%" align="center">
  <tr>
    <th colspan="3" class="text-center">Available Courses</th>
  </tr>
  <tr>
    <th>Course Name</th>
    <th>Course Detail</th> 
    <th>Actions</th>
  </tr>
  <?php
  if($data){
    foreach($data['course'] as $value)
    { ?>
      <tr>
        <td><?php echo $value->course_name; ?></td>
        <td><?php echo $value->detail; ?></td> 
        <td><a class="btn btn-success btn-xs" href="course/update?id=<?= $value->id ?>">Edit</a> <a class="btn btn-danger btn-xs" href="Course/delete?id=<?= $value->id ?>&tabname=course">Delete</a></td>
      </tr>
    <?php } 
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
        echo '<li><a href="Course?page='.($link - 1).'">Previous</a></li>';  
      }
 foreach($data['pages'] as $key=>$page){
  if(($key+1) == $link){
                      
    $active = "active"; 
  }else{
                      
    $active = "";
  }
    echo '<li class="page-item '.$active.' ">
    <a class="page-link" href="Course?page='.$page.'">'.$page.'</a> 
    </li>';
 }
 if(ceil(count($data['courseDataCount']) / 3) > $link)
  { 
    echo '<li><a href="Course?page='.($link + 1).'">Next</a></li>';    
  }
 echo '</ul>'; 
  }else{ ?>
    <tr>
      <th colspan="3" class="text-center">No Data Found!</th>
    </tr>
  <?php } ?>
</table>


        </div>

      </div>
    </div>

 
  
  </body> 
</html>