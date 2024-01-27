<?php 

namespace App\Controllers;

class CoreController {

    protected $router;
    /**
     * Fonction qui se charge d'afficher une page donnée
     *
     * @param string $viewName Nom du template de page à afficher
     * @param array $viewData Tableau contenant les différentes informations qu'on veut passer à notre vue
     * @return void
     */
    public function __construct($routerFromIndex)
    {
        $this->router = $routerFromIndex;
    }
    // Pour sécuriser encore plus notre code, on peut obliger les paramètres à avoir un certain type. Ici, en écrivant "array" devant $viewData, on oblige le 2ème paramètre à etre un tableau.
    public function show($viewName, array $viewData = [])
    {
        $router = $this->router;

        // Sur toutes les pages, on a besoin d'avoir accès à la variable $absoluteUrl. Celle-ci contient le chemin vers le dossier public et permet de générer les liens vers les assets.
        // $absoluteUrl = $_SERVER['BASE_URI'];

        $viewData['currentPage'] = $viewName;

        // définir l'url absolue pour nos assets
        $viewData['assetsBaseUri'] = $_SERVER['BASE_URI'] . '/';
        // définir l'url absolue pour la racine du site
        // /!\ != racine projet, ici on parle du répertoire public/
        $viewData['baseUri'] = $_SERVER['BASE_URI'];
     
        extract($viewData);

        require_once __DIR__ . '/../views/layout/header.tpl.php';
        require_once __DIR__ . '/../views/' . $viewName . '.tpl.php';
        require_once __DIR__ . '/../views/layout/footer.tpl.php';
    }
    
}