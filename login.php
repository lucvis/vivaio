<?php
	# Inizializzo la sessione, importo e inizializzo la classe.
	session_start();
	include_once 'guich_class.php';
	$try = new guich();
	$conserver = new DATA_Class();
	$conserver->connessione();
	
	# Verifico se un utente è già loggato, se lo è viene rimandato direttamente alla pagina principale.
	if ($try->verifica_sessione())
	{
	  header("location:index.php");
	}
	
	# Effettuo il login alla pressione del bottone dedicato.	
	if (isset($_POST['logga'])) { 

		$login = $try->verifica_login(htmlentities($_POST['nick_o_mail'], ENT_QUOTES), htmlentities($_POST['pwd'], ENT_QUOTES));
  
		if ($login) {
			header("location:index.php");
		}else{
			echo "<script>alert('I dati indicati non sono corretti.')</script>";
	  	}
	}
?>

<html>
	<head>
		<title>Pagina per l'autenticazione</title>
		<!-- Importazione del font e del css -->
		<link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
		<link href="css/login.css" type="text/css" rel="STYLESHEET">
	</head>
	<body>
		<!-- Header pagina -->
		<div class="header">
			<h1 class="guichb">Guich's Blog</h1>	
			<form class="form" method="post" action="reg.php">
				<input type='submit' id='reg' value='Registrati!'>
			</form>
		</div>
		<div class="wrapper">
			<p>Effettua il login!</p>
			<!-- Form per il login -->
			<form class="form" method="post">
				<input type='text' class='nick' name='nick_o_mail' placeholder='Nick or Mail' required/>
				<input type='password' class='pwd' name='pwd' placeholder='Password' required/>
				<input type="submit" class="login-button" name="logga" value='LOGIN!'></input>
			</form>
		</div>
	</body>
</html>