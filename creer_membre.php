<?php
require_once 'connexion.php';

if (isset($_POST['bouton'])) {
    $mel = $_POST['mel'];
    $motdepasse = $_POST['motdepasse'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $adresse = $_POST['adresse'];
    $ville = $_POST['ville'];
    $codepostal = $_POST['codepostal'];
    $profil = $_POST['profil'];

    if (!empty($mel) && !empty($motdepasse) && !empty($nom) && !empty($prenom) && !empty($adresse) && !empty($ville) && !empty($codepostal) && !empty($profil)) {
        try {
            $stmt = $connexion->prepare("INSERT INTO utilisateur (mel, motdepasse, nom, prenom, adresse, ville, codepostal, profil) VALUES (:mel, :motdepasse, :nom, :prenom, :adresse, :ville, :codepostal, :profil)");
            $stmt->bindValue(':mel', $mel);
            $stmt->bindValue(':motdepasse', $motdepasse); 
            $stmt->bindValue(':nom', $nom);
            $stmt->bindValue(':prenom', $prenom);
            $stmt->bindValue(':adresse', $adresse);
            $stmt->bindValue(':ville', $ville);
            $stmt->bindValue(':codepostal', $codepostal);
            $stmt->bindValue(':profil', $profil);

            if ($stmt->execute()) {
                echo "<div class='alert alert-success'>Membre créé avec succès !</div>";
            } else {
                echo "<div class='alert alert-danger'>Erreur lors de la création.</div>";
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
    <h2 class="mb-3">Créer un membre</h2>
    <form method="post">
        <div class="mb-3">
            <input type="email" class="form-control" name="mel" placeholder="Email" required>
        </div>
        <div class="mb-3">
            <input type="password" class="form-control" name="motdepasse" placeholder="Mot de passe" required>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <input type="text" class="form-control" name="nom" placeholder="Nom" required>
            </div>
            <div class="col-md-6 mb-3">
                <input type="text" class="form-control" name="prenom" placeholder="Prénom" required>
            </div>
        </div>
        <div class="mb-3">
            <input type="text" class="form-control" name="adresse" placeholder="Adresse" required>
        </div>
        <div class="row">
            <div class="col-md-8 mb-3">
                <input type="text" class="form-control" name="ville" placeholder="Ville" required>
            </div>
            <div class="col-md-4 mb-3">
                <input type="text" class="form-control" name="codepostal" placeholder="CP" required>
            </div>
        </div>
        <div class="mb-3">
            <select class="form-select" name="profil" required>
                <option value="" selected disabled>Choisir un profil</option>
                <option value="client">Client</option>
                <option value="admin">Administrateur</option>
            </select>
        </div>
    <button type="submit" name="bouton" class="btn btn-primary w-100">Créer le compte</button>
    </form>
</div>