<?php

require_once __DIR__.'/../inc/config.php';

// Verification autorisation
if ($_SESSION['role'] !== 'admin'){
    header("Location: forbidden.php");
} // fin de la verification de l'autorisation

// code de public/add.php

$lastName="";
$firstName="";
$birthDate="";
$email="";
$sympathie="";
$session="";
$ville="";

// Je verifie si je viens d'emplir le formulaire d'ajout d'étudiant
if (!empty($_POST)){
    	if($lastName = isset($_POST['saisieNom'])){
    		$lastName = $_POST['saisieNom'];
    	}else{
    		$lastName = '';
    	}

    	if($firstName = isset($_POST['saisiePrenom'])){
    		$firstName = $_POST['saisiePrenom'];
    	}else{
    		$firstName = '';
    	}

        if($birthDate = isset($_POST['saisieNaissance'])){
    		$birthDate = $_POST['saisieNaissance'];
    	}else{
    		$birthDate = '';
    	}

        if($email = isset($_POST['saisieEmail'])){
    		$email = $_POST['saisieEmail'];
    	}else{
    		$email = '';
    	}

        if($sympathie = isset($_POST['saisieSympathie'])){
    		$sympathie = $_POST['saisieSympathie'];
    	}else{
    		$sympathie = '';
    	}

        if($session = isset($_POST['saisieSession'])){
            $session = $_POST['saisieSession'];
        }else{
            $session = '';
        }
        if($ville = isset($_POST['saisieVille'])){
            $ville = $_POST['saisieVille'];
        }else{
            $ville = '';
        }


    $lastName = strtoupper(trim(strip_tags($lastName)));
    $firstName = ucfirst(trim(strip_tags($firstName)));
    $birthDate = ucfirst(trim(strip_tags($birthDate)));
    $email = ucfirst(trim(strip_tags($email)));
    $sympathie = ucfirst(trim(strip_tags($sympathie)));
    $session = ucfirst(trim(strip_tags($session)));
    $ville = ucfirst(trim(strip_tags($ville)));


    // Je prépare ma requête INSERT
    $sqlInsert = "
        INSERT INTO student (stu_lastname, stu_firstname, stu_birthdate, stu_email, stu_friendliness, session_ses_id, city_cit_id)
        VALUES ('{$lastName}','{$firstName}', '{$birthDate}', '{$email}', {$sympathie}, {$session}, {$ville});
    ";

    // Je fais l'INSERT
    $insertedRows = $pdo->exec($sqlInsert);
    if($insertedRows == false){
        print_r($pdo->errorInfo());
    }
    else{
        // Je récupère l'ID de la ligne insérée.
        $lastId = $pdo->lastInsertId();
        var_dump($lastId);
        echo "<script type='text/javascript'>location.href = 'student.php?student={$lastId}';</script>";
    } // fin de vérification si le INSERT s'est bien passé.
} // fin de la verification que le POST is not empty

// Je vais chercher la liste des sessions possibles
$sqlSessions = "
    SELECT DISTINCT session.ses_number
    FROM session
    ORDER BY session.ses_number ASC;
";
$pdoStatement = $pdo->query($sqlSessions);
if($pdoStatement === false){
    print_r($pdo->errorInfo());
}
// Récupération des résultats des sessions existantes
$resultatSessions = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);

// Je vais chercher la liste des noms de villes
$sqlVilles = "
    SELECT DISTINCT city.cit_id, city.cit_name
    FROM city
    ORDER BY city.cit_name ASC;
";
$pdoStatement = $pdo->query($sqlVilles);
if($pdoStatement === false){
    print_r($pdo->errorInfo());
}
// Récupération des résultats des noms de villes
$resultatVilles = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);

require_once __DIR__.'/../view/header.php';
require_once __DIR__.'/../view/add.php';
require_once __DIR__.'/../view/footer.php';
?>
