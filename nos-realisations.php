<?php 
include_once 'inc/inc.config.php';
include_once 'admin/classes/utils.php';
require_once 'admin/classes/Catrealisation.php';

$catproduct = new Catrealisation();
$result = $catproduct->catrealisationGetParent();
//print_r($result);
?>
<!doctype html>
<html class="no-js" lang="fr">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eden Blue</title>
    <link rel="stylesheet" href="assets/css/all.min.css">
    <link rel="stylesheet" href="assets/css/foundation.css">
    <link rel="stylesheet" href="assets/css/swiper-bundle.min.css">
    <link rel="stylesheet" href="assets/css/app.css">
  </head>
<body class="not-home">

  <?php include 'inc/inc.header.php'; ?>

  <main class="grid-container">

    <section class="grid-x grid-padding-x" role="gallery">
      <div class="large-12 medium-12 small-12 cell">
        <h1>Nos realisations</h1> 
            <h3>Parce-que vos reves sont notre preoccupation</h3>
            <p data-animation="top">
                Nous vous invitons à visiter notre galerie, qui fera naître en vous l’envie et l’inspiration.
                Choisissez le style de piscine le plus adapté à vos besoin : couloir de nage, à débordement, miroir et bien d’autre encore…
            </p>
      </div>
    <?php if ( !empty( $result ) ) :    ?>
       <?php foreach ( $result as $value ) :  ?>
      <div class="large-4 medium-4 small-12 cell">
        <a href="nos-realisations-detail.php?id=<?php echo $value['id']?>">
          <figure data-animation="top">
            <img src="photos/catrealisation/normale<?php echo $value['fichier']?>" alt="Nos réalisations contemporaines">
            <figcaption><?php echo $value['label']?></figcaption>
          </figure>
        </a>
      </div>
      <?php endforeach;?>
    <?php endif;?>  
    </section>

  </main>

  <?php include 'inc/inc.footer.php'; ?>

</body>
</html>
