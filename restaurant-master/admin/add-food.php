<?php include('partial/menu.php') ?>
<div class="main-content">
    <div class="wrapper">
    <h1>Add Food</h1>
        <br/><br/>
        <?php 
        if(isset($_POST['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        } 
        ?>
<form action="" method="post" enctype="multipart/form-data"> 
    <table class="table">
    <tr>
        <td>Title</td>
        <td>
            <input type="text" name="title" placeholder="Enter name food">
        </td>
    </tr>
    <tr>
    <td>Description</td>
        <td>
            <textarea name="description" cols="30" rows="5" placeholder="Description of The Food."></textarea>
        </td>
    </tr>
    <tr>
        <td>Price</td>
        <td>
            <input type="number" name="price">
        </td>
    </tr>
    <tr>
        <td>Select Image</td>
        <td>
            <input type="file" name="image">
        </td>
    </tr>
    <tr>
        <td>Category</td>
        <td>
            <select name="category">
                <?php
                //Create the PHP Code to display categories from database
                //Create SQL to get all active categories from database
                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                //Execute the Query
                $res = mysqli_query($conn, $sql);

                //Count the rows to check whether we have categories or not
                $count = mysqli_num_rows($res);

                //if count greater than zero, We have categories else we don't have catogories
                if($count>0)
                {
                    //We have categories
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Get the Details of Categories
                        $id = $row['id'];
                        $title = $row['title'];
                        ?>
                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                        <?php
                    }
                }
                else
                {
                    //We dun have categories
                    ?>
                    <option value="0">No Category Found</option>
                    <?php 
                }
                //Display in Dropdown
                ?>
            </select>
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
        <td>
            <input type="submit" name="submit" value="Add Food" class="btn btn-primary">
        </td>
    </tr>
    </table>
</form>
    <?php
    //Check whether the button is clicked or not
    if(isset($_POST['submit']))
    {
        //Add the food in database
        //Get the data from form
        $title = $_POST['title'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $category = $_POST['category'];

        //Check whether the radion button for featured and active are clicked or not
        if(isset($_POST['featured']))
        {
            $featured = $_POST['featured'];
        }
        else
        {
            $featured = "No";//Setting the Defaul Value
        }
        if(isset($_POST['active']))
        {
            $active = $_POST['active'];
        }
        else
        {
            $active = "No";//Setting the Defaul Value
        }
        //Upload the Image if seleted 
        
        //Check whether the image is clicked or not and upload the image only if the image selected
        if(isset($_FILES['image']['name']))
        {
            //Get the details of the selected image
            $image_name = $_FILES['image']['name'];

            //check whether the image is seleted or not and upload image only if selected
            if($image_name !="")
            {
            //Image is Selected 
            //Rename the image
            //Get the extension of selected image (jpg, png, gif, etc...)   
            $ext = end(explode('.',$image_name));
            //Create New name for image
            $image_name = "Food-Name-".rand(0000,9999).".".$ext;//New Image may be "Food-Name-121.jpg"
            //Upload the image
            //Get the src Path the Desination path
            
            //Source path is the current location of the image  
            $src = $_FILES['image']['tmp_name'];

            //Destination Path for the image to be upload
            $dst = "../images/food/".$image_name;

            //Finally uploaded the food image
            $uplaod = move_uploaded_file($src, $dst);
            
            //check the whether image uploaded or not
            if($uplaod==false)
            {
                //Failed to upload the image
                //Redirec to Add food page with message error
                $_SESSION['upload'] = "<div class='error'>Failed to upload the image </div>";
                header("location:".$SITEURL.'admin/add-food.php');
                die();//Stop the Proccess
            }
        }
    }
    else
    {
        $image_name = "";//Setting default Value as Blank
    }
    //Insert into Datebase
    //Create the SQL query to save or add food
    //For Numerical we do not need to pass value inside quotes '' but for string it's compulsory to add quotes '' 
    $sql2 ="INSERT INTO tbl_food SET
    title ='$title',
    description ='$description',
    price =$price,
    image_name ='$image_name',
    category_id ='$category',
    featured ='$featured',
    active ='$active'
    ";
    //Execute the Query 
    $res2 = mysqli_query($conn, $sql2);

    //Check whether data insert or not
    if($res2==true)
    {
        //Data insert Successfully
        $_SESSION['add'] = "<div class='success'>Added Food Successfully</div>";
        //Redirec ot manage food page
        header("location:".$SITEURL.'admin/manage-food.php');
    }
    else
    {
        //Failed to insert data 
        $_SESSION['add'] = "<div class='error'>Failed to Added Food </div>";
        //Redirec ot manage food page
        header("location:".$SITEURL.'admin/manage-food.php');
    }
}  
?>
    </div>
</div>
<!-- Footer  Session Starts -->
<?php include('partial/footer.php') ?>
<!-- Footer Session Ends -->            