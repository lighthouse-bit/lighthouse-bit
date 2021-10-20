<?php 
    include("classes/connect.php");
    include("classes/class.php");

    $class_name = "";
   

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {

        $signup = new Signup();
        $result = $signup->evaluate($_POST);

        if($result != "")
        {

        }
        $class_name = $_POST['class_name'];
       
    }


?>
<!DOCTYPE html>
<html>
    
    <head>
        <title>Class Details | TMS</title>
        <link rel="stylesheet" href="class.css">
    </head>
    <body>
        <div class="outer-box">
            <div class="box">
                
                <form action="" method="POST">
                    <input value="" type="text" name="class_name" placeholder="Enter class">
                    
                    <br>
                    <button type="submit">Submit</button>
                    
                </form>
            </div>
        </div>
    
</body></html>
