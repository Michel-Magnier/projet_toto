<?php
require_once __DIR__.'/../inc/config.php';
echo "<pre>";

if(!empty($_POST)){ // si le formulaire a été soumis
	// Je veux regarder le contenu des données envoyées par le formulaire
	print_r($_POST);
	switch ($_POST['submitFile']){
			case "import" :
				echo "<br>";
				// Pour les fichiers --> $_FILES
				print_r($_FILES);
				// si des fichiers ont été envoyés
				if(!empty($_FILES)){
					// Je récupère les infos sur le fichier envoyé, je mets dans mon array $fileForm
					$fileForm = isset($_FILES['fileForm']) ? $_FILES['fileForm'] : array();

					// Validation du fichier
					$formOk = true;
					$allowedExtensions = array('csv');

					// taille du fichier à uploader
					$fileSize = $_FILES['fileForm']['size'];
					echo "<br>Le fichier à uploader a une taille de {$fileSize} octets.<br>";
					if($fileSize > 102400){
						echo "<br>Le fichier à uploader est trop gros, il fait {$fileSize} octets mais le maximum autorisé à l'upload est 100 Ko.<br>";
						$formOk = false;
					}


					// seul type MIME autorisé => PDF
					if (!($fileForm['type']= 'application/csv' OR $fileForm['type']= 'application/csv' )){
						echo "<br>Le fichier choisi n'est pas de type CSV<br>";
						$formOk = false;
					}

					$dotPosition = strrpos($fileForm['name'],'.'); // récupère la position du dernier . dans la string
					$extension = substr($fileForm['name'],$dotPosition+1); // récupère une sous-chaîne de la châine de caractères

					// Je vérifie que l'extension du fichier uploadé est bien une des extensions permises
					if(!in_array($extension,$allowedExtensions)){
						echo "<br>Extension incorrecte</br>";
						$formOk = false;
					}

					if($formOk){
						// On définit un nouveau nom pour le fichier destination, pour encore plus de sécurité
						$newFileName = md5(uniqid().'*-+projet-toto-wf3'.'.'.$extension);
						// Si on a réussi à déplacer le fichier tmp vers sa destination finale avec son nom final
						if(move_uploaded_file($fileForm['tmp_name'], __DIR__.'/csv/'.$newFileName.'.csv')){
							echo "<br>uploaded OK<br>";
							$completeFileName = __DIR__.'\csv\\'.$newFileName.'.csv';
							echo "<br>Je vais ouvrir le fichier $completeFileName <br>";
							$filePointer = fopen($completeFileName, 'r');
							print_r ($filePointer);
							while (!feof($filePointer)){
								$line = fgets($filePointer);
								echo "<br>{$line}<br>";
								$lineArray[] = explode(';',$line);
							}
							print_r($lineArray);

							foreach ($lineArray as $key => $value) {

								$lastName = strtoupper(trim(strip_tags($lineArray[$key][0])));
							    $firstName = ucfirst(trim(strip_tags($lineArray[$key][1])));
							    $birthDate = ucfirst(trim(strip_tags($lineArray[$key][4])));
							    $email = ucfirst(trim(strip_tags($lineArray[$key][2])));
							    $sympathie = ucfirst(trim(strip_tags($lineArray[$key][3])));
							    $session = 1;
							    $ville = 4;

							    // Je prépare ma requête INSERT
							    $sqlInsert = "
							        INSERT INTO student (stu_lastname, stu_firstname, stu_birthdate, stu_email, stu_friendliness, session_ses_id, city_cit_id)
							        VALUES (:lastName,:firstName, :birthDate, :email, :sympathie, :session, :ville);
							    ";
								echo "<br>La requête d'insertion est : <br>{$sqlInsert}";

							    // Je prépare l'INSERT
							    $insertedRows = $pdo->prepare($sqlInsert);

								$insertedRows->bindValue(':lastName', $lastName);
								$insertedRows->bindValue(':firstName', $firstName);
								$insertedRows->bindValue(':birthDate', $birthDate);
								$insertedRows->bindValue(':email', $email);
								$insertedRows->bindValue(':sympathie', $sympathie);
								$insertedRows->bindValue(':session', $session);
								$insertedRows->bindValue(':ville', $ville);

								// J'insère pour de vrai
								$insertedRows->execute();

							    if($insertedRows == false){
							        print_r($pdo->errorInfo());
							    }
							    else{
							        // Je récupère l'ID de la ligne insérée.
							        $lastId = $pdo->lastInsertId();
							        var_dump($lastId);
							    } // fin de vérification si le INSERT s'est bien passé.
							} // fin du foreach lisant le tableau pour faire l'INSERT
							fclose($filePointer);
						}else{
							echo "<br>uploaded NOK<br>";
						} // fin du if move OK
					} // fin du if formOk=true
				} // fin du if files were uploaded
				break; // fin du case import
			case "export" :
				echo "<br>Je suis dans le case export<br>";
				// Je prépare ma requête
				$selectStudents = "
					SELECT student.stu_lastname,
					student.stu_firstname,
					student.stu_email,
					student.stu_friendliness,
					student.stu_birthdate
					FROM student
				";
				echo "<br>La requête du SELECT student est :<br>$selectStudents";

				// Je récupère le résultat du SELECT dans un tableau

				$pdoStatement = $pdo->query($selectStudents);
				if($pdoStatement === false){
				    print_r($pdo->errorInfo());
				}
				// Récupération des résultats de la requête SELECT dans un tableau
				$resultatStudents = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
				print_r($resultatStudents);

				$fileFullName = "C:\\xampp\htdocs\projet_toto\public\csv\\export-20171106.csv";

				// Je vérifie si le fichier existe déjà
				if(file_exists($fileFullName)){
					// Je supprime le fichier existant
					unlink($fileFullName);
				} // fin de vérification si le fichier export existe déjà


				// J'ouvre un fichier export en écriture
				$filePointer = fopen($fileFullName, 'w'); // J'ouvre le fichier en écriture, le fichier est créé si absent.
				print_r ($filePointer);

				// Je parse le tableau et je crée des lignes CSV
				$nbreStudents = count($resultatStudents);
				echo "<br>Il y a {$nbreStudents} étudiants dans mon tableau<br>";
				$currentStudent = 1;
				foreach ($resultatStudents as $key => $value) {
					$line = implode($resultatStudents[$key],';');
					if($currentStudent !== $nbreStudents){
						$line.= PHP_EOL; // Ajouter une End Of Line si je ne suis pas au dernier étudiant
					} // fin de la vérification si je suis sur le dernier étudiant
					echo "<br>{$line}<br>";
					fwrite($filePointer,$line);
					$currentStudent++;
				} // fin du foreach parsant le tableau pour l'INSERT

				fclose($filePointer); // Je ferme mon fichier en écriture
				break; // fin du case export
	} // fin du switch pour savoir si je suis en import ou export
} // fin du if $_POST contient quelque chose

echo "</pre>";

require_once __DIR__.'/../view/header.php';
require_once __DIR__.'/../view/fileTransfert.php';
require_once __DIR__.'/../view/footer.php';

?>
