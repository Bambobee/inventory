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
                                        <h4 class="card-title">Units</h4>                      
                                    </div><!--end col-->
                                    <div class="col-auto">                                         
                                        <div class="col-auto">
                                            <button type="button" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#addBoard"><i class="fa-solid fa-plus me-1"></i> Add Unit</button>
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
                                            <th>Short Name</th>
                                            <th>Base Unit</th>
                                            <th>Operator Value</th>
                                            <th>Operator</th>
                                            <th>Action</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>#9958</td>
                                                                                              
                                                <td>Grams</td>
                                                <td>g</td>
                                                <td>Kilogram</td>
                                                <td>1000</td>
                                                <td>/</td>
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
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Unit</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="form-validation-2" class="form">
                                <div class="mb-2">
                                    <label class="form-label">Name</label>
                                    <input class="form-control" type="text"  placeholder="Enter User Name">
                                    <small>Error Message</small>
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Short Name</label>
                                    <input class="form-control" type="text"  placeholder="Enter User Short Name">
                                    <small>Error Message</small>
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Base Unit</label>
                                    <input class="form-control" type="text"  placeholder="Enter Base Unit">
                                    <small>Error Message</small>
                                </div>
                                <div class="mb-2">
                                    <label  class="form-label">Operator</label>
                                    <input class="form-control" type="text"  placeholder="ENter Operator">
                                    <small>Error Message</small>
                                </div>
                                <div class="mb-2">
                                    <label  class="form-label">Operator Value</label>
                                    <input class="form-control" type="number"  placeholder="Enter Operator Value">
                                    <small>Error Message</small>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit form</button>
                            </form>
                        </div>
                        
                    
                    </div>
                    </div>
                </div>
            
                <?php include 'footer.php'; ?>
  