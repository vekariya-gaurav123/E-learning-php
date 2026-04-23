<?php
if(!isset($_SESSION)) {
    session_start();
}

// use for page title and extra CSS/JS dynamic for specific page 
$page_title = "Admin Feedback";
// $extra_css = ["../css/payment.css"];  
//$extra_js = ["./js/feedbacksliding.js"];

include('./adminInclude/header.php');
include_once('../dbConnection.php');

if(isset($_SESSION['is_admin_login'])){
   $adminEmail = $_SESSION['adminLogEmail']; // ✅ fixed variable mismatch
} else {
    echo "<script> location.href='../index.php'; </script>";
}
?>

<div class="col-sm-9 offset-md-2 mt-4">
    <!-- Card Wrapper -->
    <div class="card shadow">
        <!-- Card Header -->
        <div class="card-header text-white"
            style="background: linear-gradient(135deg, #28a745, #218838); border-radius: 10px 10px 0 0;">
            <h4 class="mb-0 text-center">
                <i class="fas fa-comment-dots me-2"></i> List of Feedbacks
            </h4>
        </div>

        <!-- Card Body -->
        <div class="card-body">
            <?php
                $sql = "SELECT * FROM feedback";
                $result = $conn->query($sql);
                if($result->num_rows > 0) {
            ?>
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Feedback_ID</th>
                            <th scope="col">Content</th>
                            <th scope="col">Student</th>
                            <th scope="col" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <th scope="row"><?= $row["f_id"]; ?></th>
                            <td><?= $row["f_content"]; ?></td>
                            <td><?= $row["stu_id"]; ?></td>
                            <td class="text-center">
                                <!-- Delete button -->
                                <form action="" method="POST" class="d-inline">
                                    <input type="hidden" name="id" value="<?= $row['f_id']; ?>">
                                    <button type="submit" class="btn btn-sm btn-danger" 
                                            name="delete" value="Delete" title="Delete Feedback">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <?php 
                } else {
                    echo "<p class='text-center text-muted'>No feedback available.</p>";
                }

                if(isset($_REQUEST['delete'])) {
                    $sql = "DELETE FROM feedback WHERE f_id = {$_REQUEST['id']}";
                    if($conn->query($sql) === TRUE){
                        echo '<meta http-equiv="refresh" content="0;URL=?deleted" />';
                    } else {
                        echo "<div class='alert alert-danger'>Unable to delete feedback</div>";
                    }
                }
            ?>
        </div>
    </div>
</div>

</div> <!-- div Row close from header -->
</div> <!-- div Container-fluid close from header -->

<?php
include('./adminInclude/footer.php');
?>
