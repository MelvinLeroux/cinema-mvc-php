<?php

namespace App\Models;
use App\Utils\Database;
use PDO;
Class People {
    private $id;
    private $name;
    private $picture_url;
    private $actor_id;
    private $movie_id;
    private $order;
    private $release_date;
    private $title;
    private $synopsis;
    private $rating;
    private $poster_url;
    private $background_url;
    private $director_id;
    private $composer_id;
    
    public function findDirectorByMovie($id){
        $pdo = Database::getPDO();

            // la requête
            $sql = 'SELECT  people.id, people.name, people.picture_url, movies.title
            FROM `movies`
            INNER JOIN `people` ON movies.director_id = people.id where movies.id ='.$id.' ORDER BY movies.title;' ;
            // on excéute la requête via PDO, on récupère un objet $pdoStatement
            $pdoStatement = $pdo->query($sql);
            // on utilise fetchAll pour récupérer les données depuis $pdoStatement
            $director = $pdoStatement->fetchObject(self::class);
            return $director;
    }
    public function findComposerByMovie($id){
        $pdo = Database::getPDO();

            // la requête
            $sql = 'SELECT  people.id, people.name, people.picture_url
            FROM `movies`
            INNER JOIN `people` ON movies.composer_id = people.id where movies.id ='.$id.' ORDER BY movies.title;' ;
            // on excéute la requête via PDO, on récupère un objet $pdoStatement
            $pdoStatement = $pdo->query($sql);
            // on utilise fetchAll pour récupérer les données depuis $pdoStatement
            $composer = $pdoStatement->fetchObject(self::class);
           
            if (isset($composer)){   
            return $composer;
           } else 
            return false;
                

    }

    public function findactorsbyMovie($id){
        $pdo = Database::getPDO();

            // la requête
            $sql = "SELECT p.id, p.name, p.picture_url FROM people p INNER JOIN movie_actors a ON a.actor_id = p.id INNER JOIN movies m ON m.id = a.movie_id WHERE m.id = $id ORDER BY a.order ASC" ;
            // on excéute la requête via PDO, on récupère un objet $pdoStatement
            $pdoStatement = $pdo->query($sql);
            // on utilise fetchAll pour récupérer les données depuis $pdoStatement
            $actors = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);
            
            return $actors;
    }
    

    public function actorPlayedIn ($actorId){

        $sql = "SELECT * FROM people p INNER JOIN movie_actors a ON a.actor_id = p.id INNER JOIN movies m  ON m.id = a.movie_id WHERE a.actor_id = $actorId";
    
        // Connexion à la BDD
        $pdo = Database::getPDO();
        
        // Exécuter la requete SELECT
        $pdoStatement = $pdo->query($sql);
    
        // Récupérer les résultats sous forme de tableau
        // Retourne une instances de Product
        $movie = $pdoStatement->fetchAll(PDO::FETCH_CLASS,self::class);
    
        // retourner les résultats
        return $movie;
    
    }

    public function moviesDirectedBy ($directorId){

        $sql = "SELECT * FROM people p INNER JOIN movies m  ON p.id = m.director_id WHERE m.director_id = $directorId";
    
        // Connexion à la BDD
        $pdo = Database::getPDO();
        
        // Exécuter la requete SELECT
        $pdoStatement = $pdo->query($sql);
    
        // Récupérer les résultats sous forme de tableau
        // Retourne une instances de Product
        $movie = $pdoStatement->fetchAll(PDO::FETCH_CLASS,self::class);
    
        // retourner les résultats
        return $movie;
    
    }

    public function moviesComposedBy ($composerId){

        $sql = "SELECT * FROM people p INNER JOIN movies m  ON p.id = m.composer_id WHERE m.composer_id = $composerId";
    
        // Connexion à la BDD
        $pdo = Database::getPDO();
        
        // Exécuter la requete SELECT
        $pdoStatement = $pdo->query($sql);
    
        // Récupérer les résultats sous forme de tableau
        // Retourne une instances de Product
        $movie = $pdoStatement->fetchAll(PDO::FETCH_CLASS,self::class);
    
        // retourner les résultats
        return $movie;
    
    }


    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of picture_url
     */ 
    public function getPictureurl()
    {
        return $this->picture_url;
    }

    /**
     * Set the value of picture_url
     *
     * @return  self
     */ 
    public function setPictureurl($picture_url)
    {
        $this->picture_url = $picture_url;

        return $this;
    }

    /**
     * Get the value of composer_id
     */ 
    public function getComposerid()
    {
        return $this->composer_id;
    }

    /**
     * Get the value of actor_id
     */ 
    public function getActorid()
    {
        return $this->actor_id;
    }

    /**
     * Get the value of movie_id
     */ 
    public function getMovieid()
    {
        return $this->movie_id;
    }

    /**
     * Get the value of order
     */ 
    public function getOrder()
    {        

        return $this->order;
    }

    /**
     * Get the value of release_date
     */ 
    public function getRelease_date()
    {
        return $this->release_date;
    }

    /**
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get the value of synopsis
     */ 
    public function getSynopsis()
    {
        return $this->synopsis;
    }

    /**
     * Get the value of rating
     */ 
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Get the value of poster_url
     */ 
    public function getPosterUrl()
    {
        return $this->poster_url;
    }

    /**
     * Get the value of background_url
     */ 
    public function getBackgroundUrl()
    {
        return $this->background_url;
    }

    /**
     * Get the value of director_id
     */ 
    public function getDirectorId()
    {
        return $this->director_id;
    }
}
