<?php include_once "header.php";
    include_once "oeuvres.php";
    $id   = $_GET["id"];
    $oeuv = null;

    foreach ($oeuvres as $oeuvre) {
        if ($id == $oeuvre["id"]) {
            $oeuv = $oeuvre;
        }
    }
?>

<article id="detail-oeuvre">
  <div id="img-oeuvre">
      <img src="<?php echo $oeuv['image']; ?>" alt="<?php echo $oeuv['title']; ?>" />
  </div>

  <div id="contenu-oeuvre">
    <h1><?php echo $oeuv['title'] ?></h1>
          <p class="description"><?php echo $oeuv['artiste']; ?></p>
          <p class="description-complete">
            <?php echo $oeuv['description']; ?>
          </p>
        </div>
</article>


<?php include_once 'footer.php'; ?>