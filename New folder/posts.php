<div class="post-container" >
    <div class="post-row">
        <div class="user-profile">
            <?php
                
                $image = "images/m-i.jpg";
                if(file_exists($ROW_USER['profile_image']))
                    {
                        $image = $image_class->get_thumb_profile($ROW_USER['profile_image']);
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
    <div class="post-row" style="position: relative;top:20px;bottom:10px">
        <div class="activity-icons">
            <?php
                $likes = "";
                $likes = ($ROW['likes'] > 0) ? $ROW['likes'] : "" ;
            ?>
            <a href="like.php?type=post&id=<?php echo $ROW['postid'];?>"><div><img src="images/like-blue.png" ><?php echo $likes ?></div></a>
            <div><img src="images/comments.png" >50</div>
            <div><img src="images/share.png" >20</div>
        </div>
        <div class="post-profile-icon">
            <span style="font-size: 12px;padding-right:2px">
                 <?php 
                 $post = new Post();
                 if($post->i_own_post($ROW['postid'],$_SESSION['ultimate_userid']))
                 {

                 
                    echo 
                        "<a href='edit.php?id=$ROW[postid]'>Edit </a> . <a href='delete.php?id= $ROW[postid]'>Delete </a>"; 
                }   

               
                ?> 
            </span>
                <?php
                    $i_liked = false;
                    if(isset($_SESSION['ultimate_userid']))
                    {
                        
                    
                        $DB = new Database();
                        
                        $sql = "select likes from likes  where type = 'post'  && contentid = '$ROW[postid]' limit 1";
                        $result = $DB->read($sql);
                        if(is_array($result))
                        {
                            $likes = json_decode($result[0]['likes'], true);

                            $user_ids = array_column($likes, "userid");

                            if(in_array($_SESSION['ultimate_userid'],$user_ids))
                                {
                                    $i_liked = true;
                                }

                            }

                        if($ROW['likes'] > 0){

                            echo "<br/>";
                            echo "<a href='likes.php?type=post&id=$ROW[postid]'>";

                            if($ROW['likes'] == 1){
                                if($i_liked)
                                {
                                    echo "<div style='text-align:left;'>You liked this post </div>";
                                }else
                                {
                                     
                                    echo "<div style='text-align:left;'>1 person liked this post </div>";
                                }
                               
                            }else{
                                if($i_liked){
                                    $text = "others";
                                    if($ROW['likes'] -1 ==1){
                                        $text = "other";
                                    }
                                    echo "<div style='text-align:left;'> You and " . ($ROW['likes'] - 1) . " $text liked this post </div>";
                                }else{
                                    echo "<div style='text-align:left;'>" . $ROW['likes'] . " other liked this post </div>";
                                }
                              
                            }
                            echo "</a>";
                        }
                    }
                ?>
            <?php
                
                $image = "images/m-i.jpg";
                if(file_exists($ROW_USER['profile_image']))
                    {
                        $image = $image_class->get_thumb_profile($ROW_USER['profile_image']);
                    }else
                    {

                        if($ROW_USER['gender'] == "female")
                        {
                            $image = "images/f-i.jpg";
                        }
                    }
    
            ?>
            <img src="<?php echo $image?>">
        </div>
    </div>
</div>