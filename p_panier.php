<?php
    session_start();
    ob_start();

    if (!isset($_SESSION['mel'])) {
        header('Location: index.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Mon Panier - Bibliodrive</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-9">
                <?php include 'recherche.php'; ?>
            </div>
            <div class="col-sm-3">
                <?php include 'image.php'; ?>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-sm-9">
                <?php include 'panier.php'; ?>
            </div>
            <div class="col-sm-3">
                <?php include 'authentification.php'; ?>
            </div>
        </div>
    </div>
</body>
</html>