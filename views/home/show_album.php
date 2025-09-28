<div class="container my-5">
    <div class="row justify-content-center">
        <?php 
        if (isset($album)):
            $dispo = $album['disponibility'] ? "emprunter" : "rendre"; 
            $status = $album['disponibility'] ? "Disponible" : "Indisponible";
        ?>
        <div class="col-12 col-lg-10">
            <div class="card p-4 shadow-lg custom-card text-center">
                <div class="mb-4">
                    <h2 class="mt-3"><?= htmlspecialchars($album['title']) ?></h2>
                    <img src="<?= htmlspecialchars($album['link'] ?? ''); ?>" 
                         alt="<?= htmlspecialchars($album['name'] ?? ''); ?>" 
                         class="img-fluid rounded shadow-sm album-image mx-auto d-block"
                         loading="lazy">
                </div>
                <div class="row text-start">
                    <div class="col-md-6 mb-3">
                        <h5 class="mb-3">Informations de l'album :</h5>
                        <p><strong>Auteur :</strong> <?= htmlspecialchars($album['author']) ?></p>
                        <p><strong>Disponibilité :</strong> 
                            <span class="<?= $album['disponibility'] ? 'text-success' : 'text-danger' ?>">
                                <?= $status ?>
                            </span>
                        </p>
                        <p><strong>Nombre de chansons :</strong> <?= $album['songNumber'] ?></p>
                        <p><strong>Éditeur :</strong> <?= $album['editor'] ?></p>
                    </div>
                    <div class="col-md-6">
                        <?php if (isset($songs) && !empty($songs)): ?>
                            <h5 class="mb-3">Chansons de l'album :</h5>
                            <div class="list-group song-list-scroll">
                                <?php foreach($songs as $row): ?>
                                    <div class="list-group-item">
                                        <p class="mb-1"><strong>Titre :</strong> <?= $row['title'] ?></p>
                                        <p class="mb-1">Note : <?= $row['note'] ?>/5</p>
                                        <p class="mb-0">Durée : <?= $row['duration'] ?? '—' ?> min</p>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php 
                            else: 
                            if(isset($message)){
                                echo $message;
                            } 
                            endif;
                            
                        ?>
                    </div>
                </div>
                <form action='/Medianeth/Home/<?= $dispo ?>' method="post" class="mt-4">
                    <input type="hidden" name="album_id" value="<?= $album['album_id']; ?>">
                </form>
                <div class="d-flex col align-item-center justify-content-center">
                    <form action='/Medianeth/Home/<?php echo $dispo; ?>' method="post">
                        <input type="hidden" name="id" value="<?php echo $album["album_id"]; ?>">
                        <input type="hidden" name="type" value="<?php echo "album"; ?>">
                        <input type="hidden" name="page" value="showAlbum"/>
                        <input  title="emprunter ou rendre le média" class = "btn btn-primary "type="submit" name="<?php echo $dispo; ?>" value="<?php echo $dispo; ?>"/>
                    </form>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>