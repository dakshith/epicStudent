 <?php include_once dirname(__FILE__)."/../layout/mainlayout.php";  ?>
<div class="container ">
<div class="row"> 
 
<div class="col-xs-12 col-md-6">
 
<div class="panel panel-default credit-card-box">
<div class="panel-heading"> 
<h3 class="panel-title display-td " >Course Subscription</h3>                   
</div>
<div class="panel-body"> 
<form method="POST" action="Subscription/create"> 
    <div id="main_container">
  <div class="wrapper">
<div class="col-md-5">
      <label for="username">Student:</label>
  <select name="student[]" class="form-control" data-live-search="true" required>
    <option value="">Select a Student</option>
    <?php foreach($data['studentData'] as $value)
 {
   ?>
   <option value="<?= $value->student_id ?>"><?= $value->first_name.' '.$value->last_name ?></option> 
            
            <?php
 } ?>
      
    </select>
  </div>
  <div class="col-md-5">
    <label for="username">Course:</label>
  <select name="course[]" class="form-control" data-live-search="true" required>
    <option value="">Select a Course</option>
    <?php foreach($data['courseData'] as $value)
 {
   ?>
   <option value="<?= $value->id ?>"><?= $value->course_name ?></option> 
            
            <?php
 } ?>
      
    </select>
</div>
<div class="col-md-2">
  <br/>
  <div class="btn btn-warning add-btn">Add</div>
</div>
 </div>
</div>
  <div class="col-md-12 text-center">
    <br/>
	  <input class="btn btn-primary" value="Subscribe Now" type="submit" name="btn-save">
	</div>

</form>

</div>
</div>             


</div>            

<div class="col-xs-12 col-md-6">
 
 <table border="1" width="100%" align="center">
    <tr>
      <th colspan="5" class="text-center">Subscription Report</th>
    </tr>
    <tr>
    <th>Student Name</th> 
    <th>Course</th> 
    </tr>
    <?php
 if($data['subscription']){
 foreach($data['subscription'] as $value)
 { 
   ?>
            <tr>
            <td><?php echo $value->first_name.' '.$value->last_name; ?></td> 
            <td><?php echo $value->course_name; ?></td>
            
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
                    echo '<li><a href="Subscription?page='.($link - 1).'">Previous</a></li>';  
                  }
 foreach($data['pages'] as $key=>$page){
  if(($key+1) == $link){
                      
    $active = "active"; 
  }else{
                      
    $active = "";
  }
    echo '<li class="page-item '.$active.' ">
                        <a class="page-link" href="Subscription?page='.$page.'">'.$page.'</a> 
                        </li>';
 }
 if(ceil(count($data['subscriptionDataCount']) / 3) > $link)
  { 
    echo '<li><a href="Subscription?page='.($link + 1).'">Next</a></li>';    
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
  $(document).ready(function () {
  
 
    // initialize the counter for textbox
    var x = 1;

    // handle click event on Add More button
    $('.add-btn').click(function (e) { 
     // e.preventDefault(); 
        x++; // increment the counter
        $.ajax({
            type: "POST",
            url: 'Subscription/appendFields',
            data : {'step':x},
            success: function(response)
            {
              console.log(response);
                $('#main_container').append(response)
           }
       }); 
    });
 
    // handle click event of the remove link
    $(document).on("click", ".remove-lnk", function (e) {
      e.preventDefault();
      rmid = $(this).attr("id");
      $("#row"+rmid).remove();  // remove input field
      x--; // decrement the counter
    })
 
  });
</script>
