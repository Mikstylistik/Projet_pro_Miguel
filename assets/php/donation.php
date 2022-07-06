<?php
$con = mysqli_connect("localhost","root","","fedair");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Donation</title>
        <link rel="stylesheet" href="../css/donation.css">
        <?php
            if(isset($_POST['but_upload'])){
                $fileName = $_FILES['file']['name'];
                $target_dir = "#";
                if($fileName !=''){
                    $target_file = $target_dir.basename($_FILES['file']['name']);
                
                    // File extension
                    $extension = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                    // Valid file extension
                    $extensions_arr = array("jpg","jpeg","png","gif");

                    // Check extension
                    if(in_array($extension, $extensions_arr)){

                        // Convert to base64
                        $image_base64 = base64_encode(file_get_contents($_FILES['file']['tmp_name']));
                        $image = "data::image/".$extension.";base64,".$image_base64;

                        // Store image to 'upload' folder
                        if(move_uploaded_file($_FILES['file']['tmp_name'],$target_file)){

                            // Insert record
                            $query = "INSERT INTO donation(name, image)VALUES('".$fileName."','".$image."')";
                            mysqli_query($con, $query);
                            echo "Votre fichier a bien été envoyé";
                        }
                    }
                }
            }
        ?>
</head>
<body>
<header>
        <div class="navbar">
            <div id="bloc1">
                <div class="logo">
                    <a href="./accueil.php"><img src="../images/icons/Logo_FEDAIR.svg" alt="logo_FEDAIR" width="80px"></a>
                </div>
                <div class="search">
                    <input type="text"><img class="search_logo" src="../images/icons/search.svg" alt="search_logo" width="30px">
                </div>
                <div class="icons">
                    <a href="./assets/php/login.php"><img src="../images/icons/user.svg" alt="user" style="width: 30px;"></a>
                    <img src="../images/icons/shopping-cart.svg" alt="shopping">
                </div>
            </div>
            <div class="line_separation"></div>
            <div id="bloc2">

                <a href="./produits_test.php">Produits</a>
                <a href="./reconditionne.php">Reconditionnée</a>
                <a href="#">Donation</a>
                <a href="./contact.php">Contact</a>
            </div>
        </div>
    </header>
    <div class="container">
        <div class="container_slide">
            <div class="title_slide">
                <p>Donation</p>
                <div class="purple_block"></div>
                <p class="content_slide">Faites don de vos anciens produits, afin de leur donner une nouvelle vie.</p>
            </div>
            <div class="slide">
                <img class="picture_slide" src="../images/Donation_slide.jpg" alt="patreon_slide">
            </div>
        </div>
    </div>
    <div class="form_donation">
        <form method="POST" action="" enctype="multipart/form-data">
            <input type="file" name="file">
            <input type="submit" name="but_upload" value="upload">
        </form>
    </div>
    <div class="line_separation"></div>
    <footer>
            <div class="footer_content">
                <div class="content1">
                    <p>Recevoir la newsletter</p>
                    <input type="email" id="email" name="email" size="30">
                    <button class="newsletter_button">envoyer</button>
                </div>
                <div class="content">
                    <p class="title_content">AUDIO</p>
                        <ul>
                            <li>Casque</li>
                            <li>Ecouteurs</li>
                            <li>Enceinte</li>
                        </ul>
                </div>
                <div class="content">
                    <p class="title_content">INFOS</p>
                        <ul>
                            <li>Service après-vente</li>
                            <li>Livraison</li>
                            <li>Contact</li>
                        </ul>
                </div>
                <div class="content">
                    <p class="title_content">FEDAIR</p>
                        <ul>
                            <li>A propos</li>
                            <li>Partenaires</li>
                            <li>Recrutement</li>
                        </ul>
                </div>
                <div class="content3">
                        <img src="../images/icons/Facebook.svg" alt="facebook_logo" width="40px">
                        <img src="../images/icons/Twitter.svg" alt="twitter_logo" width="40px">
                        <img src="../images/icons/LinkedIn.svg" alt="linkedin_logo" width="40px">
                        <img src="../images/icons/Instagram.svg" alt="instagram_logo" width="40px">
                    <img class="content_pay" src="../images/Payment.jpg" alt="payment_picture" width="100%">
                </div>
            </div>
            <div class="mentions">
                <ul>
                    <li>Conditions générales</li>
                    <li>Responsabilité sociale</li>
                    <li>Accessibilité</li>
                    <li>Mentions légales</li>
                    <li>copyright inc.</li>
                </ul>
            </div>
        </footer>
</body>
</html>