<?php
    try {
        $dns = 'mysql:host=localhost;dbname=bibliodrive';
        $utilisateur = 'root';
        $motDePasse = '';
        $connexion = new PDO($dns, $utilisateur, $motDePasse);
    } catch (Exception $e) {
        die("Connexion impossible");
    }
?>