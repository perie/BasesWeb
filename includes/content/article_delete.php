<?php
	unset($_SESSION["message"]);
	$idArticle = 0;
		
	if (isset($_GET["id"]))
	{
		$idArticle 	= (int)$_GET["id"];
	}
	
		// SI ON A CLIQUER SUR ANNULER ALOR ON BASCULE VERS LA LISTE
	if (isset($_POST["cancelDelete"]))
	{
		header("location: ?page=article");
	}
	
	if (isset($_POST["DeleteArticle"]))
	{
		$sql = "DELETE FROM article WHERE id=".$idArticle;
		
		// ON DEMANDE A PDO DE PREPARER LA REQUETE
		$result = $db->exec($sql);
		//$result 	= $statement->execute();

		if ($result == 0)
		{
			$_SESSION["message"] = setMsg(4004,"danger", "Aucun enregistrement n'a pu être supprimer. L' article demandé n'a pas été trouvé.<br><br>Veuillez vérifier votre demande.","Suppression impossible");
			header("location: ?page=resultat");
			exit();
		}
		else
		{
			header("location: ?page=article");
			exit();
			/*
			$_SESSION["message"]=setMsg(0,"success", "L'article ".$idArticle." n'existe plus.", "L'article à bien été supprimé");
			header("location: ?page=resultat");
			*/
		}
	}
	
	$sql = "SELECT * FROM article WHERE id=".$idArticle;
	$statement = $db->query($sql);
	$article = $statement->fetch();
		
	$tabFIELD	= array(
	//"id"=>array("type"=>"hidden", "value"=>$article["id"], "label"=>"Identifiant de l'enregistrement :"),
	"title"=>array("type"=>"text", "value"=>$article["title"], "label"=>"Titre de l'article :"),
	"date"=>array("type"=>"text", "value"=>$article["date_creation"], "label"=>"date de publication :"),
	"content"=>array("type"=>"textarea", "value"=>$article["content"], "label"=>"contenu"));
?>

<div id="main-content">
	<div class="filAriane">
		<ul>
			<li><a href="?page=article">Liste des articles</a></li>
			<li><?php echo "Nouvel article"; ?></li>
		</ul>
	</div>

	<form action="" Method="POST">	
	<?php 
	if (!isset($_SESSION["message"])) 
	{
			echo "<p>".
			"<h1>Suppression d'article</h1>".
			"Vous êtes sûr le point de supprimer l'article suivant :".
			"</p>";
		foreach($tabFIELD as $key=>$field)
		{
		echo "<p>";
			echo "<strong>".$field["label"]."</strong><br>".$field["value"];
			
			echo "</p>";
		}
	}
	?>
		<input type="submit" name="DeleteArticle" value="Valider"> &nbsp; <input type="submit" name="cancelDelete" value="Annuler">
	</form>
</div>