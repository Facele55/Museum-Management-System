<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values

$id = $M_Name =  $City = $Address = $Type = $District = $Site = "";
$id_err = $M_Name_err =  $City_err = $Address_err = $Type_err = $District_err = $Site_err = "";


$select_dis = "SELECT * FROM district";
$result_dis = mysqli_query($link, $select_dis)  or die ("bad sql: $link");


$select_type = "SELECT * FROM type";
$result_type = mysqli_query($link, $select_type)  or die ("bad sql: $link");
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    
    // Validate name
    $input_name = trim($_POST["M_Name"]);
    if(empty($input_name)){
        $M_Name_err = "Please enter a name.";
    } else{
        $M_Name = $input_name;
    }

    // Validate 
    $input_city = trim($_POST["City"]);
    if(empty($input_city)){
        $City_err = "Please enter a City.";     
    } else{
        $City = $input_city;
    }

    // Validate address address
    $input_address = trim($_POST["Address"]);
    if(empty($input_address)){
        $Address_err = "Please enter an address.";     
    } else{
        $Address = $input_address;
    }
    
    // Validate address address
    $input_site = trim($_POST["Site"]);
    if(empty($input_site)){
        $Site_err = "Please enter website address.";     
    } else{
        $Site = $input_site;
    }
    // Validate type
    $input_type = trim($_POST["Type"]);
 
    if(empty($input_type)){
        $Type_err = "Please choose type.";     
    } else{
        $Type = $input_type;
    }

    $input_district = trim($_POST["District"]);
    if(empty($input_district)){
        $District_err = "Please enter district.";     
    } else{
        $District = $input_district;
    }

              


    
    // Check input errors before inserting in database
    if(empty($M_Name_err) && empty($City_err) && empty($Address_err) && empty($Site_err) && empty($Type_err) && empty($District_err) ) {
        // Prepare an update statement
        $sql = "UPDATE museum SET M_Name=?, City=?, Address=?, Site=?, Type=?, District=? WHERE id=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssi", $param_name, $param_city, $param_address, $param_site, $param_type, $param_district,
             $param_id);
            
            // Set parameters
            $param_name = $M_Name;
            $param_city = $City;
            $param_address = $Address;
            $param_site = $Site;
            $param_type = $Type;
            $param_district = $District;
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM museum WHERE id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $M_Name = $row["M_Name"];
                    $City = $row["City"];
                    $Address = $row["Address"];
                    $Site = $row["Site"]; 
                    $Type = $row["Type"];                    
                    $District = $row["District"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
        
        // Close connection
        mysqli_close($link);
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Update Record</h2>
                    </div>
                    <p>Please edit the input values and submit to update the record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        
                        <div class="form-group <?php echo (!empty($M_Name_err)) ? 'has-error' : ''; ?>">
                            <label>Name</label>
                            <input type="text" name="M_Name" class="form-control" value="<?php echo $M_Name; ?>">
                            <span class="help-block"><?php echo $M_Name_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($Address_err)) ? 'has-error' : ''; ?>">
                            <label>Address</label>
                            <textarea type="text" name="Address" class="form-control"><?php echo $Address; ?></textarea>
                            <span class="help-block"><?php echo $Address_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($City_err)) ? 'has-error' : ''; ?>">
                            <label>City</label>
                            <input type="text" name="City" class="form-control" value="<?php echo $City; ?>">
                            <span class="help-block"><?php echo $City_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($Site_err)) ? 'has-error' : ''; ?>">
                            <label>Site</label>
                            <input type="text" name="Site" class="form-control" value="<?php echo $Site; ?>">
                            <span class="help-block"><?php echo $Site_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($Type_err)) ? 'has-error' : ''; ?>">
                            <label>Type</label>
                                <?php 
                                $opt1 = "<select name='Type'>";
                                while ($row2=mysqli_fetch_assoc($result_type)) {
                                    $opt1 .= "<option value='{$row2['T_Name']}'>{$row2['T_Name']}</option>\n";
                                }
                                $opt1 .= "</select>"
                                ?>
                            </select>
                            <?php echo $opt1; ?>
                            <span class="help-block"><?php echo $Type_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($District_err)) ? 'has-error' : ''; ?>">
                            <label>District</label>
                            <?php 
                                $opt = "<select name='District'>";
                                while ($row1=mysqli_fetch_assoc($result_dis)) {
                                    $opt .= "<option value='{$row1['D_Name']}'>{$row1['D_Name']}</option>\n";
                                }
                                $opt .= "</select>"
                                ?>
                            </select>
                            <?php echo $opt; ?>
                            <span class="help-block"><?php echo $District_err;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>