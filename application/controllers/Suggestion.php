<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Suggestion extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Suggest'); // Charger le modèle
        $this->load->model('Portefeuille'); // Charger le modèle
        $this->load->model('Code_model'); // Charger le modèle
    }

public function gain() {
    // Vérifier si l'utilisateur est connecté
    if ($this->session->userdata('user')) {
        // Utilisateur connecté, récupérer les informations de la session
        $user = $this->session->userdata('user');

        // Charger les données pour la vue
        $data['user'] = $user;
        $data['plus'] = $this->Suggest->gagner();

        // Obtenir le solde du portefeuille de l'utilisateur
        $data['solde'] = $this->Portefeuille->get_solde($user['iduser']);

        // Charger la vue suggestion.php avec les données
        $this->load->view('suggestion', $data);
    } else {
        // Utilisateur non connecté, rediriger vers la page de connexion
        redirect('Login');
    }
}

public function perte() {
    // Vérifier si l'utilisateur est connecté
    if ($this->session->userdata('user')) {
        // Utilisateur connecté, récupérer les informations de la session
        $user = $this->session->userdata('user');

        // Charger les données pour la vue
        $data['user'] = $user;
        $data['plus'] = $this->Suggest->perdre();

        // Obtenir le solde du portefeuille de l'utilisateur
        $data['solde'] = $this->Portefeuille->get_solde($user['iduser']);

        // Charger la vue suggestion.php avec les données
        $this->load->view('suggestion', $data);
    } else {
        // Utilisateur non connecté, rediriger vers la page de connexion
        redirect('Login');
    }
}

public function ajouter_argent() {
    $code = $this->input->post('code');
    $iduser = $this->session->userdata('iduser');

    $this->load->model('Code_model');
    $montant = $this->Code_model->get_valeur_code($code); // Récupérer le montant du code

    if ($montant > 0) {
        $this->Code_model->set_code_utilise($code); // Marquer le code comme utilisé

        $this->load->model('Portefeuille');
        $this->Portefeuille->ajouter_argent($iduser, $montant); // Ajouter le montant au portefeuille de l'utilisateur

        redirect('home'); // Rediriger vers la page de suggestion avec un message de succès
    } else {
        redirect('home'); // Rediriger vers la page de suggestion avec un message d'erreur
    }
}




}

?>
