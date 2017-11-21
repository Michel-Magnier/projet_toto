<?php

require_once __DIR__.'/../inc/config.php';

// code de public/resetpwd.php

$token = $_GET['token'];
$motDePasse="";
$motDePasse2="";
$messageErreur = "";

// Je verifie si je viens d'emplir le formulaire de signup
echo "Voici le POST :<br><pre>";
print_r($_POST);
echo "</pre>";

if (!empty($_POST)){

    if($motDePasse = isset($_POST['saisieMotDePasse'])){
		$motDePasse = $_POST['saisieMotDePasse'];
	}else{
		$motDePasse = '';
	}

    if($motDePasse2 = isset($_POST['saisieMotDePasse2'])){
		$motDePasse2 = $_POST['saisieMotDePasse2'];
	}else{
		$motDePasse2 = '';
	}

    $motDePasse = trim(strip_tags($motDePasse));
    $motDePasse2 = trim(strip_tags($motDePasse2));

    $formOk = true;

    // Je vérifie que les deux mots de passe saisis sont identiques
    if($motDePasse !== $motDePasse2){
        $messageErreur .= "<br>Les deux mots de passe sont differents.<br>";
        $formOk = false;
    }

    // Je vérifie que le mot de passe est assez long
    if(strlen($motDePasse) < 8 ){
        $messageErreur .= "<br>Le mot de passe est trop court.<br>";
        $formOk = false;
    }

    // J'encrypte le mot de passe
    // $motDePasseCrypte = md5($motDePasse);
    $motDePasseCrypte = password_hash($motDePasse, PASSWORD_BCRYPT);

    // Je prépare ma requête UPDATE PASSWORD
    $sqlUpdatePwd = "
        UPDATE user
        SET user.usr_password = ('{$motDePasseCrypte}'),
        user.usr_token = ''
        WHERE user.usr_token = '{$token}';
    ";
    echo "<br>Voici la requête pour l'UPDATE PASSWORD :<br>{$sqlUpdatePwd}<br>";

    if($formOk == true){
        // Je fais l'UPDATE PASSWORD
        $updatedRows = $pdo->exec($sqlUpdatePwd);
        if($updatedRows == false){
            print_r($pdo->errorInfo());
        }
        else{
            echo "Le nouveau mot de passe a bien été enregistré.";
            $messageErreur .= "<br>Le nouveau mot de passe a bien été enregistré.<br>";
            header("Location:signin.php");
        } // fin de vérification si le UPDATE PASSWORD s'est bien passé.
    } // fin de la verif sir la form est bien emplie
} // fin de la verification que le POST is not empty


require_once __DIR__.'/../view/header.php';
require_once __DIR__.'/../view/reset_password.php';
require_once __DIR__.'/../view/footer.php';
?>
