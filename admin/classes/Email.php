<?php
require_once("StorageManager.php");
class Email extends StorageManager {

	public function __construct(){

	}
	
    public function numberOfGet() {
		$this->dbConnect();
		try {
    		$sql = "SELECT count(id) as nb FROM `email`;" ;
    		$result = mysqli_query( $this->mysqli, $sql );
    		
    		while( ($row = mysqli_fetch_assoc( $result)) != false){
    		    $new_array = $row;
    		}
		
		} catch (Exception $e) {
			throw new Exception("Erreur Mysql ". $e->getMessage());
			return "errrrrrrooooOOor";
		}
		$this->dbDisConnect();
		return  $new_array['nb'];
	}
	
	public function get($id, $offset, $count){
		$this->dbConnect();
		if (!isset($id)){
			$requete = "SELECT * FROM `email` ORDER BY `date` DESC LIMIT ". $offset .",". $count .";" ;
		} else {
			$requete = "SELECT * FROM `email` WHERE id=". $id ." ORDER BY `date` DESC" ;
		}
		
		//LIMIT ". $offset .",". $count .";" ;
		
		//print_r($requete);
		$new_array = null;
		$result = mysqli_query($this->mysqli,$requete);
	    while( ($row = mysqli_fetch_assoc( $result)) != false){
      	  $new_array[] = $row;
    	}
		$this->dbDisConnect();
		return $new_array;
	}
	
	
	
	public function add($value){
		//print_r($value); exit();
	    //error_log(date() . " : XAV: ". addslashes($value['name'])  ."\n", 3, "../log/spy.log");
		$this->dbConnect();
		$this->begin();
		try {
			$sql = "INSERT INTO  .`email`
						(`date`, `name`,`firstname`,`cp`,`town`, `email`,`phone`, `message`)
						VALUES (
						now(),
						'". addslashes($value['name']) ."',
						'". addslashes($value['firstname']) ."',
						'". addslashes($value['cp']) ."',
						'". addslashes($value['town']) ."',
						'". addslashes($value['email']) ."',
						'". addslashes($value['phone']) ."',
						'". addslashes($value['message']) ."'
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
	
	public function update($value){
		//print_r($value);
		//exit();
	    $value['datepicker']=date("Y-m-d H:i:s");
		 $this->dbConnect();
		$this->begin();
		try {
			($value['online']=='on') ? $online = 1 : $online = 0;
				
			$sql = "UPDATE  .`email` SET
					`date`='". $this->inserer_date($value['datepicker']) ."',
					`nom`='". addslashes($value['name']) ."',
					`email`='". addslashes($value['email']) ."',
					`message`='". addslashes($value['message']) ."',
					`online`=". $online ."
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
	
	public function delete($value){
		//print_r($value);
		//exit();
	
		$this->dbConnect();
		$this->begin();
		try {
			$sql = "DELETE FROM  .`email`
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
	
	
}