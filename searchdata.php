
<?php

error_reporting(0);
include('admin/config.php');

?>


<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title> Museum Management System</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
  <a class="my-0 mr-md-auto font-weight-normal" href="index.php">Museum Management System</a>
    <nav class="my-2 my-md-0 mr-md-3">
      <a class="p-2 text-dark" href="index.php">Home</a>
      <a class="p-2 text-dark" href="admin/">Admin Login</a>
    </nav>
</div>


<?php
$sdata=$_POST['searchdata'];
  ?>
  <h4 align="center" style="color:red">Result against "<?php echo $sdata;?>" keyword </h4> 
<?php
$ret=mysqli_query($link,"SELECT * FROM museum WHERE (M_Name like '%$sdata%'|| City like '%$sdata%')");
$num=mysqli_num_rows($ret);
if($num>0){
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>
      <div class="col-lg-12 col-md-6 mb-4" style="padding-top:2%">
        <div class="card h-100">
          <div class="card-body">
            <h4 class="card-title" align="center"><?php  echo $row['M_Name'];?></h4>
               <p class="card-text"><b>Address:</b> <?php  echo $row['Address'];?></p>
                 <p class="card-text"><b>City:</b> <?php  echo $row['City'];?></p>
                  <p class="card-text"><b>Type of museum:</b> <?php  echo $row['Type'];?></p>
                    <p class="card-text"><b>District:</b> <?php  echo $row['District'];?></p>
                      <p><b>Website:</b><a href="  "></a> <?php  echo '<a href="' .  $row['Site'] . '">Go to site </a>';?></p>

          </div>
        </div>
      </div>
    <?php }  } else { ?>
 <div class="col-lg-12 col-md-6 mb-4" style="padding-top:2%">
        <div class="card h-100">
          <div class="card-body">
            <h4 class="card-title" align="center">No Result found against this search</h4>
                  <a class="p-2 text-dark" href="index.php">Back</a>


          </div>
        </div>
      </div>
    <?php } ?>
      
</div></div>

</body>
</html>
