<?php
require_once("StorageManager.php");

class Catproduct extends StorageManager {

  var $tabView = null;
	var $i = 0;
	
	public function __construct(){
		
	}
	
	public function catproductByParentGet($id){
		$this->dbConnect();
		$requete = "SELECT * FROM `catproduct` WHERE parent=". $id ." ORDER BY ordre" ;
		//print_r($requete);
		$new_array = null;
		$result = mysqli_query($this->mysqli,$requete);
		while( $row = mysqli_fetch_assoc( $result)){
			$new_array[] = $row;
		}
		$this->dbDisConnect();
		return $new_array;
	}
	
	public function getProductsByCategorie($id){
		$this->dbConnect();
		$requete = "SELECT product.id,product.reference,product.prix,product.libprix,product.label,product.accroche,
					product.titreaccroche,product.description,product.image1,product.image2,product.image3,
					catproduct.label as catlabel
					FROM product 
					INNER JOIN product_categorie ON product.id = product_categorie.id_product
					INNER JOIN catproduct ON catproduct.id = product_categorie.id_categorie
					WHERE product_categorie.id_categorie=". $id ;
		//print_r($requete);exit();
		$new_array = null;
		$result = mysqli_query($this->mysqli,$requete);
		while( $row = mysqli_fetch_assoc( $result)){
			$new_array[] = $row;
		}
		$this->dbDisConnect();
		return $new_array;
	}
	
	public function getCategorieByProduct($id){
		$requete = "SELECT catproduct.label as catlabel,catproduct.id as catid,catproduct.image as descat
					FROM product 
					INNER JOIN product_categorie ON product.id=product_categorie.id_product 
					INNER JOIN catproduct ON catproduct.id = product_categorie.id_categorie 
					WHERE product.id=". $id ;
		//print_r($requete);exit();
		$new_array = null;
		$result = mysqli_query($this->mysqli,$requete);
		while( $row = mysqli_fetch_assoc( $result)){
			$new_array[] = $row;
		}
		return $new_array;
	}
	
	public function getRubriqueByProduct($id){
		$requete = "SELECT rubrique.label as rublabel,rubrique.id as rubid
					FROM product
					INNER JOIN product_rubrique ON product.id=product_rubrique.id_product
					INNER JOIN rubrique ON rubrique.id = product_rubrique.id_rubrique
					WHERE product.id=". $id ;
		//print_r($requete);exit();
		$new_array = null;
		$result = mysqli_query($this->mysqli,$requete);
		while( $row = mysqli_fetch_assoc( $result)){
			$new_array[] = $row;
		}
		return $new_array;
	}
	
	public function getCouleurByProduct($id){
		$requete = "SELECT couleur.label as couleurlabel,couleur.id as couleurid
					FROM product
					INNER JOIN product_couleur ON product.id=product_couleur.id_product
					INNER JOIN couleur ON couleur.id = product_couleur.id_couleur
					WHERE product.id=". $id ;
		//print_r($requete);exit();
		$new_array = null;
		$result = mysqli_query($this->mysqli,$requete);
		while( $row = mysqli_fetch_assoc( $result)){
			$new_array[] = $row;
		}
		return $new_array;
	}
	
	public function afficherRubriques( $id=0, $debug=false ){
		$this->dbConnect();
		$sql = "SELECT * FROM rubrique";
		$sql .= " WHERE id = " . $id;
		
		if ( $debug ) echo $sql . "<br>";
		$new_array = null;
		$result = mysqli_query($this->mysqli,$sql);
		if ( !$result ) {
			throw new Exception($sql);
		}
		
		$data = mysqli_fetch_assoc( $result );
		
		// ---- Préparation du contenu à afficher ----- //
		if ( 1 == 1 ) {
			$_image = ( $data[ "image" ] != '' )
				? "/photos/rubrique" . $data[ "image" ]
				: "/img/favicon.png";
			$contenu = "<div class='large-4 medium-4 small-12 columns' onclick=\"location.href='categories.php?idrub=" . $data[ "id" ] . "'\">\n";
			$contenu .= "	<div class='content'>\n";
			$contenu .= "		<span>\n";
			//$contenu .= "			<img src='img/couronne.png' alt='' class='couronne' />\n";
			$contenu .= "			<img src='" . $_image . "' alt='' class='img' />\n";
			$contenu .= "		</span>\n";
			$contenu .= "		<h4>" . $data[ "label" ] . "</h4>\n";
			$contenu .= "		<p>" . $data[ "sous_titre" ] . "</p>\n";
			$contenu .= "		<a href='categories.php?idrub=" . $data[ "id" ] . "' class='bt-voir'>Voir</a>\n";
			$contenu .= "	</div>\n";
			$contenu .= "</div>\n";
		}
		// -------------------------------------------- //
		
		$this->dbDisConnect();
		return $contenu;
	}
	
	public function getRubriques( $id=0, $debug=false ){
		$this->dbConnect();
		$sql = "SELECT * FROM rubrique";
		if ( $id > 0 ) $sql .= " WHERE id = " . $id;
		$sql .= " ORDER BY id ASC;";
		
		if ( $debug ) echo $sql . "<br>";
		$new_array = null;
		$result = mysqli_query($this->mysqli,$sql);
		if (!$result) {
			throw new Exception($sql);
		}
		while( $row = mysqli_fetch_assoc( $result)){
			$new_array[] = $row;
		}
		$this->dbDisConnect();
		return $new_array;
	}
	
	public function gerer_rubrique( $post=array(), $debug=false ) {
		$data = $this->getRubriques( $post[ "id" ], false );
		$modification = ( !empty( $data ) ) ? true : false;
		
		if ( $modification ) {
			//echo "Modif de la rubrique...<br>";
			$this->modifierRubrique( $post, $debug );
		}
		
	}
	
	private function modifierRubrique( $post=array(), $debug=false ) {
		$this->dbConnect();
		$this->begin();
	
		$sql = "UPDATE `rubrique` SET ";
		$sql .= "`label` = '" . $this->traiter_champ( $post[ "label" ] ) . "'";
		$sql .= ", `sous_titre` = '" . $this->traiter_champ( $post[ "sous_titre" ] ) . "' ";
		if ( $post[ "image" ] != '' ) $sql .= " , `image` = '" . $this->traiter_champ( $post[ "image" ] ) . "' ";
		$sql .= "WHERE `id`=". $post[ "id" ] .";";
		
		if ( $debug ) echo $sql . "<br>";
		else {
			$result = mysqli_query( $this->mysqli, $sql );
				
			if (!$result) {
				$this->rollback();
				throw new Exception('Erreur Mysql colorDelete sql = : '.$sql);
			}
		
			$this->commit();
			$this->dbDisConnect();
		}
	}
	
	public function getCouleurs(){
		$this->dbConnect();
		$sql = "SELECT *
					FROM couleur
					ORDER BY label;";
		//print_r($sql);exit();
		$new_array = null;
		$result = mysqli_query($this->mysqli,$sql);
		if (!$result) {
			throw new Exception($sql);
		}
		while( $row = mysqli_fetch_assoc( $result)){
			$new_array[] = $row;
		}
		$this->dbDisConnect();
		return $new_array;
	}
	
	public function getColors(){
		$this->dbConnect();
		$sql = "SELECT *
					FROM color
					ORDER BY label;";
		//print_r($sql);exit();
		$new_array = null;
		$result = mysqli_query($this->mysqli,$sql);
		if (!$result) {
			throw new Exception($sql);
		}
		while( $row = mysqli_fetch_assoc( $result)){
			$new_array[] = $row;
		}
		$this->dbDisConnect();
		return $new_array;
	}
	
	public function colorAdd($value){
		//print_r($value);exit();
	
		$this->dbConnect();
		$this->begin();
	
		$sql = "INSERT INTO `color`
					(`label`)
					VALUES (
					'". addslashes($value['label']) ."'
				);";
		$result = mysqli_query($this->mysqli,$sql);
	
		if (!$result) {
			$this->rollback();
			throw new Exception('Erreur Mysql colorAdd sql = : '.$sql);
		}
		$id_record = mysqli_insert_id($this->mysqli);
	
		$this->commit();
	
		$this->dbDisConnect();
		return $id_record;
	}
	
	public function colorDelete($value){
		//print_r($value);exit();
		$this->dbConnect();
		$this->begin();
	
		$sql = "DELETE FROM `color`
				WHERE `id`=". $value .";";
		$result = mysqli_query($this->mysqli,$sql);
			
		if (!$result) {
			$this->rollback();
			throw new Exception('Erreur Mysql colorDelete sql = : '.$sql);
		}
	
		$this->commit();
		$this->dbDisConnect();
	}
	
	public function sizeAdd($value){
		//print_r($value);exit();
	
		$this->dbConnect();
		$this->begin();
	
		$sql = "INSERT INTO `size`
					(`label`)
					VALUES (
					'". addslashes($value['label']) ."'
				);";
		$result = mysqli_query($this->mysqli,$sql);
	
		if (!$result) {
			$this->rollback();
			throw new Exception('Erreur Mysql sizeAdd sql = : '.$sql);
		}
		$id_record = mysqli_insert_id($this->mysqli);
	
		$this->commit();
	
		$this->dbDisConnect();
		return $id_record;
	}
	
	public function sizeDelete($value){
		//print_r($value);exit();
		$this->dbConnect();
		$this->begin();
	
		$sql = "DELETE FROM `size`
				WHERE `id`=". $value .";";
		$result = mysqli_query($this->mysqli,$sql);
			
		if (!$result) {
			$this->rollback();
			throw new Exception('Erreur Mysql sizeDelete sql = : '.$sql);
		}
	
		$this->commit();
		$this->dbDisConnect();
	}
	
	public function getSizes(){
		$this->dbConnect();
		$sql = "SELECT *
					FROM size
					ORDER BY label;";
		//print_r($sql);exit();
		$new_array = null;
		$result = mysqli_query($this->mysqli,$sql);
		if (!$result) {
			throw new Exception($sql);
		}
		while( $row = mysqli_fetch_assoc( $result)){
			$new_array[] = $row;
		}
		$this->dbDisConnect();
		return $new_array;
	}
	
	public function catproduitViewIterative($result){
		if ($this->i==0){
			$result = $this->catproductByParentGet(0);
			//print_r($result);
		}
		if (!empty($result)) {
	
			foreach ($result as $value) {
				$decalage = "";
				//for ($j=0; $j<($value['level'] * 5); $j++) $decalage .= " ";
				//echo $decalage. $this->i . $value['label']." ". $value['id'] ." Lev:". $value['level'] . "<br>";
				$this->tabView[$this->i]['label'] = $value['label'];
				$this->tabView[$this->i]['id'] = $value['id'];
				$this->tabView[$this->i]['level'] = $value['level'];
				$this->tabView[$this->i]['description'] = $value['description'];
				$this->tabView[$this->i]['image'] = $value['image'];
				$this->tabView[$this->i]['ordre'] = $value['ordre'];
				$result = $this->catproductByParentGet($value['id']);
				//print_r($result);
				$this->i++;
				$this->catproduitViewIterative($result);
			}
	
		}
	}
	
	public function catproductGet($id){
		$this->dbConnect();
		$requete = "SELECT * FROM `catproduct` WHERE id=". $id ;
		//print_r($requete);
		$new_array = null;
		$result = mysqli_query($this->mysqli,$requete);
		while( $row = mysqli_fetch_assoc( $result)){
			$new_array[] = $row;
		}
		$this->dbDisConnect();
		return $new_array;
	}
	
	public function catproductAdd($value){
		if ($value['parent'] != 0){
			$parent = $this->catproductGet($value['parent']);
			$level = $parent[0]['level']+1;
		} else {
			$level = 0;
		}
		//print_r($level);exit();
		
		$this->dbConnect();
		$this->begin();
		
		$sql = "INSERT INTO .`catproduct`
					(`label`, `parent`, `level`)
					VALUES (
					'". addslashes($value['label']) ."',
					'". addslashes($value['parent']) ."',
					". $level ." 	
				);";
		$result = mysqli_query($this->mysqli,$sql);
		
		if (!$result) {
			$this->rollback();
			throw new Exception('Erreur Mysql catproductAdd sql = : '.$sql);
		}
		$id_record = mysqli_insert_id($this->mysqli);
		$this->commit();
		
		$this->dbDisConnect();
		return $id_record;
	}
	
	public function catproductModify($value){
		//print_r($value);exit();
		$this->dbConnect();
		$this->begin();
		try {
			$sql = "UPDATE .`catproduct` SET
					`label`='". addslashes($value['label']) ."', 
					`description`='". addslashes($value['description']) ."', 
					`image`='". addslashes($value['url1']) ."' 
					WHERE `id`=". $value['id'] .";";
			$result = mysqli_query($this->mysqli,$sql);
			
			if (!$result) {
				throw new Exception($sql);
			}
		
			$this->commit();
		
		} catch (Exception $e) {
			$this->rollback();
			throw new Exception("Erreur Mysql ". $e->getMessage());
			return "errrrrrrooooOOor";
		}
		
		
		$this->dbDisConnect();
	}
	
	public function catproductDelete($value){
		
	  //Check si la categorie ne contient pas de catégorie
	  $categlst = $this->catproductByParentGet($value);
	  if (!empty($categlst)){
	    throw new Exception("La categorie n'est pas vide ! ",1234);
	  }
	  //print_r($categlst);exit;

		//Check if the categorie is empty !
		$prod = $this->getProductsByCategorie($value);
		//print_r($prod);
		if (!empty($prod)){
			throw new Exception("La categorie n'est pas vide ! ",1234);
		}
		
		$this->dbConnect();
		$this->begin();
		
		$sql = "DELETE FROM .`catproduct` 
				WHERE `id`=". $value .";";
		$result = mysqli_query($this->mysqli,$sql);
			
		if (!$result) {
			$this->rollback();
			throw new Exception('Erreur Mysql catproductDelete sql = : '.$sql);
		}

		$this->commit();
	
		$this->dbDisConnect();
	}
	
	public function productNumberGet( $categorie, $rubrique, $actif, $debug=false ) {
		$this->dbConnect();
		
		if (empty($categorie) && empty($rubrique)) {
			$sql = "SELECT count(*) as nb FROM `product`" ;
			if ( $actif != '' ) $sql .= " WHERE actif = " . $actif;
		} 
		else if (!empty($categorie) && empty($rubrique)) {
			$sql = "SELECT count(*) as nb
					FROM product
					INNER JOIN product_categorie 
					ON product_categorie.id_product=product.id
					WHERE product_categorie.id_categorie=". $categorie . " AND actif=$actif;" ;
		} 
		else if (empty($categorie) && !empty($rubrique)) {
			$sql = "SELECT count(*) as nb
					FROM product
					INNER JOIN product_rubrique
					ON product_rubrique.id_product=product.id
					WHERE product_rubrique.id_rubrique=". $rubrique . " AND actif=$actif;" ;
		} 
		else if (!empty($categorie) && !empty($rubrique)) {
			$sql = "SELECT count(*) as nb
					FROM product
					INNER JOIN product_categorie 
					ON product_categorie.id_product=product.id
					INNER JOIN product_rubrique
					ON product_rubrique.id_product=product.id		
					WHERE product_rubrique.id_rubrique=". $rubrique . "
					AND product_categorie.id_categorie=". $categorie ." AND actif=$actif;" ;
				
		}	
		
		if ( $debug ) echo $sql . "<br>";
		$new_array = null;
		$result = mysqli_query($this->mysqli,$sql);
		if (!$result) {
			throw new Exception('Erreur Mysql productNumberGet sql = : '.$sql);
		}
		while( $row = mysqli_fetch_assoc( $result)){
			$new_array[] = $row;
		}
		$this->dbDisConnect();
		return $new_array[0]['nb'];
	}
	
	public function colorProductNumberGet($id_color,$actif){
	  $this->dbConnect();
	
    $sql = "SELECT count(*) as nb
				FROM product
				INNER JOIN product_couleur
				  ON product_couleur.id_product=product.id
				WHERE product_couleur.id_couleur=". $id_color . "
				 AND actif=$actif;" ;
	
	  //print_r($requete);
	  $new_array = null;
	  $result = mysqli_query($this->mysqli,$sql);
	  if (!$result) {
	    throw new Exception('Erreur Mysql colorProductNumberGet sql = : '.$sql);
	  }
	  while( ($row = mysqli_fetch_assoc( $result)) != false) {
	    $new_array[] = $row;
	  }
	  $this->dbDisConnect();
	  return $new_array[0]['nb'];
	}
	
	public function colorProductGet($offset, $count, $id_color,$actif){
	  $this->dbConnect();
	  try {
	    
      $sql = "SELECT product.id,product.reference,product.prix,product.shipping,product.libprix,product.label
        ,product.image1,product.accroche
        FROM product 
        INNER JOIN product_couleur
				  ON product_couleur.id_product=product.id
				WHERE product_couleur.id_couleur=". $id_color . "
				 AND actif=$actif ORDER BY product.label ASC
        LIMIT ". $offset .",". $count .";" ;
	
    	//print_r($sql);
    	$new_array = null;
    	$result = mysqli_query($this->mysqli,$sql);
    	while( ($row = mysqli_fetch_assoc( $result)) != false){
      	$new_array[] = $row;
    	}
    		
    	$this->dbDisConnect();
    	return $new_array;
  	} catch (Exception $e) {
  			die('Erreur : ' . $e->getMessage());
  	    //throw new Exception("Erreur Mysql productGet ". $e->getMessage());
  	    return "errrrrrrooooOOor";
  	}
	}
	
	public function productGet( $id, $offset, $count, $categorie, $rubrique, $actif, $debug=false ){
		$this->dbConnect();
		try {
			if (!isset($id)){
				if (isset($offset) && isset($count)) {
					if (empty($categorie) && empty($rubrique)) {
						if ( $debug ) echo "--- 1<br>";
						$sql = "SELECT product.id, product.reference, product.prix, product.shipping, product.libprix, product.label
									,product.image1, product.accroche
									FROM product WHERE actif = $actif 
									ORDER BY product.reference ASC
									LIMIT ". $offset .",". $count .";" ;
						
					} elseif (!empty($categorie) && empty($rubrique)) {
						if ( $debug ) echo "--- 2<br>";
						$sql = "SELECT product.id,product.reference,product.prix,product.shipping,product.libprix,product.label
									,product.image1,product.accroche
									FROM product
									INNER JOIN product_categorie 
									ON product_categorie.id_product=product.id
									WHERE product_categorie.id_categorie=". $categorie . " AND actif = $actif 
									ORDER BY product.reference ASC
									LIMIT ". $offset .",". $count .";" ;
					} elseif (empty($categorie) && !empty($rubrique)) {
						if ( $debug ) echo "--- 3<br>";
						$sql = "SELECT product.id,product.reference,product.prix,product.shipping,product.libprix,product.label
									,product.image1,product.accroche
									FROM product
									INNER JOIN product_rubrique
									ON product_rubrique.id_product=product.id
									WHERE product_rubrique.id_rubrique=". $rubrique . " AND actif = $actif 
									ORDER BY product.reference ASC
									LIMIT ". $offset .",". $count .";" ;
						
					} elseif (!empty($categorie) && !empty($rubrique)) {	
						if ( $debug ) echo "--- 4<br>";
						$sql = "SELECT product.id,product.reference,product.prix,product.shipping,product.libprix,product.label
									,product.image1,product.accroche
									FROM product
									INNER JOIN product_rubrique
									ON product_rubrique.id_product=product.id
									INNER JOIN product_categorie 
									ON product_categorie.id_product=product.id
									WHERE product_rubrique.id_rubrique=". $rubrique . "
									AND product_categorie.id_categorie=". $categorie . " AND actif = $actif 
									ORDER BY product.reference ASC
									LIMIT ". $offset .",". $count .";" ;
					}
				} else {
					if ( $debug ) echo "--- 5<br>";
					$sql = "SELECT * FROM `product` WHERE actif = $actif ORDER BY `reference`;" ;
				}
			} else {
				if ( $debug ) echo "--- 6<br>";
				$sql = "SELECT product.*
					FROM product 
					WHERE product.id=". $id ;
			}
			
			if ( $debug ) echo $sql . "<b>";
			$new_array = null;
			$result = mysqli_query($this->mysqli,$sql);
			while( $row = mysqli_fetch_assoc( $result)){
				$resultdetailCat = $this->getCategorieByProduct($row['id']);
				$resultdetailRubrique = $this->getRubriqueByProduct($row['id']);
				$resultdetailCouleur = $this->getCouleurByProduct($row['id']);
				$resultSousRef = $this->productsousrefGet($row['id'], null);
				$row['categories'] = $resultdetailCat;
				$row['rubriques'] = $resultdetailRubrique;
				$row['couleurs'] = $resultdetailCouleur;
				$row['sousref'] = $resultSousRef;
				//TODO: Vérifier s'il y a au moins une sousref avec stock > 0 pour l'ajouter mais faire cela seulement pour le front. 
				$new_array[] = $row;
			}
			
			$this->dbDisConnect();
			return $new_array;
		} catch (Exception $e) {
			die('Erreur : ' . $e->getMessage());
			//throw new Exception("Erreur Mysql productGet ". $e->getMessage());
			return "errrrrrrooooOOor";
		}
	}
	
	public function productModify($value){
		//print_r($value);exit();
		$this->dbConnect();
		$this->begin();
		
		$sql = "UPDATE .`product` SET
				`label`='". addslashes($value['label']) ."',
				`reference`='". addslashes($value['ref']) ."',
				`titreaccroche`='". addslashes($value['titreaccroche']) ."',
				`accroche`='". addslashes($value['accroche']) ."',
				`prix`='". addslashes($value['prix']) ."',
				`shipping`='". addslashes($value['shipping']) ."',
				`libprix`='". addslashes($value['libprix']) ."',		
				`description`='". addslashes($value['description']) ."',
				`image1`='". addslashes($value['url1']) ."',
				`image2`='". addslashes($value['url2']) ."',
				`image3`='". addslashes($value['url3']) ."'
				WHERE `id`=". $value['id'] .";";
		//print_r($sql);exit();
		$result = mysqli_query($this->mysqli,$sql);
			
		if (!$result) {
			$this->rollback();
			throw new Exception('Erreur Mysql productModify sql = : '.$sql);
		}
		
		if (!empty($value['categories'])) {
			$this->categoriesProductModify($value['categories'], $value['id']);
		} else {
			$this->categoriesProductDel($value['id']);
		}
		
		if (!empty($value['rubriques'])) {
			$this->rubriquesProductModify($value['rubriques'], $value['id']);
		} else {
			$this->rubriquesProductDel($value['id']);
		}
		
		if (!empty($value['couleurs'])) {
			$this->couleursProductModify($value['couleurs'], $value['id']);
		} else {
			$this->couleursProductDel($value['id']);
		}	
		
		$this->commit();
	
		$this->dbDisConnect();
	}
	
	private function categoriesProductDel($id){
	
		$sql = "DELETE FROM `product_categorie`
				WHERE `id_product`=". $id .";";
		$result = mysqli_query($this->mysqli,$sql);
	
		if (!$result) {
			$this->rollback();
			throw new Exception('Erreur Mysql categoriesProductDel sql = : '.$sql);
		}
	
	}
	
	private function rubriquesProductDel($id){
	
		$sql = "DELETE FROM `product_rubrique`
				WHERE `id_product`=". $id .";";
		$result = mysqli_query($this->mysqli,$sql);
	
		if (!$result) {
			$this->rollback();
			throw new Exception('Erreur Mysql rubriquesProductDel sql = : '.$sql);
		}
	
	}
	
	private function couleursProductDel($id){
	
		$sql = "DELETE FROM `product_couleur`
				WHERE `id_product`=". $id .";";
		$result = mysqli_query($this->mysqli,$sql);
	
		if (!$result) {
			$this->rollback();
			throw new Exception('Erreur Mysql couleursProductDel sql = : '.$sql);
		}
	
	}
	
	private function categoriesProductModify($categories,$id){
		
		$this->categoriesProductDel($id);
		
		$sql = "INSERT INTO `product_categorie`
				(`id_product`, `id_categorie`)
				VALUES "; 
		foreach ($categories as $values){
			$sql .= "(". $id .",". $values ."),";
		}	
		$sql = substr($sql, 0, strlen($sql)-1);
		$sql .= ";";
		$result = mysqli_query($this->mysqli,$sql);

		if (!$result) {
			$this->rollback();
			throw new Exception('Erreur Mysql categoriesProductModify sql = : '.$sql);
		}
		
	}
	
	private function rubriquesProductModify($rubriques,$id){
	
		$this->rubriquesProductDel($id);
	
		$sql = "INSERT INTO `product_rubrique`
				(`id_product`, `id_rubrique`)
				VALUES ";
		foreach ($rubriques as $values){
			$sql .= "(". $id .",". $values ."),";
		}
		$sql = substr($sql, 0, strlen($sql)-1);
		$sql .= ";";
		$result = mysqli_query($this->mysqli,$sql);
	
		if (!$result) {
			$this->rollback();
			throw new Exception('Erreur Mysql rubriquesProductModify sql = : '.$sql);
		}
	
	}
	
	private function couleursProductModify($couleurs,$id){
	
		$this->couleursProductDel($id);
	
		$sql = "INSERT INTO `product_couleur`
				(`id_product`, `id_couleur`)
				VALUES ";
		foreach ($couleurs as $values){
			$sql .= "(". $id .",". $values ."),";
		}
		$sql = substr($sql, 0, strlen($sql)-1);
		$sql .= ";";
		$result = mysqli_query($this->mysqli,$sql);
	
		if (!$result) {
			$this->rollback();
			throw new Exception('Erreur Mysql couleursProductModify sql = : '.$sql);
		}
	
	}
	
	public function productAdd($value){
		//print_r($value);exit();
	
		$this->dbConnect();
		$this->begin();
	
		$sql = "INSERT INTO .`product`
					(`label`, `reference`, `titreaccroche`, `accroche`, `description`, `image1`, `image2`, `image3`,`libprix`,`prix`,shipping)
					VALUES (
					'". addslashes($value['label']) ."',
					'". addslashes($value['ref']) ."',
					'". addslashes($value['titreaccroche']) ."',
					'". addslashes($value['accroche']) ."',
					'". addslashes($value['description']) ."',
					'". addslashes($value['url1']) ."',
					'". addslashes($value['url2']) ."',
					'". addslashes($value['url3']) ."',
					'". addslashes($value['libprix']) ."',
					". $value['prix'] .",
					". $value['shipping'] ."		
				);";
		$result = mysqli_query($this->mysqli,$sql);
	
		if (!$result) {
			$this->rollback();
			throw new Exception('Erreur Mysql productAdd sql = : '.$sql);
		}
		$id_record = mysqli_insert_id($this->mysqli);
		
		if (!empty($value['categories'])) {
			$this->categoriesProductModify($value['categories'], $id_record);
		} 
		
		if (!empty($value['rubriques'])) {
			$this->rubriquesProductModify($value['rubriques'],$id_record);
		} 
		
		if (!empty($value['couleurs'])) {
			$this->couleursProductModify($value['couleurs'], $id_record);
		} 
		
		$this->commit();
	
		$this->dbDisConnect();
		return $id_record;
	}
	
	public function productDelete($value){
	  
	  $this->dbConnect();
	  $this->begin();
	  
	  $sql = "UPDATE `product` SET
				`actif`= 0
				WHERE `id`=". $value .";";
	  //print_r($sql);exit();
	  $result = mysqli_query($this->mysqli,$sql);
	  	
	  if (!$result) {
	    $this->rollback();
	    throw new Exception('Erreur Mysql productDelete sql = : '.$sql);
	  }
	  
	  $this->commit();
	  $this->dbDisConnect();
		
	}
	
	public function productActive($value){
	   
	  $this->dbConnect();
	  $this->begin();
	   
	  $sql = "UPDATE `product` SET
				`actif`= 1
				WHERE `id`=". $value .";";
	  //print_r($sql);exit();
	  $result = mysqli_query($this->mysqli,$sql);
	
	  if (!$result) {
	    $this->rollback();
	    throw new Exception('Erreur Mysql productDelete sql = : '.$sql);
	  }
	   
	  $this->commit();
	  $this->dbDisConnect();
	
	}
	
	public function productsousrefGet( $id_product, $id_souref ){
		$this->dbConnect();
		$sql = null;
		try {
			if (isset($id_souref)){
				$sql = "SELECT product_sousref.id,product_sousref.sousref,product_sousref.id_color, 
							product_sousref.id_size,product_sousref.stock, color.label as color, size.label as size
						FROM product_sousref
						INNER JOIN color ON color.id = product_sousref.id_color
						INNER JOIN size ON size.id = product_sousref.id_size
						WHERE product_sousref.id=". $id_souref .";" ;
			} else {	
				$sql = "SELECT product_sousref.id,product_sousref.sousref,product_sousref.id_color, product_sousref.id_size,product_sousref.stock, color.label as color, size.label as size
						FROM product_sousref
						INNER JOIN color ON color.id = product_sousref.id_color
						INNER JOIN size ON size.id = product_sousref.id_size
						WHERE product_sousref.id_product=". $id_product ."
						ORDER BY product_sousref.id_color;" ;
					
			} 
			//print_r($sql);
			$new_array = null;
			$result = mysqli_query($this->mysqli,$sql);
			while( $row = mysqli_fetch_assoc( $result)){
				$new_array[] = $row;
			}
				
		//	$this->dbDisConnect();
			return $new_array;
		} catch (Exception $e) {
			die('Erreur : ' . $e->getMessage());
			//throw new Exception("Erreur Mysql productGet ". $e->getMessage());
			return "errrrrrrooooOOor";
		}
	}
	
	public function productsousrefGetByStock($stock){
	  $this->dbConnect();
	  $sql = null;
	  try {
      $sql = "SELECT product.label, product.id as id_product,product_sousref.id,product_sousref.sousref,product_sousref.id_color, product_sousref.id_size,product_sousref.stock, color.label as color, size.label as size
  				FROM product_sousref
          iNNER JOIN product ON product.id = product_sousref.id_product
  				INNER JOIN color ON color.id = product_sousref.id_color
  				INNER JOIN size ON size.id = product_sousref.id_size
  				WHERE product_sousref.stock =". $stock ."
  				ORDER BY product_sousref.id_product;" ;
	      	
	    //print_r($sql);
	    $new_array = null;
	    $result = mysqli_query($this->mysqli,$sql);
	    while( $row = mysqli_fetch_assoc( $result)){
	      $new_array[] = $row;
	    }
	
	    $this->dbDisConnect();
	    return $new_array;
	  } catch (Exception $e) {
	    die('Erreur productsousrefGetByStock: ' . $e->getMessage());
	    //throw new Exception("Erreur Mysql productGet ". $e->getMessage());
	    return "errrrrrrooooOOor";
	  }
	}
	
	public function productsousrefAdd($value){
		//print_r($value);exit();
	
		$this->dbConnect();
		$this->begin();
	
		$sql = "INSERT INTO `product_sousref`
					(`sousref`,`id_product`, `stock`,`id_color`,id_size)
					VALUES (
					'". addslashes($value['sousref']) ."',
					". $value['id'] .",
					". $value['stock'] .",
					". $value['color'] .",
					". $value['size'] ."
				);";
		$result = mysqli_query($this->mysqli,$sql);
	
		if (!$result) {
			$this->rollback();
			throw new Exception('Erreur Mysql productsousrefAdd sql = : '.$sql);
		}
		$id_record = mysqli_insert_id($this->mysqli);
	
		$this->commit();
	
		$this->dbDisConnect();
		return $id_record;
	}
	
	public function productsousrefModify($value){
		//print_r($value);exit();
		$this->dbConnect();
		$this->begin();
	
		$sql = "UPDATE `product_sousref` SET
				`sousref`='". addslashes($value['sousref']) ."',
				`stock`='". addslashes($value['stock']) ."',
				`id_color`=". $value['color'] .",
				`id_size`=". $value['size'] ."
				WHERE `id`=". $value['id_souref'] .";";
		//print_r($sql);exit();
		$result = mysqli_query($this->mysqli,$sql);
			
		if (!$result) {
			$this->rollback();
			throw new Exception('Erreur Mysql productsousrefModify sql = : '.$sql);
		}
	
		$this->commit();
		$this->dbDisConnect();
	}
	
	public function productsousrefDelete($value){
		//print_r($value);exit();
		$this->dbConnect();
		$this->begin();
	
		$sql = "DELETE FROM `product_sousref`
				WHERE `id`=". $value .";";
		$result = mysqli_query($this->mysqli,$sql);
			
		if (!$result) {
			$this->rollback();
			throw new Exception('Erreur Mysql productsousrefDelete sql = : '.$sql);
		}
	
		$this->commit();
		$this->dbDisConnect();
	}
	
	public function getStockByProduit( $id_product=0, $debug=false ) {
		//echo "--- id_product : " . $id_product . "<br>";
		$this->dbConnect();
		
		$sql = "SELECT SUM(stock) AS stock FROM `product_sousref`
			WHERE `id_product`=" . $id_product . ";";
		
		if ( $debug ) echo $sql . "<br>";
		$new_array = null;
		$result = mysqli_query($this->mysqli,$sql);
		while( $row = mysqli_fetch_assoc( $result)){
			$new_array[] = $row;
		}
		
		$this->dbDisConnect();
		return $new_array;
	}
	
	function setChamp( $id=0, $champ, $valeur=0, $debug=false ) {
		$this->dbConnect();
		$this->begin();
		
		$requete = "UPDATE `catproduct` SET";
		$requete .= " " . $champ . " = '" . $this->traiter_champ( $valeur ) . "'";
		$requete .= " WHERE id = " . $id;
		if ( $debug ) echo $requete . "<br>";
		else {
			$result = mysqli_query( $this->mysqli, $requete );
		
			if ( !$result ) {
				$this->rollback();
				throw new Exception( 'Erreur Mysql valideCommande sql = : ' . $requete );
			}
			
			$this->commit();
			$this->dbDisConnect();
		}
	}
	
	function traiter_champ( $texte='' ) {
		$texte = trim( $texte );
		$texte = addslashes( $texte );
		//$texte = utf8_decode( $texte );
		
		return $texte;
	}
	
	public function setStock( $id=0, $nb_article="+0", $debug=false ) {
		//echo "--- id : " . $id . "<br>";
		//echo "--- nb_article : " . $nb_article . "<br>";
		$this->dbConnect();
		$this->begin();
	
		$sql = "UPDATE `product_sousref` SET
			stock = stock + " . $nb_article . "
			WHERE `id`=" . $id . ";";
		if ( $debug ) echo $sql . "<br>";
		else {
			$result = mysqli_query( $this->mysqli, $sql );
				
			if ( !$result ) {
				$this->rollback();
				throw new Exception('Erreur Mysql Catproduct.setStock sql = : '.$sql);
			}
			
			$this->commit();
			$this->dbDisConnect();
		}
	}
	
	public function getNbCatByLevel( $level=0, $debug=false ) {
		//echo "--- level : " . $level . "<br>";
		$this->dbConnect();
		
		$sql = "SELECT COUNT(id) AS nb FROM `catproduct`
			WHERE `level`=" . $level . ";";
		
		if ( $debug ) echo $sql . "<br>";
		$result = mysqli_query( $this->mysqli, $sql );
		
		$row = mysqli_fetch_assoc( $result );
		
		$this->dbDisConnect();
		return $row[ "nb" ];
	}
	
}