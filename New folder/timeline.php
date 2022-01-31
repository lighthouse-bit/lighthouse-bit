<?php
    
    include("classes/autoload.php");
    //include("classes/logout.php");
    $login = new Login();
    $user_data = $login->check_login($_SESSION['ultimate_userid']);
  
    $USER = $user_data;
    if(isset($_GET['id']) && is_numeric($_GET['id']))
    {
        $profile = new Profile();
        $profile_data = $profile->get_profile($_GET['id']);

        if(is_array($profile_data)){
            $user_data = $profile_data[0];
        }
    }
    // posting starts here

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $post = new Post();
        $id = $_SESSION['ultimate_userid'];
        $result = $post->create_post($id,$_POST,$_FILES);
        
        if($result == "")
        {
            header("Location: home.php");
            die();
        }else
        {
            echo "<div style='text-align:center;font-size:12px;color:white;background-color:grey;'>";
            echo "The following errors occured: <br>";
            echo $result;
            echo "</div>";
        }
    }

    //collect posts
    $post = new Post();
    $id = $user_data['userid'];
    $posts = $post->get_posts($id,$_POST);

    // colloect frikends
    $user = new User();
   
    $friends = $user->get_friends($id,$_POST);

    $image_class = new Image();

    
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timeline | Ultimate</title>
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
                        if(file_exists($USER['profile_image']))
                            {
                                $image = $image_class->get_thumb_profile($USER['profile_image']);
                            }else
                            {

                                if($USER['gender'] == "female")
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
                        if(file_exists($USER['profile_image']))
                            {
                                $image = $image_class->get_thumb_profile($USER['profile_image']);
                            }else
                            {

                                if($USER['gender'] == "female")
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

    <div class="container" >
        

        <!-- main content -->
        <div class="main-content" style="position:relative;left:300px">
            <?php
                
                include("change_pc.php");
            
                $section = "default";
                if(isset($_GET['section']))
                {
                    $section = $_GET['section'];
                }
                if($section == "default")
                {
                    include("profile_content_default.php");
                }elseif($section == "photos")
                {
                    include("profile_content_photos.php");
                }
                
            ?>
            
            <button type="button" class="load-more-btn">Load More</button>
        </div>

 


        <!-- right sidebar -->
        <div class="right-sidebar">
            <div class="sidebar-title">
                <h4>Events</h4>
                <a href="">See All</a>
            </div>

            <div class="event">
                <div class="left-event">
                    <h3>18</h3>
                    <span>March</span>
                </div>
                <div class="right-event">
                    <h4>Social Media</h4>
                    <p><i class="fas fa-map-marker-alt"></i> Willson Tech Park</p>
                    <a href="">More Info</a>
                </div>
            </div>
            <div class="event">
                <div class="left-event">
                    <h3>22</h3>
                    <span>June</span>
                </div>
                <div class="right-event">
                    <h4>Mobile Markwting</h4>
                    <p><i class="fas fa-map-marker-alt"></i> Tech Park</p>
                    <a href="">More Info</a>
                </div>
                
            </div>
            <div class="sidebar-title">
                <h4>Advertisement</h4>
                <a href="">Close</a>
            </div>
            <img src="images/advertisement.png" class="sidebar-ads">

           
        </div>
    </div> 
    <div class="footer">
        <p>Copyright 2021 - The Lights Consultancy</p>
    </div>
    <script src="script.js"></script>   
</body>
</html>