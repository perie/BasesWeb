<?php
	
	function displayMsg($field)
	{
		$returnMsg = "";
		
		if(isset($field))
		{
			if(isset($_SESSION["register"][$field]) && !empty($_SESSION["register"][$field]["message"]))
			{
				$returnMsg.="<div class=\"alert alert-".$_SESSION["register"][$field]["message"]["type"]." fade in\">"."<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>".$_SESSION["register"][$field]["message"]["lib"]."</div>";
			}
		}
		
		return $returnMsg;
	}
	
	function setMsg ($code, $type, $libele, $titre="")
	{
		switch ($type)
		{
			case "danger" :
				$soustitre = "Désolé, ";
				break;
				
			case "warning" :
				$soustitre = "Attention, ";
				break;
				
			case "success" :
				$soustitre = "Super, ";
				break;
				
			default :
				$soustitre = "";
				break;
		}
		return array("code"=>$code, "type"=>$type, "lib"=>"<strong>".$soustitre."</strong>".$libele, "titre"=>$titre);
	}

	function sessionRegisterGetValue($field)
	{
		if (isset($_SESSION["register"])&&(isset($_SESSION["register"][$field])))
		{
			return $_SESSION["register"][$field]["value"] ;
		}
		return "";
	}
	
	function premierMot($string, $limit, $type="mot")
	{
		switch ($type)
		{
			case "mot" :
				$tabMot		= explode(" ", $string);
				$occMot		= (count($tabMot)>$limit ? $limit : count($tabMot));
				$retour		= "";
				for($i=0;$i<$occMot;$i++)
				{
					$retour .= ($retour == "" ? "" : " ").$tabMot[$i];
				}
				break;
				
			case "lettre" :
				$indice = $limit;
				while ($string[$indice] != " ")
				{
					$indice --;
				}
				$retour = substr($string, 0, $indice);
				
			default:
				break;
		}
		

		 return $retour;
	}
	
	function userSignUp ()
	{
		$_SESSION["register"] 	= array();
		$bError 				= false;
		$fieldDetails 			= array();
		$htmlListe 				= "";
		
		if(isset($_FILES) == 0)
		{
			$_SESSION["message"][] = setMsg(rand(0,5), "danger", "Le fichier est supérieur à la taille maximale autorisé");
		}

		// ON TEST SI ON A ENVOYER UNE PHOTO OU PAS
		switch ($_FILES['profil']['error'])
		{
				case UPLOAD_ERR_OK :
					// ON TESTE L'EXTENSION
					$imgName	= $_POST['pseudo'].".".strtolower(pathinfo($_FILES['profil']['name'], PATHINFO_EXTENSION));
					$uploadFile = UPLOAD_DIR_IMG. $imgName;

					echo $uploadFile;
					$tmp_name = $_FILES["profil"]["tmp_name"];
					
					move_uploaded_file($tmp_name, $uploadFile);
					
					$_SESSION["register"]["profil"] = array("name"=>"profil", "value"=>$imgName, "message"=>"");
					break;
				
				case UPLOAD_ERR_FORM_SIZE:
					$_SESSION["register"]["profil"] = array("name"=>"profil", "value"=>"", "message"=>
					setMsg(rand(0,5), "danger", "Le fichier est supérieur à la taille maximale autorisé"));
					break;
					
				case UPLOAD_ERR_NO_FILE :
					// ON AFFECTE UNE IMAGE PAR DEFAUT
					if (isset($_POST['civilite']) && $_POST['sex'] == "female")
					{
						$imgName = "user-female.png";
					}
					else
					{
						$imgName = "user-male.png";
					}
					
					$_SESSION["register"]["profil"] = array("name"=>"profil", "value"=>$imgName, "message"=>"");
					
					break;
					
		}

		foreach($_POST as $field => $value)
		{
			$htmlListe .= "\t<li><strong>".$field." : </strong>".$value."  </li>\n";
			
			$fieldDetails	= array ("name"=>$field, "value"=>$value, "message"=>"");
			$_SESSION[$field]=$value;
			
			// ON VERIFIE LE NOM
			if($field == "nom" && strlen(trim($value)) < 3)
			{
				$fieldDetails["message"] = setMsg(rand(0,5), "danger", "Le nom doit être renseigner et doit contenir au minimum 3 caractères");
				$bError = true;
			}
			
			// ON VERIFIE LE PRENOM
			if($field == "prenom" && strlen(trim($value)) < 3)
			{
				$fieldDetails["message"] = setMsg(rand(0,5), "danger", "Le prénom doit être renseigner et doit contenir au minimum 3 caractères");
				$bError = true;				
			}
			// ON VERIFIE LA DATE DE NAISSANCE
			if($field == "datenaissance" && strlen(trim($value)) < 3)
			{
				$fieldDetails["message"] = setMsg(rand(0,5), "danger", "Le prénom doit être renseigner et doit contenir au minimum 3 caractères");
				$bError = true;
			}
			
			// ON VERIFIE LE TELEPHONE
			if($field == "telephone")
			{
					// echo "<p>telephone sur ".strlen($value)." chiffres et commence par ".$value[0]."</p>";
					if (strlen($value) != 10 || $value[0] != "0")
					{
						$fieldDetails["message"] = setMsg(rand(0,5), "danger", "Votre numéro de téléphone n'est pas au bon format");
						$bError = true;
					}
			}
			
			$_SESSION["register"][$fieldDetails["name"]] = $fieldDetails;
		}
		return $bError;
	}