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


<div class="container">

    <div class="display-text">
        <h5>OPORTUNIDADES PARA</h5>
        <h5>PROGRAMADOR <span>JAVA</span></h5>
    </div>
</div>


<script>


var textos = ["ruby", "java", "python", "php", "frontend"];

var i = 0;

function MudaTexto(){
    const span = document.querySelector('.display-text span');
    span.innerText = textos[i];
    
    //Move o pivô do array, até chegar ao final do mesmo, quando chegar ao 
    //final volta para o começo
    if(++i == textos.length) i = 0;
}

setInterval(function() { 
    //setInterval(MudaTexto);
    MudaTexto();
     console.log("setInterval: Ja passou 2 segundo!");
     }, 2000);
 
</script>
</body>
</html>
 