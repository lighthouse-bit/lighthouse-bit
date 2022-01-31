<form action="" method="post" enctype="multipart/form-data">
                <div class="write-post-container">
                    <div class="user-profile">
                    <?php
                         $post = new Post();
                         if($post->i_own($USER['userid'],$_SESSION['ultimate_userid']))
                         {
            
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
                            } 
            
                    ?>
                    <img src="<?php echo $image?>">
                        <div>
                            <p><?php echo $user_data['firstname'] . " " . $user_data['lastname']?></p>
                            <small>Public <i class="fas fa-caret-down"></i></small>
                        </div>
                        
                    </div>

                    <div class="post-input-container">
                        <textarea  rows="3" placeholder="What's on your mind,<?php echo $user_data['firstname'] ;?>?" name="post"></textarea>
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
            