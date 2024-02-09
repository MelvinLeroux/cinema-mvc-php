<?php

namespace App\Models;
use PDO;
use App\Utils\Database;

Class Movie{
    private $background_url;
    private $composer_id;
    private $director_id;
    private $id;
    private $poster_url;
    private $rating;
    private $release_date;
    private $title;
    private $synopsis;

    /* -------------
    --- getters ---
    --------------*/
    
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
    public function getComposerId()
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
    public function getReleasedate()
    {
        $original_date = $this->release_date;
        $newDate = date("d-m-Y", strtotime($original_date));
        
        return $newDate;
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
    ------------------------*/

    public function searchByTitle($params)
    {
        // on récupère PDO depuis Database
        $pdo = Database::getPDO();
        // la requête
        $sql = "SELECT * FROM `movies` WHERE `title` lIKE '%$params%' ORDER BY title" ;
        // on excéute la requête via PDO, on récupère un objet $pdoStatement
        $pdoStatement = $pdo->query($sql);
        // on utilise fetchAll pour récupérer les données depuis $pdoStatement
        $movies = $pdoStatement->fetchAll(PDO::FETCH_CLASS, Movie::class);
        
        // on renvoie les données à l'appelant (le contrôleur)
        return $movies;
    }
        
    public function findMovie($id)
    {
        // on récupère PDO depuis Database
        $pdo = Database::getPDO();
        // la requête
        $sql = "SELECT * FROM `movies` WHERE `id`= $id ";
        // on excéute la requête via PDO, on récupère un objet $pdoStatement
        $pdoStatement = $pdo->query($sql);
        // on utilise fetchAll pour récupérer les données depuis $pdoStatement
        $movie = $pdoStatement->fetchObject(self::class);

        // on renvoie les données à l'appelant (le contrôleur)
        return $movie;
    }       
}