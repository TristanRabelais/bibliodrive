<?php
    require_once('connexion.php');
    if(isset($_POST["rchAuteur"])){
        $nom = $_POST["rchAuteur"];
        $stmt = $connexion->prepare("SELECT nolivre, titre, anneeparution FROM livre INNER JOIN auteur ON (livre.noauteur = auteur.noauteur) WHERE auteur.nom=:nom ORDER BY anneeparution");
        $stmt->bindValue(":nom", $nom);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        
        echo '<div class="list-group">';
        while($enregistrement = $stmt->fetch())
        {
            echo '<a href="detail_livre.php?nolivre='.$enregistrement->nolivre.'" class="list-group-item list-group-item-action">';
            echo '<h5 class="mb-1">'.$enregistrement->titre.' ('.$enregistrement->anneeparution.')</h5>';
            echo '</a>';
        }
        echo '</div>';
    }
?>