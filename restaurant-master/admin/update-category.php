<?php include('partial/menu.php')?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br/><br/>
    <?php 
    //Check whether the id is set or not
    if(isset($_GET['id']))
    {
        //Get the ID and all other details 
        $id = $_GET['id'];
        //Create SQL Query to get all other details
        $sql = "SELECT * FROM tbl_category WHERE id=$id";

        //Execute the query 
        $res = mysqli_query($conn, $sql);
        //Count the rows to check whether id is valid or not
        $count = mysqli_num_rows($res);

        if($count==1)
        {
            //Get all the data 
            $row = mysqli_fetch_assoc($res);
            $title = $row['title'];
            $current_image = $row['image_name'];
            $featured = $row['featured'];
            $active = $row['active'];
        }
        else
        {
            //Redirec to manage category with session message
            $_SESSION['no-category-found'] = "<div class='danger'>Category not Found.</div>";
            header("location:".$SITEURL.'admin/manage-category.php');
        }
    }
    else
    {
        //Redirec to manage Category
        header("location:".$SITEURL.'admin/manage-category.php');
    }
    ?>
    <form action="" method="POST" enctype="multipart/form-data">
        <table class="table"> 
            <tr>
                <td>Title</td>
                <td>
                    <input type="text" name="title" value="<?php echo $title;?>">
                </td>
            </tr>

            <tr>
                <td>Current Image</td>
                <td>
                   <?php
                   if($current_image !="")
                   {
                       //Display the image 
                       ?>
                        <img src="<?php echo $SITEURL;?>images/category/<?php echo $current_image;?>" width="90px">
                       <?php
                   }
                   else
                   {
                       //Display Method
                       echo "<div class='error'>Image not added</div>";
                   }
                   ?>
                </td>
            </tr>

            <tr>
                <td>New Image</td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>
            <tr>
                <td>Featured</td>
                <td>
                    <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes">Yes
                    <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No">No
                </td>
            </tr>
            <tr>
                <td>Active</td>
                <td>
                    <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes">Yes
                    <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No">No
                </td>
            </tr>
            
            <tr>
                <td>
                    <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="submit" name="submit" value="Update Category" class="btn btn-primary">
                </td>
            </tr>

        </table>
        </form>
        <?php 

    if(isset($_POST['submit']))
    {
        //echo "Clicker";
        //Get all the value from our form
        echo $id = $_POST['id'];
        echo $title = $_POST['title'];
        $current_image = $_POST['current_image'];
        $featured = $_POST['featured'];
        $active = $_POST['active'];

        //Updating the image if selected
        //Check whether the image is selected or not
        if(isset($_FILES['image']['name']))
        {
            //Get the Image Details
            $image_name = $_FILES['image']['name'];

            //Check whether the image avaraible or not
            if($image_name !="")
            {
                //Image varaible
                //Upload the new image
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
                 header("location:".$SITEURL.'admin/manage-category.php');
                 //stop the process
                 die();
                }
                //Remove the current image
                if($current_image !="")
                {
                    $remove_path = "../images/category/".$current_image;
                    $remove = unlink($remove_path);
    
                    //Check whether the image is removed or not
                    //if fail to remove the display message and stop the process
                    if($remove==false)
                    {
                        $_SESSION['failed-remove'] = "<div class='error'>Failed to remove the current image</div>";
                        header("location:".$SITEURL.'admin/manage-category.php');
                        die();//Stop the process
                    }
                }
            }
            else
            {
                $image_name = $current_image; 
            }
        }
        else
        {
            $image_name = $current_image; 
        }
        //Update the database
        $sql2 = "UPDATE tbl_category SET 
        title = '$title',
        image_name = '$image_name',
        featured = '$featured',
        active = '$active'
        WHERE id=$id
        ";
        
        //Execute the Query 
        $res2 = mysqli_query($conn,$sql2);
        //Redirec to manage Category with message
        //Check wether query execute or not
        if($res2==true)
        {
            //Category Updated
            $_SESSION['update'] = "<div class='success'>Update Category Successfully</div>";
            header("location:".$SITEURL.'admin/manage-category.php');
        }
        else
        {
            //Fail the Update category
            $_SESSION['update'] = "<div class='error'>Fail Update Category</div>";
            header("location:".$SITEURL.'admin/manage-category.php');
        }
    }
?>
    </div>
</div>


<?php include('partial/footer.php')?>