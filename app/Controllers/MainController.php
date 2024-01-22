<?php 

namespace App\Controllers;

use App\Models\Movie as ModelsMovie;
use Movie;
use PDO;
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
    public function searchAction()
    {
        if (isset($_GET['search'])){
            $params = $_GET['search'];
            $homeSearch = new ModelsMovie();
            $result = $homeSearch->searchByTitle($params);
            
        }
        else {
            echo "Erreur 404 - la page n'existe pas";
        }
        $data = [];
        $data['result'] = $result;        
        $this->show('main/result', $data);
    }
}