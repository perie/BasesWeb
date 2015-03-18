<div id="main-content">
	<h1><?php echo $_SESSION["message"]["titre"];?></h1>
	<div class="result result-<?php echo $_SESSION["message"]["type"];?> fade in">
		<!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>--> 
		<?php echo $_SESSION["message"]["lib"];?>
	</div>
</div>