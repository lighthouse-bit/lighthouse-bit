<?php
    
    include("classes/autoload.php");
    //include("classes/logout.php");
    $login = new Login();
    $user_data = $login->check_login($_SESSION['ultimate_userid']);
    $Post = new Post();
    $DB = new Database();
    $ERROR = "";
    if(isset($_GET['id']))
    {
        
        $ROW = $Post->get_one_post($_GET['id']);

        if(!$ROW){
            $ERROR = "No such post was found!";
        }else
        {
            if($ROW['userid'] !=$_SESSION['ultimate_userid'])
            {
                $ERROR = "Access denied!";
            }
        }
    }else
    {
        $ERROR = "No such post was found!";
    }

    // if something was posted
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $Post->delete_post($_POST['postid']);
        header("Location: home.php");
        die();
    }
    if(isset($_GET['id']) && is_numeric($_GET['id']))
    {
        $profile = new Profile();
        $profile_data = $profile->get_profile($_GET['id']);

        if(is_array($profile_data)){
            $user_data = $profile_data;
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
    $id = $_SESSION['ultimate_userid'];
    $posts = $post->get_posts($id,$_POST);

    // colloect frikends
    $user = new User();
    $id = $_SESSION['ultimate_userid'];
    $friends = $user->get_friends($id,$_POST);

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete | Ultimate</title>
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
            
            <form action="" method="post" enctype="multipart/form-data">
                <div class="write-post-container">
                    

                    <div class="post-input-container">
                       
                        
                        <hr>
                            <?php
                             if($ERROR != "")
                             {
                                 echo $ERROR;
                             }else
                            {
                                echo "Are you sure you want to delete this post?<br>";
                                $user = new User();
                                $Post = new Post();
                                $ROW = $Post->get_one_post($_GET['id']);
                                $ROW_USER = $user->get_user($ROW['userid']);

                                include("post_delete.php") ;
                                echo "<input type='hidden' name='postid' value=' $ROW[postid]'>";
                                echo "<button type='submit'>Delete</button>";
                            }
                                
                            ?>
                        <hr>
                        
                    </div>
                    
                </div>
                
            </form>

        </div>

    </div> 
    <div class="footer">
        <p>Copyright 2021 - The Lights Consultancy</p>
    </div>
    <script src="script.js"></script>   
</body>
</html>