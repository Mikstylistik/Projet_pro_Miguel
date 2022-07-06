<?php
$bdd = new PDO('mysql:host=localhost;dbname=fedair;charset=utf8;', 'root', '');
if(isset($_GET['id']) AND !empty($_GET['id'])){
    $getId = $_GET['id'];
    $recupProduit =$bdd->prepare('SELECT * FROM produits WHERE id = ?');
    $recupProduit->execute(array($getId));
    if($recupProduit->rowCount() > 0){
        $produitInfos = $recupProduit->fetch();
        // $image = $produitInfos['image'];
        $marque = $produitInfos['marque'];
        $nom = $produitInfos['nom'];
        $categorie = $produitInfos['categorie'];
        $prix = $produitInfos['prix'];


        if(isset($_POST['modifier'])){
            // $image_upload = htmlspecialchars($_POST['image']);
            $marque_saisie = htmlspecialchars($_POST['marque']);
            $nom_saisi = htmlspecialchars($_POST['nom']);
            $categorie_saisie = htmlspecialchars($_POST['categorie']);
            $prix_saisi = htmlspecialchars($_POST['prix']);
    
            $updateProduit = $bdd->prepare('UPDATE produits SET marque = ?, nom = ?, categorie = ?, prix = ? WHERE id = ?');
            $updateProduit->execute(array($marque_saisie, $nom_saisi, $categorie_saisie, $prix_saisi, $getId));
            header('location:produits.php');
        }
    }else{
        echo "Aucun produit trouvé";
    }
}else{
    echo "Aucun identifiant trouvé";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/modifier_produit.css">
    <title>Modifier produit</title>
</head>
<body>
    <header>
        <nav>
            <a href="./accueil_admin.php"><img src="../images/icons/Logo_FEDAIR.svg" alt="logo_FEDAIR" width="80px"></a>
            <a href="./deconnexion_admin.php"><img src="../images/icons/logout.svg" alt="logout" width="40px"></a>
        </nav>
    </header>
    <form method="POST" action="">
            <!-- <input type="file" name="image" value="<?= $image; ?>"> -->
            <!-- <button type="submit" name="uploadfile"> -->
            <br>
            <input type="text" name="marque" value="<?= $marque; ?>">
            <br>
            <input type="text" name="nom" value="<?= $nom; ?>">
            <br>
            <input type="text" name="categorie" value="<?= $categorie; ?>">
            <br>
            <input type="number" name="prix" value="<?= $prix; ?>">
            <br><br>
            <button type="submit" name="modifier">Modifier</button>
    </form>
</body>
</html>