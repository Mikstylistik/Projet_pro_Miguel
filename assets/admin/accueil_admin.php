<?php
session_start();
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
    <link rel="stylesheet" href="../css/accueil_admin.css">
    <title>Accueil_admin</title>
</head>
<body>
    <header>
        <nav>
            <a href="#"><img src="../images/icons/Logo_FEDAIR.svg" alt="logo_FEDAIR" width="80px"></a>
            <a href="./deconnexion_admin.php"><img src="../images/icons/logout.svg" alt="logout" width="40px"></a>
        </nav>
    </header>
    <div class="content_admin">
        <a href="membres.php">Afficher tous les membres</a>
        <a href="produits.php">Afficher tous les produits</a>
        <a href="publier_produit.php">Publier un nouveau produit</a>
    </div>
    
</body>
</html>