<?php
    class Movie extends Media{

        private int $songNumber; 
        private string $editor ; 

        public function __construct($titre, $auteur, $disponible,$songNumber, $editor){
            $this->songNumber = $songNumber; 
            $this->editor = $editor; 
            parent::__construct($titre, $auteur, $disponible);
        }

        public function getSongNumber(){
            return $this->songNumber; 
        }

        public function setSongNumber(int $songNumber){
            $this->songNumber = $songNumber; 
        }

        public function getEditor(){
            return $this->editor; 
        }

        public function seteditor(string $editor){
            $this->editor = $editor; 
        }


    }