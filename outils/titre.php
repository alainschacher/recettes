<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require('../class/class_sys.php');
$app=new sys();
$maj=new sys();

$qry = "SELECT * FROM movies WHERE originaltitle = ''";

if ($app->requete($qry,"S"))
{
    while ($ligne=mysql_fetch_assoc($app->result))
    {
        extract($ligne);
        $sel = 0;
        if($ligne['translatedtitle'] != "") 
        {
            $qry2 = 'UPDATE movies SET `originaltitle` = "'.$ligne['translatedtitle'].'" WHERE `num` ='.$ligne['num'].';';
            if (!$maj->requete($qry2, "A")) echo $maj->erreur."<br/>";
            //echo $qry2."<br/>";            
        }
    }
}

?>
