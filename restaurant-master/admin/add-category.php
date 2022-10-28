<?php include('partial/menu.php') ?>
<div class="main-content">
    <div class="wrapper">
    <h1>Add Category</h1>
    <br/><br/>
    <?php 
        if (isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        } 
        if (isset($_SESSION['uplaod']))
        {
            echo $_SESSION['uplaod'];
            unset($_SESSION['uplaod']);
        } 
    ?>
<!-- Add Category form start-->
<form action="" method="POST" enctype="multipart/form-data">
    <table class="table">
    <tr>
        <td>Title</td>
        <td>
            <input type="text" name="title" placeholder="Category Title">
        </td>
    </tr>
    
    <tr>
        <td>Select Name</td>
        <td>
            <input type="file" name="image" placeholder="Category Title">
        </td>
    </tr>

    <tr>
        <td>Featured</td>
        <td>
            <input type="radio" name="featured" value="Yes">Yes
            <input type="radio" name="featured" value="No">No
        </td>
    </tr>
    
    <tr>
        <td>Active</td>
        <td>
            <input type="radio" name="active" value="Yes">Yes
            <input type="radio" name="active" value="No">No
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <input type="submit" name="submit" value="Add Category" class="btn btn-primary">
        </td>
    </tr>
        </table>
    </form>
<!-- Add Category form End-->
<?php 
    //Check whether submit button clicked or not 
    if (isset($_POST['submit']))
    {   
        //Get the value from Category form
        $title = $_POST['title'];
        //For Radio Input, We need to check whether the button is selected or not
        if(isset($_POST['featured']))
        {
            $featured = $_POST['featured'];
        }
        else
        {
            $featured = "No";
        }
        if(isset($_POST['active']))
        {
            $active = $_POST['active'];
        }
        else
        {
            $active = "No";
        }
        if(isset($_FILES['image']['name']))
        {
            //Upload the image
            //To upload the image we need image name, source path and destination path
            $image_name = $_FILES['image']['name'];
            //Upload the image only if image is selected
            if($image_name !="")
            {
            //Auto Rename our Image
            //Get the Extension of our image (jpg, png, gif, etc)e.g. "specailfood1.jpg"
            $ext = end(explode('.', $image_name));
            //Rename the image 
            $image_name = "Food_Category_".rand(000, 999).'.'.$ext; //e.g. Food_category_843.jpg 
            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = "../images/category/".$image_name;

            //Finally Upload the image
            $upload = move_uploaded_file($source_path,$destination_path);
             //check whether the image is not uploaded or not
             //And if the image is not upload then will stop the process and redirec with error message
             if($upload==false)
             {
                  //Redirec to Add Category page
                 $_SESSION['upload'] = "<div class='danger'>Fail to upload Image.</div>";
                 header("location:".$SITEURL.'admin/add-category.php');
                 //stop the process
                 die();
                }
            }
        }
        else
        {
           //Do not upload Image and set the image_name value as blank
           $image_name = "";
        }
        //Create SQL Query to Insert Category into Database
        $sql ="INSERT INTO tbl_category SET
        title='$title',
        image_name='$image_name',
        featured='$featured',
        active='$active'
        ";
        //Execute the query and Save into Database
        $res = mysqli_query($conn,$sql) or die(mysqli_error($conn));
        //Check whether the query executed or not and data added or not
        if($res==true)
        {
            //Query Executed and category Added
            $_SESSION['add']="<div class='success'>Add Category Successfully</div>";
            //Redirec to Manage Category Page
            header("location:".$SITEURL.'admin/manage-category.php');
        }
        else
        {
            //Fail to add category
            $_SESSION['add']="<div class='error'>Fail to Add Category</div>";
            //Redirec to Manage Category Page
            header("location:".$SITEURL.'admin/manage-category.php');
        }
    }
?>
    </div>
</div>

<!-- Footer  Session Starts -->
<?php include('partial/footer.php') ?>
<!-- Footer Session Ends -->