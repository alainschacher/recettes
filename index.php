<?php
header('Content-Type: text/html; charset=utf-8');
@session_start();

require('class/class_sys.php');
$class_sys = new sys();
require('class/class_recettes.php');
$class_recette = new recette();
require('class/class_ingredient.php');
$class_ingredient = new ingredient();
require('class/class_recette_ingredients.php');
$class_recette_ingredients = new recette_ingredients();

//$class_sys->debugAll();
$titre = "Tableau de bord";
$datejour = date("d/m/Y");
$valider = true;
if (!isset($_SESSION['tricb']))
    $_SESSION['tricb'] = "recette";

if (isset($_POST['valider'])) {
//    $class_sys->debugVar($_POST);
    $_SESSION['recette'] = "";
    $_SESSION['sel_ingredients'] = array();

    foreach ($_POST AS $k => $post) {
//        echo $k . " - " . $post . "<br>";
        if (substr($k, 0, 16) == "sel_ingredients_") {
            $_SESSION['sel_ingredients'][$post] = (int) $post;
        }
    }
    $valider = true;
    if (isset($_POST['recette'])) {
        $_SESSION['recette'] = $_POST['recette'];
    }
    if (isset($_POST['tricb'])) {
        $_SESSION['tricb'] = $_POST['tricb'];
    }
    $_SESSION['type_sel'] = $_POST['type_rech'];
} else {
    $_SESSION['recette'] = '';
    $_SESSION['tricb'] = "recette";
    $_SESSION['type_sel'] = "A";
    $_SESSION['sel_ingredients'] = array();
}
//$class_sys->debugVar($_SESSION);
?>
<!doctype html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title><?php echo $titre; ?></title>
        <?php include ('php/inclusion_head.php'); ?>
    </head>

    <body>
        <div id="main">
            <div id="head">
                <?php include "php/entete.php"; ?>
            </div>
            <div id="menu">
                <?php include "php/menuh.php"; ?>
            </div>
            <div id="colgauche">
                <div class="rc">
                    <div class="HautLayout"></div>
                    <div class="MilieuLayout">
                        <form id="theForm" method="post" action="index.php">
                            <fieldset>
                                <legend>Selection</legend>
                                <table>
                                    <tr>
                                        <td>Recette :</td>
                                        <td><input name="recette" class="saisie" type="text" maxlength="50" size="30" value="<?php echo $_SESSION['recette']; ?>"></td>
                                    </tr>
                                    <tr>
                                        <td>Trier les donn&eacute;es par </td>
                                        <td><select name='tricb' id='tri'>
                                                <option value="recette" 	<?php if ($_SESSION['tricb'] == "recette") echo "selected=\"true\""; ?>>Recette</option>
                                                <option value="numero" 	<?php if ($_SESSION['tricb'] == "numero") echo "selected=\"true\""; ?>>Num&eacute;ro</option>
                                            </select>
                                        </td>
                                    </tr>
                                </table>
                                <br>&nbsp;<br>
                                <hr>
                                <fieldset>
                                    <legend>Ingrédients</legend>
                                    <?php
                                    $liste_ingredients = $class_ingredient->get_all_ingredients();
                                    echo "<table class='avec-bords'>";
                                    $col = 1;
                                    foreach ($liste_ingredients as $lingredients) {
                                        if($col == 1) {
                                            echo "<tr>";
                                        }
                                        $col +=1;
                                        echo "<td>";
                                        ?>
                                        <label><input name='sel_ingredients_<?php echo $lingredients['ingredients_id']; ?>' 
                                                      type="checkbox" 
                                                      id="id_<?php echo $lingredients['ingredients_id']; ?>" 
                                                      value="<?php echo $lingredients['ingredients_id']; ?>"
                                                      <?php
                                                      echo (isset($_SESSION['sel_ingredients'][$lingredients['ingredients_id']]) ? "checked" : "");
                                                      ?>
                                                      >
                                            <span style="font-size: 15px;"><?php echo $lingredients['ingredients_nom']; ?></span>
                                        </label>
                                        <?php
                                        echo "</td>";
                                        if($col > 6) { 
                                            $col = 1; 
                                            echo "</tr>";
                                        }
                                    }
                                    echo "</table>";
                                    ?>
                                </fieldset>
                                <br>
                                <input type="radio" name="type_rech" value="A" <?php if (isset($_SESSION['type_sel']) && $_SESSION['type_sel'] == "A") echo "checked"; ?>> Au moins un<br>
                                <input type="radio" name="type_rech" value="T" <?php if (isset($_SESSION['type_sel']) && $_SESSION['type_sel'] == "T") echo "checked"; ?>> Tous les ingrédients dans la même recette<br>
                                <br>
                                <input name="valider" class="submit" value="Valider" type="submit">
                                <hr>                            
                            </fieldset>
                        </form>

                        <fieldset>
                            <legend>Liste des recettes</legend>
                            <?php
                            if ($valider == true) {
                                $liste_recettes_ingredients = $class_recette_ingredients->recherche_ingredients(
                                        $_SESSION['sel_ingredients'], $_SESSION['type_sel']);
                                $pi = 0;
//                                $class_sys->debugVar($liste_recettes_ingredients);
                                if (count($liste_recettes_ingredients) > 0) {
                                    ?>
                                    <div style="width: 100%; color: green;">
                                        <h2>
                                            Nombre de recettes extraites :
                                        </h2>
                                    </div>
                                    <table style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Num</th>
                                                <th>Recette</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        $tricheck = 0;
                                        $first = true;
                                        foreach ($liste_recettes_ingredients AS $ki => $ligne) {
//                                $class_sys->debugVar($ligne);
                                            $pi += 1;
                                            $ctr = ($pi % 2 != 0) ? 'class="impair"' : 'class="pair"';
                                            if ($tricheck != $ligne['recettes_id']) {
                                                $first = true;
                                                $tricheck = $ligne['recettes_id'];
                                            }
                                            if ($first) {
                                                echo "<tr " . $ctr . ">";
                                                echo "<td>&nbsp;</td>";
                                                echo "<td>&nbsp;</td>";
                                                echo "<td>&nbsp;</td>";
                                                echo "<td>&nbsp;</td>";
                                                echo "<td>&nbsp;</td>";
                                                echo "<td>&nbsp;</td>";
                                                echo "</tr>";
                                            }
                                            ?>

                                            <tr <?php echo $ctr; ?>>
                                                <td style="width: 10%;"><?php echo ($first ? $ligne['recettes_id'] : ""); ?></td>
                                                <td style="width: 30%;"><a
                                                        href="gestion_recette.php?id=<?php echo $ligne['recettes_id']; ?>"
                                                        ><?php echo ($first ? $ligne['recettes_nom'] : ""); ?> </a>
                                                </td>
                                                <td style="width: 20%;">
                                                    <?php
                                                    if (isset($_SESSION['sel_ingredients'][$ligne['recette_ingredients_ingredient_id']])) {
                                                        echo "<b>";
                                                    }
                                                    echo $ligne['ingredients_nom'];
                                                    if (isset($_SESSION['sel_ingredients'][$ligne['recette_ingredients_ingredient_id']])) {
                                                        echo "</b>";
                                                    }
                                                    ?>
                                                </td>
                                                <td style="width: 10%;"><?php echo $ligne['recette_ingredients_quantite']; ?></td>
                                                <td style="width: 15%;"><?php echo $ligne['recette_ingredients_quantite_commentaire']; ?></td>
                                                <td style="width: 15%;"><?php echo $first ? $ligne['recettes_commentaire']:""; ?></td>
                                            </tr>
                                            <?php
                                            $first = false;
                                        }
                                        ?>
                                    </table>
                                    <?php
                                }
                            }
                            ?>
                        </fieldset>
                        <div id="printerlink">
                            <a href="javascript:window.print()">Imprimer la page</a>
                        </div>
                    </div>
                    <div class="BasLayout"></div>
                </div>
            </div>
        </div>
    </body>
</html>
