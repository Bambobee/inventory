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
                                    <h4 class="card-title">Categories</h4>
                                </div>
                                <!--end col-->
                                <div class="col-auto">
                                    <div class="col-auto">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#addBoard">
                                            <i class="fa-solid fa-plus me-1"></i> Add Category</button>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>
                        <!--end card-header-->
                        <div class="card-body pt-0">

                            <div class="table-responsive">
                                <table class="table mb-0 checkbox-all" id="category">
                                    <thead class="table-light">
                                        <tr>

                                            <th class="ps-0">S.N</th>
                                            <th>Category Name</th>
                                            <th>Category Description</th>
                                            <th>Created At</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                  include 'backend/fetch_category.php';
                                  foreach ($categories as $index => $category): ?>
                                        <tr>
                                        <td><?php echo $index + 1; ?></td>
                                        <td><?php echo htmlspecialchars($category['name']); ?></td>
                                        <td><?php echo htmlspecialchars($category['description']); ?></td>
                                            <td>
                                                <span><?php echo htmlspecialchars($category['date']); ?></span>
                                            </td>
                                            <td class="text-end">
                                            <a href="#"  data-bs-toggle="modal" data-bs-target="#editCategory<?php echo htmlspecialchars($category['id']); ?>"><i class="las la-pen text-primary fs-18"></i></a>
                                          <a href="backend/delete_category.php?id=<?php echo $category['id']; ?>" onclick="return confirm('Are you sure you want to delete this category?');">
                                            <i class="las la-trash-alt text-danger fs-18"></i>
                                          </a>

                                            </td>
                                        </tr>
                                        <?php 
                                 include('backend/edit_category.php');
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
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Category</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="form-validation-2" action="backend/submit_category.php" method="post"  class="form">
                            <div class="mb-2">
                                <label class="form-label">Categories Name</label>
                                <input class="form-control" type="text" name="name" placeholder="Enter Category Name">
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Date</label>
                                <input class="form-control" type="date" name="date" placeholder="Select Date">
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Categories Description</label>
                                <textarea name="description" class="form-control"></textarea>
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
                maxlength: 40,
            },
            'description': {
                required: true,
                minlength: 3,
                maxlength: 200,
            },
            'date': {
                required: true,
            }
        },
        messages: {
            'name': {
                required: "Please enter a category name.",
                minlength: "Category name must be at least 3 characters.",
                maxlength: "Category name cannot exceed 40 characters.",
            },
            'description': {
                required: "Please enter a description.",
                minlength: "Description must be at least 3 characters.",
                maxlength: "Description cannot exceed 200 characters.",
            },
            'date': {
                required: "Please select a date.",
            },
        },
        errorElement: 'div',
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.mb-2').append(error);
        },
        highlight: function(element) {
            $(element).addClass('is-invalid').removeClass('is-valid');
        },
        unhighlight: function(element) {
            $(element).addClass('is-valid').removeClass('is-invalid');
        }
    });
});

        </script>

        <?php
   include 'footer.php';
?>