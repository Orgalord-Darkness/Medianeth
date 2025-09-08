<?php 

    function leven($tab, $recherche){
        $resultats = [];
        $shortest = 2; 
        $i = 0; 
        foreach($tab as $item){
            if(str_contains(strtolower($item["title"]), strtolower($recherche))){
                $resultats[$i] = $item; 
                $i += 1; 
            }else{
                $valeur = $item["title"]; 
                $mots = explode(" ",$valeur); 
                foreach($mots as $mot){
                    $lev = levenshtein(strtolower($mot), strtolower($recherche));
                    if($lev == 0 ){
                        $resultats[$i] = $item; 
                        $i += 1; 
                    }
                    if($lev < $shortest || $shortest < 0){
                        $resultats[$i] = $item ;
                        $i += 1; 
                        $shortest = $lev; 
                    }elseif($lev == $shortest){
                        $resultats[$i] = $item; 
                    }
                }
            }
        }
        return $resultats; 
    }
    
    $count = 0; 
    $media  = $books; 
    $fields = "book";
    if(isset($_POST['media']) && !empty($_POST['media'])){
        $filtre = $_POST['media'];
        switch($filtre) :
            case 'Book': 
                $count = count($books); 
                $media  = $books; 
                $fields = "book";
                break; 
            case 'Movie': 
                $count = count($movies); 
                $media = $movies; 
                $fields = "movie";
                break ; 
            
            case 'Album': 
                $count = count($albums); 
                $media = $albums; 
                $fields = "album";
                break; 
            
            default : 
                $count = count($books); 
                $media  = $books; 
                $fields = "book";
        endswitch ; 
        if(isset($_POST['search']) && !empty($_POST['search'])){
            $search = $_POST['search'];
            $recherches = leven($media, $search); 
            $media = $recherches; 
        }
    }
?>

<html>
    <body>
        <div class="container my-4">
            <div class="row">
                <div class="col">
                    <form method="POST">
                        <div class="row">
                            <div class="col">
                                <label for="search" class="form-label visually-hidden">Rechercher</label>
                                <input type="text" name="search" value="<?php if(isset($search)){ echo $search ;}?>" class="form-control form-control-lg" placeholder="Rechercher un titre...">
                            </div>
                             <div class="col mb-0">
                                <label for="filtre" class="form-label visually-hidden">Media</label>
                                <select name="media" class="form-select form-select-lg">
                                    <option value="<?php if(isset($filre)){ echo $filtre; }?>"><?php if(isset($filtre)){ echo $filtre;}else{ echo "Choisir un media" ; } ?></option>
                                    <option value="Book">Livre</option>
                                    <option value="Movie">Film</option>
                                    <option value="Album">Album</option>
                                </select>
                            </div>
                            <div class="col">
                                <input type="submit" class="btn btn-primary btn-lg" name="rechercher" value="Rechercher">
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        <div class="container my-4">
            <div class="row g-4">
                <?php 
                if(isset($media)):
                    foreach($media as $row): 
                        if($row['disponibility'] == true){
                            $dispo = "emprunter"; 
                            $status = "Disponible";
                        }else{
                            $dispo = "rendre";
                            $status = "Indisponible";
                        }
                ?>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-header bg-primary text-white text-center py-2">
                            <h5 class="mb-0 text-truncate"><?php echo $row['title']; ?></h5>
                        </div>
                        <div class="card-body">
                            <p class="mb-1"><strong>Auteur :</strong> <?php echo $row['author']; ?></p>
                            <p class="mb-1"><strong>Disponibilité :</strong> 
                                <span class="<?= $row['disponibility'] ? 'text-success' : 'text-danger' ?>">
                                    <?php echo $status; ?>
                                </span>
                            </p>
                            <?php 
                            if ($fields === 'book') {
                                echo "<p class='mb-1'><strong>Nombre de pages :</strong> ".$row['pageNumber']."</p>";
                                $idString = "book_id"; 
                            } elseif ($fields === 'movie') {
                                echo "<p class='mb-1'><strong>Durée du film :</strong> ".$row['duration']."h</p>";
                                echo "<p class='mb-1'><strong>Genre :</strong> ".$row['genre']."</p>";
                                $idString = "movie_id"; 
                            } elseif ($fields === 'album') {
                                echo "<p class='mb-1'><strong>Nombre de chansons :</strong> ".$row['songNumber']."</p>";
                                echo "<p class='mb-1'><strong>Éditeur :</strong> ".$row['editor']."</p>";
                                $idString = "album_id"; 
                            }
                            ?>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex align-item-center justify-content-center">
                                <form action='/Medianeth/Home/<?php echo $dispo; ?>' method="post">
                                    <input type="hidden" name="id" value="<?php echo $row[$idString]; ?>">
                                    <input type="hidden" name="type" value="<?php echo $fields; ?>">
                                    <input class = "btn btn-primary "type="submit" name="<?php echo $dispo; ?>" value="<?php echo $dispo; ?>"/>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
                    endforeach;
                endif; 
                ?>
            </div>
        </div>
    </body>
<html>