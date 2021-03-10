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
        <h1>Notre livre d'or</h1>
      </div>
      
      <div class="large-6 medium-12 small-12 cell" text-center>
         <p>
            <strong>Xavier Gonzalez</strong> (12/07/2019)
         </p>
        <p>
            Un prestation sérieuse et complète, des professionnels présents et qui vous accompagnent durant toute la mise ne oeuvre avec en outre une qualité et solidité très haut de gamme. Je recommande chaudement.
        </p>
      </div>	
      <div class="large-6 medium-12 small-12 cell" text-center>
         <p>
            <strong>ELISABETH PROVOST</strong> (10/04/2019)
         </p>
        <p>
            Une équipe d'enfer, et toujours disponible.
            Travaux réalisé chez mes parents à CAVIGNAC au top, merci pour votre professionnalisme 
        </p>
      </div>	
      
      <div class="large-12 medium-12 small-12 cell" text-center>
       &nbsp;
      </div>
      
      
      <div class="large-6 medium-12 small-12 cell" text-center>
         <p>
            <strong>olette mirac</strong> (12/08/2018)
         </p>
        <p>
            Super travail, bon conseil. Couple adorable.
        </p>
      </div>	
      <div class="large-6 medium-12 small-12 cell" text-center>
         <p>
            <strong>Pascale LUCAS</strong> (20/06/2018)
         </p>
        <p>
            Vous souhaitez avoir une belle piscine, un produit voire même un simple renseignement... n hésitez pas à contacter ÉDEN BLUE. Une équipe sérieuse et professionnelle.
        </p>
      </div>	
								
    </section>
  
    <section class="grid-x grid-padding-x" role="">
      <div class="large-12 medium-12 small-12 cell" text-center>
        <h1>Laissez-nous votre témoignage</h1>
      </div>
								
    </section>
    
     <section class="grid-x grid-padding-x" data-role="livreor">
      
      <div class="large-12 medium-12 small-12 cell">
        <img src="assets/img/bubbles.svg" alt="bulles">
        
        <form class="grid-x grid-padding-x" data-animation="top">
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
