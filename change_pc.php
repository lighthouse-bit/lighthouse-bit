<?php


?>

<div class="post-container" >
    <!-- change cover image -->
    <div class="cover-image">
        <?php
            $image = "images/no-image.jpg";
            $login = new Login();
            $user_data = $login->check_login($_SESSION['ultimate_userid']);
            if(file_exists($user_data['cover_image']))
            {
                $image =$image_class->get_thumb_cover($user_data['cover_image']) ;
            }
        ?>
        <img src="<?php echo $image ?>" >
    </div>
    <!-- change profile image -->
    <div class="profile-image">
        <?php
            $image = "images/m-i.jpg";
            if($user_data['gender'] == "female")
            {
                $image = "images/f-i.jpg";
            }
            if(file_exists($user_data['profile_image']))
            {
                $image = $image_class->get_thumb_profile($user_data['profile_image']);
            }
        ?>
        <img src="<?php echo $image ?>" >
        <p><a href="change_profile_image.php?change=profile">Change Profile Photo</a> | <a href="change_profile_image.php?change=cover">Change Cover Photo</a></p>
    </div>
    <div class="pees">
        <a href="timeline.php"><p>Timeline</p></a> | <a href="timeline.php?section=about"><p>About</p></a> | <a href="timeline.php?section=photos&id=<?php echo $user_data['userid'] ?>"><p>Photos</p></a> | <a href="timeline.php?section=following"><p>Following</p></a>
        
        <?php
            $mylikes = "";
            if($user_data['likes'] > 0){
                $mylikes = "(" . $user_data['likes'] . " Followers)";
            }
        ?>
        <a href="like.php?type=user&id=<?php echo $user_data['userid']?>"><button type="submit" style="float: right;width:auto;">Follow<?php echo $mylikes ?> </button></a>
    </div>
</div>