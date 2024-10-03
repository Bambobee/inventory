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
                                    <h4 class="card-title">Account List</h4>
                                </div>
                                <!--end col-->
                                <div class="col-auto">
                                    <div class="col-auto">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#addBoard"><i class="fa-solid fa-plus me-1"></i> Add
                                            Account</button>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>
                        <!--end card-header-->
                        <div class="card-body pt-0">

                            <div class="table-responsive">
                                <table class="table mb-0 checkbox-all" id="datatable_1">
                                    <thead class="table-light">
                                        <tr>

                                            <th class="ps-0">S.N</th>
                                            <th>Account Name</th>
                                            <th>Accout Number</th>
                                            <th>Balance</th>
                                            <th>Last Updated at</th>
                                            <th>Created At</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                  include 'backend/fetch_account.php';
                                  foreach ($accounts as $index => $account): ?>
                                        <tr>
                                            <td><?php echo $index + 1; ?></td>
                                            <td><?php echo htmlspecialchars($account['acc_name']); ?></td>
                                            <td><?php echo htmlspecialchars($account['acc_number']); ?></td>
                                            <td><?php echo htmlspecialchars($account['balance']); ?></td>
                                            <td>
                                                <span><?php echo htmlspecialchars($account['last_updated']); ?></span>
                                            </td>
                                            <td>
                                                <span><?php echo htmlspecialchars($account['created_at']); ?></span>
                                            </td>
                                            <td class="text-end">
                                            <a href="#"  data-bs-toggle="modal" data-bs-target="#editAccount<?php echo htmlspecialchars($account['id']); ?>"><i class="las la-pen text-primary fs-18"></i></a>
                                          <a href="backend/delete_account.php?id=<?php echo $account['id']; ?>" onclick="return confirm('Are you sure you want to delete this Account?');">
                                            <i class="las la-trash-alt text-danger fs-18"></i>
                                          </a>
                                            </td>
                                        </tr>
                                        <?php 
                                         include('backend/edit_account.php');
                                endforeach; ?>
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
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Account</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="backend/submit_account.php" method="post" id="form-validation-2" class="form">
                            <div class="mb-2">
                                <label class="form-label">Account Name</label>
                                <input class="form-control" name="acc_name" type="text"required
                                    placeholder="Enter Account Name">
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Account Number</label>
                                <input class="form-control" name="acc_number" type="text" required
                                    placeholder="Enter Account Number">
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Amount</label>
                                <input class="form-control" name="balance" type="number" required
                                    placeholder="Enter Account Balance">
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Date</label>
                                <input class="form-control" required name="created_at" type="date" placeholder="Select Date">
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
                    'acc_name': {
                        required: true,
                        minlength: 3,
                        maxlength: 40,
                    },
                    'acc_number': {
                        required: true,
                    },
                    'balance': {
                        required: true,
                    },
                    'date': {
                        required: true,
                    }
                },
                messages: {
                    'acc_name': {
                        required: "Please enter Account Name.",
                        minlength: "A minimum of 3 characters is required.",
                        maxlength: "Field accepts a maximum of 40 characters.",
                    },
                    'acc_number': {
                        required: "Please enter the number.",
                    },
                    'balance': {
                        required: "Please enter the Amount.",
                    },
                    'date': {
                        required: "Please select the date.",
                    }
                },
            });
        })
        </script>


        <?php include 'footer.php'; ?>