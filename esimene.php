<?php
	//muutujad
	$myName = "Rauno";
	$myFamilyName = "Piibor";
	
	//hindan päeva osa (võrdlemine < > <= >=  ==  != )
	$hourNow = date("H");
	$partOfDay = "";
	if($hourNow < 8){
		$partOfDay = "Varajane hommik";
		
	}
	if($hourNow >= 8 and $hourNow <16){
		$partOfDay = "Koolipäev";
		
	}
	if($hourNow >16){
		$partOfDay = "Vaba aeg";
	}
		
	//echo $partOfDay;
	?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title> Rauno Piibor progemise asjad</title>

</head>
<body>
	<h1><?php echo $myName ." ".$myFamilyName;?></h1>
	<p>See veebileht on loodud veebiprogrammeerimise kursusel ning ei sisalda mingisugust tõsiseltvõetavat sisu. jne</p>	
	<?php
		echo "<p>Algas PHP õppimine.</p>";
		echo "<p>Täna on ";
		echo date("d.m.Y") .", kell oli lehe avamise hetkel " . date("H:i:s");
		echo", Hetkel on " .$partOfDay .".</p>";
		
	?>
</body>
</html>