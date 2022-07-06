<?php
session_start();
if(isset($_POST['valider'])){
    if(!empty($_POST['pseudo']) AND !empty($_POST['mdp'])){
        $pseudo_par_defaut = "admin";
        $mdp_par_defaut = "admin1230";

        $pseudo_saisi = htmlspecialchars($_POST['pseudo']);
        $mdp_saisi = htmlspecialchars($_POST['mdp']);

        if($pseudo_saisi == $pseudo_par_defaut AND $mdp_saisi == $mdp_par_defaut){
            $_SESSION['mdp'] = $mdp_saisi;
            header('location:accueil_admin.php');
        }else{
            echo "Votre mot de passe ou pseudo est incorrect";
        }
    }else{
        echo "Veuillez remplir tous les champs...";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/connexion_admin.css">
    <title>Espace connexion admin</title>
</head>
<body>

    <div id="logo"><img src="../images/icons/Logo_FEDAIR.svg" alt="logo_fedair" width="120px"></div>
    <form  method="POST" action="">
        <input type="text" name="pseudo" placeholder="identifiant" autocomplete="off">
        <br>
        <input type="password" name="mdp" placeholder="mot de passe">
        <br><br>
        <input class="login_button" type="submit" name="valider" placeholder="connexion">
    </form>
</body>
</html>