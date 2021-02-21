<?
	include_once '../inc/inc.config.php';
	include_once 'inc-auth-granted.php';
	include_once 'classes/utils.php';
	require 'classes/Catrealisation.php';
	
	$catproduct = new Catrealisation();
	$catproduct->catproduitViewIterative( null );
	$result = $catproduct->tabView;
	
	$parent = null;
	$label = null;
	$message = null;
	
	// ---- Modif -------------------- //
	if ( !empty( $_GET ) ) {
		$codeerror = $_GET[ "message" ];
		if ( $codeerror == 1234 ) $message = "<h3 class='btn-danger'>La catégorie que vous voulez supprimer n'est pas vide : supprimer d'abord les produits qu'elle contient.</h3>"; 
		//print_r($result);
		//print_r($result[0][ "newsletter_detail" ]);
		//exit();
	}
	
	// ---- Ajout ------------------- //
	else { 
		$id_produit = 	null;
		$titre =  		null;
	}
?>

<!doctype html>
<html class="no-js" lang="en">
<head>
		<?php include_once 'inc-meta.php';?>
	</head>

<body>	
		<?php require_once 'inc-menu.php';?>
		
		<div class="container">

		<div class="row">

			<!-- Nouvelle catégorie -->
			<div class="col-md-8">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Gestion des catégories des réalisations</h3>
					</div>
					<div class="panel-body">
						<form name="formulaire" class="form-horizontal" method="POST"
							action="catrealisation-fp.php">
							<input type="hidden" name="reference" value="categorie"> 
							<input type="hidden" name="action" id="action" value="add">

							<div class="row">
								<div class="row">
								    <input type="hidden" name="parent" id="num_parent" value="0">
									 <!-- 
									<label class="col-md-3">Catégorie Parent :</label> 
									<select name="parent" id="num_parent" class="col-md-5">
										      <option value="0" selected>-- racine --</option>
    											<? foreach ($result as $value) : 
    												$decalage = "";
    												for ($i=0; $i<($value[ "level" ] * 5); $i++) {
    													$decalage .= "&nbsp;";
    												} ?>
    												
    												<option value="<?php echo $value[ "id" ] ?>"
    											<? if ( $parent ==  $value[ "id" ] ) { ?> selected <? } ?>>
    													<?=$decalage?><?php echo $value[ "label" ] ?>
												</option>
											    <? endforeach;?>
										</select> 
										 -->  
								</div>
								<div class="row">
									<label class="col-md-3">&nbsp;Nom catégorie :</label> <input
										type="text" class="col-md-5" name="label" required id="label"
										value="<?php echo $label ?>">
								</div>
							</div>

							<div class="row ">
								<div class="col-md-3"></div>
								<div class="col-md-8">
									<br>
									<button class="btn btn-success col-sm-10" type="submit">Créer
										la catégorie</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>

			<div class="col-md-6">
				<br>
					<?php echo $message?>
				</div>

			<form name="form_liste" id="form_liste" class="form-horizontal"
				method="POST" action="catrealisation-fp.php">
				<input type="hidden" name="action" id="action" value=""> <input
					type="hidden" name="id_categorie" id="id_categorie" value=""> <input
					type="hidden" name="ordre" id="ordre" value="">
			</form>

			<table
				class="table table-hover table-bordered table-condensed table-striped">
				<thead>
					<tr>
						<th class="col-md-3" style="">Liste des catégories</th>
						<th class="col-md-2" style="">Description</th>
						<th class="col-md-1" style="">Image</th>
						<th class="col-md-1" colspan="2" style="">Actions</th>
					</tr>
				</thead>
				<tbody>
				<?php if ( !empty( $result ) ) :
						$i=0;
						
						foreach ( $result as $value ) :
						//print_r($value);
							$decalage = "";
							for ( $i=0; $i < ( $value[ "level" ] * 10 ); $i++ ) {
								$decalage .= "&nbsp;";
							}
							$i++;
							if ( $value[ "level" ] == 0 ) $classe_affichage = 'info';
							else if ( $value[ "level" ] == 1 ) $classe_affichage = 'success';
							else $classe_affichage = '';
							
							$description = ( !empty( $value[ "description" ] ) ) ? "texte OK" : "&nbsp;"; ?>
							
							<tr class="<?php echo $classe_affichage?>">
						<td>
							
						<?php if ( $value[ "level" ] == 0 ) :    // ---- Positionnement des catégories sur celles de niveau 0 ---- //
								//echo "--- " . $value[ "ordre" ] . "<br>"; //
								$nb_cat = $catproduct->getNbCatByLevel( $value[ "level" ], false );  ?>	
								
								<select id="<?php echo $value[ "id" ] ?>"
							class="select_categorie">
							<?php for( $cpt = 1; $cpt <= $nb_cat; $cpt++ ) :   
									$selected = ( $cpt == $value[ "ordre" ] ) ? "selected" : ""; ?>
									<option value="<?php echo $cpt ?>" <?php echo $selected ?>><?php echo $cpt ?> </option>
							<?php endfor; ?>
								</select>
						<?php endif; ?>
							
									<a href="/admin/product-list.php?categorie="
							<?php echo $value[ "id" ] ?>> <?php echo $decalage.$value[ "label" ] ?></a>
						</td>
						<td> <?php echo $description ?></td>
						<td>
							
						<?php	if( !empty( $value[ "image" ] ) ) : ?>
								    <a href='/photos/catrealisation<?php echo $value[ "image" ] ?>'
							target='_blank'><img alt="" width='110'
								src="/photos/catrealisation/thumbs/<?php echo $value[ "image" ] ?>"></a>
						<?php endif; ?>

							</td>
						<td><a href="catrealisation-edit.php?id=<?php echo $value[ "id" ] ?>"><img
								src='img/modif.png' width='30' alt='Modifier'></a></td>

						<td>
							<div style='display: none;'
								class='supp<?php echo $value[ "id" ] ?> alert alert-warning alert-dismissible fade in'
								role='alert'>
								<button type='button' class='close' aria-label='Close'
									onclick="$('.supp<?php echo $value[ "id" ] ?>').css('display', 'none');">
									<span aria-hidden='true'>×</span>
								</button>
								<strong>Voulez vous vraiment supprimer ?</strong>
								<button type='button' class='btn btn-danger'
									onclick="location.href='catrealisation-fp.php?reference=categorie&action=delete&id=<?php echo $value[ "id" ] ?>'">Oui
									!</button>
							</div> <img src='img/del.png' width='20' alt='Supprimer'
							onclick="$('.supp<?php echo $value[ "id" ] ?>').css('display', 'block');">
						</td>
					</tr>
					
					<?php endforeach; ?>
					<?php endif; ?>
				</tbody>
			</table>

		</div>
	</div>

	<script
		src="http://ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="/js/jquery.min.js"><\/script>')</script>

	<script>
			
			// DOM Ready
			$(function() {
				
				$( ".select_categorie" ).change(function() {
					//alert( "changement..." );
					var id_cat = $(this).attr( "id" );
					var ordre = $(this).val();
					
					$( "#form_liste #action" ).val( "changer-ordre-categorie" );
					$( "#form_liste #id_categorie" ).val( id_cat );
					$( "#form_liste #ordre" ).val( ordre );
					$( "#form_liste" ).submit();
					
					return false;
				});
				
			});
			
		</script>

</body>
</html>


