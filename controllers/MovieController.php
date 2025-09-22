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
		$illustrations = Illustration::GetIllustration();
		if(isset($_POST['title']) && isset($_POST['author'])&& isset($_POST['disponibility'])&& isset($_POST['duration']) && isset($_POST['genre'])&& isset($_POST['illustration_id'])){
			$titre = $_POST['title'] ; 
			$auteur = $_POST['author'] ; 
            $disponible = $_POST['disponibility'];
            $duration = $_POST['duration'];
			$genre = $_POST['genre'];
			$illustration_id = $_POST['illustration_id'];
			$get_illustration = Illustration::GetIllustrationById($illustration_id);
			$illustration = new Illustration($get_illustration['name'],$get_illustration['link']);

			if(!empty($titre)&&!empty($auteur) && !empty($disponible) && !empty($duration) && !empty($genre) && !empty($illustration)){
				$movie = new Movie($titre, $auteur, $disponible, $duration, $genre,$illustration); 
				$movie = Movie::create($titre, $auteur, $disponible, $duration, $genre,$illustration_id) ; 
				echo '<script>window.location.href = "/Medianeth/Movie/adminMovie";</script>';
			}else{
				$message = "champ vide" ; 
			}
		}
		require_once('views/movie/form.php');
	}

	function updateMovie($id){
		$fonction = "Modifier";
		$illustrations = Illustration::GetIllustration();
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
				if(isset($_POST['title']) && isset($_POST['author'])&& isset($_POST['disponibility'])&& isset($_POST['duration']) && isset($_POST['genre'])&& isset($_POST['illustration_id'])){
					$titre = $_POST['title'] ; 
					$auteur = $_POST['author'] ; 
					$disponible = $_POST['disponibility'];
					$duration = $_POST['duration'];
					$genre = $_POST['genre'];
					$illustration_id = $_POST['illustration_id'];

					if(!empty($titre)&& !empty($auteur) && !empty($disponible) && !empty($duration) && !empty($genre)&& !empty($illustration_id)){
						$movie = Movie::update($id, $titre, $auteur, $disponible, $duration, $genre,$illustration_id);
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
