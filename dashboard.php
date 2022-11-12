<?php 
session_start();
include 'conectiondb.php';
if(!isset($_SESSION['Aname'])){
    header('location:admin_login.php');
}

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

                <a href="#" class="list-group-item list-group-item-action bg-transparent second-text active"><i
                        class="fas fa-chart-line me-2"></i>Orders</a>
                <a href="add_product.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i
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
                    <h2 class="fs-2 m-0">Orders</h2>
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

            <div class="table_content" id="marks_table">
                <table class="Marks_entry_table">
                <tr>
                    <th>OrderID</th>
                    <th>Name</th>
                    <th>Contact No</th>
                    <th>Address</th>
                    <th>Order</th>
                </tr>
                <?php
                
                    $selectquery ="select * from order_manager ";
                    $query= mysqli_query($conn,$selectquery);
                    $nums=mysqli_num_rows($query);
                    while($res =mysqli_fetch_array($query))
                    {
                        $order_id=$res['order_id'];
                    ?>
                    <tr>
                    <td><?php echo $res['order_id']; ?></td>
                    <?php
                    $user_id=$res['user_id'];
                    $quer2="select * from register where id='$user_id'";
                    $exequery=mysqli_query($conn,$quer2);
                    $res2=mysqli_fetch_array($exequery);
                    ?>
                    <td><?php echo $res2['name']; ?></td>
                    <td><?php echo $res2['Contact_No']; ?></td>
                    <td><?php echo $res2['Address']; ?></td>
                    <td>
                        <table class="Marks_entry_table2">
                            <tr>
                                <th>ProductName</th>
                                <th>Price</th>
                                <th>Quantity</th>
                            </tr>
                            <?php
                
                                $selectquery1 ="select * from user_order where ord_id='$order_id' ";
                                $query3= mysqli_query($conn,$selectquery1);
                                while($res3 =mysqli_fetch_array($query3))
                                {
                                ?>
                                <tr>
                                    <td><?php echo $res3['Prod_name']; ?></td>
                                    <td><?php echo $res3['Price']; ?></td>
                                    <td><?php echo $res3['quantity']; ?></td>
                                </tr>
                                <?php 
                                }
                                ?>
                        </table>
                    </td>
                </tr>


                <?php } ?>
                    
                </table>
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