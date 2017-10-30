<br><br>
<h3>
    <?= $resultatStudent['stu_lastname'].' '.$resultatStudent['stu_firstname'] ; ?>
</h3>
<ul>
<li>
    ID : <?= $resultatStudent['stu_id'] ; ?>
</li>
<li>
    Nom : <?= $resultatStudent['stu_lastname'] ; ?>
</li>
<li>
    Prénom : <?= $resultatStudent['stu_firstname'] ; ?>
</li>
<li>
    Email : <?= $resultatStudent['stu_email'] ; ?>
</li>
<li>
    Date de naissance : <?= $resultatStudent['stu_birthdate'] ; ?>
</li>
<li>
    <?php
    $dateOfBirth = "{$resultatStudent['stu_birthdate']}";
    $today = date("Y-m-d");
    $diff = date_diff(date_create($dateOfBirth), date_create($today));
    ?>
    Âge : <?= $diff->format('%y') ; ?>
</li>
<li>
    Ville : <?= $resultatStudent['cit_name'] ; ?>
</li>
<li>
    Sympathie : <?= $resultatStudent['stu_friendliness'] ; ?>
</li>
<li>
    Numéro de session : <?= $resultatStudent['ses_number'] ; ?>
</li>
<li>
    Nom de session : <?= $resultatStudent['tra_name'] ; ?>
</li>
</ul>
