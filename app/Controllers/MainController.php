<?php 

namespace App\Controllers;

use App\Models\Movie as ModelsMovie;
use App\Models\People;
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
    public function movieAction($params){
        $movieModel = new ModelsMovie();
        $peopleModel = new People();
        $movieTodisplay = $movieModel->findMovie($params['id']);
        $directorToDisplay = $peopleModel->findDirectorByMovie($params['id']);
        $composerToDIsplay = $peopleModel->findComposerByMovie(($params['id']));
        $actorsToDisplay = $peopleModel->findactorsbyMovie($params['id']);
        $this->show ('details/movie',['movie' => $movieTodisplay,'director' => $directorToDisplay, 'composer'=>$composerToDIsplay, 'actors'=>$actorsToDisplay,]);
    }
}