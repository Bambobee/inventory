<?php
   include 'header.php';
?>
  
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
                                        <h4 class="card-title">Customer</h4>                      
                                    </div><!--end col-->
                                    <div class="col-auto">                                         
                                        <div class="col-auto">
                                            <button type="button" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#addBoard"><i class="fa-solid fa-plus me-1"></i> Add Customer</button>
                                          </div>
                                    </div><!--end col-->
                                </div><!--end row-->                                  
                            </div><!--end card-header-->
                            <div class="card-body pt-0">
                                
                                <div class="table-responsive">
                                    <table class="table mb-0" id="datatable_1">
                                        <thead class="table-light">
                                          <tr>
                                            <th>S.N</th>
                                            <th>Name</th>
                                            <th>Contact</th>
                                            <th>Added Date</th>
                                            <th>Total Sales Due</th>
                                            <th>Total Sales Due Returned</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>#9958</td>
                                                <td class="d-flex align-items-center">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-grow-1 text-truncate"> 
                                                            <h6 class="m-0">Unity Pugh</h6>
                                                            <a href="#" class="fs-12 text-primary">dummy@gmail.com</a>                                                                                           
                                                        </div><!--end media body-->
                                                    </div>
                                                </td>
                                                
                                                <td><a href="#" class="text-body text-decoration-underline">075225855</a></td>
                                                <td>9/25/2024</td>
                                                <td>ugx 1000</td>
                                                <td>ugx 1000</td>
                                                <td><span class="badge rounded text-success bg-success-subtle">Active</span></td>
                                                <td class="text-end">                                                       
                                                    <a href="projects-users.html#"><i class="las la-pen text-secondary fs-18"></i></a>
                                                    <a href="projects-users.html#"><i class="las la-trash-alt text-secondary fs-18"></i></a>
                                                </td>
                                            </tr>
                                            <!-- <td><span class="badge rounded text-secondary bg-secondary-subtle">Inactive</span></td> -->
                                            
                                                                                                                           
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
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Customer</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="form-validation-2" class="form">
                                <div class="mb-2">
                                    <label class="form-label">User Name</label>
                                    <input class="form-control" type="text"  placeholder="Enter User Name">
                                    <small>Error Message</small>
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">User Email</label>
                                    <input class="form-control" type="email"  placeholder="Enter User Email">
                                    <small>Error Message</small>
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Contact</label>
                                    <input class="form-control" type="text"  placeholder="Enter User Contact">
                                    <small>Error Message</small>
                                </div>
                                <div class="mb-2">
                                    <label  class="form-label">Date</label>
                                    <input class="form-control" type="date"  placeholder="Select Date">
                                    <small>Error Message</small>
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Status</label>
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected>Open this select menu</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                      </select>
                                    <small>Error Message</small>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit form</button>
                            </form>
                        </div>
                        
                    
                    </div>
                    </div>
                </div>
            
                <?php
   include 'footer.php';
?>