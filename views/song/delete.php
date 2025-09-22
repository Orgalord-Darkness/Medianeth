<div class="container my-5">
  <div class="alert alert-danger shadow p-4">
    <h4 class="alert-heading">Suppression</h4>
    <p>Êtes-vous sûr de vouloir supprimer la chanson <?php if(isset($song)){ echo $song['title'] ;}?> ?</p>
     <?php if (isset($message) && !empty($message)) : ?>
        <p class="text-danger fw-bold text-center"><?= $message; ?></p>
      <?php endif; ?>
    <form method="post" class="d-inline">
      <input type="hidden" name="song_id" value="<?php if (isset($id)){echo $id ;}?>">
      <input type="submit" class="btn btn-danger" name="ask" value="Supprimer">
    </form>
    <a href="/Medianeth/Song/adminSong" class="btn btn-secondary">Annuler</a>
  </div>
</div>
