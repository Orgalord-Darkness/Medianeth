<?php 
class Book extends Media{
    
    private int $pageNumber; 

    public function __construct($titre, $auteur, $disponible,$pageNumber){
        $this->pageNumber = $pageNumber; 
        parent::__construct($titre, $auteur, $disponible);
    }

    public function getPageNumber(){
        return $this->pageNumber; 
    }

    public function setPageNumber($pageNumber){
        $this->pageNumber = $pageNumber; 
    }


}