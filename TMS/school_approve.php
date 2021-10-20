<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Approve | TMS</title>
    <script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
    <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
</head>
<body>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>S/N</th>
                <th>Name</th>
                
            </tr>
        </thead>
        <tbody>
            
            <?php
                include("classes/connect.php");

                $query = "select * from school";
                $DB = new Database();
                $display = $DB->read($query);
                foreach ($display as $key) {
                ?>
                <tr>
                    <td><?php echo $key['id'] ; ?></td>
                    <td><?php echo $key['school_name'] ; ?></td>
                    
                </tr>
                <?php } ?>
                
   
        </tbody>
    </table>
</body>
</html>