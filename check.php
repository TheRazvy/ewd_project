<?php
	session_start(); 

	
	if(!isset($_SESSION['id'])){ // verifica daca este setata sesiunea (daca utilizatorul este conectat) daca utilizatorul nu este conectat va fi redirectionat catre index.php
		header("Location: index.php"); //redirectionare
		exit(""); // o metoda simpla pentru a spori securitatea. Opreste continuarea executiei php cand este executata.
		}
	
	
	?>