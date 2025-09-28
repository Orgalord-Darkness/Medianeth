<html>
    <body>
        <div class="container my-4">
            <h1>Bonjour <?php if(isset($_SESSION['login'])): echo $_SESSION['login'] ; endif ?></h1>
        </div>
        
        <div class="container my-4">
            <div class="card shadow-sm bg-primary-subtle">
                <div class="card-header text-center bg-primary text-white">
                    <h4>Recherche de livres</h4>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="title" class="form-label">Titre</label>
                                <input type="text" name="title" class="form-control" value="<?php echo isset($title) ? $title : ''; ?>" placeholder="Rechercher un titre...">
                            </div>
                            <div class="col-md-6">
                                <label for="author" class="form-label">Auteur</label>
                                <input type="text" name="author" class="form-control" value="<?php echo isset($author) ? $author : ''; ?>" placeholder="Rechercher un auteur...">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="dispo" class="form-label">Disponibilité</label>
                                <select name="dispo" class="form-select">
                                    <option value="" selected>Toutes les disponibilités</option>
                                    <option value="1" <?php echo isset($dispo) && $dispo == 1 ? 'selected' : ''; ?>>Disponible</option>
                                    <option value="0" <?php echo isset($dispo) && $dispo == 0 ? 'selected' : ''; ?>>Indisponible</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="n1" class="form-label">Plage de pages (de)</label>
                                <input type="number" name="n1" class="form-control" value="<?php echo isset($n1) ? $n1 : ''; ?>" placeholder="Page de départ">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="n2" class="form-label">Plage de pages (à)</label>
                                <input type="number" name="n2" class="form-control" value="<?php echo isset($n2) ? $n2 : ''; ?>" placeholder="Page d'arrivée">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 d-flex align-items-end">
                                <input type="hidden" name="media-book" value="Book"/>
                                <input type="submit" name="rechercher" class="btn btn-primary w-100" value="Rechercher">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <h1>Livres : </h1>
            <div class="row g-4">
                <?php 
                if(isset($books)):
                    foreach($books as $row): 
                        if($row['disponibility'] == true){
                            $dispo = "emprunter"; 
                            $status = "Disponible";
                        }else{
                            $dispo = "rendre";
                            $status = "Indisponible";
                        }
                ?>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card h-100 shadow border-1">
                        <div class="card-header bg-primary text-white text-center py-2">
                            <h5 class="mb-0 text-truncate"><?php echo $row['title']; ?></h5>
                        </div>
                        <div class="card-body">
                             <img src="<?= htmlspecialchars($row['link'] ?? ''); ?>" 
                                alt="<?= htmlspecialchars($row['name'] ?? ''); ?>" 
                                class="img-fluid mb-3" style="max-height:200px; object-fit:cover;"
                                loading="lazy">
                            <p class="mb-1"><strong>Auteur :</strong> <?php echo $row['author']; ?></p>
                            <p class="mb-1"><strong>Disponibilité :</strong> 
                               <?php if ($row['disponibility']): ?>
                                  <span class="badge bg-success">Disponible</span>
                              <?php else: ?>
                                  <span class="badge bg-danger">Indisponible</span>
                              <?php endif; ?>
                            </p>
                            <?php 
                                echo "<p class='mb-1'><strong>Nombre de pages :</strong> ".$row['pageNumber']."</p>";
                                $idString = "book_id"; 
                            ?>
                        </div>
                        <div class="card-footer d-flex">
                            <div class="d-flex col align-item-center justify-content-center">
                                <form action='/Medianeth/Home/<?php echo $dispo; ?>' method="post">
                                    <input type="hidden" name="id" value="<?php echo $row[$idString]; ?>">
                                    <input type="hidden" name="type" value="<?php echo "book"; ?>">
                                     <input type="hidden" name="page" value="dashboard"/>
                                    <input  title="emprunter ou rendre le média" class = "btn btn-primary "type="submit" name="<?php echo $dispo; ?>" value="<?php echo $dispo; ?>"/>
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
        
        <div class="container my-4">
            <div class="card shadow-sm bg-primary-subtle">
                <div class="card-header text-center bg-primary text-white">
                    <h4>Recherche de Films</h4>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="title" class="form-label">Titre</label>
                                <input type="text" name="title" id="title" class="form-control" value="<?php echo isset($title) ? $title : ''; ?>" placeholder="Rechercher un titre...">
                            </div>
                            <div class="col-md-6">
                                <label for="author" class="form-label">Auteur</label>
                                <input type="text" name="author" id="author" class="form-control" value="<?php echo isset($author) ? $author : ''; ?>" placeholder="Rechercher un auteur...">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="dispo" class="form-label">Disponibilité</label>
                                <select name="dispo" id="dispo" class="form-select">
                                    <option value="" selected>Toutes les disponibilités</option>
                                    <option value="1" <?php echo isset($dispo) && $dispo == 1 ? 'selected' : ''; ?>>Disponible</option>
                                    <option value="0" <?php echo isset($dispo) && $dispo == 0 ? 'selected' : ''; ?>>Indisponible</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="n1" class="form-label">Durée (de)</label>
                                <input type="number" name="n1" id="n1" class="form-control" value="<?php echo isset($n1) ? $n1 : ''; ?>" placeholder="Durée minimale en minutes">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="n2" class="form-label">Durée (à)</label>
                                <input type="number" name="n2" id="n2" class="form-control" value="<?php echo isset($n2) ? $n2 : ''; ?>" placeholder="Durée maximale en minutes">
                            </div>
                            <div class="col-md-6">
                                <label for="genre" class="form-label">Genre</label>
                                <input type="text" name="genre" id="genre" class="form-control" value="<?php echo isset($genre) ? $genre : ''; ?>" placeholder="Rechercher un genre...">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 d-flex align-items-end">
                                <input type="hidden" name="media-movie" value="Movie"/>
                                <input type="submit" name="rechercher" class="btn btn-primary w-100" value="Rechercher">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <h1>Films : </h1>
            <div class="row g-4">
                <?php 
                if(isset($movies)):
                    foreach($movies as $row): 
                        if($row['disponibility'] == true){
                            $dispo = "emprunter"; 
                            $status = "Disponible";
                        }else{
                            $dispo = "rendre";
                            $status = "Indisponible";
                        }
                ?>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card h-100 shadow border-1">
                        <div class="card-header bg-primary text-white text-center py-2">
                            <h5 class="mb-0 text-truncate"><?php echo $row['title']; ?></h5>
                        </div>
                        <div class="card-body">
                             <img src="<?= htmlspecialchars($row['link'] ?? ''); ?>" 
                                alt="<?= htmlspecialchars($row['name'] ?? ''); ?>" 
                                class="img-fluid mb-3" style="max-height:200px; object-fit:cover;" loading="lazy">
                            <p class="mb-1"><strong>Auteur :</strong> <?php echo $row['author']; ?></p>
                            <p class="mb-1"><strong>Disponibilité :</strong> 
                                <?php if ($row['disponibility']): ?>
                                  <span class="badge bg-success">Disponible</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Indisponible</span>
                                <?php endif; ?>
                            </p>
                            <?php 
                                echo "<p class='mb-1'><strong>Durée du film :</strong> ".$row['duration']."h</p>";
                                echo "<p class='mb-1'><strong>Genre :</strong> ".$row['genre']."</p>";
                                $idString = "movie_id"; 
    
                            ?>
                        </div>
                        <div class="card-footer d-flex">
                            <div class="d-flex col align-item-center justify-content-center">
                                <form action='/Medianeth/Home/<?php echo $dispo; ?>' method="post">
                                    <input type="hidden" name="id" value="<?php echo $row[$idString]; ?>">
                                    <input type="hidden" name="type" value="<?php echo "movie"; ?>">
                                    <input type="hidden" name="page" value="library"/>
                                    <input  title="emprunter ou rendre le média" class = "btn btn-primary "type="submit" name="<?php echo $dispo; ?>" value="<?php echo $dispo; ?>"/>
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
        
        <div class="container my-4">
            <h1>Albums : </h1>
            <form method="POST">
                <div class="container my-4">
                    <div class="card shadow bg-primary-subtle">
                        <div class="card-header text-center bg-primary text-white">
                            <h4>Recherche d'album</h4>
                        </div>
                        <div class="card-body bg-light">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="title" class="form-label">Titre</label>
                                    <input type="text" name="title" class="form-control" placeholder="Titre de l'album" value="<?php if (isset($title)) echo $title; ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="author" class="form-label">Auteur</label>
                                    <input type="text" name="author" class="form-control" placeholder="Auteur de l'album" value="<?php if (isset($author)) echo $author; ?>">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="dispo" class="form-label">Disponibilité</label>
                                    <select name="dispo" id="dispo" class="form-select">
                                        <option value="">Choisir la disponibilité</option>
                                        <option value="1" <?php if (isset($dispo) && $dispo == 1) echo 'selected'; ?>>Disponible</option>
                                        <option value="0" <?php if (isset($dispo) && $dispo == 0) echo 'selected'; ?>>Indisponible</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="songNumberStart" class="form-label">Nombre de chansons (de)</label>
                                    <input type="number" name="n1" class="form-control" placeholder="Min." value="<?php if (isset($n1)) echo $n1; ?>">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="songNumberEnd" class="form-label">Nombre de chansons (à)</label>
                                    <input type="number" name="n2" class="form-control" placeholder="Max." value="<?php if (isset($n2)) echo $n2; ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="editor" class="form-label">Éditeur</label>
                                    <input type="text" name="editor" class="form-control" placeholder="Éditeur de l'album" value="<?php if (isset($editor)) echo $editor; ?>">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12 d-flex align-items-end">
                                    <input type="hidden" name="media-album" value="Album"/>
                                    <button type="submit" name="rechercher" class="btn btn-primary w-100">Rechercher</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>


            <div class="row g-4">
                <?php 
                if(isset($albums)):
                    foreach($albums as $row): 
                        if($row['disponibility'] == true){
                            $dispo = "emprunter"; 
                            $status = "Disponible";
                        }else{
                            $dispo = "rendre";
                            $status = "Indisponible";
                        }
                ?>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card h-100 shadow border-1">
                        <div class="card-header bg-primary text-white text-center py-2">
                            <h5 class="mb-0 text-truncate"><?php echo $row['title']; ?></h5>
                        </div>
                        <div class="card-body">
                             <img src="<?= htmlspecialchars($row['link'] ?? ''); ?>" 
                                alt="<?= htmlspecialchars($row['name'] ?? ''); ?>" 
                                class="img-fluid mb-3" style="max-height:200px; object-fit:cover;" loading="lazy">
                            <p class="mb-1"><strong>Auteur :</strong> <?php echo $row['author']; ?></p>
                            <p class="mb-1"><strong>Disponibilité :</strong> 
                                <?php if ($row['disponibility']): ?>
                                  <span class="badge bg-success">Disponible</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Indisponible</span>
                                <?php endif; ?>
                            </p>
                            <?php 
                                echo "<p class='mb-1'><strong>Nombre de chansons :</strong> ".$row['songNumber']."</p>";
                                echo "<p class='mb-1'><strong>Éditeur :</strong> ".$row['editor']."</p>";
                                $idString = "album_id"; 
                            ?>
                        </div>
                        <div class="card-footer d-flex justify-content-between align-items-center gap-2">
                            <form action="/Medianeth/Home/<?php echo $dispo; ?>" method="post" class="m-0">
                                <input type="hidden" name="id" value="<?php echo $row[$idString]; ?>">
                                <input type="hidden" name="type" value="album">
                                <input type="hidden" name="page" value="library"/>
                                <input title="Emprunter ou rendre le média" class="btn btn-primary btn-sm" type="submit" name="<?php echo $dispo; ?>" 
                                    value="<?php echo $dispo; ?>"/>
                            </form>
                            <a class="btn btn-primary btn-sm d-flex align-items-center justify-content-center square-icon-button" title="En savoir plus" 
                            href="/Medianeth/Home/showAlbum/<?php echo $row[$idString]; ?>">
                                <i class="fa-solid fa-info"></i>
                            </a>
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