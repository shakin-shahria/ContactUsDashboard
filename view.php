<?php 
    session_start();
    // Fetch all products from database
    include ('db_connection.php');
    $sql = "SELECT * FROM contact_us";
    $result = $conn->query($sql);

    $filepath = 'http://localhost/Projects/CDIP/demo/uploads/';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Message View</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
</head>

<body>
<div class="container" style="padding: 10px; margin-top: 20px; border: 2px solid #000; border-radius: 2px;">
    <?php if(isset($_SESSION["success_message"])) { ?>
        <div class="alert alert-success" role="alert">
          <?php echo $_SESSION["success_message"]; ?>
        </div>
    <?php } ?>
    <div class="row">
        <div class="col-md-10">
            <h2 style="text-align: center; color: #d08c23;">MANAGE MESSAGES</h2>
        </div>
    </div>
    
    <div class="showdata">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>SL.</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>File</th>
                    <th>Comment</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                if ($result->num_rows > 0) {
                    $count = 1;
                    while($row = $result->fetch_assoc()) {
            ?>
                        <tr id="productRow-<?php echo $row["id"]; ?>" class="product-row" data-id="<?php echo $row["id"]; ?>">
                            <td><?php echo $count ?></td>
                            <td class="first_name"><?php echo $row["first_name"] ?></td>
                            <td class="last_name"><?php echo $row["last_name"] ?></td>
                            <td class="email"><?php echo $row["email"] ?></td>
                            <td>
                                <?php 
                                    $fileExtension = pathinfo($row["file"], PATHINFO_EXTENSION);
                                    if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif'])) {
                                ?>
                                        <button type="button" class="btn btn-primary btn-sm view-file-btn" data-file="<?php echo $filepath.$row["file"]; ?>">View Image</button>
                                <?php 
                                    } elseif (in_array($fileExtension, ['pdf', 'doc', 'docx'])) {
                                ?>
                                        <button type="button" class="btn btn-primary btn-sm view-file-btn" data-file="<?php echo $filepath.$row["file"]; ?>">View Document</button>
                                <?php 
                                    } else {
                                        echo "File type not supported";
                                    }
                                ?>
                            </td>
                            <td class="comment"><?php echo $row["comment"] ?></td>
                            <td>
                                <input type="button" class="btn btn-success btn-sm edit_product" value="EDIT MESSAGE" data-product-id="<?php echo $row["id"]; ?>"/>
                                <button type="button" class="btn btn-danger btn-sm delete-product-btn" data-id="<?php echo $row["id"]; ?>" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">DELETE MESSAGE</button>
                            </td>
                        </tr>
            <?php
                        $count++;
                    }
                }
            ?>
            </tbody>
        </table>
    </div>
</div>

<!-- File View Modal -->
<div class="modal fade" id="fileViewModal" tabindex="-1" aria-labelledby="fileViewModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="fileViewModalLabel">View File</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <iframe id="fileViewer" style="width: 100%; height: 80vh;" frameborder="0"></iframe>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Edit message modal -->
<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editMessageModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editMessageModalLabel">Edit Message</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editProductForm">
          <div class="mb-3">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" class="form-control" id="first_name" name="first_name">
          </div>
          <div class="mb-3">
            <label for="last_name" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="last_name" name="last_name">
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control" id="email" name="email">
          </div>
          <div class="mb-3">
            <label for="comment" class="form-label">Comment</label>
            <input type="text" class="form-control" id="comment" name="comment">
          </div>
          <input id="product_id" type="hidden" name="product_id" value="">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="saveChanges">Save changes</button>
      </div>
    </div>
  </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Deletion</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this message?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger" id="confirmDeleteButton">Delete</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable();
        $('.alert-success').delay(3000).fadeOut('slow');

        var productIdToDelete;

        // View File button click handler
        $(document).on('click', '.view-file-btn', function() {
    var fileUrl = $(this).data('file');
    var fileExtension = fileUrl.split('.').pop().toLowerCase();
    
    // Check file extension and set viewer accordingly
    if (fileExtension === 'pdf') {
        $('#fileViewer').attr('src', 'https://mozilla.github.io/pdf.js/web/viewer.html?file=' + encodeURIComponent(fileUrl));
    } else if (fileExtension === 'doc' || fileExtension === 'docx') {
        $('#fileViewer').attr('src', 'https://view.officeapps.live.com/op/view.aspx?src=' + encodeURIComponent(fileUrl));
    } else {
        // For other file types (images, etc.), set the source directly
        $('#fileViewer').attr('src', fileUrl);
    }
    
    // Show the modal
    $('#fileViewModal').modal('show');
});


        // Edit message button click handler
        $('.edit_product').on('click', function() {
            var productId = $(this).data('product-id');
            $.ajax({
                url: 'ajax_get_data.php',
                type: 'GET',
                data: { id: productId },
                success: function(data) {
                    var productData = JSON.parse(data);
                    $('#first_name').val(productData.first_name);
                    $('#last_name').val(productData.last_name);
                    $('#email').val(productData.email);
                    $('#comment').val(productData.comment);
                    $('#editProductModal').modal('show');
                    $('#product_id').val(productData.id);
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error: ' + status + error);
                }
            });
        });

        // Save Changes button click handler
        $('#saveChanges').on('click', function() {
            var formData = $('#editProductForm').serialize();
            $.ajax({
                type: 'POST',
                url: 'ajax_update_data.php',
                data: formData,
                success: function(response) {
                    var result = JSON.parse(response);
                    if (result.status === 'success') {
                        var productId = $('#product_id').val();
                        var firstName = $('#first_name').val();
                        var lastName = $('#last_name').val();
                        var email = $('#email').val();
                        var comment = $('#comment').val();

                        var row = $('#productRow-' + productId);
                        row.find('.first_name').text(firstName);
                        row.find('.last_name').text(lastName);
                        row.find('.email').text(email);
                        row.find('.comment').text(comment);

                        $('#editProductModal').modal('hide');
                        alert('Message updated successfully!');
                    } else {
                        alert('Failed to update message: ' + result.message);
                    }
                },
                error: function() {
                    console.log('Error submitting form data.');
                }
            });
        });

        // Delete Product button click handler
        $(document).on('click', '.delete-product-btn', function() {
        productIdToDelete = $(this).data('id');
    });

    // Confirm Delete button click handler
    $('#confirmDeleteButton').on('click', function() {
        $.ajax({
            url: 'delete_product.php',
            type: 'POST',
            data: { id: productIdToDelete },
            success: function(response) {
                if (response.trim() === 'success') {
                    $('#productRow-' + productIdToDelete).remove();
                    $('#confirmDeleteModal').modal('hide');
                    alert('Message deleted successfully!');
                } else {
                    alert('Message deleted.');
                }
            },
            error: function() {
                alert('Error deleting message.');
            }
        });
    });
});
</script>

</body>
</html>
