<?php
    require_once 'connexion.php';
    if (isset($_POST['bouton'])) {
        $noauteur = $_POST['noauteur'];
        $titre = $_POST['titre'];
        $isbn13 = $_POST['isbn13'];
        $anneeparution = $_POST['anneeparution'];
        $detail = $_POST['detail'];
        $photo = $_POST['photo'];
        $sql = "INSERT INTO livre (noauteur, titre, isbn13, anneeparution, detail, photo, dateajout)
                VALUES (:noauteur, :titre, :isbn13, :anneeparution, :detail, :photo, CURDATE())";
        $stmt = $connexion->prepare($sql);
        $stmt->execute([
            ':noauteur' => $noauteur,
            ':titre' => $titre,
            ':isbn13' => $isbn13,
            ':anneeparution' => $anneeparution,
            ':detail' => $detail,
            ':photo' => $photo
        ]);
        echo "<div class='alert alert-success'>Le livre a été ajouté avec succès.</div>";
    }
    $queryAuteurs = $connexion->query("SELECT noauteur, nom FROM auteur ORDER BY nom");
    $auteurs = $queryAuteurs->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="card p-3 shadow-sm">
    <h2 class="mb-3">Ajouter un livre</h2>
    <form method="post">
        <div class="mb-3">
            <label class="form-label">Auteur</label>
            <select class="form-select" name="noauteur" required>
                <?php foreach ($auteurs as $auteur): ?>
                    <option value="<?= $auteur['noauteur']; ?>"><?= $auteur['nom']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <input type="text" class="form-control" name="titre" placeholder="Titre du livre" required>
        </div>
        <div class="mb-3">
            <input type="text" class="form-control" name="isbn13" placeholder="ISBN13" required>
        </div>
        <div class="mb-3">
            <input type="number" class="form-control" name="anneeparution" placeholder="Année de parution" required>
        </div>
        <div class="mb-3">
            <textarea class="form-control" name="detail" placeholder="Détails / Résumé" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <input type="text" class="form-control" name="photo" placeholder="Nom du fichier image (ex: couverture.jpg)" required>
        </div>
        <button type="submit" name="bouton" class="btn btn-primary w-100">Enregistrer</button>
    </form>
</div>