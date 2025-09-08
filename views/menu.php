<button class="btn btn-primary button-fixed" type="button" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop" aria-controls="staticBackdrop" id='colorChangeButton' title="menu">
  <i class="fa-solid fa-bars"></i>
</button>
<?php if(isset($_SESSION['user_id'])): ?>


<script>
const button = document.getElementById('colorChangeButton');

// Variable pour suivre l'état de la couleur actuelle
let isBlue = true;

// Fonction pour changer la couleur
function toggleColor() {
  if (isBlue) {
    button.style.backgroundColor = '#007bff';
    button.style.color = "#00000" 
  } else {
    button.style.backgroundColor = '#FFF666';
    button.style.color = "#00000"
  }
  
  // Inverse l'état de la couleur
  isBlue = !isBlue;
}

// Appelle la fonction toggleColor toutes les 2 secondes (2000 millisecondes)
setInterval(toggleColor, 500);
</script>
<div class="offcanvas offcanvas-start" data-bs-backdrop="static" tabindex="-1" id="staticBackdrop" aria-labelledby="staticBackdropLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="staticBackdropLabel"><i class="fa-solid fa-bars"></i></h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <hr>
        <ul class="nav nav-pills flex-column mb-auto">
          <li class="nav-item">
            <a href="/Medianeth/Home/library/" class="nav-link link-dark" title="vue d'ensembe">
            <i class="fa-solid fa-eye"></i>
               Accueil
            </a>
        </li>
        <li class="nav-item">
            <a href="/Medianeth/Book/adminBook/" class="nav-link link-dark" title="vue d'ensembe">
            <i class="fa-solid fa-book"></i>
               Livre
            </a>
        </li>
        <li>
            <a href="/Medianeth/Movie/adminMovie" class="nav-link link-dark" title="rechercher le planning d'un employer">
                <i class="fa-solid fa-film"></i>
                Film
            </a>
        </li>
        <li>
            <a href="/Medianeth/Album/adminAlbum" class="nav-link link-dark" title="statistiques des heures">
                <i class="fa-solid fa-record-vinyl"></i>
                Album
            </a>
        </li>
        <li>
            <a href="/Medianeth/User/logout" class="nav-link link-dark" title="statistiques des heures">
                <i class="fa-solid fa-right-from-bracket"></i>
                Déconnexion
            </a>
        </li>
        </ul>
        <hr>
  </div>
</div>
<?php else: 
?>

<div class="offcanvas offcanvas-start" data-bs-backdrop="static" tabindex="-1" id="staticBackdrop" aria-labelledby="staticBackdropLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="staticBackdropLabel"><i class="fa-solid fa-bars"></i></h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <hr>
        <ul class="nav nav-pills flex-column mb-auto">
        <li>
            <a href="/Medianeth/User/login" class="nav-link link-dark" title="statistiques des heures">
                <i class="fa-solid fa-person"></i>
                Connexion
            </a>
        </li>
        <li>
            <a href="/Medianeth/User/signin" class="nav-link link-dark" title="statistiques des heures">
                <i class="fa-solid fa-person"></i>
                Inscription
            </a>
        </li>
        </ul>
        <hr>
  </div>
</div>
<?php endif;?>