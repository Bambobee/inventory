<?php
session_start();
include 'db_conn.php';

// Check if the user is logged in by checking if the 'email' session is set
if (!isset($_SESSION['email'])) {
    // If not logged in, redirect to the login page
    header('Location: index');
    exit();
} else {
    $email = $_SESSION['email'];

    // Fetch user role from the database
    $stmt = $conn->prepare("SELECT role FROM users WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if user was found
    if ($user) {
        $role = $user['role'];

        // Redirect if the user is not an Admin
        if ($role !== 'Admin') {
            header('Location: auth-maintenance');
            exit();
        }
    } else {
        // Handle case if no user found (optional)
        header('Location: index');
        exit();
    }
}
?>
<?php include 'header1.php'; ?>


<div class="page-wrapper">

    <!-- Page Content-->
    <div class="page-content">
        <div class="container-xxl">
            <div class="row">
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
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h4 class="card-title">Deposit List</h4>
                                </div>
                                <!--end col-->
                                <div class="col-auto">
                                    <div class="col-auto">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#addBoard"><i class="fa-solid fa-plus me-1"></i> Add
                                            Deposit</button>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>
                        <!--end card-header-->
                        <div class="card-body pt-0">

                            <div class="table-responsive">
                            <table class="table mb-0 checkbox-all" id="deposit">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="ps-0">S.N</th>
                                            <th>Account Name</th>
                                            <th>Deposit Ref</th>
                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th>Payment Method</th>
                                            <th>Description</th>
                                            <th>Proof</th>
                                            <th>Created At</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                         include 'backend/fetch_deposit.php';
                                        foreach ($deposits as $index => $deposit): ?>
                                            <tr>
                                                <td><?php echo $index + 1; ?></td>
                                                <td><?php echo htmlspecialchars($deposit['acc_name']); ?></td> <!-- Display account name -->
                                                <td><?php echo htmlspecialchars($deposit['deposit_ref']); ?></td>
                                                <td><?php echo htmlspecialchars($deposit['date_of_payment']); ?></td>
                                                <td><?php echo htmlspecialchars($deposit['amount']); ?></td> <!-- Display deposit amount -->
                                                <td><?php echo htmlspecialchars($deposit['payment_method']); ?></td> <!-- Display payment method -->
                                                <td><?php echo htmlspecialchars($deposit['description']); ?></td> <!-- Display description -->
                                                <td>
                                                    <?php if (!empty($deposit['proof'])): ?>
                                                        <a href="backend/<?php echo htmlspecialchars($deposit['proof']); ?>" target="_blank">View Proof</a>
                                                    <?php else: ?>
                                                        No Proof
                                                    <?php endif; ?>
                                                </td>
                                                <td><?php echo htmlspecialchars($deposit['created_at']); ?></td> <!-- Display created at date -->
                                                <td class="text-end">
                                                <a href="backend/delete_deposit.php?id=<?php echo $deposit['id']; ?>" onclick="return confirm('Are you sure you want to delete this Deposit?');">
                                            <i class="las la-trash-alt text-danger fs-18"></i>
                                          </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div><!-- container -->


        <!-- Modal -->
        <div class="modal fade" id="addBoard" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Deposit</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="form-validation-2"  enctype="multipart/form-data" action="backend/submit_deposit.php" method="post" class="form">
                            <div class="mb-2">
                                <label class="form-label">Account Name</label>
                                <select class="form-select" name="acc_id" aria-label="Default select example">
                                    <option selected value="">Select the Account Name</option>
                                    <?php 
                                  include 'backend/fetch_account.php';
                                  foreach ($accounts as $index => $account): ?>
                                    <option value="<?php echo htmlspecialchars($account['id']); ?>"><?php echo htmlspecialchars($account['acc_name']); ?></option>
                                    <?php 
                                endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Amount</label>
                                <input class="form-control" name="amount" type="number" placeholder="Enter Amount">
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Date of Payment</label>
                                <input class="form-control" name="date_of_payment" type="date" placeholder="Select Date">
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Payment Method</label>
                                <select class="form-select" name="payment_method" aria-label="Default select example">
                                    <option selected value=" ">Select the Payment type</option>
                                    <?php 
                                  include 'backend/fetch_payment.php';
                                  foreach ($payment_methods as $index => $payment): ?>
                                    <option value="<?php echo htmlspecialchars($payment['title']); ?>"><?php echo htmlspecialchars($payment['title']); ?></option>
                                    <?php 
                                endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Proof File (reciept image or mobile payment screenshot)</label>
                                <input class="form-control" name="image" type="file" >
                            </div>
                            <div class="mb-2">
                                <label class="form-label"> Description</label>
                                <textarea name="description" class="form-control" id=""></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit form</button>
                        </form>
                    </div>


                </div>
            </div>
        </div>
        <script src="./jquery/jquery-3.6.1.min.js"></script>
        <script src="./jquery/jquery.validate.min.js"></script>
        <script>
        $(document).ready(() => {
            $.validator.addMethod(
                "regex",
                function(value, element, regexp) {
                    var check = false;
                    return this.optional(element) || regexp.test(value);
                }
            );

            $.validator.addMethod("extension", function(value, element, param) {
                param = typeof param === "string" ? param.replace(/,/g, '|') : "png|jpe?g|gif";
                return this.optional(element) || value.match(new RegExp(".(" + param + ")$", "i"));
            });

            $.validator.addMethod('filesize', function(value, element, param) {
                return this.optional(element) || (element.files[0].size <= param)
            }, 'File size must be less than {0} bytes');

            $("#form-validation-2").validate({
                rules: {
                    'acc_id': {
                        required: true,
                    },
                    'amount': {
                        required: true,
                    },
                    'date_of_payment': {
                        required: true,
                    },
                    'payment_method': {
                        required: true,
                    },
                    'image': {
                        required: true,
                    extension: "jpg|png|jpeg",
                    filesize: 2 * (1024 * 1024), // 2MB
                },
                    'description': {
                        required: true,
                        minlength: 8,
                        maxlength: 200,
                    }
                },
                messages: {
                    'description': {
                        required: "Please enter Account Name.",
                        minlength: "A minimum of 8 characters is required.",
                        maxlength: "Field accepts a maximum of 200 characters.",
                    },
                    'acc_id': {
                        required: "Please select the account name.",
                    },
                    'amount': {
                        required: "Please enter the Amount.",
                    },
                    'date_of_payment': {
                        required: "Please select the date of payment.",
                    },
                    'payment_method': {
                        required: "Please select the payment Method.",
                    },
                    'image':{
                        required: "Pleas upload the proof.",
                        extension: "Please select a file with a valid extension (jpg, png, jpeg, pdf).",
                        filesize: "File size must be less than 2MB.",
                    }
                },
            });
        })
        </script>

        <?php include 'footer.php'; ?>