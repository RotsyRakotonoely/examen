<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Portefeuille extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function ajouter_argent($idUtilisateur, $montant) {
        $this->db->set('montant', 'montant + ' . $montant, false);
        $this->db->where('iduser', $idUtilisateur);
        $this->db->update('portefeuille');
    }
    
    
    public function get_solde($iduser) {
        $this->db->select('montant');
        $this->db->where('iduser', $iduser);
        $query = $this->db->get('portefeuille');
    
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->montant;
        }
    
        return 0;
    }
    
}
