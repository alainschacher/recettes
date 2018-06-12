<?php

include_once('class_sys.php');

class recette {

    public $recette_id = 0;
    public $recette_nom = "";
    public $recettes_pour_qte_pers = 0;
    public $recettes_type = 1;
    public $recettes_commentaire = 1;
    
    public $erreur = "";

    function __construct() {
        $this->cleardata();
    }

    public function setdata($ligne) {
        $this->recette_id = $ligne['recettes_id'];
        $this->recette_nom = $ligne['recettes_nom'];
        $this->recettes_pour_qte_pers = $ligne['recettes_pour_qte_pers'];
        $this->recettes_type = $ligne['recettes_type'];
        $this->recettes_commentaire = $ligne['recettes_commentaire'];
    }

    private function cleardata() {
        $this->recette_id = 0;
        $this->recette_nom = "";
        $this->recettes_pour_qte_pers = 0;
        $this->recettes_type = 1;
        $this->recettes_commentaire = "";
    }

    public function recrecette($id) {
        $class_sys = new sys();
        $query = "SELECT * FROM recettes WHERE recettes_id =" . $id;
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

    public function get_ingredients($id) {
        $class_sys = new sys();
        $list_ingredients = array();
        $query = sprintf("SELECT * FROM          recettes AS r 
                                  INNER JOIN    recette_ingredients AS ri   ON(r.recettes_id = ri.recette_ingredients_recette_id)
                                  INNER JOIN    ingredients         AS i    ON(ri.recette_ingredients_ingredient_id = i.ingredients_id)
                                  WHERE r.recettes_id = %d
                                  ORDER BY ri.recette_ingredients_ordre", $id);
        if ($class_sys->requete($query, "S")) {
            while ($ligne = $class_sys->result->fetch_assoc()) {
                $list_ingredients[] = $ligne;
            }
        } else {
            $this->erreur = $class_sys->erreur;
        }
        return $list_ingredients;
    }

    public function get_ingredients_from_list_recette($liste_id) {
        $class_sys = new sys();
        $list_ingredients = array();
        $query = sprintf("SELECT * FROM   recettes AS r
                                            INNER JOIN recette_ingredients AS ri    ON(ri.recette_ingredients_recette_id = r.recettes_id)
                                            INNER JOIN ingredients AS i             ON(i.ingredients_id = ri.recette_ingredients_ingredient_id) 
                                            WHERE r.recettes_id IN (%s) 
                                            ORDER BY r.recettes_nom", $liste_id);
        if ($class_sys->requete($query, "S")) {
            while ($ligne = $class_sys->result->fetch_assoc()) {
                $list_ingredients[] = $ligne;
            }
        } else {
            $this->erreur = $class_sys->erreur;
        }
        return $list_ingredients;
    }

}

?>