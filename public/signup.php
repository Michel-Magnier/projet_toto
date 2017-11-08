<?php

require_once __DIR__.'/../inc/config.php';

// code de public/signup.php

$email="";
$motDePasse="";
$motDePasse2="";
$messageErreur = "";

// Je verifie si je viens d'emplir le formulaire de signup
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

        if($motDePasse2 = isset($_POST['saisieMotDePasse2'])){
    		$motDePasse2 = $_POST['saisieMotDePasse2'];
    	}else{
    		$motDePasse2 = '';
    	}


    $email = strtolower(trim(strip_tags($email)));
    $motDePasse = trim(strip_tags($motDePasse));
    $motDePasse2 = trim(strip_tags($motDePasse2));

    $formOk = true;

    // Je vérifie que l'adresse email est valide
    if(!(filter_var($email,FILTER_VALIDATE_EMAIL))){
        $messageErreur .= "<br>L'email {$email} n'est pas valide.<br>";
        $formOk = false;
    }

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

    // Je prépare ma requête INSERT
    $sqlInsert = "
        INSERT INTO user (usr_email, usr_password, usr_role)
        VALUES ('{$email}','{$motDePasseCrypte}','user');
    ";
    echo "<br>Voici la requête pour l'INSERT :<br>{$sqlInsert}<br>";

    // L'email saisi existe-t-il déjà dans la table user ?
    $sqlSelect = "
        SELECT user.usr_email
        FROM user
        WHERE user.usr_email = '{$email}';
    ";
    echo "<br>Requête SELECT pour voir si l'email existe déjà dans la table user<br>{$sqlSelect}<br>";
    $pdoStatement = $pdo->query($sqlSelect);
    if($pdoStatement === false){
        print_r($pdo->errorInfo());
    }
    // Récupération des résultats
    $resultatUniciteEmail = $pdoStatement->fetch(PDO::FETCH_ASSOC);
    echo "Voici le résultat de la verification de l'unicité de l'email :<pre>";
    print_r($resultatUniciteEmail);
    echo "</pre>";
    if(!empty($resultatUniciteEmail)){
        $messageErreur .= "<br>Cet email est déjà utilisé.<br>";
        $formOk = false;
    } // fin de la vérification si l'email existe déjà


    if($formOk == true){
        // Je fais l'INSERT
        $insertedRows = $pdo->exec($sqlInsert);
        if($insertedRows == false){
            print_r($pdo->errorInfo());
        }
        else{
            // Je récupère l'ID de la ligne insérée.
            $lastId = $pdo->lastInsertId();
            var_dump($lastId);
            echo "Le nouvel user a bien été créé.";
            $messageErreur .= "<br>Le nouvel user a bien été créé.<br>";
        } // fin de vérification si le INSERT s'est bien passé.
    } // fin de la verif sir la form est bien emplie
} // fin de la verification que le POST is not empty


require_once __DIR__.'/../view/header.php';
require_once __DIR__.'/../view/signup.php';
require_once __DIR__.'/../view/footer.php';
?>
