<div class="container my-5">
  <div class="alert alert-danger shadow p-4">
    <h4 class="alert-heading">⚠️ Suppression</h4>
    <p>Êtes-vous sûr de vouloir supprimer le livre <?php if(isset($book)){ echo $book['title'] ;}?> ?</p>
    <hr>
    <form method="post" class="d-inline">
      <input type="hidden" name="book_id" value="<?php if (isset($id)){echo $id ;}?>">
      <input type="submit" class="btn btn-danger" name="ask" value="Supprimer">
    </form>
    <a href="/Medianeth/Book/adminBook" class="btn btn-secondary">Annuler</a>
  </div>
</div>
