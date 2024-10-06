<!-- Modal -->
<div class="modal fade" id="editProduct<?php echo htmlspecialchars($product['id']); ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">


                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Product</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="form-validation-2" action="backend/update_product.php" method="post"  class="form">
                        <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                            <div class="mb-2">
                                <label class="form-label"> Name</label>
                                <input class="form-control" value="<?php echo htmlspecialchars($product['name']); ?>" name="name" type="text" placeholder="Enter Product Name">
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Category</label>
                                <select class="form-select" name="category" id="select_cate" aria-label="Default select example">
                                    <option selected value="">Select category Name</option>
                                    <?php 
                                  foreach ($categories as $index => $category): ?>
                                    <option value="<?php echo htmlspecialchars($category['name']); ?>" <?php echo ( $category['name']  == $product['category']) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($category['name']); ?></option>
                                    <?php 
                                endforeach; ?>
                                </select>
                                </select>
                            </div>
                            <div class="mb-2">
                                <label class="form-label">product Cost</label>
                                <input class="form-control" value="<?php echo htmlspecialchars($product['product_cost']); ?>" name="product_cost" type="number" placeholder="Enter Product Cost">
                            </div>
                            <div class="mb-2">
                                <label class="form-label">selling Price</label>
                                <input class="form-control" value="<?php echo htmlspecialchars($product['selling_price']); ?>" name="selling_price" type="number" placeholder="Enter Product price">
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Suplier</label>
                                <select class="form-select" id="sup_select" name="supplier_id" aria-label="Default select example">
                                    <option selected value="">Select Suplier Name</option>
                                    <?php 
                                  foreach ($suppliers as $index => $supplier): ?>
                                    <option value="<?php echo htmlspecialchars($supplier['id']); ?>" <?php echo ( $supplier['id']  == $product['supplier_id']) ? 'selected' : ''; ?>>
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
                                  foreach ($units as $index => $unit): ?>
                                    <option value="<?php echo htmlspecialchars($unit['base_unit']); ?>" <?php echo ( $unit['base_unit']  == $product['unit']) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($unit['base_unit']); ?></option>
                                    <?php 
                                endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Status</label>
                                <select class="form-select" name="status" aria-label="Default select example">
                                    <option selected value="">Select status</option>
                                    <option value="Active" <?php echo ($product['status'] == 'Active') ? 'selected' : ''; ?>>Active</option>
                            <option value="Inactive"
                                <?php echo ($product['status'] == 'Inactive') ? 'selected' : ''; ?>>Inactive</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit form</button>
                        </form>
                    </div>


                </div>
            </div>
        </div>