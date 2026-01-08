<?php
    if (!isset($_SESSION["mel"])) {
        if (!isset($_POST['btnconnexion'])) {
            ?>
            <form method="post"> 
                <h5>Email :</h5>
                <input name="mel" class="form-control" type="text">
                <h5>Mot de passe :</h5>
                <input name="motdepasse" class="form-control" type="password">
                <div class="text-center mt-2">
                    <input type="submit" class="btn btn-success" name="btnconnexion" value="Connexion">
                </div>
            </form>
            <?php
        } else {
            require_once 'connexion.php';
            $mel = $_POST['mel'];
            $motdepasse = $_POST['motdepasse'];

            $stmt = $connexion->prepare("SELECT * FROM utilisateur WHERE mel=:mel AND motdepasse=:motdepasse");
            $stmt->bindValue(":mel", $mel); 
            $stmt->bindValue(":motdepasse", $motdepasse); 
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            $stmt->execute();
            $enregistrement = $stmt->fetch(); 

            if ($enregistrement) { 
                $_SESSION["mel"] = $mel;
                $_SESSION["prenom"] = $enregistrement->prenom;
                $_SESSION["nom"] = $enregistrement->nom;
                $_SESSION["profil"] = $enregistrement->profil;

                if ($_SESSION["profil"] === "admin") {
                    header("Location: index.php"); 
                } else {
                    header("Location: index.php"); 
                }
                exit();
            } else { 
                echo "Échec de la connexion.";
                header("Refresh:2");
                exit();
            }
        }
    } else {
        ?>
        <div class="text-center">
            <h3><?= $_SESSION["prenom"] . ' ' . $_SESSION["nom"]; ?></h3>
            <p><?= $_SESSION["mel"]; ?></p>
            <p class="badge bg-info text-dark">Profil : <?= $_SESSION["profil"]; ?></p>
            
            <form method="post">
                <button class="btn btn-danger" name="deco" type="submit">Déconnexion</button>
            </form>
        </div>
        <?php
        if (isset($_POST['deco'])) {
            session_unset();
            session_destroy();
            header("Location: index.php");
            exit();
        }
    }
?>