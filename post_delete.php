<div class="post-container" >
    <div class="post-row">
        <div class="user-profile">
            <?php
                
                $image = "images/m-i.jpg";
                if(file_exists($ROW_USER['profile_image']))
                    {
                        $image = $image_class->get_thumb_profile($user_data['profile_image']);
                    }else
                    {

                        if($ROW_USER['gender'] == "female")
                        {
                            $image = "images/f-i.jpg";
                        }
                    }
    
            ?>
            <img src="<?php echo $image?>">
            <div>
                <p><?php
                   
           
                     echo htmlspecialchars($ROW_USER['firstname']) . " " . htmlspecialchars($ROW_USER['lastname']);
                     if($ROW['is_profile_image'])
                     {
                         $pronoun = "his";
                         if($ROW_USER['gender'] == "female")
                         {
                             $pronoun = "her";
                         }
                         echo "<span> updated $pronoun profile image</span>";
                     }

                     if($ROW['is_cover_image'])
                     {
                         $pronoun = "his";
                         if($ROW_USER['gender'] == "female")
                         {
                             $pronoun = "her";
                         }
                         echo "<span> updated $pronoun cover image</span>";
                     }
                     
                ?></p><br>
                <span><?php echo $ROW['date']?></span>
            </div>
        </div>
        <a href=""><i class="fas fa-ellipsis-v"></i></a>
    </div>
    <div style="position: relative;top:10px;bottom:20px;">
        <?php echo htmlspecialchars($ROW['post'])?>
        <br><br>
        <?php
            if(file_exists($ROW['image']))
            {
                $image_class = new Image();
                $post_image = $image_class->get_thumb_post($ROW['image']);
                echo "<img src='$post_image' style='width:100%;'/>";
            }
            
         ?>
    </div>
   
</div>