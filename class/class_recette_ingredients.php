<?php

include_once('class_sys.php');
include_once ('class_recettes.php');

class recette_ingredients {

    public $recette_ingredients_id = 0;
    public $recette_ingredients_recette_id = 0;
    public $recette_ingredients_ingredient_id = 0;
    public $recette_ingredients_ordre = 0;
    public $recette_ingredients_quantite = 0.00;
    public $recette_ingredients_quantite_commentaire = "";
    public $erreur = "";

    function __construct() {
        $this->cleardata();
    }

    public function setdata($ligne) {
        $this->recette_ingredients_id = $ligne['recette_ingredients_id'];
        $this->recette_ingredients_recette_id = $ligne['recette_ingredients_recette_id'];
        $this->recette_ingredients_ingredient_id = $ligne['recette_ingredients_ingredient_id'];
        $this->recette_ingredients_ordre = $ligne['recette_ingredients_ordre'];
        $this->recette_ingredients_quantite = $ligne['recette_ingredients_quantite'];
        $this->recette_ingredients_quantite_commentaire = $ligne['recette_ingredients_quantite_commentaire'];
    }

    private function cleardata() {
        $this->recette_ingredients_id = 0;
        $this->recette_ingredients_recette_id = 0;
        $this->recette_ingredients_ingredient_id = 0;
        $this->recette_ingredients_ordre = 0;
        $this->recette_ingredients_quantite = 0.00;
        $this->recette_ingredients_quantite_commentaire = "";
    }

    public function recrecette($id) {
        $class_sys = new sys();
        $query = "SELECT * FROM recette_ingredients WHERE recette_ingredients_id =" . $id;
        if ($class_sys->requete($query, "S")) {
            while ($ligne = mysqli_fetch_assoc($class_sys->result)) {
                extract($ligne);
                $this->setdata($ligne);
            }
        } else {
            $this->erreur = $class_sys->erreur;
            return false;
        }
        return true;
    }

    public function recherche_ingredients($liste_ingredients, $type) {
        $class_sys = new sys();
        $class_recettes = new recette();
        $liste_recettes_ingredients = array();
        $liste_recettes = array();
        $liste_ingredient_sel = array();
        $liste_ingredients_sel_char = "";

        foreach ($liste_ingredients AS $k => $v) {
            $liste_ingredient_sel[] = array("ingredients_id" => (int) $v, "trouve" => "N");
        }
        $liste_ingredients_sel_char = implode(",", $liste_ingredients);

        $query = sprintf("SELECT  r.recettes_id FROM   recette_ingredients AS i
                                                INNER JOIN      recettes AS r   ON(i.recette_ingredients_recette_id = r.recettes_id)
                                                WHERE i.recette_ingredients_ingredient_id IN (%s)
                                                GROUP BY r.recettes_id 
                                                ORDER BY r.recettes_id", $liste_ingredients_sel_char);
        if ($class_sys->requete($query, "S") && $class_sys->num_rows > 0) {
            while ($ligne = $class_sys->result->fetch_assoc()) {
                $liste_recettes[] = $ligne['recettes_id'];
            }
            if ($type == "A") {
                $ind_id = implode(",", $liste_recettes);
                $liste_recettes_ingredients = $class_recettes->get_ingredients_from_list_recette($ind_id);
            } else {
//                $class_sys->debugVar($liste_recettes);
                $liste_recettes_id = array();
                foreach ($liste_recettes AS $klr => $vlr) {
                    foreach ($liste_ingredient_sel AS $k => $v) {
                        $liste_ingredient_sel[$k]['trouve'] = "N";
                    }

                    $liste_ingredients_pour_une_recette = $class_recettes->get_ingredients($vlr);
//                    $class_sys->debugVar($liste_ingredients_pour_une_recette);
                    foreach ($liste_ingredients_pour_une_recette AS $k => $v) {
                        foreach ($liste_ingredient_sel AS $klis => $vlis) {
                            if ($vlis['ingredients_id'] == $v['ingredients_id']) {
                                $liste_ingredient_sel[$klis]['trouve'] = "O";
                            }
                        }
                    }
                    $recette_ok = true;
                    foreach ($liste_ingredient_sel AS $klis => $vlis) {
                        if ($vlis['trouve'] == "N") {
                            $recette_ok = false;
                        }
                    }
//                    echo ($recette_ok ? "true":"false")."<br>";
                    if ($recette_ok) {
                        $liste_recettes_id[] = $vlr;
                    }
//                    $class_sys->debugVar($liste_recettes_id);
                }
                $liste_recettes_ingredients = $class_recettes->get_ingredients_from_list_recette(implode(",",$liste_recettes_id));
            }
        } else {
            $this->erreur = $class_sys->erreur;
        }

        return $liste_recettes_ingredients;
    }

}

?>