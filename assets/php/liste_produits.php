<?php
function getAdmin($email, $password){
    if(require("connect.php")){
        $recup = $access->prepare("SELECT * FROM admin WHERE email = ? AND mdp = ?");
        $recup->execute(array($email, $password));{
            if($recup->rowCount() == 1){
                $data = $recup->fetch();
                return $data;
    }else{
        return false;
        }
        $recup->closeCursor();
        }
    }
}

function add($image, $marque, $nom, $catégorie, $prix){
    if(require('connect.php')){
        $recup = $bdd->prepare('INSERT INTO produits (image, marque, nom, catégorie, prix) VALUES ($image, $marque, $nom, $catégorie, $prix)');
        $recup->execute(array($image, $marque, $nom, $catégorie, $prix));

        $recup->closeCursor();
    }
}

function display(){
    if(require('connect.php')){
        $recup = $bdd->prepare('SELECT * FROM produits ORDER BY id DESC');
        $recup->execute();
        $data = $recup->fetchAll(PDO::FETCH_OBJ);
        return $data;
        
        $recup->closeCursor();
    }
}

function delete($id){
    if(require('connect.php')){
        $recup = $bdd->prepare('DELETE * FROM produits WHERE id=?');
        $recup->execute(array($id));
    }
}
?>