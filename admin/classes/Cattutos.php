<?php
require_once("StorageManager.php");

class Cattutos extends StorageManager {

  var $tabView = null;
	var $i = 0;
	
	public function __construct(){
		
	}
	
	public function stuffAdd($value){
	    //print_r($value);exit();
	    $this->dbConnect();
	    $this->begin();
	
	    try {
	        $sql = "INSERT INTO  `cattutos`
						(`date`, `titre`, `accroche`, `video`, `contenu`)
						VALUES (
						'". $this->inserer_date($value['datepicker']) ."',
						'". addslashes($value['titre']) ."',
						'". addslashes($value['accroche']) ."',
						'". addslashes($value['video']) ."',
						'". addslashes($value['contenu']) ."'
					);";
	        $result = mysqli_query($this->mysqli,$sql);
	        	
	        if (!$result) {
	            throw new Exception($sql);
	        }
	        $id_record = mysqli_insert_id($this->mysqli);
	        $this->commit();
	
	    } catch (Exception $e) {
	        $this->rollback();
	        throw new Exception("Erreur Mysql ". $e->getMessage());
	        return "errrrrrrooooOOor";
	    }
	    $this->dbDisConnect();
	    return $id_record;
	}
	
	public function stuffModify($value){
	    //print_r($value);
	    //exit();
	
	    $this->dbConnect();
	    $this->begin();
	    try {
	        $sql = "UPDATE  .`cattutos` SET
					`date`='". $this->inserer_date($value['datepicker']) ."',
					`titre`='". addslashes($value['titre']) ."',
					`accroche`='". addslashes($value['accroche']) ."',
					 `video`='". addslashes($value['video']) ."',
					`contenu`='". addslashes($value['contenu']) ."' 
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
	
	public function stuffDelete($value){
	    //print_r($value);
	    //exit();
	
	    $this->dbConnect();
	    $this->begin();
	    try {
	        //$recherche[ "num_parent" ] = $value;
	        //$res = $this->getImagesListe($recherche);
	        
	        $sql = "DELETE FROM  .`cattutos`
					WHERE `id`=". $value .";";
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
	
	
	
	
	public function stuffGetByParentId($id){
	    $this->dbConnect();
	    if ($id == null){
	        $requete = "SELECT * FROM `cattutos` ORDER BY date DESC" ;
	    }else {
	        $requete = "SELECT * FROM `cattutos` WHERE parent=". $id ." ORDER BY date  DESC" ;
	    }
	    //print_r($requete);
	    $new_array = null;
	    $result = mysqli_query($this->mysqli,$requete);
	    while( ($row = mysqli_fetch_assoc( $result)) != false) {
	        $new_array[] = $row;
	    }
	    $this->dbDisConnect();
	    return $new_array;
	}
	
	
	public function catStuffGet($id){
	    $this->dbConnect();
	    $requete = "SELECT * FROM `cattutos` WHERE id=". $id ;
	    //print_r($requete);
	    $new_array = null;
	    $result = mysqli_query($this->mysqli,$requete);
	    while( ($row = mysqli_fetch_assoc( $result)) != false) {
	        $new_array[] = $row;
	    }
	    $this->dbDisConnect();
	    return $new_array;
	}
	
	public function getImagesListe( $tab=array()){
	    //print_r($tab);
	    $this->dbConnect();
	    $this->begin();
	    try {
    	    $requete = "SELECT * FROM `cattutos_image`" ;
    	
    	    if ( !isset($tab[ "where" ]) ) {
    	        $requete .= " WHERE num_image > 0";
    	        	
    	        if ( !empty( $tab ) ) {
    	            foreach( $tab as $champ => $val ) {
    	                if ( $champ != "champ" && $champ != "order_by" && $champ != "sens" )
    	                    $requete .= " AND " . $champ . " = '" . addslashes( $val ) . "'";
    	            }
    	        }
    	        	
    	        $order_by = ( isset($tab[ "order_by" ])) ? $tab[ "order_by" ] : "num_image";
    	        $sens = ( isset($tab[ "sens" ]) ) ? $tab[ "sens" ] : "ASC";
    	        $requete .= " ORDER BY " . $order_by . " " . $sens;
    	    } else {
    	        $requete .= $tab[ "where" ];
    	    }	    
    	    //print_r($requete);
    	    $new_array = null;
    	    $result = mysqli_query( $this->mysqli, $requete );
    	    while( ( $row = mysqli_fetch_assoc( $result ) ) != false ){
    	        $new_array[] = $row;
    	    }
    	    $this->commit();
	    } catch (Exception $e) {
	        $this->rollback();
	        throw new Exception("Erreur Mysql ". $e->getMessage());
	        return "errrrrrrooooOOor";
	    }   
    	$this->dbDisConnect();
    	return $new_array;
	}
	
	public function getImageDefaut( $num=0) {
	
	    $this->dbConnect();
	    $requete = "SELECT * FROM `cattutos_image`
			WHERE num_parent = " . intval( $num ) . "
			AND defaut = 'oui'";
	    $result = mysqli_query( $this->mysqli, $requete );
	
	    $row = mysqli_fetch_assoc( $result );
	    $this->dbDisConnect();
	    return $row;
	}
	
	public function ajouterImage( $value) {
	    $this->dbConnect();
	    $this->begin();
	
	    try {
	        ( $value[ 'defaut' ] == 'oui' ) ? $defaut = "oui" : $defaut = "non";
	        	
	        $sql = "INSERT INTO `cattutos_image`
				( `num_parent`, `fichier`, `defaut` )
				VALUES (
				". intval( $value[ "num_parent" ] ) .",
				'". addslashes( $value[ "fichier" ] ) ."',
				'". $defaut ."'
			);";
	        $result = mysqli_query( $this->mysqli, $sql );
	
	        if ( !$result ) {
	            throw new Exception( $sql );
	        }
	        $id_record = mysqli_insert_id( $this->mysqli );
	        	
	        $this->commit();
	
	    } catch (Exception $e) {
	        $this->rollback();
	        throw new Exception("Erreur Mysql ". $e->getMessage());
	        return "errrrrrrooooOOor";
	    }
	    $this->dbDisConnect();
	    return $id_record;
	}
	
	public function setChamp( $champ, $valeur=0, $id=0) {
	
	    $this->dbConnect();
	    $this->begin();
	    try {
	        $requete = "UPDATE `cattutos` SET";
	        $requete .= " " . $champ . " = '" . $this->traiter_champ( $valeur ) . "'";
	        $requete .= " WHERE `id`=" . $id . ";";
	        $result = mysqli_query( $this->mysqli, $requete );
	        	
	        if ( !$result ) {
	            throw new Exception( $requete );
	        }
	
	        $this->commit();
	        	
	    } catch (Exception $e) {
	        $this->rollback();
	        throw new Exception("Erreur Mysql ". $e->getMessage());
	        return "errrrrrrooooOOor";
	    }
	
	    $this->dbDisConnect();
	}
	
	public function setChampImage( $champ, $valeur=0, $id=0) {
	
	    $this->dbConnect();
	    $this->begin();
	    try {
	        $requete = "UPDATE `cattutos_image` SET";
	        $requete .= " " . $champ . " = '" . $this->traiter_champ( $valeur ) . "'";
	        $requete .= " WHERE `num_image`=" . $id . ";";
	        $result = mysqli_query( $this->mysqli, $requete );
	
	        if ( !$result ) {
	            throw new Exception( $requete );
	        }
	
	        $this->commit();
	
	    } catch (Exception $e) {
	        $this->rollback();
	        throw new Exception("Erreur Mysql ". $e->getMessage());
	        return "errrrrrrooooOOor";
	    }
	
	    $this->dbDisConnect();
	}
	
	public function supprimerImage( $num_image) {
	
	    $this->dbConnect();
	    $this->begin();
	    try {
	        $sql = "DELETE FROM `cattutos_image` WHERE `num_image` = " . intval( $num_image );
	        $result = mysqli_query( $this->mysqli, $sql );
	        	
	        if ( !$result ) {
	            throw new Exception($sql);
	        }
	
	        $this->commit();
	
	    }
	    catch (Exception $e) {
	        $this->rollback();
	        throw new Exception("Erreur Mysql ". $e->getMessage());
	        return "errrrrrrooooOOor";
	    }
	
	    $this->dbDisConnect();
	}
	
	private function traiter_champ( $texte='' ) {
	    $texte = trim( $texte );
	    $texte = addslashes( $texte );
	    $texte = utf8_decode( $texte );
	
	    return $texte;
	}
}