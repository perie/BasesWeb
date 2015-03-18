<?php
	unset($_SESSION["message"]);
	
	// SI ON A CLIQUER SUR ANNULER ALOR ON BASCULE VERS LA LISTE
	if (isset($_POST["cancelArticle"]))
	{
		header("location: ?page=article");
	}
	if (isset($_POST["submitArticle"]))
	{
		header("location: ?page=article");
	}
	
	if (isset($_GET["id"]))
	{
		$idArticle 	= (int)$_GET["id"];
	}
	else
	{
		$idArticle	= -1;
	}
	
	// ON CONSTRUIT LA REQUETE
	$sql = "SELECT * FROM article WHERE id=".$idArticle;

	// ON EXECUTE UNE REQUETE VIA PDO
	$statement = $db->query($sql);
	
	// ON RECUPERE LE RESULTAT SOUS FORME DE TABLEAU.
	if ($article = $statement->fetch())
	{
		$tabFIELD	= array(
		"id"=>array("type"=>"number", "value"=>$article["id"], "label"=>"Identifiant de l'enregistrement :"),
		"title"=>array("type"=>"text", "value"=>$article["title"], "label"=>"Titre de l'article :"),
		"content"=>array("type"=>"textarea", "value"=>$article["content"], "label"=>"contenu"));

	}
	else
	{
		$_SESSION["message"]=setMsg(4004,"danger", "Attention, vous avez demandé l'article ".$idArticle."<br>Veuillez vérifier votre saisie.","L'article demandé n'existe pas");
	}
?>

<div id="main-content">
	<div class="filAriane">
		<ul>
			<li><a href="?page=article">Liste des articles</a></li>
			<li><?php echo $article["title"]." [Mode édition]"; ?></li>
		</ul>
	</div>

	<form action="" Method="POST">	
	<?php 
	if (!isset($_SESSION["message"])) 
	{
		foreach($tabFIELD as $key=>$field)
		{
			echo "<p>";
			switch ($field["type"])
			{
				case "number" :
					echo "<label>".$field["label"]."<br><input type=\"text\" name=\"".$key."\" value=\"".$field["value"]."\" disabled></label>";
					break;
				case "text" :
					echo "<label>".$field["label"]."<br><input type=\"text\" name=\"".$key."\" value=\"".$field["value"]."\" size=\"100\"></label>";
					break;
				case "textarea" :
					echo "<label>".$field["label"]."<br><textarea rows=\"10\" cols=\"100\" name=\"".$key."\">".$field["value"]."</textarea></label>";
					break;
					
					
				default:
					break;
			}
			echo "</p>";
		}
	}
	else
	{
		echo "<br><br><div class=\"alert alert-".$_SESSION["message"]["type"]." fade in\">"."<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>".nl2br($_SESSION["message"]["lib"])."</div>";
	}
	?>
		<input type="submit" name="submitArticle" value="Valider"> &nbsp; <input type="submit" name="cancelArticle" value="Annuler">
	</form>
		
</div>