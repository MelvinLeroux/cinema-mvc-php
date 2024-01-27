<?php

namespace App\Models;
use PDO;
use App\Utils\Database;

Class Movie{
    private $id;
    private $title;
    private $synopsis;
    private $release_date;
    private $rating;
    private $poster_url;
    private $background_url;
    private $director_id;
    private $composer_id;
    private $composer;
    private $director;


    
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
     * Get the value of title
     */ 
    public function getTitle()
    {
        return $this->title;
    }
    
    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title)
    {
        $this->title = $title;
        
        return $this;
    }
    
    /**
     * Get the value of synopsis
     */ 
    public function getSynopsis()
    {
        return $this->synopsis;
    }
    
    /**
     * Set the value of synopsis
     *
     * @return  self
     */ 
    public function setSynopsis($synopsis)
    {
        $this->synopsis = $synopsis;
        
        return $this;
    }
    
    /**
     * Get the value of release_date
     */ 
    public function getReleasedate()
    {
        return $this->release_date;
    }
    
    /**
     * Set the value of release_date
     *
     * @return  self
     */ 
    public function setRelease_date($release_date)
    {
        $this->release_date = $release_date;
        
        return $this;
    }
    
    /**
     * Get the value of rating
     */ 
    public function getRating()
    {
        return $this->rating;
    }
    
    /**
     * Set the value of rating
     *
     * @return  self
     */ 
    public function setRating($rating)
    {
        $this->rating = $rating;
        
        return $this;
    }
    
    /**
     * Get the value of poster_url
     */ 
    public function getPosterUrl()
    {
        return $this->poster_url;
    }

    /**
     * Set the value of poster_url
     *
     * @return  self
     */ 
    public function setPosterUrl($poster_url)
    {
        $this->poster_url = $poster_url;
        
        return $this;
    }
    
    
    
    /**
     * Get the value of director_id
     */ 
    public function getDirectorId()
    {
        return $this->director_id;
    }
    
    /**
     * Set the value of director_id
     *
     * @return  self
     */ 
    public function setDirectorId($director_id)
    {
        $this->director_id = $director_id;
        
        return $this;
    }
    
    /**
     * Get the value of composer_id
     */ 
    public function getComposerId()
    {
        return $this->composer_id;
    }
    
    /**
     * Set the value of composer_id
     *
     * @return  self
     */ 
    public function setComposerId($composer_id)
    {
        $this->composer_id = $composer_id;
        
        return $this;
    }
    
    /**
     * Get the value of background_url
     */ 
    public function getBackgroundUrl()
    {
        return $this->background_url;
    }
    
    /**
     * Set the value of background_url
     *
     * @return  self
     */ 
    public function setBackgroundUrl($background_url)
    {
        $this->background_url = $background_url;
        
        return $this;
    }
    
    /**
     * Get the value of composer
     */ 
    public function getComposer()
    {
    return new People ($this->composer);
    }

    /**
     * Set the value of composer
     *
     * @return  self
     */ 
    public function setComposer($composer)
    {
        $this->composer = $composer;
        
        return $this;
    }
    
    /**
     * Get the value of director
     */ 
    public function getDirector()
    {
        return new People ($this->director);
    }
    
    /**
     * Set the value of director
     *
     * @return  self
     */ 
    public function setDirector($director)
    {
                $this->director = $director;
                
                return $this;
    }

    public function getActors()
    {
        return new People ($this->director);
    }
    
    /**
     * Set the value of director
     *
     * @return  self
     */ 
    public function setActors($director)
    {
                $this->director = $director;
                
                return $this;
    }

    public function searchByTitle($params)
        {
            // on récupère PDO depuis Database
            $pdo = Database::getPDO();
            // la requête
            $sql = "SELECT * FROM `movies` WHERE `title` lIKE '%$params%'";
            // on excéute la requête via PDO, on récupère un objet $pdoStatement
            $pdoStatement = $pdo->query($sql);
            // on utilise fetchAll pour récupérer les données depuis $pdoStatement
            $movies = $pdoStatement->fetchAll(PDO::FETCH_CLASS, Movie::class);
            
            // on renvoie les données à l'appelant (le contrôleur)
            return $movies;
        }
        
    public function findMovie($id){
        $pdo = Database::getPDO();
            // la requête
            $sql = "SELECT * FROM `movies` WHERE `id`= $id ";
            // on excéute la requête via PDO, on récupère un objet $pdoStatement
            $pdoStatement = $pdo->query($sql);
            // on utilise fetchAll pour récupérer les données depuis $pdoStatement
            $movie = $pdoStatement->fetchObject(self::class);
            return $movie;
    }
        
}