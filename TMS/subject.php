<?php 
    include("classes/connect.php");
    include("classes/subject.php");

    $subject_title = "";
    
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {

        $signup = new Signup();
        $result = $signup->evaluate($_POST);

        if($result != "")
        {

        }
        $subject_title = $_POST['subject_title'];
       
    }


?>

<!DOCTYPE html>
<html>
    
    <head>
        <title>Subject Details | TMS</title>
        <link rel="stylesheet" href="staff.css">
    </head>
    <body>
        <div class="outer-box">
            <div class="box">
                
                <form action="" method="POST">
                    <input value="" type="text" name="subject_title" placeholder="Enter subject">
                
                    <br>
                    <button type="submit">Submit</button>
                    
                </form>
            </div>
        </div>
    
</body></html>
