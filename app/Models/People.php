<?php

namespace App\Models;
use App\Utils\Database;
use PDO;

Class People {
    private $actor_id;
    private $background_url;
    private $composer_id;
    private $director_id;
    private $id;
    private $movie_id;
    private $name;
    private $order;
    private $picture_url;
    private $poster_url;
    private $rating;
    private $release_date;
    private $synopsis;
    private $title;
    
    /* -------------
    --- getters ---
    --------------*/

    /**
     * Get the value of actor_id
     */ 
    public function getActorid()
    {
        return $this->actor_id;
    }

    /**
     * Get the value of background_url
     */ 
    public function getBackgroundUrl()
    {
        return $this->background_url;
    }

    /**
     * Get the value of composer_id
     */ 
    public function getComposerid()
    {
        return $this->composer_id;
    }

    /**
     * Get the value of director_id
     */ 
    public function getDirectorId()
    {
        return $this->director_id;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of movie_id
     */ 
    public function getMovieid()
    {
        return $this->movie_id;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the value of order
     */ 
    public function getOrder()
    {        

        return $this->order;
    }

    /**
     * Get the value of picture_url
     */ 
    public function getPictureurl()
    {
        return $this->picture_url;
    }

    /**
     * Get the value of poster_url
     */ 
    public function getPosterUrl()
    {
        return $this->poster_url;
    }

    /**
     * Get the value of rating
     */ 
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Get the value of release_date
     */ 
    public function getRelease_date()
    {
        return $this->release_date;
    }

    /**
     * Get the value of synopsis
     */ 
    public function getSynopsis()
    {
        return $this->synopsis;
    }

    /**
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /* ---------------------
    --- Database methods ---
    -----------------------*/

    public function findDirectorByMovie($id)
    {
        // on récupère PDO depuis Database
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

    public function findComposerByMovie($id)
    {
        // on récupère PDO depuis Database
        $pdo = Database::getPDO();
        // la requête
        $sql = 'SELECT  people.id, people.name, people.picture_url
        FROM `movies`
        INNER JOIN `people` ON movies.composer_id = people.id where movies.id ='.$id.' ORDER BY movies.title;' ;
        // on excéute la requête via PDO, on récupère un objet $pdoStatement
        $pdoStatement = $pdo->query($sql);
        // on utilise fetchAll pour récupérer les données depuis $pdoStatement
        $composer = $pdoStatement->fetchObject(self::class);      
        
        if (isset($composer)) {  
            return $composer;
        } 

        return false;
    }

    public function findactorsbyMovie($id)
    {
        // on récupère PDO depuis Database
        $pdo = Database::getPDO();
        // la requête
        $sql = "SELECT p.id, p.name, p.picture_url FROM people p INNER JOIN movie_actors a ON a.actor_id = p.id INNER JOIN movies m ON m.id = a.movie_id WHERE m.id = $id ORDER BY a.order ASC" ;
        // on exécute la requête via PDO, on récupère un objet $pdoStatement
        $pdoStatement = $pdo->query($sql);
        // on utilise fetchAll pour récupérer les données depuis $pdoStatement
        $actors = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);
        
        // on renvoie les données à l'appelant (le contrôleur)
        return $actors;
    }

    public function actorPlayedIn ($actorId)
    {
        // on récupère PDO depuis Database
        $pdo = Database::getPDO();
        // la requête
        $sql = "SELECT * FROM people p INNER JOIN movie_actors a ON a.actor_id = p.id INNER JOIN movies m  ON m.id = a.movie_id WHERE a.actor_id = $actorId";
        // on exécute la requête via PDO, on récupère un objet $pdoStatement
        $pdoStatement = $pdo->query($sql);
        // on utilise fetchAll pour récupérer les données depuis $pdoStatement
        $movie = $pdoStatement->fetchAll(PDO::FETCH_CLASS,self::class);
        
        // on renvoie les données à l'appelant (le contrôleur)
        return $movie;
    }

    public function moviesDirectedBy ($directorId)
    {
        // on récupère PDO depuis Database
        $pdo = Database::getPDO();
        // la requête
        $sql = "SELECT * FROM people p INNER JOIN movies m  ON p.id = m.director_id WHERE m.director_id = $directorId";
        // on exécute la requête via PDO, on récupère un objet $pdoStatement
        $pdoStatement = $pdo->query($sql);
        // on utilise fetchAll pour récupérer les données depuis $pdoStatement
        $movie = $pdoStatement->fetchAll(PDO::FETCH_CLASS,self::class);
        
        // on renvoie les données à l'appelant (le contrôleur)
        return $movie;
    }

    public function moviesComposedBy ($composerId)
    {
        // on récupère PDO depuis Database
        $pdo = Database::getPDO();
        // la requête
        $sql = "SELECT * FROM people p INNER JOIN movies m  ON p.id = m.composer_id WHERE m.composer_id = $composerId";    
        // on exécute la requête via PDO, on récupère un objet $pdoStatement
        $pdoStatement = $pdo->query($sql);
        // on utilise fetchAll pour récupérer les données depuis $pdoStatement
        $movie = $pdoStatement->fetchAll(PDO::FETCH_CLASS,self::class);
        
        // on renvoie les données à l'appelant (le contrôleur)    
        return $movie;
    }
}
