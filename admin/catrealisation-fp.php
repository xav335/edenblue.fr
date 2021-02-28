            <?
	include_once '../inc/inc.config.php';
	require 'classes/Catrealisation.php';
	require 'classes/ImageManager.php';
	require 'classes/Catrealisation_image.php';
	session_start();
	
	$debug = false;

	$catrealisation =          new Catrealisation();
	$catrealisation_image =    new Catrealisation_image();
	$imageManager = New ImageManager();
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
	//print_r($_POST);exit();
	
	// ---- Forms processing ------------------------------------------------- //
	if ( !empty( $_POST ) ) {
	    //print_r( $_POST); exit();
	    // ---- Gestion des images du produit -------------------------------- //
	    if ( !empty( $_POST[ "mes_images" ] ) ) {
	        //print_r( $_POST); exit();
	    
	        $cpt = 1;
	        foreach( $_POST[ "mes_images" ] as $_image ) {
	            $source = $_SERVER['DOCUMENT_ROOT'] . $_image;
	            echo "<br>--- source : " . $source . "<br>";
	            $filenameDest = $imageManager->fileDestManagement( $source, $_POST['id'] );
	            echo "--- filenameDest : " . $filenameDest . "<br>";
	            //exit();
	            // ---- Cr�ation des diff�rentes images ------------ //
	            if ( 1 == 1 ) {
	    
	                // ---- Image de taille "normale" ---- //
	                $destination = $_SERVER['DOCUMENT_ROOT'] . '/photos/catrealisation/normale' . $filenameDest;
	                if ( $debug ) echo "--- destination : " . $destination . "<br>";
	                $imageManager->imageResize( $source, $destination, 800, 600, ZEBRA_IMAGE_CROP_CENTER );
	    
	                // ---- Image de taille "grande" ----- //
	                $destination = $_SERVER['DOCUMENT_ROOT'] . '/photos/catrealisation/accueil' . $filenameDest;
	                if ( $debug ) echo "--- destination : " . $destination . "<br>";
	                $imageManager->imageResize( $source, $destination, 319, 327, ZEBRA_IMAGE_CROP_CENTER );
	    
	                // ---- Image de taille "vignette" --- //
	                $destination = $_SERVER['DOCUMENT_ROOT'] . '/photos/catrealisation/vignette' . $filenameDest;
	                if ( $debug ) echo "--- destination : " . $destination . "<br>";
	                $imageManager->imageResize( $source, $destination, 97, 99, ZEBRA_IMAGE_CROP_CENTER );
	            }
	            // ------------------------------------------------- //
	            	
	            // ---- Ce produit a-t-il une image par d�faut? ---- //
	            if ( 1 == 1 ) {
	                $image_defaut = $catrealisation_image->getImageDefaut( $_POST['id'], $debug );
	                $has_imageDefaut = ( $image_defaut[ "fichier" ] != '' ) ? true : false;
	            }
	            // ------------------------------------------------- //
	            	
	            // ---- Enregistrement de l'image ------------------ //
	            unset( $val );
	            $val[ "num_produit" ] = $_POST['id'];
	            $val[ "fichier" ] = $filenameDest;
	            $val[ "defaut" ] = ( $cpt == 1 && !$has_imageDefaut ) ? 'oui' : 'non';
	            $catrealisation_image->ajouter( $val, $debug );
	            // ------------------------------------------------- //
	            	
	            $cpt++;
	        }
	        
	        header( "Location: /admin/catrealisation-edit.php?id=". $_POST['id']);
	        
	    }
	    
	    
	    // ---------------------------------------------- //
	    // ------------------------------------------------------------------- //
	        
	        // ---- Suppression d'une image ------------------------------------------- //
	    if ( $_POST[ "action" ] == "supprimer image" ) {
	        //print_r( $_POST); exit();
	         
	        $catrealisation_image->supprimer( $_POST[ "num_image" ], $debug );
	        header( "Location: /admin/catrealisation-edit.php?id=" . $_POST[ "id" ] );
	    }
	    // ------------------------------------------------------------------------ //
	    
	    // ---- D�finition d'une image par d�faut --------------------------------- //
	    if ( $_POST[ "action" ] == "par defaut" ) {
	        	
	        // ---- Liste des autres images de l'offre ---- //
	        unset( $recherche );
	        $recherche[ "num_produit" ] = $_POST[ "id" ];
	        $liste_image = $catrealisation_image->getListe( $recherche, $debug );
	        	
	        // ---- On passe toutes les autres � "non" ---- //
	        if ( !empty( $liste_image ) ) {
	            foreach( $liste_image as $_image ) {
	                $catrealisation_image->setChamp( "defaut", 'non', $_image[ "num_image" ], $debug );
	            }
	        }
	        	
	        $catrealisation_image->setChamp( "defaut", 'oui', $_POST[ "num_image" ], $debug );
	       header( "Location: /admin/catrealisation-edit.php?id=" . $_POST[ "id" ] );
	    }
	    // ------------------------------------------------------------------------ //
	    
		
		// ---- Traitement des Categorie ------------------------------------- //
		if ( $_POST['reference'] == 'catrealisation' ){
			//print_r($_POST);exit();
			$imageManager = New ImageManager();
			$catproduct = new Catrealisation();
			if ($_POST['action'] == 'modif') { //Modifier
				try {
// 					//Gestion des images
// 					$source = $_SERVER['DOCUMENT_ROOT'].$_POST['url1'];
	
// 					if (strstr($source,'uploads')){
// 						$source = $_SERVER['DOCUMENT_ROOT'].$_POST['url1'];
// 						$filenameDest = $imageManager->fileDestManagement($source,$_POST['id']);
// 						//Image
// 						$destination=$_SERVER['DOCUMENT_ROOT'].'/photos/catrealisation'.$filenameDest;
// 						//copy($source, $destination); // si c'est un PDF par exemple
// 						$imageManager->imageResize($source, $destination, null, 650, false);
// 						//Vignette  
// 						$destination=$_SERVER['DOCUMENT_ROOT'].'/photos/catrealisation/thumbs'.$filenameDest;
// 						$imageManager->imageResize($source, $destination, null, 350, false);
// 						$_POST['url1']=$filenameDest;
// 					}
// 					$imageManager =null;
					$result = $catproduct->catproductModify($_POST);
					$catproduct = null;
					//header('Location: /admin/catrealisation-list.php');
					header( "Location: /admin/catrealisation-edit.php?id=" . $_POST[ "id" ] );
				} catch (Exception $e) {
					echo 'Erreur contactez votre administrateur <br> :',  $e->getMessage(), "\n";
					$catproduct = null;
					exit();
				}
			}	
		
		  if ($_POST['action'] == 'add') { //ajout
		      //print_r($_POST);exit();
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
		if ( $_POST[ "action" ] == "changer-ordre-categorie" ) {
		    //print_r($_POST);exit();
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