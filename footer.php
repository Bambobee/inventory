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
                                by Mannatthemes</span>
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



</body>
<!--end body-->

</html>