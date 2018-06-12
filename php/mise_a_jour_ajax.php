<?php

require_once('../class/class_sys.php');
$app = new sys();
//$app->debugAll();

$type = $_POST["table"];
$retour = "";
switch ($type) {
    case 'recette':
        $retour = recette($app);
        break;
    case 'ingredient':
        $retour = ingredient($app);
        break;
    case 'ingredient_recette':
        $retour = ingredient_recette($app);
        break;
}
echo $retour;

function ingredient_recette($class_sys) {
    $ret = "";
    $id_recette = $_POST['id_recette'];
    $id_ingredient = $_POST['id_ingredient'];
    $quantite = $_POST['quantite'];
    $quantite_commentaire = $_POST['quantite_commentaire'];
    $id_ingredient_recette = $_POST['id_ingredient_recette'];
    
    if ($id_ingredient_recette == '0') {
        $query = sprintf('INSERT INTO recette_ingredients (
        		recette_ingredients_recette_id,
                        recette_ingredients_ingredient_id,
                        recette_ingredients_ordre,
                        recette_ingredients_quantite,
                        recette_ingredients_quantite_commentaire) VALUES
			(%d,%d,%d,"%s","%s")',$id_recette,$id_ingredient,0,$quantite,$quantite_commentaire);
        //echo $query;
        if (!$class_sys->requete($query, "A"))
            $ret = "Erreur : " . $app->afferr($class_sys->erreur);
        else
            $ret = "Enregistrement créé";
    }
    else {
        $query = 'UPDATE recettes SET
        	recettes_nom 		=   "' . $nom . '"
        	WHERE recettes_id   =' . $idd;
        //echo $query;
        if (!$class_sys->requete($query, "U"))
            $ret = "Erreur : " . $class_sys->afferr($app->erreur);
        else
            $ret = "Enregistrement mis à jour";
    }
    return $ret;
}

function recette($app) {
    $ret = "";
    $idd = $_POST['id'];
    $nom = $_POST['nom'];
    $commentaire = $_POST["recettes_commentaire"];
    $recettes_pour_qte_pers = $_POST['recettes_pour_qte_pers'];
    $recettes_type = $_POST['recettes_type'];

    if ($idd == '0') {
        $query = sprintf('INSERT INTO recettes (
        	recettes_nom,recettes_pour_qte_pers,recettes_type,recettes_commentaire) VALUES
			("%s",%d,%d)',$nom,$recettes_pour_qte_pers,$recettes_type,$commentaire);
        //echo $query;
        if (!$app->requete($query, "A"))
            $ret = "Erreur : " . $app->afferr($app->erreur);
        else
            $ret = "Enregistrement créé";
    }
    else {
        $query = sprintf('UPDATE recettes SET
        	recettes_nom 		=   "%s",
                recettes_pour_qte_pers  =   %d,
                recettes_commentaire    =   "%s"
        	WHERE recettes_id   = %d',$nom,$recettes_pour_qte_pers,$commentaire,$idd);
        //echo $query;
        if (!$app->requete($query, "U"))
            $ret = "Erreur : " . $app->afferr($app->erreur);
        else
            $ret = "Enregistrement mis à jour";
    }
    return $ret;
}

function ingredient($app) {
    $ret = "";
    $idd = $_POST['id'];
    $nom = $_POST['nom'];

    if ($idd == '0') {
        $query = 'INSERT INTO ingredients (
        	ingredients_nom) VALUES
			(
            "' . $nom . '")';
        //echo $query;
        if (!$app->requete($query, "A"))
            $ret = "Erreur : " . $app->afferr($app->erreur);
        else
            $ret = "Enregistrement créé";
    }
    else {
        $query = 'UPDATE ingredients SET
        	ingredients_nom 		=   "' . $nom . '"
        	WHERE ingredients_id   =' . $idd;
        //echo $query;
        if (!$app->requete($query, "U"))
            $ret = "Erreur : " . $app->afferr($app->erreur);
        else
            $ret = "Enregistrement mis à jour";
    }
    return $ret;
}

?>
