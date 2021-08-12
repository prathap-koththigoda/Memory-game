<?php 

// !!!!!!!!!!!!!!!!!! ORDNER IN htdocs Ablegen !!!!!!!!!!!!!!!!!!!!!!!

function getArrCards(){					// Daten werden vom Ordner geholt und die darin entsprechenden Dateien werden in einem Array gespeichert.
	
	$path = dirname(__FILE__)."/images/front/";
	
	$arrImages = scandir($path);
	$arrCars = array();
	foreach($arrImages as $image){
		
		if($image == "." || $image == "..") // Wenn die Bilder ungleich sind wird das Spiel weitergeführt.
			continue;
		
		$info = pathinfo($image);
		
		$filename = $info["basename"];
		$name = $info["filename"];
		
		$arrCard  = array();
		$arrCard["name"] = $name;
		$arrCard["filename"] = $filename;
		$arrCard["url"] = "images/front/{$filename}"; //pfad zum Ordner und Dateien
		
		$arrCars[] = $arrCard;
		$arrCars[] = $arrCard;
		
	}
	
	shuffle($arrCars); //Karten werden gemischt 
		
	return($arrCars); // und zurückgegeben
}

/**
 * CSS wird in eine funktion erstellt und später in php eingefügt.
 * plus gesamtes CSS wird hier definiert. Textposition, farbe, abstände, Rahmen etc.
 * <!-- Rückseite der Karten wird bei Zeile 95 definiert. -->
 */
function putCss(){
	
	?>
form {
	text-align:center;
}

	h1 {
		margin-top:30px;
		color:00b5fa;
		text-align:center;
		border-color:white;
		margin-left:15px;
		margin-right:15px;
		font-size:35px;
		text-shadow: 4px 4px darkblue;
	}

	.button:hover {
		background-color:lightgreen;
		
	}

	form input {
		background-color:red;
		text-align:center;
		font-weight:bold;
		font-size:150%;
		border-radius:20px;
		box-shadow: 4px 4px;
	
		
	}

	body {
		background-color:black;
		
	}

	html {
		margin-left:11cm;
		margin-right:11cm;
	}


	.field{
		background-color:black;
		padding:10px;
		min-height:150px;
		min-width:150px;
		padding-left:29px;
	}
	
	.card{
		width:100px;
		height:100px;
		float:left;
		float:center;
		background-color:white;
		margin:20px;
		border:4px solid gray;
		position:relative;
		
	}
	
	.card.ok{
		border-color:lightgreen;
	}
	
	.card .back,
	.card .front{
		width:100%;
		height:100%;
		background-image:url('images/back/Back_5.jpg');
		background-size:cover;
		position:absolute;						
		xbackground-color:red;
		display:block;
		cursor:pointer;
	}
	
	.card .front{
		display:none;
	}
	
	.card.show-front .front{
		display:block;
	}
	
	.card.show-front .back{
		display:none;
	}
	
	
	<?php 
}

/**
 * Spiel wird ins HTML eingefügt
 */
function putGame(){
	
	$arrCards = getArrCards();
	
	if(isset($_POST['Neustart'])) {
		
	}
	?>


	<html>

	<head>
		<style> /* CSS wird hier ins HTML mit einer Funktion eingefügt. */
			<?php putCss()?> 
		</style>
	
	<script
  src="https://code.jquery.com/jquery-1.12.4.min.js"
  integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
  crossorigin="anonymous"></script>
		
		<script src="js/script.js"></script> <!--Java Script Code wird ins Html verlinkt. -->
	
	</head>
	
	<body style="border: 4px dotted #ff00ee;">
	
	<h1 style="border: 4px dotted lightgreen;">Willkommen zu unserem Memory Spiel</h1>;

	<form method="post"> <!--Neustart Button wird hier erstellt. -->
        <input class="button" type="submit" name="Neustart"
                value="Neustart"/>
        
    </form>

		<section>
		<div class="field">
			
			<?php foreach($arrCards as $card):?>
			
			<div class="card card-name-<?php echo $card["name"]?>" data-name="<?php echo $card["name"]?>">
				
				<div class="front" style="background-image:url('<?php echo $card["url"]?>')"></div>
				<div class="back"></div>
			</div>
							
			<?php endforeach?>
			
			<div style="clear:both;"></div>				
			
		</div>
		</section>

	</body>
	</html>
	
	<?php 
	
}


putGame();
