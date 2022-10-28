<?php 
    //Include constant Page
    include('../config/constant.php');

    if(isset($_GET['id']) && isset($_GET['image_name'])) //Either use '&&' or AND
    {
    //Proccess to delete
    // echo "Proccess to delete";
    //Get the ID and Image name
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];
    //Remove the image if avaible
    //Check whether the image is available or not and delete only if available
    if($image_name != "")
    {
        //If has image and need to remove it from folder
        //Get the image Path
        $path ="../images/food/".$image_name;
        //Remove image file from folder
        $remove  = unlink($path);

        //Check whether the image is removed or not
        if($image_name==false)
        {
            //Fail to remove image
            $_SESSION['upload'] = "<div class='error'>Fail to remove image file.</div>";
            //Redirec to manage food
            header("location:".$SITEURL.'admin/manage-food.php');
            //Stop the Procc of deleting food
            die();
        }
    } 
    //Delete food from database
    $sql = "DELETE FROM tbl_food WHERE id=$id";
    //Execute the Query 
    $res = mysqli_query($conn, $sql);
    //Check whether the query execute ot not and set the session message respectively
    if($res==true)
    {
        //Food delete
        $_SESSION['delete'] = "<div class='success'>Successfully to delete food.</div>";
        header("location:".$SITEURL.'admin/manage-food.php');
    }

    else
    {
        //Fail to delete food
        $_SESSION['delete'] = "<div class='error'>Failed to delete food.</div>";
        header("location:".$SITEURL.'admin/manage-food.php');
    } 
}
else
{
    //Redirec to manage food with Session message
    //Redirec to manage food page
    $_SESSION['Unauthorized'] = "<div class='error'>Unauthorized Access.</div>";
    header("location:".$SITEURL.'admin/manage-food.php');
}
?>