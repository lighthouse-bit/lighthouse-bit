<?php

    include("classes/connect.php");
    include("classes/signup.php");

    $firstname = "";
    $lastname = "";
    $gender = "";
    $email = "";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $signup = new Signup();
        $result = $signup->evaluate($_POST);

        if($result != ""){
            echo "<div style='text-align:center;font-size:12px;color:white;background-color:grey;'>";
            echo "The following errors occured: <br>";
            echo $result;
            echo "</div>";
        }else{
            header("Location: index_login.php");
            die();
        }
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
    }
    
?>


<html><head>
        <title>Signup | Ultimate9ja</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <div class="outer-box">
            <div class="box">
                
                <form action="" method="POST">
                    <input value="<?php echo $firstname?>" type="text" name="firstname" placeholder="First name">
                    <input value="<?php echo $lastname?>" type="text" name="lastname" placeholder="Last name"><br>
                    <label for="">Gender</label>
                    <select name="gender" >
                        <option value=""><?php echo $gender?></option>
                        <option value="male">male</option>
                        <option value="female">female</option>
                    </select><br>
                    <input type="password" name="password" placeholder="Password">
                    <input type="password2" name="password" placeholder="Confirm password">
                    <input value="<?php echo $email?>" type="text" name="email" placeholder="Email">
                    <br>
                    <button type="submit">Submit</button>
                    <a href="index_login.php"><p>already have an account?</p></a>
                </form>
            </div>
        </div>
    
</body></html>
