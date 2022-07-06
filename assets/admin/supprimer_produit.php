<?php
$bdd = new PDO('mysql:host=localhost;dbname=fedair;charset=utf8;', 'root', '');
if(isset($_GET['id']) AND !empty($_GET['id'])){
    $getId = $_GET['id'];
    $recupProduit = $bdd->prepare('SELECT * FROM produits WHERE id = ?');
    $recupProduit->execute(array($getId));
    if($recupProduit->rowCount() > 0){
        $deleteProduit = $bdd->prepare('DELETE FROM produits WHERE id = ?');
        $deleteProduit->execute(array($getId));
        header('location:produits.php');
        var_dump($deleteProduit);
    }else{
        echo "Aucun produit trouvé";
    }
    }else{
        echo "Aucun identifiant trouvé";
    }

?>