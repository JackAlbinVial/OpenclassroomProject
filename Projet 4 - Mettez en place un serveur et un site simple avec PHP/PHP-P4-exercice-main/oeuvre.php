<?php
    require 'header.php';
    require 'bdd.php';

    $bdd = connexion();

    $CountOeuvre = $bdd->query('SELECT COUNT(*) FROM oeuvre');
    $maxOeuvre   = (int) $CountOeuvre->fetchColumn();

    //Si l'id de l'url est supperieur à l'id max de la bdd, on redirige sur la page d'accueil
    if ($_GET['id'] > $maxOeuvre) {
        header('Location: index.php');
    }

    /*une fois qu'on a vérifier que l'url contient un id bien borné
    on peut passer à la suite du traitement*/

    $requete = $bdd->prepare('SELECT * FROM oeuvre WHERE id = ?');
    $requete->execute([$_GET['id']]);
    $oeuvre = $requete->fetch();

    // Si l'URL ne contient pas d'id, on redirige sur la page d'accueil
    if (empty($_GET['id'])) {
        header('Location: index.php');
    }

    // Si aucune oeuvre trouvé, on redirige vers la page d'accueil
    if (is_null($oeuvre)) {
        header('Location: index.php');
    }

?>

<article id="detail-oeuvre">
    <div id="img-oeuvre">
        <img src="<?php echo $oeuvre['Image'] ?>" alt="<?php echo $oeuvre['Titre'] ?>">
    </div>
    <div id="contenu-oeuvre">
        <h1><?php echo $oeuvre['Titre'] ?></h1>
        <p class="Description"><?php echo $oeuvre['Artiste'] ?></p>
        <p class="description-complete">
             <?php echo $oeuvre['Description'] ?>
        </p>
    </div>
</article>

<?php require 'footer.php'; ?>
