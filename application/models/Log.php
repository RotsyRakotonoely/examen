<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log extends CI_Model {

    function login($email,$mdp){
        $sql="SELECT * FROM users WHERE email = '".$email."' and mdp = '".$mdp."'";
        $query = $this->db->query($sql);
        $results = $query->result_array();
        return $results;
    }

    function inscription($email, $nom, $mdp, $genre, $taille, $poids, $portefeuille) {
        $sql = "INSERT INTO users (email, mdp, nom, genre, taille, poids, portefeuille) VALUES ('" . $email . "','" . $mdp . "','" . $nom . "','" . $genre . "'," . $taille . "," . $poids . ",0)";
        $query = $this->db->query($sql);
    
        // Récupérer l'ID de l'utilisateur inséré
        $user_id = $this->db->insert_id();
    
        // Créer le portefeuille pour l'utilisateur
        $portefeuille_data = array(
            'iduser' => $user_id,
            'montant' => 0 // Remplacez 0 par le montant initial souhaité
        );
        $this->db->insert('portefeuille', $portefeuille_data);
    
        return $query;
    }
    


function checkEmailExists($email) {
    $this->db->where('email', $email);
    $query = $this->db->get('users');
    return $query->num_rows() > 0;
}


}

?>

