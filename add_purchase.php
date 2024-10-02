<?php include 'header.php'; ?>
  
    <div class="page-wrapper">
        <!-- Page Content-->
        <div class="page-content">
            <form action="">
            <div class="container-xxl">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h4 class="card-title">Add New Purchase</h4>
                                    </div>
                                    <!--end col-->
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </div>
                            <!--end card-header-->
                            <div class="card-body pt-0">

                                <div class="row">
                                    <div class="col-6">
                                        <label class="form-label">Date</label>
                                        <input class="form-control" type="date">

                                    </div>
                                    <div class="col-6">
                                        <label class="form-label">Supplier</label>
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected>Choose Product Name</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                        </select>

                                    </div>
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

                                    <!--end col-->
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </div>
                            <!--end card-header-->
                            <div class="card-body pt-0">
                                <div class="table-responsive">
                                    <table class="table mb-0 checkbox-all">
                                        <thead class="table-light">
                                            <tr>
                                                <th class="ps-0">S.N</th>
                                                <th>Product Name</th>
                                                <th>Unit Cost</th>
                                                <th>Quantity</th>
                                                <th>Sub Total</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>
                                                    <select class="form-select" aria-label="Default select example">
                                                        <option selected>Choose Product Name</option>
                                                        <option value="1">One</option>
                                                        <option value="2">Two</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" readonly class="form-control" />
                                                </td>
                                                <td style="display: flex;">
                                                    <span style="
                                display: flex;
                                align-items: center;
                                box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px
                                  2.6px;
                                border-radius: 50%;
                                padding: 10px;
                              ">
                                                        <i class="bx bx-plus" style="font-size: 20px;"></i></span>
                                                    <input type="number" class="mx-2" />
                                                    <span style="
                                display: flex;
                                align-items: center;
                                box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px
                                  2.6px;
                                border-radius: 50%;
                                padding: 10px;
                              ">
                                                        <i class="bx bx-minus" style="font-size: 20px;"></i></span>
                                                </td>
                                                <td>
                                                    <input type="text" readonly class="form-control" />
                                                </td>
                                                <td class="text-end">
                                                    <a href="projects-users.html#"><i
                                                            class="las la-plus text-secondary fs-18"></i></a>
                                                    <a href="projects-users.html#"><i
                                                            class="las la-trash-alt text-secondary fs-18"></i></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="offset-md-9 col-md-3 mt-4">
                                    <table class="table table-striped table-sm">
                                        <tbody>
                                            <tr>
                                                <td class="bold">Order Tax</td>
                                                <td>
                                                    <span>Ugx 200 (20.00%)</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="bold">Discount</td>
                                                <td v-if="purchase.discount_type == 'fixed'">
                                                    <span>Ugx 0.00</span>
                                                </td>
                                                <!-- <td v-else> <span>Ugx 200 (20.00%)</span></td> -->
                                            </tr>
                                            <tr>
                                                <td class="bold">Shipping</td>
                                                <td>Ugx 500</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="font-weight-bold">Grand Total</span>
                                                </td>
                                                <td>
                                                    <span class="font-weight-bold">Ugx 50000</span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
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

                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </div>
                            <!--end card-header-->
                            <div class="card-body pt-0">
                                <div class="row">

                                    <div class="form-group col-md-4">
                                        <label for="ordertax">Order Tax </label>
                                        <div class="input-group">
                                            <input type="text" class="form-control">

                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>


                                    <div class="form-group col-md-4">
                                        <label for="Discount">Discount </label>
                                        <input type="text" class="form-control">

                                        <select class="form-select">
                                            <option value="fixed">Fixed</option>
                                            <option value="percent">Percent %</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="shipping">Shipping </label>
                                        <div class="input-group">
                                            <input type="text" class="form-control">

                                            <span class="input-group-text">$</span>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <label for="note">Please provide any details </label>
                                        <textarea type="text" class="form-control" name="note" id="note"
                                            placeholder="Please provide any details"></textarea>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

         <button class="btn btn-primary">Submit</button>
        </form>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- container -->


    <!-- <footer class="footer text-center text-sm-start d-print-none">
        <div class="container-xxl">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-0 rounded-bottom-0">
                        <div class="card-body">
                            <p class="text-muted mb-0">
                                ©
                                <script>
                                    document.write(new Date().getFullYear());
                                </script>
                                Rizz
                                <span class="text-muted d-none d-sm-inline-block float-end">
                                    Crafted with
                                    <i class="iconoir-heart text-danger"></i>
                                    by Mannatthemes</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer> -->

    <!--end footer-->
    </div>
    <!-- end page content -->
    </div>
    <!-- end page-wrapper -->

    <!-- Javascript  -->
    <!-- vendor js -->

    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/simple-datatables/umd/simple-datatables.js"></script>
    <script src="assets/js/pages/datatable.init.js"></script>
    <script src="assets/js/app.js"></script>

    <script src="assets/js/pages/ecommerce-index.init.js"></script>

    <script src="assets/js/pages/form-validation.js"></script>
</body>
<!--end body-->

</html>