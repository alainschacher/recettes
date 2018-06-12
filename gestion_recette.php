<?php
header('Content-Type: text/html; charset=utf-8');
@session_start();

require('class/class_sys.php');
$class_sys = new sys();
require('class/class_recettes.php');
$fi = new recette();
require('class/class_ingredient.php');

$idd = 0;
if (@$_GET['id'] != "")
    $idd = @$_GET['id'];

if ($idd == 0)
    $titre = "Cr&eacute;er une recette";
else
    $titre = "Modifier une recette";

$datejour = date("d/m/Y");
if ($idd != 0)
    $fi->recrecette($idd);

//$class_sys->debugVar($_SERVER);
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
                        <form method="post" id="gestion_type _animal_Form"
                              action="gestion_recette.php?id=<?php echo $idd; ?>">
                            <input type="hidden" value="<?php echo $idd; ?>" id="idd">
                            <fieldset>
                                <legend>
                                    <?php echo $titre; ?>
                                </legend>
                                <table>
                                    <tr>
                                        <td>Label :</td>
                                        <td><input class="oblig" type="text" id="recette_id" maxlength="10"
                                                   size="10" value="<?php echo $fi->recette_id; ?>" readonly/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>nom :</td>
                                        <td><input class="oblig" type="text" id="recette_nom"
                                                   maxlength="60" size="60"
                                                   value="<?php echo $fi->recette_nom; ?>" /> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Recette pour :</td>
                                        <td><input class="oblig" type="text" id="recettes_pour_qte_pers"
                                                   maxlength="60" size="60"
                                                   value="<?php echo $fi->recettes_pour_qte_pers; ?>" 
                                                   <?php if($idd > 0) {echo "readonly";} ?> /> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Type :</td>
                                        <td>
                                        <select id="recettes_type"  <?php if($idd > 0) {echo 'disabled';} ?>>
                                            <option value='1' <?php if($idd > 0 && $fi->recettes_type == '1') echo 'selected=""';?>>Jus</option>
                                        <option value='2'<?php if($idd > 0 && $fi->recettes_type == '2') echo 'selected=""';?>>Smoothies</option>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Commentaires :</td>
                                        <td>
                                            <textarea rows="4" cols="80" id="recettes_commentaire"><?php if($idd > 0) echo $fi->recettes_commentaire;?></textarea>
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
                        <div id="liste_ingredients">
                            <?php if ($idd > 0) { ?>
                            <div id="formulaire_ajout_ingredient">
                                <fieldset style="margin-top:20px;margin-bottom:20px;">
                                    <legend>Ajouter un ingrédient</legend>
                                    <?php
                                    $class_ingredients = new ingredient();
                                    $liste_ingredients = $class_ingredients->get_all_ingredients();
                                    if (count($liste_ingredients) > 0) {
                                        ?>
                                        <select id="sel_ingredient">
                                            <?php foreach ($liste_ingredients AS $ingredients) { ?>
                                                <option value='<?php echo $ingredients['ingredients_id']; ?>'><?php echo $ingredients['ingredients_nom']; ?></option>
                                            <?php } ?>
                                        </select>
                                        <input id="quantite" name="quantite" class="saisie" type="text" maxlength="50" size="30" value="0"/>
                                        <input id="quantite_commentaire" name="quantite_commentaire" class="saisie" type="text" maxlength="50" size="30" value=""/>
                                        <button type='submit' id='bouton_ajouter_ingredient'>Ajouter</button>
                                        <?php
                                    }
                                    ?>
                                        <div id='message_erreur_ingredient'></div>
                                </fieldset>
                            </div>
                            <?php } ?>
                            <fieldset>
                                <legend>
                                    Liste des Ingrédients
                                </legend>
                                <?php
                                $class_recette = new recette();
                                $liste_recette_ingredients = $class_recette->get_ingredients($idd);
//                        $class_sys->debugVar($liste_ingredients);
                                if (count($liste_recette_ingredients) > 0) {
                                    ?>
                                    <table style='width:100%;'>
                                        <thead>
                                            <tr>
                                                <th>Num</th>
                                                <th>Ingrédient</th>
                                                <th>Quantité</th>
                                                <th>Commentaire</th>
                                            </tr>
                                        </thead>
                                            <?php foreach ($liste_recette_ingredients AS $recette_ingredients) { ?>
                                            <tr>
                                                <td><?php echo $recette_ingredients['recette_ingredients_id']; ?></td>
                                                <td><?php echo htmlentities($recette_ingredients['ingredients_nom']); ?></td>
                                                <td><?php echo $recette_ingredients['recette_ingredients_quantite']; ?></td>
                                                <td><?php echo $recette_ingredients['recette_ingredients_quantite_commentaire']; ?></td>
                                            </tr>
                                    <?php } ?>
                                    </table>
                                    <?php
                                }
                                ?>
                            </fieldset>

                        </div>
                        <div id="printerlink">
                            <a href="javascript:window.print()">Imprimer la page</a>
                        </div>
                    </div>
                    <div class="BasLayout"></div>
                </div>
            </div>
            <div id="coldroite">
                <div class="rc">
                    <div id="cont_droite">
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

<script>
    $(document).ready(function () {
        
        $("#bouton_ajouter_ingredient").click(function () {
            var quantite = $("#quantite").val();
            var qte_commentaire = $("#quantite_commentaire").val();
            if(quantite == "0" && qte_commentaire == "") {
                alert("La quantité doit être différente de 0 !");
                return false;
            }
            $.ajax({
                url: 'php/mise_a_jour_ajax.php',
                type: 'POST',
                data: {
                    table: "ingredient_recette",
                    id_recette: $("#idd").val(),
                    id_ingredient_recette: 0,
                    id_ingredient: $("#sel_ingredient").val(),
                    quantite: $("#quantite").val(),
                    quantite_commentaire : $("#quantite_commentaire").val()
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    // En cas d'erreur, on le signale
                    $('#message').html('').html('<div class="error">Une erreur est survenue lors de la requête.</div>');
                },
                success: function (data, textStatus, jqXHR) {
                    // Succes. On affiche un message de confirmation
                    $('#cont_droite').html('').html(data);
                    document.location.href="gestion_recette.php?id="+$('#idd').val();
                }
            });
        });

        $("#bt_valider").click(function () {
            recette_nom = $("#recette_nom").val();
//            alert("recette_nom :" + recette_nom);
            if (recette_nom == '' || recette_nom == null)
            {
                alert("Le nom de la recette est obligatoire !");
                return false;
            }

            $.ajax({
                url: 'php/mise_a_jour_ajax.php',
                type: 'POST',
                data: {
                    table: "recette",
                    id: $("#recette_id").val(),
                    nom: recette_nom,
                    recettes_pour_qte_pers : $("#recettes_pour_qte_pers").val(),
                    recettes_type : $("#recettes_type").val(),
                    recettes_commentaire: $("#recettes_commentaire").val()
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    // En cas d'erreur, on le signale
                    $('#message').html('').html('<div class="error">Une erreur est survenue lors de la requête.</div>');
                },
                success: function (data, textStatus, jqXHR) {
                    // Succes. On affiche un message de confirmation
                    $('#cont_droite').html('').html(data);
                    document.location.href="liste_recettes.php";
                }
            });
        });
    });
</script>
