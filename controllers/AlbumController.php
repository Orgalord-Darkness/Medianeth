<?php
    function adminAlbum(){
		$albums = Album::GetAlbum() ; 
        require_once('views/album/administration.php') ; 
	}

	function addAlbum(){
		if(isset($_POST['titre']) && isset($_POST['auteur'])&& isset($_POST['disponible'])&& isset($_POST['songNumber']) && isset($_POST['editor'])){
			$titre = $_POST['titre'] ; 
			$auteur = $_POST['auteur'] ; 
            $disponible = $_POST['disponible'];
            $songNumber = $_POST['songNumber'];
            $editor = $_POST['editor'];

			if(!empty($titre)&&!empty($auteur) && !empty($disponible) && !empty($songNumber)&& !empty($editor)){
				$album = new Album($titre, $auteur, $disponible, $songNumber,$editor,  time(), time()); 
				$album = Album::create($titre, $auteur, $disponible,$songNumber,$editor, time(), time()) ; 
				echo '<script>window.location.href = "/medianeth/Administration/Admin/";</script>';
			}
		}else{ 
			echo '<script>window.location.href = "/medianeth/Administration/Admin/";</script>';
		}
	}

	function updateAlbum($id){
		if(isset($_POST['album_id'])){
			$id = $_POST['album_id'] ; 
			$album = Album::GetAlbumById($id) ;  
			if(!empty($album)){
				if(isset($_POST['titre']) && isset($_POST['auteur'])&& isset($_POST['disponible'])&& isset($_POST['songNumber']) && isset($_POST['editor'])){
                    $titre = $_POST['titre'] ; 
                    $auteur = $_POST['auteur'] ; 
                    $disponible = $_POST['disponible'];
                    $songNumber = $_POST['songNumber'];
                    $editor = $_POST['editor'];
                            
					if(!empty($titre)&&!empty($auteur) && !empty($disponible) && !empty($songNumber)&& !empty($editor)){
						$album = Album::update($titre, $auteur, $disponible,$songNumber,$editor, time(), time())  ;  
						echo '<script>window.location.href = "/medianeth/Administration/Admin/";</script>';
					}
				}else{
					echo "remplir tous les champs " ; 
				}
			}
		}
	}

	function deleteAlbum($id){
		if(isset($_POST['album_id'])){
			$id = $_POST['album_id'] ; 
			$album = Album::GetAlbumById($id) ;  
			if(!empty($album)){
				if(isset($_POST['ask'])){ 
					if($_POST['ask'] == 'confirm'){ 
						$album = Album::delete($id) ;  
						echo '<script>window.location.href = "/medianeth/Administration/Admin/";</script>';
					}
				}
			}else{ 
				echo "suppression annuler" ; 
			}	
		}
    }
