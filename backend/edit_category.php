 <!-- Modal -->
 <div class="modal fade" id="editCategory<?php echo htmlspecialchars($category['id']); ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Category</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="form-validation-2" action="backend/update_category.php" method="post"  class="form">
                        <input type="hidden" name="id" value="<?php echo $category['id']; ?>">
                            <div class="mb-2">
                                <label class="form-label">Categories Name</label>
                                <input class="form-control" type="text" value="<?php echo htmlspecialchars($category['name']); ?>"  name="name" >
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Date</label>
                                <input class="form-control" type="date" value="<?php echo htmlspecialchars($category['date']); ?>" name="date" >
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Categories Description</label>
                                <textarea name="description" class="form-control"> <?php echo htmlspecialchars($category['description']); ?></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit form</button>
                        </form>
                    </div>


                </div>
            </div>
        </div>
