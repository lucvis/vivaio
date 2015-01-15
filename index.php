<?php
	# Inizializzo la sessione, importo e inizializzo le classi.
	session_start();
	include_once 'vivaio_class.php';
	$try = new guich();
	$conserver = new DATA_Class();
	$conserver->connessione();

	if (isset($_POST['loggin'])){

		$login = $try->verifica_login($_POST['nick_o_mail'], $_POST['pwd']);

		if (!$login){
			echo "<script>alert('I dati indicati non sono corretti.')</script>";
		}
	}
?>

<html>
	<head>
		<title>Il Vivaio di Guich</title>
		<!-- Importazione del font e del css -->
		<link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
		<link href="css/index.css" type="text/css" rel="STYLESHEET">
		<script> 
			$(document).ready(function(){
				$(".mylogin").click(function () {
					var effect = 'slide';
					var options = { direction: ('up') };
					var duration = 850;

					$('.logind').toggle(effect, options, duration);
				});

				$(".myprod").click(function () {
					var effect = 'slide';
					var options = { direction: ('up') };
					var duration = 850;

					$('.prodotti').toggle(effect, options, duration);
				});
			});

			$(document).mouseup(function (e){
			    var prodotti = $(".prodotti");
			    var login = $(".logind");

			    if (!prodotti.is(e.target) && prodotti.has(e.target).length === 0){
			        var effect = 'slide';
					var options = { direction: ('up') };
					var duration = 850;

					prodotti.hide(effect, options, duration);
			    }

			    if (!login.is(e.target) && login.has(e.target).length === 0){
			        var effect = 'slide';
					var options = { direction: ('up') };
					var duration = 850;

					login.hide(effect, options, duration);
			    }
			});
		</script>
	</head>
	<body>
		<!-- Header pagina -->
		<div class="header">
			<h1 class="guichb">Il Vivaio di Guich</h1>
			
			<input type='submit' class='mylogin' name='mylogin' id='mylogin' value='Login!' >
			<input type='submit' class='myprod' name='myprod' id='myprod' value='I nostri Prodotti!' >
			
			<div class="logind">
				<p>Effettua il login!</p>
				<form class="form" method="post">
					<input type='text' class='nick' name='nick_o_mail' placeholder='Nick or Mail' required />
					<input type='password' class='pwd' name='pwd' placeholder='Password' required />
					<input type="submit" class="logga" name="loggin" value='LOGIN!'></input>
				</form>
			</div>

			<div class="prodotti">
				<p>I Nostri Prodotti</p>
				<form class="form" method="post">
				</form>
			</div>
		</div>
	</body>
</html>