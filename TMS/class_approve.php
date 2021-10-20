<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class Approve | TMS</title>
    <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
</head>
<body>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>S/N</th>
                <th>Class</th>
            </tr>
        </thead>
        <tbody>
            
            <?php
                include("classes/connect.php");

                $query = "select * from class";
                $DB = new Database();
                $display = $DB->read($query);
                foreach ($display as $key) {
                ?>
                <tr>
                    <td><?php echo $key['id'] ; ?></td>
                    <td><?php echo $key['class_name'] ; ?></td>
                </tr>
                <?php } ?>
                
   
        </tbody>
    </table>
</body>
</html>