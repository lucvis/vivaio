<?php
	session_start();
	include_once'guich_class.php';
	$try = new guich();
	$try->parser();
	
	$conserver = new DATA_Class();
	$conserver->connessione();
	
	if ($try->verifica_sessione())
	{
		#redirect in caso di esito negativo
		header("location:index.php");
	}
	
	# chiamata al metodo per la registrazione
	if (isset($_POST['reg']))
	{ 
		$registrato = $try->registra($_POST['nick'], $_POST['pwd'], $_POST['email']);
	 
	 	# controllo sull'esito del metodo
	 	if ($registrato) {
		# notifica in caso di esito positivo
			echo "<script>alert('Registrazione conclusa, ora puoi effettuare il login!'); window.location='login.php';</script>";
			}else{
			# notifica in caso di esito negativo
			echo "<script>alert('Un utente utilizza alcuni dei dati da te inseriti, riprova con altri dati!')</script>";
		}
	}
?>

<html>
	<head>
		<title>Pagina per la registrazione</title>
		<!-- Importazione del font e del css -->
		<link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
		<link href="css/registration.css"  rel="STYLESHEET">
	</head>
	<body>
		<!-- Header pagina -->
		<div class="header">
			<h1 class="guichb">Registrati al Blog di Guich!</h1>
			<form class="form" method="post" action="index.php">
				<input type='submit' id='bestemmie' value='Login!'>
			</form>
		</div>
		<div class="reg">
			<p>Per registrare un'account mi servono alcune tue informazioni!</p>
			<!-- Form per la registrazione -->
			<form class="form" method="post">
				<?php
					# Visualizzo i campi di testo secondo il file xml di configurazione.
					if ($try->nick == 1){
						echo "<input type='text' class='nick' name='nick' placeholder='Nick' required/><br/>";
					}
					if ($try->pwd == 1){
						echo "<input type='password' class='pwd' name='pwd' placeholder='Password' required/><br/>";
					}
					if ($try->email == 1){
						echo "<input type='text' class='mail' name='email' placeholder='Email' required/><br/>";
					}
					
					if ($try->nome == 1){
						echo "<input type='text' class='nome' name='nome' placeholder='Nome' required/><br/>";
					}
					
					if ($try->cognome == 1){
						echo "<input type='text' class='cognome' name='cognome' placeholder='Cognome' required/><br/>";
					}
					
					if ($try->sesso == 1){
						echo "<input type='text' class='sesso' name='sesso' placeholder='Sesso' required/><br/>";
					}
					
					if ($try->datan == 1){
						echo "<input type='text' class='datan' name='datan' placeholder='Et&agrave' required/><br/>";
					}
					
					if ($try->reg == 1){
						echo "<input type='submit' name='reg' value='Registrati!'>";
					}
				?>
			</form>
		</div>
	</body>
</html>