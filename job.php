<?php 

include('config/database.php');

//url completa
$urlCompleted = $_SERVER['REQUEST_URI'];
//url cortada para verificação, pode conter, python, ruby, php etc
$urlCut = substr($_SERVER['REQUEST_URI'], 21);

//Encontra a posição da primeira ocorrência de uma string
$pos = strpos( $urlCompleted, $urlCut );

echo $urlCut;

//se url for igual all retorna todas as vagas
if($urlCut == 'all') {
	$sql = 'SELECT * FROM jobs ORDER BY created_at';
} 
else if ($urlCut == 'frontend') {
	$sql = "SELECT * from jobs WHERE title LIKE '%front%' ";
}
else if ($urlCut == 'reactjs') {
	$sql = "SELECT * from jobs WHERE title LIKE '%react%' ";
} else {
	$sql = "SELECT * from jobs WHERE title LIKE '%" . $urlCut ."%' ";
}
 
//make query & get result
$result = mysqli_query($conn, $sql);

//fetch the resulting rows as an array
$getJobs = mysqli_fetch_all($result, MYSQLI_ASSOC);
 
//free the resulting rows as an array
mysqli_free_result($result);

if(!$getJobs) {
	$error = ' ocorreu algum problema :(';
} 

//close connectiong
mysqli_close($conn);
 
//aciona o select para buscar as vagas
if(isset($_POST['selected'])) {
	//pega o valor, python, reactjs, ruby etc
	$getValue = $_POST['selected'];
	//da reload na url com parametro pego pelo getValue
	header('Location: job.php?='.$getValue.'');
	//unset($getJobs);
}  

 

//}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Site de Vagas</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <!-- font awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
	
	 
      
 </head>
<body>

<?php include('templates/navbar.php'); ?>

<div class="container-jobs">
    <h1>Vagas para Programadores e Desenvolvedores</h1>
    
		<div class="input-group">
			<!-- <div class="input-group-addon">
				<i class="icone-section fa fa-search"></i>
				<input type="submit" name="submit"/>
			</div> -->
			
			 

			<form  method="post">
				<div class="input-group-addon">
					<i class="icone-section fa fa-search"></i>
					<input type="submit" value="" class="inp"/>
				</div>
				<select name="selected">
					<option value="all">Todos os skills</option>
					<option value="frontend">Front-End</option>
					<option value="reactjs">ReactJS</option>
					<option value="python">Python</option>
					<option value="ruby">Ruby</option>
					<option value="php">PHP</option>
				</select>
         	</form>

			
		</div> <!-- input grupo -->

		 
</div> <!-- container-jobs -->

<div class="append-container">

<div class="first-container-jobs">
	<div class="content">
		
	<span>Tipo de contrato</span>
		<ul>
			<li><a href="contract_type.php?=clt">clt</a></li>
			<li><a href="contract_type.php?=pj">pj</a></li>
			<li><a href="contract_type.php?=estagio">estágio</a></li>
		</ul>
	<span>Nivel de Experiencia</span>
		<ul>
			<li><a href="expertise.php?=junior">júnior</a></li>
			<li><a href="expertise.php?=pleno">pleno</a></li>
			<li><a href="expertise.php?=senior">sênior</a></li>
		</ul>
	<span>Tamanho da empresa</span>
		<ul>
			<li><a href="company_type.php?=startup">startup</a></li>
			<li><a href="company_type.php?=media">p/ média</a></li>
			<li><a href="company_type.php?=grande">grande</a></li>
		</ul>

	</div>
</div>
<!-- segundo container -->
<div class="second-container-jobs">

<?php foreach ($getJobs as $jobs): ?>
		<!-- container das vagas -->
		<div class="grid-job">
			
			<div class="grid-job-img">
				<img src="assets/company-null.png"/> 
			</div>
		
		<div class="grid-append">
			<div class="title-principal">
				<h2><?php echo htmlspecialchars($jobs['title']); ?></h2>
			</div>
							
			<div class="append-jobs">
				<h3>
					<img src="assets/icon-company.svg"/> 
					<span><?php echo htmlspecialchars($jobs['company']); ?></span>
				</h3>
				<h3>
					<img src="assets/icon-location.svg"/> 
					<span><?php echo htmlspecialchars($jobs['localization']); ?></span>
				</h3>
				<h3>
					<img src="assets/icon-company.svg"/> 
					<span><?php echo htmlspecialchars($jobs['company_size']); ?></span>
				</h3>
				<h3>
					<img src="assets/icon-money.svg"/> 
					<span><?php echo htmlspecialchars($jobs['salary']); ?></span>
				</h3>
				<h3>
					<img src="assets/icon-level.svg"/> 
					<span><?php echo htmlspecialchars($jobs['nivel']); ?></span>
				</h3>
				<h3>
					<img src="assets/icon-contract.svg"/> 
					<span><?php echo htmlspecialchars($jobs['contract_ct']); ?></span>
				</h3>
				<h3>
					<img src="assets/icon-airplane.svg"/> 
					<span><?php echo htmlspecialchars($jobs['remoto']); ?></span>
				</h3>
			</div> <!--fim append-jobs -->

			<div class="container-techs">
				<section class="wrap">
					<?php foreach(explode(',', $jobs['techs']) as $ing): ?>
						<div class="techs"><?php echo htmlspecialchars($ing); ?></div>
					<?php endforeach ?>
				</section>
			</div>
			 

		</div> <!--fim grid-append -->
		
			 
				<!-- <div class="card-action right-align">
					<a class="brand-text" href="details.php?id=<?php echo $jobs['id']?>">more info</a>
				</div> -->

		</div> <!-- fim grid-job -->
			
<?php endforeach; ?>

<?php if (isset($error)): ?>
	<div class="error-404-jobs">
		<h1><?php echo $error;  ?></h1>
	</div>
<?php endif; ?>

</div><!-- fim second-container-jobs -->


</div> <!-- fim append-container -->



</body>
</html>
 