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
                                    <h4 class="card-title">Products</h4>
                                </div>
                                <!--end col-->
                                <div class="col-auto">
                                    <div class="col-auto">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#addBoard"><i class="fa-solid fa-plus me-1"></i> Add
                                            Product</button>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>
                        <!--end card-header-->
                        <div class="card-body pt-0">

                            <div class="table-responsive">
                                <table class="table mb-0 checkbox-all" id="products_table">
                                    <thead class="table-light">
                                        <tr>

                                            <th class="ps-0">S.N</th>
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>Product Cost</th>
                                            <th> Selling Price</th>
                                            <th>Suplier</th>
                                            <th>Base Unit</th>
                                            <th>Created At</th>
                                            <th>Status</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                  include 'backend/fetch_product.php';
                                  foreach ($products as $index => $product): ?>
                                        <tr>
                                      <td><?php echo $index + 1; ?></td> 
                                      <td><?php echo htmlspecialchars($product['name']); ?></td>
                                      <td><?php echo htmlspecialchars($product['category']); ?></td>
                                      <td><?php echo htmlspecialchars($product['product_cost']); ?></td>
                                      <td><?php echo htmlspecialchars($product['selling_price']); ?></td>
                                      <td><?php echo htmlspecialchars($product['supplier_name']); ?></td>
                                      <td><?php echo htmlspecialchars($product['unit']); ?></td>
                                      <td><?php echo htmlspecialchars($product['status']); ?></td>
                                      <td><?php echo htmlspecialchars($product['date']); ?></td>
                                            <td class="text-end">
                                                <a href="ecommerce-products.html#"><i
                                                        class="las la-pen text-secondary fs-18"></i></a>
                                                <a href="ecommerce-products.html#"><i
                                                        class="las la-trash-alt text-secondary fs-18"></i></a>
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


        <!-- Modal -->
        <div class="modal fade" id="addBoard" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">


                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Product</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="form-validation-2" action="backend/submit_product.php" method="post"  class="form">
                            <div class="mb-2">
                                <label class="form-label"> Name</label>
                                <input class="form-control" name="name" type="text" placeholder="Enter Product Name">
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Category</label>
                                <select class="form-select" name="category" id="select_cate" aria-label="Default select example">
                                    <option selected value="">Select category Name</option>
                                    <?php 
                                  include 'backend/fetch_category.php';
                                  foreach ($categories as $index => $category): ?>
                                    <option value="<?php echo htmlspecialchars($category['name']); ?>">
                                        <?php echo htmlspecialchars($category['name']); ?></option>
                                    <?php 
                                endforeach; ?>
                                </select>
                                </select>
                            </div>
                            <div class="mb-2">
                                <label class="form-label">product Cost</label>
                                <input class="form-control" name="product_cost" type="number" placeholder="Enter Product Cost">
                            </div>
                            <div class="mb-2">
                                <label class="form-label">selling Price</label>
                                <input class="form-control" name="selling_price" type="number" placeholder="Enter Product price">
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Suplier</label>
                                <select class="form-select" id="sup_select" name="supplier_id" aria-label="Default select example">
                                    <option selected value="">Select Suplier Name</option>
                                    <?php 
                                  include 'backend/fetch_active_suppliers.php';
                                  foreach ($suppliers as $index => $supplier): ?>
                                    <option value="<?php echo htmlspecialchars($supplier['id']); ?>">
                                        <?php echo htmlspecialchars($supplier['name']); ?></option>
                                    <?php 
                                endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Base Unit</label>
                                <select class="form-select" id="unit_sele" name="unit" aria-label="Default select example">
                                    <option selected value="">Select Base Unit</option>
                                    <?php 
                                  include 'backend/fetch_unit.php';
                                  foreach ($units as $index => $unit): ?>
                                    <option value="<?php echo htmlspecialchars($unit['base_unit']); ?>">
                                        <?php echo htmlspecialchars($unit['base_unit']); ?></option>
                                    <?php 
                                endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Status</label>
                                <select class="form-select" name="status" aria-label="Default select example">
                                    <option selected value="">Select status</option>
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
        <script src="assets/jquery/jquery-3.6.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>

        <script>
        $("#select_cate").chosen();
        </script>

        <script>
        $("#sup_select").chosen();
        </script>
        <script>
        $("#unit_sele").chosen();
        </script>

        

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
                    },
                    'category': {
                        required: true,
                    }
                    ,
                    'product_cost': {
                        required: true,
                    },
                    'selling_price': {
                        required: true,
                    },
                    'supplier_id': {
                        required: true,
                    }
                    ,
                    'unit': {
                        required: true,
                    },
                    'status': {
                        required: true,
                    }
                },
                messages: {
                    'name': {
                        required: "Please enter a category name.",
                    },
                    'category': {
                        required: "Please Select the category",
                    }  ,
                    'product_cost': {
                        required: "Please enter the product cost",
                    },
                    'selling_price': {
                        required: "Please enter the selling Price",
                    },
                    'supplier_id': {
                        required: "Please Select the supplier",
                    }
                    ,
                    'unit': {
                        required: "Please Select the base unit",
                    },
                    'status': {
                        required: "Please Select the status",
                    }
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

        <?php include 'footer.php'; ?>