<?php
header('Content-Type: text/html; charset=utf-8');
@session_start();

require('class/class_sys.php');
$app = new sys();
require('class/class_recettes.php');
$fi = new recette();

//$app->debugAll();
$titre = "Liste des recettes";
$datejour = date("d/m/Y");
$valider = true;
if (!isset($tri))
    $tri = "recette";

$recette = "";
$numero = "";
$tri = "recette";

if (isset($_POST['valider'])) {
    $_SESSION['recette'] = "";
    $_SESSION['numero'] = "";

    $valider = true;
    if (isset($_POST['recette'])) {
        $recette = $_POST['recette'];
        $_SESSION['recette'] = $recette;
    }
    if (isset($_POST['numero'])) {
        $numero = $_POST['numero'];
        $_SESSION['numero'] = $numero;
    }
    if (isset($_POST['tricb'])) {
        $tri = $_POST['tricb'];
        $_SESSION['tricb'] = $tri;
    }
    //echo "Film :" .$recette." num :".$numero." tri :".$tri;
}

//$app->debugVar($recette);
?>
<!doctype html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title><?php echo $titre; ?></title>
        <?php include ('php/inclusion_head.php');?>
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
                        <form id="theForm" method="post" action="liste_recettes.php">
                            <fieldset>
                                <legend>Selection</legend>
                                <?php include ('php/formrecette.php'); ?>
                            </fieldset>
                            <fieldset>
                                <legend>Liste des recettes</legend>
                                <?php
                                //echo "valider ".$valider;
                                if ($valider == true) {
                                    $qry = "SELECT * FROM recettes";
                                    if ($recette <> "") {
                                        $qry .= " WHERE (recettes_nom LIKE \"%" . $recette . "%\")";
                                        $w = true;
                                    }
                                    switch ($tri) {
                                        case "nom": $qry .= " ORDER BY recettes_nom";
                                            break;
                                        case "numero": $qry .= " ORDER BY recettes_id";
                                            break;
                                        default: $qry .= " ORDER BY recettes_nom";
                                            break;
                                    }
                                    //$app->debugVar($qry);
                                    $pi = 0;
                                    if ($app->requete($qry, "S")) {
                                        ?>
                                        <div style="width: 100%; color: green;">
                                            <h2>
                                                Nombre d'enregistrements extraits :
                                                <?php echo $app->num_rows; ?>
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
                                            while ($ligne = mysqli_fetch_assoc($app->result)) {
                                                extract($ligne);
                                                $fi->setdata($ligne);
                                                //$app->debugVar($fi);
                                                $pi += 1;
                                                if ($pi % 2 != 0)
                                                    $ctr = 'class="impair"';
                                                else
                                                    $ctr = 'class="pair"';
                                                ?>
                                                <tr <?php echo $ctr; ?>>
                                                    <td style="width: 10%;"><?php echo $fi->recette_id; ?></td>
                                                    <td style="width: 30%;"><a
                                                            href="gestion_recette.php?id=<?php echo $fi->recette_id; ?>"
                                                            ><?php echo $fi->recette_nom; ?> </a>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                        </table>
                                        <?php
                                    } else
                                        echo $app->erreur;
                                }
                                ?>
                            </fieldset>
                        </form>
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
