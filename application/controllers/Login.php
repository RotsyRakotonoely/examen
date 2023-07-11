<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Log'); // Charger le modèle
    }

    public function login() {
        // Initialiser la variable $data
        $data = array();
    
        // Vérifier si le formulaire a été soumis
        if ($this->input->post()) {
            $email = $this->input->post('email');
            $mdp = $this->input->post('mdp');
    
            // Appeler la méthode de modèle pour vérifier les informations de connexion
            $user = $this->Log->login($email, $mdp);
    
            if ($user) {
                if ($email == 'admin' && $mdp == 'admin') {
                    // Identifiants admin valides, rediriger vers le backend
                    $this->session->set_userdata('user', $user[0]);
                    redirect('pageback');
                } else {
                    // Rediriger l'utilisateur vers une page sécurisée ou une page de profil
                    $this->session->set_userdata('user', $user[0]);
                    redirect('home');
                }
            } else {
                // Identifiants de connexion invalides, afficher un message d'erreur
                $data['error'] = 'Identifiants de connexion invalides.';
            }
        }
    
        // Charger la vue du formulaire de connexion
        $this->load->view('login', $data);
    }

    public function inscription() {
        $this->load->view('inscription');
        $data = array();
        // Vérifier si le formulaire d'inscription a été soumis
        if ($this->input->post()) {
            // Récupérer les données du formulaire
            $email = $this->input->post('email');
            $mdp = $this->input->post('mdp');
            $nom = $this->input->post('nom');
            $genre = $this->input->post('genre');
            $taille = $this->input->post('taille');
            $poids = $this->input->post('poids');
    
            // Appeler la méthode du modèle pour insérer l'utilisateur
            $this->Log->inscription($email, $nom, $mdp, $genre, $taille, $poids, 0);
    
            // Rediriger vers une page de confirmation ou de connexion
            redirect(''); // Remplacez "page_confirmation" par l'URL de la page souhaitée
        }
    
        $this->load->view('login', $data);
    }
    
    public function logout() {
        // Supprimer les informations utilisateur de la session
        $this->session->unset_userdata('user');

        // Rediriger l'utilisateur vers la page de connexion
        redirect('');
    }
}
?>
