<?php

    enum Genre{
        case Action ; 

        case Aventure ; 

        case Comédie ; 

        case Drame ; 

        case Horreur ; 

        case Thriller ; 

        case Fantastique ;

        case ScienceFiction ; 

        case Fantasy ; 

        case Policier ; 

        case Romance ; 

        case Guerre ; 

        case Western ; 

        case Animation ; 

        case Documentaire ; 

        case Biopic ; 

        case Historique ; 
    }
    class Movie extends Media{

        private float $duration; 
        private Genre $genre; 

        public function __construct($titre, $auteur, $disponible,$duration, $genre){
            $this->duration = $duration; 
            $this->genre = $genre; 
            parent::__construct($titre, $auteur, $disponible);
        }

        public function getDuration(){
            return $this->duration; 
        }

        public function setDuration(float $duration){
            $this->duration = $duration; 
        }

        public function getGenre(){
            return $this->genre; 
        }

        public function setGenre(Genre $genre){
            $this->genre = $genre; 
        }


    }