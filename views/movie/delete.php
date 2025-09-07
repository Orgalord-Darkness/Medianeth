<div class="container my-5">
  <div class="alert alert-danger shadow p-4">
    <h4 class="alert-heading">Suppression</h4>
    <p>Êtes-vous sûr de vouloir supprimer le film <?php if(isset($movie)){ echo $movie['title'] ;}?> ?</p>
    <hr>
    <form method="post" class="d-inline">
      <input type="hidden" name="movie_id" value="<?php if (isset($id)){echo $id ;}?>">
      <input type="submit" class="btn btn-danger" name="ask" value="Supprimer">
    </form>
    <a href="/Medianeth/Movie/adminMovie" class="btn btn-secondary">Annuler</a>
  </div>
</div>
