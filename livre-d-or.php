<?php include_once 'inc/inc.config.php'; ?>
<?php include_once 'admin/classes/utils.php';?>
<?php 
require_once 'admin/classes/Goldbook.php';

	$goldbook = new Goldbook();
	$result2 = $goldbook->goldbookGet(null);
	print_r($result);
	
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
      <?php if (!empty($result2)) : 
            $i=0;?>
          <?php foreach ($result2 as $value) : 
                $i++; ?>
              <?php if($value['online']=='1') :?>
              <div class="large-6 medium-12 small-12 cell" text-center>
                 <p>
                    <strong><?php echo $value['nom'] ?></strong>&nbsp;(<?php echo traitement_datetime_affiche($value['date']) ?>)
                 </p>
                <p>
                    <?php echo nl2br($value['message']) ?>
                </p>
              </div>	
              <?php if ($i%2==0) : ?>
                 <div class="large-12 medium-12 small-12 cell" text-center>&nbsp;</div>
              <?php endif;?>
              <?php endif;?>
          <?php endforeach;?>
      <?php endif;?>
      
    </section>
  
    <section class="grid-x grid-padding-x" role="">
      <div class="large-12 medium-12 small-12 cell" text-center>
        <h1>Laissez-nous votre témoignage</h1>
      </div>
			 <div id="resultat"></div>					
    </section>
    
     <section class="grid-x grid-padding-x" data-role="livreor">
     
      <div class="large-12 medium-12 small-12 cell">
        <img src="assets/img/bubbles.svg" alt="bulles">
        
        <form class="grid-x grid-padding-x" data-animation="top" id="formulaire" method="post" action="livre-d-or.php">
            <input type="hidden" name="datepicker"   value="<?php echo date("d/m/Y")?>">
          <div class="large-5 medium-5 small-12 cell">
            <input type="text" name="nom" placeholder="Nom" required /><input type="text" name="prenom" placeholder="Prénom"  required />
            <input type="email" name="email" placeholder="e-mail" required />
          </div>
          <div class="large-7 medium-7 small-12 cell">
             <textarea name="message" placeholder="Votre message ici" required ></textarea>
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
		        url: '/ajax/goldbook.php',
		        type: 'post',
		        data: data,
		        success: function (data) {
		            $("#resultat").html("<h3>Merci pour votre message</h3>");
		        	$("#nom").val("");
		        	$("#prenom").val("");
		           	$("#email").val("");
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
