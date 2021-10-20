<?php 
    include("classes/connect.php");
    include("classes/time.php");

    $start = "";
    $end = "";
    
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {

        $signup = new Signup();
        $result = $signup->evaluate($_POST);

        if($result != "")
        {

        }
        $start = $_POST['start'];
        $end = $_POST['end'];
       
    }


?>

<!DOCTYPE html>
<html>
    
    <head>
        <title>Time Frame | TMS</title>
        <link rel="stylesheet" href="staff.css">
    </head>
    <body>
        <div class="outer-box">
            <div class="box">
                
                <form action="" method="POST">
                    <label for="">Starts</label>
                    <select name="start" id="">
                        <option value="8:00">8:00</option>
                        <option value="8:30">8:30</option>
                        <option value="9:00">9:00</option>
                        <option value="9:30">9:30</option>
                        <option value="10:00">10:00</option>
                        <option value="10:30">10:30</option>
                        <option value="11:00">11:00</option>
                        <option value="11:30">11:30</option>
                        <option value="12:00">12:00</option>
                        <option value="12:30">12:30</option>
                        <option value="1:00">1:00</option>
                        <option value="1:30">1:30</option>
                        <option value="2:00">2:00</option>
                    </select><br>

                    <label for="">Ends</label>
                    <select name="end" id="">
                        <option value="8:00">8:00</option>
                        <option value="8:30">8:30</option>
                        <option value="9:00">9:00</option>
                        <option value="9:30">9:30</option>
                        <option value="10:00">10:00</option>
                        <option value="10:30">10:30</option>
                        <option value="11:00">11:00</option>
                        <option value="11:30">11:30</option>
                        <option value="12:00">12:00</option>
                        <option value="12:30">12:30</option>
                        <option value="1:00">1:00</option>
                        <option value="1:30">1:30</option>
                        <option value="2:00">2:00</option>
                    </select>
                    
                
                    <br>
                    <button type="submit">Submit</button>
                    
                </form>
            </div>
        </div>
    
</body></html>
