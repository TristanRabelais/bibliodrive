<?php
    if(!isset($_SESSION['panier'])){
        $_SESSION['panier'] = array();
    }
    if (isset($_POST['btn-ajoutpanier']) && isset($_POST['nolivre_a_ajouter'])) {
        $idLivre = $_POST['nolivre_a_ajouter'];
        if (!in_array($idLivre, $_SESSION['panier'])) {
            if (count($_SESSION['panier']) < 5) {
                $_SESSION['panier'][] = $idLivre;
            } else {
                echo "<div class='alert alert-warning'>Limite de 5 livres atteinte !</div>";
            }
        }
    }
    if(isset($_POST['annuler'])){
        $index = $_POST['index_livre'];
        unset($_SESSION['panier'][$index]);
        $_SESSION['panier'] = array_values($_SESSION['panier']);
        header("Location: p_panier.php");
        exit();
    }
    if(isset($_POST['valider']) && !empty($_SESSION['panier'])){
        require_once('connexion.php');
        $mel = $_SESSION['mel'];
        $dateemprunt = date("Y-m-d");
        try {
            $stmt = $connexion->prepare("INSERT INTO emprunter(mel, nolivre, dateemprunt) VALUES (:mel, :nolivre, :dateemprunt)");
            foreach($_SESSION['panier'] as $nolivre) {
                $stmt->execute([
                    ':mel' => $mel,
                    ':nolivre' => $nolivre,
                    ':dateemprunt' => $dateemprunt
                ]);
            }
            $_SESSION['panier'] = array();
            echo "<div class='alert alert-success'>Commande validée avec succès !</div>";
        } catch (PDOException $e) {
            echo "<div class='alert alert-danger'>Erreur lors de la validation.</div>";
        }
    }
?>
<div class="card p-3 shadow-sm">
    <h2 class="mb-3">Votre panier</h2>
    <?php 
    $nb_livres = count($_SESSION['panier']);
    $reste = 5 - $nb_livres;
    ?>
    <p class="text-muted">Il vous reste <?= $reste ?> réservations possibles.</p>
    <?php if (empty($_SESSION['panier'])): ?>
        <div class="alert alert-info">Votre panier est vide.</div>
    <?php else: ?>
        <ul class="list-group mb-3">
            <?php foreach ($_SESSION['panier'] as $index => $nolivre): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    Livre n° <?= $nolivre ?>
                    <form method="post" style="margin:0;">
                        <input type="hidden" name="index_livre" value="<?= $index ?>">
                        <button type="submit" name="annuler" class="btn btn-sm btn-danger">Supprimer</button>
                    </form>
                </li>
            <?php endforeach; ?>
        </ul>
        <form method="post">
            <button type="submit" name="valider" class="btn btn-success w-100">Valider mes emprunts</button>
        </form>
    <?php endif; ?>
</div>