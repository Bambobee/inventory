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
                                        <h4 class="card-title">Deposit List</h4>                      
                                    </div><!--end col-->
                                    <div class="col-auto">                                         
                                        <div class="col-auto">
                                            <button type="button" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#addBoard"><i class="fa-solid fa-plus me-1"></i> Add Deposit</button>
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
                                            <th>Account Name</th>
                                            <th>Deposit Ref</th>
                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th>Payment Method</th>
                                            <th>Description</th>
                                            <th>Proof</th>
                                            <th>Created At</th>
                                            <th class="text-end">Action</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                               
                                                
                                                <td>1</td>
                                                <td>Food</td>
                                                <td>4412225</td>
                                                <td>4412225</td>
                                                <td>4412225</td>
                                                <td>4412225</td>
                                                <td>UGX 7000</td>
                                                <td>
                                                    <span>14 Jan 2024, 10:30am</span>
                                                </td>
                                                <td>
                                                    <span>14 Jan 2024, 10:30am</span>
                                                </td>
                                                <td class="text-end">                                                       
                                                    <a href="ecommerce-products.html#"><i class="las la-pen text-secondary fs-18"></i></a>
                                                    <a href="ecommerce-products.html#"><i class="las la-trash-alt text-secondary fs-18"></i></a>
                                                </td>
                                            </tr>
                                                                                                                       
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->                                     
            </div><!-- container -->
            
                       
                <!-- Modal -->
                <div class="modal fade" id="addBoard" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        
                        
                        <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Deposit</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="form-validation-2" class="form">
                                <div class="mb-2">
                                    <label class="form-label">Account Name</label>
                                    <input class="form-control" type="text"  placeholder="Enter Account Name">
                                    <small>Error Message</small>
                                </div>
                                 <div class="mb-2">
                                    <label class="form-label">Amount</label>
                                    <input class="form-control" type="number"  placeholder="Enter Amount">
                                    <small>Error Message</small>
                                </div>
                                <div class="mb-2">
                                    <label  class="form-label">Date</label>
                                    <input class="form-control" type="date"  placeholder="Select Date">
                                    <small>Error Message</small>
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Payment Type</label>
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected>Open this select menu</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                      </select>
                                    <small>Error Message</small>
                                </div>
                                <div class="mb-2">
                                    <label  class="form-label">Proof File</label>
                                    <input class="form-control" type="file"  placeholder="Select Date">
                                    <small>Error Message</small>
                                </div>
                                <div class="mb-2">
                                    <label class="form-label"> Description</label>
                                    <textarea name="" class="form-control" id=""></textarea>
                                    <small>Error Message</small>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit form</button>
                            </form>
                        </div>
                        
                    
                    </div>
                    </div>
                </div>
            
                <?php include 'footer.php'; ?>
  