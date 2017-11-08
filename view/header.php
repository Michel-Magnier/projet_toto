
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
        <li class="navigation" id="nav_home"><a class="navigation" href= "index.php">Home</a></li>
        <li class="navigation" id="nav_index"><a class="navigation" href= "index.php">Toutes les sessions</a></li>
        <?php if(isset($_SESSION['id'])) : ?>
            <?php if (($_SESSION['role'] == 'user') || ($_SESSION['role'] == 'admin')) : ?>
                <li class="navigation" id="nav_list"><a class="navigation" href= "list.php?page=1">Tous les étudiants</a></li>
            <?php endif; ?>
        <?php endif; ?>
        <?php if(isset($_SESSION['id'])) : ?>
            <?php if ($_SESSION['role'] == 'admin') : ?>
                <li class="navigation" id="nav_add"><a class="navigation" href= "add.php">Ajout d'un étudiant</a></li>
            <?php endif; ?>
        <?php endif; ?>
        <?php if(!isset($_SESSION['id'])) : ?>
            <li class="navigation" id="nav_signup"><a class="navigation" href= "signup.php">Sign Up</a></li>
            <li class="navigation" id="nav_signin"><a class="navigation" href= "signin.php">Sign In</a></li>
        <?php else : ?>
            <li class="navigation" id="nav_disconnect"><a class="navigation" href= "disconnect.php">Déconnexion</a></li>
        <?php endif; ?>
        <li class="navigation" id="nav_recherche">
            <form action=list.php method="GET">
                <label>Recherche :</label>
                <input type="text" name="recherche" size="10" placeholder="Recherche" />
                <input type="submit" value="Rechercher" />
            </form>
        </li>
        <?php
        if(isset($_SESSION['id'])){
            echo "Bonjour, {$_SESSION['role']} {$_SESSION['id']}.";
        }
        ?>
    </ul>
    <hr>
