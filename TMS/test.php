<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <div>select from array</div>
        <div>select from all records</div>
    </div>

    <div>
        <?php
        
            $selected = "Adventure";
            $options = array('comedy','adventure', 'crime','adult','horror');

            echo "<select>";
            foreach($options as $option){

                if($selected==$option){
                    echo "<option selected='selected' value='$option'>$option</option>";
                }else{
                    "<option value='$option'>$option</option>";
                }
            }
            echo "</select>";
        
        
        
        
        ?>
    </div>
</body>
</html>