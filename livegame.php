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