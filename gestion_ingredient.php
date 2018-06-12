<?php
header('Content-Type: text/html; charset=utf-8');
@session_start();

require('class/class_sys.php');
$app = new sys();
require('class/class_ingredient.php');
$fi = new ingredient();

$idd = 0;
if (@$_GET['id'] != "")
    $idd = @$_GET['id'];

if ($idd == 0)
    $titre = "Cr&eacute;er un ingredient";
else
    $titre = "Modifier un ingrédient";

$datejour = date("d/m/Y");
if ($idd != 0)
    $fi->recingredient($idd);

//$app->debugVar($_SERVER);
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
                        <form method="post" id="gestion_type _animal_Form"
                              action="gestion_ingredient.php?id=<?php echo $idd; ?>">
                            <input type="hidden" value="<?php echo $idd; ?>" id="idd">
                                <fieldset>
                                    <legend>
                                        <?php echo $titre; ?>
                                    </legend>
                                    <table>
                                        <tr>
                                            <td>Label :</td>
                                            <td><input class="oblig" type="text" id="ingredient_id" maxlength="10"
                                                       size="10" value="<?php echo $fi->ingredients_id; ?>" readonly/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>nom :</td>
                                            <td><input class="oblig" type="text" id="ingredient_nom"
                                                       maxlength="60" size="60"
                                                       value="<?php echo $fi->ingredients_nom; ?>" /> 
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <div id="message"></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <div id="boutons_valide">
                                                    <input id="bt_valider" value="Valider la fiche" type="button"/>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </fieldset>
                        </form>
                        <script type="text/javascript">
//                            onload_fiche_recette(<?php echo $idd; ?>);
                        </script>
                        <div id="printerlink">
                            <a href="javascript:window.print()">Imprimer la page</a>
                        </div>
                    </div>
                    <div class="BasLayout"></div>
                </div>
            </div>
            <div id="coldroite">
                <div class="rc">
                    <div id="cont_droite"></div>
                </div>
            </div>
        </div>
    </body>
</html>

<script>
    $(document).ready(function() {
        $("#bt_valider").click(function() {
            ingredient_nom = $("#ingredient_nom").val();
            console.log("ingredient_nom :" + ingredient_nom);
            if (ingredient_nom == '' || ingredient_nom == null)
            {
                alert("Le nom de l'ingrédient est obligatoire !");
                return false;
            }

            $.ajax({
                url: 'php/mise_a_jour_ajax.php',
                type: 'POST',
                data: {
                    table: "ingredient",
                    id: $("#ingredient_id").val(),
                    nom: ingredient_nom
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    // En cas d'erreur, on le signale
                    $('#message').html('').html('<div class="error">Une erreur est survenue lors de la requête.</div>');
                },
                success: function(data, textStatus, jqXHR) {
                    // Succes. On affiche un message de confirmation
                    $('#cont_droite').html('').html(data);
                    document.location.href="liste_ingredient.php";
                }
            });
        });
    });
</script>
