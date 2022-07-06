<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=fedair;charset=utf8;', 'root', '');
if(!$_SESSION['mdp']){
    header('location:connexion_admin.php');

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/membres.css">
    <title>Afficher les membres</title>
</head>
    <header>
        <nav>
            <a href="./accueil_admin.php"><img src="../images/icons/Logo_FEDAIR.svg" alt="logo_FEDAIR" width="80px"></a>
            <a href="./deconnexion_admin.php"><img src="../images/icons/logout.svg" alt="logout" width="40px"></a>
        </nav>
    </header>
<body>
    <!-- Afficher tous les membres -->
    <?php
        $recupUsers = $bdd->query('SELECT * FROM users');
        while($user = $recupUsers->fetch()){
            ?>
            <p><?= $user['identifiant']; ?><a href="bannir.php?id=<?= $user['id']; ?>" style="color:red; text-decoration:none">  Bannir le membre</a></p>
            <?php
        }
    ?>
    <!-- Fin afficher tous les membres -->
</body>
</html>