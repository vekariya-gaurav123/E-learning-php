<?php
if (!isset($_SESSION)) {
    session_start();
}

// use for page title and extra CSS/JS dynamic for specific page 
$page_title = "Lessons";
// $extra_css = ["../css/payment.css"];  
//$extra_js = ["./js/feedbacksliding.js"];

include('./admininclude/header.php');
include('../dbConnection.php');

if (isset($_SESSION['is_admin_login'])) {
    $adminEmail = $_SESSION['adminLogEmail'];
} else {
    echo "<script> location.href='../index.php'; </script>";
}
?>

<div class="col-sm-9 offset-md-2 mt-4">
    <!-- Search Form -->
    <form action="" method="POST" class="row g-3 align-items-end d-print-none mb-4">
        <!-- Course ID Input -->
        <div class="col-md-6 d-flex flex-row">
            <i class="fas fa-book mr-2 text-secondary" style="margin-top:12px;"></i>
            <input type="text" class="form-control rounded-3 mr-2" id="checkid" name="checkid"
                placeholder="Enter Course ID" pattern="^[0-9]+$" title="Enter only numbers" required>
            <button type="submit" class="btn btn-success rounded-3" style="width:150px;">
                <i class="fas fa-search me-2"></i> Search
            </button>
        </div>

        <!-- Search Button -->
        <div class="col-md-2 d-flex align-items-end">

        </div>
    </form>

    <?php
    if (isset($_REQUEST['checkid']) && $_REQUEST['checkid'] != "") {
        $sql = "SELECT * FROM course WHERE course_id = {$_REQUEST['checkid']}";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['course_id'] = $row['course_id'];
            $_SESSION['course_name'] = $row['course_name'];
            ?>

            <h3 class="mt-4 p-3 bg-dark text-white text-center rounded"
                style="background: linear-gradient(135deg, #28a745, #218838); border-radius: 10px 10px 0 0;">
                <i class="fas fa-id-card me-2"></i> Course ID : <?php echo $row['course_id']; ?> |
                <i class="fas fa-book me-2"></i> Course Name : <?php echo $row['course_name']; ?>
            </h3>

            <?php
            // Show lessons
            $sql = "SELECT * FROM lesson WHERE course_id = {$_REQUEST['checkid']}";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo '<div class="table-responsive mt-3">
                    <table class="table table-bordered table-striped text-center align-middle shadow-sm">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Lesson_ID</th>
                                <th scope="col">Lesson Name</th>
                                <th scope="col">Lesson Link</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>';

                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<th scope="row">' . $row["lesson_id"] . '</th>';
                    echo '<td>' . $row["lesson_name"] . '</td>';
                    echo '<td><a href="' . $row["lesson_link"] . '" target="_blank">' . $row["lesson_link"] . '</a></td>';
                    echo '<td class="d-flex flex-row">
                        <!-- Edit Button -->
                        <form action="editlesson.php" method="POST" class="d-inline">
                            <input type="hidden" name="id" value="' . $row["lesson_id"] . '">
                            <button type="submit" class="btn btn-info btn-sm mr-2" name="view" value="View">
                                <i class="fas fa-edit"></i>
                            </button>
                        </form>
                        
                        <!-- Delete Button -->
                        <form action="" method="POST" class="d-inline">
                            <input type="hidden" name="id" value="' . $row["lesson_id"] . '">
                            <button type="submit" class="btn btn-danger btn-sm" name="delete" value="Delete">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </form>
                    </td>';
                    echo '</tr>';
                }
                echo '</tbody></table></div>';
            } else {
                echo '<div class="alert alert-dark mt-4 text-center" role="alert">No Lessons Found!</div>';
            }
        } else {
            echo '<div class="alert alert-dark mt-4 text-center" role="alert">Course Not Found!</div>';
        }
    }

    // Delete Lesson
    if (isset($_REQUEST['delete'])) {
        $sql = "DELETE FROM lesson WHERE lesson_id = {$_REQUEST['id']}";
        if ($conn->query($sql) === TRUE) {
            echo '<meta http-equiv="refresh" content="0; URL=?checkid=' . $_SESSION['course_id'] . '" />';
            exit;
        } else {
            echo "<div class='alert alert-danger mt-2'>Unable to Delete Data</div>";
        }
    }
    // Add Lesson Button
    
    ?>
</div>

</div> <!-- from header -->
</div> <!-- from header -->

<?php
if (isset($_SESSION['course_id'])) {
        echo '<div>
        <a class="btn btn-success box" href="./addlesson.php">
            <i class="fas fa-plus fa-2x"></i>
        </a>
    </div>';
    }
?>
<?php include('./admininclude/footer.php'); ?>