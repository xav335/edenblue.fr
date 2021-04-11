<?php
	include_once '../inc/inc.config.php';
	require 'classes/Cattutos.php';
	require 'classes/ImageManager.php';
	session_start();
	// ---- Security --------------------------------------------------------- //
	if (!isset($_SESSION['accessGranted']) || !$_SESSION['accessGranted']) {
	    $result = $storageManager->grantAccess($_POST['login'], $_POST['mdp']);
	    if (!$result){
	        header('Location: /admin/?action=error');
	    } else {
	        $_SESSION['accessGranted'] = true;
	    }
	}

	$stuff = new Cattutos();
	$imageManager = new ImageManager();
	
	
	
	// ---------AJOUTS ET MODIFICATIONS ------------------- //
	if ( !empty( $_POST ) ) {
	    //print_r( $_POST); exit();
	    // ---- Gestion des champs textes -------------------------------- //
	    if ( $_POST[ "action" ] == "add" ) {
	        try {
	            $result = $stuff->stuffAdd($_POST);
	        } catch (Exception $e) {
	            echo 'Erreur contactez votre administrateur <br> :',  $e->getMessage(), "\n";
	            exit();
	        }
	        
	        //------ Id du Tutos ------//
	        //--------------------------//
	        $idStuff = $result;
	        //--------------------------//
	        //--------------------------//
	    } else {
	        try {
	            $result = $stuff->stuffModify($_POST);
	        } catch (Exception $e) {
	            echo 'Erreur contactez votre administrateur <br> :',  $e->getMessage(), "\n";
	            exit();
	        }
	        
	        //------ Id du Tutos ------//
	        //--------------------------//
	        $idStuff = $_POST['id'];
	        //--------------------------//
	        //--------------------------//
	    }
	    
	   
	    
	    // ---- Gestion des images du produit -------------------------------- //
	    if ( !empty( $_POST[ "mes_images" ] ) ) {
	        //print_r( $_POST); exit();
	    
	        $cpt = 1;
	        foreach( $_POST[ "mes_images" ] as $_image ) {
	            $source = $_SERVER['DOCUMENT_ROOT'] . $_image;
	            //echo "<br>--- source : " . $source . "<br>";
	            $filenameDest = $imageManager->fileDestManagement( $source, $idStuff );
	            //exit();
	            // ---- Creation des differentes images ------------ //
	    
                // ---- Image de taille "normale" ---- //
                $destination = $_SERVER['DOCUMENT_ROOT'] . '/photos/cattutos' . $filenameDest;
                $imageManager->imageResize( $source, $destination, 800, 600, ZEBRA_IMAGE_CROP_CENTER );
    
                // ---- Image de taille "vignette" --- //
                $destination = $_SERVER['DOCUMENT_ROOT'] . '/photos/cattutos/thumbs' . $filenameDest;
                $imageManager->imageResize( $source, $destination, 97, 99, ZEBRA_IMAGE_CROP_CENTER );
	            // ------------------------------------------------- //
	            	
	            // ---- Ce produit a-t-il une image par d�faut? ---- //
                $image_defaut = $stuff->getImageDefaut( $idStuff );
                $has_imageDefaut = ( $image_defaut[ "fichier" ] != '' ) ? true : false;
	            // ------------------------------------------------- //
	            	
	            // ---- Enregistrement de l'image ------------------ //
	            unset( $val );
	            $val[ "num_parent" ] = $idStuff;
	            $val[ "fichier" ] = $filenameDest;
	            $val[ "defaut" ] = ( $cpt == 1 && !$has_imageDefaut ) ? 'oui' : 'non';
	            $stuff->ajouterImage( $val);
	            // ------------------------------------------------- //
	            	
	            $cpt++;
	        }
	        
	        
	    }
	    // ------------------------------------------------------------------- //
	    // ---- Gestion du PDF ----------------------------------------------- //
	    
	    if ( $_POST[ "url1_changement" ] == 'changer pdf' ) {
	        //print_r( $_POST); exit();
	        if ( $_POST[ "url1" ] != '' ) {
	            $source = $_SERVER['DOCUMENT_ROOT'] . $_POST[ "url1" ];
	            $filenameDest = $imageManager->fileDestManagement( $source, $idStuff );
	            	
	            $destination = $_SERVER['DOCUMENT_ROOT'] . '/photos/cattutos/pdf' . $filenameDest;
	            	
	            // ---- Copie du fichier ----------- //
	            copy( $source, $destination );
	        }
	        // ---- MAJ de l'enregistrement ---- //
	        $stuff->setChamp( "fichier_pdf", $filenameDest, $idStuff);
	    }
	   
	    // ---------------------------------------------- //
	    // ------------------------------------------------------------------- //
	        
	   // ---- Suppression d'une image ------------------------------------------- //
		if ( $_POST[ "action" ] == "supprimer-image" ) {
		    //print_r( $_POST); exit();
		    
		    // ---- Suppression physique des fichiers ---- //
		    $recherche[ "num_image" ] =  $_POST[ "num_image" ];
		    $result = $stuff->getImagesListe( $recherche);
		    //print_r($result);exit();
		    
		     $fichier_a_supprimer = $_SERVER['DOCUMENT_ROOT'] . "/photos/cattutos/" . $result[ 0 ][ "fichier" ];
		     if ( file_exists( $fichier_a_supprimer ) ) {
		     unlink( $fichier_a_supprimer );
		     }
		     $fichier_a_supprimer = $_SERVER['DOCUMENT_ROOT'] . "/photos/cattutos/thumbs" . $result[ 0 ][ "fichier" ];
		     if ( file_exists( $fichier_a_supprimer ) ) {
		     unlink( $fichier_a_supprimer );
		     }
		     
		    
			$stuff->supprimerImage( $_POST[ "num_image" ]);
			
			
			
		}
			// ------------------------------------------- //
		
		// ------------------------------------------------------------------------ //
	    
	    // ---- Definition d'une image par defaut --------------------------------- //
	    if ( $_POST[ "action" ] == "par defaut" ) {
	       // print_r( $_POST); exit();
	        // ---- Liste des autres images de l'offre ---- //
	        unset( $recherche );
	        $recherche[ "num_parent" ] = $idStuff;
	        $liste_image = $stuff->getImagesListe($recherche);
	        
	        // ---- On passe toutes les autres � "non" ---- //
	        if ( !empty( $liste_image ) ) {
	            foreach( $liste_image as $val ) {
	                $stuff->setChampImage( "defaut", 'non', $val[ "num_image" ]);
	            }
	        }
	        $stuff->setChampImage( "defaut", 'oui', $_POST[ "num_image" ]);
	    }
	    // ------------------------------------------------------------------------ //
	    
	//---------- RETOUR A LA PAGE EDIT ---------//	
	header( "Location: /admin/cattutos-edit.php?id=". $idStuff);
	// ----------------------------------------------------------------------- //
	
	} elseif ( !empty( $_GET ) ) {
        //print_r( $_GET); exit();
        if ( $_GET[ "action" ] == "delete" ) {
            $stuff->stuffDelete($_GET[ "id" ]);
            header( "Location: /admin/cattutos-list.php");
        }
	}
	// ---- ERREUR!!! -------------------------------------------------------- //
	else {
		header('Location: /admin/');
	}
	// ----------------------------------------------------------------------- //
?>