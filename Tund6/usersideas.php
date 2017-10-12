<?php
	require("functions.php");
	$notice = " ";
	//kas pole sisse loginud
	if(!isset($_SESSION["userId"])){
		header("Location: login.php");
		exit();
	}
	
	//väljalogimine
	if(isset($_GET["logout"])){
		session_destroy();
		header("Location: login.php");
		exit();
	}
	
	if(isset($_POST["ideaButton"])){
		
		if(isset($_POST["idea"]) and !empty($_POST["idea"])){
			//echo $_POST["ideaColor"];
			$notice = saveIdea($_POST["idea"],$_POST["ideaColor"]);
		}
	}
	//See on siin ainult minu tehtud kodutöö jaoks!!!
	require("../../usersinfotable.php");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Andrus Rinde veebiprogrammeerimine</title>
</head>
<body>
	<h1>Foto</h1>
	<p>See leht on loodud õppetöö raames ning ei sisalda mingit tõsiseltvõetavat sisu.</p>
	<p><a href="?logout=1">Logi välja!</a></p>
	<p><a href="main.php">Pealeht</a></p>
	<hr>
	<h2>Lisa oma hea mõte</h2>
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER ["PHP_SELF"]); ?>">
		<label>Hea mõte: </label>
		<input name="idea" type="text">
		<br>
		<label>Mõttega seonduv värv: </label>
		<input name="ideaColor" type="color">
		<br>
		<input name="ideaButton" type="submit" value="Salvesta mõte!">
		<span><?php echo $notice; ?></span>
		
	</form>
	<hr>
	<div style="width: 40%">
		<?php echo listIdeas(); ?>
	</div>
	
</body>
</html>
