<div class="container">
    <h1 class="mb-4">Administration — Albums</h1>   
    
        <a href="/Medianeth/Album/addAlbum"><button class="btn btn-primary">+</button></a>
    
    <?php if (count($albums) === 0){ ?>
    <div class="alert alert-secondary text-center">Aucun album trouvé.</div>
    <?php }else{ ?> 
    <div class="container my-4">
        <div class="row g-4">
            <?php foreach($albums as $row): ?>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100 shadow-lg border-1 rounded-3">
                        <div class="card-header bg-primary text-white text-center py-2">
                            <h5 class="mb-0 text-truncate"><?php echo $row["title"];?></h5>
                        </div>
                        <div class="card-body">
                            <img src="<?= htmlspecialchars($row['link'] ?? ''); ?>" 
                                alt="<?= htmlspecialchars($row['name'] ?? ''); ?>" 
                                class="img-fluid mb-3" style="max-height:200px; object-fit:cover;">
                            <p class="mb-1"><strong>Auteur :</strong> <?php echo $row['author'];?></p>
                            <p class="mb-1">
                                <strong>Disponibilité :</strong>
                                <?php if ($row['disponibility']): ?>
                                    <span class="badge bg-success">Disponible</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Indisponible</span>
                                <?php endif; ?>
                            </p>
                            <p class="mb-1"><strong>Nombre de chansons :</strong> <?php echo $row['songNumber'];?> h</p>
                            <p class="mb-1"><strong>Editeur :</strong> <?php echo $row['editor'];?></p>
                        </div>
                        <div class="card-footer bg-transparent border-0 d-flex justify-content-between">
                            <a href="/Medianeth/Album/updateAlbum/<?php echo $row['album_id'];?>">
                                <button type="submit" class="btn btn-sm btn-outline-primary">
                                    <i class="fa fa-pen"></i> Modifier
                                </button>
                            </a>
                            <form action="/Medianeth/Album/deleteAlbum" method="post" class="d-inline">
                                <input type="hidden" name="album_id" value="<?= $row['album_id'] ?>">
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