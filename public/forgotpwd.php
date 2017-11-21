<?php

require_once __DIR__.'/../inc/config.php';

// code de public/forgotpwd.php

$id="";
$email="";
$messageErreur = "";

// Je verifie si je viens d'emplir le formulaire de forgotpwd
echo "Voici le POST :<br><pre>";
print_r($_POST);
echo "</pre>";

if (!empty($_POST)){
	if($email = isset($_POST['saisieEmail'])){
		$email = $_POST['saisieEmail'];
	}else{
		$email = '';
	}

    $email = strtolower(trim(strip_tags($email)));

    $formOk = true;

    // Je vérifie que l'adresse email est valide
    if(!(filter_var($email,FILTER_VALIDATE_EMAIL))){
        $messageErreur .= "<br>L'email {$email} n'est pas valide.<br>";
        $formOk = false;
    }

    // Je vais lire l'ID de cet user dans la table user
    $sqlSelect = "
        SELECT user.usr_id
        FROM user
        WHERE user.usr_email = '{$email}';
    ";
    echo "<br>Requête SELECT pour lire l'ID de cet user dans la table user<br>{$sqlSelect}<br>";
    $pdoStatement = $pdo->query($sqlSelect);
    if($pdoStatement === false){
        print_r($pdo->errorInfo());
    }
    // Récupération des résultats
    $resultatID = $pdoStatement->fetch(PDO::FETCH_ASSOC);
    echo "Voici le résultat de la lecture de l'ID dans la table user :<pre>";
    print_r($resultatID);
    echo "</pre>";
    $id = $resultatID['usr_id'];
    if(empty($resultatID)){
        $messageErreur .= "<br>Il n'y a pas d'utilisateur avec cet email.<br>";
        $formOk = false;
    } // fin de la vérification s'il existe dans la table user un utilisateur avec cet email

    if ($formOk){
        // remplir par un md5() aléatoire le champ "token" de ce user
        $token = md5(microtime());
		$sqlUpdateToken = "
			UPDATE user
			SET user.usr_token = '{$token}'
			WHERE user.usr_id = {$id};
		";

		echo "<br>Voici la requête pour UPDATE TOKEN :<br>{$sqlUpdateToken}";
		$updatedRows = $pdo->exec($sqlUpdateToken);
        if($updatedRows == false){
            print_r($pdo->errorInfo());
        }
        else{
            echo "Le token {$token} a bien été mis à jour pour le user {$id}.";
            $messageErreur .= "<br>Le token {$token} a bien été mis à jour pour le user {$id}.<br>";
			$messageErreur .= "Un email a été envoyé à l'adresse indiquée.<br>Suivez le lien dans l'email pour obtenir un nouveau mot de passe !";
			$linkResetPwd = "http://projet-toto.dev/reset_password.php?token={$token}";
			echo "<br>Voici le lien à envoyer par email à l'utilisateur pour reset password :<br>{$linkResetPwd}";
			// SEND EMAIL
			$to = $email;
			$subject = "Vous avez demandé un nouveau mot de passe pour Projet Toto";
			$htmlContent = "Suivez ce lien pour pouvoir définir un nouveau mot de passe :<br>{$linkResetPwd}";
			$textContent = "Suivez ce lien pour pouvoir définir un nouveau mot de passe :\n{$linkResetPwd}";
			sendEmail($to, $subject, $htmlContent, $textContent='');
		} // fin de la vérification si l'UPDATE TOKEN s'est bien passé
    } // Fin de vérification si l'email saisi est valide et existe dans la table user
} // fin de la verification que le POST is not empty


require_once __DIR__.'/../view/header.php';
require_once __DIR__.'/../view/forgotpwd.php';
require_once __DIR__.'/../view/footer.php';
?>
