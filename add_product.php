<?php 
session_start();
include 'conectiondb.php';
if(!isset($_SESSION['Aname'])){
    header('location:admin_login.php');
}

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
   $message[] = 'product deleted added successfully';
};


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/add_product.css">

    <title>Dashboard</title>
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom"><i
                    class="fas fa-user-secret me-2"></i>B.S Solar</div>
            <div class="list-group list-group-flush my-3">
                 <a href="dashboard.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-chart-line me-2"></i>Orders</a>
                <a href="#" class="list-group-item list-group-item-action bg-transparent second-text  active"><i
                        class="fas fa-project-diagram me-2"></i>Add Products</a>
                <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
                        class="fas fa-chart-line me-2"></i>Contact</a>
                
                <a href="logout_backend.php" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold"><i
                        class="fas fa-power-off me-2"></i>Logout</a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0">Add Products</h2>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle second-text fw-bold" href="#" id="navbarDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user me-2"></i><?php echo $_SESSION['Aname']; ?>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Profile</a></li>
                                <li><a class="dropdown-item" href="#">Settings</a></li>
                                <li><a class="dropdown-item" href="#">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
                
            <?php

                if(isset($message)){
                foreach($message as $message){
                    echo '<span class="message">'.$message.'</span>';
                }
                }

            ?>
            
            <div class="container">

                <div class="admin-product-form-container">

                    <form action="#" method="post" enctype="multipart/form-data">
                        <h3>add a new product</h3>

                        <input type="text" placeholder="Enter product name" name="product_name" class="box">
                        <input type="number" placeholder="Enter product price" name="product_price" class="box">
                        <input type="text" placeholder="Enter Description " name="Description" class="box">
                        <input type="file" accept="image/png, image/jpeg, image/jpg" multiple='multiple' name="product_image" class="box">
                        <input type="submit" class="submit_btn" name="add_product" value="add product">
                    </form>

                </div>

                <?php

                $select = mysqli_query($conn, "SELECT * FROM product");
                
                ?>
                <div class="table_content" id="marks_table">
                    <table class="Marks_entry_table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>name</th>
                            <th>price</th>
                            <th>description</th>
                            <th>image</th>
                            
                        </tr>
                        </thead>
                        <?php while($row = mysqli_fetch_assoc($select)){ ?>
                        <tr>
                            <td>
                                <a href="product_update.php?edit=<?php echo $row['prod_id']; ?>" class="btn"> <i class="fas fa-edit"></i> edit </a>
                                <a href="add_product.php?delete=<?php echo $row['prod_id']; ?>" class="btn"> <i class="fas fa-trash"></i> delete </a>
                            </td>
                            <td><?php echo $row['prod_name']; ?></td>
                            <td>Rs<?php echo $row['prod_price']; ?></td>
                            <td><?php echo $row['prod_description']; ?></td>
                            <td>   <img src="uploads/<?php echo $row['pro_image']; ?>" height="100" alt=""></td>
                            
                        </tr>
                    <?php } ?>
                    </table>
                </div>

            </div>
                             
        </div>
    </div>
    <!-- /#page-content-wrapper -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };
    </script>
</body>

</html>