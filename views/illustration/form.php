<div class="container my-5">
    <div class="card shadow border-0">
        <div class="card-header bg-primary text-white text-center">
            <h2 class="mb-0"><?php if(isset($fonction)){ echo $fonction ; }?> une illustration</h2>
        </div>
        <div class="card-body">
            <form method="post" class="p-3">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="label-name">Nom</span>
                    <input type="text" class="form-control" id="name" name="name"
                           value="<?php if(isset($name)){ echo $name ;}?>" 
                           required aria-describedby="label-name">
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text" id="label-link">Lien de l'image</span>
                    <input type="url" class="form-control" id="link" name="link"
                           value="<?php if(isset($link)){ echo $link ;}?>" 
                           required aria-describedby="label-link" placeholder="https://exemple.com/image.jpg">
                </div>
                <?php if(isset($link) && !empty($link)): ?>
                    <div class="text-center mb-3">
                        <img src="<?= htmlspecialchars($link); ?>" alt="<?= htmlspecialchars($name ?? '') ?>" class="img-fluid" style="max-height:200px; object-fit:cover;">
                    </div>
                <?php endif; ?>
                <p class="text-danger text-center">
                    <?php if(isset($message)){ echo ($message) ; } ?>
                </p>
                <div class="d-grid">
                    <input type="submit" class="btn btn-primary btn-lg" 
                           name="<?php if(isset($fonction)){echo $fonction ; }?>" 
                           value="<?php if(isset($fonction)){echo $fonction ; }?> l'illustration">
                    <input type="hidden" name="illustration_id" value="<?php if(isset($id)){ echo $id ;}?>">
                </div>
            </form>
        </div>
    </div>
</div>