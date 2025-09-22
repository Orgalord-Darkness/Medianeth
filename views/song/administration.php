<div class="container">
    <h1 class="mb-4">Administration — Songs</h1>   
    
    <a href="/Medianeth/Song/addSong"><button class="btn btn-primary">+</button></a>
    
    <?php if (count($songs) === 0){ ?>
        <div class="alert alert-secondary text-center">Aucune chanson trouvée.</div>
    <?php }else{ ?> 
    <div class="container my-4">
        <div class="row g-4">
            <?php foreach($songs as $row): 
                    $album = $albums[$row['album_id']];
                ?>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100 shadow-lg border-1 rounded-3">
                        <div class="card-header bg-primary text-white text-center py-2">
                            <h5 class="mb-0 text-truncate">
                                <?= htmlspecialchars($row["title"]); ?>
                            </h5>
                        </div>
                        <div class="card-body">
                            <p class="mb-1"><strong>Note :</strong> <?= htmlspecialchars($row['note']); ?>/5</p>
                            <p class="mb-1"><strong>Durée :</strong> <?= htmlspecialchars($row['duration']); ?>minutes</p>
                            <p class="mb-1"><strong>Album :</strong> <?= $album['title']; ?></p>
                        </div>
                        <div class="card-footer bg-transparent border-0 d-flex justify-content-between">
                            <a href="/Medianeth/Song/updateSong/<?= $row['song_id']; ?>">
                                <button type="submit" class="btn btn-sm btn-outline-primary">
                                    <i class="fa fa-pen"></i> Modifier
                                </button>
                            </a>
                            <form action="/Medianeth/Song/deleteSong" method="post" class="d-inline">
                                <input type="hidden" name="song_id" value="<?= $row['song_id'] ?>">
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="fa fa-trash"></i> Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; }?>
        </div>
    </div>
</div>
