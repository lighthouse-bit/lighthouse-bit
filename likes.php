<?php
    
    include("classes/autoload.php");
    
    $login = new Login();
    $user_data = $login->check_login($_SESSION['ultimate_userid']);
    $Post = new Post();
    $DB = new Database();
    $likes = false;
    $ERROR = "";
    if(isset($_GET['id']) && isset($_GET['type']))
    {
        $likes = $Post-> get_likes($_GET['id'],$_GET['type']);
        
    }else
    {
        $ERROR = "No information was found!";
    }

   
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>People who liked | Ultimate</title>
    <link rel="stylesheet" href="timeline.css">
</head>
<body>
    <nav>
        <!-- left nav -->
        <div class="nav-left">
            <a href="home.php"><img src="images/logo.png" class="logo"></a>
            <ul>
                <li><img src="images/notification.png"></li>
                <li><img src="images/inbox.png"></li>
                <li><img src="images/video.png"></li>
            </ul>
        </div>

        <!-- right nav -->
        <div class="nav-right">
            <div class="search-box">
                <img src="images/search.png">
                <input type="text" placeholder="Search">
            </div>

            <div class="nav-user-icon online" onclick="settingsMenuToggle()">
            <?php
                        
                        $image = "images/m-i.jpg";
                        $login = new Login();
                        $user_data = $login->check_login($_SESSION['ultimate_userid']);
                        if(file_exists($user_data['profile_image']))
                            {
                                $image_class = new Image();
                                $image = $image_class->get_thumb_profile($user_data['profile_image']);
                            }else
                            {

                                if($user_data['gender'] == "female")
                                {
                                    $image = "images/f-1.jpg";
                                }
                            }
            
            ?>
            <img src="<?php echo $image?>">
            </div>
        </div>
        <!-- settings-menu -->
        <div class="settings-menu">
            <div id="dark-btn" >
                <span>

                </span>
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
                        <p><?php echo $user_data['firstname'] . " " . $user_data['lastname']?></p>
                        <a href="">View your profile</a>
                    </div>
                    
                </div>
                <hr>
                <div class="user-profile">
                    <img src="images/feedback.png">
                    <div>
                        <p>Give Feedback </p>
                        <a href="">Help us improve on the app</a>
                    </div>
                </div>
                <hr>
                <div class="settings-links">
                    <img src="images/setting.png" class="settings-icon">
                    <a href="">Settings & Privacy <img src="images/arrow.png" width="10px"></a>
                </div>
                <div class="settings-links">
                    <img src="images/help.png" class="settings-icon">
                    <a href="">Help & Support <img src="images/arrow.png" width="10px"></a>
                </div>
                <div class="settings-links">
                    <img src="images/display.png" class="settings-icon">
                    <a href="">Display & Accessibility <img src="images/arrow.png" width="10px"></a>
                </div>
                <div class="settings-links">
                    <img src="images/logout.png" class="settings-icon">
                    <a href="classes/logout.php">  Logout <img src="images/arrow.png" width="10px"></a>
                </div>
            </div>
            
        </div>
    </nav>
    <br>
    
    <div class="container" >
        

        <!-- main content -->
        <div class="main-content" style="position:relative;left:300px">
            
            
                <div class="write-post-container">
                    

                    <div class="post-input-container">
                       
                        
                        <hr>
                            <?php

                                $User = new User();
                                $image_class = new Image();

                                if(is_array($likes)){
                                    foreach($likes as $row){
                                        $FRIEND_ROW = $User->get_user($row['userid']);
                                        include("user.php");
                                    }
                                }
                            ?>
                        <hr>
                        
                    </div>
                    
                </div>
                
           

        </div>

    </div> 
    <div class="footer">
        <p>Copyright 2021 - The Lights Consultancy</p>
    </div>
    <script src="script.js"></script>   
</body>
</html>