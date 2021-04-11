<?php include_once '../inc/inc.config.php'; ?>
<?php include_once 'inc-auth-granted.php';?>
<?php include_once 'classes/utils.php';?>
<?php 
require 'classes/Cattutos.php';

if (!empty($_GET)){ //Modif 
	$action = 'modif';
	$stuff = new Cattutos();
}

// ---- Modification ---------------------------- //
if ( !empty( $_GET ) ) {
    $action = 'modif';
    $result = $stuff->catStuffGet($_GET['id']);
    //print_r($result); 
    
    if ( !empty( $result ) ) {
        $labelTitle = 'Tuto N°: '. $_GET['id'];
		$id= 			$_GET['id'];
		$titre=  		$result[0]['titre'];
		$date= 	traitement_datetime_affiche($result[0]['date']);
		$accroche= 		$result[0]['accroche'];
		$contenu= 	$result[0]['contenu'];
		$video= 	$result[0]['video'];
		$fichier_pdf= 	$result[0]['fichier_pdf'];
		if($result[0]['online']=='1') {
			$online = 'checked';
		} else {
			$online = '';
		}
        	
		$display_pdf = ( $fichier_pdf != '' ) ? "block" : "none";
		$display_pdf_img = ( $fichier_pdf != '' ) ? "none" : "block";
		
        // ---- Liste des photos associées  ---- //
        unset( $recherche );
        $recherche[ "num_parent" ] = $_GET[ "id" ];
        $liste_image = $stuff->getImagesListe( $recherche);
        //print_r($liste_image);exit();
            
        }
        // -------------------------------------------------- //
        	
        else {
        $message = 'Aucun enregistrement';
        
    }
}
// ---- Ajout d'une rubrique -------------------- //
else {
    $action = 'add';
	$labelTitle = 'Edition Nv tuto ';
	$id= 			null;
	$titre=  		null;
	$date= 	        null;
	$accroche= 		null;
	$contenu= 		null;
	$video= 		null;
	$fichier_pdf= 	null;
	$online = 		null;

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
				<form name="formulaire" id="formulaire" class="form-horizontal" method="POST"  action="cattutos-fp.php">
					<input type="hidden" name="action" id="action" value="<?php echo $action?>">
					<input type="hidden" name="reference" value="cattutos">
					<input type="hidden" name="id" id="id" value="<?=$id?>">
					<input type="hidden" name="num_image" id="num_image" value="">
					
					<div class="form-group" >
						<label class="col-sm-1">Date :</label>
					    <input class="col-sm-2" type="text" name="datepicker" required id="datepicker" value="<?php echo $date?>" >
					</div>
					<div class="form-group" >
						<label class="col-sm-1" for="titre">Titre :</label>
					    <input type="text" class="col-sm-11" name="titre" required  value="<?php echo $titre ?>">
					</div>
					
					<div class="form-group">
						<label for="accroche">Contenu :</label><br>
		           		<textarea class="col-sm-11" name="contenu" id="contenu" rows="5" ><?php echo $contenu ?></textarea>
		            </div>
		            
		            <div class="form-group" >
						<label for="accroche">Lien vers ...</label><br>
		           		<input class="col-sm-8"  name="accroche"  id="accroche" value="<?php echo $accroche ?>" />
		            </div> 
		            
		            <div class="form-group">
						<label for="accroche">Code Youtube :</label><br>
		           		<textarea class="col-sm-11" name="video" id="video" rows="3" ><?php echo $video ?></textarea>
		            </div>
		           <div class="col-md-6" style="margin-bottom:20px;">
							<label for="titre">Choix des photos </label><br>
							<input type="hidden" name="url0" id="url0" value=""><br>
							<input type="hidden"  name="idImage"  id="idImage" value="">
	            			<a href="javascript:openCustomRoxy('0')"><img id="" src="img/choisirImageIci.png" id="customRoxyImage0" style="max-width:400px;"></a>
					</div>
					<div class="col-md-6" style="margin-bottom:20px;">
							<label for="titre">Choix du PDF</label><br><br>
							<input type="hidden" name="url1_changement" id="url1_changement" value="">
							<input type="hidden" name="url1" id="url1" value="<?=$fichier_pdf?>">
							
							<div id="div_pdf" style="display:<?=$display_pdf?>;">
								<img src="../admin/img/pdf.png" />&nbsp;
								<span id="span_pdf"><a target="_blank" href="/photos/cattutos/pdf<?=$fichier_pdf?>"><?=$fichier_pdf?></a></span>&nbsp;&nbsp;
						  		<input type="button" value="Changer" onclick="javascript:openCustomRoxy('1');" />&nbsp;
						  		<input type="button" value="Annuler" onclick="javascript:annuler_pdf();" />
							</div>
							<div id="div_pdf_img" style="display:<?=$display_pdf_img?>;">
	            				<a href="javascript:openCustomRoxy('1')"><img id="img_pdf" src="img/choisirPDFIci.png" id="customRoxyImage1" style="max-width:400px;"></a>
	            			</div>
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
				            		  <img src="/photos/cattutos/thumbs<?php echo $_image["fichier"]?>" width="230" style="max-width:230px;"></a><br>
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
						<a href="cattutos-list.php" class="btn btn-success col-sm-6" class="btn btn-default annuler"> Retour </a>	
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
			  	if ( $( "#url1" ).val() != '' ) {
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
				$( "#action" ).val( "supprimer-image" );
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


			$(document).ready(
					  /* This is the function that will get executed after the DOM is fully loaded */
					  function () {
					    $( "#datepicker" ).datepicker({
					    	altField: "#datepicker",
					    	closeText: 'Fermer',
					    	prevText: 'Précédent',
					    	nextText: 'Suivant',
					    	currentText: 'Aujourd\'hui',
					    	monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
					    	monthNamesShort: ['Janv.', 'Févr.', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil.', 'Août', 'Sept.', 'Oct.', 'Nov.', 'Déc.'],
					    	dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
					    	dayNamesShort: ['Dim.', 'Lun.', 'Mar.', 'Mer.', 'Jeu.', 'Ven.', 'Sam.'],
					    	dayNamesMin: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
					    	weekHeader: 'Sem.',
					    	dateFormat: 'dd/mm/yy'
					    });
					  }

					);
		</script>
		
</body>
</html>


