<?php
include 'conectiondb.php';

$name=$_POST['name'];
$email=$_POST['email'];
$password=$_POST['password'];
$confirm=$_POST['confirm'];
$contact=$_POST['contact'];
$address=$_POST['address'];

if($password==$confirm){



$query="insert into register values(null,'$name','$email','$password','$contact','$address')";



$query2="select * from register where email='$email' ";

$result=mysqli_query($conn,$query2);

$check=mysqli_num_rows($result);

if ($check>0){
    ?>
    <script>
      alert('User Already Exist');
      window.location.assign('signup.php')
    </script>
      <?php
}
    else{
    if(mysqli_query($conn,$query))
    {
        ?>
    <script>
      alert('user register succefully');
      window.location.assign('signup.php')
    </script>
      <?php
    }
    else{
        ?>
    <script>
      alert('Something wrong');
      window.location.assign('signup.php')
    </script>
      <?php
    }
    }




}
else{
    ?>
    <script>
      alert('Confirm password must be same ');
      window.location.assign('signup.php')
    </script>
      <?php
}


?>