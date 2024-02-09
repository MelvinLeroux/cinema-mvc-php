<?php 

namespace App\Controllers;
use App\Models\Movie as ModelsMovie;
use App\Models\People;

class MainController extends CoreController {
    /**
    * Méthode qui se charge d'afficher la page d'accueil
    */
    public function homeAction()
    {  
        $this->show('main/home');
    }

    /**
    * Méthode qui se charge d'afficher les résultats d'une recherche
    */
    public function searchAction()
    {
        if (isset($_GET['search'])){
            $params = $_GET['search'];
            $homeSearch = new ModelsMovie();
            $result = $homeSearch->searchByTitle($params);
        } else {
            echo "Erreur 404 - la page n'existe pas";
        }

        $data = [];
        $data['result'] = $result;     
        $data['input']= $params;   

        $this->show('main/result', $data);
    }

    /**
    * Méthode qui se charge d'afficher les détails d'un film
    */
    public function movieAction($params)
    {
        $movieModel = new ModelsMovie();
        $movieTodisplay = $movieModel->findMovie($params);
        $peopleModel = new People();

        if ($movieTodisplay) {
            $directorToDisplay = $peopleModel->findDirectorByMovie($params);
            $composerToDisplay = $peopleModel->findComposerByMovie(($params));
            $actorsToDisplay = $peopleModel->findactorsbyMovie($params);

            $this->show(
                'details/movie',
                [
                    'movie' => $movieTodisplay,
                    'director' => $directorToDisplay,
                    'composer'=>$composerToDisplay,
                    'actors'=>$actorsToDisplay,
                ]
            );
        } else {
            $this->show('error/error404');
        }
    }

    /**
    * Méthode qui se charge d'afficher les films d'un réalisateur
    */
    public function directorAction($params)
    {
        // On récupère l'id du réalisateur
        $peopleModel = new People();
        $directedBy = $peopleModel->moviesDirectedBy($params);

        $data = [];

        $data['result'] = $directedBy;
        $data['input']= $data['result'][0]->getName();

        $this->show('main/result', $data);
    }

    /**
    * Méthode qui se charge d'afficher les films d'un compositeur
    */
    public function composerAction($params)
    {
        // On récupère l'id du compositeur
        $peopleModel = new People();
        $composedBy = $peopleModel->moviesComposedBy($params);

        $data = [];

        $data['result'] = $composedBy;
        $data['input']= $data['result'][0]->getName();

        $this->show('main/result', $data);
    }

    /**
    * Méthode qui se charge d'afficher les films d'un compositeur
    */
    public function actorAction($params)
    {
        // On récupère l'id de l'acteur
        $peopleModel = new People();
        $actorPlayedIn = $peopleModel->actorPlayedIn($params);
        $data = []; 
        $data['result'] = $actorPlayedIn;
        $data['input']= $data['result'][0]->getName();

        $this->show('main/result', $data);
    }
}