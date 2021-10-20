<?php 
    include("classes/connect.php");
    include("classes/school.php");

    $school_name = "";
    $address = "";
    $motor = "";
   

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {

        $signup = new Signup();
        $result = $signup->evaluate($_POST);

        if($result != "")
        {

        }
        $school_name = $_POST['school_name'];
        $address = $_POST['address'];
        $motor = $_POST['motor'];
       
    }


?>


<!DOCTYPE html>
<html>
    
    <head>
        <title>School Details | TMS</title>
        <link rel="stylesheet" href="staff.css">
    </head>
    <body>
        <div class="outer-box">
            <div class="box">
                
                <form action="" method="POST">
                    <input value="" type="text" name="school_name" placeholder="School name">
                    <input value="" type="text" name="motor" placeholder="motor">
                    <input value="" type="text" name="address" placeholder="Address"><br>
                    <button type="submit">Submit</button>
                    
                </form>
            </div>
        </div>
    
</body></html>
