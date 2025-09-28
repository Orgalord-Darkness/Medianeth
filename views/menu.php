

<nav class="navbar navbar-expand-lg navbar-dark bg-primary px-3 fixed-top opacity-75">
  <a class="navbar-brand text-white" href="/Medianeth/Home/library/">
    <i class="fa-solid fa-book-open"></i> Medianeth
  </a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMedianeth" aria-controls="navbarMedianeth" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarMedianeth">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <?php if(isset($_SESSION['user_id'])): ?>
        <li class="nav-item"><a class="nav-link text-white" href="/Medianeth/Home/dashboard/"><i class="fa-solid fa-gauge"></i> Dashboard</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="/Medianeth/Book/adminBook/"><i class="fa-solid fa-book"></i> Livre</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="/Medianeth/Movie/adminMovie"><i class="fa-solid fa-film"></i> Film</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="/Medianeth/Album/adminAlbum"><i class="fa-solid fa-record-vinyl"></i> Album</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="/Medianeth/Song/adminSong"><i class="fa-solid fa-music"></i> Song</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="/Medianeth/Illustration/adminIllustration"><i class="fa-solid fa-image"></i> Illustration</a></li>
        <li class="nav-item"><a class="nav-link text-warning" href="/Medianeth/User/logout"><i class="fa-solid fa-right-from-bracket"></i> Déconnexion</a></li>
                                              
      <?php else: ?>
        <li class="nav-item">
          <a href="/Medianeth/User/login" class="nav-link text-white" title="Connexion">
            <i class="fa-solid fa-right-to-bracket"></i> Connexion
          </a>
        </li>
        <li class="nav-item">
          <a href="/Medianeth/User/signin" class="nav-link text-white" title="Inscription">
            <i class="fa-solid fa-user-plus"></i> Inscription
          </a>
        </li>
      <?php endif; ?>
    </ul>
    <?php if(isset($_SESSION['user_id'])): ?>
      <ul class="navbar-nav ms-auto align-items-center">
       <li class="nav-item d-flex align-items-center me-3">
          <span class="navbar-text text-white d-flex align-items-center">
            <img 
              src="<?php if(isset($_SESSION['illustration'])): echo $_SESSION['illustration']; endif; ?>" 
              alt="Avatar de <?= htmlspecialchars($_SESSION['login']); ?>" 
              class="rounded-circle me-2" 
              style="width: 32px; height: 32px; object-fit: cover;"
              loading="lazy"
            >
            <?= htmlspecialchars($_SESSION['login']); ?>
          </span>
        </li>

        <li class="nav-item">
          <form action="/Medianeth/User/delete" method="post" class="d-inline">
            <input type="hidden" name="user_id" value="<?php if(isset($_SESSION['user_id'])) echo $_SESSION['user_id']; ?>"/>
            <button type="submit" class="nav-link btn btn-link text-danger p-0 m-0" style="text-decoration: none;">
              <i class="fa-solid fa-user-minus"></i><strong>Supprimer mon compte</strong>
            </button>
          </form>
        </li>
      </ul>


    <?php endif; ?>
  </div>
</nav>


