<?php 

include('config/database.php');


$thumbnail = 
$title = 
$company = 
$localization = 
$company_size =
$salary = 
$nivel = 
$contract_ct = 
$remoto = 
$techs = '';

$errors = array(
    'title' => '', 'company' => '', 
    'localization' => '','company_size' => '','salary' => '','nivel' => '',
    'contract_ct' => '','remoto' => '', 'techs' => '');


    // if(isset($_GET['submit'])) {
// 	echo $_GET['email'];
// 	echo $_GET['title'];
// 	echo $_GET['ingredients'];
// }


if(isset($_POST['submit'])) {
 	//check title
	if(empty($_POST['title'])) {

		$errors['title'] = 'titulo é necessario <br/>';
	} else {
		$title = $_POST['title'];

		if(!filter_var($title)) {
			$errors['title'] = 'title deve ser um endereço de email válido';
		}
    }

	//check company
    if(empty($_POST['company'])) {
        $errors['company'] = 'um nome é necessario <br/>';

	} else {
		$company = $_POST['company'];

		if(!filter_var($company)) {
			$errors['company'] = 'title deve ser um endereço de email válido <br/>';
		}
    }

	//check local
    if(empty($_POST['localization'])) {
        $errors['localization'] = 'local é necessario <br/>';
	} else {
		$localization = $_POST['localization'];

		if(!filter_var($localization)) {
			$errors['localization'] = 'localidade é necessaria <br/>';
		}
    }

	//check company_size
    if(empty($_POST['company_size'])) {
        $errors['company_size'] = 'porte da empresa <br/>';

	} else {
		$company_size = $_POST['company_size'];

		if(!filter_var($company_size)) {
			$errors['company_size'] = 'nome da companhnia é necessaria <br/>';
		}
    }

	//check salary
    if(empty($_POST['salary'])) {
        $errors['salary'] = 'digite o salario <br/>';
	} else {
		$salary = $_POST['salary'];

		if(!filter_var($salary)) {
			$errors['salary'] = 'salario é necessaria <br/>';
		}
    }

	//check nivel
    if(empty($_POST['nivel'])) {
        $errors['nivel'] = 'importante o nivel <br/>';

	} else {
		$nivel = $_POST['nivel'];

		if(!filter_var($nivel)) {
			$errors['nivel'] = 'nivel é necessaria <br/>';
		}
    }
    
	//check contract
    if(empty($_POST['contract_ct'])) {
        $errors['contract_ct'] = 'especifique <br/>';
	} else {
		$contract_ct = $_POST['contract_ct'];
        if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $contract_ct)) {
			$errors['contract_ct'] = 'escreva por virgula';
		}
    }

	//check remoto
    if(empty($_POST['remoto'])) {
 
        $errors['remoto'] = 'remoto? <br/>';

	} else {
		$remoto = $_POST['remoto'];

		if(!filter_var($remoto)) {
			$errors['remoto'] = 'aceita remoto? <br/>';
		}
	}

    //check techs
	if(empty($_POST['techs'])) {
		$errors['techs'] =  'pelo menos uma tecnologia <br/>';
	} else {
		$techs = $_POST['techs'];

		if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $techs)) {
			$errors['techs'] = 'deve ser como uma lista separada';
		}
	}
 
    if(array_filter($errors)) {
		//echo 'errors in the form';
	} else {
        //se conseguir passar por todos os if finalmente
		$thumbnail = mysqli_real_escape_string($conn, $_POST['thumbnail']);
		$title = mysqli_real_escape_string($conn, $_POST['title']);
		$company = mysqli_real_escape_string($conn, $_POST['company']);
		$localization = mysqli_real_escape_string($conn, $_POST['localization']);
		$company_size = mysqli_real_escape_string($conn, $_POST['company_size']);
		$salary = mysqli_real_escape_string($conn, $_POST['salary']);
		$nivel = mysqli_real_escape_string($conn, $_POST['nivel']);
		$remoto = mysqli_real_escape_string($conn, $_POST['remoto']);
		$contract_ct = mysqli_real_escape_string($conn, $_POST['contract_ct']);
		$techs = mysqli_real_escape_string($conn, $_POST['techs']);

        //create sql
		$sql = "INSERT INTO 
        jobs(
            thumbnail, 
            title, 
            company, 
            localization, 
            company_size, 
            salary, 
            nivel, 
            remoto, 
            contract_ct,
            techs) 
        VALUES(
            '$thumbnail', 
            '$title', 
            '$company', 
            '$localization', 
            '$company_size', 
            '$salary', 
            '$nivel',
            '$remoto',
            '$contract_ct',
            '$techs')";
		
 		//save to db and check
		if(mysqli_query($conn, $sql)) {
            //sucess
            echo 'sucesso!';
			//header('Location: index.php');
  		} else {
			//error
			echo 'query error: ' . mysqli_error($conn);
		}
 	}
 
 
 	 

} //end of POST CHECK



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

<div class="container-put-jobs">
    <form method="post">

    <label>thumbnail</label>
    <input class="thumbnail-job" type="file" name="thumbnail" placeholder="imagem...">
    <br>

    <div class="red-text"><?php echo $errors['title']; ?></div>
    <label>titilo</label>
    <input class="title" type="text" name="title" placeholder="titulo...">
    <br>

    <div class="red-text"><?php echo $errors['company']; ?></div>
    <label>empresa</label>
    <input class="company" type="text" name="company" placeholder="empresa...">
    <br>

    <div class="red-text"><?php echo $errors['localization']; ?></div>
    <label>local</label>
    <input class="local" type="text" name="localization" placeholder="local...">
    <br>

    <div class="red-text"><?php echo $errors['company_size']; ?></div>
    <label>tamamnho da empresa</label>
    <input class="company_size" type="text" name="company_size" placeholder="tamanho da empresa...">
    <br>

    <div class="red-text"><?php echo $errors['salary']; ?></div>
    <label>sálario</label>
    <input class="salary" type="text" name="salary" placeholder="salario...">
    <br>

    <div class="red-text"><?php echo $errors['nivel']; ?></div>
    <label>nivel</label>
    <input class="nivel" type="text" name="nivel" placeholder="nivel...">
    <br>

    <div class="red-text"><?php echo $errors['contract_ct']; ?></div>
    <label>contrato</label>
    <input class="contract" type="text" name="contract_ct" placeholder="contrato...">
    <br>

    <div class="red-text"><?php echo $errors['remoto']; ?></div>
    <label>remoto</label>
    <input class="remoto" type="text" name="remoto" placeholder="remoto...">
    <br>

    <div class="red-text"><?php echo $errors['techs']; ?></div>
    <label>tecnologias</label>
    <input class="techs" type="text" name="techs" placeholder="tecnologias(por virgula)...">
    <br>

    <input class="btn-submit"  type="submit" name="submit" value="submit" 
					class="btn brand z-depth-0">
    </form>
</div>



</body>
</html>
 