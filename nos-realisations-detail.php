<?php 
include_once 'inc/inc.config.php';
include_once 'admin/classes/utils.php';
require_once 'admin/classes/Catrealisation.php';
require_once 'admin/classes/Catrealisation_image.php';

if (!empty($_GET)){
    $catrealisation =          new Catrealisation();
    $catrealisation_image =    new Catrealisation_image();
    $result = $catrealisation->catproductGet($_GET['id']);
    
    $titre = $result[0]['label'];
    $description = $result[0]['description'];
    
    unset( $recherche );
    $recherche[ "num_produit" ] = $_GET[ "id" ];
    $liste_image = $catrealisation_image->getListe( $recherche);
}
//print_r($result[0]);
//print_r($liste_image);
?>
<!doctype html>
<html class="no-js" lang="fr">
  <head>
    <?php include 'inc/inc.head.php'; ?>
    <title>Eden Blue</title>
  </head>
<body class="not-home">

  <?php include 'inc/inc.header.php'; ?>

  <main class="grid-container">

    <section class="grid-x grid-padding-x" role="gallery">
      <div class="large-12 medium-12 small-12 cell">
        <h1><?php echo $titre ?></h1>
         <p data-animation="top">
            <?php echo nl2br($description) ?>
         </p>
      </div>
    <?php if ( !empty( $liste_image ) ) : ?>
		<?php foreach( $liste_image as $_image ) : ?>
				
	  <div class="large-3 medium-4 small-12 cell">
        <a data-fancybox="<?php echo $titre ?>" href="photos/catrealisation/normale<?php  echo $_image["fichier"]?>"><img src="photos/catrealisation/normale<?php echo  $_image["fichier"]?>" alt="Nom de la photo" data-animation="top"></a>
      </div>
	
        <?php endforeach;?>		
	<?php endif;?>					
								
    </section>

  </main>

  <?php include 'inc/inc.footer.php'; ?>

</body>
</html>
