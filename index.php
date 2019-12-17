<!DOCTYPE html>
<html class=" js csstransforms3d csstransitions">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="UTF-8">
	<meta name="viewport" content="initial-scale=1.0,width=device-width">
	<title>Macr0LOL</title>
	<script async="" src="./resources/img/cloud.png"></script>
	<link rel="icon" type="image/png" sizes="32x32" href="resources/img/base-icons/bronze.png">
	<link rel="shortcut icon" href="favicon.png">
	<link rel="stylesheet" type="text/css" href="./resources/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="./resources/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="./resources/css/style.css">

</head>
<body>
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
	<div class="main post-page">
		<div class="container">
			<div class="row">
				<div class="col-md-9 col-sm-8">
					<!--POST-->
				  <div class="post">
						<div class="slider">
							<div class="content"><h3><img src="resources/img/max.png" width="75" heigth="75">LeagueOfStat</h3></div><center>
							<?php if(isset($_POST['sum'])){}else{echo '<img src="resources/img/cloud.png" width="200" heigth="200">';}?><BR><br><br>
<?php
    display_form();
    if(isset($_POST['get'])){
        $api_key = get_key();
        $country_code = "tr1";
        $headers_param = array($country_code,$api_key);
        $sum_id = get_sum_id($_POST['sum'],$headers_param[0],$headers_param[1]);
        load_page($country_code,$api_key,$headers_param,$sum_id);
    }

    //functions
    function get_key(){
        $file_open = file('resources/api_key_007.txt');
        foreach($file_open as $item){
            return $item;
        }
    }
    function display_form(){
		if(isset($_POST['get'])){
		}else{
			include_once("formulario.html");
		}
    }
    function load_page($country_code,$api_key,$headers_param,$sum_id){
        $header_use = check_header();
        $type_function = $header_use[0];
        $funcs = $header_use[1];
        $funcs = explode(";",$type_function);
        $count_funcs = count($funcs) -1;
        call_functions($count_funcs,$funcs,$country_code,$api_key,$sum_id);
    }
    function call_functions($count_funcs,$funcs,$country_code,$api_key,$sum_id){
        while($count_funcs != 0){
            $func_now = $funcs[$count_funcs];
            $count_funcs--;
            if($func_now == "sum"){
                info_summoner_name($_POST['sum'],$country_code,$api_key); 
            }
            if ($func_now == "ranked"){ 
                info_ranked($sum_id,$country_code,$api_key); 
            }
            if($func_now == "champs"){
                get_mastery($sum_id,$country_code,$api_key);
            }
            if($func_now == "queue"){
                queue_list($sum_id,$country_code,$api_key);
            }
        }
    }
    function check_header(){
        $type_function = "";
        $funcs = 0;
        if(isset($_POST['queue'])){
            $funcs++;
            $type_function = $type_function . ";queue";
        }
        if(isset($_POST['ranked'])){
            $funcs++;
            $type_function = $type_function.";ranked";
        }
        if(isset($_POST['status'])){
            $funcs++;
            $type_function = $type_function.";status";
        }
        if(isset($_POST['champs'])){
            $funcs++;
            $type_function = $type_function.";champs";
        }
        if($_POST['sum'] != ""){
            $funcs++;
            $type_function = $type_function.";sum";
        }
        $return = array($type_function,$funcs);
        return $return;
    }
	function get_elo($sum,$country_code,$api_key){
		$sum = str_replace(" ", "+",$sum);
        $url = 'https://'. $country_code . '.api.riotgames.com/lol/summoner/v4/summoners/by-name/'. $sum .'?api_key='.$api_key;
        $json = file_get_contents($url);
        $json = json_decode($json);
        $sum_id = $json->{'id'};
        $elos = get_summoner_tier($sum,$country_code,$api_key);
		$flex = explode(":FLEX:", $elos);
		$solo = explode(":SOLO:", $elos);
		$tt = explode(":TT:", $elos);
		
		$elo = explode(":",$solo[1]);
		$div = $elo[1];
		$elo = $elo[0];
		$division = $div;
		$elo = strtolower($elo);
		return $elo;
	}
	function get_icon($sum,$country_code,$api_key){
		$sum = str_replace(" ", "+",$sum);
        $url = 'https://'. $country_code . '.api.riotgames.com/lol/summoner/v4/summoners/by-name/'. $sum .'?api_key='.$api_key;
        $json = file_get_contents($url);
        $json = json_decode($json);
		$icon = $json->{'profileIconId'};
		return $icon;
	}
    function info_summoner_name($sum , $country_code , $api_key){
        $sum = str_replace(" ", "+",$sum);
        $url = 'https://'. $country_code . '.api.riotgames.com/lol/summoner/v4/summoners/by-name/'. $sum .'?api_key='.$api_key;
        $json = file_get_contents($url);
        $json = json_decode($json);
        $sum_id = $json->{'id'};
        $elos = get_summoner_tier($sum,$country_code,$api_key);
		$flex = explode(":FLEX:", $elos);
		$solo = explode(":SOLO:", $elos);
		$tt = explode(":TT:", $elos);
		
		$elo = explode(":",$solo[1]);
		$div = $elo[1];
		$elo = $elo[0];
		$division = strtolower($div);
		
		$elo1 = explode(":",$flex[1]);
		$div = $elo1[1];
		$division_f = $div;
		$elo_f = strtolower($elo1[0]);
		
		$elo1 = explode(":",$tt[1]);
		$div = $elo1[1];
		$elo_t = strtolower($elo1[0]);
		$division_t = ($div);
		
        echo "<A id='info' /></A><h1><b>SUMMONER INFO</b></h1>";
        echo "<fieldset><legend><h3><b>Tier rank Solo / Flex</b></h3></legend><img src='resources/img/tier-icons/". $elo ."_". $division .".png'>";
        echo "<img src='resources/img/tier-icons/". $elo_f ."_". $division_f .".png'><img src='resources/img/tier-icons/". $elo_t ."_". $division_t .".png'></fieldset><br><br>";
        echo "<fieldset><legend><b>INFO ACCOUNT</b></legend><br>Summoner:<b>" . $json->{'name'} . "</b>";
        echo "<br>Level:<b>" . $json->{'summonerLevel'} . "</b>" ."<br>";
        $show_now = file_get_contents('https://'.$country_code.'.api.riotgames.com/lol/champion-mastery/v4/scores/by-summoner/'.$sum_id.'?api_key='.$api_key);
        echo "Mastery Points:<b>" . $show_now . "</b></fieldset>";
		echo "Ranked Solo Duo - <b>" . $elo ." " . $division ."</b>";
		echo "<br>Ranked Flex 5x5 - <b>" . $elo_f ." " .$division_f ."</b>";
		echo "<br>Ranked 3x3 - <b>" . $elo_t ." " .$division_t ."</b>";
		if($elo_t == "")
		{
			echo "<b>Cant Reach Data or Null</b>";
		}
		echo"<br><br><legend></legend>";
    }
	function get_lvl($sum, $country_code,$api_key){
	    $sum = str_replace(" ", "+",$sum);
        $url = 'https://'. $country_code . '.api.riotgames.com/lol/summoner/v4/summoners/by-name/'. $sum .'?api_key='.$api_key;
        $json = file_get_contents($url);
        $json = json_decode($json);	
		$lvl = $json->{'summonerLevel'};
		return $lvl;
	}
    function get_summoner_tier($sum,$country_code,$api_key){
        $sum_id = get_sum_id($sum,$country_code,$api_key);
        $url_status = "https://". $country_code. ".api.riotgames.com/lol/league/v4/entries/by-summoner/". $sum_id ."?api_key=" . $api_key;
        $json_status = file_get_contents($url_status);
        $json2 = json_decode($json_status);
		if(isset($json2[0])){
			$elo_0 = $json2[0]->{'queueType'} . ";" . $json2[0]->{'tier'} . ";" . $json2[0]->{'rank'};
			$elos0 = explode(";",$elo_0);
			if($elos0[0] == "RANKED_FLEX_SR"){
				$elo_f = $elos0[1]. ":" . $elos0[2];
			}
			if($elos0[0] == "RANKED_SOLO_5x5"){
				$elo_s = $elos0[1]. ":" . $elos0[2];
			}
			if($elos0[0] == "RANKED_FLEX_TT"){
				$elo_t = $elos0[1]. ":" . $elos0[2];
			}
		}
		if(isset($json2[1])){
			$elo_1 = $json2[1]->{'queueType'} . ";" . $json2[1]->{'tier'} . ";" . $json2[1]->{'rank'};
			$elos1 = explode(";",$elo_1);
			if($elos1[0] == "RANKED_FLEX_SR"){
				$elo_f = $elos1[1]. ":" . $elos1[2];
			}
			if($elos1[0] == "RANKED_SOLO_5x5"){
				$elo_s = $elos1[1]. ":" . $elos1[2];
			}
			if($elos1[0] == "RANKED_FLEX_TT"){
				$elo_t = $elos1[1]. ":" . $elos1[2];
			}
		}
		if(isset($json2[2])){
			$elo_2 = $json2[2]->{'queueType'} . ";" . $json2[2]->{'tier'} . ";" . $json2[2]->{'rank'};
			$elos2 = explode(";",$elo_2);
			if($elos2[0] == "RANKED_FLEX_SR"){
				$elo_f = $elos2[1]. ":" . $elos2[2];
			}
			if($elos2[0] == "RANKED_SOLO_5x5"){
				$elo_s = $elos2[1]. ":" . $elos2[2];
			}
			if($elos2[0] == "RANKED_FLEX_TT"){
				$elo_t = $elos2[1]. ":" . $elos2[2];
			}
		}
		$return = "";
		if(isset($elo_f)){
			$return = $return . ":FLEX:" . $elo_f;
		}
		if(isset($elo_s)){
			$return = $return . ":SOLO:" . $elo_s;
		}
		if(isset($elo_t)){
			$return = $return . ":TT:" . $elo_t;
		}
		return $return;
    }
    function get_sum_id($sum,$country_code,$api_key){
        $url = 'https://'. $country_code . '.api.riotgames.com/lol/summoner/v4/summoners/by-name/'. $sum .'?api_key='.$api_key;
        $json = file_get_contents($url);
        $json = json_decode($json);
        $sum_id = $json->{'id'};
        return $sum_id;
    }
    /**
* @param $sum_id
* @param $country_code
* @param $api_key
*/function info_ranked($sum_id,$country_code,$api_key){
        $url_status = "https://". $country_code. ".api.riotgames.com/lol/league/v4/entries/by-summoner/". $sum_id ."?api_key=" . $api_key;
        $json_status = file_get_contents($url_status);
        $json2 = json_decode($json_status);
        
        echo "<fieldset><legend><b><h3>Ranked Info</b></h3></legend><br><b><h3>";

        if (isset($json2[0])){
            $qnow = $json2[0]->{'queueType'};
            $qnow = str_replace("_"," ",$qnow);
            $qnow = str_replace("SR","5X5",$qnow);
            $qnow = str_replace("TT", "3x3", $qnow);
			echo $qnow . "</b></h3>";
            echo "<br>Ranked Tier:<b>" . $json2[0]->{'tier'} . "</b>";
            echo "<br>Rank:<b>" . $json2[0]->{'rank'} . "</b>";
            echo "<br>LP:<b>" . $json2[0]->{'leaguePoints'} . "</b>";
            echo "<br>Wins:<b>" . $json2[0]->{'wins'} . "</b>";
            echo "<br>Loses:<b>" . $json2[0]->{'losses'} . "</b><br>";
        }
        if (isset($json2[1])) {
            $qnow = $json2[1]->{'queueType'};
            $qnow = str_replace("_"," ",$qnow);
            $qnow = str_replace("SR","5X5",$qnow);
            $qnow = str_replace("TT", "3x3", $qnow);
            echo "<br><h3><b>" . $qnow . "</b></h3>";;
            echo "<br>Ranked Tier:<b>" . $json2[1]->{'tier'} . "</b>";
            echo "<br>Rank:<b>" . $json2[1]->{'rank'} . "</b>";
            echo "<br>LP:<b>" . $json2[1]->{'leaguePoints'} . "</b>";
            echo "<br>Wins:<b>" . $json2[1]->{'wins'} . "</b>";
            echo "<br>Loses:<b>" . $json2[1]->{'losses'};
        }
        if (isset($json2[2])) {
            $qnow = $json2[2]->{'queueType'};
            $qnow = str_replace("_"," ",$qnow);
            $qnow = str_replace("SR","5X5",$qnow);
            $qnow = str_replace("TT", "3x3", $qnow);
            echo "<br><h3><b>" . $qnow . "</b></h3>";
            echo "<br>Ranked Tier:<b>" . $json2[2]->{'tier'} . "</b>";
            echo "<br>Rank:<b>" . $json2[2]->{'rank'} . "</b>";
            echo "<br>LP:<b>" . $json2[2]->{'leaguePoints'} . "</b>";
            echo "<br>Wins:<b>" . $json2[2]->{'wins'} . "</b>";
            echo "<br>Loses:<b>" . $json2[2]->{'losses'};
        }
        echo "</b><br><br></fieldset><br>";
    }
#MASTERY
#QUEUE
?>
                                <br><br><br></center>
    					</div>
					</div>
					<div class="related" id="masonry">
						<div class="row"> </div>
				  </div>
				</div>
	            <div align="center">
              </div>
	            <div class="col-md-3 col-sm-4">
					<aside>
					  <br>
                      <center>
                      
                      <h6>
					  <?php
						$api_key = get_key();
						if(isset($_POST['sum'])){
							$sum = $_POST['sum'];
							$lvl = get_lvl($sum,$country_code,$api_key);
							echo "<h4><b>".$sum."</b></h4><br>";
							$icon = get_icon($sum,$country_code,$api_key);
							$elo = get_elo($sum,$country_code,$api_key);
							
							echo "<div style='position:absolute; top:122px; left:81px;'><img src='http://opgg-static.akamaized.net/images/profile_icons/profileIcon". $icon .".jpg' width='130px' heigth='134px'></div>";
							echo"<div style='position:relative;'><img src='http://opgg-static.akamaized.net/images/borders2/platinum.png' width='160px' heigth='160px'></div>";
							
							echo"<div style='position:relative; top:10px; left:20px;'>";
							echo "<img src='resources/img/clou.png' width='200' heigth='200'></div>";
							echo "<div style='position:absolute; top:300px; left:135px;'>";
							echo "<br><BR><h1><b>".$lvl."</b></h1><br>";
							echo "</div>";
							echo "<img src='resources/img/tier-icons/". $elo ."_". "i" .".png'>";
							echo "<h3><b>Connection Status</b></h3>";
						}else{
							echo"<img src='resources/img/riot.png' width='213'>";
						}
						servers_status($country_code,$api_key);
					    function servers_status($country_code,$api_key){
							$url_status_all = 'https://'.$country_code.'.api.riotgames.com/lol/status/v3/shard-data?api_key='.$api_key;
							$url_encoded = file_get_contents($url_status_all);
							$json3 = json_decode($url_encoded, true);
							$store_status = $json3['services'][1]['status'];
							$web_status = $json3['services'][2]['status'];
							$client_status = $json3['services'][3]['status'];
							echo "<fieldset>";
							echo "<h3>Store:</h3><b>" . $store_status . "</b>";
							if ($store_status == "online")
							{
								echo "<img src='https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcTmq-0Mi0wHkI2lCV5hFEm1a54GGN7uIQ3Qo2XWwB2G3N-i011C'width='32px'>";
							}
							if ($store_status == "offline")
							{
								echo "<img src='https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQiVcj-sie7yNUrhZacxR5GsEbvfeqw3D2WW1h5p_o6amD_6RSA'width='15px'>";
							}
							echo "<h3>Site: </h3><b>" . $web_status . "</b>";
							if ($web_status == "online")
							{
								echo "<img src='https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcTmq-0Mi0wHkI2lCV5hFEm1a54GGN7uIQ3Qo2XWwB2G3N-i011C'width='32px'>";
							}
							if ($web_status == "offline")
							{
								echo "<img src='https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQiVcj-sie7yNUrhZacxR5GsEbvfeqw3D2WW1h5p_o6amD_6RSA'width='15px'>";
							}
							echo "<h3>Client: </h3><b>" . $client_status . "</b>";
							if ($client_status == "online")
							{
								echo "<img src='https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcTmq-0Mi0wHkI2lCV5hFEm1a54GGN7uIQ3Qo2XWwB2G3N-i011C'width='32px'>";
							}
							if ($client_status == "offline")
							{
								echo "<img src='https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQiVcj-sie7yNUrhZacxR5GsEbvfeqw3D2WW1h5p_o6amD_6RSA'width='15px'>";
							}
							echo "<br></fieldset>";
    }
					  ?>
					  </h6>
                      </div>
                      </center>

				  </aside>
			  </div>
		</div>
	</div>
	<footer>
		<div class="container">
			<img src="./resources/img/clou.png" alt="" width="80" heigth="80">
			<ul class="list-inline social">
			</ul>
			<p>Copyright © Gündüz Corp 2019. Tüm hakları saklıdır.</p>
		</div>
	</footer>

</body></html>
