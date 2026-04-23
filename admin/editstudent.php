<?php
if (!isset($_SESSION)) {
    session_start();
}

// use for page title and extra CSS/JS dynamic for specific page 
$page_title = "Edit Student";
// $extra_css = ["../css/payment.css"];  
//$extra_js = ["./js/feedbacksliding.js"];

include('./admininclude/header.php');
include('../dbConnection.php');

if (isset($_SESSION['is_admin_login'])) {
    $adminEmail = $_SESSION['adminLogEmail']; // ✅ Added missing semicolon
} else {
    echo "<script>location.href='../index.php';</script>";
}

// Update student details
if (isset($_REQUEST['requpdate'])) {
    // Checking for empty fields
    if (($_REQUEST['stu_id'] == "") || ($_REQUEST['stu_name'] == "") || ($_REQUEST['stu_email'] == "") || ($_REQUEST['stu_pass'] == "") || ($_REQUEST['stu_occ'] == "")) {
        // Message displayed if required field is missing
        $msg = '<div class="alert alert-warning col-sm-12 ml-6 mt-2 text-center" role="alert">Fill All Fields</div>';
    } else {
        // Assigning User Values to Variables
        $sid = $_REQUEST['stu_id'];
        $sname = $_REQUEST['stu_name'];
        $semail = $_REQUEST['stu_email'];
        $spass = $_REQUEST['stu_pass'];
        $socc = $_REQUEST['stu_occ'];

        $sql = "UPDATE student SET stu_id='$sid', stu_name='$sname', stu_email='$semail', stu_pass='$spass', stu_occ='$socc' WHERE stu_id='$sid'";
        if ($conn->query($sql) == TRUE) {
            // Success message
            $msg = '<div class="alert alert-success col-sm-12 ml-6 mt-2 text-center" role="alert">Updated Successfully</div>';
        } else {
            // Failure message
            $msg = '<div class="alert alert-danger col-sm-12 ml-6 mt-2 text-center" role="alert">Unable to Update</div>';
        }
    }
}
// ------------------- ROW FETCH BLOCK (SEPARATE) after update -------------------
if (isset($_REQUEST['view']) || isset($_REQUEST['requpdate'])) {
    $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : $_REQUEST['stu_id'];
    $sql = "SELECT * FROM student WHERE stu_id = '$id'";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
    }
}
?>

<div class="col-sm-9 offset-md-2">
    <div class="card mt-4 shadow-sm">
        <!-- Proper green gradient header -->
        <div class="card-header text-white text-center" style="background: linear-gradient(135deg, #28a745, #218838);">
            <h3 class="mb-0">Update Student Details</h3>
        </div>

        <div class="card-body">
            <?php
            // if (isset($_REQUEST['view'])) {
            //     $sql = "SELECT * FROM student WHERE stu_id = {$_REQUEST['id']}";
            //     $result = $conn->query($sql);
            //     $row = $result->fetch_assoc();
            // }
            ?>

            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="stu_id" class="font-weight-bold">
                            <i class="fas fa-id-card mr-1"></i> ID
                        </label>
                        <input type="text" class="form-control" id="stu_id" name="stu_id"
                            value="<?php if (isset($row['stu_id']))
                                echo $row['stu_id']; ?>" readonly>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="stu_name" class="font-weight-bold">
                            <i class="fas fa-user mr-1"></i> Name
                        </label>
                        <input type="text" class="form-control" id="stu_name" name="stu_name"
                            value="<?php if (isset($row['stu_name']))
                                echo $row['stu_name']; ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="stu_email" class="font-weight-bold">
                            <i class="fas fa-envelope mr-1"></i> Email
                        </label>
                        <input type="email" class="form-control" id="stu_email" name="stu_email"
                            pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-z]{2,}$"
       title="Enter a valid email like abc@xyz.com" value="<?php if (isset($row['stu_email']))
                                echo $row['stu_email']; ?>">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="stu_pass" class="font-weight-bold">
                            <i class="fas fa-lock mr-1"></i> Password
                        </label>
                        <input type="password" class="form-control" id="stu_pass" name="stu_pass"
                            value="<?php if (isset($row['stu_pass']))
                                echo $row['stu_pass']; ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="stu_occ" class="font-weight-bold">
                            <i class="fas fa-briefcase mr-1"></i> Occupation
                        </label>
                        <input type="text" class="form-control" id="stu_occ" name="stu_occ"
                            value="<?php if (isset($row['stu_occ']))
                                echo $row['stu_occ']; ?>">
                    </div>
                    <div class="form-group col-md-6"></div>
                </div>

                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-success mr-2" id="requpdate" name="requpdate"><i class="fas fa-save mr-1"></i>Update</button>
                    <a href="students.php" class="btn btn-secondary"><i class="fas fa-times-circle mr-1"></i>Close</a>
                </div>

                <?php if (isset($msg))
                    echo $msg; ?>
            </form>
        </div>
    </div>
</div>


</div> <!-- div row close from header -->
</div> <!-- div container-fluid close from header -->

<?php
include('./admininclude/footer.php');
?>