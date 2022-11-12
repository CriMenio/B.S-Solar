<?php
session_start();
include 'conectiondb.php';
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $email=$_POST["email"];
    $password=$_POST["password"];
    $sql="select * from register where email='$email' AND password='$password' ";
    $result=mysqli_query($conn,$sql);
    
    if($row=mysqli_fetch_array($result))
    {
        $_SESSION["name"]=$row['name'];
        $_SESSION["userID"]=$row['id'];
        $_SESSION["email"]=$email;

        $email=$_SESSION['email'];
        $_SESSION['status']="login";
        header("location:cart_.php");
    }

    else{
        ?>
        <script>
          alert('Login  Unsuccessfully');
          window.location.assign('signup.php')
        </script>
          <?php
    }
    ?>
<script>
  alert('Email or password is incorrect');  
</script>
<?php
}

?>