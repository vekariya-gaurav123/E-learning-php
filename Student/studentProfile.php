<?php
if (!isset($_SESSION)) {
    session_start();
}

// use for page title and extra CSS/JS dynamic for specific page 
$page_title = "Student Profile";
// $extra_css = ["../css/payment.css"];  
//$extra_js = ["./js/feedbacksliding.js"];

include('./stuInclude/header.php');
include('../dbConnection.php');

if (isset($_SESSION['is_login'])) {
    $stuEmail = $_SESSION['stuLogEmail'];
} else {
    echo "<script> location.href='../index.php'; </script>";
}

$sql = "SELECT * FROM student WHERE stu_email='$stuEmail'";
$result = $conn->query($sql);
if ($result->num_rows == 1) {
    $row     = $result->fetch_assoc();
    $stuId   = $row["stu_id"];
    $stuName = $row["stu_name"];
    $stuOcc  = $row["stu_occ"];
    $stuImg  = $row["stu_img"];
}

if (isset($_REQUEST['updateStunameBtn'])) {
    if ($_REQUEST['stuName'] == "") {
        $passmsg = '<div class="alert alert-warning col-sm-12 ml-6 mt-2 text-center" role="alert">Fill All Fields</div>';
    } else {
        $stuname = $_REQUEST['stuName'];
        $stuOcc  = $_REQUEST['stuOcc'];

        // Image handling
        if (!empty($_FILES['stuImg']['name'])) {
            // New image uploaded
            $stu_image      = $_FILES['stuImg']['name'];
            $stu_image_temp = $_FILES['stuImg']['tmp_name'];
            $img_folder     = '../image/stu/' . $stu_image;
            move_uploaded_file($stu_image_temp, $img_folder);
        } elseif (isset($_POST['removeImg']) && $_POST['removeImg'] == "yes") {
            // Remove image if checkbox checked
            $img_folder = "";
        } else {
            // Keep old image
            $img_folder = $stuImg;
        }

        $sql = "UPDATE student 
                SET stu_name = '$stuname', stu_occ = '$stuOcc', stu_img = '$img_folder' 
                WHERE stu_email = '$stuEmail'";

        if ($conn->query($sql) == TRUE) {
            $passmsg = '<div class="alert alert-success col-sm-12 ml-6 mt-2 text-center" role="alert">Updated Successfully</div>';
            $stuImg = $img_folder; // update variable
        } else {
            $passmsg = '<div class="alert alert-danger col-sm-12 ml-6 mt-2 text-center" role="alert">Unable to Update</div>';
        }
    }
}
?>

<div class="col-sm-10 offset-sm-2 mt-5">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header text-white text-center rounded-top-4" style="background: linear-gradient(135deg, #28a745, #218838); border-radius: 10px 10px 0 0;">
            <h4 class="mb-0"><i class="fas fa-user-edit me-2"></i> Update Student Profile</h4>
        </div>
        <div class="card-body p-4">
            <form class="mx-auto" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <!-- Student ID -->
                    <div class="col-md-6 mb-3">
                        <label for="stuId" class="form-label"><i class="fas fa-id-card me-1"></i> Student ID</label>
                        <input type="text" class="form-control" id="stuId" name="stuId"
                            value="<?php if (isset($stuId)) { echo $stuId; } ?>" readonly>
                    </div>

                    <!-- Email -->
                    <div class="col-md-6 mb-3">
                        <label for="stuEmail" class="form-label"><i class="fas fa-envelope me-1"></i> Email</label>
                        <input type="email" class="form-control" id="stuEmail"
                            value="<?php echo $stuEmail ?>" readonly>
                    </div>
                </div>

                <div class="row">
                    <!-- Name -->
                    <div class="col-md-6 mb-3">
                        <label for="stuName" class="form-label"><i class="fas fa-user me-1"></i> Name</label>
                        <input type="text" class="form-control" id="stuName" name="stuName"
                            value="<?php if (isset($stuName)) { echo $stuName; } ?>">
                    </div>

                    <!-- Occupation -->
                    <div class="col-md-6 mb-3">
                        <label for="stuOcc" class="form-label"><i class="fas fa-briefcase me-1"></i> Occupation</label>
                        <input type="text" class="form-control" id="stuOcc" name="stuOcc"
                            value="<?php if (isset($stuOcc)) { echo $stuOcc; } ?>">
                    </div>
                </div>

                <!-- Profile Image -->
                <div class="mb-3">
                    <label for="stuImg" class="form-label"><i class="fas fa-image me-1"></i> Profile Image</label><br>
                    <input type="checkbox" name="removeImg" value="yes"> Remove current image
                    <input type="file" class="form-control mt-2" id="stuImg" name="stuImg">
                </div>

                <!-- Update button -->
                <div class="text-center">
                    <button type="submit" class="btn btn-success rounded-3" name="updateStunameBtn"><i class="fas fa-save mr-1"></i>Update</button>
                </div>

                <?php if (isset($passmsg)) { echo $passmsg; } ?>
            </form>
        </div>
    </div>
</div>

</div> <!-- Close Row Div from header file -->
</div> <!-- Close Row Div from header file -->

<?php
include('./stuInclude/footer.php');
?>
