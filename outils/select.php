<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require('../class/class_sys.php');
$app=new sys();
$maj=new sys();

$qry = "SELECT * FROM movies";

if ($app->requete($qry,"S"))
{
    while ($ligne=mysql_fetch_assoc($app->result))
    {
        extract($ligne);
        $sel = 0;
        if($ligne['checked'] == "True") $sel = 1;
        $qry2 = "UPDATE movies SET `select` = '".$sel."' WHERE `num` =".$ligne['num'].";";
        //UPDATE  `filmsperso`.`movies` SET  `select` =  '1' WHERE  `movies`.`num` =677;
        if (!$maj->requete($qry2, "A")) echo $maj->erreur."<br/>";
        //echo $qry2."<br/>";
    }
}

?>
