<?php

include_once('class_sys.php');

class ingredient {

    public $ingredients_id = 0;
    public $ingredients_nom = "";
    public $ingredients_picture = "";
    public $erreur = "";

    function __construct() {
        $this->cleardata();
    }

    public function setdata($ligne) {
        $this->ingredients_id = $ligne['ingredients_id'];
        $this->ingredients_nom = $ligne['ingredients_nom'];
        $this->ingredients_picture = "";
    }

    private function cleardata() {
        $this->ingredients_id = 0;
        $this->ingredients_nom = "";
        $this->ingredients_picture = "";
    }

    public function recingredient($id) {
        $app = new sys();
        $query = "SELECT * FROM ingredients WHERE ingredients_id =" . $id;
        if ($app->requete($query, "S")) {
            while ($ligne = mysqli_fetch_assoc($app->result)) {
                extract($ligne);
                $this->setdata($ligne);
            }
        } else {
            $this->erreur = $app->erreur;
            return false;
        }
        return true;
    }

    public function get_all_ingredients() {
        $class_sys = new sys();
        $list_ingredients = array();
        $query = sprintf("SELECT * FROM     ingredients AS i ORDER BY i.ingredients_nom");
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