<?php
session_start();
$bdd = new PDO('mysql:host=localhost;dbname=fedair;charset=utf8;', 'root', '');
if(!$_SESSION['mdp']){
    header('location:connexion_admin.php');
}
    if(isset($_POST['envoyer'])){
        if(!empty($_POST['image']) AND !empty($_POST['marque']) AND !empty($_POST['nom']) AND !empty($_POST['categorie']) AND !empty($_POST['prix'])){
            $image = htmlspecialchars($_POST['image']);
            $marque = htmlspecialchars($_POST['marque']);
            $nom = htmlspecialchars($_POST['nom']);
            $categorie = htmlspecialchars($_POST['categorie']);
            $prix = htmlspecialchars($_POST['prix']);
            
            $insererProduit = $bdd->prepare('INSERT INTO `produits` (image, marque, nom, categorie, prix)VALUES(?, ?, ?, ?, ?)');
            $insererProduit->execute(array($image, $marque, $nom, $categorie, $prix));
            
            echo "Le produit a bien été ajouté";
        }else{
            echo "Veuillez compléter tous les champs !";
        }
        // var_dump($insererProduit);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau produit</title>
</head>
<body>
    <header>
        <nav>
            <a href="./accueil_admin.php"><img src="../images/icons/Logo_FEDAIR.svg" alt="logo_FEDAIR" width="80px"></a>
            <a href="./deconnexion_admin.php"><img src="../images/icons/logout.svg" alt="logout" width="40px"></a>
        </nav>
    </header>
    <form method="POST" action="">
        <input type="file" name="image">
        <!-- <button type="submit" name="uploadfile"> -->
        <br>
        <input type="text" name="marque" placeholder="marque">
        <br>
        <input type="text" name="nom" placeholder="modele">
        <br>
        <input type="text" name="categorie" placeholder="catégorie">
        <br>
        <input type="number" name="prix" placeholder="prix">
        <br>
        <input type="submit" name="envoyer">
    </form>
</body>
</html>