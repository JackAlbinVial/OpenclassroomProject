<?php require 'header.php'; ?>

<form action="traitement.php" method="POST">
    <div class="champ-formulaire">
        <label for="Titre">Titre de l'œuvre</label>
        <input type="text" name="Titre" id="Titre" required>
    </div>
    <div class="champ-formulaire">
        <label for="Artiste">Auteur de l'œuvre</label>
        <input type="text" name="Artiste" id="Artiste" required>
    </div>
    <div class="champ-formulaire">
        <label for="Image">URL de l'image</label>
        <input type="url" name="Image" id="Image" required>
    </div>
    <div class="champ-formulaire">
        <label for="Description">Description</label>
        <textarea name="Description" id="Description" required></textarea>
    </div>

    <input type="submit" value="Valider" name="submit">
</form>

<?php require 'footer.php'; ?>
