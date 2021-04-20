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
  <label for="username">First Name:</label>
  <input type="text" id="fname" class="form-control" name="firstname" value="<?= $data->first_name ?>" required><br/><br/> 

  <label for="username">Last Name:</label>
  <input type="text" id="lname" class="form-control" name="lastname" value="<?= $data->last_name ?>" required><br/><br/>

  <label for="username">DOB (MM/DD/YYYY):</label>
  <input type="text" id="datepicker" class="form-control"name="dob" value="<?= $data->dob ?>" required><br/><br/>

  <label for="username">Contact Number:</label>
  <input type="tel" id="contact" class="form-control" name="contact" value="<?= $data->contact ?>" maxlength="10" minlength="10" required><br/><br/>

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

<script type="text/javascript">
   $(function() {
$( "#datepicker" ).datepicker();
});
</script>