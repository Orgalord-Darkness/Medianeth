<?php 
    $count = count($books); 
    $media  = $books; 
    $fields = "book";
    if(isset($_GET['media']) && !empty($_GET['media'])){
        $filtre = $_GET['media'];
        switch($filtre) :
            case 'Book': 
                $count = count($books); 
                $media  = $books; 
                $fields = "book"; 
            case 'Movie': 
                $count = count($movies); 
                $media = $movies; 
                $fields = "movie"; 
            
            case 'Album': 
                $count = count($albums); 
                $media = $albums; 
                $fields = "album"; 
            
            default : 
                $count = count($books); 
                $media  = $books; 
                $fields = "book";
        endswitch ; 
            
    }

?>

<html>
    <body>
        <form class="form">
            <label for="filtre">Media : </label>
            <select name = "media" class="form-control">
                <option value="Book">Livre</option>
                <option value="Movie">Film</option>
                <option value="Album">Album</option>
            </select>
            <input type="submit" class="btn btn-primary" name="filtrer">
        </form>

        <?php 
            if(isset($media)):
                foreach($media as $row): 
                    if($row['disponibility'] == true){
                        $dispo = 'Disponible' ; 
                    }else{
                        $dispo = 'Indisponible' ; 
                    }   
            ?>
                <div class="card w-12">
                    <div class="card-header">
                        <h1 class="text-center"><?php echo $row['title'] ; ?></h1>
                    </div>
                    <div class="card-body">
                        <h2 class="text-center">Auteur : <?php echo $row['author'] ; ?></h2>
                        <h2 class="text-center">Disponibilité : <?php echo $dispo ; ?></h2>
                        <?php 
                            if ($fields === 'book') {
                                echo "<h2 class='text-center'>Nombre de pages : ".$row['pageNumber']."</h2>" ;
                            } elseif ($fields === 'movie') {
                                echo "<h2 class='text-center'>Durée du film : ".$row['duration']."</h2>" .
                                    "<h2 class='text-center'>Genre : ".$row['genre']."</h2>" ;
                            } elseif ($fields === 'album') {
                                echo "<h2 class='text-center'>Nombre de chansons : ".$row['songNumber']."</h2>" .
                                    "<h2 class='text-center'>Editeur : ".$row['editor']."</h2>" ;
                            }

                        ?>
                    </div>
                </div>
        <?php 
                endforeach ;
            endif; 
        ?>
    </body>
<html>