<?php
if (!isset($_SESSION)) {
    session_start();
}

// use for page title and extra CSS/JS dynamic for specific page 
$page_title = "Admin Students";
// $extra_css = ["../css/payment.css"];  
//$extra_js = ["./js/feedbacksliding.js"];

include('./admininclude/header.php');
include('../dbConnection.php');

if (isset($_SESSION['is_admin_login'])) {
    $adminEmail = $_SESSION['adminLogEmail'];   // ✅ fixed missing semicolon
} else {
    echo "<script>location.href='../index.php';</script>";
}
?>

<div class="col-sm-9 offset-md-2 mt-4">
    <!-- Card Wrapper -->
    <div class="card shadow">
        <!-- Card Header -->
        <div class="card-header text-white"
            style="background: linear-gradient(135deg, #28a745, #218838); border-radius: 10px 10px 0 0;">
            <h4 class="mb-0 text-center"><i class="fas fa-user-graduate me-2"></i> List of Students</h4>
        </div>

        <!-- Card Body -->
        <div class="card-body">
            <?php
            $sql = "SELECT * FROM student order by stu_id desc";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                ?>
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Student ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result->fetch_assoc()) { ?>
                                <tr>
                                    <th scope="row"><?= $row['stu_id']; ?></th>
                                    <td><?= $row['stu_name']; ?></td>
                                    <td><?= $row['stu_email']; ?></td>
                                    <td class="text-center">
                                        <!-- Edit button -->
                                        <form action="editstudent.php" method="POST" class="d-inline">
                                            <input type="hidden" name="id" value="<?= $row['stu_id']; ?>">
                                            <button type="submit" class="btn btn-sm btn-info me-2" name="view" value="view"
                                                title="Edit Student">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </form>

                                        <!-- Delete button -->
                                        <form action="" method="POST" class="d-inline">
                                            <input type="hidden" name="id" value="<?= $row['stu_id']; ?>">
                                            <button type="submit" class="btn btn-sm btn-danger" name="delete" value="delete"
                                                title="Delete Student">
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
                echo "<p class='text-center text-muted'>No students found.</p>";
            }

            // ✅ Handle delete action
            if (isset($_REQUEST['delete'])) {
                $sql = "DELETE FROM student WHERE stu_id = {$_REQUEST['id']}";
                if ($conn->query($sql) === TRUE) {
                    echo '<meta http-equiv="refresh" content="0;URL=?deleted" />';
                } else {
                    echo "<div class='alert alert-danger'>Unable to delete data</div>";
                }
            }
            ?>
        </div>
    </div>
</div>

</div><!-- div Container-fluid close from header -->
</div><!-- div Container-fluid close from header -->


<!-- Add Lesson Button -->
<div>
    <a class="btn btn-success box" href="./addnewstudent.php">
        <i class="fas fa-plus fa-2x"></i>
    </a>
</div>

<?php
include('./admininclude/footer.php');
?>