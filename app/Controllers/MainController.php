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
        $data['input']= $params;   
        $this->show('main/result', $data);
    }
    public function movieAction($params){
        $movieModel = new ModelsMovie();
        $movieTodisplay = $movieModel->findMovie($params['id']);
        $peopleModel = new People();
        if ($movieTodisplay) {
        $directorToDisplay = $peopleModel->findDirectorByMovie($params['id']);
        $composerToDIsplay = $peopleModel->findComposerByMovie(($params['id']));
        $actorsToDisplay = $peopleModel->findactorsbyMovie($params['id']);
        }
        $this->show ('details/movie',['movie' => $movieTodisplay,'director' => $directorToDisplay, 'composer'=>$composerToDIsplay, 'actors'=>$actorsToDisplay,]);
    }
    public function directorAction($params)
    {
        // On récupère l'id du réalisateur
        $peopleModel = new People();
        $directedBy = $peopleModel->moviesDirectedBy($params['id']);

        $data = [];

        $data['result'] = $directedBy;
        $data['input']= $data['result'][0]->getName();

        $this->show('main/result', $data);
    }

    /**
     * Méthode qui affiche tous les films d'un compositeur
     * 
     * @param array $urlParams
     * @return void
     */

    public function composerAction($params)
    {
        // On récupère l'id du compositeur
        $peopleModel = new People();
        $composedBy = $peopleModel->moviesComposedBy($params['id']);

        $data = [];

        $data['result'] = $composedBy;
        $data['input']= $data['result'][0]->getName();

        $this->show('main/result', $data);
    }

    /**
     * Méthode qui affiche tous les films d'un acteur
     * 
     * @param array $urlParams
     * @return void
     */

    public function actorAction($params)
    {
        

        // On récupère l'acteur correspondant à l'id
        $peopleModel = new People();
        $actorPlayedIn = $peopleModel->actorPlayedIn($params['id']);
        
        $data = [];
        
        $data['result'] = $actorPlayedIn;
        $data['input']= $data['result'][0]->getName();


        $this->show('main/result', $data);
    }
}