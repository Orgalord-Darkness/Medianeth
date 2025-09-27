<div class="container my-5">
    <div class="row justify-content-center">
        <?php 
        if (isset($album)):
            $dispo = $album['disponibility'] ? "emprunter" : "rendre"; 
            $status = $album['disponibility'] ? "Disponible" : "Indisponible";
        ?>
        <div class="col-12 col-lg-10">
            <div class="card p-4 shadow-lg custom-card text-center">
                <!-- Image centrée -->
                <div class="mb-4">
                    <img src="<?= htmlspecialchars($album['link'] ?? ''); ?>" 
                         alt="<?= htmlspecialchars($album['name'] ?? ''); ?>" 
                         class="img-fluid rounded shadow-sm album-image mx-auto d-block">
                    <h2 class="mt-3"><?= htmlspecialchars($album['title']) ?></h2>
                </div>

                <!-- Infos + chansons -->
                <div class="row text-start">
                    <!-- Infos album -->
                    <div class="col-md-6 mb-3">
                        <p><strong>Auteur :</strong> <?= htmlspecialchars($album['author']) ?></p>
                        <p><strong>Disponibilité :</strong> 
                            <span class="<?= $album['disponibility'] ? 'text-success' : 'text-danger' ?>">
                                <?= $status ?>
                            </span>
                        </p>
                        <p><strong>Nombre de chansons :</strong> <?= $album['songNumber'] ?></p>
                        <p><strong>Éditeur :</strong> <?= $album['editor'] ?></p>
                    </div>

                    <!-- Liste des chansons avec scroll -->
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

                <!-- Bouton emprunter / rendre -->
                <form action='/Medianeth/Home/<?= $dispo ?>' method="post" class="mt-4">
                    <input type="hidden" name="album_id" value="<?= $album['album_id']; ?>">
                </form>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

<style>
    .custom-card {
        max-width: 100%;
        border-radius: 10px;
        background-color: #f8f9fa;
    }

    .album-image {
        max-height: 300px;
        object-fit: cover;
        width: auto;
        max-width: 100%;
    }

    .song-list-scroll {
        max-height: 300px;
        overflow-y: auto;
        border: 1px solid #dee2e6;
        border-radius: .25rem;
        background-color: #fff;
    }

    /* Un peu d’esthétique pour la scrollbar */
    .song-list-scroll::-webkit-scrollbar {
        width: 6px;
    }
    .song-list-scroll::-webkit-scrollbar-thumb {
        background-color: #adb5bd;
        border-radius: 10px;
    }

    @media (max-width: 768px) {
        .album-image {
            max-height: 200px;
        }

        .song-list-scroll {
            max-height: 200px;
        }
    }
</style>
