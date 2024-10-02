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
                                        <h4 class="card-title">Products</h4>                      
                                    </div><!--end col-->
                                    <div class="col-auto">                                         
                                        <div class="col-auto">
                                            <button type="button" class="btn btn-primary"  data-bs-toggle="modal" data-bs-target="#addBoard"><i class="fa-solid fa-plus me-1"></i> Add Product</button>
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
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>Product Cost</th>
                                            <th> Selling Price</th>
                                            <th>Suplier</th>
                                            <th>Unit</th>
                                            <th>Status</th>
                                            <th class="text-end">Action</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                               
                                                
                                                <td>1</td>
                                                <td>Food</td>
                                                <td>jghgjhngbh</td>
                                                <td>UGX 1200</td>
                                                <td>UGX 1300</td>
                                                <td>rfdrf</td>
                                                <td>Kilogram</td>
                                                <td>Active</td>
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
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Product</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="form-validation-2" class="form">
                                <div class="mb-2">
                                    <label class="form-label"> Name</label>
                                    <input class="form-control" type="text"  placeholder="Enter Product Name">
                                    <small>Error Message</small>
                                </div>
                                <div class="mb-2">
                                    <label  class="form-label">Category</label>
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected>Select category Name</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                      </select>
                                    <small>Error Message</small>
                                </div>
                                <div class="mb-2">
                                    <label class="form-label"> Price</label>
                                    <input class="form-control" type="number"  placeholder="Enter Product price">
                                    <small>Error Message</small>
                                </div>
                                <div class="mb-2">
                                    <label  class="form-label">Suplier</label>
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected>Select Suplier Name</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                      </select>
                                    <small>Error Message</small>
                                </div>
                                <div class="mb-2">
                                    <label  class="form-label">Unit</label>
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected>Select Unit Price</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                      </select>
                                    <small>Error Message</small>
                                </div>
                                <div class="mb-2">
                                    <label  class="form-label">Status</label>
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected>Select status</option>
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
            
                <?php include 'footer.php'; ?>
  