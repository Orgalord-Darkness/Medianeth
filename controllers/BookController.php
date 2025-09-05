<?php 


    function adminBook(){
		$books = Book::GetBook() ; 
        require_once('views/administration.php') ; 
	}

	function libraryBook(){
		$books = Book::GetBook(); 
		require_once('views/ocupancy/library.php') ; 
	}

	function addBook(){
		if(isset($_POST['titre']) && isset($_POST['auteur'])&& isset($_POST['disponible'])&& isset($_POST['numberPage'])){
			$titre = $_POST['titre'] ; 
			$auteur = $_POST['auteur'] ; 
            $disponible = $_POST['disponible'];
            $numberPage = $_POST['numberPage'];

			if(!empty($titre)&&!empty($auteur) && !empty($disponible) && !empty($numberPage)){
				$book = new Book($titre, $auteur, $disponible, $numberPage, time(), time()); 
				$book = Book::create($titre, $auteur, $disponible, $numberPage, time(), time()) ; 
				echo '<script>window.location.href = "/medianeth/Administration/Admin/";</script>';
			}
		}else{ 
			echo '<script>window.location.href = "/medianeth/Administration/Admin/";</script>';
		}
	}

	function updateBook($id){
		if(isset($_POST['book_id'])){
			$id = $_POST['book_id'] ; 
			$book = Book::GetBookById($id) ;  
			if(!empty($book)){
				if(isset($_POST['titre']) && isset($_POST['auteur'])&& isset($_POST['disponible'])&& isset($_POST['numberPage'])){
                    $titre = $_POST['titre'] ; 
                    $auteur = $_POST['auteur'] ; 
                    $disponible = $_POST['disponible'];
                    $numberPage = $_POST['numberPage']; 
					if(!empty($titre)&&!empty($auteur) && !empty($disponible) && !empty($numberPage)){
						$book = Book::update($titre, $auteur, $disponible, $numberPage, time(), time())  ;  
						echo '<script>window.location.href = "/medianeth/Administration/Admin/";</script>';
					}
				}else{
					echo "remplir tous les champs " ; 
				}
			}
		}
	}

	function deleteBook($id){
		if(isset($_POST['book_id'])){
			$id = $_POST['book_id'] ; 
			$book = Book::GetBookById($id) ;  
			if(!empty($book)){
				if(isset($_POST['ask'])){ 
					if($_POST['ask'] == 'confirm'){ 
						$book = Book::delete($id) ;  
						echo '<script>window.location.href = "/medianeth/Administration/Admin/";</script>';
					}
				}
			}else{ 
				echo "suppression annuler" ; 
			}	
		}
    }
