<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Suggest extends CI_Model {

    function gagner(){
        $sql="SELECT * FROM VariationPoidsAvecNoms WHERE objectif = 'gain'";
        $query = $this->db->query($sql);
        $results = $query->result_array();
        return $results;
    }

    function perdre(){
        $sql="SELECT * FROM VariationPoidsAvecNoms WHERE objectif = 'perte'";
        $query = $this->db->query($sql);
        $results = $query->result_array();
        return $results;
    }
}

?>
