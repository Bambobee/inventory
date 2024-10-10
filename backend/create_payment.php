<div class="modal fade" id="addBoard<?php echo htmlspecialchars($purchase['id']); ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Make Payments</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form  action="backend/submit_purchase_payment.php" method="post" class="form">
                            <input type="hidden" name="pur_id" value="<?php echo htmlspecialchars($purchase['id']); ?>">

                            <div class="mb-2">
                                <label class="form-label">Payment Date</label>
                                <input class="form-control" type="date" required name="payment_date" >
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Paying Amount</label>
                                <input class="form-control" type="number" required name="paid_amount">
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Payment Method</label>
                                <select class="form-select" name="payment_method" required required aria-label="Default select example">
                                    <option selected value="">Select payment method</option>
                                    <?php 
                                  foreach ($payment_methods as $index => $supplier): ?>
                                    <option value="<?php echo htmlspecialchars($supplier['title']); ?>">
                                        <?php echo htmlspecialchars($supplier['title']); ?></option>
                                    <?php 
                                endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Account</label>
                                <select class="form-select" name="acc_id" required required aria-label="Default select example">
                                    <option selected value="">Select an Account</option>
                                    <?php 
                              
                                  foreach ($accounts as $index => $account): ?>
                                    <option value="<?php echo htmlspecialchars($account['id']); ?>">
                                        <?php echo htmlspecialchars($account['acc_number']); ?> (<?php echo htmlspecialchars($account['balance']); ?>)</option>
                                    <?php 
                                endforeach; ?>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit form</button>
                        </form>
                    </div>


                </div>
            </div>
        </div>