
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete admin</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
<?php 
    // Include connection
    include ('../config/constant.php');
    //Get the ID of admin to deleted
        $id = $_GET['id'];
        //Create SQl Query to delete Admin
        $sql = "DELETE FROM tbl_admin WHERE id=$id";
        //Execute the Query 
        $res = mysqli_query($conn, $sql);
        //Check whether the Query is exucute or not 
        if ($res == true)
        {
            //Query Executed Successfully and Admin deleted
            //Create the Session to Display Message
            $_SESSION['delete'] = "<div class='success'>Deleted Admin Successfully </div>";
            //Redirec to Manage admin page
           header("location:".$SITEURL.'admin/manage-admin.php');
        }
        else
        {
            $_SESSION['delete'] = "<div class='error'>Failed to delete</div>";
           header("location:".$SITEURL.'admin/manage-admin.php');
        }
        //Redirect to manage Admin Page with message (success or error)
?>
</body>
</html>
   


