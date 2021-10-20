<?php 
    include("classes/connect.php");
    include("classes/staff.php");

    $firstname = "";
    $lastname = "";

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {

        $signup = new Signup();
        $result = $signup->evaluate($_POST);

        if($result != "")
        {

        }
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
    }


?>

<!DOCTYPE html>
<html>
    
    <head>
        <title>Staff Details | TMS</title>
        <link rel="stylesheet" href="staff.css">
    </head>
    <body>
        <div class="outer-box">
            <div class="box">
                
                <form action="" method="POST">
                    <input value="" type="text" name="firstname" placeholder="First name">
                    <input value="" type="text" name="lastname" placeholder="Last name">
                    <br>
                    <button type="submit">Submit</button>
                    
                </form>
            </div>
        </div>
    
</body></html>
