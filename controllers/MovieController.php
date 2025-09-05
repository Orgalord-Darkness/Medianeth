<?php 


    function adminMovie(){
		$movies = Movie::GetMovie() ; 
        require_once('views/administration.php') ; 
	}

	function libraryMovie(){
		$movies = Movie::GetMovie(); 
		require_once('views/movie/library.php') ; 
	}

	function addMovie(){
		if(isset($_POST['titre']) && isset($_POST['auteur'])&& isset($_POST['disponible'])&& isset($_POST['duration']) && isset($_POST['genre'])){
			$titre = $_POST['titre'] ; 
			$auteur = $_POST['auteur'] ; 
            $disponible = $_POST['disponible'];
            $duration = $_POST['duration'];
            $genre = $_POST['genre'];

			if(!empty($titre)&&!empty($auteur) && !empty($disponible) && !empty($duration)&& !empty($genre)){
				$movie = new Movie($titre, $auteur, $disponible, $duration,$genre,  time(), time()); 
				$movie = Movie::create($titre, $auteur, $disponible, $duration,$genre, time(), time()) ; 
				echo '<script>window.location.href = "/medianeth/Administration/Admin/";</script>';
			}
		}else{ 
			echo '<script>window.location.href = "/medianeth/Administration/Admin/";</script>';
		}
	}

	function updateMovie($id){
		if(isset($_POST['movie_id'])){
			$id = $_POST['movie_id'] ; 
			$movie = Movie::GetMovieById($id) ;  
			if(!empty($movie)){
				if(isset($_POST['titre']) && isset($_POST['auteur'])&& isset($_POST['disponible'])&& isset($_POST['duration']) && isset($_POST['genre'])){
                    $titre = $_POST['titre'] ; 
                    $auteur = $_POST['auteur'] ; 
                    $disponible = $_POST['disponible'];
                    $duration = $_POST['duration'];
                    $genre = $_POST['genre'];
                    
					if(!empty($titre)&&!empty($auteur) && !empty($disponible) && !empty($duration)&& !empty($genre)){
						$movie = Movie::update($titre, $auteur, $disponible, $duration,$genre, time(), time())  ;  
						echo '<script>window.location.href = "/medianeth/Administration/Admin/";</script>';
					}
				}else{
					echo "remplir tous les champs " ; 
				}
			}
		}
	}

	function deleteMovie($id){
		if(isset($_POST['movie_id'])){
			$id = $_POST['movie_id'] ; 
			$movie = Movie::GetMovieById($id) ;  
			if(!empty($movie)){
				if(isset($_POST['ask'])){ 
					if($_POST['ask'] == 'confirm'){ 
						$movie = Movie::delete($id) ;  
						echo '<script>window.location.href = "/medianeth/Administration/Admin/";</script>';
					}
				}
			}else{ 
				echo "suppression annuler" ; 
			}	
		}
    }
