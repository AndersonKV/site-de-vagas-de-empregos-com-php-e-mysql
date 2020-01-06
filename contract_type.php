<?php

include('config/database.php');

$clt = 'clt';
$pj = 'pj';
$estagio = 'estagio';

//verifica se o parametro passado bate com os seguintes abaixo
$verifyCLT = '/' . $clt . '/';
$verifyPJ = '/' . $pj . '/';
$verifyEstagio = '/' . $estagio . '/';

if(preg_match($verifyCLT, $_SERVER['REQUEST_URI'])) {
	echo ' ------CLT-----<br>';

	$sql = "SELECT * from jobs WHERE contract_ct LIKE '%clt%' ";
	//$sql = "SELECT * `contract_ct` FROM `jobs` WHERE 1";

	//get the query result
	$result = mysqli_query($conn, $sql);

	//fetch the resulting rows as an array
	$array_clt = mysqli_fetch_all($result, MYSQLI_ASSOC);

	mysqli_free_result($result);
	
	echo '<pre>';
	//print_r($array_clt);
	echo '</pre>';

	mysqli_close($conn);


} 

else if (preg_match($verifyPJ, $_SERVER['REQUEST_URI'])) {
	echo ' ------PJ-----<br>';

	//make sql
	$sql = "SELECT * from jobs WHERE contract_ct LIKE '%pj%' ";

	//get the query result
	$result = mysqli_query($conn, $sql);

	//fetch the resulting rows as an array
	$array_pj = mysqli_fetch_all($result, MYSQLI_ASSOC);

	mysqli_free_result($result);

	echo '<pre>';
	//print_r($array_pj);
	echo '</pre>';

	mysqli_close($conn);

}

else if (preg_match($verifyEstagio, $_SERVER['REQUEST_URI'])) {
	echo ' ------ESTAGIO-----<br>';

	//make sql
	$sql = "SELECT * from jobs WHERE contract_ct LIKE '%estagio%' ";

	//get the query result
	$result = mysqli_query($conn, $sql);

	//fetch the resulting rows as an array
	$array_estagio = mysqli_fetch_all($result, MYSQLI_ASSOC);

	mysqli_free_result($result);
	
 	echo '<pre>';
	//print_r($array_estagio);
	echo '</pre>';

	mysqli_close($conn);
 
}

else {
	$error = ' ocorreu algum problema :(';
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
    <!-- font awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
  
 </head>
<body>

<?php include('templates/navbar.php'); ?>

<div class="container-jobs">
    <h1>Vagas para Programadores e Desenvolvedores</h1>
    
		<div class="input-group">
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

<?php if (isset($array_clt)): ?>
	<?php foreach ($array_clt as $jobs): ?>
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
		
		</div> <!-- fim grid-job -->
			
	<?php endforeach; ?>
<?php endif; ?> 

<?php if (isset($array_pj)): ?>
	<?php foreach ($array_pj as $jobs): ?>
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
		
		</div> <!-- fim grid-job -->
			
	<?php endforeach; ?>
<?php endif; ?>

<?php if (isset($array_estagio)): ?>
	<?php foreach ($array_estagio as $jobs): ?>
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
		
		</div> <!-- fim grid-job -->
			
	<?php endforeach; ?>
<?php endif; ?>

<?php if (isset($error)): ?>
	<div class="error-404-jobs">
		<h1><?php echo $error;  ?></h1>
	</div>
<?php endif; ?>



</div><!-- fim second-container-jobs -->


</div> <!-- fim append-container -->

<script>
const url = window.location.href;

let getUl = document.querySelectorAll('.content ul')[0];
let getLi = getUl.querySelectorAll('li');

if(url.indexOf("clt") != -1) {
    getLi[0].classList.add("classSet")
}
else if(url.indexOf("pj") != -1) {
    getLi[1].classList.add("classSet")
}
if(url.indexOf("estagio") != -1) {
    getLi[2].classList.add("classSet")
}

</script>
</body>
</html>
 