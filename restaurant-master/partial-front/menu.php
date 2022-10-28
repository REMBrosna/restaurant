<?php include('config/constant.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
</head>
<style>
    .menu{
        background: rgba(0, 0, 0, 0.5);
        color: #fff;
        font-family: Khmer OS Moul;
        height: 100px;
        padding-top: 20px;
        text-align: center;
        width: 100%;
        position: fixed;
        top: 0;
    }
</style>
<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container">
            <div class="menu">
                <ul>
                    <li>
                        <a href="<?php echo $SITEURL; ?>">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo $SITEURL;?>categories.php">Categories</a>
                    </li>
                    <li>
                        <a href="<?php echo $SITEURL;?>foods.php">Foods</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
        <script src="../script/scroll.js"></script>
    </section>
    <!-- Navbar Section Ends Here -->