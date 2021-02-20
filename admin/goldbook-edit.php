<?php include_once '../inc/inc.config.php'; ?>
<?php include_once 'inc-auth-granted.php';?>
<?php include_once 'classes/utils.php';?>
<?php 
require 'classes/Goldbook.php';

if (!empty($_GET)){ //Modif 
	$action = 'modif';
	$goldbook = new Goldbook();
	$result = $goldbook->goldbookGet($_GET['id']);
	//print_r($result);
	if (empty($result)) {
		$message = 'Aucun enregistrements';
	} else {
		$labelTitle= 	'Livre d\' or N°: '. $_GET['id'];
		$date_goldbook= traitement_datetime_affiche($result[0]['date']);
		$id_produit= 			$_GET['id'];
		$nom=  			$result[0]['nom'];
		$email=  		$result[0]['email'];
		$message= 		$result[0]['message'];
		if($result[0]['online']=='1') { 
			$online = 'checked'; 
		} else {
			$online = '';
		}
	}
} else { //ajout goldbook
	$action = 'add';
	$labelTitle = 'Edition Livre Or ';
	$id_produit= 			null;
	$nom=  			null;
	$email= 		null;
	$date_goldbook= null;
	$message= 		null;
	$online = 		null;
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
			<h3><?php echo $labelTitle ?></h3><br>
			<div class="col-xs-12 col-sm-12 col-md-12">
				
					<form name="formulaire" class="form-horizontal" method="POST"  action="goldbook-fp.php">
						<input type="hidden" name="reference" value="goldbook">
						<input type="hidden" name="action" value="<?php echo $action ?>">
						<input type="hidden" name="id" id="id" value="<?php echo $id_produit ?>">
						
						<div class="form-group" >
							<label class="col-sm-1" >Date :</label>
						    <input class="col-sm-2" type="text" name="datepicker" required id="datepicker" value="<?php echo $date_goldbook?>" >
						</div>
						<div class="form-group" >
							<label class="col-sm-1" for="titre">Nom :</label>
						    <input type="text" class="col-sm-11" name="name" required  value="<?php echo $nom ?>">
						</div>
						<div class="form-group" >
							<label class="col-sm-1" for="titre">Email :</label>
						    <input type="text" class="col-sm-11" name="email" required  value="<?php echo $email ?>">
						</div>
						<div class="form-group" >
							<label for="accroche">Message :</label><br>
			           		<textarea class="col-sm-12"  name="message" required id="accroche" rows="3" ><?php echo $message ?></textarea>
			            </div> 
						<div class="form-group" >
							<label for="titre">En ligne :</label>
						    <input type="checkbox" name="online" <?php echo  $online ?>>
						</div>
			            <button class="btn btn-success col-sm-12" type="submit" class="btn btn-default"> Valider </button>
			        </form>
			        <script type="text/javascript">
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
			</div>
		</div>
	</div>
</body>
</html>


