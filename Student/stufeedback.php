<?php
if (!isset($_SESSION)) {
    session_start();
}

// use for page title and extra CSS/JS dynamic for specific page 
$page_title = "Student Feedback";
// $extra_css = ["../css/payment.css"];  
//$extra_js = ["./js/feedbacksliding.js"];

include('./stuInclude/header.php');
include_once('../dbConnection.php');

if (isset($_SESSION['is_login'])) {
    $stuEmail = $_SESSION['stuLogEmail'];
} else {
    echo "<script> location.href='../index.php'; </script>";
    exit;
}

$sql = "SELECT * FROM student WHERE stu_email='$stuEmail'";
$result = $conn->query($sql);
if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $stuID = $row["stu_id"];
}

$passmsg = "";

if (isset($_REQUEST['submitFeedbackBtn'])) {
    if ($_REQUEST['f_content'] == "") {
        // Message displayed if required field missing
        $passmsg = '<div class="alert alert-warning col-sm-12 ml-6 mt-2 text-center" role="alert">
                        Fill All Fields
                    </div>';
    } else {
        $fcontent = $_REQUEST["f_content"];
        $sql = "INSERT INTO feedback (f_content, stu_id) VALUES ('$fcontent', '$stuID')";
        if ($conn->query($sql) === TRUE) {
            // Message displayed on form submit success
            $passmsg = '<div class="alert alert-success col-sm-12 ml-6 mt-2 text-center" role="alert">
                            Submitted Successfully
                        </div>';
        } else {
            // Message displayed on form submit failure
            $passmsg = '<div class="alert alert-danger col-sm-12 ml-6 mt-2 text-center" role="alert">
                            Unable to Submit
                        </div>';
        }
    }
}
?>

<div class="col-sm-10 col-md-6 offset-sm-4 mt-5">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header text-white text-center rounded-top-4" style="background: linear-gradient(135deg, #28a745, #218838); border-radius: 10px 10px 0 0;">
            <h4 class="mb-0"><i class="fas fa-comment-dots me-2"></i> Student Feedback</h4>
        </div>
        <div class="card-body p-4">
            <form method="POST">
                <!-- Student ID -->
                <div class="mb-3">
                    <label for="stuId" class="form-label"><i class="fas fa-id-card me-1"></i> Student ID</label>
                    <input type="text" class="form-control" id="stuId" name="stuId"
                        value="<?php if (isset($stuID)) { echo $stuID; } ?>" readonly>
                </div>

                <!-- Feedback -->
                <div class="mb-3">
                    <label for="f_content" class="form-label"><i class="fas fa-pencil-alt me-1"></i> Write Feedback</label>
                    <textarea class="form-control" id="f_content" name="f_content" rows="3" placeholder="Write your feedback here..."></textarea>
                </div>

                <!-- Submit button -->
                <div class="text-center">
                    <button type="submit" class="btn btn-success px-4 rounded-3" name="submitFeedbackBtn">
                        Submit
                    </button>
                </div>

                <?php if (isset($passmsg)) { echo $passmsg; } ?>
            </form>
        </div>
    </div>
</div>

</div> <!-- Close Row Div from header file-->
</div> <!-- Close Row Div from header file-->

<?php
include('./stuInclude/footer.php');
?>