<!DOCTYPE html>
<html>
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
<?php 
	$api_key = "RGAPI-41b61337-762f-4866-a6f5-ef1bce4cd7d3";
	$sum_id = "frqwRHHy65N6ze5HEVscSFRaD3mQdfyrs_2jWnt8xG7L2A";
	$country_code = "tr1";
  $champs_url = 'https://'.$country_code.'.api.riotgames.com/lol/static-data/v4/champions?locale=pt_BR&tags=info&dataById=true&api_key='.$api_key;
  $champ_name = file_get_contents($champs_url);
  $champ = json_decode($champ_name);
  while($count != $all_champs){
  $champ_now = $champ->{'data'}->{$count}->{'championId'};
      if($json_m[$count]->{'chestGranted'} == 1){
          $chest_return = 'Zaten Kazanılmış';
      }else{$chest_return = "Kazanılmamış";}
      echo "
      <br>Champion ID: <b>" . $json_m[$count]->{'championId'}." </b>İsim<b alt='teste'> ".$champ_now.
      "</b> Skor:<b alt='123 x 3'>". $json_m[$count]->{'championPoints'}.
      "</b> Seviye:<b>". $json_m[$count]->{'championLevel'}.
      "</b> Sandık:<b>". $chest_return;   
      $count++; 
  }
  ?>
  <?php
  echo"
    <div class='panel'>
            Champion: <b>" . $json_m[$count]->{'championId'}.
         "</div>".
         "
         <div class='panel'>
                 Points ID: <b>" . $json_m[$count]->{'championPoints'}.
              "</div>".
              "
    <div class='panel'>
            Level: <b>" . $json_m[$count]->{'championLevel'}.
         "</div>".
         "
         <div class='panel'>
                 Chest: <b>" . $chest_return;
              "</div>".
              "
              <div class='panel'>
                      Champion ID: <b>" . $json_m[$count]->{'championId'}.
                   "</div>"
                   ?>