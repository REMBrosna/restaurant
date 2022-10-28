<?php include('partial/menu.php') ?>
<div class="main-content">
    <div class="wrapper">
    <h1>Edit Admin</h1>
    <br/><br/>
    <?php
    // Get the ID of selected admin
    $id = $_GET['id'];
    //Create SQL query to Get the detail
    $sql = "SELECT * FROM tbl_admin WHERE id=$id";
    //Execute the Query
    $res = mysqli_query($conn, $sql);
    
    //Check whether the Query Execute or not 
    if ($res == TRUE){
        //Check whether the data is avaible or not 
        $count = mysqli_num_rows($res);
        if ($count==1)
        {
            //Get the Details
            //echo "admin varaible"
           $row = mysqli_fetch_assoc($res);
           $full_name = $row["full_name"];
           $username = $row["username"];
        }
        else
        {
            //Redirec to Manage Admin page
            header("location:".$SITEURL.'admin/manage-admin.php');
        }
    }
    ?>
    <form action="" method="post">
    <table class="table">
        <tr>
            <th>Full Name :</th>
            <td>
                <input type="text" name="full_name" value="<?php echo $full_name; ?>" > 
            </td>
        </tr>
        <tr>
            <th>Username :</th>
            <td>
                <input type="text" name="username" value="<?php echo $username ?>"> 
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="hidden" name="id" value="<?php echo $id ?>">  
                <input type="submit" name="submit" value="Edit" class="btn btn-primary"> 
            </td>
        </tr>
    </table>
    </form>
    </div>
</div>
<?php 
    //Check whether the submit button is clicked or not
    if (isset($_POST['submit'])){
        //Get the value from form to update
         $id = $_POST['id'];
         $full_name = $_POST['full_name'];
         $username = $_POST['username'];
         //Create the SQL Query to Update Admin
         $sql = "UPDATE tbl_admin SET 
         full_name = '$full_name',
         username = '$username'
         WHERE id='$id'
         ";
         //Execute the Query 
         $res = mysqli_query($conn, $sql);
         if ($res == true){
             //Query executed and Admin edited
             $_SESSION['edit'] = "<div class='success'>Admin edited successfully</div>";
             header("location:".$SITEURL.'admin/manage-admin.php');
         }
         else 
         {
             //Failed to Edit Admin
             $_SESSION['edit'] = "<div class='error'>Failed to edit Admin </div>";
             header("location:".$SITEURL.'admin/add-admin.php');
         }
    }
?>