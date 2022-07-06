<?php
    include("connect.php");
    require("liste_produits.php");
    $produits = display()
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/produit_test.css">
    <title>Document</title>
</head>
<body>
    <script src="js/jquery-1.10.2.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <header>
        <div class="navbar">
            <div id="bloc1">
                <div class="logo">
                    <img src="./assets/images/icons/Logo_FEDAIR.svg" alt="logo_FEDAIR" width="80px">
                </div>
                <div class="search">
                    <input type="text">
                </div>
                <div class="icons">
                    <a href="./assets/php/login.php"><img src="./assets/images/icons/user.svg" alt="user" style="width: 30px;"></a>
                    <img src="./assets/images/icons/shopping-cart.svg" alt="shopping">
                </div>
            </div>
            <div class="line_separation"></div>
            <div id="bloc2">

                <a href="./assets/php/produits_test.php">Produits</a>
                <a href="#">Reconditionnée</a>
                <a href="#">Donation</a>
                <a href="#">Contact</a>
            </div>
        </div>
    </header>

        <!-- Page Content -->
        <div class="container">
        <div class="row">
         <br />
         <h2>Filtre</h2>
         <br />
            <div>                    
                <div class="list-group">
                    <h3>Prix</h3>
                        <input type="hidden" id="hidden_minimum_price" value="0" />
                        <input type="hidden" id="hidden_maximum_price" value="65000" />
                            <p id="price_show">1000 - 65000</p>
                            <div id="price_range"></div>
                </div>    
                <div class="list-group">
                    <h3>Marques</h3>
                        <div style="height: 180px; overflow-y: auto; overflow-x: hidden;">
                    <?php

                    $query = ("SELECT DISTINCT (marque) FROM produits WHERE status = '1' ORDER BY id DESC");
                    $statement = $bdd->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach($result as $row)
                    {
                    ?>
                    <div class="list-group-item checkbox">
                        <label>
                            <input type="checkbox" class="common_selector brand" value="<?php echo $row['marque']; ?>"  > 
                            <?php 
                                echo $row['marque']; 
                            ?>
                        </label>
                    </div>
                    <?php
                    }

                    ?>
                </div>
            </div>
        </div>

    <script>
        $(document).ready(function(){

                filter_data();

                function filter_data(){
                    $('.filter_data').html('<div id="loading" style="" ></div>');
                    let action = 'fetch_data';
                    let minimum_price = $('#hidden_minimum_price').val();
                    let maximum_price = $('#hidden_maximum_price').val();
                    let brand = get_filter('brand');
                    let ram = get_filter('ram');
                    let storage = get_filter('storage');
                    $.ajax({
                    url:"fetch_data.php",
                    method:"POST",
                    data:{action:action, minimum_price:minimum_price, maximum_price:maximum_price, brand:brand},
                    success:function(data){
                        $('.filter_data').html(data);
                    }
                });
            }

                function get_filter(class_name){
                    let filter = [];
                    $('.'+class_name+':checked').each(function(){
                        filter.push($(this).val());
                    });
                    return filter;
                    }

    $('.common_selector').click(function(){
        filter_data();
    });

    $('#price_range').slider({
        range:true,
        min:1000,
        max:65000,
        values:[1000, 65000],
        step:500,
        stop:function(event, ui)
        {
            $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
            $('#hidden_minimum_price').val(ui.values[0]);
            $('#hidden_maximum_price').val(ui.values[1]);
            filter_data();
        }
    });

});
</script>

    <?php foreach($produits as $produit):?>
        <div class="card">
            <img src="<?=$produit->image?>" alt="picture" style="width: 120px;">
            <h3><?= $produit->marque?></h3>   
                <p><?= $produit->nom?></p>
                <p><?= $produit->catégorie?></p>
                <p><?= $produit->prix?> €</p>
        </div>
    <?php endforeach?>
</body>
</html>