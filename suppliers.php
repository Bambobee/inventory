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
                                    <h4 class="card-title">Supplier</h4>
                                </div>
                                <!--end col-->
                                <div class="col-auto">
                                    <div class="col-auto">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#addBoard"><i class="fa-solid fa-plus me-1"></i> Add
                                            Supplier</button>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>
                        <!--end card-header-->
                        <div class="card-body pt-0">

                            <div class="table-responsive">
                                <table class="table mb-0" id="supplier">
                                    <thead class="table-light">
                                        <tr>
                                            <th>S.N</th>
                                            <th>Supplier_I.D</th>
                                            <th>Name</th>
                                            <th>Contact</th>
                                            <th>Address</th>
                                            <th>Added Date</th>
                                            <th>Total Purchase Due</th>
                                            <!-- <th>Total Purchase Due Returned</th> -->
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                  include 'backend/fetch_supplier.php';
                                  foreach ($suppliers as $index => $supplier): ?>
                                        <tr>
                                            <td><?php echo $index + 1; ?></td>
                                            <td><?php echo htmlspecialchars($supplier['suplier_id']); ?></td>
                                            <td class="d-flex align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-grow-1 text-truncate">
                                                        <h6 class="m-0">
                                                            <?php echo htmlspecialchars($supplier['name']); ?></h6>
                                                        <a href="#"
                                                            class="fs-12 text-primary"><?php echo htmlspecialchars($supplier['email']); ?></a>
                                                    </div>
                                                    <!--end media body-->
                                                </div>
                                            </td>
                                            <td><?php echo htmlspecialchars($supplier['contact']); ?></td>
                                            <td><?php echo htmlspecialchars($supplier['address']); ?></td>
                                            <td><?php echo htmlspecialchars($supplier['date']); ?></td>
                                            <td>ugx <?php echo !empty($supplier['total_due']) ? htmlspecialchars($supplier['total_due']) : '0'; ?></td>

                                            <td> <span
                                                    class="badge rounded text-<?php echo $supplier['status'] === 'Active' ? 'success' : 'secondary'; ?> bg-<?php echo $supplier['status'] === 'Active' ? 'success-subtle' : 'secondary-subtle'; ?>">
                                                    <?php echo htmlspecialchars($supplier['status']); ?>
                                                </span></td>
                                            <td class="text-end">
                                                <a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#editSupplier<?php echo htmlspecialchars($supplier['id']); ?>"><i
                                                        class="las la-pen text-primary fs-18"></i></a>
                                                <a href="backend/delete_supplier.php?id=<?php echo $supplier['id']; ?>"
                                                    onclick="return confirm('Are you sure you want to delete this supplier?');">
                                                    <i class="las la-trash-alt text-danger fs-18"></i>
                                                </a>

                                            </td>
                                        </tr>
                                        <!-- <td><span class="badge rounded text-secondary bg-secondary-subtle">Inactive</span></td> -->

                                        <?php 
                                            
                                            
                                 include('backend/edit_supplier.php');
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
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Supplier</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="backend/submit_supplier.php" method="post" id="form-validation-2" class="form">
                            <div class="mb-2">
                                <label class="form-label">Name</label>
                                <input class="form-control" name="name" type="text" required
                                    placeholder="Enter User Name">
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Email</label>
                                <input class="form-control" name="email" type="email" required
                                    placeholder="Enter User Email">
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Contact</label>
                                <input class="form-control" name="contact" type="text" required
                                    placeholder="Enter User Contact">
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Date</label>
                                <input class="form-control" type="date" name="date" required placeholder="Select Date">
                            </div>

                            <div class="mb-2">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-select" required aria-label="Default select example">
                                    <option selected value=" ">Open this select menu</option>
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Address</label>
                                <textarea class="form-control" name="address"></textarea>
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
                    'date': {
                        required: true,
                    },
                    'status': {
                        required: true,
                    },
                    'address': {
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
                    'date': {
                        required: "Please select the date.",
                    },
                    'status': {
                        required: "Please select the status.",
                    },
                    'address': {
                        required: "Please select the address.",
                    }
                },
            });
        })
        </script>

        <?php
                include 'footer.php';
             ?>