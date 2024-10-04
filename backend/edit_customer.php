       <!-- Modal -->
       <div class="modal fade" id="editCustomer<?php echo htmlspecialchars($customer['id']); ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Customer</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="backend/update_customer.php" method="post" id="form-validation-2" class="form">
                        <input type="hidden" name="id" value="<?php echo $customer['id']; ?>">
                            <div class="mb-2">
                                <label class="form-label">Name</label>
                                <input class="form-control" value="<?php echo htmlspecialchars($customer['name']); ?>" name="name" type="text" >
                            </div>
                            <div class="mb-2">
                                <label class="form-label">User Email</label>
                                <input class="form-control" value="<?php echo htmlspecialchars($customer['email']); ?>" name="email" type="email" >
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Total Sales Due</label>
                                <input class="form-control" value="<?php echo htmlspecialchars($customer['total_sale_due']); ?>" name="total_sale_due" type="number" >
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Total Sale Due Returned</label>
                                <input class="form-control" value="<?php echo htmlspecialchars($customer['total_sales_due_returned']); ?>" name="total_sales_due_returned" type="number">
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Contact</label>
                                <input class="form-control" value="<?php echo htmlspecialchars($customer['contact']); ?>" name="contact" type="text" >
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Date</label>
                                <input class="form-control" value="<?php echo htmlspecialchars($customer['added_date']); ?>" name="added_date" type="date">         
                                       </div>
                            <div class="mb-2">
                                <label class="form-label">Status</label>
                                <select class="form-select" name="status" aria-label="Default select example">
                                    <option selected value=" ">Open from this select menu</option>
                                    <option value="Active" <?php echo ($customer['status'] == 'Active') ? 'selected' : ''; ?>>Active</option>
                                  <option value="Inactive"
                                      <?php echo ($customer['status'] == 'Inactive') ? 'selected' : ''; ?>>Inactive</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit form</button>
                        </form>
                    </div>


                </div>
            </div>
        </div>

