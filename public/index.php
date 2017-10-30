<?php
require_once __DIR__.'/../inc/config.php';

// code de public/index.php

// Je recupére la liste des trainings
$selectTrainings="
    SELECT training.tra_name,
        session.ses_id,
        session.ses_number,
        session.ses_start_date,
        session.ses_end_date
    FROM session
    INNER JOIN training ON session.training_tra_id = training.tra_id
    ORDER BY training.tra_name, session.ses_number ASC;
";
echo "<br>Voici la requête selectTrainings : {$selectTrainings}<br>";
$pdoStatement = $pdo->query($selectTrainings);
if($pdoStatement === false){
    print_r($pdo->errorInfo());
}
// Récupération des résultats
$resultatTrainings = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);


// construction du tableau de tableaux
foreach ($resultatTrainings as $value) {
    $tableauFinal[$value['tra_name']][$value['ses_id']]['ses_number'] = $value['ses_number'];
    $tableauFinal[$value['tra_name']][$value['ses_id']]['ses_start_date'] = $value['ses_start_date'];
    $tableauFinal[$value['tra_name']][$value['ses_id']]['ses_end_date'] = $value['ses_end_date'];
}

echo "<pre>";
echo "Voici tableauFinal :";
print_r($tableauFinal);
echo "</pre>";

require_once __DIR__.'/../view/header.php';
require_once __DIR__.'/../view/home.php';
require_once __DIR__.'/../view/footer.php';

?>
