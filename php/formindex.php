<table>
    <tr>
        <td>Recette :</td>
        <td><input name="recette" class="saisie" type="text" maxlength="50" size="30" value="<?php echo $recette; ?>"></td>
    </tr>
    <tr>
        <td>Trier les donn&eacute;es par </td>
        <td><select name='tricb' id='tri'>
                <option value="recette" 	<?php if ($tri == "recette") echo "selected=\"true\""; ?>>Recette</option>
                <option value="numero" 	<?php if ($tri == "numero") echo "selected=\"true\""; ?>>Num&eacute;ro</option>
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
    foreach ($liste_ingredients as $lingredients) {
        ?>
        <label><input type="checkbox" id="id_<?php echo $lingredients['ingredients_id']; ?>" value="<?php echo $lingredients['ingredients_id']; ?>"><?php echo $lingredients['ingredients_nom']; ?></label>
        <?php
    }
    ?>
</fieldset>
<br>
<input name="valider" class="submit" value="Valider" type="submit">
<hr>
