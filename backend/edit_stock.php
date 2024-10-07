    <!-- Modal -->
    <div class="modal fade" id="editStock<?php echo htmlspecialchars($stock['id']); ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">

            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Stock</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="form-validation-2" action="backend/update_stock.php" method="post" class="form">
                        <input type="hidden" name="id" value="<?php echo $stock['id']; ?>">
                            <div class="mb-2">
                                <label class="form-label">Stock Batch ID</label>
                                <input class="form-control" value="<?php echo htmlspecialchars($stock['stock_id']); ?>" name="stock_id" type="text"
                                    placeholder="Enter batch number">

                            </div>
                            <div class="mb-2">
                                <label class="form-label">Select Product name</label>
                                <select class="form-select" id="select_cate" name="product_id"
                                    aria-label="Default select example">
                                    <option selected value="">Select Product name</option>
                                    <?php 
                                 
                                  foreach ($products as $index => $product): ?>
                                    <option  value="<?php echo htmlspecialchars($product['id']); ?>" <?php echo ( $product['id']  == $stock['product_id']) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($product['name']); ?></option>
                                    <?php 
                                endforeach; ?>
                                </select>

                            </div>
                            <div class="mb-2">
                                <label class="form-label">Stock level</label>
                                <input class="form-control" name="stock_level" value="<?php echo htmlspecialchars($stock['stock_level']); ?>" type="number"
                                    placeholder="Enter stock amount">

                            </div>
                            <div class="mb-2">
                                <label class="form-label">Stock alert levels</label>
                                <input class="form-control" name="stock_alert_level_figure" value="<?php echo htmlspecialchars($stock['stock_alert_level']); ?>" type="number"
                                    placeholder="Enter the minimum stock amount">

                            </div>
                            <div class="mb-2">
                                <label class="form-label">Expiry Date</label>
                                <input class="form-control" value="<?php echo htmlspecialchars($stock['expiry_date']); ?>" name="expiry_date" type="date" placeholder="Select Date">

                            </div>
                            <div class="mb-2">
                                <label class="form-label">Added at Date</label>
                                <input class="form-control" value="<?php echo htmlspecialchars($stock['created_at']); ?>" type="date" name="created_at" placeholder="Select Date">

                            </div>
                            <button type="submit" class="btn btn-primary">Submit form</button>
                        </form>
                    </div>


                </div>
            </div>
        </div>