<?php 

namespace App\Controllers;

class MainController extends CoreController {

    /**
     * Méthode qui se charge d'afficher la page d'accueil
     *
     * @return void
     */
    public function homeAction()
    {
        dump('string');
        $this->show('main/home');
    }
}