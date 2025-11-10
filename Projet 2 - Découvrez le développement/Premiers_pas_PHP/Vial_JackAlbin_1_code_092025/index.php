<?php include_once 'header.php';
include_once 'oeuvres.php'; ?>

<div id="liste-oeuvres">
    <?php foreach ($oeuvres as $oeuvre) {?>
        <article class="oeuvre">
            <a href="oeuvre.php?id=<?php echo $oeuvre['id']; ?>">
                <img src="<?php echo $oeuvre['image']; ?>" alt="<?php echo $oeuvre['title']; ?>">
                <h2><?php echo $oeuvre['title']; ?></h2>
                <p class="description"><?php echo $oeuvre['artiste']; ?></p>
            </a>
        </article>
    <?php }?>
</div>

<?php include_once 'footer.php'; ?>