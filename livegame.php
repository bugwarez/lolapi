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
	<link rel="stylesheet" type="text/css" href="./resources/css/style2.css">
</head>
<body>
<nav>
  <ul>
    <li>
      <a class="link" href="index.php">Home</a>
    </li>
    <li>
      <a class="link" href="livegame.php">Live Game</a>
    </li>
    <li>
      <a class="link" href="champions.php">Champion Stats</a>
    </li>
    <li>
      <a class="link" href="functions.php">Func Deneme</a>
    </li>
  </ul>
</nav>
</body>
</html>
<?php 
	$api_key = "RGAPI-b3904630-9f15-4882-a228-caa44ac6b7ee";
	$sum_id = "frqwRHHy65N6ze5HEVscSFRaD3mQdfyrs_2jWnt8xG7L2A";
	$country_code = "tr1";
        /*$url_mastery = 'https://'.$country_code.'.api.riotgames.com/lol/champion-mastery/v4/champion-masteries/by-summoner/'. $sum_id .'?api_key='. $api_key;
        $url_m_encoded = file_get_contents($url_mastery);
        $json_m = json_decode($url_m_encoded);
        $all_champs = count($json_m); 
        $count = 0;*/
        function live_gamedata($sum_id,$country_code,$api_key){
        $live_game = file_get_contents('https://'.$country_code.'.api.riotgames.com/lol/match/v4/matchlists/by-account/'.$sum_id.'?api_key='.$api_key);
        $json_status = file_get_contents($live_game);
        $json2 = json_decode($json_status);
        echo "<br>Rank:<b>" . $json2[0]->{'lane'} . "</b>";
        echo $live_game;
        //fonksiyonları değiştirip dene canlı oyun için
        }
?>