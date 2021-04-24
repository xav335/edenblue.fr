<?php require_once '../inc/inc.config.php';?>
<?php
require '../admin/classes/Contact.php';
require '../admin/classes/Email.php';
require '../admin/classes/utils.php';
session_start();

$contact = new Contact();
$email = new Email();

error_log(date("Y-m-d H:i:s") ." xxxxxxxxxxx  ". $_SERVER["SCRIPT_FILENAME"] ."  xxxxxxxxxxx  \n", 3, "../log/spy.log");
error_log(date("Y-m-d H:i:s") ." : ". $_POST['action'] ."\n", 3, "../log/spy.log");
error_log(date("Y-m-d H:i:s") ." : ". $_POST['from'] ."\n", 3, "../log/spy.log");
error_log(date("Y-m-d H:i:s") ." : ". $_POST['name'] ."\n", 3, "../log/spy.log");
error_log(date("Y-m-d H:i:s") ." : ". $_POST['firstname'] ."\n", 3, "../log/spy.log");
error_log(date("Y-m-d H:i:s") ." : ". $_POST['email'] ."\n", 3, "../log/spy.log");
error_log(date("Y-m-d H:i:s") ." : ". $_POST['cp'] ."\n", 3, "../log/spy.log");
error_log(date("Y-m-d H:i:s") ." : ". $_POST['town'] ."\n", 3, "../log/spy.log");
error_log(date("Y-m-d H:i:s") ." : ". $_POST['phone'] ."\n", 3, "../log/spy.log");
error_log(date("Y-m-d H:i:s") ." : ". $_POST['message'] ."\n", 3, "../log/spy.log");

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
	
	try {
	    if (!empty($_POST)){
	       $email->add($_POST);
	    }   
	    
	} catch (Exception $e) {
	    error_log(date("Y-m-d H:i:s") ." Erreur: ". $e->getMessage() ."\n", 3, "../log/spy.log");
	    $email = null;
	    exit();
	}

	try {
        $entete = "From:" . $_POST[ "name" ] . " <" . $_POST[ "email" ] . ">\n";
        $entete .= "MIME-version: 1.0\n";
        $entete .= "Content-type: text/html; charset= iso-8859-1\n";
        $entete .= "Bcc:" . MAIL_BCC . "\n";
        //echo "Entete :<br>" . $entete . "<br><br>";
        
        $sujet = utf8_decode( "Prise de contact de l'".$_POST['from'] );
        
        //$_to = "franck_langleron@hotmail.com";
            $_to = ( MAIL_TEST != '' )
            ? MAIL_TEST
            : MAIL_CUSTOMER;
        //echo "Envoi du message à : " . $_to . "<br><br>";
        
        $message = "Bonjour,<br><br>";
        $message .= "La personne suivante a rempli le formulaire de contact :<br>";
        $message .= "Nom : <b>" . $_POST[ "name" ] . " " . $_POST[ "firstname" ] . "</b><br>";
        $message .= "E-mail / Téléphone : <b>" . $_POST[ "email" ] . " / " . $_POST[ "phone" ] . "</b><br>";
        $message .= "Adresse : <b>" . $_POST[ "cp" ] . " " . $_POST[ "town" ] . "</b><br>";
        $message .= "Message : <br><i>" . nl2br( $_POST[ "message" ] ) . "</i><br><br>";
        $message .= "Cordialement.";
        $message = utf8_decode( $message );
     
        error_log(date("Y-m-d H:i:s") ." : ". $message ."\n", 3, "../log/spy.log");
        
        $retour = mail( $_to, $sujet, stripslashes( $message ), $entete );
        
        
    } catch (Exception $e) {
        error_log(date("Y-m-d H:i:s") ." Erreur Envoi mail: ". $e->getMessage() ."\n", 3, "../log/spy.log");
        $email = null;
        exit();
    }    
        		
	error_log(date("Y-m-d H:i:s") ." : Message envoyé ! \n", 3, "../log/spy.log");
} else {
	error_log(date("Y-m-d H:i:s") ." : Message NON envoyé ! \n", 3, "../log/spy.log");
}
error_log(date("Y-m-d H:i:s") ." xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx  \n", 3, "../log/spy.log");
?>
