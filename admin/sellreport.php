<?php
if (!isset($_SESSION)) {
    session_start();
}

// use for page title and extra CSS/JS dynamic for specific page 
$page_title = "Sellreport";
// $extra_css = ["../css/payment.css"];  
//$extra_js = ["./js/feedbacksliding.js"];

include('./adminInclude/header.php');
include('../dbConnection.php');

if (isset($_SESSION['is_admin_login'])) {
    $adminEmail = $_SESSION['adminLogEmail'];
} else {
    echo "<script> location.href='../index.php';</script>";
}
?>

<div class="col-sm-9 mt-4 offset-md-2">
    <!-- Search Form -->
    <form action="" method="POST" class="d-print-none">
        <div class="form-row align-items-center">
            <!-- Start Date -->
            <div class="form-group col-md-3">
                <label for="startdate" class="font-weight-bold">
                    <i class="fas fa-calendar-alt"></i> Start Date
                </label>
                <input type="date" class="form-control" id="startdate" name="startdate" required>
            </div>

            <!-- TO Label -->
            <div class="col-md-1 text-center mt-2 font-weight-bold">TO</div>

            <!-- End Date -->
            <div class="form-group col-md-3">
                <label for="enddate" class="font-weight-bold">
                    <i class="fas fa-calendar-check"></i> End Date
                </label>
                <input type="date" class="form-control" id="enddate" name="enddate" required>
            </div>

            <!-- Search Button -->
            <div class="form-group col-md-2 d-flex align-items-end" style="margin-top:30px;"> 
                <button type="submit" class="btn btn-success btn-block" name="searchsubmit">
                    <i class="fas fa-search"></i> Search
                </button>
            </div>
        </div>
    </form>

    <?php
    if (isset($_REQUEST['searchsubmit'])) {
        $startdate = $_REQUEST['startdate'];
        $enddate = $_REQUEST['enddate'];

        $sql = "SELECT * FROM courseorder WHERE order_date BETWEEN '$startdate' AND '$enddate'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo '
            <h4 class="text-white text-center p-2 mt-4 rounded" style="background: linear-gradient(135deg, #28a745, #218838);">Order Details</h4>
            <div class="table-responsive">
                <table class="table table-bordered table-striped text-center">
                    <thead class="thead-dark">
                        <tr>
                            <th>Order ID</th>
                            <th>Course ID</th>
                            <th>Student Email</th>
                            <th>Course Name</th>
                            <th>Amount</th>
                            <th>Order Date</th>
                        </tr>
                    </thead>
                    <tbody>';
            
            while ($row = $result->fetch_assoc()) {
                echo '<tr>
                    <td>' . $row["order_id"] . '</td>
                    <td>' . $row["course_id"] . '</td>
                    <td>' . $row["stu_email"] . '</td>
                    <td>' . $row["course_name"] . '</td>
                    <td>₹ ' . $row["amount"] . '</td>
                    <td>' . $row["order_date"] . '</td>
                </tr>';
            }

            echo '</tbody></table></div>';
            echo '<div class="d-print-none text-center mb-3">
                <button class="btn btn-success" onclick="window.print()">
                    <i class="fas fa-print"></i> Print
                </button>
            </div>';
        } else {
            echo "<div class='alert alert-warning col-sm-6 mx-auto mt-3 text-center'>
                <i class='fas fa-exclamation-circle'></i> No Records Found!
            </div>";
        }
    }
    ?>
</div>

</div> <!-- div row close from header -->
</div> <!-- div container-fluid close from header-->

<?php
include('./adminInclude/footer.php');
?>