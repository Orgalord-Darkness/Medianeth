<div class="container my-5">
  <div class="alert alert-danger shadow p-4">
    <h4 class="alert-heading">Suppression</h4>
    <p>Êtes-vous sûr de vouloir supprimer l'album <?php if(isset($album)){ echo $album['title'] ;}?> ?</p>
    <hr>
      <?php if (isset($message) && !empty($message)) : ?>
        <p class="text-danger fw-bold text-center"><?= $message; ?></p>
      <?php endif; ?>
    <form method="post" class="d-inline">
      <input type="hidden" name="album_id" value="<?php if (isset($id)){echo $id ;}?>">
      <input type="submit" class="btn btn-danger" name="ask" value="Supprimer">
    </form>
    <a href="/Medianeth/Album/adminAlbum" class="btn btn-secondary">Annuler</a>
  </div>
</div>
