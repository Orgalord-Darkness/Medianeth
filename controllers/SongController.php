<?php 
	include_once('models/Song.php');
    include_once('models/Album.php');

    function adminSong(){
		$songs = Song::GetSong() ; 
        $albums = Album::GetAlbum();
        require_once('views/song/administration.php') ; 
	}

	function addSong(){
		$fonction = "Ajouter";
        $albums = Album::getAlbum();
		if(isset($_POST['title']) && isset($_POST['note'])&& isset($_POST['duration'])&& isset($_POST['album_id'])){
			$title = $_POST['title'] ; 
			$note = $_POST['note'] ; 
            $duration = $_POST['duration'];
            $album_id = $_POST['album_id'];

			if(!empty($title)&&!empty($note) && !empty($duration) && !empty($album_id)){
                $getAlbum = Album::getAlbumById($album_id);
				$getIllustration = Illustration::GetIllustrationById($getAlbum['illustration_id']);
				$illustration = new Illustration($getIllustration['name'], $getIllustration['link']);
                $album = new Album($getAlbum['title'], $getAlbum['author'], $getAlbum['disponibility'], $getAlbum['songNumber'], $getAlbum['editor'],$illustration);
                if(!empty($getAlbum)){
                    $song = new Song($title, $note, $duration, $album); 
                    $song = Song::create($title, $note, $duration, $album_id); 
                }
				echo '<script>window.location.href = "/Medianeth/Song/adminSong";</script>';
			}else{
				$message = "champ vide" ; 
			}
		}
		require_once('views/song/form.php');
	}

	function updateSong($id){
		$fonction = "Modifier";
        $albums = Album::GetAlbum();
		$song = Song::GetSongById($id) ;  
		$title = $song['title'];
		$note = $song['note'];
		$duration = $song['duration'];
		$album_id = $song['album_id'];
		
		if(isset($_POST['song_id'])){
			$id = $_POST['song_id'];
			$song = Song::GetSongById($id) ;  
			if(!empty($song)){
				if(isset($_POST['title']) && isset($_POST['note'])&& isset($_POST['duration'])&& isset($_POST['album_id'])){
					$title = $_POST['title'] ; 
                    $note = $_POST['note'] ; 
                    $duration = $_POST['duration'];
                    $album_id = $_POST['album_id'];

                    if(!empty($title)&&!empty($note) && !empty($duration) && !empty($album_id)){
						$song = Song::update($id, $title, $note, $duration, $album_id); 
						echo '<script>window.location.href = "/Medianeth/Song/adminSong";</script>'; 
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
		require_once('views/song/form.php');
	}

	function deleteSong(){
		if(isset($_POST['song_id'])){
			$id = $_POST['song_id'] ; 
			$song = Song::GetSongById($id) ;  
			if(!empty($song)){
				if(isset($_POST['ask'])){ 
					if($_POST['ask'] == 'Supprimer'){ 
						$song = Song::delete($id) ;  
						echo '<script>window.location.href = "/Medianeth/Song/adminSong";</script>'; 
					}
				}
			}else{ 
				echo "suppression annuler" ; 
			}	
		}
		require_once('views/song/delete.php');
    }
