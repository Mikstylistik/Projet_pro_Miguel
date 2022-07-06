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
    <link rel="stylesheet" href="../css/produits_admin.css">
    <title>Afficher les produits</title>
</head>
<body>
    <header>
        <nav>
            <a href="./accueil_admin.php"><img src="../images/icons/Logo_FEDAIR.svg" alt="logo_FEDAIR" width="80px"></a>
            <a href="./deconnexion_admin.php"><img src="../images/icons/logout.svg" alt="logout" width="40px"></a>
        </nav>
    </header>
    <!-- Afficher tous les produits -->
    <?php
        $recupProduit = $bdd->query('SELECT * FROM produits');
        while($produit = $recupProduit->fetch()){
            ?>
            <div class="content_product">
                <div style="border: 1px solid #000000;">
                <img src="<?= $produit['image']; ?>" alt="logo" width="150px">
                
                    <p><?= $produit['marque']; ?></p>
                    <p><?= $produit['nom']; ?></p>
                    <p><?= $produit['categorie']; ?></p>
                    <p><?= $produit['prix']; ?> €</p>
                    <a href="supprimer_produit.php?id=<?= $produit['id'];?>"><button style="color: white; background-color: red; margin-bottom: 10px;">Supprimer produit</button></a>
                    <a href="modifier_produit.php?id=<?= $produit['id'];?>"><button style="color: white; background-color: blue; margin-bottom: 10px;">Modifier produit</button></a>
                </div>

            </div>
                <br>
            <?php
        }
    ?>
    <!-- Fin afficher tous les produits -->
</body>
</html>