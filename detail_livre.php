<?php
    session_start();
    ob_start();
    require_once('connexion.php');

    if (!isset($_GET["nolivre"])) {
        header("Location: index.php");
        exit();
    }
    $nolivre = $_GET["nolivre"];
    $stmt = $connexion->prepare("SELECT * FROM livre INNER JOIN auteur ON (livre.noauteur = auteur.noauteur) WHERE livre.nolivre = :nolivre");
    $stmt->bindValue(":nolivre", $nolivre);
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    $stmt->execute();
    $livre = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Détails - <?= $livre ? $livre->titre : 'Livre' ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-3">
        <div class="row">
            <div class="col-sm-9"><?php include 'recherche.php'; ?></div>
            <div class="col-sm-3"><?php include 'image.php'; ?></div>
        </div>
        <div class="row mt-4">
            <div class="col-sm-9">
                <?php if ($livre): ?>
                    <div class="row">
                        <div class="col-md-4">
                            <img src="./covers/<?= $livre->photo ?>" class="img-fluid rounded shadow" alt="Couverture">
                        </div>
                        <div class="col-md-8">
                            <h2><?= $livre->titre ?></h2>
                            <p><strong>Auteur :</strong> <?= $livre->prenom . " " . $livre->nom ?></p>
                            <p><strong>ISBN :</strong> <?= $livre->isbn13 ?></p>
                            <p><strong>Année :</strong> <?= $livre->anneeparution ?></p>
                            <hr>
                            <p><?= nl2br($livre->detail) ?></p>
                            
                            <?php if (isset($_SESSION["mel"])): ?>
                                <form method="POST" action="p_panier.php">
                                    <input type="hidden" name="nolivre_a_ajouter" value="<?= $livre->nolivre ?>">
                                    <button type="submit" name="btn-ajoutpanier" class="btn btn-success btn-lg">Ajouter au panier</button>
                                </form>
                            <?php else: ?>
                                <p class="alert alert-info">Connectez-vous pour réserver ce livre.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php else: ?>
                    <p class="alert alert-danger">Livre introuvable.</p>
                <?php endif; ?>
            </div>
            <div class="col-sm-3">
                <?php include 'authentification.php'; ?>
            </div>
        </div>
    </div>
</body>
</html>