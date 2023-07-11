<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Code_model extends CI_Model {

    public function get_code_by_value($code) {
        $this->db->where('code', $code);
        $query = $this->db->get('code');
    
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
    
        return false;
    }
    
    public function marquer_code_utilise($idCode) {
        $this->db->where('idCode', $idCode);
        $this->db->set('utilise', 1);
        $this->db->update('code');
    }

    public function is_code_utilise($code) {
        $this->db->where('code', $code);
        $query = $this->db->get('code');
        return $query->num_rows() > 0;
    }
    
    public function get_code_by_id($idCode) {
        return $this->db->get_where('code', array('idCode' => $idCode))->row_array();
    }
    

    public function set_code_utilise($code) {
        $this->db->where('code', $code);
        $this->db->update('code', array('utilise' => 1));
    }

    public function get_valeur_code($code) {
        $this->db->select('valeur');
        $this->db->where('code', $code);
        $query = $this->db->get('code');
        $result = $query->row();
        return $result->valeur;
    }

    public function is_code_valid($code) {
        $query = $this->db->get_where('code', array('code' => $code, 'utilise' => 0));
        return $query->num_rows() > 0;
    }    
    
    public function is_code_invalid($code) {
        $query = $this->db->get_where('code', array('code' => $code));
        $result = $query->row();
        return $result && $result->utilise == 1;
    }
    
    
    
    
}
