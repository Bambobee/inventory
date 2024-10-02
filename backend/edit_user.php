      <!-- Modal -->
      <div class="modal fade" id="editUser<?php echo htmlspecialchars($user['id']); ?>" data-bs-backdrop="static"
          data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit User</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      <form action="backend/user_update.php" id="form-validation-2" class="form" method="post"
                          enctype="multipart/form-data">
                          <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                          <div class="mb-2">
                              <label class="form-label">User Name</label>
                              <input id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>"
                                  class="form-control" required type="text" placeholder="Enter User Name">
                          </div>
                          <div class="mb-2">
                              <label class="form-label">User Email</label>
                              <input id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>"
                                  class="form-control" required type="email" placeholder="Enter User Email">
                          </div>
                          <div class="mb-2">
                              <label class="form-label">User Contact</label>
                              <input id="contact" name="contact"
                                  value="<?php echo htmlspecialchars($user['contact']); ?>" class="form-control"
                                  required type="text" placeholder="Enter User Contact">
                          </div>
                          <div class="mb-2">
                              <label class="form-label">Date</label>
                              <input id="date" name="date" class="form-control"
                                  value="<?php echo htmlspecialchars($user['date']); ?>" required type="date"
                                  placeholder="Select Date">
                          </div>
                          <div class="mb-2">
                              <label class="form-label">Image</label>
                              <input id="image" name="image" class="form-control" type="file"><br>
                              <img src="backend/<?php echo htmlspecialchars($user['image']); ?>"
                                  style="object-fit: cover; width: 100px; " class="me-2 align-self-center rounded"
                                  alt="...">
                          </div>
                          <div class="mb-2">
                              <label class="form-label">User Role</label>
                              <select id="role" required name="role" class="form-select"
                                  aria-label="Default select example">
                                  <option value="Admin" <?php echo ($user['role'] == 'Admin') ? 'selected' : ''; ?>>
                                      Admin</option>
                                  <option value="Employee"
                                      <?php echo ($user['role'] == 'Employee') ? 'selected' : ''; ?>>Employee</option>
                              </select>
                          </div>

                          <div class="mb-2">
                              <label class="form-label">Status</label>
                              <select id="status" required name="status" class="form-select"
                                  aria-label="Default select example">
                                  <option value="Active" <?php echo ($user['status'] == 'Active') ? 'selected' : ''; ?>>
                                      Active</option>
                                  <option value="Inactive"
                                      <?php echo ($user['status'] == 'Inactive') ? 'selected' : ''; ?>>Inactive</option>
                              </select>
                          </div>

                          <div class="mb-2">
                              <label class="form-label">Address</label>
                              <textarea name="address" required class="form-control"
                                  id="address"> <?php echo htmlspecialchars($user['address']); ?></textarea>
                          </div>
                          <button type="submit" class="btn btn-primary">Submit form</button>
                      </form>
                  </div>
              </div>
          </div>
      </div>