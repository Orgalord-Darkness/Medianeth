<?php 

function library(){
        $books = Book::GetBook();
        $movies = Movie::GetMovie();
		$albums = Album::GetAlbum();
        
		require_once('views/home/library.php') ; 
	}