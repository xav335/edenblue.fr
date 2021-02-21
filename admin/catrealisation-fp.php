            <?
	include_once '../inc/inc.config.php';
	require 'classes/Catrealisation.php';
	require 'classes/ImageManager.php';
	session_start();
	
	$debug = false;

	// ---- Security --------------------------------------------------------- //
	if (!isset($_SESSION['accessGranted']) || !$_SESSION['accessGranted']) {
		$result = $storageManager->grantAccess($_POST['login'], $_POST['mdp']);
		if (!$result){
			header('Location: /admin/?action=error');
		} else {
			$_SESSION['accessGranted'] = true;
		}
	}
	// ----------------------------------------------------------------------- //
	
	
	// ---- Forms processing ------------------------------------------------- //
	if ( !empty( $_POST ) ) {
		
		// ---- Traitement des Categorie ------------------------------------- //
		if ( $_POST['reference'] == 'categorie' ){
			//print_r($_POST);exit();
			$imageManager = New ImageManager();
			$catproduct = new Catrealisation();
			if ($_POST['action'] == 'modif') { //Modifier
				try {
					//Gestion des images
					$source = $_SERVER['DOCUMENT_ROOT'].$_POST['url1'];
	
					if (strstr($source,'uploads')){
						$source = $_SERVER['DOCUMENT_ROOT'].$_POST['url1'];
						$filenameDest = $imageManager->fileDestManagement($source,$_POST['id']);
						//Image
						$destination=$_SERVER['DOCUMENT_ROOT'].'/photos/catrealisation'.$filenameDest;
						//copy($source, $destination); // si c'est un PDF par exemple
						$imageManager->imageResize($source, $destination, null, 650, false);
						//Vignette  
						$destination=$_SERVER['DOCUMENT_ROOT'].'/photos/catrealisation/thumbs'.$filenameDest;
						$imageManager->imageResize($source, $destination, null, 350, false);
						$_POST['url1']=$filenameDest;
					}
					$imageManager =null;
					
					$result = $catproduct->catproductModify($_POST);
					$catproduct = null;
					header('Location: /admin/catrealisation-list.php');
				} catch (Exception $e) {
					echo 'Erreur contactez votre administrateur <br> :',  $e->getMessage(), "\n";
					$catproduct = null;
					exit();
				}
		
			} else {  //ajouter
				try {
					//print_r($_POST);exit();
					$result = $catproduct->catproductAdd($_POST);
					$catproduct = null;
					header('Location: /admin/catrealisation-list.php');
				} catch (Exception $e) {
					echo 'Erreur contactez votre administrateur <br> :',  $e->getMessage(), "\n";
					$catproduct = null;
					exit();
				}
			}
		}
		//-------------------------------------------------------------------- //
		
		// ---- Changement de l'ordre d'affichage des cat�gories ------------- //
		else if ( $_POST[ "action" ] == "changer-ordre-categorie" ) {
			$categorie = new Catrealisation();
			try {
				$categorie->setChamp( 
					$_POST[ "id_categorie" ], 
					"ordre", 
					$_POST[ "ordre" ], 
					$debug 
				);
				
				if ( !$debug ) header( "Location: /admin/catrealisation-list.php" );
			} 
			catch ( Exception $e ) {
				echo 'Erreur contactez votre administrateur <br> :',  $e->getMessage(), "\n";
				$catproduct = null;
				exit();
			}
		}
		//-------------------------------------------------------------------- //
		
	}
	// ----------------------------------------------------------------------- //
	
	
	// ---- GET GET GET ------------------------------------------------------ //
	else if (!empty($_GET)) {
		
		if ($_GET['reference'] == 'categorie'){ //supprimer
			$catproduct = new Catrealisation();
			if ($_GET['action'] == 'delete'){
				try {
					$result = $catproduct->catproductDelete($_GET['id']);
					$catproduct = null;
					header('Location: /admin/catrealisation-list.php');
				} catch (Exception $e) {
						echo 'Erreur contactez votre administrateur <br> :',  $e->getMessage() , '\n';
						$catproduct = null;
						if($e->getCode() == 1234){
							header('Location: /admin/catrealisation-list.php?message='.$e->getCode());
						}
						exit();
				}
			}
		}
		
	}
	// ----------------------------------------------------------------------- //
	
	
	// ---- ERREUR!!! -------------------------------------------------------- //
	else {
		header('Location: /admin/');
	}
	// ----------------------------------------------------------------------- //
?>