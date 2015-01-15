<?php
	/* Classe per la connessione al server */
	class DATA_Class {
		var $server;
		var $db;
		var $utente;
		var $pass;
		
		public function connessione(){
			$doc = simplexml_load_file("./vivaiodb.xml");
			$array_items = $doc->db;
			foreach($array_items as $db){    
				$this->server = $db->server;
				$this->db = $db->db;
				$this->utente = $db->utente;
				$this->pass = $db->pass;
			}
			
			# connessione al DBMS
			$connessione = mysql_connect($this->server, $this->utente, $this->pass) or die('Errore nella connessione: ' . mysql_error());
			# selezione del database
			mysql_select_db($this->db, $connessione) or die('Errore dal database: ' . mysql_error());
		} 
	}
	
	/* Classe per la registrazione e il login*/
	class guich{
		var $nick;
		var $pwd;
		var $email;
		var $nome;
		var $cognome;
		var $telefono;
		var $tipo;
	
		public function parser(){
			$doc = simplexml_load_file("./vivaiodb.xml");
			$array_items = $doc->guich;
			
			foreach($array_items as $guich){    
				$this->nick = $guich->nick;
				$this->pwd = $guich->pwd;
				$this->email = $guich->email;
				$this->telefono = $guich->telefono;
				$this->nome = $guich->nome;
				$this->cognome = $guich->cognome;
				$this->tipo = $guich->tipo;
			}
		}
		
		public function registra($cognome, $nome, $tipo, $telefono, $nick, $pwd, $email) 
		{
			# confronto degli input con i dati contenuti in tabella
			$query = mysql_query("SELECT IDCliente FROM clienti WHERE nick = '$nick' OR email = '$email'") or die('Errore: ' . mysql_error());
			$conta = mysql_num_rows($query);
			# se il confronto non genera corrispondenze..
			if ($conta == 0){
			  $risultato = mysql_query("INSERT INTO clienti(Cognome, Nome, Tipo, Telefono, Nick, Pwd, Email) 
			  						   VALUES ('$cognome', '$nome', '$tipo', '$telefono', '$nick', 'pwd', 'email)") or die('Errore: ' .mysql_error());
			  return $risultato;
			}else{
			  return FALSE;
			}
		}
		
		public function verifica_login($nick_o_mail, $pwd) {
			# Verifico se i dati immessi sono presenti nel db.
			$qry = "SELECT IDCliente FROM clienti WHERE (email = '$nick_o_mail' OR nick = '$nick_o_mail') and pwd = '$pwd'";
			$query = mysql_query($qry) or die('Errore: ' . mysql_error());
			
			$conta = mysql_num_rows($query);
			if ($conta == 1) {	
			  	$risultato = mysql_fetch_object($query);     
			  	$_SESSION['id_user'] = $risultato->IDCliente;
			  	return TRUE;
			}else{
				return FALSE;
			}
		}
		
		public function utente($IDCliente){
			if($_SESSION['IDCliente']=$IDCliente){
				# Stamo il nome dell'utente connesso.
				$query = mysql_query("SELECT nick FROM clienti WHERE IDCliente = $id_user") or die('Errore: ' . mysql_error());
				$risultato = mysql_fetch_object($query);
				echo $risultato->nick;
			}
		}
		
		public function verifica_sessione() {
			# Restituisco l'informazione della sessione se questa è stata inizializzata.
			if(isset($_SESSION['IDCliente'])){
			  return TRUE;
			}else{
			  return FALSE;
			}
		}
		
		public function esci() { 
			# Esco dalla sessione e la distruggo.
			$_SESSION['IDCliente'] = null;
			session_destroy();	
		}
}
?>