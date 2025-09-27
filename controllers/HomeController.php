<?php 

	function leven($tab, $recherche){
		$resultats = [];
		$shortest = 2; 
		$i = 0; 
		foreach($tab as $item){
			if(str_contains(strtolower($item["title"]), strtolower($recherche))){
				$resultats[$i] = $item; 
				$i += 1; 
			}else{
				$valeur = $item["title"]; 
				$mots = explode(" ",$valeur); 
				foreach($mots as $mot){
					$lev = levenshtein(strtolower($mot), strtolower($recherche));
					if($lev == 0 ){
						$resultats[$i] = $item; 
						$i += 1; 
					}
					if($lev < $shortest || $shortest < 0){
						$resultats[$i] = $item ;
						$i += 1; 
						$shortest = $lev; 
					}elseif($lev == $shortest){
						$resultats[$i] = $item; 
					}
				}
			}
		}
		return $resultats; 
	}

	function library(){
		$type="Book";
		$default="Book";
		$count = 0; 
		$books = Book::GetBook();
		$movies = Movie::GetMovie();
		$albums = Album::GetAlbum();
		if(isset($_POST['default']) && !empty($_POST['default'])){
			$type = $_POST['default'];
			$default = $_POST['default'];
		}elseif(isset($_POST['media']) && !empty($_POST['media'])){
			$type= $_POST['media'];
		}
		if(isset($_POST['order'])){
			$order = $_POST['order'];
		}else{
			$order = "ASC";
		}
		switch($type) :
			case 'Book': 
				$count = count($books); 
				if(!empty($order)){
					$media = Book::GetBookByOrder($order);
				}else{
					$media  = $books; 
				}
				$fields = "book";
				$default = "Book";
				break; 
			case 'Movie': 
				$count = count($movies); 
				if(!empty($order)){
					$media = Movie::GetMovieByOrder($order);
				}else{
					$media  = $movies; 
				}
				$fields = "movie";
				$default = "Movie";
				break ; 
			
			case 'Album': 
				$count = count($albums); 
				if(!empty($order)){
					$media = Album::GetAlbumByOrder($order);
				}else{
					$media  = $albums; 
				}
				$fields = "album";
				$default = "Album";
				break; 
			default : 
				$count = count($books); 
				$media  = $books; 
				$fields = "book";
				$default = "Book";
		endswitch ; 
		
		if(isset($_POST['search']) && !empty($_POST['search'])){
			$search = $_POST['search'];
			$recherches = leven($media, $search); 
			$media = $recherches; 
		}
		require_once('views/home/library.php') ; 
	}

	function showAlbum($id){
		if(isset($id) && !empty($id)){
			$album_id = $id; 
			$album = Album::GetAlbumById($album_id);
			if(!empty($album)){
				$songs = Song::GetSongByAlbumId($album_id);
				if(empty($songs)){
					$message = "<p class='text-danger'>Aucune chanson dans l'album</p>";
				}
			}
		}
		require_once('views/home/show_album.php');

	}

	function dashboard(){
		$books = Book::getBook();
		$movies = Movie::getMovie();
		$albums = Album::getAlbum();

		require_once('views/home/dashboard.php');

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

		echo '<script>window.location.href = "/Medianeth/Home/library";</script>';
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
		echo '<script>window.location.href = "/Medianeth/Home/library";</script>';
	}