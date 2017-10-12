<?php
	$database = "if17_piibraun1";
	require("../../../config.php");
	
	//Alustame sessiooni
	session_start();
	
	//Sisselogimise funktsioon
	function signIn($email, $password){
		$notice = "";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt =  $mysqli->prepare("SELECT id, email, password FROM vpusers WHERE email =?");
		$stmt->bind_param("s",$email);
		$stmt->bind_result($id, $emailFromDb, $passwordFromDb);
		$stmt->execute();
		
		//kontrollime kasutajat
		if($stmt->fetch()){
			$hash = hash("sha512", $password);
			if($hash == $passwordFromDb){
				$notice = "Kõik korras!Logisimegi sisse!";
				
				//Salvestame sessioonimuutujaid
				$_SESSION["userId"] = $id;
				$_SESSION["userEmail"] = $emailFromDb;
				
				//liigume pealehele
				header("Location: main.php");
				exit();
			}else{
				$notice = "Sisestasite vale salasõna!";
			}
		}else{
			$notice = "Sellist kasutajat (" .$email .") ei ole!";
		}
		return $notice;
	}
	
	//uue kasutaja andmebaasi lisamine
	function signUp($signupFirstName, $signupFamilyName, $signupBirthDate, $gender, $signupEmail, $signupPassword){
	//ühendus serveriga
		
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		//käsk serverile
		$stmt = $mysqli->prepare("INSERT INTO vpusers (firstname, lastname, birthday, gender, email, password) VALUES (?, ?, ?, ?, ?, ?)");
		echo $mysqli->error;
		//s - string ehk tekst
		//i - integer ehk täisarv
		//d - decimal, ujukomaarv
		$stmt->bind_param("sssiss", $signupFirstName, $signupFamilyName, $signupBirthDate, $gender, $signupEmail, $signupPassword);
		if($stmt->execute()){
			echo "Õnnestus!";
		} else {
			echo "Tekkis viga: " .$stmt->error;
		}
		$stmt->close();
		$mysqli->close();
	}
	//sisestuse kontrollimine
	
	
	//save idea funktsioonid
	function saveIdea($idea, $color){
		$notice = "";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("INSERT INTO vpusersideas (userid, idea, ideacolor) VALUES(?, ?, ?)");
		echo $mysqli->error;
		$stmt->bind_param("iss", $_SESSION["userId"], $idea, $color);
		if($stmt->execute()){
			$notice = "Mõte on salvestatud!";
		} else {
			$notice = "Salvestamisel tekkis viga: " .$stmt->error;
		}
		
		$stmt->close();
		$mysqli->close();
		return $notice;
	}
	function listIdeas(){
		$notice = "";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("SELECT idea, ideacolor FROM vpusersideas ORDER BY id DESC");
		echo $mysqli->error;
		$stmt->bind_result($idea, $color);
		$stmt->execute();
		
		while(€stmt->fetch()){
			//<p style="background-color: #ff5577">Hea mõte</p>
			$notice .= '<p style="background-color: ' .$color .'">' .$idea ."</p> \n";
		}
		
		stmt->close();
		$mysqli->close();
		return $notice;
	}
	
	function test_input($data){
			$data = trim($data);//Eemaldab lõpust tühiku, tab või muu sellise asja
			$data = stripslashes($data);//Eemaldab kaldkirja"\"
			$data = htmlspecialchars($data);//Eemaldab keelatud märgid
			return $data;
	}
	
	/*$x = 8;
	$y = 5;
	echo "Teine summa on: ".($x + $y);
	addValues();
	
	function addValues(){
		echo "Teine summa on: ".($GLOBALS["x"] + $GLOBALS["y"]);
		$a = 4;
		$b = 1;
		echo "Kolmas summa on:".($a + $b);
		
	}
	
	echo "Neljas summa on:".($a + $b); */
	
	
	?>