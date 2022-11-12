<?php
session_start();
include 'conectiondb.php';
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $name=$_POST["admin_name"];
    $password=$_POST["admin_password"];
    $sql="select * from admin_login where admin_name='$name' AND password='$password' ";
    $result=mysqli_query($conn,$sql);
    
    if($row=mysqli_fetch_array($result))
    {
        $_SESSION["Aname"]=$row['admin_name'];
        $_SESSION["Aid"]=$row['id'];
        ?>
        <script>
          alert('Login  successfully');
          window.location.assign('dashboard.php')
        </script>
          <?php
    }

    else{
        ?>
        <script>
          alert('Login  Unsuccessfully');
          window.location.assign('admin_login.php')
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