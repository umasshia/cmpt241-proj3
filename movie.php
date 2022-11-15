<!DOCTYPE html>

<html lang = "en-US">
	<head>
		<title>Rancid Tomatoes</title>
		<meta charset="utf-8" />
		<link href="movie.css" type="text/css" rel="stylesheet" />
		<link rel="icon" type="image/gif" href="rotten.gif" />
	</head>
	<?php
	$ratingpic = "";
	$ratingalt = "";
	$movie =   $_GET["film"];
	$infofile = file_get_contents("$movie/info.txt");
	$overviewfile = file_get_contents("$movie/overview.txt");
	$info = explode("\n", $infofile);
	$overview = explode("\n", $overviewfile);
	$reviews = glob("$movie/review*.txt"); 
	
	if (intval($info[2]) < 60) {
		$ratingpic = "rottenbig.png";
		$ratingalt = "Rotten";
	}
	else {
		$ratingpic = "freshbig.png";
		$ratingalt = "Fresh";
	}
	
	function writeh1($info) {
		echo $info[0] , " (" , trim($info[1]), ")";
	}
	
	function writeoverview($overviewfile, $overview) {
		echo "<dl>";
		for($i = 0; $i < sizeof($overview); $i++){  
		$line = $overview[$i];
 		$separatedline = explode(":", $line, 2);
 		echo "<dt>", $separatedline[0], "</dt>";
 		echo "<dd>", $separatedline[1],  "</dd>";
 	}
 
 	echo "</dl>";
	}
	
	function writereview ($reviews) {
		for($i = 0; $i < sizeof($reviews); $i++){
			$review = explode("\n", file_get_contents($reviews[$i]));
			$review[1] = strtolower($review[1]);
			echo 
			"<p class = 'review'>
				<img src='$review[1].gif' alt='$review[1]' /> 
				<q>$review[0]</q>
			</p>
			<p class='reviewer'>
				<img src='critic.gif' alt='Critic'/>
				$review[2]<br />
				$review[3]
			</p>";
		
			if($i == ceil(sizeof($reviews)/2 - 1 )){
				echo 
					"</div>
					<div class='column2'>";
			}
		}
	}
	
	function pageindex($movie) {
		if($movie == 'mortalkombat')
			echo "(1-9) of 9";
		if($movie == 'princessbride')
			echo "(1-7) of 7";
		if($movie == 'tmnt')
			echo "(1-8) of 8";
		if($movie == 'tmnt2')
			echo "(1-11) of 11";
	}
	
	?>
	<body>
		<div class = "banner">
                <img src="banner.png" alt="Rancid Tomatoes" />
        </div>
		<h1>
			<?php writeh1($info); ?>
	    </h1>
		<div class = "content">
			<div class = "top">
				<img class = "top" src = "<?php echo $ratingpic; ?>" alt = "<?php echo $ratingalt; ?>" />	
				<?=$info[2]?>%			
			</div>
			<div class = "overview">
				<img src="<?=$movie ?>/overview.png" alt="general overview" />
				<?php writeoverview($overviewfile, $overview); ?>
			</div>
				<div class = "column1">
				<?php writereview($reviews); ?>
				</div>
				<p class = "pageindex"> <?php pageindex($movie); ?></p>
		</div>
		<div class = "validate">
			<a href="https://validator.w3.org/check?uri=https://turing.manhattan.edu/~gsamushia01/project3/movie.php"><img src="w3c-html.png" alt="Valid HTML5" /></a> <br />
			<a href="http://jigsaw.w3.org/css-validator/validator?uri=https://turing.manhattan.edu/~gsamushia01/project3/movie.css"><img src="w3c-css.png" alt="Valid CSS" /></a>
		</div>
	</body>