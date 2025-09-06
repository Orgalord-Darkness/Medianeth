<?php 
	include_once('models/Book.php');

    function adminBook(){
		$books = Book::GetBook() ; 
        require_once('views/book/administration.php') ; 
	}

	function libraryBook(){
		$books = Book::GetBook(); 
		require_once('views/ocupancy/library.php') ; 
	}

	function addBook(){
		$fonction = "Ajouter";
		if(isset($_POST['title']) && isset($_POST['author'])&& isset($_POST['disponibility'])&& isset($_POST['pageNumber'])){
			$titre = $_POST['title'] ; 
			$auteur = $_POST['author'] ; 
            $disponible = $_POST['disponibility'];
            $numberPage = $_POST['pageNumber'];

			if(!empty($titre)&&!empty($auteur) && !empty($disponible) && !empty($numberPage)){
				$book = new Book($titre, $auteur, $disponible, $numberPage); 
				$book = Book::create($titre, $auteur, $disponible, $numberPage) ; 
				echo '<script>window.location.href = "/Medianeth/Book/adminBook";</script>';
			}else{
				$message = "champ vide" ; 
			}
		}
		require_once('views/book/add.php');
	}

	function updateBook($id){
		$fonction = "Modifier";
		$book = Book::GetBookById($id) ;  
		$title = $book['title'];
		$author = $book['author'];
		$disponibility = $book['disponibility'];
		$pageNumber = $book['pageNumber'];
		
		if(isset($_POST['book_id'])){
			$id = $_POST['book_id'];
			$book = Book::GetBookById($id) ;  
			if(!empty($book)){
				if(isset($_POST['title']) && isset($_POST['author'])&& isset($_POST['disponibility'])&& isset($_POST['pageNumber'])){
					$titre = $_POST['title'] ; 
					$auteur = $_POST['author'] ; 
					$disponible = $_POST['disponibility'];
					$numberPage = $_POST['pageNumber'];
					if(!empty($titre)&& !empty($auteur) && !empty($disponible) && !empty($numberPage)){
						$book = Book::update($id, $titre, $auteur, $disponible, $numberPage);
						echo '<script>window.location.href = "/Medianeth/Book/adminBook";</script>'; 
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
		require_once('views/book/add.php');
	}

	function deleteBook(){
		if(isset($_POST['book_id'])){
			$id = $_POST['book_id'] ; 
			$book = Book::GetBookById($id) ;  
			if(!empty($book)){
				if(isset($_POST['ask'])){ 
					if($_POST['ask'] == 'Supprimer'){ 
						$book = Book::delete($id) ;  
						echo '<script>window.location.href = "/Medianeth/Book/adminBook";</script>'; 
					}
				}
			}else{ 
				echo "suppression annuler" ; 
			}	
		}
		require_once('views/book/delete.php');
    }
