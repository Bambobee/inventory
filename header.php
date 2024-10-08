<?php
session_start();
include 'db_conn.php';

$email = $_SESSION['email'];
// Check if the user is logged in by checking if the 'email' session is set
if (!isset($_SESSION['email'])) {
    // If not logged in, redirect to the login page
    header('Location: index');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr" data-startbar="light" data-bs-theme="light">

<head>
    <meta charset="utf-8" />
    <title>Rizz | Rizz - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico" />

    <!-- App css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/chosen.min.css" rel="stylesheet" type="text/css" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="./assets/datatables.min.css">
    <link rel="stylesheet" href="./assets/responsive.dataTables.min.css">
    <link rel="stylesheet" href="./assets/sweetalert.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css" />
    <style>
    .error {
        color: red;
    }
    </style>
</head>

<!-- Top Bar Start -->

<body>
    <!-- Top Bar Start -->
    <div class="topbar d-print-none">
        <div class="container-xxl">
            <nav class="topbar-custom d-flex justify-content-between" id="topbar-custom">
                <ul class="topbar-item list-unstyled d-inline-flex align-items-center mb-0">
                    <li>
                        <button class="nav-link mobile-menu-btn nav-icon" id="togglemenu">
                            <i class="iconoir-menu-scale"></i>
                        </button>
                    </li>
                    <li class="mx-3 welcome-text">
                        <?php 
              // Get the current hour in 24-hour format
              $currentHour = date('H');

              // Initialize greeting message
              $greeting = 'Good Morning';

              // Change greeting based on the time of day
              if ($currentHour >= 12 && $currentHour < 17) {
                  $greeting = 'Good Afternoon';
              } elseif ($currentHour >= 17 || $currentHour < 5) {
                  $greeting = 'Good Evening';
              }

              $stmt = $conn->prepare("Select * from users where email = '$email'");
              $stmt->execute();
              $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
              ?>
                        <h3 class="mb-0 fw-bold text-truncate"><?= $greeting; ?>, <span
                                style="color: #6ad892;"><?= $rows[0]['name']; ?>!</span></h3>
                        <!-- <h6 class="mb-0 fw-normal text-muted text-truncate fs-14">Here's your overview this week.</h6> -->
                    </li>
                </ul>
                <ul class="topbar-item list-unstyled d-inline-flex align-items-center mb-0">
                    <li class="topbar-item">
                        <a class="nav-link nav-icon" href="javascript:void(0);" id="light-dark-mode">
                            <i class="icofont-moon dark-mode"></i>
                            <i class="icofont-sun light-mode"></i>
                        </a>
                    </li>

                    <li class="dropdown topbar-item">
                        <a class="nav-link dropdown-toggle arrow-none nav-icon" data-bs-toggle="dropdown"
                            href="ecommerce-index.html#" role="button" aria-haspopup="false" aria-expanded="false">
                            <?php
              if($rows[0]['image'] == ''){
                  echo '<img class="thumb-lg rounded-circle" src="assets/images/User-avatar.svg.png">';
              }else{
                  echo '<img class="thumb-lg rounded-circle" src="backend/'.$rows[0]['image'].'">';
              }
              ?>

                        </a>
                        <div class="dropdown-menu dropdown-menu-end py-0">
                            <div class="d-flex align-items-center dropdown-item py-2 bg-secondary-subtle">
                                <div class="flex-shrink-0">
                                    <?php
              if($rows[0]['image'] == ''){
                  echo '<img class="thumb-lg rounded-circle" src="assets/images/User-avatar.svg.png">';
              }else{
                  echo '<img class="thumb-lg rounded-circle" src="backend/'.$rows[0]['image'].'">';
              }
              ?>
                                </div>
                                <div class="flex-grow-1 ms-2 text-truncate align-self-center">
                                    <h6 class="my-0 fw-medium text-dark fs-13">
                                        <?= $rows[0]['name']; ?>
                                    </h6>
                                    <small class="text-muted mb-0"><?= $rows[0]['role']; ?></small>
                                </div>
                                <!--end media-body-->
                            </div>
                            <div class="dropdown-divider mt-0"></div>

                            <small class="text-muted px-2 py-1 d-block">Settings</small>
                            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#image"><i
                                    class="las la-cog fs-18 me-1 align-text-bottom"></i>
                                Change Profile Picture
                            </a>
                            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#password"><i
                                    class="las la-lock fs-18 me-1 align-text-bottom"></i>Change Password</a>
                            <div class="dropdown-divider mb-0"></div>
                            <a class="dropdown-item text-danger" href="logout.php"><i
                                    class="las la-power-off fs-18 me-1 align-text-bottom"></i>
                                Logout</a>
                        </div>
                    </li>
                </ul>
                <!--end topbar-nav-->
            </nav>
            <!-- end navbar-->
        </div>
    </div>
    <!-- Top Bar End -->
    <!-- leftbar-tab-menu -->
    <div class="startbar d-print-none">
        <!--start brand-->
        <div class="brand">
            <a href="index.html" class="logo">
                <span>
                    <img src="assets/images/logo-sm.png" alt="logo-small" class="logo-sm" />
                </span>
                <span class="">
                    <img src="assets/images/logo-light.png" alt="logo-large" class="logo-lg logo-light" />
                    <img src="assets/images/logo-dark.png" alt="logo-large" class="logo-lg logo-dark" />
                </span>
            </a>
        </div>
        <!--end brand-->
        <!--start startbar-menu-->
        <div class="startbar-menu">
            <div class="startbar-collapse" id="startbarCollapse" data-simplebar>
                <div class="d-flex align-items-start flex-column w-100">
                    <!-- Navigation -->
                    <ul class="navbar-nav mb-auto w-100">
                      <?php
                    if (isset($_SESSION['email'])) {
                        $email = $_SESSION['email'];

                        // Fetch user role from the database
                        $stmt = $conn->prepare("SELECT role FROM users WHERE email = :email");
                        $stmt->bindParam(':email', $email);
                        $stmt->execute();
                        $user = $stmt->fetch(PDO::FETCH_ASSOC);

                        // Check if user was found
                        if ($user) {
                            $role = $user['role'];

                            // Common Dashboard link for all roles
                            ?>
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard">
                                <i class="bx bxs-dashboard menu-icon"></i>
                                <span>Dashboards</span>
                            </a>
                        </li>
                        <?php

                  // Role-specific menu items
                  if ($role == 'Employee') {
                      // Menu items for Employee
                      ?>

                        <li class="nav-item">
                            <a class="nav-link" href="ecommerce-index.html#sidebarDashboards" data-bs-toggle="collapse"
                                role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                                <i class='bx bxs-group menu-icon'></i>
                                <span>People</span>
                            </a>
                            <div class="collapse" id="sidebarDashboards">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="customers">Customers</a>
                                    </li>
                                    <!--end nav-item-->
                                    <li class="nav-item">
                                        <a class="nav-link" href="suppliers">Suppliers</a>
                                    </li>
                                    <!--end nav-item-->
                                </ul>
                                <!--end nav-->
                            </div>
                            <!--end startbarDashboards-->
                        </li>



                        <li class="nav-item">
                            <a class="nav-link" href="ecommerce-index.html#product" data-bs-toggle="collapse"
                                role="button" aria-expanded="false" aria-controls="stock">

                                <i class="bx bxl-product-hunt menu-icon"></i>

                                <span>Products</span>
                            </a>
                            <div class="collapse" id="product">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="category">Category</a>
                                    </li>
                                    <!--end nav-item-->
                                    <li class="nav-item">
                                        <a class="nav-link" href="products">All Products</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" href="units">Units</a>
                                    </li>


                                    <!--end nav-item-->
                                </ul>
                                <!--end nav-->
                            </div>
                            <!--end startbarDashboards-->
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="ecommerce-index.html#stock" data-bs-toggle="collapse"
                                role="button" aria-expanded="false" aria-controls="stock">
                                <i class="bx bxs-store-alt menu-icon"></i>
                                <span>Stock </span>
                            </a>
                            <div class="collapse" id="stock">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="stock_levels">Stock Managment</a>
                                    </li>
                                    <!--end nav-item-->
                                    <li class="nav-item">
                                    <?php

                                        // Function to count low stock items
                                        function countLowStock($conn) {
                                            try {
                                                // Count the number of low stock items
                                                $stmt = $conn->prepare("SELECT COUNT(*) as low_stock_count
                                                                        FROM stock a
                                                                        WHERE a.stock_level <= a.stock_alert_level");
                                                $stmt->execute();
                                                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                                                return $result['low_stock_count'];
                                            } catch (PDOException $e) {
                                                echo "Error: " . $e->getMessage();
                                                return 0; // Return 0 if there's an error
                                            }
                                        }

                                        // Fetch the count of low stock items
                                        $lowStockCount = countLowStock($conn);
                                        ?>

                                        <!-- HTML Navigation Link with Low Stock Badge -->
                                        <a class="nav-link" href="low_stock">Low Stock <span class="badge bg-danger"><?php echo htmlspecialchars($lowStockCount); ?></span></a>


                                    </li>
                                    <!--end nav-item-->
                                    <li class="nav-item">
                                        <a class="nav-link" href="expired_stock">Expired Stock <span
                                                class="badge bg-danger">4</span></a>
                                    </li>
                                </ul>
                                <!--end nav-->
                            </div>
                            <!--end startbarDashboards-->
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="purchases">
                                <i class='bx bxs-purchase-tag menu-icon'></i>
                                <span>Purchases</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="sales">
                                <i class='bx bxs-dollar-circle menu-icon'></i>
                                <span>Sales</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="sales_returned">
                                <i class='bx bx-money-withdraw menu-icon'></i>
                                <span>Sales Returned</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="purchase_returned">
                                <i class='bx bxs-purchase-tag-alt menu-icon'></i>
                                <span>Purchase Returned</span>
                            </a>
                        </li>

                        <?php
            } elseif ($role == 'Admin') {
                // Menu items for Admin
                ?>
                        <li class="nav-item">
                            <a class="nav-link" href="user">
                                <i class="bx bxs-user-rectangle menu-icon"></i>
                                <span>User Managment</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="ecommerce-index.html#sidebarDashboards" data-bs-toggle="collapse"
                                role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                                <i class='bx bxs-group menu-icon'></i>
                                <span>People</span>
                            </a>
                            <div class="collapse" id="sidebarDashboards">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="customers">Customers</a>
                                    </li>
                                    <!--end nav-item-->
                                    <li class="nav-item">
                                        <a class="nav-link" href="suppliers">Suppliers</a>
                                    </li>
                                    <!--end nav-item-->
                                </ul>
                                <!--end nav-->
                            </div>
                            <!--end startbarDashboards-->
                        </li>



                        <li class="nav-item">
                            <a class="nav-link" href="ecommerce-index.html#product" data-bs-toggle="collapse"
                                role="button" aria-expanded="false" aria-controls="stock">

                                <i class="bx bxl-product-hunt menu-icon"></i>

                                <span>Products</span>
                            </a>
                            <div class="collapse" id="product">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="category">Category</a>
                                    </li>
                                    <!--end nav-item-->
                                    <li class="nav-item">
                                        <a class="nav-link" href="products">All Products</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" href="units">Units</a>
                                    </li>


                                    <!--end nav-item-->
                                </ul>
                                <!--end nav-->
                            </div>
                            <!--end startbarDashboards-->
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="ecommerce-index.html#stock" data-bs-toggle="collapse"
                                role="button" aria-expanded="false" aria-controls="stock">
                                <i class="bx bxs-store-alt menu-icon"></i>
                                <span>Stock </span>
                            </a>
                            <div class="collapse" id="stock">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="stock_levels">Stock Managment</a>
                                    </li>
                                    <!--end nav-item-->
                                    <li class="nav-item">
                                    <?php

                            // Function to count low stock items
                            function countLowStock($conn) {
                                try {
                                    // Count the number of low stock items
                                    $stmt = $conn->prepare("SELECT COUNT(*) as low_stock_count
                                                            FROM stock a
                                                            WHERE a.stock_level <= a.stock_alert_level");
                                    $stmt->execute();
                                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                                    return $result['low_stock_count'];
                                } catch (PDOException $e) {
                                    echo "Error: " . $e->getMessage();
                                    return 0; // Return 0 if there's an error
                                }
                            }

                            // Fetch the count of low stock items
                            $lowStockCount = countLowStock($conn);
                            ?>

                            <!-- HTML Navigation Link with Low Stock Badge -->
                            <a class="nav-link" href="low_stock">Low Stock <span class="badge bg-danger"><?php echo htmlspecialchars($lowStockCount); ?></span></a>


                                    </li>
                                    <!--end nav-item-->
                                    <li class="nav-item">
                                    <?php

                                        // Function to count expired stock items
                                        function countExpiredStock($conn) {
                                            try {
                                                // Count the number of expired stock items where expiry_date is less than or equal to the current date
                                                $stmt = $conn->prepare("SELECT COUNT(*) as expired_stock_count
                                                                        FROM stock a
                                                                        WHERE a.expiry_date <= CURDATE()");
                                                $stmt->execute();
                                                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                                                return $result['expired_stock_count'];
                                            } catch (PDOException $e) {
                                                echo "Error: " . $e->getMessage();
                                                return 0; // Return 0 if there's an error
                                            }
                                        }

                                        // Fetch the count of expired stock items
                                        $expiredStockCount = countExpiredStock($conn);
                                        ?>

                                        <!-- HTML Navigation Link with Expired Stock Badge -->
                                        <a class="nav-link" href="expired_stock">Expired Stock <span class="badge bg-danger"><?php echo htmlspecialchars($expiredStockCount); ?></span></a>
                                        </a>
                                    </li>
                                </ul>
                                <!--end nav-->
                            </div>
                            <!--end startbarDashboards-->
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="purchases">
                                <i class='bx bxs-purchase-tag menu-icon'></i>
                                <span>Purchases</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="sales">
                                <i class='bx bxs-dollar-circle menu-icon'></i>
                                <span>Sales</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="sales_returned">
                                <i class='bx bx-money-withdraw menu-icon'></i>
                                <span>Sales Returned</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="purchase_returned">
                                <i class='bx bxs-purchase-tag-alt menu-icon'></i>
                                <span>Purchase Returned</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="ecommerce-index.html#sales" data-bs-toggle="collapse"
                                role="button" aria-expanded="false" aria-controls="sales">
                                <i class='bx bx-money menu-icon'></i>
                                <span>Accounting</span>
                            </a>
                            <div class="collapse" id="sales">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="account">Account</a>
                                    </li>
                                    <!--end nav-item-->
                                    <li class="nav-item">
                                        <a class="nav-link" href="deposit">Deposit</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="expenses">Expenses</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="payment_method">Payment Methods</a>
                                    </li>
                                    <!--end nav-item-->
                                </ul>
                                <!--end nav-->
                            </div>
                            <!--end startbarDashboards-->
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="ecommerce-index.html#report" data-bs-toggle="collapse"
                                role="button" aria-expanded="false" aria-controls="report">
                                <i class="bx bxs-report menu-icon"></i>
                                <span>Reports </span>
                            </a>
                            <div class="collapse" id="report">
                                <ul class="nav flex-column">
                                <li class="nav-item">
                                        <a class="nav-link" href="sales_report">Expenses Report</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="purchase_report">Deposit Report</a>
                                    </li>
                                    <!--end nav-item-->
                                    <li class="nav-item">
                                        <a class="nav-link" href="sales_report">Sales Report</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="purchase_report">Purchase Report</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" href="payment_sale_report">Payment Sale</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="payment_purchase_report">Payment Purchase</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="payment_sales_return">Payment Sales Return</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="payment_purchase_return">Payment Purchase Return</a>
                                    </li>
                                    <!--end nav-item-->
                                </ul>
                                <!--end nav-->
                            </div>
                            <!--end startbarDashboards-->
                        </li>
                        <?php
            }
        } else {
            // Handle case where user is not found
            echo "<li class='nav-item'><span class='nav-link'>User not found.</span></li>";
        }
    } else {
        // Handle case where user is not logged in
        echo "<li class='nav-item'><span class='nav-link'>Please log in.</span></li>";
    }
    ?>
                        <!--end nav-item-->
                    </ul>


                    <!--end navbar-nav--->
                </div>
            </div>
            <!--end startbar-collapse-->
        </div>
        <!--end startbar-menu-->
    </div>
    <!--end startbar-->
    <div class="startbar-overlay d-print-none"></div>
    <!-- end leftbar-tab-menu-->