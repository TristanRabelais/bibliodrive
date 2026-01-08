<?php
if (isset($_SESSION['profil']) && $_SESSION['profil'] == 'admin') {
?>
  <nav class="navbar navbar-expand-sm navbar-dark bg-warning">
    <div class="container-fluid">
      <a class="navbar-brand text-dark" href="index.php">Accueil Administrateur</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="mynavbar">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link text-dark" href="p_ajouter_livre.php">Ajouter un livre</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-dark" href="p_creer_membre.php">Créer un membre</a>
          </li>
        </ul>
        <form class="d-flex" action="p_liste_livres.php" method="post">
          <input class="form-control me-2" type="text" name="rchAuteur" placeholder="Rechercher un auteur...">
          <button class="btn btn-primary" type="submit">Rechercher</button>
        </form>
      </div>
    </div>
  </nav>
<?php
} else {
?>
  <nav class="navbar navbar-expand-sm navbar-dark bg-danger">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">Accueil</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="mynavbar">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link" href="p_panier.php">Panier</a>
          </li>
        </ul>
        <form class="d-flex" action="p_liste_livres.php" method="post">
          <input class="form-control me-2" type="text" name="rchAuteur" placeholder="Rechercher un auteur...">
          <button class="btn btn-primary" type="submit">Rechercher</button>
        </form>
      </div>
    </div>
  </nav>
<?php
}
?>