<?php include_once '../inc/inc.config.php'; ?>
<?php
require 'classes/Catproduct.php';
require 'classes/ImageManager.php';
require 'classes/utils.php';
session_start();

// ---- Security --------------------------------- //
if ( !isset( $_SESSION[ "accessGranted" ] ) || !$_SESSION[ "accessGranted" ] ) {
	$result = $storageManager->grantAccess($_POST[ "login" ], $_POST[ "mdp" ]);
	if (!$result){
		header('Location: /admin/?action=error');
	} else {
		$_SESSION[ "accessGranted" ] = true;
	}
}

// ---- Forms processing ------------------------- //
if ( !empty( $_POST ) ) {
	
	
	// traitement des Produit
	if ($_POST[ "reference" ] == 'product'){
		//print_r($_POST);exit();
		$catproduct = new Catproduct();
		$imageManager = New ImageManager();
		for ($i=1;$i<4;$i++){
			$source = $_SERVER[ "DOCUMENT_ROOT" ].$_POST[ "url" . $i];
			
			if(strstr($source,'uploads')){
				$source = $_SERVER[ "DOCUMENT_ROOT" ].$_POST[ "url" . $i];
				$filenameDest = $imageManager->fileDestManagement($source,$_POST[ "id" ]);
				//Image
				$destination=$_SERVER[ "DOCUMENT_ROOT" ].'/photos/products'.$filenameDest;
				$imageManager->imageResize( $source, $destination, null, 650 );
				//Vignette
				$destination=$_SERVER[ "DOCUMENT_ROOT" ].'/photos/products/thumbs'.$filenameDest;
				$imageManager->imageResize( $source, $destination, 250, 250, ZEBRA_IMAGE_CROP_CENTER );
				$_POST[ "url" . $i] = $filenameDest;
			}
		}
		
		// ---- Modifier ---------------------------------- //
		if ( $_POST[ "action" ] == 'modif' ) {
			try {
				$result = $catproduct->productModify( $_POST );
				$catproduct = null;
				header('Location: /admin/product-list.php?rubrique='.$_POST[ "rubrique" ].'&categorie='.$_POST[ "categorie" ]);
			} 
			catch ( Exception $e ) {
				echo 'Erreur contactez votre administrateur <br> :',  $e->getMessage(), "\n";
				$catproduct = null;
				exit();
			}
		
		}
		
		// ---- Ajouter ----------------------------------- //
		else {
			try {
				//print_r($_POST);exit();
				$result = $catproduct->productAdd($_POST);
				$catproduct = null;
				header('Location: /admin/product-list.php');
			} 
			catch (Exception $e) {
				echo 'Erreur contactez votre administrateur <br> :',  $e->getMessage(), "\n";
				$catproduct = null;
				exit();
			}
		}
	}
	
	if ( $_POST[ "reference" ] == 'product-sousref' ) {
		//print_r($_POST);exit();
		$catproduct = new Catproduct();
		if ($_POST[ "action" ] == 'modif') { //Modifier
			try {
				$result = $catproduct->productsousrefModify($_POST);
				$catproduct = null;
				header('Location: /admin/product-sousref-edit.php?id='.$_POST[ "id" ]. '&rubrique='.$_POST[ "rubrique" ].'&categorie='.$_POST[ "categorie" ]);
			} catch (Exception $e) {
				echo 'Erreur contactez votre administrateur <br> :',  $e->getMessage(), "\n";
				$catproduct = null;
				exit();
			}
	
		} else {  //ajouter
			try {
				//print_r($_POST);exit();(!empty($rubriques) && in_array($value[ "id" ], $rubriques)) ? $check = 'checked' : $check = '';
				if (empty($_POST[ "sousref" ]))  $_POST[ "sousref" ]=randomChar(5);
				$result = $catproduct->productsousrefAdd($_POST);
				$catproduct = null;
				header('Location: /admin/product-sousref-edit.php?id='.$_POST[ "id" ] .'&rubrique='.$_POST[ "rubrique" ].'&categorie='.$_POST[ "categorie" ]);
			} catch (Exception $e) {
				echo 'Erreur contactez votre administrateur <br> :',  $e->getMessage(), "\n";
				$catproduct = null;
				exit();
			}
		}
	}
	
	if ( $_POST[ "reference" ] == 'product-color' ) {
		//print_r($_POST);exit();
		$catproduct = new Catproduct();
		if ($_POST[ "action" ] == 'add') { //add
			try {
				$result = $catproduct->colorAdd($_POST);
				$catproduct = null;
				header('Location: /admin/product-color-edit.php?id_product='.$_POST[ "id_product" ].'&rubrique='.$_POST[ "rubrique" ].'&categorie='.$_POST[ "categorie" ]);
			} catch (Exception $e) {
				echo 'Erreur contactez votre administrateur <br> :',  $e->getMessage(), "\n";
				$catproduct = null;
				exit();
			}
		}
	}
	
	if ( $_POST[ "reference" ] == 'product-size' ) {
		//print_r($_POST);exit();
		$catproduct = new Catproduct();
		if ($_POST[ "action" ] == 'add') { //add
			try {
				$result = $catproduct->sizeAdd($_POST);
				$catproduct = null;
				header('Location: /admin/product-size-edit.php?id_product='.$_POST[ "id_product" ].'&rubrique='.$_POST[ "rubrique" ].'&categorie='.$_POST[ "categorie" ]);
			} catch (Exception $e) {
				echo 'Erreur contactez votre administrateur <br> :',  $e->getMessage(), "\n";
				$catproduct = null;
				exit();
			}
		}
	}
}

// ---- GET GET GET ------------------------------ //
else if ( !empty( $_GET ) ) {
	
	if ($_GET[ "reference" ] == 'product'){ //supprimer
		$catproduct = new Catproduct();
		if ($_GET[ "action" ] == 'delete'){
			try {
				$result = $catproduct->productDelete($_GET[ "id" ]);
				$catproduct = null;
				header('Location: /admin/product-list.php?rubrique='.$_GET[ "rubrique" ].'&categorie='.$_GET[ "categorie" ]);
			} catch (Exception $e) {
				echo 'Erreur contactez votre administrateur <br> :',  $e->getMessage() , '\n';
				$catproduct = null;
				exit();
			}
		}
	}
	
	if ($_GET[ "reference" ] == 'product'){ //supprimer
	    $catproduct = new Catproduct();
	    if ($_GET[ "action" ] == 'reactive'){
	        try {
	            $result = $catproduct->productActive($_GET[ "id" ]);
	            $catproduct = null;
	            header('Location: /admin/product-list.php?actif=OFFrubrique='.$_GET[ "rubrique" ].'&categorie='.$_GET[ "categorie" ]);
	        } catch (Exception $e) {
	            echo 'Erreur contactez votre administrateur <br> :',  $e->getMessage() , '\n';
	            $catproduct = null;
	            exit();
	        }
	    }
	}
	
	if ($_GET[ "reference" ] == 'product-sousref'){ //supprimer
		$catproduct = new Catproduct();
		if ($_GET[ "action" ] == 'delete'){
			try {
				$result = $catproduct->productsousrefDelete($_GET[ "id_sousref" ]);
				$catproduct = null;
				header('Location: /admin/product-sousref-edit.php?id='.$_GET[ "id" ].'&rubrique='.$_GET[ "rubrique" ].'&categorie='.$_GET[ "categorie" ]);
			} catch (Exception $e) {
				echo 'Erreur contactez votre administrateur <br> :',  $e->getMessage() , '\n';
				$catproduct = null;
				exit();
			}
		}
	}
	
	if ($_GET[ "reference" ] == 'product-color'){ //supprimer
		$catproduct = new Catproduct();
		if ($_GET[ "action" ] == 'delete'){
			try {
				$result = $catproduct->colorDelete($_GET[ "id" ]);
				$catproduct = null;
				header('Location: /admin/product-color-edit.php?id_product='.$_GET[ "id_product" ]);
			} catch (Exception $e) {
				echo 'Erreur contactez votre administrateur <br> :',  $e->getMessage() , '\n';
				$catproduct = null;
				exit();
			}
		}
	}
	
	if ($_GET[ "reference" ] == 'product-size'){ //supprimer
		$catproduct = new Catproduct();
		if ($_GET[ "action" ] == 'delete'){
			try {
				$result = $catproduct->sizeDelete($_GET[ "id" ]);
				$catproduct = null;
				header('Location: /admin/product-size-edit.php?id_product='.$_GET[ "id_product" ]);
			} catch (Exception $e) {
				echo 'Erreur contactez votre administrateur <br> :',  $e->getMessage() , '\n';
				$catproduct = null;
				exit();
			}
		}
	}
	
} 

// ---- ERREUR ----------------------------------- //
else {
	header('Location: /admin/');
}

?>