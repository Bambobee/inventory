   <!-- Modal -->
   <div class="modal fade" id="editAccount<?php echo htmlspecialchars($account['id']); ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Account Information</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="backend/update_account.php" method="post" id="form-validation-2" class="form">
                            
                          <input type="hidden" name="id" value="<?php echo $account['id']; ?>">
                            <div class="mb-2">
                                <label class="form-label">Account Name</label>
                                <input class="form-control" name="acc_name" type="text" value="<?php echo htmlspecialchars($account['acc_name']); ?>" required
                                    placeholder="Enter Account Name">
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Account Number</label>
                                <input class="form-control" name="acc_number" value="<?php echo htmlspecialchars($account['acc_number']); ?>" type="text" required
                                    placeholder="Enter Account Number">
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Amount</label>
                                <input class="form-control" name="balance" type="number" value="<?php echo htmlspecialchars($account['balance']); ?>" required
                                    placeholder="Enter Account Balance">
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Date</label>
                                <input class="form-control" required name="created_at" value="<?php echo htmlspecialchars($account['created_at']); ?>" type="date" placeholder="Select Date">
                            </div>

                            <button type="submit" class="btn btn-primary">Submit form</button>
                        </form>
                    </div>


                </div>
            </div>
        </div>