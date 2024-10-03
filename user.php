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
<?php
   include 'header1.php';
?>
<div class="page-wrapper">

<!-- Your HTML Form here -->
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
                                    <h4 class="card-title">User Managment</h4>
                                </div>
                                <!--end col-->
                                <div class="col-auto">
                                    <div class="col-auto">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#addBoard"><i class="fa-solid fa-plus me-1"></i> Add
                                            Category</button>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>
                        <!--end card-header-->
                        <div class="card-body pt-0">

                            <div class="table-responsive">
                            <table class="table mb-0" id="datatable_1">
                              <thead class="table-light">
                                  <tr>
                                      <th>S.N</th>
                                      <th>Name</th>
                                      <th>Contact</th>
                                      <th>Role</th>
                                      <th>Added Date</th>
                                      <th>Address</th>
                                      <th>Status</th>
                                      <th>Action</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <?php 
                                  include 'backend/fetch_user.php';
                                  foreach ($users as $index => $user): ?>
                                  <tr>
                                      <td><?php echo $index + 1; ?></td>
                                      <td class="d-flex align-items-center">
                                          <div class="d-flex align-items-center">
                                              <?php if (!empty($user['image'])): ?>
                                              <img src="backend/<?php echo htmlspecialchars($user['image']); ?>" style="object-fit: cover;" class="me-2 thumb-md align-self-center rounded" alt="...">
                                              <?php else: ?>
                                              <img src="assets/images/User-avatar.svg.png" class="me-2 thumb-md align-self-center rounded" alt="No Image">
                                              <?php endif; ?>
                                              <div class="flex-grow-1 text-truncate">
                                                  <h6 class="m-0"><?php echo htmlspecialchars($user['name']); ?></h6>
                                                  <a href="#" class="fs-12 text-primary"><?php echo htmlspecialchars($user['email']); ?></a>
                                              </div>
                                          </div>
                                      </td>
                                      <td><?php echo htmlspecialchars($user['contact']); ?></td>
                                      <td><?php echo htmlspecialchars($user['role']); ?></td>
                                      <td><?php echo htmlspecialchars($user['date']); ?></td>
                                      <td><?php echo htmlspecialchars($user['address']); ?></td>
                                      <td>
                                          <span class="badge rounded text-<?php echo $user['status'] === 'Active' ? 'success' : 'secondary'; ?> bg-<?php echo $user['status'] === 'Active' ? 'success-subtle' : 'secondary-subtle'; ?>">
                                              <?php echo htmlspecialchars($user['status']); ?>
                                          </span>
                                      </td>
                                      <td class="text-end">
                                          <a href="#"  data-bs-toggle="modal" data-bs-target="#editUser<?php echo htmlspecialchars($user['id']); ?>"><i class="las la-pen text-primary fs-18"></i></a>
                                          <a href="backend/delete_user.php?id=<?php echo $user['id']; ?>" onclick="return confirm('Are you sure you want to delete this user?');">
                                            <i class="las la-trash-alt text-danger fs-18"></i>
                                          </a>

                                      </td>
                                  </tr>
                                  <?php 
                                 include('backend/edit_user.php');
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
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Add User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="backend/submit_user.php" id="form-validation-2" class="form" method="post" enctype="multipart/form-data">
                    <div class="mb-2">
                        <label class="form-label">User Name</label>
                        <input id="name" name="name" class="form-control" required type="text"
                            placeholder="Enter User Name">
                    </div>
                    <div class="mb-2">
                        <label class="form-label">User Email</label>
                        <input id="email" name="email" class="form-control" required type="email"
                            placeholder="Enter User Email">
                    </div>
                    <div class="mb-2">
                        <label class="form-label">User Contact</label>
                        <input id="contact" name="contact" class="form-control" required type="text"
                            placeholder="Enter User Contact">
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Date</label>
                        <input id="date" name="date" class="form-control" required type="date" placeholder="Select Date">
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Image</label>
                        <input id="image" name="image" class="form-control" type="file">
                    </div>
                    <div class="mb-2">
                        <label class="form-label">User Role</label>
                        <select id="role" required name="role" class="form-select" aria-label="Default select example">
                            <option selected value=" ">Open this select User role</option>
                            <option value="Admin">Admin</option>
                            <option value="Employee">Employee</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Status</label>
                        <select id="status" required name="status" class="form-select" aria-label="Default select example">
                            <option selected value=" ">Open this select user Status</option>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Address</label>
                        <textarea name="address" required class="form-control" id="address"></textarea>
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
            function (value, element, regexp) {
                var check = false;
                return this.optional(element) || regexp.test(value);
            }
        );

        $.validator.addMethod("extension", function (value, element, param) {
            param = typeof param === "string" ? param.replace(/,/g, '|') : "png|jpe?g|gif";
            return this.optional(element) || value.match(new RegExp(".(" + param + ")$", "i"));
        });

        $.validator.addMethod('filesize', function (value, element, param) {
            return this.optional(element) || (element.files[0].size <= param)
        }, 'File size must be less than {0} bytes');

        $("#form-validation-2").validate({
            rules: {
                'name': {
                    required: true,
                    minlength: 3,
                    maxlength: 40,
                },
                'email': {
                    required: true,
                    email: true,
                },
                'contact': {
                    required: true,
                    regex: /^[0-9]{10,15}$/, // Phone number validation
                },
                'address': {
                    required: true,
                },
                'date': {
                    required: true,
                },
                'role': {
                    required: true,
                },
                'status': {
                    required: true,
                },
                'image': {
                    extension: "jpg|png|jpeg",
                    filesize: 2 * (1024 * 1024), // 2MB
                },
            },
            messages: {
                'name': {
                    required: "Please enter full names.",
                    minlength: "A minimum of 3 characters is required.",
                    maxlength: "Field accepts a maximum of 40 characters.",
                },
                'email': {
                    required: "Please enter the email.",
                    email: "Enter a valid email address.",
                },
                'contact': {
                    required: "Please enter the phone number.",
                    regex: "Enter a valid phone number (10-15 digits).",
                },
                'address': {
                    required: "Please enter the address.",
                },
                'date': {
                    required: "Please select the date.",
                },
                'role': {
                    required: "Please select the role.",
                },
                'status': {
                    required: "Please select the status.",
                },
                'image': {
                    extension: "Please enter a valid image type (PNG, JPG, JPEG).",
                    filesize: "Image size should not exceed 2MB.",
                }
            },
        });
    })
</script>


      <?php include 'footer.php' ?>