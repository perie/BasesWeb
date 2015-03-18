<?php
	unset($_SESSION["message"]);
	$idArticle = 0;
	
	if(isset($_GET["id"]))
	{
		$idArticle = $_GET["id"];
	}
	
	// SI ON A CLIQUER SUR ANNULER ALOR ON BASCULE VERS LA LISTE
	if (isset($_POST["cancelArticle"]))
	{
		header("location: ?page=article");
	}
	
	if (isset($_POST["submitArticle"]))
	{
		if (isset($_POST["title"]) && isset($_POST["content"]))
		{
			// ON PREPARE LA REQUETE AVEC DES CLEF (:nomclef)
			switch($idArticle)
			{
				case 0 :
					$sql = "INSERT INTO article (`title`, `content`) VALUES (:title, :content)";
					break;
				default :
					$sql = "UPDATE article SET `title`=:title, `content`=:content WHERE id=".$idArticle;
					break;
			}
			
			// ON DEMANDE A PDO DE PREPARER LA REQUETE
			$statement = $db->prepare($sql);
			$statement->bindParam(":title", $_POST["title"]);
			$statement->bindParam(":content", $_POST["content"]);
			
			$result 	= $statement->execute();
			echo $sql;

			if ($result == 0)
			{
				$_SESSION["message"] = setMsg(4001,"danger","Une erreur est survenue lors de la tentative d'ajout d'article dans la base de données.<pre>".print_r($db->errorInfo(),true)."</pre>", "Erreur");
				header("location: ?page=resultat");
			}
			else
			{
				header("location: ?page=article");
			}
		}
	}
	
	
	
	echo "\$idArticle=".$idArticle;
	
	$sql = "SELECT * FROM article WHERE id=".$idArticle;
	$statement = $db->query($sql);
	$article = $statement->fetch();
		
	$tabFIELD	= array(
	"id"=>array("type"=>($idArticle>0 ? "number" : "hidden"), "value"=>$article["id"], "label"=>"Identifiant de l'enregistrement :"),
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
		foreach($tabFIELD as $key=>$field)
		{
			echo "<p>";
			switch ($field["type"])
			{
				/*case "number" :
					echo "<label>".$field["label"]."<br><input type=\"text\" name=\"".$key."\" value=\"".$field["value"]."\" disabled></label>";
					break;
				*/
				case "text" :
					echo "<label>".$field["label"]."<br><input type=\"text\" name=\"".$key."\" value=\"".$field["value"]."\" size=\"100\"></label>";
					break;
				case "textarea" :
					echo "<label>".$field["label"]."<br><textarea rows=\"10\" cols=\"100\" name=\"".$key."\">".$field["value"]."</textarea></label>";
					break;
				
				case "hidden" :
					echo "<br><input type=\"".$field["type"]."\" name=\"".$key."\" value=\"".$field["value"]."\">";
					break;
					
					
				default:
					echo "<label>".$field["label"]."<br><input type=\"".$field["type"]."\" name=\"".$key."\" value=\"".$field["value"]."\" disabled></label>";
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