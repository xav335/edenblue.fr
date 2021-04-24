<?php include_once '../inc/inc.config.php';
include_once 'inc-auth-granted.php';

require 'classes/Email.php';
session_start();

//Security
if (!isset($_SESSION['accessGranted']) || !$_SESSION['accessGranted']) {
	$result = $storageManager->grantAccess($_POST['login'], $_POST['mdp']);
	if (!$result){
		header('Location: /admin/?action=error');
	} else {
		$_SESSION['accessGranted'] = true;
	}
}

//print_r($_POST);exit();
//Forms processing
if (!empty($_GET)) { // GET GET GET
		$email = new Email();
		if ($_GET['action'] == 'delete'){
			try {
				$result = $email->delete($_GET['id']);
				$result = null;
				header('Location: /admin/email-list.php');
			} catch (Exception $e) {
				echo 'Erreur contactez votre administrateur <br> :',  $e->getMessage(), "\n";
				$result = null;
				exit();
			}
		}
	
} else {
	header('Location: /admin/');
}

?>