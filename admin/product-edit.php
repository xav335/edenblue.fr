<?php include_once '../inc/inc.config.php'; ?>
<?php include_once 'inc-auth-granted.php';?>
<?php include_once 'classes/utils.php';?>
<?php 
require 'classes/Catproduct.php';

(!empty($_GET['rubrique'])) ? $rubrique =$_GET['rubrique'] : $rubrique = null;
(!empty($_GET['categorie'])) ? $categorie =$_GET['categorie'] : $categorie = null;


$catproduct = new Catproduct();
//Recup des categories
$catproduct->catproduitViewIterative(null);
$resultCat = $catproduct->tabView;

//Recup des couleurs
$resultCouleur = $catproduct->getCouleurs();

// Recup des rubriques
$resultRubrique = $catproduct->getRubriques();

if (!empty($_GET)){ //Modif 
	$action = 'modif';
	$result = $catproduct->productGet($_GET['id'],null,null,null,null,1);
	//print_r($result);exit();
	//print_r($result[0]['categories']);
	$catproduct=null;
	
	if (empty($result)) {
		$message = 'Aucun enregistrements';
	} else {
		$labelTitle= 	'Produit N°: '. $_GET['id'];
		$id_produit= 			$_GET['id'];
		$label=  		$result[0]['label'];
		$prix=  		$result[0]['prix'];
		$shipping=  	$result[0]['shipping'];
		$libprix=  		$result[0]['libprix'];
		$reference=  	$result[0]['reference'];
		$titreaccroche= $result[0]['titreaccroche'];
		$accroche= 		$result[0]['accroche'];
		$description= 	$result[0]['description'];
		$categories= 	null;
		if (!empty($result[0]['categories'])){
			foreach ($result[0]['categories'] as $value) {
				$categories[]=$value['catid'];
			}
		}
		$rubriques= 	null;
		if (!empty($result[0]['rubriques'])){
			foreach ($result[0]['rubriques'] as $value) {
				$rubriques[]=$value['rubid'];
			}
		}
		$couleurs= 	null;
		if (!empty($result[0]['couleurs'])){
			foreach ($result[0]['couleurs'] as $value) {
				$couleurs[]=$value['couleurid'];
			}
		}
		//print_r($categories);exit();
		for ($i=1;$i<4;$i++) {
			$image[$i] = 	$result[0]['image'.$i];
			if(empty($image[$i]) || !isset($image[$i])){
				$img[$i]  = '/img/favicon.png';
				$imgval[$i]  = '';
			} else {
				$img[$i]  = '/photos/products/thumbs'. $image[$i];
				$imgval[$i]  = $image[$i];
			}
		}	
	}
} else { //ajout 
	$action= 		'add';
	$labelTitle= 	'Edition Produit ';
	$id_produit= 			null;
	$label=  		null;
	$prix=  		null;
	$shipping=		null;
	$libprix=  		'€';
	$reference=  	null;
	$titreaccroche= 'Les + produit';
	$accroche= 		null;
	$description= 	null;
	$categories= 	null;
	$rubriques= 	null;
	$couleurs= 	null;
	for ($i=1;$i<4;$i++) {
		$img[$i]  = '/img/favicon.png';
		$imgval[$i]  = '';
	}
	$catproduct=	null;
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
				<form name="formulaire" class="form-horizontal" method="POST"  action="product-fp.php">
					<input type="hidden" name="reference" value="product">
					<input type="hidden" name="action" value="<?php echo $action ?>">
					<input type="hidden" name="id" id="id" value="<?php echo $id_produit ?>">
					<input type="hidden" name="rubrique" id="rubrique" value="<?php echo $rubrique ?>">
					<input type="hidden" name="categorie" id="categorie" value="<?php echo $categorie ?>">
					
					<div class="form-group" >
						<label class="col-sm-2" for="titre">Nom produit :</label>
					    <input type="text" class="col-sm-8" name="label" required  value="<?php echo $label ?>">
					</div>
					<div class="form-group" >
						<label class="col-sm-2" for="titre">Rubrique :</label>
							<? 
							if ( !empty( $resultRubrique ) ) {
								$i=0;
								foreach ( $resultRubrique as $value ) {
									
									// ---- On ne prend pas en compte #1 ---- //
									if ( $value['id'] != 1 ) {
										$activ = ( !empty( $rubriques ) && in_array( $value['id'], $rubriques ) ) ? 'checked' : '';
										echo $value['label'] . ":<input type='checkbox'  name='rubriques[]' value='" . $value['id'] . "' " . $activ . " >&nbsp;\n";
									}
								}
							}
							?>
					</div>
					<div class="form-group" >
						<label class="col-sm-2" for="titre">Accord couleurs :</label>
							<?php 
							if (!empty($resultCouleur)) {
								$i=0;
								foreach ($resultCouleur as $value) { 
								$i++;
								(!empty($couleurs) && in_array($value['id'], $couleurs)) ? $activ = 'checked' : $activ = '';
								?>
								
								<?php echo $value['label'] ?>:<input type="checkbox"  name="couleurs[]" value="<?php echo $value['id'] ?>" <?php echo $activ ?> >&nbsp;
								
								<?php } ?>
							<?php } ?>	
					</div>
					<div class="form-group" >
						<label class="col-sm-2" for="titre">Réf. :</label>
					    <input type="text" class="col-sm-4" name="ref" required  value="<?php echo $reference ?>">
					</div>
					<div class="form-group" >
						<label class="col-sm-2" for="titre">Prix ttc:</label>
					    <input type="number" step="0.01" class="col-sm-2" name="prix" required  value="<?php echo $prix ?>">
					     <input type="text" class="col-sm-4" name="libprix" required  value="<?php echo $libprix ?>">
					</div>
					<div class="form-group" >
						<label class="col-sm-2" for="titre">Frais de port extra ttc :</label>
					    <input type="number" step="0.01" class="col-sm-2" name="shipping" required  value="<?php echo $shipping ?>">
					</div>
					<div class="form-group">
						<label for="accroche">Description :</label><br>
		           		<textarea class="col-sm-11" name="description" id="description" rows="6" ><?php echo $description ?></textarea>
		            </div>
		            <div class="form-group" >
						<label class="col-sm-2" for="titre">Titre encard :</label>
					    <input type="text" class="col-sm-4" name="titreaccroche" required  value="<?php echo $titreaccroche ?>">
					</div>
		            <div class="form-group">
						<label for="accroche">Encart Vert :</label><br>
		           		<textarea class="col-sm-11" name="accroche" id="accroche" rows="3" ><?php echo $accroche ?></textarea>
		            </div>
		            <div class="form-group"><br>
						<label  for="titre">Choisissez les photos du produit: </label>
						<input type="hidden"  name="idImage"  id="idImage" value="">
					</div>	
				
						<?php for ($i=1;$i<4;$i++) {?>
							<div class="col-md-4">
						<input type="hidden"  name="url<?php echo $i ?>"  id="url<?php echo $i ?>" value="<?php echo $imgval[$i]?>"><br>
            			<a href="javascript:openCustomRoxy('<?php echo $i ?>')"><img  src="<?php echo $img[$i]?>" id="customRoxyImage<?php echo $i ?>" style="max-width:200px;"></a>
						<img src="img/del.png" width="20" alt="Supprimer" onclick="clearImage(<?php echo $i ?>)"/>
						<br><br>
						</div>	
						<?php }?>
					
		            <div id="roxyCustomPanel" style="display: none;">
  							<iframe src="/admin/fileman2/index.php?integration=custom" style="width:100%;height:100%" frameborder="0"></iframe>
					</div>
					
					<script type="text/javascript">
						function openCustomRoxy(idImage){
							$('#idImage').val(idImage);
						 	$('#roxyCustomPanel').dialog({modal:true, width:875,height:600});
						}
						function closeCustomRoxy(){
						  	$('#roxyCustomPanel').dialog('close');
						}
	
						function clearImage(idImage){
							$('#customRoxyImage'+idImage).attr('src', '/img/favicon.png');
							$('#url'+idImage).val('');
						}
						
					</script>
					
					
					<table class="table table-hover table-bordered table-condensed table-striped" >
						<thead>
							<tr>
								<th class="col-md-12"  colspan="2">
									Cochez les catégories auquelles le produit appartient :
								</th>
							</tr>
						</thead>
						
						<tbody>
							<?php 
							if (!empty($resultCat)) {
								$i=0;
								foreach ($resultCat as $value) { 
									$decalage = "";
									for ($i=0; $i<($value['level'] * 10); $i++) {
										$decalage .= "&nbsp;";
									}
								$i++;
								(!empty($categories) && in_array($value['id'], $categories)) ? $activ = 'checked' : $activ = '';
								?>
								<tr class="<?php if ($value['level']==0) echo 'info';  if ($value['level']==1) echo 'success';?>">
									<td><input type="checkbox"  name="categories[]" value="<?php echo $value['id'] ?>" <?php echo $activ ?>></td>
									<td><?php echo $decalage.$value['label']?></td>
								</tr>
								<?php } ?>
							<?php } ?>	
						</tbody>
					</table>
					
					<div class="form-group">
		            	<button class="btn btn-success col-sm-12" type="submit" class="btn btn-default"> Valider </button>
		            </div>
					<script type="text/javascript">
						tinymce.init({
						selector: "textarea.editme",
						// ===========================================
						// INCLUDE THE PLUGIN
						// ===========================================
						plugins: [
						"advlist autolink lists link image charmap print preview anchor",
						"searchreplace visualblocks code fullscreen textcolor",
						"insertdatetime media table contextmenu paste jbimages"
						],
											
						// ===========================================
						// PUT PLUGIN'S BUTTON on the toolbar
						// ===========================================
						toolbar: "insertfile undo redo | styleselect | forecolor backcolor | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",
						// ===========================================
						// SET RELATIVE_URLS to FALSE (This is required for images to display properly)
						// ===========================================
						// AJOUTE LES URL EN ENTIER decommenter les 2 lignes suivantes
						//document_base_url: "http://dev.bsport.fr",
						//remove_script_host : false,
						relative_urls: false,
						file_browser_callback: RoxyFileBrowser
						
						});
	
	
						function RoxyFileBrowser(field_name, url, type, win) {
						  var roxyFileman = '/admin/fileman/index.php';
						  if (roxyFileman.indexOf("?") < 0) {     
						    roxyFileman += "?type=" + type;   
						  }
						  else {
						    roxyFileman += "&type=" + type;
						  }
						  roxyFileman += '&input=' + field_name + '&value=' + document.getElementById(field_name).value;
						  if(tinyMCE.activeEditor.settings.language){
						    roxyFileman += '&langCode=' + tinyMCE.activeEditor.settings.language;
						  }
						  tinyMCE.activeEditor.windowManager.open({
						     file: roxyFileman,
						     title: 'Gestionnaire de fichiers',
						     width: 850, 
						     height: 650,
						     resizable: "yes",
						     plugins: "media",
						     inline: "yes",
						     close_previous: "no"  
						  }, {     window: win,     input: field_name    });
						  return false; 
						}

						
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
		        </form>
			</div>
		</div>
	</div>
</body>
</html>


