<?php 
include_once 'inc/inc.config.php';
include_once 'admin/classes/utils.php';
?>
<!doctype html>
<html class="no-js" lang="fr">
<head>
    <?php include 'inc/inc.head.php'; ?>
    <title>Eden Blue - Contact - Plan d'accès</title>
</head>
<body class="not-home">

  <?php include 'inc/inc.header.php'; ?>

  <main class="grid-container">

	<section class="grid-x grid-padding-x" role="">
		<div class="large-12 medium-12 small-12 cell" text-center>
			<h1>Contactez nous - Plan d'accès</h1>
		</div>
		<div id="resultat"></div>
	</section>

	<section class="grid-x grid-padding-x" data-role="votre-projet">
		<div class="large-5 medium-5 small-12 cell">
			<img src="assets/img/enfant-brassards.svg" alt="enfant brassards"> <img
				src="assets/img/nageuse.svg" alt="nageuse"> <img
				src="assets/img/bubbles.svg" alt="bulles">
		</div>
		<div class="large-7 medium-7 small-12 cell">
			<img src="assets/img/bubbles.svg" alt="bulles">
			<form class="grid-x grid-padding-x" data-animation="top"
				id="formulaire" method="post" action="contact.php">
				<div class="large-12 medium-12 small-12 cell">
					<h2>Parlons de votre projet</h2>
				</div>
				<div class="large-6 medium-6 small-12 cell">
					<input type="text" name="nom" id="nom" placeholder="Nom" required /><input
						type="text" name="prenom" id="prenom" placeholder="Prénom" /> <input
						type="text" name="cp" id="cp" placeholder="Code postal" /><input
						type="text" name="ville" id="ville" placeholder="Ville" /> <input
						type="email" name="email" id="email" placeholder="e-mail" required />
					<input type="tel" name="tel" id="tel" placeholder="telephone" />
				</div>
				<div class="large-6 medium-6 small-12 cell">
					<textarea name="message"
						placeholder="Votre projet en quelques mots"></textarea>
				</div>
				<div class="large-6 medium-6 small-12 cell"></div>
				<div class="large-6 medium-6 small-12 cell">
					<input type="submit" value="Être rappelé(e)">
				</div>
			</form>
		</div>
		<div class="large-12 medium-12 small-12 cell">
			<div data-animation="right">
				<a href="#" target="_blank"><i class="fab fa-facebook-square"></i></a>
				<a href="tel:+33533880011">05 33 88 00 11</a>
			</div>
		</div>


	</section>

	<div class="large-12 medium-12 small-12 cell" text-center>
		<hr>
	</div>


	<section class="grid-x grid-padding-x" role="">
		<div class="large-12 medium-12 small-12 cell">
			<iframe
				src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d18339.204939930278!2d-0.41934575523646817!3d45.04323182712202!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x4e0fa023239ba576!2sEden+Blue!5e0!3m2!1sfr!2sfr!4v1481302103226"
				width="100%" height="480" frameborder="0" style="border: 0"
				allowfullscreen></iframe>
		</div>
	</section>

	<section class="grid-x grid-padding-x" role="">
		<div class="large-4 medium-12 small-12 cell" text-center>&nbsp;</div>
		<div class="large-4 medium-12 small-12 cell" text-center>
			<img src="assets/img/trophe.jpg" alt="trophe de la piscine or et spa 2020 edenblue.fr">
		</div>
		<div class="large-4 medium-12 small-12 cell" text-center>&nbsp;</div>
	</section>

	<div class="large-12 medium-12 small-12 cell" text-center>
		<hr>
	</div>

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
