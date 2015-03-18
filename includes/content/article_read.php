<?php
	unset($_SESSION["message"]);
	
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
			<li><?php echo $article["title"]?></li>
		</ul>
	</div>
	
	<?php 
	if (!isset($_SESSION["message"])) 
	{
		echo "<article>".
				"<h1>".$article["title"]."</h1>".
				"<h4>Consultation de l'article ".$article["id"]." publié le ".$article["date_creation"]."</h3>".
				"<p>".nl2br($article["content"]).
				"</p>";
	}
	else
	{
		echo "<br><br><div class=\"alert alert-".$_SESSION["message"]["type"]." fade in\">"."<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>".nl2br($_SESSION["message"]["lib"])."</div>";
	}
	?>
	<article>
		
</div>