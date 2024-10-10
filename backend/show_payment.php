<div class="modal fade" id="show<?php echo htmlspecialchars($purchase['id']); ?>" data-bs-backdrop="static"
    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Show Payments</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    <h3 class="fs-4">Payment Details</h3>
                    <p>Payment Amount: UGX <?php echo number_format($purchase['paid_amount'], 2);?></p>
                    <p>Payment Method: <?php echo htmlspecialchars($purchase['payment_method']);?></p>
                    <p>Payment Date: <?php echo htmlspecialchars($purchase['payment_date']);?></p>
                    <p>Payment Account: <?php echo htmlspecialchars($purchase['acc_number']);?></p>
                </div>

                <button type="button" class="btn btn-secondary " data-bs-dismiss="modal">Close</button>
            </div>
          
        </div>
    </div>
</div>