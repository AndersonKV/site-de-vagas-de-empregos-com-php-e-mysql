<?php 

//conecta ao banco de dados
$connection = mysqli_connect('localhost', 'root', '', 'ex_jobs'); 
 
//check connectin
if(!$connection) {
    echo 'connection error: ' . mysqli_connect_error();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Site de Vagas</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
 </head>
<body>

<?php include('templates/navbar.php'); ?>



    

</body>
</html>
 