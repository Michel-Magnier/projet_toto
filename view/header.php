
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>
        Projet Toto par Michel Magnier
    </title>
    <!-- <link rel="stylesheet" href="css/reset.css"> -->
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <ul class="navigation">
        <li class="navigation"><a class="navigation" href= "index.php">Home</a></li>
        <li class="navigation"><a class="navigation" href= "index.php">Toutes les sessions</a></li>
        <li class="navigation"><a class="navigation" href= "list.php?page=1">Tous les étudiants</a></li>
        <li class="navigation"><a class="navigation" href= "add.php">Ajout d'un étudiant</a></li>
        <li class="navigation"><a class="navigation" href= "signup.php">Sign Up</a></li>
        <li class="navigation"><a class="navigation" href= "signin.php">Sign In</a></li>
        <li class="navigation">
            <form action=list.php method="GET">
                <label>Recherche :</label>
                <input type="text" name="recherche" size="10" placeholder="Recherche" />
                <input type="submit" value="Rechercher" />
            </form>
        </li>
    </ul>
    <hr>
