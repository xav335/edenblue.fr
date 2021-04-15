<?php include_once '../inc/inc.config.php'; ?>
<?php include_once 'inc-auth-granted.php';?>
<?php include_once 'classes/utils.php';?>
<?php 
require 'classes/Catrealisation.php';
require 'classes/Catrealisation_image.php';

if (!empty($_GET)){ //Modif 
	$action = 'modif';
	$catrealisation =          new Catrealisation();
	$catrealisation_image =    new Catrealisation_image();
	
	
}


// ---- Modification ---------------------------- //
if ( !empty( $_GET ) ) {
    $action = 'modif';
    $result = $catrealisation->catproductGet($_GET['id']);

    if ( !empty( $result ) ) {
        $titre_page = 	'Catégorie "'. $result[ 0 ][ "label" ] . '"';
        $labelTitle = 'Catégorie N°: '. $_GET['id'];
		$id_produit= 			$_GET['id'];
		$label=  		$result[0]['label'];
		$description= 		$result[0]['description'];
        	
        	
        // ---- Liste des photos associées  ---- //
        if ( 1 == 1 ) {
            unset( $recherche );
            $recherche[ "num_produit" ] = $_GET[ "id" ];
            $liste_image = $catrealisation_image->getListe( $recherche);
            //print_r($liste_image);
            
        }
        // -------------------------------------------------- //
        	
    }
    else $message = 'Aucun enregistrement';
}

// ---- Ajout d'une rubrique -------------------- //
else {
    $action = 'add';
    $titre_page = 	'Nouveau produit';
    $id	=			null;
    $nom = 			null;
    $description =	null;
    $img[ 1 ] = 	"/img/favicon.png";
    $imgval[ 1 ] = 	"/img/favicon.png";
    $fichier_pdf = 	'';
    $accueil = 		'0';
    $online = 		'0';

    $display_pdf = "none";
    $display_pdf_img = "block";

}


?>
<!doctype html>
<html class="no-js" lang="fr">
<head>
	<?php include_once 'inc-meta.php';?>
</head>
<body>	
	<?php require_once 'inc-menu.php';?>

	<div class="container">

		<div class="row">
			<h3><?php echo $labelTitle ?></h3>
			<div class="col-xs-12 col-sm-12 col-md-12">
				<form name="formulaire" id="formulaire" class="form-horizontal" method="POST"  action="catrealisation-fp.php">
					<input type="hidden" name="action" id="action" value="modif">
					<input type="hidden" name="reference" value="catrealisation">
					<input type="hidden" name="id" id="id" value="<?=$id_produit?>">
					<input type="hidden" name="num_image" id="num_image" value="">
					<div class="form-group" >
						<label class="col-sm-1" for="titre">Titre :</label>
					    <input type="text" class="col-sm-11" name="label" required  value="<?php echo $label ?>">
					</div>
					<div class="form-group">
						<label for="accroche">Description :</label><br>
		           		<textarea class="col-sm-11" name="description" id="contenu" rows="6"  ><?php echo $description ?></textarea>
		            </div>
		           <div class="col-md-6" style="margin-bottom:20px;">
							<label for="titre">Choix des photos </label><br>
							<input type="hidden" name="url0" id="url0" value=""><br>
							<input type="hidden"  name="idImage"  id="idImage" value="">
	            			<a href="javascript:openCustomRoxy('0')"><img id="" src="img/choisirImageIci.png" id="customRoxyImage0" style="max-width:400px;"></a>
					</div>
					
				
				    <div id="roxyCustomPanel" style="display: none;">
  							<iframe src="/admin/fileman2/index.html?integration=custom" style="width:100%;height:100%" frameborder="0"></iframe>
					</div>
					
				    <div style="clear:both;"></div>
				    <div id="div_liste_image">
							<?
							// ---- Affichage de la liste des images déjà associées à cette offre ---- //
							if ( !empty( $liste_image ) ) :
								$cpt = 0;
								foreach( $liste_image as $_image ) : ?>
									
									<div class="col-md-3" style="text-align:center; margin-bottom:20px; border:0px solid red;">
									 <a data-fancybox="ppp" href="/photos/catrealisation/normale<?php echo $_image["fichier"]?>">
				            		  <img src="/photos/catrealisation/accueil<?php echo $_image["fichier"]?>" width="230" style="max-width:230px;"></a><br>
				            		<?php if ( $_image[ "defaut" ] == 'non' ) : ?>
				            		      <input type='button' id='<?php echo $_image[ "num_image" ]?>' value='Par défaut' class='par_defaut' />
				            		<?php endif; ?>      
				            		      <input type='button' id='<?php echo $_image[ "num_image" ]?>' value='Supprimer' class='supprimer_image_precise' />
									</div>
									
									<?php if ( $cpt % 4 == 4 ) : ?>
									   <div style='clear:both;'></div>
									
									<?php endif;   
									$cpt++;
								endforeach;
							endif;
							// ----------------------------------------------------------------------- //
							?>
					</div>
				     
			</div>
			<div class="col-md-12" style="margin-bottom:20px;">
						<a href="catrealisation-list.php" class="btn btn-success col-sm-6" class="btn btn-default annuler"> Retour liste </a>	
						<button type="submit" class="btn btn-success col-sm-6" class="btn btn-default"> Valider </button>
					</div>	
				  </form>
		</div>
	</div>
	
	<script type="text/javascript">
			var cpt = 0;
			
			function openCustomRoxy(idImage){
				$( "#url0" ).val( '' );
				$( "#url1" ).val( '' );
				
				$('#idImage').val(idImage);
			 	$('#roxyCustomPanel').dialog({modal:true, width:875,height:600});
			}
			
			function closeCustomRoxy(){
			  	$('#roxyCustomPanel').dialog('close');
			  	
			  	// ---- Contenu photo --------------------- //
			  	if ( $( "#url0" ).val() != '' ) {
			  		//alert( "Photos..." );
			  		
			  		var fichier_image = $( "#url0" ).val();
			  		var contenu = "<div id='div_image_" + cpt + "' class='col-md-3' style='text-align:center; margin-bottom:20px; border:0px solid red;'>\n";
					contenu += "	<input type='hidden' name='mes_images[]' value='" + fichier_image + "' />\n";
            		contenu += "	<img src='" + fichier_image + "' width='230' style='max-width:230px;'></a><br>\n";
            		//contenu += "	<input type='button' value='Par défaut' />\n";
            		contenu += "	<input type='button' id='" + cpt + "' value='Supprimer' class='supprimer_image' />\n";
					contenu += "</div>";
					
					if ( ( cpt % 4 ) == 4 ) contenu += "<div style='clear:both;'></div>\n";
					
					$( "#div_liste_image" ).append( contenu );
					cpt++;
			  	}
			  	// ---------------------------------------- //
			  	
			  	
			  	// ---- Contenu du PDF -------------------- //
			  	else if ( $( "#url1" ).val() != '' ) {
			  		$( "#div_pdf_img" ).hide();
			  		
			  		$( "#url1_changement" ).val( "changer pdf" );
			  		$( "#span_pdf" ).html( $( "#url1" ).val() );
			  		$( "#div_pdf" ).show();
			  	}
			  	// ---------------------------------------- //
			  	
			}
			
			function clearImage(idImage){
				$('#customRoxyImage'+idImage).attr('src', '/img/favicon.png');
				$('#url'+idImage).val('');
			}
			
			function annuler_pdf() {
				$( "#url1_changement" ).val( "changer pdf" );
				$( "#url1" ).val( '' );
				
				$( "#div_pdf" ).hide();
				$( "#div_pdf_img" ).show();
			}
			
			$( document ).on( "click", ".supprimer_image", function() {
				var val = $(this).attr( "id" );
				//alert( "Suppression de l'image " + val );
				$( "#div_image_" + val ).remove();
			});
			
			$( ".par_defaut" ).click(function() {
				var val = $(this).attr( "id" );
				//alert( "Image #" + val + " par defaut" );
				
				$( "#num_image" ).val( val );
				$( "#action" ).val( "par defaut" );
				$( "#formulaire" ).submit();
			});
			
			$( ".supprimer_image_precise" ).click(function() {
				var val = $(this).attr( "id" );
				//alert( "Suppression de l'image #" + val );
				//console.log(val);
				$( "#num_image" ).val( val );
				$( "#action" ).val( "supprimer image" );
				$( "#formulaire" ).submit();
			});
			
			$( ".annuler" ).click(function() {
				window.location.href = "./liste.php";
			});
			
			$( ".valider" ).click(function() {
				//alert( "On poste..." );
				var is_coche = false;
				
				// ---- Il faut a moins un type de bien sélectionné ---- //
				if ( 1 == 1 ) {
					$( ".type_bien" ).each( function( index ) {
						//console.log( index + ": " + $( this ).text() );
						if (  $(this).is( ":checked" ) ) {
							//alert( "coché!!!" );
							is_coche = true;
							return false;
						}
					});
				}
				
				// ---- Tout va bien --> On poste ---------------------- //
				if ( is_coche ) {
					$( "#formulaire" ).submit();
					//alert( "On poste..." );
				}
				else alert( "Veuillez cocher au moins un type de bien." );
				
				return false;
			});
			
		</script>
		
</body>
</html>


