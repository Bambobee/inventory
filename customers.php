<?php
   include 'header.php';
?>

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
                                    <h4 class="card-title">Customer</h4>
                                </div>
                                <!--end col-->
                                <div class="col-auto">
                                    <div class="col-auto">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#addBoard"><i class="fa-solid fa-plus me-1"></i> Add
                                            Customer</button>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>
                        <!--end card-header-->
                        <div class="card-body pt-0">

                            <div class="table-responsive">
                                <table class="table mb-0 checkbox-all" id="customer">
                                    <thead class="table-light">
                                        <tr>
                                            <th>S.N</th>
                                            <th>Customer ID</th>
                                            <th>Name</th>
                                            <th>Contact</th>
                                            <th>Added Date</th>
                                            <th>Total Sales Due</th>
                                            <th>Total Sales Due Returned</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                  include 'backend/fetch_customer.php';
                                  foreach ($customers as $index => $customer): ?>
                                        <tr>
                                            <td><?php echo $index + 1; ?></td>
                                            <td><?php echo htmlspecialchars($customer['cust_id']); ?></td>
                                            <td class="d-flex align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1 text-truncate">
                                                        <h6 class="m-0">
                                                            <?php echo htmlspecialchars($customer['name']); ?></h6>
                                                        <a href="#"
                                                            class="fs-12 text-primary"><?php echo htmlspecialchars($customer['email']); ?></a>
                                                    </div>
                                                    <!--end media body-->
                                                </div>
                                            </td>

                                            <td><?php echo htmlspecialchars($customer['contact']); ?></td>
                                            <td><?php echo htmlspecialchars($customer['added_date']); ?></td>
                                            <td>ugx <?php echo htmlspecialchars($customer['total_sale_due']); ?></td>
                                            <td>ugx
                                                <?php echo htmlspecialchars($customer['total_sales_due_returned']); ?>
                                            </td>
                                            <td>
                                                <span
                                                    class="badge rounded text-<?php echo $customer['status'] === 'Active' ? 'success' : 'secondary'; ?> bg-<?php echo $customer['status'] === 'Active' ? 'success-subtle' : 'secondary-subtle'; ?>">
                                                    <?php echo htmlspecialchars($customer['status']); ?>
                                                </span>
                                            </td>
                                            <td class="text-end">
                                            <a href="#"  data-bs-toggle="modal" data-bs-target="#editCustomer<?php echo htmlspecialchars($customer['id']); ?>"><i class="las la-pen text-primary fs-18"></i></a>
                                          <a href="backend/delete_customer.php?id=<?php echo $customer['id']; ?>" onclick="return confirm('Are you sure you want to delete this customer?');">
                                            <i class="las la-trash-alt text-danger fs-18"></i>
                                          </a>

                                            </td>
                                        </tr>
                                        <?php 
                                        
                                 include('backend/edit_customer.php');
                                                endforeach;
                                                ?>

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
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Customer</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="backend/submit_customer.php" method="post" id="form-validation-2" class="form">
                            <div class="mb-2">
                                <label class="form-label">Name</label>
                                <input class="form-control" name="name" type="text" required placeholder="Enter User Name">
                            </div>
                            <div class="mb-2">
                                <label class="form-label">User Email</label>
                                <input class="form-control" name="email" type="email" required placeholder="Enter User Email">
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Contact</label>
                                <input class="form-control" name="contact" type="text" required placeholder="Enter User Contact">
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Date</label>
                                <input class="form-control" name="added_date" type="date" required placeholder="Select Date">
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Status</label>
                                <select class="form-select" name="status" required aria-label="Default select example">
                                    <option selected value=" ">Open from this select menu</option>
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
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
    // Custom method to validate regex
    $.validator.addMethod(
        "regex",
        function(value, element, regexp) {
            var check = false;
            return this.optional(element) || regexp.test(value);
        }
    );

    // Custom method to validate file extension
    $.validator.addMethod("extension", function(value, element, param) {
        param = typeof param === "string" ? param.replace(/,/g, '|') : "png|jpe?g|gif";
        return this.optional(element) || value.match(new RegExp(".(" + param + ")$", "i"));
    });

    // Custom method to validate file size
    $.validator.addMethod('filesize', function(value, element, param) {
        return this.optional(element) || (element.files[0].size <= param)
    }, 'File size must be less than {0} bytes');

    // Re-initialize form validation each time the modal is shown
    $('#addBoard').on('shown.bs.modal', function () {
        // Clear previous validation errors
        $("#form-validation-2").validate().resetForm();

        // Initialize validation for the form
        $("#form-validation-2").validate({
            rules: {
                'name': {
                    required: true,
                    minlength: 3,
                    maxlength: 50,
                },
                'email': {
                    required: true,
                    email: true,
                },
                'contact': {
                    required: true,
                    regex: /^[0-9]{10,15}$/, // Phone number validation
                },
                'added_date': {
                    required: true,
                },
                'status': {
                    required: true,
                }
            },
            messages: {
                'name': {
                    required: "Please enter Account Name.",
                    minlength: "A minimum of 3 characters is required.",
                    maxlength: "Field accepts a maximum of 50 characters.",
                },
                'email': {
                    required: "Please enter the email.",
                    email: "Enter a valid email address.",
                },
                'contact': {
                    required: "Please enter the phone number.",
                    regex: "Enter a valid phone number (10-15 digits).",
                },
                'added_date': {
                    required: "Please select the date.",
                },
                'status': {
                    required: "Please select the status.",
                }
            },
        });
    });
});
</script>


        <?php
   include 'footer.php';
?>