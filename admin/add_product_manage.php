<?php
include_once('conectiondb.php');
if(isset($_POST['add_product'])){
    
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_description = $_POST['Description'];
    $product_image = $_FILES['product_image']['name'];
    $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
    $product_image_folder = 'uploads/'.$product_image;

   if(empty($product_name) || empty($product_price) || empty($product_description) || empty($product_image)){
      $message[] = 'please fill out all';
   }else{
      $insert = "INSERT INTO product VALUES(NULL,'$product_name', '$product_price','$product_description','$product_image')";
      $upload = mysqli_query($conn,$insert);
      if($upload){
         move_uploaded_file($product_image_tmp_name, $product_image_folder);
         $message[] = 'new product added successfully';
      }else{
         $message[] = 'could not add the product';
         echo mysqli_error($conn);
      }
   }

};

if(isset($_GET['delete'])){
   $id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM product WHERE prod_id = $id");
   header('location:add_product.php');
};

// print_r($_FILES['product_image']);

?>