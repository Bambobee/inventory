<!--Start Footer-->

<footer class="footer text-center text-sm-start d-print-none">
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
                                by Denzal</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Modal -->
<div class="modal fade" id="password" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">


            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Password</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="controllerUserData.php" class="form">
                    <input type="hidden" name="email" value="<?= $_SESSION['email']; ?>">
                    <!-- Fixed the hidden input -->

                    <div class="mb-2">
                        <label class="form-label">New Password</label>
                        <input class="form-control" type="password" name="password" placeholder="Enter New Password"
                            required>
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Confirm Password</label>
                        <input class="form-control" type="password" name="cpassword" placeholder="Confirm Password"
                            required>
                    </div>

                    <button type="submit" name="changePassword" class="btn btn-primary">Submit</button>
                </form>
            </div>


        </div>
    </div>
</div>

<div class="modal fade" id="image" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Profile Picture</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form method="POST" action="controllerUserData.php" class="form" enctype="multipart/form-data">
              <input type="hidden" name="email" value="<?= $_SESSION['email']; ?>"> <!-- Fixed the hidden input -->
              <p style="color: red; ">Note: Image size should be below 2MB</p>
              <div class="mb-2">
                  <label class="form-label">Upload Image</label>
                  <input class="form-control" type="file" name="image" required>
              </div>
              <button type="submit" name="changeProfilePic" class="btn btn-primary">Submit</button>
          </form>
            </div>


        </div>
    </div>
</div>
<!--end footer-->
</div>
<!-- end page content -->
</div>
<!-- end page-wrapper -->

<!-- Javascript  -->
<!-- vendor js -->
<script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/libs/simplebar/simplebar.min.js"></script>
<script src="assets/libs/apexcharts/apexcharts.min.js"></script>
<script src="assets/js/pages/ecommerce-index.init.js"></script>
<script src="assets/js/app.js"></script>


<script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.2/js/dataTables.responsive.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.2/js/responsive.bootstrap5.js"></script>

    <script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script>

    <script>
    new DataTable('#expenses', {
        responsive: true,
    });
    </script>

<script>
    new DataTable('#deposit', {
        responsive: true,
    });
    </script>

<script>
    new DataTable('#customer', {
        responsive: true,
    });
    </script>
<script>
    new DataTable('#supplier', {
        responsive: true,
    });
    </script>
<script>
    new DataTable('#category', {
        responsive: true,
    });
    </script>

<!-- product -->
<script>
    new DataTable('#products_table', {
        responsive: true,
    });
    </script>
</body>
<!--end body-->

</html>