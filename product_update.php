<?php

include 'conectiondb.php';



$id = $_GET['edit'];
$query="select * from product where prod_id='$id';";
$exc=mysqli_query($conn,$query);
$res=mysqli_fetch_array($exc);



?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="/css/add_product.css">
</head>
<body>



<div class="container">


<div class="admin-product-form-container centered">

                  <form action="update_product_manage.php" method="post" enctype="multipart/form-data">
                        <h3>add a new product</h3>
                        <input type="text" placeholder="Enter product name" name="product_name" value="<?php echo $res['prod_name']; ?>"class="box" required>
                        <input type="number" placeholder="Enter product price" name="product_price" value="<?php echo $res['prod_price']; ?>" class="box" required>
                        <input type="text" placeholder="Enter Description " name="Description" value="<?php echo $res['prod_description']; ?>" class="box" required>
                        <input type="file" accept="image/png, image/jpeg, image/jpg" multiple='multiple' name="product_image" class="box" >
                        <input type="hidden" name="prod_id" value="<?php echo $id ?>">
                        <input type="submit" class="submit_btn" name="edit_product" value="edit product">
                    </form>

   

</div>

</div>

</body>
</html>