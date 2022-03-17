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
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title> Museum Management System</title>
</head>

<body>
<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
  <a class="my-0 mr-md-auto font-weight-normal" href="index.php">Museum Management System</a>
    <nav class="my-2 my-md-0 mr-md-3">
      <a class="p-2 text-dark" href="admin/index.php">Admin Login</a>
    </nav>
</div>
  

  <!-- Page Content -->
  <div class="container">
<form name="search" method="post" action="searchdata.php">
    <!-- Jumbotron Header -->
       <div class="card my-4">
          <h5 class="card-header">Search By Name </h5>
          <div class="card-body">
            <div class="input-group">
              <input type="text" class="form-control" name="searchdata" placeholder="Search for..." required="true">
              <span class="input-group-btn">
                <button class="btn btn-secondary" type="submit">Go!</button>
              </span>
            </div>
          </div>
        </div>
</form>
    <!-- Page Features -->
      <div class="row text-left">
          <?php
          $ret=mysqli_query($link,"select * from museum");
          $num=mysqli_num_rows($ret);
          if($num>0){
              $cnt=1;
              while ($row=mysqli_fetch_array($ret)) {
                  ?>
                  <div class="col-lg-4 col-md-6 mb-4">
                      <div class="card h-100">
                          <div class="card-body">
                              <h4 class="card-title" align="center"><?php  echo $row['M_Name'];?></h4>
                              <p class="card-text"><b>Address:</b> <?php  echo $row['Address'];?></p>
                              <p class="card-text"><b>City:</b> <?php  echo $row['City'];?></p>
                              <p class="card-text"><b>Type of museum:</b> <?php  echo $row['Type'];?></p>
                              <p class="card-text"><b>District:</b> <?php  echo $row['District'];?></p>
                              <p><b>Website:</b><a href="  "></a>
                                  <?php  echo '<a href="' .  $row['Site'] . '">Go to site </a>';?>
                              </p>
                          </div>
                      </div>
                  </div>
              <?php } }?>
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container -->
</body>
</html>
