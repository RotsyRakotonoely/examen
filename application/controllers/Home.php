<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    // public function __construct() {
    //     parent::__construct();
    //     $this->load->model('Log');
    //     // Charger d'autres modèles ou bibliothèques si nécessaire
    // }

    public function index() {
        // Vérifier si l'utilisateur est connecté
        if ($this->session->userdata('user')) {
            // Utilisateur connecté, récupérer les informations de la session
            $user = $this->session->userdata('user');
    
            // Charger la vue home.php avec les informations de l'utilisateur
            $data['user'] = $user;
            $this->load->view('home', $data);
        } else {
            // Utilisateur non connecté, rediriger vers la page de connexion
            redirect('Login');
        }
    }
    
    
    
    

}
?>
