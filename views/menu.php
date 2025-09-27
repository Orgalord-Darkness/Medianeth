<!-- <button class="btn btn-primary button-fixed" type="button" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop" aria-controls="staticBackdrop" title="menu">
  <i class="fa-solid fa-bars"></i>
</button>
<?php if(isset($_SESSION['user_id'])): ?>

<div class="offcanvas offcanvas-start" data-bs-backdrop="static" tabindex="-1" id="staticBackdrop" aria-labelledby="staticBackdropLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="staticBackdropLabel"><i class="fa-solid fa-bars"></i></h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <h1><?php if(isset($_SESSION['login'])){echo $_SESSION['login'] ; }?></h1>
            </li>
            <li class="nav-item">
                <a href="/Medianeth/Home/library/" class="nav-link link-dark" title="vue d'ensembe">
                <i class="fa-solid fa-eye"></i>
                Accueil
                </a>
            </li>
             <li class="nav-item">
                <a href="/Medianeth/Home/dashboard/" class="nav-link link-dark" title="vue d'ensembe">
                <i class="fa-solid fa-gauge"></i>
                Dashboard
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
                <a href="/Medianeth/Song/adminSong" class="nav-link link-dark" title="statistiques des heures">
                    <i class="fa-solid fa-music"></i>
                    Song
                </a>
            </li>
            <li>
                <a href="/Medianeth/Illustration/adminIllustration" class="nav-link link-dark" title="statistiques des heures">
                    <i class="fa-solid fa-image"></i>
                    Illustration
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
<?php endif;?> -->

<nav class="navbar navbar-expand-lg navbar-dark bg-primary px-3 fixed-top opacity-75">
  <a class="navbar-brand text-white" href="/Medianeth/Home/library/">
    <i class="fa-solid fa-book-open"></i> Medianeth
  </a>

  <!-- Bouton hamburger pour mobile -->
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMedianeth" aria-controls="navbarMedianeth" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Contenu de la navbar -->
  <div class="collapse navbar-collapse" id="navbarMedianeth">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <?php if(isset($_SESSION['user_id'])): ?>
        <li class="nav-item">
          <a class="nav-link text-white hover-bg-light rounded" href="/Medianeth/Home/library/" title="Accueil"><i class="fa-solid fa-eye"></i> Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white hover-bg-light rounded" href="/Medianeth/Home/dashboard/" title="Dashboard"><i class="fa-solid fa-gauge"></i> Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white hover-bg-light rounded" href="/Medianeth/Book/adminBook/" title="Livre"><i class="fa-solid fa-book"></i> Livre</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white hover-bg-light rounded" href="/Medianeth/Movie/adminMovie" title="Film"><i class="fa-solid fa-film"></i> Film</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white hover-bg-light rounded" href="/Medianeth/Album/adminAlbum" title="Album"><i class="fa-solid fa-record-vinyl"></i> Album</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white hover-bg-light rounded" href="/Medianeth/Song/adminSong" title="Chanson"><i class="fa-solid fa-music"></i> Song</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white hover-bg-light rounded" href="/Medianeth/Illustration/adminIllustration" title="Illustration"><i class="fa-solid fa-image"></i> Illustration</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-warning hover-bg-light rounded" href="/Medianeth/User/logout" title="Déconnexion"><i class="fa-solid fa-right-from-bracket"></i> Déconnexion</a>
        </li>
      <?php else: ?>
        <li class="nav-item">
          <a class="nav-link text-white hover-bg-light rounded" href="/Medianeth/User/login" title="Connexion"><i class="fa-solid fa-right-to-bracket"></i> Connexion</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white hover-bg-light rounded" href="/Medianeth/User/signin" title="Inscription"><i class="fa-solid fa-user-plus"></i> Inscription</a>
        </li>
      <?php endif; ?>
    </ul>

    <?php if(isset($_SESSION['user_id'])): ?>
      <span class="navbar-text text-white">
        <i class="fa-solid fa-user"></i>
        <?php echo htmlspecialchars($_SESSION['login']); ?>
      </span>
    <?php endif; ?>
  </div>
</nav>
