<?php
session_start();
if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(isset($_POST['addcart'])){
        if(isset($_SESSION['cart'])){
            $myproduct=array_column($_SESSION['cart'],'name');
            if(in_array($_POST['prod'],$myproduct)){
              
                ?>
        <script>
          alert('This Item Is Already Present In You Cart');
          window.location.assign('products.php')
        </script>
          <?php
            }
            else{
            $count=count($_SESSION['cart']);
            $_SESSION['cart'][$count]=array('name'=>$_POST['prod'],'price'=>$_POST['price'],'img'=>$_POST['img'],'qnt'=>1);
            ?>
            <script>
              alert('Product Added To Your Cart');
              window.location.assign('products.php')
            </script>
              <?php
        }

    }
    else{
        $_SESSION['cart'][0]=array('name'=>$_POST['prod'],'price'=>$_POST['price'],'img'=>$_POST['img'],'qnt'=>1);
        
        ?>
        <script>
          alert('Your Product Added succefully in the Cart ');
          window.location.assign('products.php')
        </script>
          <?php
    }
}

if(isset($_POST['btn'])){

  foreach($_SESSION['cart'] as $key => $value){ 
    if($value['name']==$_POST['prod_name']){
      unset($_SESSION['cart'][$key]);
      $_SESSION['cart']=array_values($_SESSION['cart']);
      ?>
      <script>
        alert('Product Is Removed From Cart');
        window.location.assign('cart_.php')
      </script>
        <?php
    }
  }

}

if(isset($_POST['number'])){
  foreach($_SESSION['cart'] as $key => $value){ 
     if($value['name']==$_POST['prod_quantity']){
      $_SESSION['cart'][$key]['qnt']=$_POST['number'];
       ?>
       <script>
         window.location.assign('cart_.php')
       </script>
         <?php
     }
   }

}
       

}

?>