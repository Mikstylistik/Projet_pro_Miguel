<?php
session_start();
  $bdd = new PDO('mysql:host=localhost;dbname=fedair;charset=utf8;', 'root', '');
  $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);


if(isset($_POST['inscription'])){
    if(!empty($_POST['identifiant']) AND !empty($_POST['pass'])){
        $identifiant = htmlspecialchars($_POST['identifiant']);
        $mdp = sha1($_POST['pass']);
        $insertUser = $bdd->prepare('INSERT INTO users(identifiant, pass)VALUES(?, ?)');
        $insertUser->execute(array($identifiant, $mdp));

        $recupUser = $bdd->prepare('SELECT * FROM users WHERE identifiant = ? AND pass = ?');
        $recupUser->execute(array($identifiant, $mdp));
        if($recupUser->rowCount() > 0){
          $_SESSION['identifiant'] = $identifiant;
          $_SESSION['pass'] = $mdp;
          $_SESSION['id'] = $recupUser->fetch()['id'];

        }

        echo $_SESSION['id'];

    }else{
        echo "Veuillez compléter tous les champs";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <title>Connexion</title>
</head>
<body>
    <div class="test"></div>
<div class="wrapper">
      <div class="title-text">
        <div class="title login">Connexion</div>
        <div class="title signup">Inscription</div>
      </div>
      <div class="form-container">
        <div class="slide-controls">
          <input type="radio" name="slide" id="login" checked>
          <input type="radio" name="slide" id="signup">
          <label for="login" class="slide login">Connexion</label>
          <label for="signup" class="slide signup">Inscription</label>
          <div class="slider-tab"></div>
        </div>
        <div class="form-inner">
          <form  action="#" class="login">
            <div class="field">
              <input type="text" placeholder="Identifiant" required>
            </div>
            <div class="field">
              <input type="password" placeholder="Mot de passe" required>
            </div>
            <div class="pass-link"><a href="#">Mot de passe oublié ?</a></div>
            <div class="field btn">
              <div class="btn-layer"></div>
              <input type="submit" value="Connexion">
            </div>
          </form>
          <form method="POST" action="" class="signup">
            <div class="field">
              <input type="text" name="identifiant" placeholder="Identifiant" autocomplete="off">
            </div>
            <div class="field">
              <input type="password" name="pass" placeholder="Mot de passe" autocomplete="off">
            </div>
            <div class="field">
              <input type="password" name="confirm" placeholder="Confirmer mot de passe" autocomplete="off">
            </div>
            <div class="field btn">
              <div class="btn-layer"></div>
              <input type="submit" name="inscription" value="Inscription">
            </div>
          </form>
        </div>
      </div>
    </div>
    <script src="../js/login.js"></script>
</body>
</html>