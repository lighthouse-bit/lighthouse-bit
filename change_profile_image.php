<?php 

    session_start();
    include("classes/connect.php");
	include("classes/login.php");
    include("classes/user.php");
    include("classes/post.php");
    include("classes/image.php");

   
    $login = new Login();
    $user_data = $login->check_login($_SESSION['ultimate_userid']);
    $image_class = new Image();

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {

        if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != "")
        {


            if($_FILES['file']['type'] == "image/jpeg")
            {

                $allowed_size = (1024 * 1024) *7; 
                if($_FILES['file']['size'] <$allowed_size)
                {
                    //everything is fine
                    $folder = "uploads/" . $user_data['userid'] . "/";

                    //create folder
                    if(!file_exists($folder))
                    {

                        mkdir($folder, 0777,true);
                    }

                    $image = new Image();

                    $filename =  $folder . $image->generate_filename(10) . ".jpg";
                    move_uploaded_file($_FILES['file']['tmp_name'], $filename);

                    $change = "profile";

                        //check for mode
                        if(isset($_GET['change']))
                        {

                            $change = $_GET['change'];
                        }
                    

                    
                    if($change == "cover")
                    {
                    
                        if(file_exists($user_data['cover_image']))
                        {
                            unlink($user_data['cover_image']);
                        }
                        $image-> resize_image($filename,$filename,1500,1500);
                    }else
                    {
                        if(file_exists($user_data['profile_image']))
                        {
                            unlink($user_data['profile_image']);
                        }
                        $image-> resize_image($filename,$filename,1500,1500);
                    }
                    

                    if(file_exists($filename))
                    {

                        $userid = $user_data['userid']; 
                        

                        if($change == "cover")
                        {
                            $query = "update users set cover_image = '$filename' where userid = '$userid' limit 1";
                            $_POST['is_cover_image'] = 1;
                        }else
                        {
                            $query = "update users set profile_image = '$filename' where userid = '$userid' limit 1";
                            $_POST['is_profile_image'] = 1;
                        }

                        
                        
                        $DB = new Database();
                        $DB->save($query);


                        //create a post
                        $post = new Post();
                  
                        $post->create_post($userid, $_POST,$filename);

                        header("Location: timeline.php");
                        die;
                    }
                }else
                {
                    echo"<div style='text-align:center;font-size:12px;color:white;background-color:grey'>";
                    echo "<br>The following errors occured:<br><br>";
                    echo "Only images of 3Mb or lower are allowed!";
                    echo "</div>";
                }
            }else
            {
                
                echo"<div style='text-align:center;font-size:12px;color:white;background-color:grey'>";
                echo "<br>The following errors occured:<br><br>";
                echo "Only images of jpeg type are allowed!";
                echo "</div>";
            }
            
        }else
        {
            echo"<div style='text-align:center;font-size:12px;color:white;background-color:grey'>";
			echo "<br>The following errors occured:<br><br>";
			echo "please add a valid image!";
			echo "</div>";
        }
        
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <!--<meta http-equiv="X-UA-Compatible" content="IE-edge"> -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <title>Change Profile image | Ultimate9ja</title>
        <link rel="stylesheet" href="CPI.css">
        <link rel="manifest" href="manifest.json">
        <link rel="apple-touch-icon" href="images/log.png">
        <meta name="theme-color" content="#009578">
        <script src="https://kit.fontawesome.com/46ce6ca646.js" crossorigin="anonymous"></script>

        <script src="vendors/jquery-1.7.2.min.js"></script>
        <script src="vendors/bootstrap.js"></script>
    </head>
    <body>

        <nav>
            <div class="nav-left">

                <a href="home.php"><img src="images/lo.png" class="logo"></a>
                <ul>
                    <li><a href="#"><img src="images/notification.png"></a></li>
                    <li><a href="#"><img src="images/inbox.png"></a></li>
                    <li><a href="#"><img src="images/video.png"></a></li>
                </ul>
            </div>
            <div class="nav-right">

                <div class="search-box">
                    
                    <img src="images/search.png">
                    <input type="text" placeholder="Search">
                </div>
                <div class="nav-user-icon online" onclick="settingsMenuToggle()">
                    <?php
                        
                        $image = "images/m-i.jpg";
                        if(file_exists($user_data['profile_image']))
                            {
                                $image = $image_class->get_thumb_profile($user_data['profile_image']);
                            }else
                            {

                                if($user_data['gender'] == "female")
                                {
                                    $image = "images/f-i.jpg";
                                }
                            }
            
                    ?>
                    <img src="<?php echo $image?>">
                </div>

            </div>
             <!----------settings-menu----------->
            <div class="settings-menu">


                <div id="dark-btn">
                    <span></span>
                </div>

                <div class="settings-menu-inner">
                    <div class="user-profile">
                        <?php

                            $image = "images/m-i.jpg";
                            if(file_exists($user_data['profile_image']))
                                    {
                                        $image = $image_class->get_thumb_profile($user_data['profile_image']);
                                    }else
                                    {

                                        if($user_data['gender'] == "female")
                                        {
                                            $image = "images/f-i.jpg";
                                        }
                                    }
                            ?>
                        <img src="<?php echo $image?>">
                        <div>
                        <?php echo $user_data['firstname'] . " " . $user_data['lastname'] ?><br>
                            <a href="#">See your profile</a>
                        </div>
                    </div>
                    <hr>
                    <div class="user-profile">
                        <img src="images/feedback.png">
                        <div>
                            <p>Give Feedback</p><br>
                            <a href="#">Help us to improve on new features</a>
                        </div>
                    </div>
                    <hr>


                    <div class="settings-links">
                        <img src="images/setting.png" class="settings-icon">
                        <a href="#">Settings & Privacy <img src="images/arrow.png" width="10px"></a>
                    </div>
                    <div class="settings-links">
                        <img src="images/help.png" class="settings-icon">
                        <a href="#">Help & Support <img src="images/arrow.png" width="10px"></a>
                    </div>
                    <div class="settings-links">
                        <img src="images/display.png" class="settings-icon">
                        <a href="#">Display & Accessibility <img src="images/arrow.png" width="10px"></a>
                    </div>
                    <div class="settings-links">
                        <img src="images/logout.png" class="settings-icon">
                        <a href="logout.php">Logout<img src="images/arrow.png" width="10px"></a>
                    </div>


                </div>
                
            </div>
            <!-- end of settingsmenu -->


        </nav>

        <div class="container">
            

            <!------main-content----------->
            <div class="main-content" style="position:relative;left:300px" >


               <div class="write-post-container">
                    

                    <!-- Post -->
                    <div class="post-input-container">
                        <form action="" method="post" enctype="multipart/form-data">
                            <input type="file" name="file">
                            <input type="submit" value="Change">
                        </form>

                    </div>  

                </div>
                <?php
                    $change = "profile";

                    //check for mode
                    if(isset($_GET['change']) && $_GET['change'] == "cover")
                    {

                        $change = "cover";
                        echo "<img src='$user_data[cover_image]' style='max-width:100%'>";
                    }else
                    {
                        echo "<img src='$user_data[profile_image]' style='max-width:500px'>";
                    }

                    
                ?>
            </div>

        </div>
    

        <div class="footer">
            <p>Copyright 2021 - The Lights Consultancy</p>
        </div>

        <script src="Script.js"></script>
    </body>
</html>

