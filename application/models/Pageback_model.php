<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pageback_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function getTotalUsers() {
        $query = $this->db->query("SELECT COUNT(*) as total FROM users");
        return $query->row()->total;
    }
    
    public function getStatisticsByGender() {
        $totalUsers = $this->getTotalUsers();
    
        $query = $this->db->query("SELECT genre, COUNT(*) as count FROM users GROUP BY genre");
        $results = $query->result();
    
        $statistics = array();
        foreach ($results as $result) {
            $percentage = ($result->count / $totalUsers) * 100;
            $statistics[] = array(
                'genre' => $result->genre,
                'count' => $result->count,
                'percentage' => $percentage
            );
        }
    
        return $statistics;
    }
    
}



?>

