<?php

require_once __DIR__.'/../inc/config.php';

// code de public/add.php

$lastName="";
$firstName="";
$birthDate="";
$email="";
$sympathie="";

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



    $lastName = strtoupper(trim(strip_tags($lastName)));
    echo $lastName;
    $firstName = ucfirst(trim(strip_tags($firstName)));
    echo $firstName;
    $birthDate = ucfirst(trim(strip_tags($birthDate)));
    echo $birthDate;
    $email = ucfirst(trim(strip_tags($email)));
    echo $email;
    $sympathie = ucfirst(trim(strip_tags($sympathie)));
    echo $sympathie;


    // Je prépare ma requête INSERT
    $sqlInsert = "
        INSERT INTO student (stu_lastname, stu_firstname, stu_birthdate, stu_email, stu_friendliness)
        VALUES ('{$lastName}','{$firstName}', '{$birthDate}', '{$email}', '{$sympathie}');
    ";
    echo $sqlInsert;

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
        echo $insertedRows.' ligne(s) insérées<br>';

    }
} // fin de la verification que le POST is not empty

// Je vais chercher la liste des sessions possibles
sqlSessions = "
    SELECT UNIQUE session.ses_number
    FROM session;
";

require_once __DIR__.'/../view/header.php';
require_once __DIR__.'/../view/add.php';
require_once __DIR__.'/../view/footer.php';
?>
