<?php
if (!isset($_SESSION)) {
    session_start();
}

// use for page title and extra CSS/JS dynamic for specific page 
$page_title = "Admin Dashboard";
// $extra_css = ["../css/payment.css"];  
//$extra_js = ["./js/feedbacksliding.js"];

include('./admininclude/header.php');
include('../dbConnection.php');

if (isset($_SESSION['is_admin_login'])) {
    $adminEmail = $_SESSION['adminLogEmail'];
} else {
    echo "<script>location.href='../index.php';</script>";
}

$sql = "SELECT * FROM course";
$result = $conn->query($sql);
$totalcourse = $result->num_rows;

$sql = "SELECT * FROM student";
$result = $conn->query($sql);
$totalstu = $result->num_rows;

$sql = "SELECT * FROM courseorder";
$result = $conn->query($sql);
$totalsold = $result->num_rows;
?>

<div class="container mt-4 offset-md-2">
    <div class="row">
        <!-- Dashboard Cards -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header text-white text-center"
                     style="background: linear-gradient(135deg, #dc3545, #c82333);">
                    <h5 class="mb-0"><i class="fas fa-book"></i> Courses</h5>
                </div>
                <div class="card-body text-center">
                    <h4 class="card-title"><?php echo $totalcourse; ?></h4>
                    <a class="btn btn-danger btn-sm" href="courses.php">View</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header text-white text-center"
                     style="background: linear-gradient(135deg, #343a40d5, #23272b);">
                    <h5 class="mb-0"><i class="fas fa-user-graduate"></i> Students</h5>
                </div>
                <div class="card-body text-center">
                    <h4 class="card-title"><?php echo $totalstu; ?></h4>
                    <a class="btn btn-dark btn-sm" href="students.php">View</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header text-white text-center"
                     style="background: linear-gradient(135deg, #17a2b8, #117a8b);">
                    <h5 class="mb-0"><i class="fas fa-shopping-cart"></i> Sold</h5>
                </div>
                <div class="card-body text-center">
                    <h4 class="card-title"><?php echo $totalsold; ?></h4>
                    <a class="btn btn-info btn-sm" href="sellreport.php">View</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Orders Table -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header text-white"
                    style="background: linear-gradient(135deg, #28a745, #218838); border-radius: 10px 10px 0 0;">
                    <h5 class="mb-0 text-center"><i class="fas fa-clipboard-list"></i> Course Orders</h5>
                </div>
                <div class="card-body">
                    <?php
                    $sql = "SELECT * FROM courseorder ORDER BY order_date DESC";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        echo '<div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">Order ID</th>
                                            <th scope="col">Course ID</th>
                                            <th scope="col">Student Email</th>
                                            <th scope="col">Order Date</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                        while ($row = $result->fetch_assoc()) {
                            echo '<tr>';
                            echo '<th scope="row">' . $row['order_id'] . '</th>';
                            echo '<td>' . $row['course_id'] . '</td>';
                            echo '<td>' . $row['stu_email'] . '</td>';
                            echo '<td>' . $row['order_date'] . '</td>';
                            echo '<td>' . $row['amount'] . '</td>';
                            echo '<td>
                                    <form action="" method="POST" class="d-inline">
                                        <input type="hidden" name="id" value="' . $row["order_id"] . '">
                                        <button type="submit" class="btn btn-sm btn-danger" name="delete" value="Delete">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                  </td>';
                            echo '</tr>';
                        }
                        echo '</tbody></table></div>';
                    } else {
                        echo "<p class='text-muted mb-0'>No course orders found.</p>";
                    }

                    if (isset($_REQUEST['delete'])) {
                        $sql = "DELETE FROM courseorder WHERE order_id = '{$_REQUEST['id']}'";
                        if ($conn->query($sql) === TRUE) {
                            echo '<meta http-equiv="refresh" content="0;URL=?deleted" />';
                        } else {
                            echo "<p class='text-danger'>Unable to Delete</p>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div> <!-- div Row close from header -->
</div> <!-- div Container-fluid close from header -->
<?php
include('./admininclude/footer.php');
?>