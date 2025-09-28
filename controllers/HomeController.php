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
			$order = null; 
		}
		if(isset($_POST['disponibility'])){
			$dispo = $_POST['disponibility'];
		}else{
			$dispo = null;
		}
		switch($type) :
			case 'Book': 
				$count = count($books); 
				if(!empty($dispo)){
					$media = Book::GetBookByDispo($dispo);
				}else{
					$media  = $books; 
				}
				$fields = "book";
				$default = "Book";
				break; 
			case 'Movie': 
				$count = count($movies); 
				if(!empty($dispo)){
					$media = Movie::GetMovieByDispo($dispo);
				}else{
					$media  = $movies; 
				}
				$fields = "movie";
				$default = "Movie";
				break ; 
			
			case 'Album': 
				$count = count($albums); 
				if($order != null){
					$media = Album::GetAlbumByDispo($dispo);
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

		if ($order === 'ASC' || $order === 'DESC') {
			$sortedMedia = $media;
			usort($sortedMedia, function($a, $b) use ($order) {
				$titleA = strtolower($a['title']);
				$titleB = strtolower($b['title']);
				if ($titleA === $titleB) return 0;
				return ($order === 'ASC') ? ($titleA < $titleB ? -1 : 1) : ($titleA > $titleB ? -1 : 1);
			});
			$media = $sortedMedia;
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
		if(isset($_POST['media-book']) && !empty($_POST['media-book'])){
			if(isset($_POST['title']) && isset($_POST['author']) && isset($_POST['dispo']) && isset($_POST['n1']) && isset($_POST['n2'])){
				$title = $_POST['title'];
				$author=$_POST['author'];
				$dispo = $_POST['dispo'];
				$n1 = $_POST['n1'];
				$n2 = $_POST['n2'];
				$books = Book::GetBookBySearch($title, $author, $dispo, $n1, $n2);
			}
		}
		if(isset($_POST['media-movie']) && !empty($_POST['media-movie'])){
			if(isset($_POST['title']) && isset($_POST['author']) && isset($_POST['dispo']) && isset($_POST['n1']) && isset($_POST['n2']) && isset($_POST['genre'])){
				$title = $_POST['title'];
				$author=$_POST['author'];
				$dispo = $_POST['dispo'];
				$n1 = $_POST['n1'];
				$n2 = $_POST['n2'];
				$genre = $_POST['genre'];
				$movies = Movie::GetMovieBySearch($title, $author, $dispo, $n1, $n2,$genre);
			}
		}
		if(isset($_POST['media-album']) && !empty($_POST['media-album'])){
			if(isset($_POST['title']) && isset($_POST['author']) && isset($_POST['dispo']) && isset($_POST['n1']) && isset($_POST['n2']) && isset($_POST['editor'])){
				$title = $_POST['title'];
				$author=$_POST['author'];
				$dispo = $_POST['dispo'];
				$n1 = $_POST['n1'];
				$n2 = $_POST['n2'];
				$editor = $_POST['editor'];
				$albums = Album::GetAlbumBySearch($title, $author, $dispo, $n1, $n2,$editor);
			}
		}
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
		if(isset($_POST['page']) && !empty($_POST['page'])){
			$page = $_POST['page'];
			if($page == "showAlbum"){
				echo '<script>window.location.href = "/Medianeth/Home/'.$page.'/'.$id.'";</script>';
			}
		}
		echo '<script>window.location.href = "/Medianeth/Home/'.$page.'";</script>';
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
		if(isset($_POST['page']) && !empty($_POST['page'])){
			$page = $_POST['page'];
			if($page == "showAlbum"){
				echo '<script>window.location.href = "/Medianeth/Home/'.$page.'/'.$id.'";</script>';
			}
		}
		echo '<script>window.location.href = "/Medianeth/Home/'.$page.'";</script>';
	}