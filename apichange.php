<!DOCTYPE html>
<html class=" js csstransforms3d csstransitions">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="UTF-8">
	<meta name="viewport" content="initial-scale=1.0,width=device-width">
	<title>EloCloud Finder</title>
	<script async="" src="./resources/img/cloud.png"></script>
	<link rel="icon" type="image/png" sizes="32x32" href="resources/img/icloud.png">
	<link rel="shortcut icon" href="favicon.png">
	<link rel="stylesheet" type="text/css" href="./resources/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="./resources/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="./resources/css/style.css">

</head>
		<div class="container">
			<!--MENU-->
			<nav class="menu">
				<ul class="list-inline">
					<center><li><a href="index.php">Home</a></li></center>

				</ul>
	  </nav>
	  </div>
<?php
//--------------------------------//
$senhaverify = "batunahan123";     // <- Senha para login
//--------------------------------//

if(isset($_POST['newkey']))
{
    if($_POST['newkey'] != ""){
        fwrite(fopen("resources/api_key_007.txt", "w"), $_POST['newkey']);
        echo "<center><h2>Yeni Key:".$_POST['newkey']."<br>Api Anahtarı Başarıyla Değiştirildi";
    }
}

session_start(); //Para qualquer função session é preciso ter ela inciada

	if(!empty($_POST)){
		$senha = $_POST['senha'];

		if($senha == $senhaverify){
			$_SESSION["login"] = "sim"; //Apenas um exemplo, se existir a sessao e exibir $_SESSION['login'] por um echo, irá retornar "sim"
		}

	}
	if(isset($_GET['acao'])){
		if($_GET['acao'] == "sair"){
			session_destroy();
			header("Location: ApiChange.php"); //Redireciona a pagina para o estado inicial sem a url com get, caso contrario ele vai logar e sair na mesma hora
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>ChangeApi</title>
		<meta charset="utf-8">
	</head>
	<center><body><li id="view">
</li><img src="resources/img/riot.png"><br><br>
		<?php if(isset($_SESSION["login"])){ ?> <!-- Verifica se existe uma session login, no caso nao esta verificando se a sessao login é "sim" -->

			<h1>Api Anahtarını Güncelle</h1>
            <fieldset><legend>Key:</legend>
            <form method='post'><input type='text' name='newkey' placeholder='RGAPI-22961d8e-95ec-492f-934c-e106281bcc44'><input type='submit' value='Aktif Et'></form>
                <form method="post">
        
    </form>
			<a href="?acao=sair">Çıkış</a>

		<?php }else{ ?>
<h2>Password<br><br></h2>
		<form method="post">
        
			<input type="password" name="senha" placeholder="Digite a senha">
			<input type="submit" value="Logar-se">
		</form>

		<?php } ?>

	</body>
</html>