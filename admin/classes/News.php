<?php
require_once("StorageManager.php");
class News extends StorageManager {

	public function __construct(){

	}
	
	public function newsValidGet(){
		$this->dbConnect();
		$requete = "SELECT * FROM `news` WHERE online=1 ORDER BY `date_news` DESC" ;
		//print_r($requete);
		$new_array = null;
		$result = mysqli_query($this->mysqli,$requete);
		while( ($row = mysqli_fetch_assoc( $result)) != false) {
			$new_array[] = $row;
		}
		$this->dbDisConnect();
		return $new_array;
	}
	
	
	public function newsGet($id,$online){
		 $this->dbConnect();
		if (!isset($id)){
		    if ($online==1) {
		        $requete = "SELECT * FROM `news` WHERE online=1 ORDER BY date_news DESC" ;
		    }else {
		        $requete = "SELECT * FROM `news` ORDER BY date_news DESC" ;
		    }
			
		} else {
			$requete = "SELECT * FROM `news` WHERE `id_news`=". $id;
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
	
	public function newsGetOffset($offset,$count){
	    $this->dbConnect();
	    $requete = "SELECT * FROM `news` WHERE alaune=1 AND online=1 ORDER BY date_news DESC LIMIT ". $offset .",". $count .";" ;
	    //print_r($requete);
	    $new_array = null;
	    $result = mysqli_query($this->mysqli,$requete);
	    while( ($row = mysqli_fetch_assoc( $result)) != false) {
	        $new_array[] = $row;
	    }
	    $this->dbDisConnect();
	    return $new_array;
	}
	
	public function newsAdd($value){
		//print_r($value);
		//exit();
		$this->dbConnect();
		$this->begin();
		($value['online']=='1') ? $online = 1 : $online = 0;
		($value['alaune']=='1') ? $alaune = 1 : $alaune = 0;
		try {
			
			$sql = "INSERT INTO  `news`
						(`date_news`, `titre`, `accroche`, `image1`, `video`, `contenu`, `alaune`, `online`)
						VALUES (
						'". $this->inserer_date($value['datepicker']) ."', 
						'". addslashes($value['titre']) ."',
						'". addslashes($value['accroche']) ."',
						'". addslashes($value['url1']) ."',
						'". addslashes($value['video']) ."',
						'". addslashes($value['contenu']) ."',
						". $alaune .", 	    
						". $online ."	
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
	
	public function newsModify($value){
		//print_r($value);
		//exit();
		$this->dbConnect();
		$this->begin();
		try {
			($value['online']=='1') ? $online = 1 : $online = 0;
			($value['alaune']=='1') ? $alaune = 1 : $alaune = 0;
			$sql = "UPDATE  .`news` SET
					`date_news`='". $this->inserer_date($value['datepicker']) ."', 
					`titre`='". addslashes($value['titre']) ."', 
					`accroche`='". addslashes($value['accroche']) ."', 
					`image1`='". addslashes($value['url1']) ."',
					`video`='". addslashes($value['video']) ."',
					`contenu`='". addslashes($value['contenu']) ."',
					`alaune`=". $alaune .",	
					`online`=". $online ."		 
					WHERE `id_news`=". $value['id'] .";";
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
	
	public function newsDelete($value){
		//print_r($value);
		//exit();
	
		 $this->dbConnect();
		$this->begin();
		try {
			$sql = "DELETE FROM  .`news` 
					WHERE `id_news`=". $value .";";
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
	
	
}