<?php 

namespace App\Controllers;

use App\Models\Movie;
use App\Models\People;

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
            $homeSearch = new Movie();
            $result = $homeSearch->searchByTitle($params);   
        }
        else {
            echo "Erreur 404 - la page n'existe pas";
        }
        $data = [];
        $data['result'] = $result;        
        $this->show('main/result', $data);
    }
    public function movieAction($id){
        $movieModel = new Movie();
        $peopleModel = new People();
        $movieTodisplay = $movieModel->findMovie($id);
        $directorToDisplay = $peopleModel->findDirectorByMovie($id);
        $composerToDIsplay = $peopleModel->findComposerByMovie($id);
        $actorsToDisplay = $peopleModel->findactorsbyMovie($id);
        
        $this->show ('details/movie',['movie' => $movieTodisplay,'director' => $directorToDisplay, 'composer'=>$composerToDIsplay, 'actors'=>$actorsToDisplay,]);
    }
}