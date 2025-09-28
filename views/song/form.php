<div class="container my-5">
    <div class="card shadow border-0">
        <div class="card-header bg-primary text-white text-center">
            <h2 class="mb-0"><?php if(isset($fonction)){ echo $fonction ; }?> une chanson</h2>
        </div>
        <div class="card-body">
            <form method="post" class="p-3">

                <!-- Title -->
                <div class="input-group mb-3">
                    <span class="input-group-text" id="label-title">Titre</span>
                    <input type="text" class="form-control" id="title" name="title"
                           value="<?php if(isset($title)){ echo $title ;}?>" 
                           required aria-describedby="label-title">
                </div>

                <!-- Note -->
                <div class="input-group mb-3">
                    <span class="input-group-text" id="label-note">Note</span>
                    <input type="number" class="form-control" id="note" name="note" max=5
                           value="<?php if(isset($note)){ echo $note ;}?>" 
                           aria-describedby="label-note">
                </div>

                <!-- Duration -->
                <div class="input-group mb-3">
                    <span class="input-group-text" id="label-duration">Durée</span>
                    <input type="float" class="form-control" id="duration" name="duration"
                           value="<?php if(isset($duration)){ echo $duration ;}?>" 
                           required aria-describedby="label-duration" placeholder="ex: 3.45">
                </div>

                <!-- Album ID -->
                <div class="input-group mb-3">
                    <span class="input-group-text" id="label-album">Album</span>
                    <select class="form-control" name="album_id">
                        <?php foreach($albums as $row): ?> 
                            <option value="<?php echo $row['album_id'];?>"><?php echo $row['title'];?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Message d'erreur -->
                <p class="text-danger text-center">
                    <?php if(isset($message)){ echo ($message) ; } ?>
                </p>

                <!-- Actions -->
                <div class="d-grid">
                    <input type="submit" class="btn btn-primary btn-lg" 
                           name="<?php if(isset($fonction)){echo $fonction ; }?>" 
                           value="<?php if(isset($fonction)){echo $fonction ; }?> la chanson">
                    <input type="hidden" name="song_id" value="<?php if(isset($id)){ echo $id ;}?>">
                </div>
            </form>
        </div>
    </div>
</div>
