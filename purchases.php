<?php include 'header.php'; ?>
  
    <div class="page-wrapper">

        <!-- Page Content-->
        <div class="page-content">
            <div class="container-xxl"> 
            <?php
          // Check if there are any success or error messages in the session

          if (isset($_SESSION['success'])) {
              echo "
              <div class='alert alert-success alert-dismissible fade show' role='alert'>" . $_SESSION['success'] . "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
              unset($_SESSION['success']); // Clear the message
          }

          if (isset($_SESSION['error'])) {
              echo "
              <div class='alert alert-danger alert-dismissible fade show' role='alert'>" . $_SESSION['error'] . "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
              unset($_SESSION['error']); // Clear the message
          }
          ?>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col">                      
                                        <h4 class="card-title">Purchases</h4>                      
                                    </div><!--end col-->
                                    <div class="col-auto">                                         
                                        <div class="col-auto">
                                            <a href="add_purchase" class="btn btn-primary">Add Purchase</a>
                                          </div>
                                    </div><!--end col-->
                                </div><!--end row-->                                  
                            </div><!--end card-header-->
                            <div class="card-body pt-0">
                                
                                <div >
                                    <table class="table mb-0 checkbox-all" id="purchase_table">
                                        <thead class="table-light">
                                          <tr>                                           
                                            <th class="ps-0">S.N</th>
                                            <th>Date </th>
                                            <th>Purchase I.D</th>
                                            <th>Supplier</th>
                                            <th>Grand Total</th>
                                            <th>Paid </th>
                                            <th>Due</th>
                                            <th>Payment Status</th>
                                            <th class="text-end">Action</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                  include 'backend/fetch_purchase.php';
                                  foreach ($purchases as $index => $purchase): ?>
                                            <tr>
                                            <td><?php echo $index + 1; ?></td>
                                            <td><?php echo htmlspecialchars($purchase['date']); ?></td>
                                            <td><?php echo htmlspecialchars($purchase['purchase_id']); ?></td>
                                            <td><?php echo htmlspecialchars($purchase['supplier_name']); ?></td>
                                            <td>UGX <?php echo htmlspecialchars($purchase['grand_total']); ?></td>
                                            <td>UGX <?php echo htmlspecialchars($purchase['paid_amount']); ?></td>
                                            <td>UGX <?php echo htmlspecialchars($purchase['due']); ?></td><td>
                                            <?php
                                            // Check the payment status and apply appropriate classes
                                            if ($purchase['payment_status'] === 'Paid') {
                                                echo '<span class="badge rounded text-success bg-success-subtle">' . htmlspecialchars($purchase['payment_status']) . '</span>';
                                            } elseif ($purchase['payment_status'] === 'Partial') {
                                                echo '<span class="badge rounded text-warning bg-warning-subtle">' . htmlspecialchars($purchase['payment_status']) . '</span>';
                                            } elseif ($purchase['payment_status'] === 'Unpaid') {
                                                echo '<span class="badge rounded text-danger bg-danger-subtle">' . htmlspecialchars($purchase['payment_status']) . '</span>';
                                            } else {
                                                // Default case for unknown payment status
                                                echo '<span class="badge rounded text-secondary bg-secondary-subtle">' . htmlspecialchars($purchase['payment_status']) . '</span>';
                                            }
                                            ?>
                                        </td>
                                                <td class="text-end">                                                       
                                                  <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                      <i class='bx bx-dots-vertical-rounded'></i>
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                      <li><a class="dropdown-item" href="#">Edit Purchase</a></li>
                                                      <li><a class="dropdown-item" href="#">Purchase Details</a></li>
                                                      <li><a class="dropdown-item" href="#">Show Payments</a></li>
                                                      <li><a class="dropdown-item" href="#">Create Payments</a></li>
                                                      <li><a class="dropdown-item" href="#">Download PDF</a></li>
                                                      <li>
                                                        <a class="dropdown-item" href="backend/delete_purchase.php?id=<?php echo $purchase['id']; ?>" 
                                                        onclick="return confirm('Are you sure you want to delete this Purchase?');">
                                                        Delete Purchase
                                                        </a>
                                                    </li>
                                                    </ul>
                                                  </div>
                                                </td>
                                            </tr>
                                            <?php 
                                endforeach; ?>                                                                       
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->                                     
            </div><!-- container -->
            <script src="assets/jquery/jquery-3.6.1.min.js"></script>
            <?php include 'footer.php'; ?>
  