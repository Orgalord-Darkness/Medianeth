<?php 
class Book extends Media{
    
    private int $pageNumber; 

    public function __construct($pageNumber){
        $this->pageNumber = $pageNumber; 
    }

    public function getPageNumber(){
        return $this->pageNumber; 
    }

    public function setPageNumber($pageNumber){
        $this->pageNumber = $pageNumber; 
    }


}