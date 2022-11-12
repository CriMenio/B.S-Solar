<?php
session_start();
include 'conectiondb.php';

if(!isset($_SESSION["email"])){
    ?>
        <script>
          alert('Please Login');
          window.location.assign('signup.php')
        </script>
          <?php

}
else{

  if(isset($_POST['purchase'])){
    $pay=$_POST['pay'];
    $user_id=$_SESSION['userID'];

    $query1="INSERT INTO `order_manager`(`order_id`, `user_id`, `pay_mod`) VALUES ('','$user_id','$pay')";

    if(mysqli_query($conn,$query1)){
    $order_id=mysqli_insert_id($conn);
    $query2="INSERT INTO `user_order`(`ord_id`, `Prod_name`, `quantity`, `Price`) VALUES (?,?,?,?)";
    $stat=mysqli_prepare($conn,$query2);
    if($stat){
      mysqli_stmt_bind_param($stat,"isii",$order_id,$prod_name,$quantity,$price);
      foreach($_SESSION['cart'] as $key => $value){
        $prod_name=$value['name'];
        $quantity=$value['qnt'];
        $price=$value['price'];
        mysqli_stmt_execute($stat);
      }
      unset($_SESSION['cart']);
      ?>
    <script>
      alert('order placed succefully');
      window.location.assign('cart_.php')
    </script>
      <?php

    
    }
    else{
      echo "details not insert";
    }
    }
    else{
      echo "error";
    }
    


  }
  



}
?>