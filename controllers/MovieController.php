<?php 
    function adminMovie(){
		$movies = Movie::GetMovie() ; 
        require_once('views/movie/read.php') ; 
	}

	function libraryMovie(){
		$movies = Movie::GetMovie(); 
		require_once('views/movie/library.php') ; 
	}

	function addMovie(){
		$fonction = "Ajouter";
		if(isset($_POST['title']) && isset($_POST['author'])&& isset($_POST['disponibility'])&& isset($_POST['duration']) && isset($_POST['genre'])){
			$titre = $_POST['title'] ; 
			$auteur = $_POST['author'] ; 
            $disponible = $_POST['disponibility'];
            $duration = $_POST['duration'];
			$genre = $_POST['genre'];

			if(!empty($titre)&&!empty($auteur) && !empty($disponible) && !empty($duration) && !empty($genre)){
				$movie = new Movie($titre, $auteur, $disponible, $duration, $genre); 
				$movie = Movie::create($titre, $auteur, $disponible, $duration, $genre) ; 
				echo '<script>window.location.href = "/Medianeth/Movie/adminMovie";</script>';
			}else{
				$message = "champ vide" ; 
			}
		}
		require_once('views/movie/form.php');
	}

	function updateMovie($id){
		$fonction = "Modifier";
		$movie = Movie::GetMovieById($id) ;  
		$title = $movie['title'];
		$author = $movie['author'];
		$disponibility = $movie['disponibility'];
		$duration = $movie['duration'];
		$genre = $movie['genre'];
		
		if(isset($_POST['movie_id'])){
			$id = $_POST['movie_id'];
			$movie = Movie::GetMovieById($id) ;
			$title = $movie['title'];
			$author = $movie['author'];
			$disponibility = $movie['disponibility'];
			$duration = $movie['duration'];
			$genre = $movie['genre'];
			if(!empty($movie)){
				if(isset($_POST['title']) && isset($_POST['author'])&& isset($_POST['disponibility'])&& isset($_POST['duration']) && isset($_POST['genre'])){
					$titre = $_POST['title'] ; 
					$auteur = $_POST['author'] ; 
					$disponible = $_POST['disponibility'];
					$duration = $_POST['duration'];
					$genre = $_POST['genre'];

					if(!empty($titre)&& !empty($auteur) && !empty($disponible) && !empty($duration) && !empty($genre)){
						$movie = Movie::update($id, $titre, $auteur, $disponible, $duration, $genre);
						echo '<script>window.location.href = "/Medianeth/Movie/adminMovie";</script>'; 
					}else{
						$message = "champ vide";
					}
				}else{
					$message =  "remplir tous les champs " ; 
				}
			}else{
				$message = "objet vide"; 
			}
		}
		require_once('views/movie/form.php');
	}

	function deleteMovie(){
		if(isset($_POST['movie_id'])){
			$id = $_POST['movie_id'] ; 
			$movie = Movie::GetMovieById($id) ;  
			if(!empty($movie)){
				if(isset($_POST['ask'])){ 
					$movie = Movie::delete($id) ;  
					echo '<script>window.location.href = "/Medianeth/Movie/adminMovie/";</script>';
				}
			}else{ 
				$message= "suppression annuler" ; 
			}	
		}else{
			$message="Test";
		}
		require_once('views/movie/delete.php');
    }
