<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produits</title>
    <link rel="stylesheet" href="../css/produits_test.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"> -->
</head>
<body>
<header>
        <div class="navbar">
            <div id="bloc1">
                <div class="logo">
                <a href="accueil.php"><img src="../images/icons/Logo_FEDAIR.svg" alt="logo_FEDAIR" width="80px"></a>
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
                <a href="#">Produits</a>
                <a href="./reconditionne.php">Reconditionnée</a>
                <a href="./donation.php">Donation</a>
                <a href="./contact.php">Contact</a>
            </div>
        </div>
    </header>
    <div class="container">
        <div class="container_slide">
            <div class="title_slide">
                <p>Produits</p>
                <div class="purple_block"></div>
                <p class="content_slide">Découvrez nos offres sur nos meilleurs modèles </p>
            </div>
            <div class="slide">
                <img class="picture_slide" src="../images/Produits_slide.jpg" alt="headphones_slide">
            </div>
        </div>
        <div class="row">
            <!-- Brand List  -->
            <div class="col-md-3">
                <form action="" method="GET">
                    <div class="card shadow mt-3">
                        <div class="card-header">
                            <h5>FILTRE</h5>
                                <button type="submit">Valider</button>
                            
                        </div>
                        <div class="card-body">
                            <h6>MARQUES</h6>
                            <?php
                                $con = mysqli_connect("localhost","root","","fedair");

                                $brand_query = "SELECT * FROM marque_produit";
                                $brand_query_run  = mysqli_query($con, $brand_query);

                                if(mysqli_num_rows($brand_query_run) > 0)
                                {
                                    foreach($brand_query_run as $brandlist)
                                    {
                                        $checked = [];
                                        if(isset($_GET['brands']))
                                        {
                                            $checked = $_GET['brands'];
                                        }
                                        ?>
                                            <div class="title_brands">
                                                <input type="checkbox" name="brands[]" value="<?= $brandlist['id']; ?>" 
                                                    <?php if(in_array($brandlist['id'], $checked)){ echo "checked"; } ?>
                                                 />
                                                <?= $brandlist['nom_marque']; ?>
                                            </div>
                                        <?php
                                    }
                                }
                                else
                                {
                                    echo "No Brands Found";
                                }
                            ?>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Brand Items - Products -->

                    <div class="card-body_row">
                        <?php
                            if(isset($_GET['brands']))
                            {
                                $branchecked = [];
                                $branchecked = $_GET['brands'];
                                foreach($branchecked as $rowbrand)
                                {
                                    // echo $rowbrand;
                                    $products = "SELECT * FROM produits WHERE marque_id IN ($rowbrand)";
                                    $products_run = mysqli_query($con, $products);
                                    if(mysqli_num_rows($products_run) > 0)
                                    {
                                        foreach($products_run as $proditems) :
                                            ?>
                                                    <div class="card_border">
                                                    <img src="<?= $proditems['image'];?>" alt="" style="height:100px ;">
                                                        <h5> <?= $proditems['marque']; ?></h5>
                                                        <h6> <?= $proditems['nom']; ?></h6>
                                                        <p style="font-family: font_1, sans serif; margin-left:82px; margin-top:-25px"><?= $proditems['categorie']; ?></p>
                                                        <div class="yellow_block1"></div>
                                                        <h5 style="font-family: font_3, sans serif; font-size: 25px; margin-top: 20px; text-align: right; margin-right: 30px;"><?= $proditems['prix']; ?> €</h5>
                                                </div>

                                            <?php
                                        endforeach;
                                    }
                                }
                                    }else{
                                $products = "SELECT * FROM produits";
                                $products_run = mysqli_query($con, $products);
                                if(mysqli_num_rows($products_run) > 0)
                                {
                                    foreach($products_run as $proditems) :
                                        ?>
                                                <div class="card_border">
                                                    <img src="<?= $proditems['image'];?>" alt="" style="height:100px ;">
                                                        <h5><?= $proditems['marque']; ?></h5>
                                                        <h6> <?= $proditems['nom']; ?></h6>
                                                        <p style="font-family: font_1, sans serif; margin-left:82px; margin-top:-25px"><?= $proditems['categorie']; ?></p>
                                                        <div class="yellow_block1"></div>
                                                        <h5 style="font-family: font_3, sans serif; font-size: 25px; margin-top: 20px; text-align: right; margin-right: 30px;"><?= $proditems['prix']; ?> €</h5>
                                                </div>

                                        <?php
                                    endforeach;
                                }else{
                                    echo "No Items Found";
                                }
                            }
                        ?>
                        <button onclick="topFunction()" id="return_button">Retour en haut</button> 
                    </div>
                </div>
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
    <script src="../js/accueil.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
</body>
</html>