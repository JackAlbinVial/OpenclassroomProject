<?php
    /**
 * Affichage de la partie admin : liste des articles avec un bouton "modifier" pour chacun.
 * Et un formulaire pour ajouter un article.
 * Et liste des articles avec tri par colonne.
 */

    // Fonction helper pour générer l'URL de tri d'une colonne
    function sortUrl(string $column, string $currentSort, string $currentOrder): string
    {
    $newOrder = ($currentSort === $column && $currentOrder === 'ASC') ? 'DESC' : 'ASC';
    return "index.php?action=admin&sort=$column&order=$newOrder";
    }

    // Fonction helper pour afficher l'icône de tri
    function sortIcon(string $column, string $currentSort, string $currentOrder): string
    {
    if ($currentSort !== $column) {
        return '<i class="fi fi-br-angles-up-down"></i>';
    }
    return $currentOrder === 'ASC'
        ? '<i class="fi fi-br-angle-up"></i>'
        : '<i class="fi fi-br-angle-down"></i>';
    }
?>

<h2>Edition des articles</h2>

<table class="adminArticle">
    <thead>
        <tr>
            <th><a href="<?php echo sortUrl('title', $sort, $order) ?>">Titre <?php echo sortIcon('title', $sort, $order) ?></a></th>
            <th>Contenu</th>
            <th><a href="<?php echo sortUrl('vues', $sort, $order) ?>">Vues <?php echo sortIcon('vues', $sort, $order) ?></a></th>
            <th><a href="<?php echo sortUrl('nb_comments', $sort, $order) ?>">Commentaires <?php echo sortIcon('nb_comments', $sort, $order) ?></a></th>
            <th><a href="<?php echo sortUrl('date_creation', $sort, $order) ?>">Date <?php echo sortIcon('date_creation', $sort, $order) ?></a></th>
            <th class="col-actions"></th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($articles as $article) {?>
            <tr>
                <td class="col-title"><?php echo mb_strimwidth($article->getTitle(), 0, 38, '...') ?></td>
                <td class="col-content"><?php echo $article->getContent(200) ?></td>
                <td class="col-center"><?php echo $article->getVues() ?></td>
                <td class="col-center"><?php echo $article->getNbComments() ?></td>
                <td class="col-center"><?php echo $article->getDateCreation()->format('d/m/Y') ?></td>
                <td class="col-actions">
                    <a class="submit" id="edit" href="index.php?action=showUpdateArticleForm&id=<?php echo $article->getId() ?>">
                        <i class="fi fi-rr-pencil"></i>
                    </a>
                    <a class="submit" id="delete"
                       href="index.php?action=deleteArticle&id=<?php echo $article->getId() ?>"
                       <?php echo Utils::askConfirmation("Êtes-vous sûr de vouloir supprimer cet article ?") ?>>
                        <i class="fi fi-br-trash"></i>
                    </a>
                </td>
            </tr>
        <?php }?>
    </tbody>
</table>

<a class="submit" href="index.php?action=showUpdateArticleForm">Ajouter un article</a>