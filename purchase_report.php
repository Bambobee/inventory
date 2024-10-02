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
                                        <h4 class="card-title">Purchase Report</h4>
                                    </div>
                                    <!--end col-->
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </div>
                            <!--end card-header-->
                            <div class="card-body pt-0">

                                <div class="row">
                                    <div class="col-4">
                                        <label class="form-label">Purchase I.D</label>
                                        <input class="form-control" type="text">

                                    </div>
                                    <div class="col-4">
                                        <label class="form-label">Supplier</label>
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected>Choose Product Name</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                        </select>

                                    </div>
                                    <div class="col-4">
                                        <label class="form-label">Month</label>
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected>Choose Product Name</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                        </select>

                                    </div>
                                    <div class="col-4">
                                        <label class="form-label">Year</label>
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected>Choose Product Name</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                        </select>

                                    </div>
                                    <div class="col-4">
                                        <label class="form-label">Date</label>
                                        <input class="form-control" type="date">

                                    </div>
                                    
                                </div>
                                <div class="col-4 mt-2 row" style="gap: 10px ">
                                    <button class="btn btn-primary col-4">Filter</button>
                                    <button class="btn btn-danger col-4">Reset</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col">        
                                        <button class="btn btn-primary">PDF</button>                    
                                        <button class="btn btn-secondary">EXCEL</button>                    
                                    </div><!--end col-->
                                   <!--end col-->
                                </div><!--end row-->                                  
                            </div><!--end card-header-->
                            <div class="card-body pt-0">
                                
                                <div class="table-responsive">
                                    <table class="table mb-0 checkbox-all" id="datatable_1">
                                        <thead class="table-light">
                                          <tr>
                                           
                                            <th class="ps-0">S.N</th>
                                            <th>Date </th>
                                            <th>Purcahse I.D</th>
                                            <th>Supplier</th>
                                            <th>Grand Total</th>
                                            <th>Paid </th>
                                            <th>Due</th>
                                            <th>Payment Status</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>14 Jan 2024</td>
                                                <td>REF_dsfs144</td>
                                                <td>cdsdfsd</td>
                                                <td>Ugx 40000</td>
                                                <td>Ugx 0</td>
                                                <td>Ugx 40000</td>
                                                
                                                <td><span class="badge rounded text-danger bg-success-subtle">Unpaid</span></td>
                                               
                                            </tr>
                                                                                                                       
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Grand Total:</th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th>UGX 400</th>
                                                <th>UGX 400</th>
                                                <th>UGX 400</th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->                                     
            </div><!-- container -->
            
            <?php include 'footer.php'; ?>
  