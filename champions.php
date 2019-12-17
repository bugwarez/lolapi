<!DOCTYPE html>
<html class=" js csstransforms3d csstransitions">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="UTF-8">
	<meta name="viewport" content="initial-scale=1.0,width=device-width">
	<title>EloCloud Finder</title>
	<script async="" src="./resources/img/cloud.png"></script>
	<link rel="icon" type="image/png" sizes="32x32" href="resources/img/base-icons/bronze.png">
	<link rel="shortcut icon" href="favicon.png">
	<link rel="stylesheet" type="text/css" href="./resources/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="./resources/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="./resources/css/style.css">

</head>
		<div class="container">
			<!--MENU-->
		
			<nav>
  <ul>
    <li>
      <a href="index.php">Home</a>
    </li>
    <li>
      <a href="livegame.php">Live Game</a>
    </li>
    <li>
      <a href="champions.php">Champion Stats</a>
    </li>
    <li>
      <a href="#">Contact</a>
    </li>
  </ul>
</nav>
</div>
<body>
<?php 
	$api_key = "RGAPI-b3904630-9f15-4882-a228-caa44ac6b7ee";
	$sum_id = "frqwRHHy65N6ze5HEVscSFRaD3mQdfyrs_2jWnt8xG7L2A";
	$country_code = "tr1";
        $url_mastery = 'https://'.$country_code.'.api.riotgames.com/lol/champion-mastery/v4/champion-masteries/by-summoner/'. $sum_id .'?api_key='. $api_key;
        $url_m_encoded = file_get_contents($url_mastery);
        $json_m = json_decode($url_m_encoded);
        $all_champs = count($json_m); 
        $count = 0;
        echo "<b><br><h3>Champion Mastery</b></h3><br>";
        
        while($count != $all_champs){
        $champ_now = $champ->{'data'}->{$count}->{'championId'};
            if($json_m[$count]->{'chestGranted'} == 1){
                $chest_return = 'Zaten Kazanılmış';
            }else{$chest_return = "Kazanılmamış";}
            echo "
            <div class='masterydivcontainer'>
            <br><b>Champion ID: " . $json_m[$count]->{'championId'}.
            "</b> Skor:<b alt='123 x 3'>". $json_m[$count]->{'championPoints'}.
            "</b> Level:<b>". $json_m[$count]->{'championLevel'}.
            "</b> Tokens:<b>". $json_m[$count]->{'tokensEarned'}.
            "</b> Chest:<b>". $chest_return;
            "</div>".
            $count++; 
        }
        echo "
        <h1>Freeler</h1> 
        " 
        
        
?>