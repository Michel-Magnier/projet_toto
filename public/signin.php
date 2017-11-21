<?php

require_once __DIR__.'/../inc/config.php';

// code de public/signin.php

$email="";
$motDePasse="";
$messageErreur = "";

// Je verifie si je viens d'emplir le formulaire de signin
echo "Voici le POST :<br><pre>";
print_r($_POST);
echo "</pre>";

if (!empty($_POST)){
	if($email = isset($_POST['saisieEmail'])){
		$email = $_POST['saisieEmail'];
	}else{
		$email = '';
	}

    if($motDePasse = isset($_POST['saisieMotDePasse'])){
		$motDePasse = $_POST['saisieMotDePasse'];
	}else{
		$motDePasse = '';
	}

    $email = strtolower(trim(strip_tags($email)));
    $motDePasse = trim(strip_tags($motDePasse));

    $formOk = true;

    // Je vérifie que l'adresse email est valide
    if(!(filter_var($email,FILTER_VALIDATE_EMAIL))){
        $messageErreur .= "<br>L'email {$email} n'est pas valide.<br>";
        $formOk = false;
    }

    // Je vais lire le mot de passe de cet user dans la table user ?
    $sqlSelect = "
        SELECT user.usr_id,
        user.usr_password,
		user.usr_role
        FROM user
        WHERE user.usr_email = '{$email}';
    ";
    echo "<br>Requête SELECT pour lire le mot de passe de cet user dans la table user<br>{$sqlSelect}<br>";
    $pdoStatement = $pdo->query($sqlSelect);
    if($pdoStatement === false){
        print_r($pdo->errorInfo());
    }
    // Récupération des résultats
    $resultatMotDePasse = $pdoStatement->fetch(PDO::FETCH_ASSOC);
    echo "Voici le résultat de la lecture du mot de passe dans la table user :<pre>";
    print_r($resultatMotDePasse);
    echo "</pre>";
    $id = $resultatMotDePasse['usr_id'];
	$role = $resultatMotDePasse['usr_role'];
    if(empty($resultatMotDePasse)){
        $messageErreur .= "<br>Il n'y a pas d'utilisateur avec cet email.<br>";
        $formOk = false;
    } // fin de la vérification s'il existe dans la table user un utilisateur avec cet email

    // je compare le mot de passe saisi avec le mot de passe de la table user
    if(password_verify($motDePasse, $resultatMotDePasse['usr_password'])){
        // Bon mot de passe.
        $messageErreur .= "<br>Bon mot de passe.<br>";
        $messageErreur .= "<br>Vous êtes maintenant loggé avec l'utilisateur {$id}<br>";
        $ip = getIP();
        $messageErreur .= "<br>votre adresse IP est {$ip}<br>";
		$_SESSION['id'] = $id;
		$_SESSION['ip'] = $ip;
		$_SESSION['role'] = $role;
    }else{
        // Mauvais mot de passe
        $messageErreur .= "<br>Mauvais mot de passe.<br>";
    } // fin de la verif si le mot de passe est bon
} // fin de la verification que le POST is not empty


require_once __DIR__.'/../view/header.php';
require_once __DIR__.'/../view/signin.php';
require_once __DIR__.'/../view/footer.php';
?>
