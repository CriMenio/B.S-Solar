<?php 
include "conectiondb.php";
$prod_id=$_POST['prod_id'];


$product_name = $_POST['product_name'];
$product_price = $_POST['product_price'];
$product_description = $_POST['Description'];
$product_image = $_FILES['product_image']['name'];
$product_image_tmp_name = $_FILES['product_image']['tmp_name'];
$product_image_folder = 'uploaded_img/'.$product_image;

echo "$prod_id $product_name $product_price  $product_description" ;

$update_data = "update product set prod_name='$product_name',prod_price='$product_price',prod_description='$product_description',prod_image='$product_image' where prod_id='$prod_id'";
$upload = mysqli_query($conn, $update_data);
echo $upload;

if($upload){
    ?>
    <script>
      alert('updated  successfully..');
      window.location.assign('add_product.php')
    </script>
      <?php
 }else{
    ?>
    <script>
      alert('updated  unsuccessfully..');
      window.location.assign('add_product.php')
    </script>
      <?php
 }

?>