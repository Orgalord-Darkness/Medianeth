<div class="container">
    <h1 class="mb-4">Administration — Illustrations</h1>   
    
    <a href="/Medianeth/Illustration/addIllustration"><button class="btn btn-primary">+</button></a>
    
    <?php if (count($illustrations) === 0){ ?>
        <div class="alert alert-secondary text-center">Aucune illustration trouvée.</div>
    <?php }else{ ?> 
    <div class="container my-4">
        <div class="row g-4">
            <?php foreach($illustrations as $row): ?>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100 shadow-lg border-1 rounded-3">
                        <div class="card-header bg-primary text-white text-center py-2">
                            <h5 class="mb-0 text-truncate"><?= htmlspecialchars($row["name"]); ?></h5>
                        </div>
                        <div class="card-body text-center">
                            <img src="<?= htmlspecialchars($row['link'] ?? ''); ?>" 
                                alt="<?= htmlspecialchars($row['name'] ?? ''); ?>" 
                                class="img-fluid mb-3" style="max-height:200px; object-fit:cover;">

                            <!-- Lien -->
                            <p class="mb-1">
                                <strong>Lien :</strong> 
                                <a href="<?= htmlspecialchars($row['link'] ?? ''); ?>" target="_blank">
                                    <?= htmlspecialchars($row['link'] ?? ''); ?>
                                </a>
                            </p>

                        </div>
                        <div class="card-footer bg-transparent border-0 d-flex justify-content-between">
                            <a href="/Medianeth/Illustration/updateIllustration/<?= $row['illustration_id']; ?>">
                                <button type="submit" class="btn btn-sm btn-outline-primary">
                                    <i class="fa fa-pen"></i> Modifier
                                </button>
                            </a>
                            <form action="/Medianeth/Illustration/deleteIllustration" method="post" class="d-inline">
                                <input type="hidden" name="illustration_id" value="<?= $row['illustration_id']; ?>">
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Supprimer cette illustration ?')">
                                    <i class="fa fa-trash"></i> Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php } ?>
</div>
