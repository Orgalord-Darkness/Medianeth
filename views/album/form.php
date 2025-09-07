<div class="container my-5">
    <div class="card shadow border-0">
        <div class="card-header bg-primary text-white text-center">
            <h2 class="mb-0"><?php if(isset($fonction)){ echo $fonction ; }?> un album</h2>
        </div>
        <div class="card-body">
            <form method="post" class="p-3">

                <div class="input-group mb-3">
                    <span class="input-group-text" id="label-title">Titre</span>
                    <input type="text" class="form-control" id="title" name="title"
                           value="<?php if(isset($title)){ echo $title ;}?>" 
                           required aria-describedby="label-title">
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text" id="label-author">Auteur</span>
                    <input type="text" class="form-control" id="author" name="author"
                           value="<?php if(isset($author)){ echo $author ;}?>" 
                           required aria-describedby="label-author">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-text">
                        <input type="checkbox" class="form-check-input mt-0" id="disponibility" name="disponibility" value="1" checked>
                    </div>
                    <label class="form-control" for="disponibility">Disponible</label>
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text" id="label-songNumber">Nombre de chansons</span>
                    <input type="number" class="form-control"name="songNumber" value="<?php if(isset($songNumber)){ echo $songNumber ;}?>"required>
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text" id="label-editor">Editeur</span>
                    <input class="form-control"name="editor" value="<?php if(isset($editor)){ echo $editor ;}?>"required>
                </div>

                <p class="text-danger text-center">
                    <?php if(isset($message)){ echo ($message) ; } ?>
                </p>
                <div class="d-grid">
                    <input type="submit" class="btn btn-primary btn-lg" name="<?php if(isset($fonction)){echo $fonction ; }?>" value="<?php if(isset($fonction)){echo $fonction ; }?> l'album">
                    <input type="hidden" name="album_id" value="<?php if(isset($id)){ echo $id ;}?>">
                </div>
            </form>
        </div>
    </div>
</div>
