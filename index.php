<?php
	// ON DECLARE NOTRE SESSION
	session_start();
		
	// ON EFFECTUE NOS INCLUSION
	require ("./includes/define.php");
	require ("./includes/db_connect.php");
	require ("./includes/functions.php");
	
	// echo "<pre>".print_r($_POST, true)."</pre>";
	 
	// ON RECUPERE LE NOM DE LA PAGE A VISITE
	if (isset($_GET["page"]))
	{
		$pageName = $_GET["page"];
	}

		
	// SELON LA PAGE DEMANDE.
	switch($pageName)
	{
		case "inscription" :
			$pageTitle	= "Formulaire d'inscription";
			$pageFile	= "content/form_log.php";
			break;
			
		case "resultat" :
			$pageTitle	= "Résultat de l'opération";
			$pageFile	= "content/resultat.php";
			break;

		case "article_read" :
			$pageTitle	= "Lecture d'article";
			$pageFile	= "content/article_read.php";
			break;		

		case "article_edit" :
			$pageTitle	= "Edition d'article";
			$pageFile	= "content/article_edit.php";
			break;		

		case "article_delete" :
			$pageTitle	= "Supression d'article";
			$pageFile	= "content/article_delete.php";
			break;		
			
		case "article" :
			$pageTitle	= "Liste d'article";
			$pageFile	= "content/article_list.php";
			break;
			
		case "home" :
		default :
			
			$pageTitle	= "Formulaire d'inscription";
			$pageFile	= "content/home.php";
			break;
	}
	
	// ON INCLUE LE HEADER.
	require ("./includes/blocs/head.php");
	include ("./includes/blocs/header.php");
	include ("./includes/".$pageFile);
	include ("./includes/blocs/footer.php");

	
	//print_r($_SESSION);
