<?php
if (!isset($_SESSION)) {
    session_start();
}

// use for page title and extra CSS/JS dynamic for specific page 
$page_title = "My Courses";
// $extra_css = ["../css/payment.css"];  
//$extra_js = ["./js/feedbacksliding.js"];

include('./stuInclude/header.php');
include('../dbConnection.php');

if (isset($_SESSION['is_login'])) {
    $stuEmail = $_SESSION['stuLogEmail'];
} else {
    echo "<script> location.href='../index.php';</script>";
}
?>
<div class="col-sm-10 offset-sm-2 mt-5">
    <!-- Page Heading -->

    <div class="card-header text-white text-center rounded-top-4" style="background: linear-gradient(135deg, #28a745, #218838); border-radius: 10px 10px 0 0;">
        <h3 class="mb-0"><i class="fas fa-book me-2"></i> My Enrolled Courses</h3>
    </div>

    <?php
    if (isset($stuLogEmail)) {
        $sql = "SELECT co.order_id, c.course_id, c.course_name, c.course_duration, 
               c.course_desc, c.course_img, c.course_author, 
               c.course_original_price, c.course_price 
        FROM courseorder AS co 
        JOIN course AS c ON c.course_id = co.course_id 
        WHERE co.stu_email = '$stuLogEmail' 
        ORDER BY co.order_date DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) { ?>

                <!-- Course Card -->
                <div class="card mb-4 shadow-sm border-0 rounded-3">
                    <h5 class="card-header bg-light fw-bold text-dark">
                        <?php echo $row['course_name']; ?>
                    </h5>
                    <div class="row g-0 align-items-center">
                        <!-- Image -->
                        <div class="col-sm-4">
                            <img src="<?php echo $row['course_img']; ?>" class="card-img p-2 rounded-3" alt="Course image" style="height:200px; width:100%; object-fit:cover; object-position:center;">
                        </div>

                        <!-- Details -->
                        <div class="col-sm-8">
                            <div class="card-body">
                                <p class="card-text text-muted"><?php echo $row['course_desc']; ?></p>
                                <p class="mb-1"><i class="fas fa-clock me-1"></i> Duration:
                                    <strong><?php echo $row['course_duration']; ?></strong>
                                </p>
                                <p class="mb-1"><i class="fas fa-user me-1"></i> Instructor:
                                    <strong><?php echo $row['course_author']; ?></strong>
                                </p>
                                <p class="mt-2 mb-2">Price:
                                    <small class="text-muted"><del>&#8377;
                                            <?php echo $row['course_original_price']; ?></del></small>
                                    <span class="fw-bold text-dark">&#8377; <?php echo $row['course_price']; ?></span>
                                </p>

                                <!-- Watch Button -->
                                <a href="watchcourse.php?course_id=<?php echo $row['course_id']; ?>"
                                    class="btn btn-success float-right px-4 mb-2">
                                    <i class="fas fa-play-circle me-1"></i> Watch Course
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            <?php }
        } else {
            echo "<p class='text-center text-muted'>No courses enrolled yet.</p>";
        }
    }
    ?>
</div>

</div> <!-- Close  Row Div from header file-->
</div> <!-- Close  Row Div from header file-->
<?php
include('./stuInclude/footer.php');
?>