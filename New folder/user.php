<div class="online-list">
    <div class="online">
        <?php
            $image = "images/m-i.jpg";
            if($FRIEND_ROW['gender'] == "female")
            {
                $image = "images/f-i.jpg";
            }

            if(file_exists($FRIEND_ROW['profile_image']))
            {
                $image_class = new Image();
                $image = $image_class->get_thumb_profile($FRIEND_ROW['profile_image']);
            }
        ?>
        
        <a href="timeline.php?id=<?php echo $FRIEND_ROW['userid'];?>"><img src="<?php echo $image ?>"></a>
    </div>
    <p><a href="timeline.php?id=<?php echo $FRIEND_ROW['userid'];?>"><?php echo $FRIEND_ROW['firstname'] . " " . $FRIEND_ROW['lastname']?></a></p>
</div>