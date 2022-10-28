
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Category</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
<?php 
    // Include connection
    include ('../config/constant.php');
    //Get the ID of admin to deleted
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //Get the value and Delete 
         echo "Get the value and Delete";
         $id = $_GET['id'];
         $image_name = $_GET['image_name'];
            //Remove the Physical image file is avaraible
        if ($image_name != "")
        {
              //Image is available. So remove it
            $path = "../images/category/".$image_name;
            $remove = unlink($path);
              //if false to remove image then add an error message and stop the process
        if($remove==false)  
        {
            //Set the SESSION Message
            $_SESSION['remove'] = "<div class='error'>Failed to remove Category Image</div>";
            //Redirec to Manage Category Page
            header("location:".$SITEURL.'admin/manage-category.php');
            //Stop the Process
            die();
        }
    }
        //Create SQl Query to delete Admin
        //SQL Query to Delete data from database
        $sql = "DELETE FROM tbl_category WHERE id=$id";
        //Execute the Query 
        $res = mysqli_query($conn, $sql);
        //Check whether the Query is exucute or not 

        if ($res == true)
        {
            //Query Executed Successfully and Category deleted
            //Create the Session to Display Message
            $_SESSION['delete'] = "<div class='success'>Deleted Category Successfully </div>";
            //Redirec to Manage Category page
            header("location:".$SITEURL.'admin/manage-category.php');
        }
        else
        {
            //Redirect to manage Admin Page with message (success or error)
            //Delete the data from Database
            $_SESSION['delete'] = "<div class='error'>Failed to delete</div>";
            header("location:".$SITEURL.'admin/manage-category.php');
        }    
}
else
{
    //Redirec to manage category page
    header("location:".$SITEURL.'admin/manage-category.php');
}   
?>
</body>
</html>
   



      