<?php
if (empty($_POST['Titre']) ||
    empty($_POST['Description']) ||
    empty($_POST['Artiste']) ||
    empty($_POST['Image']) ||
    strlen($_POST['Description']) < 3 ||
    ! filter_var($_POST['Image'], FILTER_VALIDATE_URL)) {

    header('Location: ajouter.php');

} else {
    $titre       = htmlspecialchars($_POST['Titre']);
    $description = htmlspecialchars($_POST['Description']);
    $artiste     = htmlspecialchars($_POST['Artiste']);
    $image       = htmlspecialchars($_POST['Image']);

    require 'bdd.php';
    $bdd = connexion();

    $requete = $bdd->prepare('INSERT INTO oeuvre (Titre, Description, Artiste, Image) VALUES (?, ?, ?, ?)');
    $requete->execute([$titre, $description, $artiste, $image]);

    header('Location: oeuvre.php?id=' . $bdd->lastInsertId());
}
