<?php 

	function library(){
		$books = Book::GetBook();
		$movies = Movie::GetMovie();
		$albums = Album::GetAlbum();
		
		require_once('views/home/library.php') ; 
	}

	function rendre(){
		if(isset($_POST['id']) && isset($_POST['type'])){
			if(!empty($_POST['id']) && !empty($_POST['type'])){
				$id = $_POST['id'];
				$type = $_POST['type'];

				switch($type):
					case 'book' : 
						$book = Book::getBookById($id);
						$book = Book::rendre($id); 
						break ; 
					case 'movie' : 
						$movie = Movie::getMovieById($id);
						$movie = Movie::rendre($id);
						break ;
					case 'album' :
						$album = Album::getAlbumById($id); 
						$album = Album::rendre($id);   

				endswitch; 
			}
		}

		$books = Book::GetBook();
		$movies = Movie::GetMovie();
		$albums = Album::GetAlbum();
		require_once('views/home/library.php');
	}

	function emprunter(){
		if(isset($_POST['id']) && isset($_POST['type'])){
			if(!empty($_POST['id']) && !empty($_POST['type'])){
				$id = $_POST['id'];
				$type = $_POST['type'];

				switch($type):
					case 'book' : 
						$book = Book::getBookById($id);
						$book =Book::emprunter($id); 
						break ; 
					case 'movie' : 
						$movie = Movie::getMovieById($id);
						$movie = Movie::emprunter($id); 
						break ;
					case 'album' :
						$album = Album::getAlbumById($id); 
						$album = Album::emprunter($id);   

				endswitch; 
			}
		}
		$books = Book::GetBook();
		$movies = Movie::GetMovie();
		$albums = Album::GetAlbum();
		require_once('views/home/library.php');
	}