<?php 
include_once 'inc/inc.config.php';
include_once 'admin/classes/utils.php';
?>
<!doctype html>
<html class="no-js" lang="fr">
  <head>
    <?php include 'inc/inc.head.php'; ?>
    <title>Eden Blue -  Livre d'or</title>
  </head>
<body class="not-home">

  <?php include 'inc/inc.header.php'; ?>

  <main class="grid-container">

    <section class="grid-x grid-padding-x" role="">
      <div class="large-12 medium-12 small-12 cell" text-center>
        <h1>Livre d'or</h1>
      </div>
								
    </section>
    
    
    
     <section class="grid-x grid-padding-x" data-role="livreor">
      
      <div class="large-12 medium-12 small-12 cell">
        <img src="assets/img/bubbles.svg" alt="bulles">
        <form class="grid-x grid-padding-x" data-animation="top">
          <div class="large-12 medium-12 small-12 cell">
            <h2>Laissez-nous votre témoignage</h2>
          </div>
          <div class="large-5 medium-5 small-12 cell">
            <input type="text" name="nom" placeholder="Nom" /><input type="text" name="prenom" placeholder="Prénom" />
            <input type="email" name="email" placeholder="e-mail" />
          </div>
          <div class="large-7 medium-7 small-12 cell">
             <textarea name="message" placeholder="Votre message ici"></textarea>
          </div>
          <div class="large-12 medium-12 small-12 cell">
            <input type="submit" value="Envoyer">
          </div>
        </form>
      </div>
      
      
    </section>

  </main>

  <?php include 'inc/inc.footer.php'; ?>

</body>
</html>
