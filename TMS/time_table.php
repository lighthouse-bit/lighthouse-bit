<?php 
    //include("classes/connect.php");
    include("classes/time_table.php");
    include("classes/connect.php");

    //$class = "";
    //$staff = "";
    //$subject = "";
   
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {

        $signup = new Signup();
        $result = $signup->evaluate($_POST);

        $class = $_POST['class'];
        $staff = $_POST['staff'];
        $subject = $_POST['subject'];

        
        // static $monday = "1";
        // static $tuesday = "2";
        // static $wednesday = "3";
        // static $thursday = "4";
        // static $friday = "5";
        
       
       
    }


?>



<html><head>
        <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
        <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    </head>

    <body>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
            <div class="d-flex justify-content-center pt-3 container">
                <label class="label label-default">Select Class</label>
                <select class="form-select" aria-label="Default select example" name="class">
                    <option value="">Select class</option>
                    <?php
                    

                    $query = "select * from class";
                    $fetch = "select * from staff";
                    $link = "select *from subject";
                    $time = "select * from time_frame";
                    $DB = new Database();
                    $display = $DB->read($query);
                    $show = $DB->read($fetch);
                    $see = $DB->read($link);
                    $alt = $DB->read($time);
                    foreach ($display as $key) {
                    ?>
                    <option value="<?php echo $key['class_name'];?>"><?php echo $key['class_name'];?></option>
                    <?php } ?>
                                                                            
                                        
                                                                            
                </select>
            </div><br>
            
                <div class="table-responsive ">
                    <table class="table table-striped table-hover table-condensed">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <?php
                                    
                                    foreach ($alt as $key) {
                                    ?>
                                        <th scope="col">
                                            <?php echo $key['start'] . "-" . $key['end'] ; ?>
                                        </th>                            
                                    <?php } ?>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">Monday</th>
                                <?php
                                
                                foreach ($alt as $key) {
                                            ?>
                                    <td>
                                    
                                        <select name="staff[]" id="">
                                            
                                            <option value="">Select staff</option>
                                            <?php
                                            
                                            foreach ($show as $key) {                                            
                                                    ?>
                                                <option value="<?php echo $key['id'];?>"><?php echo $key['firstname'] . " " . $key['lastname']?></option>
                                         
                                            <?php } ?>
                                        </select><br><br>
                                        <select name="subject[]" id="">
                                        
                                            <option value="">Select subject</option>
                                            <?php
                                            foreach ($see as $key) {
                                                ?>
                                                <option value="<?php echo $key['subject_title'];?>"><?php echo $key['subject_title'] ?></option>                        
                                            
                                            <?php } ?>
                                        </select>
                                    </td>
                                <?php } ?>
                               
                            </tr>
                            <tr>
                                <th scope="row">Tuesday</th>
                                <?php
                                foreach ($alt as $key) {
                                            ?>
                                    <td>
                                    
                                        <select name="staff[]" id="">
                                            <option value="">Select staff</option>
                                            <?php
                                            foreach ($show as $key) {
                                                    ?>
                                                <option value="<?php echo $key['id'];?>"><?php echo $key['firstname'] . " " . $key['lastname']?></option>                        
                                                
                                            <?php } ?>
                                        </select><br><br>
                                        <select name="subject[]" id="">
                                        
                                            <option value="">Select subject</option>
                                            <?php
                                            foreach ($see as $key) {
                                                ?>
                                                <option value="<?php echo $key['subject_title'];?>"><?php echo $key['subject_title'] ?></option>                        
                                            
                                            <?php } ?>
                                        </select>
                                    </td>
                                <?php } ?>
   
                            </tr>
                            <tr>
                                <th scope="row">Wednesday</th>
                             
                                <?php
                                foreach ($alt as $key) {
                                            ?>
                                    <td>
                                        <select name="staff[]" id="">
                                            <option value="">Select staff</option>
                                            <?php
                                            foreach ($show as $key) {
                                                    ?>
                                                <option value="<?php echo $key['id'];?>"><?php echo $key['firstname'] . " " . $key['lastname']?></option>                        
                                                
                                            <?php } ?>
                                        </select><br><br>
                                        <select name="subject[]" id="">
                                        
                                            <option value="">Select subject</option>
                                            <?php
                                            foreach ($see as $key) {
                                                ?>
                                                <option value="<?php echo $key['subject_title'];?>"><?php echo $key['subject_title'] ?></option>                        
                                            
                                            <?php } ?>
                                        </select>
                                    </td>
                                <?php } ?>
                             
                            </tr>
                            <tr>
                                <th scope="row">Thursday</th>
                               
                                <?php
                                foreach ($alt as $key) {
                                            ?>
                                    <td>
                                    
                                        <select name="staff[]" id="">
                                            <option value="">Select staff</option>
                                            <?php
                                            foreach ($show as $key) {
                                                    ?>
                                                <option value="<?php echo $key['id'];?>"><?php echo $key['firstname'] . " " . $key['lastname']?></option>                        
                                                
                                            <?php } ?>
                                        </select><br><br>
                                        <select name="subject[]" id="">
                                        
                                            <option value="">Select subject</option>
                                            <?php
                                            foreach ($see as $key) {
                                                ?>
                                                <option value="<?php echo $key['subject_title'];?>"><?php echo $key['subject_title'] ?></option>                        
                                            
                                            <?php } ?>
                                        </select>
                                    </td>
                                <?php } ?>
 
                            </tr>
                            <tr>
                                <th scope="row">Friday</th>
                               
                                <?php
                                foreach ($alt as $key) {
                                            ?>
                                    <td>
                                    
                                        <select name="staff[]" id="">
                                            <option value="">Select staff</option>
                                            <?php
                                            foreach ($show as $key) {
                                                    ?>
                                                <option value="<?php echo $key['id'];?>"><?php echo $key['firstname'] . " " . $key['lastname']?></option>                        
                                                
                                            <?php } ?>
                                        </select><br><br>
                                        <select name="subject[]" id="">
                                        
                                            <option value="">Select subject</option>
                                            <?php
                                            foreach ($see as $key) {
                                                ?>
                                                <option value="<?php echo $key['subject_title'];?>"><?php echo $key['subject_title'] ?></option>                        
                                            
                                            <?php } ?>
                                        </select>
                                    </td>
                                <?php } ?>
                            
                            </tr>
                        </tbody>
                    </table>
                </div><br>
                <div class="col-md-12 text-center">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
        </form>
    
</body></html>