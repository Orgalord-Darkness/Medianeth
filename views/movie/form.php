<div class="container my-5">
    <div class="card shadow border-0">
        <div class="card-header bg-primary text-white text-center">
            <h2 class="mb-0"><?php if(isset($fonction)){ echo $fonction ; }?> un livre</h2>
        </div>
        <div class="card-body">
            <form method="post" class="p-3">

                <!-- Titre -->
                <div class="input-group mb-3">
                    <span class="input-group-text" id="label-title">Titre</span>
                    <input type="text" class="form-control" id="title" name="title"
                           value="<?php if(isset($title)){ echo $title ;}?>" 
                           required aria-describedby="label-title">
                </div>

                <!-- Auteur -->
                <div class="input-group mb-3">
                    <span class="input-group-text" id="label-author">Auteur</span>
                    <input type="text" class="form-control" id="author" name="author"
                           value="<?php if(isset($author)){ echo $author ;}?>" 
                           required aria-describedby="label-author">
                </div>

                <!-- Disponibilité -->
                <div class="input-group mb-3">
                    <div class="input-group-text">
                        <input type="checkbox" class="form-check-input mt-0" 
                               id="disponibility" name="disponibility" value="1" checked>
                    </div>
                    <label class="form-control" for="disponibility">Disponible</label>
                </div>

                <!-- Durée -->
                <div class="input-group mb-3">
                    <span class="input-group-text" id="label-duration">Durée (h)</span>
                    <input type="number" class="form-control" id="duration" name="duration"
                           value="<?php if(isset($duration)){ echo $duration ;}?>" 
                           required aria-describedby="label-duration">
                </div>
                <!-- Genre -->
                <div class="input-group mb-4">
                    <label class="input-group-text" for="genre">Genre</label>
                    <select id="genre" name="genre" class="form-select">
                        <option value="<?= isset($genre) ? $genre : '' ?>"> <?= isset($genre) ? $genre : 'Choisir un genre' ?> </option>
                        <option value="Action">Action</option>
                        <option value="Aventure">Aventure</option>
                        <option value="Comédie">Comédie</option>
                        <option value="Drame">Drame</option>
                        <option value="Horreur">Horreur</option>
                        <option value="Thriller">Thriller</option>
                        <option value="Fantastique">Fantastique</option>
                        <option value="ScienceFiction">Science-Fiction</option>
                        <option value="Fantasy">Fantasy</option>
                        <option value="Policier">Policier</option>
                        <option value="Romance">Romance</option>
                        <option value="Guerre">Guerre</option>
                        <option value="Western">Western</option>
                        <option value="Animation">Animation</option>
                        <option value="Documentaire">Documentaire</option>
                        <option value="Biopic">Biopic</option>
                        <option value="Historique">Historique</option>
                    </select>
                </div>

                <p class="text-danger text-center">
                    <?php if(isset($message)){ echo ($message) ; } ?>
                </p>
                <!-- Bouton -->
                <div class="d-grid">
                    <input type="submit" class="btn btn-primary btn-lg" name="<?php if(isset($fonction)){echo $fonction ; }?>" value="<?php if(isset($fonction)){echo $fonction ; }?> le livre">
                    <input type="hidden" name="movie_id" value="<?php if(isset($id)){ echo $id ;}?>">
                </div>
            </form>
        </div>
    </div>
</div>
