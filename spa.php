<!doctype html>
<html class="no-js" lang="fr">
  <head>
    <?php include 'inc/inc.head.php'; ?>
    <title>Eden Blue</title>
  </head>
<body class="spa">

<?php include 'inc/inc.header.php'; ?>

  <main class="grid-container">

    <section class="grid-x grid-padding-x" data-role="introduction">
      <div class="large-12 cell">
        <h1 data-animation="top">Spa, prenez soin de vous</h1>
        <p data-animation="top">
            Sortez de votre vie trépidante en plongeant dans les eaux apaisantes, effervescentes et cristallines des Spa Dynatsty! 
        </p>
       
      </div>
      <div class="large-12 cell" role="spadetail">
        <div class="grid-x grid-padding-x">
          <div class="large-4 cell"></div>
          <div class="large-4 cell"><a href="spa-serie-club.php"><img src="assets/img/gammeclub/cl84c.png" alt="" class="img-spa-top" /></a></div>
          <div class="large-4 cell"></div>
          <div class="large-4 cell text-right">
            <div class="legende"><a href="spa-serie-club.php">Serie Club</a><br/><br/><a href="spa-serie-sensation.php">Serie sensation</a></div>
            <a href="spa-serie-sensation.php"><img src="assets/img/gammesensation/amara-vuecote-edenblue.png" alt="" class="img-spa" data-animation="right" /></a>
          </div>
          <div class="large-4 cell"></div>
          <div class="large-4 cell">
             <a href="spa-serie-privilege.php"><img src="assets/img/gammeprivilege/nautilus-vuecote-edenblue.png" alt="" class="img-spa" data-animation="left" /></a>
            <div class="legende">
              <a href="spa-serie-privilege.php">Série privilège</a> <br/><br/>
               <a href="spa-serie-sport.php">Serie sport</a>
            </div>
          </div>
          <div class="large-4 cell"></div>
          <div class="large-4 cell"><a href="spa-serie-sport.php"><img src="assets/img/gammesport/aquex19-vuecote-edenblue.png" alt="" class="img-spa-bottom" /></a></div>
          <div class="large-4 cell"></div>
        </div>
      </div>
     </section>  
     
     <section class="grid-x grid-padding-x" data-role="gallery">
      <div class="large-12 medium-12 small-12 cell text-center">
        <h2 data-animation="top">Un large choix d'équipements</h2>
        <ul>
             <li>Un choix d’équipement et de finitions à la hauteur suivant les séries</li>
             <li>Système de traitement Ozonateur / UV qui stérilise et désinfecte l’eau</li>
             <li>Le système Aqukinetic au cœur des soin</li>
             <li>Système d’isolation Ecologique RMAX</li>
             <li>La chromothérapie et la réflexologie</li>
             <li>La gestion de votre spa par clavier tactile couleur</li>
         </ul>
      </div>
      <div id="resultat"></div>
    </section>

    <section class="grid-x grid-padding-x" data-role="votre-projet">
      <div class="large-5 medium-5 small-12 cell">
        <img src="assets/img/mousse-1st-plan.svg" alt="mousse premier-plan">
        <img src="assets/img/mousse-1st-plan.svg" alt="mousse premier-plan 2">
        <img src="assets/img/femme-spa.svg" alt="femme spa">
        <img src="assets/img/homme-spa.svg" alt="homme spa">
        <img src="assets/img/mousse-last-plan.svg" alt="mousse arriere-plan">
      </div>
      <div class="large-7 medium-7 small-12 cell">
        <form class="grid-x grid-padding-x" data-animation="top" id="formulaire" method="post" action="contact.php">
         <input type="hidden" name="from" value="espace spa">
          <div class="large-12 medium-12 small-12 cell">
            <h2>Parlons de votre projet</h2>
          </div>
          <div class="large-6 medium-6 small-12 cell">
            <input type="text" name="name" id="nom" placeholder="Nom" required /><input type="text" name="firstname" id="prenom" placeholder="Prénom" /> 
			<input type="text" name="cp" id="cp" placeholder="Code postal" /><input type="text" name="town" id="ville" placeholder="Ville" />
			<input type="email" name="email" id="email" placeholder="e-mail" required />
			<input type="tel" name="phone" id="tel" placeholder="telephone" />
          </div>
          <div class="large-6 medium-6 small-12 cell">
            <textarea name="message" id="message" placeholder="Votre projet en quelques mots"></textarea>
          </div>
          <div class="large-6 medium-6 small-12 cell"></div>
          <div class="large-6 medium-6 small-12 cell">
            <input type="submit" value="Être rappelé(e)">
          </div>
        </form>
      </div>
      <div class="large-12 medium-12 small-12 cell">
        <div data-animation="right"><a href="#" target="_blank"><i class="fab fa-facebook-square"></i></a> <a href="tel:+33533880011">05 33 88 00 11</a></div>
      </div>
    </section>

  </main>

  <?php include 'inc/inc.footer.php'; ?>

</body>
<script type="text/javascript">

	$(document).on('submit','#formulaire',function(e) {
	  e.preventDefault();
	  data = $(this).serializeArray();

	  data.push({
	   		name: 'action',
	    	value: 'sendMail'
	  	})

	  console.log(data);

	    /* I put the above code for check data before send to ajax*/
	    $.ajax({
		        url: '/ajax/contact.php',
		        type: 'post',
		        data: data,
		        success: function (data) {
		            $("#resultat").html("<hr><h2 class='sous-titre'>Merci pour votre message</h2><hr>");
		        	$("#nom").val("");
		        	$("#prenom").val("");
		        	$("#ville").val("");
		        	$("#cp").val("");
		           	$("#email").val("");
		         	$("#tel").val("");
		           	$("#message").val("");
		        },
		        error: function() {
		        	 $("#resultat").html("<h3>Une erreur s'est produite !</h3>");
		        }
		   	});
	return false;
	})

</script>
</html>
