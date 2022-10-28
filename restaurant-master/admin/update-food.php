<?php include('partial/menu.php') ?>
<?php
    //Check whether id is set or not
    if(isset($_GET['id']))
    {
        //Get all the Details
        $id = $_GET['id'];

        //SQL Query to get the selected food
        $sql2 = "SELECT * FROM tbl_food WHERE id=$id";

        //Execute the Query
        $res2 = mysqli_query($conn,$sql2);

        //Get the value based on query executed
        $row2 = mysqli_fetch_assoc($res2);

        //Get the Individual Values of Seleted Food
        $title = $row2['title'];
        $description = $row2['description'];
        $price = $row2['price'];
        $current_image = $row2['image_name'];
        $current_category = $row2['category_id'];
        $featured = $row2['featured'];
        $active = $row2['active'];
    }
    else
    {
        //Redirect to Manage Food
        header("location:".$SITEURL.'admin/manage-food.php');
    }

?>
<div class="main-content">
    <div class="wrapper">
    <h1>Update Food</h1>
    <br/><br/>
    <form action="" method="post" enctype="multipart/form-data">
    <table class="table">
        <tr>
            <td>Title</td>
            <td>
                <input type="text" name="title" value="<?php echo $title ?>" placeholder="Food title goes here.">
            </td>
        </tr>
        <tr>
            <td>Description</td>
            <td>
                <textarea name="description" cols="50" rows="5">
                    <?php echo $description; ?>
                </textarea>
            </td>
        </tr>
        <tr>
            <td>Price</td>
            <td>
                <input type="number" name="price" value="<?php echo $price; ?>">
            </td>
        </tr>
        <tr>
            <td>Current Image</td>
            <td>
                <?php
                    if($current_image =="")
                    {
                        //Image not Varaible
                        echo "<div class='error'>Image not Avaraible</div>";
                    }
                    else
                    {
                        //Image Varailable
                        ?>
                            <img src="<?php echo $SITEURL;?>images/food/<?php echo $current_image;?>" width="90px">
                        <?php
                    }
                ?>
            </td>
        </tr>
        <tr>
            <td>Select New Image</td>
            <td>
                <input type="file" name="image">
            </td>
        </tr>
        <tr>
            <td>Category</td>
            <td>
                <select name="category">
                    <?php 
                    //Query to Get Active Categories
                    $sql ="SELECT * FROM tbl_category WHERE active='Yes'";
                    //Execute Query
                    $res = mysqli_query($conn, $sql);
                    //Count Row
                    $count = mysqli_num_rows($res);

                    //Check whether category available or not 
                    if($count>0)
                    {
                        //Category Available
                        while($row=mysqli_fetch_assoc($res))
                        {
                        $category_title = $row['title'];
                        $category_id = $row['id'];
                        ?>
                        <option <?php if($current_category==$category_id){ echo "selected";} ?> value="<?php echo $category_id ?>"><?php echo $category_title; ?></option>
                        <?php
                        }
                    }
                    else
                    {
                        //Category not Available
                        echo "<option value='0'>Category not availble</option>";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>Featured</td>
            <td>
                <input <?php if($featured=="Yes") {echo "checked";}?> type="radio" name="featured" value="Yes">Yes
                <input <?php if($featured=="No") {echo "checked";}?> type="radio" name="featured" value="No">No
            </td>
        </tr>
        <tr>
            <td>Active</td>
            <td>
                <input <?php if($active=="Yes") {echo "checked";}?> type="radio" name="active" value="Yes">Yes
                <input <?php if($active=="No") {echo "checked";}?> type="radio" name="active" value="No">No
            </td>
        </tr>
        <tr>
            <td>
                <input type="hidden" name="id" class="btn btn-primary" value="<?php echo $id; ?>">
                <input type="hidden" name="current_image" class="btn btn-primary" value="<?php echo $current_image; ?>">
                <input type="submit" name="submit" value="Update Food" class="btn btn-primary">
            </td>
        </tr>
    </table>
    </form>
 
<?php 
if(isset($_POST['submit']))
{
//1 .Get all the details from the form
$id = $_POST['id'];
$title = $_POST['title'];
$description = $_POST['description'];
$price = $_POST['price'];
$current_image = $_POST['current_image'];
$category = $_POST['category'];

$featured = $_POST['featured'];
$active = $_POST['active'];
//2.Upload the image if selected
//Check whether upload button is clicked or not
if(isset($_FILES['image']['name']))
{
    //Upload button Clicked
    $image_name = $_FILES['image']['name'];//New Image name

    //Check whether the file is available or not
    if($image_name !=""){
        //Image is available 
        //Upload the new image
        
        //Rename the Image
        $ext = end(explode('.', $image_name));//Get the extension of the image page
        $image_name ="Food-name-".rand(0000, 9999).'.'.$ext;//This will be renamed image

        //Get the Source Path and Destination Path
        $src_path = $_FILES['image']['tmp_name'];//Source Path
        $dest_path = "../images/food/".$image_name;//Destination Path

        //Upload the image 
        $upload = move_uploaded_file($src_path, $dest_path);

        //Check whether the image is uploaded or not
        if($upload==false)
        {
            //Fail to Upload
            //fail to remove the current image
            $_SESSION['upload']= "<div class='error'>Failed to Upload New Image</div>";
            //Redirec to manage food
            header("location:".$SITEURL.'admin/manage-food.php');
            //Stop the proccess
            die();
        }
        //B. Remove the Current Image if Available
        if($current_image !="")
        {   
            //Current Image is Available
            //Remove the Image
            $remove_path ="../images/food/".$current_image;
            $remove = unlink($remove_path);
            //Check whether the image is removed or not
            if($remove==false)
            {
                //Fail to remove the current image
                $_SESSION['remove-failed'] = "<div>Failed to remove the current image</div>";
                //Redirect to manage food
                header("location:".$SITEURL.'admin/manage-food.php');
                die();//Stop the Process
            }
        }
    }
    else
    {
        $image_name = $current_image;//Default Image when image is not seletect
    }
}
else
{
    $image_name = $current_image;
}
//Update the Food into Database
$sql4 ="UPDATE tbl_food SET 
    title='$title',
    description='$description',
    price=$price,
    image_name='$image_name',
    category_id='$category',
    featured='$featured',
    active='$active'
    WHERE id=$id
";
    //Execute the Query
    $res4 = mysqli_query($conn, $sql4);
    //Check whether the Query Exucuted or not
    if($res4==true)
        {
            //Query executed and food update
            $_SESSION['update'] = "<div class='success'>Food update successfully</div>";
            header("location:".$SITEURL.'admin/manage-food.php');
        }
        else
        {
            //Failed to upload Food
            $_SESSION['update'] = "<div class='success'>Food update successfully</div>";
            header("location:".$SITEURL.'admin/manage-food.php');
        }
}
?>
   </div>
</div>


 

