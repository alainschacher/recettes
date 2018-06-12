<table>
    <tr>
        <td>Ingrédient :</td>
        <td><input name="ingredient" class="saisie" type="text" maxlength="50" size="30" value="<?php echo $ingredient; ?>"></td>
    </tr>
    <tr>
        <td>Num&eacute;ro :</td>
        <td><input name="numero" class="saisie" type="text" maxlength="10" size="10" value="<?php echo $numero; ?>"></td>
    </tr>
    <tr>
        <td>Trier les donn&eacute;es par </td>
        <td><select name='tricb' id='tri'>
                <option value="ingredient" 	<?php if ($tri == "ingredient") echo "selected=\"true\""; ?>>Ingrédient</option>
                <option value="numero" 	<?php if ($tri == "numero") echo "selected=\"true\""; ?>>Num&eacute;ro</option>
            </select>
        </td>
    </tr>
</table>
<br>&nbsp;<br>
<input name="valider" class="submit" value="Valider" type="submit">
<hr>
