<?php include 'header.php'; ?>
  
  
    <div class="page-wrapper">

        <!-- Page Content-->
        <div class="page-content">
            <div class="container-xxl"> 
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col">                      
                                        <h4 class="card-title">Purchases Returned</h4>                      
                                    </div><!--end col-->
                                    <div class="col-auto">                                         
                                        <div class="col-auto">
                                            <a href="add_purchase_returned.html" class="btn btn-primary">Add Purchase Returned</a>
                                          </div>
                                    </div><!--end col-->
                                </div><!--end row-->                                  
                            </div><!--end card-header-->
                            <div class="card-body pt-0">
                                
                                <div class="table-responsive">
                                    <table class="table mb-0 checkbox-all" id="datatable_1">
                                        <thead class="table-light">
                                          <tr>
                                           
                                            <th class="ps-0">S.N</th>
                                            <th>Date </th>
                                            <th>Purchase I.D</th>
                                            <th>Supplier</th>
                                            <th>Grand Total</th>
                                            <th>Paid </th>
                                            <th>Due</th>
                                            <th>Payment Status</th>
                                            <th class="text-end">Action</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>14 Jan 2024</td>
                                                <td>REF_dsfs144</td>
                                                <td>Fruit Supplier</td>
                                                <td>Ugx 40000</td>
                                                <td>Ugx 0</td>
                                                <td>Ugx 40000</td>
                                                
                                                <td><span class="badge rounded text-danger bg-success-subtle">Unpaid</span></td>
                                               
                                                <td class="text-end">                                                       
                                                  <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                      <i class='bx bx-dots-vertical-rounded'></i>
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                      <li><a class="dropdown-item" href="#">Edit Purchase</a></li>
                                                      <li><a class="dropdown-item" href="#">Purchase Details</a></li>
                                                      <li><a class="dropdown-item" href="#">Show Payments</a></li>
                                                      <li><a class="dropdown-item" href="#">Create Payments</a></li>
                                                      <li><a class="dropdown-item" href="#">Download PDF</a></li>
                                                      <li><a class="dropdown-item" href="#">Delete Purchase</a></li>
                                                    </ul>
                                                  </div>
                                                </td>
                                            </tr>
                                                                                                                       
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->                                     
            </div>
            <!-- container -->
            <?php include 'footer.php'; ?>
  