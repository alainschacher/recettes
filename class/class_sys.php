<?php

class sys {

    var $base;
    var $requette;
    var $connexion;
    var $user;
    var $mdp;
    var $hote;
    public $erreur;
    public $num_rows = 0;
    public $new_id = 0;
    public $result;

    // le constructeur de notre classe qui prend un paramètre
    function __construct() {
        $this->hote = "localhost";
        $this->user = "alain";
        $this->mdp = "alain";
        $this->base = "recettes";
        $this->erreur = "";

        return true;
    }

    function afferr($err) {
        echo $err;
    }

    function requete($req, $t) {
        $this->connexion = new mysqli($this->hote, $this->user, $this->mdp, $this->base);

        //$this->connexion = mysqli_connect($this->hote, $this->user, $this->mdp);

        if (mysqli_connect_errno()) {
            $this->erreur = "Connexion impossible : " . mysqli_error();
            return false;
        }

        $this->requette = $req;
        $this->result = $this->connexion->query($this->requette);
        if ($this->result) {
            if ($t == "S")
                $this->num_rows = $this->result->num_rows;
            if ($t == "I" || $t == "A")
                $this->new_id = mysqli_insert_id($this->connexion);
            mysqli_close($this->connexion);
            return true;
        }
        else {
            $this->erreur = "Erreur dans la requette : " . mysqli_error($this->connexion);
            mysqli_close($this->connexion);
            return false;
        }
    }

    function debugVar($var) {
        //$this->dump_table($var);

        echo '<pre>';
        echo "\nDEBUG\n";
        if (is_array($var)) {
            echo "<pre>";
            var_dump($var);
            echo "</pre>";
        } else {
            var_dump($var);
        }
        echo "\nFIN DEBUG\n";
        echo '</pre>';
    }

    function dump_table($var, $title = false, $level = 0) {
        if ($level == 0) {
            echo '<table width="400" border="0" cellspacing="1" cellpadding="3" class="dump">';

            if ($title)
                echo '<tr>
                         <th align="center" colspan="2">' . $title . '</th>
                       </tr>';

            echo '
              <tr>
                <th align="left">VAR NAME</th>
                <th align="left">VALUE</th>
              </tr>';
        }
        else {
            echo '<tr>
                    <td colspan="2">
                        <table width="100%" border="0" cellspacing="3" cellpadding="3" class="dump_b">
                    </td>
                  </tr>';
        }
        foreach ($var as $i => $value) {
            if (is_array($value) or is_object($value)) {
                $this->dump_table($value, false, ($level + 1));
            } else {
                echo '<tr>
                            <td align="left" width="50%" >' . $i . '</th>
                            <td align="left" width="50%" >' . $value . '</th>
                           </tr>';
            }
        }
        echo '</table>';
    }

    function debugAll() {
        echo '<pre>';
        echo "POST\n";
        var_dump($_POST);
        echo "GET\n";
        var_dump($_GET);
        echo "SESSION\n";
        var_dump($_SESSION);
        echo "SERVER\n";
        var_dump($_SERVER);
        echo '</pre>';
    }

    function nom_appli() {
        return "Penselev.V01";
    }

    function licence() {
        return "Licence accord&eacute; &agrave; Elevage CANEDEN";
    }

    function heurecombo() {
        $cbh = "";
        for ($i = 0; $i < 24; $i++) {
            $j = "00";
            if ($i < 10)
                $h = "0" . (string) $i . "H" . $j;
            else
                $h = (string) $i . "H" . $j;
            $cbh .= '<option value="' . $h . '">' . $h . '</option>"';
            $j = "15";
            if ($i < 10)
                $h = "0" . (string) $i . "H" . $j;
            else
                $h = (string) $i . "H" . $j;
            $cbh .= '<option value="' . $h . '">' . $h . '</option>"';
            $j = "30";
            if ($i < 10)
                $h = "0" . (string) $i . "H" . $j;
            else
                $h = (string) $i . "H" . $j;
            $cbh .= '<option value="' . $h . '">' . $h . '</option>"';
            $j = "45";
            if ($i < 10)
                $h = "0" . (string) $i . "H" . $j;
            else
                $h = (string) $i . "H" . $j;
            $cbh .= '<option value="' . $h . '">' . $h . '</option>"';
        }
        $cbh .= "</select>";
        return $cbh;
    }

}

?>
