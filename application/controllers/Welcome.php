<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    // public function __construct() {
    //     parent::__construct();
    //     $this->load->model('Log'); // Charger le modèle
    // }

    public function index() {
        // Charger la vue du formulaire de connexion
        $this->load->view('login');
    }
}
?>
