<?php include 'header.php'; 
include 'backend/fetch_active_suppliers.php';
?>

<div class="page-wrapper">
    <!-- Page Content-->
    <div class="page-content">
        <form action="" method="post">
            <div class="container-xxl">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h4 class="card-title">Add New Purchase</h4>
                                    </div>
                                    <!--end col-->
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </div>
                            <!--end card-header-->
                            <div class="card-body pt-0">

                                <div class="row">
                                    <div class="col-6">
                                        <label class="form-label">Date</label>
                                        <input class="form-control" name="date" type="date">

                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">Supplier</label>
                                        <select class="form-select" id="select_sup"name="supplier_id" aria-label="Default select example">
                                            <option selected>Choose supplier Name</option>
                                            <?php 
                                 
                                  foreach ($suppliers as $index => $supplier): ?>
                                            <option value="<?php echo htmlspecialchars($supplier['id']); ?>">
                                                <?php echo htmlspecialchars($supplier['name']); ?></option>
                                            <?php 
                                endforeach; ?>
                                        </select>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">

                                    <!--end col-->
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </div>
                            <!--end card-header-->
                            <div class="card-body pt-0">
                                <button type="button" class="btn btn-primary mb-3" id="add_row">Add Row</button>
                                <div>
                                    <table class="table mb-0 checkbox-all">
                                        <thead class="table-light">
                                            <tr>
                                                <th class="ps-0">S.N</th>
                                                <th>Product Name</th>
                                                <th>Unit Cost</th>
                                                <th>Quantity</th>
                                                <th>Sub Total</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="purchase_body">
                                            <tr>
                                                <td>1</td>
                                                <td>
                                                    <select class="form-select drop" name="product_id[]" id="select_product"
                                                        aria-label="Default select example">
                                                        <option selected>Choose Product Name</option>
                                                        <?php 
                                                    include 'backend/fetch_active_product.php';
                                                    foreach ($products as $index => $product): ?>
                                                        <option value="<?php echo htmlspecialchars($product['id']); ?>">
                                                            <?php echo htmlspecialchars($product['name']); ?>
                                                        </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" readonly class="form-control unit-cost" />
                                                </td>
                                                <td style="display: flex;">
                                                    <span style="
                                                            display: flex;
                                                            align-items: center;
                                                            box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px
                                                            2.6px;
                                                            border-radius: 50%;
                                                            padding: 10px;
                                                        ">
                                                        <i class="bx bx-plus" style="font-size: 20px;"></i></span>
                                                    <input type="number" name="qty[]" value="1" class="mx-2 form-control quantity" />
                                                    <span style="
                                                        display: flex;
                                                        align-items: center;
                                                        box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px
                                                        2.6px;
                                                        border-radius: 50%;
                                                        padding: 10px;
                                                    ">
                                                        <i class="bx bx-minus" style="font-size: 20px;"></i></span>
                                                </td>
                                                <td>
                                                    <input type="text" name="sub_total[]" readonly class="form-control sub-total" />
                                                </td>
                                                <td class="text-end">
                                                    <a href="#" class="remove-row"><i
                                                            class="las la-trash-alt text-secondary fs-18"></i>
                                                        </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="offset-md-9 col-md-3 mt-4">
                                    <table class="table table-striped table-sm">
                                        <tbody>
                                            <tr>
                                                <td class="bold">Order Tax</td>
                                                <td>
                                                    <span id="order_tax_display">Ugx 0.00 (0%)</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="bold">Discount</td>
                                                <td>
                                                    <span id="discount_display">Ugx 0.00</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="bold">Shipping</td>
                                                <td>
                                                    <span id="shipping_display">Ugx 0.00</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><span class="font-weight-bold">Grand Total</span></td>
                                                <tr>
                                                    <td><span class="font-weight-bold">Grand Total</span></td>
                                                    <td>
                                                        <span id="grand_total_display" class="font-weight-bold">Ugx 0.00</span>
                                                        <input type="hidden" name="grand_total" value="">
                                                    </td>
                                                </tr>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>


                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <div class="card" style="padding: 2%;">
                    <div class="row">

                        <div class="form-group col-md-4">
                            <label for="ordertax">Order Tax (%)</label>
                            <div class="input-group">
                                <input type="number" name="tax" id="order_tax_input" class="form-control" value="0"
                                    oninput="calculateGrandTotal()">
                                <span class="input-group-text">%</span>
                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="discount">Discount</label>
                            <div class="input-group">
                                <input type="number" name="discount" id="discount_input" class="form-control" value="0"
                                    oninput="calculateGrandTotal()">
                                <select id="discount_type_input" class="form-select" onchange="calculateGrandTotal()">
                                    <option value="fixed">Fixed</option>
                                    <option value="percent">Percent %</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="shipping">Shipping</label>
                            <div class="input-group">
                                <input type="number" name="shipping" id="shipping_input" class="form-control" value="0"
                                    oninput="calculateGrandTotal()">
                                <span class="input-group-text">Ugx</span>
                            </div>
                        </div>

                        <div class="form-group col-md-12 mt-2">
                            <label for="note">Please provide any details</label>
                            <textarea name="details" class="form-control" name="note" id="note"
                                placeholder="Please provide any details"></textarea>
                        </div>
                    </div>

                </div>


                <button class="btn btn-primary">Submit</button>
        </form>
        <!-- end col -->
    </div>
    <!-- end row -->
</div>
<!-- container -->


<!-- <footer class="footer text-center text-sm-start d-print-none">
        <div class="container-xxl">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-0 rounded-bottom-0">
                        <div class="card-body">
                            <p class="text-muted mb-0">
                                ©
                                <script>
                                    document.write(new Date().getFullYear());
                                </script>
                                Rizz
                                <span class="text-muted d-none d-sm-inline-block float-end">
                                    Crafted with
                                    <i class="iconoir-heart text-danger"></i>
                                    by Mannatthemes</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer> -->

<!--end footer-->
</div>
<!-- end page content -->
</div>
<!-- end page-wrapper -->

<!-- Javascript  -->
<!-- vendor js -->
<script src="assets/jquery/jquery-3.6.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>

<script>
$(document).ready(function() {
    $('#select_product').change(function() {
        var productId = $(this).val();

        if (productId) {
            $.ajax({
                url: 'backend/fetch_price.php', // Path to the PHP file
                method: 'POST',
                data: {
                    product_id: productId
                },
                dataType: 'json',
                success: function(response) {
                    if (response.selling_price) {
                        // Update the readonly input with the selling price
                        $('input[readonly]').val(response.selling_price);
                    } else {
                        alert('Product not found.');
                    }
                },
                error: function() {
                    alert('An error occurred while fetching the price.');
                }
            });
        } else {
            // Clear the selling price input if no product is selected
            $('input[readonly]').val('');
        }
    });
});
</script>
<script>
$(document).ready(function() {
    var rowCount = 1;
    var shippingCost = 500; // Static shipping cost
    var discountType = 'fixed';
    var discountValue = 0;
    var taxPercentage = 0;

    // Function to update the row numbers after adding/removing rows
    function updateRowNumbers() {
        $('#purchase_body tr').each(function(index) {
            $(this).find('td:first').text(index + 1);
        });
    }

    // Function to calculate subtotal based on quantity and unit price
    function calculateSubtotal($row) {
        var unitPrice = parseFloat($row.find('.unit-cost').val()) || 0;
        var quantity = parseInt($row.find('.quantity').val()) || 1;
        var subtotal = unitPrice * quantity;
        $row.find('.sub-total').val(subtotal.toFixed(2)); // Update the subtotal field
        calculateGrandTotal(); // Recalculate the grand total
    }

    // Function to calculate the grand total
   // Function to calculate the grand total
function calculateGrandTotal() {
    var grandTotal = 0;
    var discount = 0;
    var orderTax = 0;
    var shippingCost = parseFloat($('#shipping_input').val()) || 0;
    var discountValue = parseFloat($('#discount_input').val()) || 0;
    var discountType = $('#discount_type_input').val();
    var taxPercentage = parseFloat($('#order_tax_input').val()) || 0;

    // Loop through each row to calculate the grand total before discount and tax
    $('#purchase_body tr').each(function() {
        var subtotal = parseFloat($(this).find('.sub-total').val()) || 0;
        grandTotal += subtotal;
    });

    // Apply discount based on the discount type
    if (discountType === 'fixed') {
        discount = discountValue;
    } else if (discountType === 'percent') {
        discount = (discountValue * grandTotal) / 100;
    }

    grandTotal -= discount; // Subtract the discount from the grand total

    // Apply shipping cost
    grandTotal += shippingCost;

    // Apply tax
    orderTax = (taxPercentage * grandTotal) / 100;
    grandTotal += orderTax;

    // Update the grand total display and hidden input
    $('#grand_total_display').text('Ugx ' + grandTotal.toFixed(2));
    $('input[name="grand_total"]').val(grandTotal.toFixed(2)); // Update the hidden input with the grand total

    // Update the order summary
    $('#order_tax_display').text('Ugx ' + orderTax.toFixed(2) + ' (' + taxPercentage + '%)');
    $('#discount_display').text('Ugx ' + discount.toFixed(2));
    $('#shipping_display').text('Ugx ' + shippingCost.toFixed(2));
}

// Event listener for discount input
$('#discount_input, #discount_type_input').on('input change', function() {
    calculateGrandTotal();
});

// Event listener for tax and shipping input
$('#order_tax_input, #shipping_input').on('input', function() {
    calculateGrandTotal();
});


    // Event listener for discount input
    $('#discount_input, #discount_type_input').on('input change', function() {
        calculateGrandTotal();
    });

    // Event listener for tax and shipping input
    $('#order_tax_input, #shipping_input').on('input', function() {
        calculateGrandTotal();
    });

    // Function to add a new row
    $('#add_row').click(function() {
        rowCount++;
        var newRow = `
            <tr>
                <td>${rowCount}</td>
                <td>
                    <select class="form-select drop" id="select_product" name="product_id[]">
                        <option selected>Choose Product Name</option>
                        <?php foreach ($products as $product): ?>
                        <option value="<?php echo htmlspecialchars($product['id']); ?>">
                            <?php echo htmlspecialchars($product['name']); ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td><input type="text" readonly class="form-control unit-cost" /></td>
                <td style="display: flex;">
                    <span class="bx bx-plus" style=" font-size: 20px;
                                                            display: flex;
                                                            align-items: center;
                                                            box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px
                                                            2.6px;
                                                            border-radius: 50%;
                                                            padding: 10px;
                                                         cursor: pointer;"></span>
                    <input type="number" name="qty[]" class="mx-2 form-control quantity" value="1" />
                    <span class="bx bx-minus" style=" font-size: 20px;
                                                            display: flex;
                                                            align-items: center;
                                                            box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px
                                                            2.6px;
                                                            border-radius: 50%;
                                                            padding: 10px;
                                                         cursor: pointer;"></span>
                </td>
                <td><input type="text" name="sub_total[]" readonly class="form-control sub-total" /></td>
                <td class="text-end">
                    <a href="#" class="remove-row"><i class="las la-trash-alt text-secondary fs-18"></i></a>
                </td>
            </tr>`;
        $('#purchase_body').append(newRow);
        updateRowNumbers();
    });

    // Event listener for product selection to fetch price
    $(document).on('change', '.drop', function() {
        var $row = $(this).closest('tr');
        var productId = $(this).val();

        if (productId) {
            $.ajax({
                url: 'backend/fetch_price.php',
                method: 'POST',
                data: {
                    product_id: productId
                },
                dataType: 'json',
                success: function(response) {
                    if (response.selling_price) {
                        $row.find('.unit-cost').val(response.selling_price);
                        calculateSubtotal($row);
                    }
                }
            });
        }
    });

    // Event listeners for increment/decrement buttons
    $(document).on('click', '.bx-plus', function() {
        var $row = $(this).closest('tr');
        var $quantityInput = $row.find('.quantity');
        var quantity = parseInt($quantityInput.val()) || 1;
        $quantityInput.val(quantity + 1);
        calculateSubtotal($row);
    });

    $(document).on('click', '.bx-minus', function() {
        var $row = $(this).closest('tr');
        var $quantityInput = $row.find('.quantity');
        var quantity = parseInt($quantityInput.val()) || 1;
        if (quantity > 1) {
            $quantityInput.val(quantity - 1);
            calculateSubtotal($row);
        }
    });

    // Event listener for quantity input change
    $(document).on('input', '.quantity', function() {
        var $row = $(this).closest('tr');
        calculateSubtotal($row);
    });

    // Event listener for removing rows
    $(document).on('click', '.remove-row', function() {
        $(this).closest('tr').remove();
        rowCount--;
        updateRowNumbers();
        calculateGrandTotal();
    });

    // Event listener for tax input
    $('input[name="tax"]').on('input', function() {
        taxPercentage = parseFloat($(this).val()) || 0;
        calculateGrandTotal();
    });

    // Event listener for discount type and value
    $('select[name="discount_type"]').change(function() {
        discountType = $(this).val();
        calculateGrandTotal();
    });

    $('input[name="discount_value"]').on('input', function() {
        discountValue = parseFloat($(this).val()) || 0;
        calculateGrandTotal();
    });

    // Event listener for shipping cost change
    $('input[name="shipping"]').on('input', function() {
        shippingCost = parseFloat($(this).val()) || 0;
        calculateGrandTotal();
    });
});
</script>



<script>
$("#select_sup").chosen();
</script>



<script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/libs/simplebar/simplebar.min.js"></script>
<script src="assets/libs/simple-datatables/umd/simple-datatables.js"></script>
<script src="assets/js/pages/datatable.init.js"></script>
<script src="assets/js/app.js"></script>

<script src="assets/js/pages/ecommerce-index.init.js"></script>

<script src="assets/js/pages/form-validation.js"></script>
</body>
<!--end body-->

</html>