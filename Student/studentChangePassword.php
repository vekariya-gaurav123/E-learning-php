<?php
if (!isset($_SESSION)) {
    session_start();
}

// use for page title and extra CSS/JS dynamic for specific page 
$page_title = "Student Changepassword";
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

$passmsg = ""; // Initialize message

if (isset($_REQUEST['stuPassUpdateBtn'])) {
    if ($_REQUEST['stuNewPass'] == "") {
        $passmsg = '<div class="alert alert-warning col-sm-12 ml-6 mt-2 text-center" role="alert">Fill All Fields</div>';
    } else {
        $sql = "SELECT * FROM student WHERE stu_email = '$stuEmail'";
        $result = $conn->query($sql);
        if ($result->num_rows == 1) {
            $stuPass = $_REQUEST['stuNewPass'];
            $sql = "UPDATE student SET stu_pass = '$stuPass' WHERE stu_email = '$stuEmail'";
            if ($conn->query($sql) === TRUE) {
                $passmsg = '<div class="alert alert-success col-sm-12 ml-6 mt-2 text-center" role="alert">Updated Successfully</div>';
            } else {
                $passmsg = '<div class="alert alert-danger col-sm-12 ml-6 mt-2 text-center" role="alert">Unable to Update</div>';
            }
        }
    }
}
?>

<div class="col-sm-10 col-md-6 offset-sm-4 mt-5">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header text-white text-center rounded-top-4" style="background: linear-gradient(135deg, #28a745, #218838); border-radius: 10px 10px 0 0;">
            <h4 class="mb-0"><i class="fas fa-key me-2"></i> Change Password</h4>
        </div>
        <div class="card-body p-4">
            <form method="POST">

                <!-- Email -->
                <div class="mb-3">
                    <label for="inputEmail" class="form-label">
                        <i class="fas fa-envelope"></i> Email
                    </label>
                    <input type="email" class="form-control" id="inputEmail" value="<?php echo $stuEmail ?>" readonly>
                </div>
                
                <!-- New Password -->
                <div class="mb-3">
                    <label for="inputnewpassword" class="form-label">
                        <i class="fas fa-lock"></i> New Password
                    </label>
                    <input type="password" class="form-control" id="inputnewpassword" placeholder="Enter new password"
                        name="stuNewPass">
                </div>

                <!-- Submit Button -->
                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-success px-4 rounded-3" name="stuPassUpdateBtn">
                        Update
                    </button>
                </div>

                <?php if (isset($passmsg))
                    echo $passmsg; ?>
            </form>
        </div>
    </div>
</div>