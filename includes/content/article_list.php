<?php
	unset($_SESSION["message"]);
	// ON CONSTRUIT LA REQUETE
	$sql = "SELECT * FROM article";

	// ON EXECUTE UNE REQUETE VIA PDO
	$statement = $db->query($sql);
	
	// ON RECUPERE LE RESULTAT SOUS FORME DE TABLEAU.
	if ($tabArticle = $statement->fetchall())
	{
	
	}
	else
	{
		$_SESSION["message"]=setMsg(4004,"danger", "Attention, vous n'avez aucun article dans votre base de données.<br>Veuillez ajouter un article grâce au formulaire de création d'article'.","Aucun article n'est présent dans la base de données");
	}
?>

<div id="main-content">
	<h2>Liste des articles présent dans la base de données</h2>
	<p>Il y a <?php echo count($tabArticle);?> article(s) </p>
	<p><a href="?page=article_edit">Ajouter un nouvel article</a></p>
	<?php 
	if (!isset($_SESSION["message"])) 
	{
		echo "<table class=\"tabArticle\">";
		echo "
			<tr class=\"entete\">
				<td>ID</td>
				<td>TITRE</td>
				<td>DATE CREATION</td>
				<td>CONTENU</td>
				<td colspan=2>&nbsp;</td>
			</tr>
			";
		
		foreach($tabArticle as $article)
		{
			echo "<tr>".
					"<td>".$article["id"]."</td>".
					"<td><a href=?page=article_read&id=".$article["id"].">".$article["title"]."</a></td>".
					"<td>".$article["date_creation"]."</td>".
					"<td>".premierMot($article["content"],50, "lettre")." ...</td>".
					"<td><a href=?page=article_edit&id=".$article["id"]."><img src =\"./img/ico-edit.png\" height=\"24px\" title=\"Modifier\"></a></td>".
					"<td><a href=?page=article_delete&id=".$article["id"]."><img src=\"./img/ico-delete.png\" height=\"24px\" title=\"Supprimer\"></a></td>".
				"</tr>";
		}
		
		echo "</table>";
	}
	else
	{
		echo "<br><br><div class=\"alert alert-".$_SESSION["message"]["type"]." fade in\">"."<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>".nl2br($_SESSION["message"]["lib"])."</div>";
	}
	?>
	
		
</div>