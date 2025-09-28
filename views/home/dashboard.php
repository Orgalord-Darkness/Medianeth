<html>
    <body>
        <div class="container my-4">
            <h1>Bonjour <?php if(isset($_SESSION['login'])): echo $_SESSION['login'] ; endif ?></h1>
            <div class="row">
                <div class="col">
                    <form method="POST">
                        <div class="row">
                            <div class="col">
                                <label for="search" class="form-label">Rechercher</label>
                                <input type="text" name="search" value="<?php if(isset($search)){ echo $search ;}?>" class="form-control form-control-lg" placeholder="Rechercher un titre...">
                            </div>
                            <div class="col mb-0">
                                <label for="order" class="form-label">Trier le titre par ordre</label>
                                <select name="order" class="form-select form-select-lg">
                                    <option value="null">Choisir l'ordre</option>
                                    <option value="ASC">A - Z</option>
                                    <option value="DESC">Z - A</option>
                                </select>
                            </div>
                            <div class="col">
                                <input title="lancer la recherche" type="submit" class="btn btn-primary btn-lg" name="rechercher" value="Rechercher">
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        
        <div class="container my-4">
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
                    <div class="card h-100 shadow-sm border-0">
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
                                <span class="<?= $row['disponibility'] ? 'text-success' : 'text-danger' ?>">
                                    <?php echo $status; ?>
                                </span>
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
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-header bg-primary text-white text-center py-2">
                            <h5 class="mb-0 text-truncate"><?php echo $row['title']; ?></h5>
                        </div>
                        <div class="card-body">
                             <img src="<?= htmlspecialchars($row['link'] ?? ''); ?>" 
                                alt="<?= htmlspecialchars($row['name'] ?? ''); ?>" 
                                class="img-fluid mb-3" style="max-height:200px; object-fit:cover;" loading="lazy">
                            <p class="mb-1"><strong>Auteur :</strong> <?php echo $row['author']; ?></p>
                            <p class="mb-1"><strong>Disponibilité :</strong> 
                                <span class="<?= $row['disponibility'] ? 'text-success' : 'text-danger' ?>">
                                    <?php echo $status; ?>
                                </span>
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
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-header bg-primary text-white text-center py-2">
                            <h5 class="mb-0 text-truncate"><?php echo $row['title']; ?></h5>
                        </div>
                        <div class="card-body">
                             <img src="<?= htmlspecialchars($row['link'] ?? ''); ?>" 
                                alt="<?= htmlspecialchars($row['name'] ?? ''); ?>" 
                                class="img-fluid mb-3" style="max-height:200px; object-fit:cover;" loading="lazy">
                            <p class="mb-1"><strong>Auteur :</strong> <?php echo $row['author']; ?></p>
                            <p class="mb-1"><strong>Disponibilité :</strong> 
                                <span class="<?= $row['disponibility'] ? 'text-success' : 'text-danger' ?>">
                                    <?php echo $status; ?>
                                </span>
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