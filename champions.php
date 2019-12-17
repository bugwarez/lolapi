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
		<div class="container">
			<!--MENU-->
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
</div>
<?php 
	$api_key = "RGAPI-41b61337-762f-4866-a6f5-ef1bce4cd7d3";
	$sum_id = "frqwRHHy65N6ze5HEVscSFRaD3mQdfyrs_2jWnt8xG7L2A";
	$country_code = "tr1";
        $url_mastery = 'https://'.$country_code.'.api.riotgames.com/lol/champion-mastery/v4/champion-masteries/by-summoner/'. $sum_id .'?api_key='. $api_key;
        $url_m_encoded = file_get_contents($url_mastery);
        $json_m = json_decode($url_m_encoded);
        $all_champs = count($json_m); 
        $count = 0;
        echo "<b><br><h3>Champion Mastery</b></h3>";
        $champs_url = 'https://'.$country_code.'.api.riotgames.com/lol/static-data/v4/champions?locale=pt_BR&tags=info&dataById=true&api_key='.$api_key;
        $champ_name = file_get_contents($champs_url);
        $champ = json_decode($champ_name);
        while($count != $all_champs){
        $champ_now = $champ->{'data'}->{$count}->{'championId'};
            if($json_m[$count]->{'chestGranted'} == 1){
                $chest_return = 'Zaten Kazanılmış';
            }else{$chest_return = "Kazanılmamış";}
            if ($chest_return == 'Zaten Kazanılmış')
            {
              echo "<img src='https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcTmq-0Mi0wHkI2lCV5hFEm1a54GGN7uIQ3Qo2XWwB2G3N-i011C'width='32px'>";
            }
            else
            {
              echo "<img src='https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQiVcj-sie7yNUrhZacxR5GsEbvfeqw3D2WW1h5p_o6amD_6RSA'width='15px'>";
            }
            echo"
            
    <div class='panel'>
    <br>
    <b>Champion: <b>" . $json_m[$count]->{'championId'}.
         "</div>".
         "
         <div class='panel'>
                 Points: <b>" . $json_m[$count]->{'championPoints'}.
              "</div>".
              "
    <div class='panel'>
            Level: <b>" . $json_m[$count]->{'championLevel'}.
         "</div>".
         "
         <div class='panel'>
                 Chest: <b>" . $chest_return;
              "</div>".
              "<br>" .
              
                   $count++;
        }
//Şampiyon ismi ama bozuk"</b>İsim<b alt='teste'> ".$champ_now.
//deneme1

?>