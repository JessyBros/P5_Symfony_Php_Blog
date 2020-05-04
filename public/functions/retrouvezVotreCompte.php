<?php

if (isset($_POST["submit"])) {
	$email  = isset($_POST['email']) ? $_POST['email'] : NULL;
	$verificationEmail = $verificationEmailManager -> verificationEmail($email);
		if ($verificationEmail){
			$id =$verificationEmail['id'];
			recupererCompteMail($email,$id);
			$messageServeur = '<p id="messageServeurTrue">Le mail a bien été envoyé </p>';
	} else {
		$messageServeur= '<p id="messageServeur">L\'Email n\'existe pas !</p>';
	}
} else {
	$messageServeur = "";
}	
