<?php 
namespace App\Controllers;

class CoreController {
    protected $router;
    
    /** Fonction qui se charge de dispatcher */
    public function __construct($routerFromIndex)
    {
        $this->router = $routerFromIndex;   
    }

    /**
     * Fonction qui se charge d'afficher une page donnée
     * Pour sécuriser encore plus notre code, on peut obliger les paramètres à avoir un certain type. Ici, en écrivant "array" devant $viewData, on oblige le 2ème paramètre à etre un tableau.
     * @param string $viewName Nom du template de page à afficher
     * @param array $viewData Tableau contenant les différentes informations qu'on veut passer à notre vue
     * @return void
     */
    public function show($viewName, array $viewData = [])
    {
        $router = $this->router;
        // Sur toutes les pages, on a besoin d'avoir accès à la variable $absoluteUrl.
        $absoluteUrl = $_SERVER['BASE_URI'];
        $viewData['currentPage'] = $viewName;
        // définir l'url absolue pour la racine du site
        // On veut désormais accéder aux données de $viewData, mais sans accéder au tableau
        // La fonction extract permet de créer une variable pour chaque élément du tableau passé en argument
        extract($viewData);
        // => la variable $currentPage existe désormais, et sa valeur est $viewName
        // => il en va de même pour chaque élément du tableau
        // $viewData est disponible dans chaque fichier de vue
        require_once __DIR__ . '/../views/layout/header.tpl.php';
        require_once __DIR__ . '/../views/' . $viewName . '.tpl.php';
        require_once __DIR__ . '/../views/layout/footer.tpl.php';
    }
}