<?php
    function adminAlbum(){
		$albums = Album::GetAlbum() ; 
        require_once('views/album/read.php') ; 
	}

	function addAlbum(){
		$fonction = "Ajouter";
		$illustrations = Illustration::getIllustration();
		if(isset($_POST['title']) && isset($_POST['author'])&& isset($_POST['disponibility'])&& isset($_POST['songNumber']) && isset($_POST['editor'])&& isset($_POST['illustration_id'])){
			$titre = $_POST['title'] ; 
			$auteur = $_POST['author'] ; 
            $disponible = $_POST['disponibility'];
            $songNumber = $_POST['songNumber'];
            $editor = $_POST['editor'];
			$illustration_id = $_POST['illustration_id'];

			$get_illustration = Illustration::GetIllustrationById($illustration_id);
			$illustration = new Illustration($get_illustration['name'],$get_illustration['link']);

			if(!empty($titre)&&!empty($auteur) && !empty($disponible) && !empty($songNumber)&& !empty($editor) && !empty($illustration)){
				$album = new Album($titre, $auteur, $disponible, $songNumber,$editor,$illustration); 
				$album = Album::create($titre, $auteur, $disponible,$songNumber,$editor,$illustration_id) ; 
				echo '<script>window.location.href = "/Medianeth/Album/adminAlbum/";</script>';
			}else{
				$message ='Champ vide';
			}
		}
		require_once('views/album/form.php');
	}

	function updateAlbum($id){
		$fonction = "Modifer";
		$illustrations = Illustration::getIllustration();
		$album = Album::getAlbumById($id);
		$title = $album['title'] ; 
		$author = $album['author'] ; 
		$disponible = $album['disponibility'];
		$songNumber = $album['songNumber'];
		$editor = $album['editor'];
		if(isset($_POST['album_id'])){
			$id = $_POST['album_id'] ; 
			$album = Album::GetAlbumById($id) ;  
			if(!empty($album)){
				if(isset($_POST['title']) && isset($_POST['author'])&& isset($_POST['disponibility'])&& isset($_POST['songNumber']) && isset($_POST['editor'])&& isset($_POST['illustration_id'])){
                    $title = $_POST['title'] ; 
					$author = $_POST['author'] ; 
					$disponible = $_POST['disponibility'];
					$songNumber = $_POST['songNumber'];
					$editor = $_POST['editor'];
					$illustration_id = $_POST['illustration_id'];

					if(!empty($title)&&!empty($author) && !empty($disponible) && !empty($songNumber)&& !empty($editor) && !empty($illustration_id)){
						$album = Album::update($id, $title, $author, $disponible,$songNumber,$editor,$illustration_id)  ;  
						echo '<script>window.location.href = "/Medianeth/Album/adminAlbum/";</script>';
					}else{
						$message="Champ vide" ; 
					}
				}
			}
		}
		require_once('views/album/form.php');
	}

	function deleteAlbum(){
		if(isset($_POST['album_id'])){
			$id = $_POST['album_id'] ; 
			$album = Album::GetAlbumById($id) ;  
			if(!empty($album)){
				if(isset($_POST['ask'])){ 
					$song = Song::GetSongByAlbumId($id);
					if(empty($song)){
						$album = Album::delete($id) ;  
						echo '<script>window.location.href = "/Medianeth/Album/adminAlbum/";</script>';
					}else{
						$message = "Impossible de supprimer, cette album contient des chansons non supprimé";
					}
				}
			}else{ 
				$message= "suppression annuler" ; 
			}	
		}
		require_once('views/album/delete.php');
    }
