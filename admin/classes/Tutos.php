<?php
require_once("StorageManager.php");
class Tutos extends StorageManager {

	public function __construct(){

	}
	
	public function newsValidGet(){
		$this->dbConnect();
		$requete = "SELECT * FROM `tutos` WHERE online=1 ORDER BY `date_news` DESC" ;
		//print_r($requete);
		$new_array = null;
		$result = mysqli_query($this->mysqli,$requete);
		while( ($row = mysqli_fetch_assoc( $result)) != false) {
			$new_array[] = $row;
		}
		$this->dbDisConnect();
		return $new_array;
	}
	
	
	public function newsGet($id){
		 $this->dbConnect();
		if (!isset($id)){
			$requete = "SELECT * FROM `tutos` ORDER BY date_news DESC" ;
		} else {
			$requete = "SELECT * FROM `tutos` WHERE id_news=". $id ;
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
	    $requete = "SELECT * FROM `tutos` WHERE online=1 ORDER BY date_news DESC LIMIT ". $offset .",". $count .";" ;
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
	    //error_log(date("Y-m-d H:i:s") . " : XAV: ". addslashes($value['accroche'])  ."\n", 3, "../log/spy.log");
		 $this->dbConnect();
		$this->begin();
		
		try {
			($value['online']=='on') ? $online = 1 : $online = 0;
			$sql = "INSERT INTO  `tutos`
						(`date_news`, `titre`, `accroche`, `image1`,`image2`,`image3`, `video`, `contenu`, `online`)
						VALUES (
						'". $this->inserer_date($value['datepicker']) ."', 
						'". addslashes($value['titre']) ."',
						'". addslashes($value['accroche']) ."',
						'". addslashes($value['url1']) ."',
						'". addslashes($value['url2']) ."',
						'". addslashes($value['url3']) ."',
						'". addslashes($value['video']) ."',
						'". addslashes($value['contenu']) ."',
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
			($value['online']=='on') ? $online = 1 : $online = 0;
			$sql = "UPDATE  .`tutos` SET
					`date_news`='". $this->inserer_date($value['datepicker']) ."', 
					`titre`='". addslashes($value['titre']) ."', 
					`accroche`='". addslashes($value['accroche']) ."', 
					`image1`='". addslashes($value['url1']) ."',
					`image2`='". addslashes($value['url2']) ."',
					`image3`='". addslashes($value['url3']) ."',    
					 `video`='". addslashes($value['video']) ."',
					`contenu`='". addslashes($value['contenu']) ."',
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
			$sql = "DELETE FROM  .`tutos` 
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