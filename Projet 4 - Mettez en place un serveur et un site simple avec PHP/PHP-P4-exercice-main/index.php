<?php
    require 'header.php';
    require 'bdd.php';

    $bdd     = connexion();
    $oeuvres = $bdd->query('SELECT * FROM oeuvre');
?>
<div id="liste-oeuvres">
    <?php foreach ($oeuvres as $oeuvre): ?>
        <article class="oeuvre">
            <a href="oeuvre.php?id=<?php echo $oeuvre['Id'] ?>">
                <img src="<?php echo $oeuvre['Image'] ?>" alt="<?php echo $oeuvre['Titre'] ?>">
                <h2><?php echo $oeuvre['Titre'] ?></h2>
                <p class="Description"><?php echo $oeuvre['Artiste'] ?></p>
            </a>
        </article>
    <?php endforeach; ?>
</div>
<?php require 'footer.php'; ?>
