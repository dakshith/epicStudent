 <?php include_once dirname(__FILE__)."/../layout/mainlayout.php";  ?>
<html lang="en">
 
<body>



<div class="container ">
<div class="row"> 
 <div class="col-xs-12 col-md-4"> 
</div>
<div class="col-xs-12 col-md-4"> 
<div class="panel panel-default credit-card-box">
<div class="panel-heading"> 
<h3 class="panel-title display-td " >Update Student Details</h3>                   
</div>
<div class="panel-body"> 
<form method="POST"> 
    <label for="username">Course Name:</label>
  <input type="text" id="fname" class="form-control" name="course_name" value="<?= $data->course_name ?>" required><br/><br/> 

  <label for="username">Course Detail:</label>
  <textarea  id="lname" class="form-control" name="detail" value="<?= $data->detail ?>" required><?= $data->detail ?></textarea><br/><br/>

  <div class="col-md-12 text-center">
	  <input class="btn btn-primary" value="Update" type="submit" name="btn-save">
	</div>
</form>

</div>
</div>             


</div>            

<div class="col-xs-12 col-md-4">
 

</div>

</div>
</div>

 
	
</body>
</body>
</html>
