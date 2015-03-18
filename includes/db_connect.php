<?php

	// ON PREPARE LA CONNSION
	$dsn		= "mysql:dbname=".$db_database.";host=".$db_server.";charset=utf8";
	
	// CONNEXION A LA BASE DE DONNEES EN OBJET PDO
	$db 		= new PDO ($dsn, $db_user, $db_pwd);
	// ON DEMANDE UN RETOUR EN TABLEAU ASSOCIATIF
	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
	
	// ON DETRUIT LES VARIABLES DE CONNEXION.
	unset($db_server, $db_database, $db_user, $db_pwd, $dsn);