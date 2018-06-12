<?php

require('../class/tmdb_v3.php');

$apikey = "605d93c6bcf783ae5b20f1092ae4b0ed";
$tmdb_V3 = new TMDBv3($apikey);
$tmdb_V3->setLang("fr");
$config = $tmdb_V3->getConfig();
$img_baseurl = $tmdb_V3->getImageURL();

$film = utf8_decode($_POST["recettetrad"]);
//echo utf8_encode($film);
$rec_film = $tmdb_V3->searchMovie($film, 'cl');
//print_r($rec_film);
foreach ($rec_film as $key => $value) {
	//echo "key ".$key."value ".print_r($value)."<br>";
	//print_r($key);
	if (is_array($value) && !is_null($value)) {
		//        echo "<pre>";
		//        print_r($value);
		//        echo "</pre>";
		echo "<form action=\"".$_SERVER['PHP_SELF']."\" method=\"post\">";
		echo "<table class='maxtab'>";
		echo "<tr>";
		echo "<th>Id</th>";
		echo "<th>Titre original</th>";
		echo "<th>Titre</th>";
		echo "<th>Image</th>";
		echo "</tr>";
		foreach ($value as $key2 => $val2) {
			echo "<tr>";
			//echo "key2 ".$key2." Value ".$val2."<br>";
			echo "<td valign='middle' >" . $val2['id'] . "</td>";
			echo "<td valign='middle'>" . $val2['original_title'] . "</td>";
			echo "<td valign='middle'>" . $val2['title'] . "</td>";
			echo "<td valign='middle'><img src=" . $img_baseurl . $val2['poster_path'] . " width='100'></td>";
			echo "</tr>";
			//  print_r($val2['id']);
		}
		echo "</table>";
		echo "</form>";
	}
	//else   echo "Key ".$key ." ".$value."<br>";
}
?>
