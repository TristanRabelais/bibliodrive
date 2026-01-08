<?php
    require_once 'connexion.php';

    if (isset($_POST['bouton'])) {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];

        if (!empty($nom) && !empty($prenom)) {
            try {
                $stmt = $connexion->prepare("INSERT INTO auteur (nom, prenom) VALUES (:nom, :prenom)");
                $stmt->bindValue(':nom', $nom);
                $stmt->bindValue(':prenom', $prenom);
                
                if ($stmt->execute()) {
                    echo "<div class='alert alert-success'>Auteur ajouté avec succès !</div>";
                } else {
                    echo "<div class='alert alert-danger'>Erreur lors de l'ajout.</div>";
                }
            } catch (PDOException $e) {
                echo "<div class='alert alert-danger'>Erreur système.</div>";
            }
        } else {
            echo "<div class='alert alert-warning'>Tous les champs sont obligatoires.</div>";
        }
    }
?>
<div class="card p-3 shadow-sm">
    <h2 class="mb-3">Ajouter un auteur</h2>
    <form method="post">
        <div class="mb-3">
            <input type="text" class="form-control" name="nom" placeholder="Nom de famille" required>
        </div>
        <div class="mb-3">
            <input type="text" class="form-control" name="prenom" placeholder="Prénom" required>
        </div>
        <button type="submit" name="bouton" class="btn btn-primary w-100">Enregistrer l'auteur</button>
    </form>
    <div class="mt-3 text-center">
        <a href="p_ajouter_livre.php" class="btn btn-secondary btn-sm">Retour à l'ajout de livre</a>
    </div>
</div>