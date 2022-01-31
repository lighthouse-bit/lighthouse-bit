<?php

    include("classes/autoload.php");
    //include("classes/logout.php");
    $login = new Login();
    $user_data = $login->check_login($_SESSION['ultimate_userid']);
  
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
    $id = $user_data['userid'];
    $friends = $user->get_friends($id,$_POST);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Ultimate</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav>
        <!-- left nav -->
        <div class="nav-left">
            <img src="images/logo.png" class="logo">
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
                        if(file_exists($user_data['profile_image']))
                            {
                                $image_class = new Image();
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
                        <a href="timeline.php">View your profile</a>
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

    <div class="container">
        <!-- left sidebar -->
        <div class="left-sidebar">
            <div class="imp-links">
                <a href="#"><img src="images/news.png"> Latest news</a>
                <a href="#"><img src="images/friends.png"> Friends</a>
                <a href="#"><img src="images/group.png"> Group</a>
                <a href="#"><img src="images/marketplace.png"> Marketplace</a>
                <a href="#"><img src="images/watch.png"> Watch</a>
                <a href="">See More</a>
            </div>
            <div class="shortcut-links">
                <p>Your Shortcuts</p>
                <a href=""><img src="images/shortcut-1.png">Web Developers</a>
                <a href=""><img src="images/shortcut-2.png">Web Design Course</a>
                <a href=""><img src="images/shortcut-3.png"> Full Stack Developement</a>
                <a href=""><img src="images/shortcut-4.png">Website Experts</a>
            </div>
        </div>

        <!-- main content -->
        <div class="main-content">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="write-post-container">
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
                            <small>Public <i class="fas fa-caret-down"></i></small>
                        </div>
                        
                    </div>

                    <div class="post-input-container">
                        <textarea  rows="3" placeholder="What's on your mind,Dude?" name="post"></textarea>
                        <input type="file" name="file">
                        <div class="add-post-links">
                            <a href=""><img src="images/live-video.png">Live Video</a>
                            <a href=""><img src="images/photo.png">Photo/Video</a>
                            
                        </div>
                        <button type="submit">Post</button>
                    </div>

                </div>
                
            </form>

            
               <?php 
               if($posts)
               {
                   foreach($posts as $ROW)
                   {
                       $user = new User();
                       $ROW_USER = $user->get_user($ROW['userid']);
                       include("posts.php");
                   }
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

            <div class="sidebar-title">
                <h4>Conversation</h4>
                <a href="">Hide Chat</a>
            </div>

            <!-- friends -->
            <?php 
               if($friends)
               {
                   foreach($friends as $FRIEND_ROW)
                   {
                      
                       include("user.php");
                   }
               }
           
               ?>
            
        </div>
    </div> 
    <div class="footer">
        <p>Copyright 2021 - The Lights Consultancy</p>
    </div>
    <script src="script.js"></script>   
</body>
</html>