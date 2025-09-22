<?php 
	include_once('models/Illustration.php');

    function adminIllustration(){
		$illustrations = Illustration::GetIllustration();
        require_once('views/illustration/administration.php') ; 
	}

	function addIllustration(){
		$fonction = "Ajouter";
        $illustrations = Illustration::getIllustration();
		if(isset($_POST['name']) && isset($_POST['link'])){
			$name = $_POST['name'] ; 
			$link = $_POST['link'] ; 

			if(!empty($name)&&!empty($link)){
                $illustration = new Illustration($name, $link); 
                $illustration = Illustration::create($name, $link); 
                echo '<script>window.location.href = "/Medianeth/Illustration/adminIllustration";</script>';
			}else{
				$message = "champ vide" ; 
			}
		}
		require_once('views/illustration/form.php');
	}

	function updateIllustration($id){
		$fonction = "Modifier";
		$illustration = Illustration::GetIllustrationById($id) ;  
		$name = $illustration['name'];
		$link = $illustration['link'];
		
		if(isset($_POST['illustration_id'])){
			$id = $_POST['illustration_id'];
			$illustration = Illustration::GetIllustrationById($id) ;  
			if(!empty($illustration)){
				if(isset($_POST['name']) && isset($_POST['link'])){
                    $name = $_POST['name'] ; 
                    $link = $_POST['link'] ; 

                    if(!empty($name)&&!empty($link)){
						$illustration = Illustration::update($id, $name, $link); 
						echo '<script>window.location.href = "/Medianeth/Illustration/adminIllustration";</script>'; 
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
		require_once('views/illustration/form.php');
	}

	function deleteIllustration(){
		if(isset($_POST['illustration_id'])){
			$id = $_POST['illustration_id'] ; 
			$illustration = Illustration::GetIllustrationById($id) ;  
			if(!empty($illustration)){
				if(isset($_POST['ask'])){ 
					if($_POST['ask'] == 'Supprimer'){ 
						$illustration = Illustration::delete($id) ;  
						echo '<script>window.location.href = "/Medianeth/Illustration/adminIllustration";</script>'; 
					}
				}
			}else{ 
				echo "suppression annuler" ; 
			}	
		}
		require_once('views/illustration/delete.php');
    }
