<?php include 'header.php'; 
 include 'backend/fetch_product.php';
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
                                    <h4 class="card-title">Low Stock</h4>
                                </div>
                                <!--end col-->
                              
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>
                        <!--end card-header-->
                        <div class="card-body pt-0">

                            <div class="table-responsive">
                                <table class="table mb-0 checkbox-all" id="stock_table">
                                    <thead class="table-light">
                                        <tr>

                                            <th class="ps-0">S.N</th>
                                            <th>Stock ID</th>
                                            <th>Product </th>
                                            <th>Stock Levels</th>
                                            <th>Stock Alert Level</th>
                                            <th>Expiry date </th>
                                            <th>Created At</th>
                                            <th>Last Updated At</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                  include 'backend/fetch_low_stock.php';
                                  foreach ($lowStocks as $index => $stock): ?>
                                        <tr>
                                            <td><?php echo $index + 1; ?></td>
                                            <td><?php echo htmlspecialchars($stock['stock_id']); ?></td>
                                            <td><?php echo htmlspecialchars($stock['product_name']); ?></td>
                                            <td><?php echo htmlspecialchars($stock['stock_level']); ?></td>
                                            <td><?php echo htmlspecialchars($stock['stock_alert_level']); ?></td>
                                            <td><?php echo htmlspecialchars($stock['expiry_date']); ?></td>
                                            <td><?php echo htmlspecialchars($stock['created_at']); ?></td>
                                            <td>
                                                <span><?php echo htmlspecialchars($stock['last_updated']); ?></span>
                                            </td>
                                            <td class="text-end">
                                                <a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#editStock<?php echo htmlspecialchars($stock['id']); ?>"><i
                                                        class="las la-pen text-primary fs-18"></i></a>
                             

                                            </td>
                                        </tr>
                                        <?php 
                                 include('backend/edit_stock.php');
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
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Stock</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="form-validation-2" action="backend/submit_stock.php" method="post" class="form">
                            <div class="mb-2">
                                <label class="form-label">Stock Batch ID</label>
                                <input class="form-control" name="stock_id" type="text"
                                    placeholder="Enter batch number">

                            </div>
                            <div class="mb-2">
                                <label class="form-label">Select Product name</label>
                                <select class="form-select" id="select_cate" name="product_id"
                                    aria-label="Default select example">
                                    <option selected value="">Select Product name</option>
                                    <?php 
                                 
                                  foreach ($products as $index => $product): ?>
                                    <option value="<?php echo htmlspecialchars($product['id']); ?>">
                                        <?php echo htmlspecialchars($product['name']); ?></option>
                                    <?php 
                                endforeach; ?>
                                </select>

                            </div>
                            <div class="mb-2">
                                <label class="form-label">Stock level</label>
                                <input class="form-control" name="stock_level" type="number"
                                    placeholder="Enter stock amount">

                            </div>
                            <div class="mb-2">
                                <label class="form-label">Stock alert levels</label>
                                <input class="form-control" name="stock_alert_level_figure" type="number"
                                    placeholder="Enter the minimum stock amount">

                            </div>
                            <div class="mb-2">
                                <label class="form-label">Expiry Date</label>
                                <input class="form-control" name="expiry_date" type="date" placeholder="Select Date">

                            </div>
                            <div class="mb-2">
                                <label class="form-label">Added at Date</label>
                                <input class="form-control" type="date" name="created_at" placeholder="Select Date">

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
                    'stock_id': {
                        required: true,
                    },
                    'product_id': {
                        required: true,
                    },
                    'stock_level': {
                        required: true,
                    },
                    'stock_alert_level_figure': {
                        required: true,
                    },
                    'expired_date': {
                        required: true,
                    },
                    'created_date': {
                        required: true,
                    }
                },
                messages: {
                    'stock_id': {
                        required: "Please enter the stock ref_number.",
                    },
                    'product_id': {
                        required: "Please Select the the product Name",
                    },
                    'stock_level': {
                        required: "Please enter the stock level",
                    },
                    'stock_alert_level_figure': {
                        required: "Please enter the stock Alert figure",
                    },
                    'expiry_date': {
                        required: "Please enter the expiry date",
                    },
                    'created_date': {
                        required: "Please Select the created date",
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