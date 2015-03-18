<?php 
	if(isset($_POST["userSignUpSubmit"])) 
	{
		if (userSignUp() == true)
		{
			$_SESSION["message"]= array(
			"titre"=>"Inscription validé", 
			"type"=>"success", 
			"lib"=>"Votre inscription à été valider, un email vous à été envoyer à l'adresse suivante : <br>
			<strong>".sessionRegisterGetValue("email")."</strong>.
			<br><br>Afin de pouvoir poursuivre sur notre site, vous devez valider votre adresse email à partir du lien de confirmation présent dans l'email qui vous à été envoyé.");
			header("location: ?page=resultat");
		}
	}
	else
	{
		unset($_SESSION["register"]);
	}
	
	//echo "<pre>".print_r($_SESSION, true)."</pre>";
?>
<div id="main-content">
	<p>
		<form action="" name="form" id="createaccount" method="post" target="_blank" enctype="multipart/form-data" onsubmit="return formValidation()">
			
			
			<fieldset style="padding:10px;">
					<legend>Etat civil</legend>
					
					<label>Civilité : 
						<select name="civilite" id="title">
							<option value="Monsieur" 
								<?php echo (isset($_SESSION["civilite"]) ? (sessionRegisterGetValue("civilite")=="Monsieur" ? "selected" : "") : "selected") ?>onselect="document.forms.sex.value.male.checked">M.</option>
							<option value="Madame" 
								<?php echo (isset($_SESSION["civilite"]) ? (sessionRegisterGetValue("civilite")=="Madame" ? "selected" : "") : "selected") ?>
								onselect="forms.sex.value=female;">Mme</option>
							<option value="Mademoiselle" 
								<?php echo (isset($_SESSION["civilite"]) ? (sessionRegisterGetValue("civilite")=="Mademoiselle" ? "selected" : "") : "selected") ?>
								onselect="forms.sex.value=female;">Mlle</option>
						</select>
					</label>
					Sexe : 
						<label><input type="radio" name="sex" value="male" 
						<?php echo (isset($_SESSION["sex"]) ? (sessionRegisterGetValue("sex")=="male" ? "checked" : "") : "checked") ?>>Homme&nbsp;</label>
						<label><input type="radio" name="sex" value="female" 
						<?php echo (isset($_SESSION["sex"]) ? (sessionRegisterGetValue("sex")=="female" ? "checked" : "") : "checked") ?>>Femme&nbsp;</label>
					<br>
					
				<label for="name" class="">Votre nom : 
					<input type="text" name="nom" id="username" value="<?php echo ((isset($_SESSION["register"])&&(isset($_SESSION["register"]["nom"]))) ? $_SESSION["register"]["nom"]["value"] : "") ?>" placeholder="Votre nom de famille" title="Le nom est obligatoire" required></input>
				</label><?php echo displayMsg("nom"); ?><br>
				<label>Votre prénom : <input type="text" name="prenom" value="<?php echo sessionRegisterGetValue("prenom")?>"id="firstame" placeholder="Vos prénoms" required></input>
				</label><?php echo displayMsg("prenom"); ?><br>
				<label>Date de naissance : <input type="date" name="datenaissance" id="datepicker" size="10" pattern="^(0[1-9]|[12][0-9]|3[01])/(0[1-9]|1[012])/[0-9]{4}$" value="<?php echo sessionRegisterGetValue("datenaissance") ?>" placeholder="JJ/MM/AAAA" title="JJ/MM/AAAA" required></input>
				</label><?php echo displayMsg("datenaissance"); ?><br>
				
			</fieldset>
			
			<fieldset style="padding:10px;">
				<legend>Connexion</legend>
				<label>Login/Pseudo : <input type="text" name="pseudo" id="login" value="<?php echo sessionRegisterGetValue("pseudo")?>"placeholder="Votre pseudo pour le site" required></input>
				</label><?php echo displayMsg("pseudo"); ?><br>
				<label>
					Email : 
					<input type="text" name="email" id="email" placeholder="monemail@mondomaine.com" onchange="form.verifemail.pattern=this.value"  value="<?php echo sessionRegisterGetValue("email")?>"  required></input>
				</label><?php echo displayMsg("email"); ?><br>
				<label>
					Verification Email : 
					<input type="text" name="verifemail" id="emailcontrol" value="<?php echo sessionRegisterGetValue("verifemail") ?>"   required></input>
				</label><?php echo displayMsg("verifemail"); ?><br>
				<label>mot de passe: <input type="password" name="password" id="pass" placeholder="password" required></input>
				</label><?php echo displayMsg("password"); ?><br>
				<label>Vérification du mot de passe: <input type="password" name="verifpassword" id="passcontrol" required></input>
				</label><?php echo displayMsg("verifpassword"); ?><br>
				
			</fieldset>
			
			<fieldset style="padding:10px;">
			
				<legend>Informations personnelles</legend>
				
				<label>Telephone : <input type="tel" name="telephone" id="phone" placeholder="9999999999" pattern="^((\+\d{1,3}(-|)?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" value="<?php echo sessionRegisterGetValue("telephone") ?>"></input>
				</label><?php echo displayMsg("telephone"); ?><br>
				<label>Url site : <input type="url" name="siteweb" id="urlsite" value="<?php echo sessionRegisterGetValue("siteweb") ?>" placeholder="http://www.monsite.com"></input></label><br>
				<label>Présentation : <textarea name="presentation" value="<?php echo sessionRegisterGetValue("presentation") ?>" placeholder="Préciser ici quelques informations vous concernant"></textarea></label><br>
				<table>
					<tr>
						<td>
							<?php echo "<img src=\"./img/".sessionRegisterGetValue("profil")."\" width=\"48px\"><br>"; ?>
						</td>
						<td>
							<label>
								<!-- MAX_FILE_SIZE doit précéder le champ input de type file -->
								<input type="hidden" name="MAX_FILE_SIZE" value="262144000" />
								Photo de profil : <input type="file" name="profil" />
							</label><br>
						</td>
					</tr>
				</table>
			</fieldset>				
			
			<label><input type="checkbox" name="newsletter" checked="1" value="<?php echo (isset($_SESSION["newsletter"]) ? $_SESSION["newsletter"] : "") ?>">Je souhaite m'abonner à la newsletter.</label><br>
			
			<input type="submit" name="userSignUpSubmit" value="valider">
		</form>
	</p>
</div>