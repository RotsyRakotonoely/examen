<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pageback extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('Pageback_model');
    }

    public function index() {
        // Appeler les méthodes du modèle pour récupérer les statistiques
        $statisticsByGender = $this->Pageback_model->getStatisticsByGender();

        // Passer les statistiques à la vue
        $data['statisticsByGender'] = $statisticsByGender;

        // Charger la vue
        $this->load->view('pageback', $data);
    }
}


?>