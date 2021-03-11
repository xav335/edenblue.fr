<?php require_once '../inc/inc.config.php';?>
<?php
require '../admin/classes/Contact.php';
require '../admin/classes/utils.php';
session_start();

$contact = new Contact();

error_log(date("Y-m-d H:i:s") ." : ". $_POST['action'] ."\n", 3, "../log/spy.log");
error_log(date("Y-m-d H:i:s") ." : ". $_POST['name'] ."\n", 3, "../log/spy.log");
error_log(date("Y-m-d H:i:s") ." : ". $_POST['firstname'] ."\n", 3, "../log/spy.log");
error_log(date("Y-m-d H:i:s") ." : ". $_POST['email'] ."\n", 3, "../log/spy.log");
error_log(date("Y-m-d H:i:s") ." : ". $_POST['tel'] ."\n", 3, "../log/spy.log");
error_log(date("Y-m-d H:i:s") ." : ". $_POST['sujet'] ."\n", 3, "../log/spy.log");
error_log(date("Y-m-d H:i:s") ." : ". $_POST['message'] ."\n", 3, "../log/spy.log");
error_log(date("Y-m-d H:i:s") ." : ". $_POST['newsletter'] ."\n", 3, "../log/spy.log");

if ($_POST[ "action" ] == "sendMail") {
	
	try {
	   $result1 = $contact->contactGetByEmail($_POST['email']);
	   //si l'email existe en base on y touche pas ...
	   //TODO: mettre à jour l'inscription a newsletter
    	if(empty($result1)){
    	      $_POST['fromcontact']='on';
    	      $contact->contactAdd($_POST);
    	      $contact = null;
    	}
		
		
	} catch (Exception $e) {
		error_log(date("Y-m-d H:i:s") ." Erreur: ". $e->getMessage() ."\n", 3, "../log/spy.log");
		$contact = null;
		exit();
	}

	//$_to = "fjavi.gonzalez@gmail.com";
	$_to = ( MAIL_TEST != '' )
    	? MAIL_TEST
    	: MAIL_CONTACT;
	$sujet = MAIL_NAME_CUSTOMER . " - Contact Site";
	//echo "Envoi du message à " . $_to . "<br>";
		
	$entete = "From:" . MAIL_NAME_CUSTOMER . " <" . MAIL_CUSTOMER . ">\n";
	$entete .= "MIME-version: 1.0\n";
	$entete .= "Content-type: text/html; charset= utf-8\n";
	$entete .= "Bcc: ". MAIL_BCC ."\n";
	$entete .= "Reply-to: " . $_POST[ "email" ] . "\n";		
	$corps = "";
	$corps .= "Bonjour,<br>";
	$corps .= "Sujet : " . utf8_decode( $_POST[ "sujet" ] ) ."<br>";
	$corps .= "Nv message de :<br>" . utf8_decode( $_POST[ "name" ] . " ". $_POST[ "firstname" ] )  . " (" . $_POST[ "email" ] . ")<br>";
	$corps .= "Tel : ". $_POST[ "tel" ] ."<br><br>";
	$corps .= "<b>Message :</b><br>";
	$corps .= utf8_decode( $_POST[ "message" ] ) . "<br><br>";
	$corps = utf8_encode( $corps );
	//echo $corps . "<br>";
		
	// Envoi des identifiants par mail
	mail($_to, $sujet, stripslashes($corps), $entete);
		
	error_log(date("Y-m-d H:i:s") ." : Message envoyé ! \n", 3, "../log/spy.log");
} else {
	error_log(date("Y-m-d H:i:s") ." : Message NON envoyé ! \n", 3, "../log/spy.log");
}
error_log(date("Y-m-d H:i:s") ." xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx  \n", 3, "../log/spy.log");
?>
