<!-- 
<div class="row  slide" style ="position : sticky ; margin-bottom : 5% ; z-index:1000 ;background-color: #98DDFF; height:10% ; width : 100% ;box-shadow: 0 0 20px 2px rgb(0,0,10)" >
    <div class="col-4 ">
        
    </div>
    <div class="col-4 my-auto" style="width : 33% ">
        <h4 class="text-center header_text ">Medianeth</h4>
    </div>
    <div class="col-1"></div>
</div> -->
<button class="btn btn-primary button-fixed" type="button" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop" aria-controls="staticBackdrop" id='colorChangeButton' title="menu">
  <i class="fa-solid fa-bars"></i>
</button>

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
            <i class="fa-solid fa-eye"></i>
               Livre
            </a>
        </li>
        <li>
            <a href="/Medianeth/Movie/adminMovie" class="nav-link link-dark" title="rechercher le planning d'un employer">
                <i class="fa-solid fa-magnifying-glass"></i>
                Film
            </a>
        </li>
        <li>
            <a href="/Medianeth/Album/adminAlbum" class="nav-link link-dark" title="statistiques des heures">
                <i class="fa-solid fa-chart-line"></i>
                Album
            </a>
        </li>
        <li>
            <a href="/Medianeth/User/login" class="nav-link link-dark" title="statistiques des heures">
                <i class="fa-solid fa-chart-line"></i>
                Connexion
            </a>
        </li>
        <li>
            <a href="/Medianeth/User/signin" class="nav-link link-dark" title="statistiques des heures">
                <i class="fa-solid fa-chart-line"></i>
                Inscription
            </a>
        </li>
        </ul>
        <hr>
  </div>
</div>
