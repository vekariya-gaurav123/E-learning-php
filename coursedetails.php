<?php

// use for page title and extra CSS/JS dynamic for specific page 
$page_title = "Course Details";
// $extra_css = ["../css/payment.css"];  
//$extra_js = ["./js/feedbacksliding.js"];

include('./mainInclude/header.php');
include('./dbConnection.php');
?>

<!-- start main-content of coursedetails page -->
<div class="container mt-4">
    <?php
    if (isset($_GET['course_id'])) {
        $course_id = $_GET['course_id'];
        $_SESSION['course_id'] = $course_id; // for payment purpose 
    
        $sql = "SELECT * FROM course WHERE course_id = '$course_id'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        // Store course name for checkout - added by jeel 
        $_SESSION['course_name'] = $row['course_name'];
    }
    ?>

    <div class="row p-2" style="border:2px solid black">
        <div class="col-md-4">
            <img src="<?php echo str_replace('..', '.', $row['course_img']) ?>" alt="course" class="card-img-top"
                style="height:200px; width:100%; object-fit:cover; object-position:center;" />
        </div>

        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title">
                    Course Name : <?php echo $row['course_name'] ?>
                </h5>
                <p class="card-text">
                    <?php echo $row['course_desc'] ?>
                </p>
                <p class="card-text">
                    Duration(In Hours) : <?php echo $row['course_duration'] ?>
                </p>

                <form action="checkout.php" method="post">
                    <p class="card-text d-inline">
                        Price :
                        <small>
                            <del>&#8377 <?php echo $row['course_original_price'] ?></del>
                        </small>
                        <span class="font-weight-bolder">
                            &#8377 <?php echo $row['course_price'] ?>
                        </span>
                    </p>
                    <input type="hidden" name="course_id" value="<?php echo $row['course_id']; ?>">
                    <!-- for payment purpose -->
                    <?php
                    // 🔑 Same logic as index.php
                    if (isset($_SESSION['is_admin_login'])) {
                        // Admin always sees Watch Now
                        echo '<a href="./student/watchcourse.php?course_id=' . $course_id . '" class="btn btn-info font-weight-bolder float-right">Check Lessons Videos</a>';
                    } elseif (isset($_SESSION['is_login'])) {
                        $stuEmail = $_SESSION['stuLogEmail'];
                        $checkOrder = "SELECT * FROM courseorder WHERE course_id = $course_id AND stu_email = '$stuEmail'";
                        $orderResult = $conn->query($checkOrder);

                        if ($orderResult->num_rows > 0) {
                            // Already purchased
                            echo '<a href="./student/watchcourse.php?course_id=' . $course_id . '" class="btn btn-success font-weight-bolder float-right">Watch Now</a>';
                        } else {
                            // Logged in but not purchased
                            echo '<form action="checkout.php" method="post">
                <input type="hidden" name="id" value="' . $row['course_price'] . '">
                <button type="submit" class="btn btn-dark font-weight-bolder float-right" name="buy">Buy Now</button>
              </form>';
                        }
                    } else {
                        // Not logged in
                        echo '<a href="#" class="btn btn-dark font-weight-bolder float-right" data-toggle="modal" data-target="#stuLoginModalCenter">Buy Now</a>';
                    }
                    ?>
                </form>
            </div>
        </div>
    </div>

    <div class="container mt-3">
        <div class="row">
            <table class="table table-bordered table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Lesson No.</th>
                        <th scope="col">Lesson Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM lesson";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        $num = 0;
                        while ($row = $result->fetch_assoc()) {
                            if ($course_id == $row['course_id']) {
                                $num++;
                                echo '<tr>
                                          <th scope="row">' . $num . '</th>
                                          <td>' . $row['lesson_name'] . '</td>
                                      </tr>';
                            }
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- end main-content of coursedetails page -->

<!-- start footer, sturegister, stulogin, adminlogin section -->
<?php include('./mainInclude/footer.php'); ?>
<!-- end footer, sturegister, stulogin, adminlogin section -->