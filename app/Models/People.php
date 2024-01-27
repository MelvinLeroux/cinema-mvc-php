<?php

namespace App\Models;
use App\Utils\Database;
use PDO;
Class People {
    private $id;
    private $name;
    private $picture_url;
    private $title;
    
    public function findDirectorByMovie($id){
        $pdo = Database::getPDO();
            // la requête
            $sql = 'SELECT  people.name, people.picture_url, movies.title
            FROM `movies`
            INNER JOIN `people` ON movies.director_id = people.id where movies.id ='.$id.' ORDER BY movies.title;' ;
            // on excéute la requête via PDO, on récupère un objet $pdoStatement
            $pdoStatement = $pdo->query($sql);
            // on utilise fetchAll pour récupérer les données depuis $pdoStatement
            $director = $pdoStatement->fetchObject(self::class);
            dump($director);
            return $director;
    }

    public function findComposerByMovie($id){
        $pdo = Database::getPDO();
            // la requête
            $sql = 'SELECT  people.name, people.picture_url
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
    public function getPicture_url()
    {
        return $this->picture_url;
    }

    /**
     * Set the value of picture_url
     *
     * @return  self
     */ 
    public function setPicture_url($picture_url)
    {
        $this->picture_url = $picture_url;

        return $this;
    }
}
