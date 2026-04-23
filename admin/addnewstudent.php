<?php
if (!isset($_SESSION)) {
    session_start();
}
// use for page title and extra CSS/JS dynamic for specific page 
$page_title = "Add New Student";
// $extra_css = ["../css/payment.css"];  
//$extra_js = ["./js/feedbacksliding.js"];

include('./admininclude/header.php');
include('../dbConnection.php');

if (isset($_SESSION['is_admin_login'])) {
    $adminEmail = $_SESSION['adminLogEmail'];   // ✅ fixed missing semicolon
} else {
    echo "<script>location.href='../index.php';</script>";
}

if (isset($_REQUEST['newStuSubmitBtn'])) {
    // checking for empty fields
    if (($_REQUEST['stu_name'] == "") || ($_REQUEST['stu_email'] == "") || ($_REQUEST['stu_pass'] == "") || ($_REQUEST['stu_occ'] == "")) {
        $msg = '<div class="alert alert-warning col-sm-12 ml-6 mt-2 text-center" role="alert">Fill All Fields</div>';
    } else {
        $stu_name = $_REQUEST['stu_name'];
        $stu_email = $_REQUEST['stu_email'];
        $stu_pass = $_REQUEST['stu_pass'];
        $stu_occ = $_REQUEST['stu_occ'];

        $sql = "INSERT INTO student (stu_name, stu_email, stu_pass, stu_occ) 
                VALUES ('$stu_name','$stu_email','$stu_pass','$stu_occ')";

        if ($conn->query($sql) == TRUE) {
            $msg = '<div class="alert alert-success col-sm-12 ml-6 mt-2 text-center" role="alert">Student Added Successfully</div>';
        } else {
            $msg = '<div class="alert alert-danger col-sm-12 ml-6 mt-2 text-center" role="alert">Unable to Add Student</div>';
        }
    }
}
?>

<div class="col-sm-9 offset-md-2">
    <div class="card mt-4 shadow-sm">
        <div class="card-header text-white text-center" 
             style="background: linear-gradient(135deg, #28a745, #218838);">
            <h3 class="mb-0">
                <i class="fas fa-user-graduate mr-2"></i> Add New Student
            </h3>
        </div>
        <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data">

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="stu_name"><i class="fas fa-user mr-2"></i>Name</label>
                        <input type="text" class="form-control" id="stu_name" name="stu_name"
                            placeholder="Enter full name"
                            value="<?php if(isset($_REQUEST['stu_name'])) echo $_REQUEST['stu_name']; ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="stu_email"><i class="fas fa-envelope mr-2"></i>Email</label>
                        <input type="email" class="form-control" id="stu_email" name="stu_email"
                            placeholder="Enter email"
                            pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-z]{2,}$"
       title="Enter a valid email like abc@xyz.com" value="<?php if(isset($_REQUEST['stu_email'])) echo $_REQUEST['stu_email']; ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="stu_pass"><i class="fas fa-lock mr-2"></i>Password</label>
                        <input type="password" class="form-control" id="stu_pass" name="stu_pass"
                            placeholder="Enter password"
                            value="<?php if(isset($_REQUEST['stu_pass'])) echo $_REQUEST['stu_pass']; ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="stu_occ"><i class="fas fa-briefcase mr-2"></i>Occupation</label>
                        <input type="text" class="form-control" id="stu_occ" name="stu_occ"
                            placeholder="Enter occupation"
                            value="<?php if(isset($_REQUEST['stu_occ'])) echo $_REQUEST['stu_occ']; ?>">
                    </div>
                </div>

                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-success mr-2" id="newStuSubmitBtn"
                        name="newStuSubmitBtn"><i class="fas fa-plus-circle mr-1"></i>Submit</button>
                    <a href="students.php" class="btn btn-secondary"><i class="fas fa-times mr-1"></i>Close</a>
                </div>

                <?php if (isset($msg)) echo $msg; ?>
            </form>
        </div>
    </div>
</div>

</div> <!-- div row close from header -->
</div> <!-- div container-fluid close from header -->

<?php
include('./admininclude/footer.php');
?>