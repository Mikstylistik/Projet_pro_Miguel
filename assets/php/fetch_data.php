
<?php

//fetch_data.php

include("connect.php");

if(isset($_POST["action"]))
{
 $query = "SELECT * FROM produits WHERE status = '1'";
 if(isset($_POST["minimum_price"], $_POST["maximum_price"]) && !empty($_POST["minimum_price"]) && !empty($_POST["maximum_price"])){
    $query .= "AND prix BETWEEN '".$_POST["minimum_price"]."' AND '".$_POST["maximum_price"]."'";
 }
 if(isset($_POST["marque"]))
 {
  $brand_filter = implode("','", $_POST["marque"]);
  $query .= "AND marque IN('".$brand_filter."')";
 }

 $statement = $bdd->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 $total_row = $statement->rowCount();
 $output = '';
 if($total_row > 0)
 {
  foreach($result as $row)
  {
   $output .= '
   <div class="col-sm-4 col-lg-3 col-md-3">
    <div style="border:1px solid #ccc; border-radius:5px; padding:16px; margin-bottom:16px; height:450px;">
     <img src="image/'. $row['product_image'] .'" alt="" class="img-responsive" >
     <p align="center"><strong><a href="#">'. $row['product_name'] .'</a></strong></p>
     <h4 style="text-align:center;" class="text-danger" >'. $row['prix'] .'</h4>
     <p>Camera : '. $row['product_camera'].' MP<br />
     Marque : '. $row['marque'] .' <br />
     RAM : '. $row['product_ram'] .' GB<br />
     Storage : '. $row['product_storage'] .' GB </p>
    </div>

   </div>
   ';
  }
 }
 else
 {
  $output = '<h3>No Data Found</h3>';
 }
 echo $output;
}

?>