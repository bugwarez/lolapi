<?php
function get_mastery($sum_id,$country_code,$api_key){
    $url_mastery = 'https://'.$country_code.'.api.riotgames.com/lol/champion-mastery/v4/champion-masteries/by-summoner/'. $sum_id .'?api_key='. $api_key;
    $url_m_encoded = file_get_contents($url_mastery);
    $json_m = json_decode($url_m_encoded);
    $all_champs = count($json_m);
    $count = 0;
    echo "<b><br><h3>Champion Mastery</b></h3><br>";
    $champs_url = 'https://'.$country_code.'.api.riotgames.com/lol/champion-mastery/v4/champion-masteries/by-summoner/'. $sum_id .'?api_key='. $api_key;
    $champ_name = file_get_contents($champs_url);
    $champ = json_decode($champ_name);
    while($count != $all_champs){
        $champ_now = $champ->{'data'}->{$count}->{'name'};
        if($json_m[$count]->{'chestGranted'} == true){
            $chest_return = 'Already Acquired';
        }else{$chest_return = "Not Acquired";}
        echo "
            <br>Champion ID: <b>" . $json_m[$count]->{'championId'}." </b>Name<b alt='teste'> ".$champ_now.
            "</b> Pontuaçao:<b alt='123 x 3'>". $json_m[$count]->{'championPoints'}.
            "</b> Level:<b>". $json_m[$count]->{'championLevel'}.
            "</b> Chest:<b>". $chest_return;
        $count++;
    }
    echo "<br><b>TOTAL CHAMPS:".$all_champs."</b>";
}
function queue_list($sum_id,$country_code,$api_key){
    $url_list_q = 'https://'.$country_code.'.api.riotgames.com/lol/league/v4/entries/by-summoner/'.$sum_id.'?api_key='.$api_key;
    $url_q_encoded = file_get_contents($url_list_q);
    $json_q = json_decode($url_q_encoded);
    $all_queued = count($json_q[0]->{'entries'}) - 1;
    echo "<fieldset><legend><b><h3>Queue info</h3></b></legend><b><br><h3>Players in the league</b></h3><br>";
    while($all_queued != 0){
        echo "</b><br><h4>Player Name:<b></h4>" . $json_q[0]->{'entries'}[$all_queued]->{'playerOrTeamName'};
        echo "</b><br>Pdl's:<b>" . $json_q[0]->{'entries'}[$all_queued]->{'leaguePoints'};
        echo "</b><br>Wins:<b>" . $json_q[0]->{'entries'}[$all_queued]->{'wins'};
        echo "</b><br>Loses:<b>" . $json_q[0]->{'entries'}[$all_queued]->{'losses'};
        echo "</b><br>Rank - Division:<b> " . $json_q[0]->{'tier'} . $json_q[0]->{'entries'}[$all_queued]->{'rank'};
        $all_queued--;
    }
}