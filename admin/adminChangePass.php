<?php
if(!isset($_SESSION)){
    session_start();
}
// use for page title and extra CSS/JS dynamic for specific page 
$page_title = "Admin ChangePass";
// $extra_css = ["../css/payment.css"];  
//$extra_js = ["./js/feedbacksliding.js"];

include('./admininclude/header.php');
include('../dbConnection.php');

if(isset($_SESSION['is_admin_login'])){
    $adminEmail = $_SESSION['adminLogEmail'];   // ✅ added missing semicolon
}else{
    echo "<script>location.href='../index.php';</script>";
}
$adminEmail = $_SESSION['adminLogEmail'];

if(isset($_REQUEST['adminPassUpdatebtn'])){
    if(($_REQUEST['adminPass'] == "")){   // ✅ fixed variable name (was adminpass)
        // msg displayed if required field missing 
        $passmsg = '<div class="alert alert-warning col-sm-12 ml-6 mt-2" style="text-align:center;" role="alert">Fill All Fields</div>';
    }else{
        $sql = "SELECT * FROM admin WHERE admin_email='$adminEmail'";
        $result = $conn->query($sql);
        if($result->num_rows == 1){
            $adminPass = $_REQUEST['adminPass'];   // ✅ consistent variable
            $sql = "UPDATE admin SET admin_pass = '$adminPass' WHERE admin_email ='$adminEmail' ";
            if($conn->query($sql) == TRUE){
                // below msg display on form submit success
                $passmsg = '<div class="alert alert-success col-sm-12 ml-6 mt-2" role="alert">Updated Successfully</div>';
            }else{
                // below msg display on form submit failed
                $passmsg = '<div class="alert alert-danger col-sm-12 ml-6 mt-2" role="alert">Unable to update</div>';
            }
        }
    }
}
?>

<div class="col-sm-9 mt-4 offset-md-2">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header text-white text-center rounded-top-4" style="background: linear-gradient(135deg, #28a745, #218838); border-radius: 10px 10px 0 0;">
                    <h4 class="mb-0"><i class="fas fa-key me-2"></i>Update Admin Password</h4>
                </div>
                <div class="card-body p-4">
                    <form method="POST">
                        <div class="mb-3">
                            <div class="col-md-4 text-md-end">
                                <label for="inputemail" class="col-form-label fw-bold">
                                    <i class="fas fa-envelope"></i> Email
                                </label>
                            </div>
                            <div class="col-md-12">
                                <input type="text" class="form-control rounded-3" id="inputemail" 
                                    value="<?php echo $adminEmail ?>" readonly>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="col-md-4 text-md-end">
                                <label for="inputnewpassword" class="col-form-label fw-bold">
                                    <i class="fas fa-lock"></i> New Password
                                </label>
                            </div>
                            <div class="col-md-12">
                                <input type="password" class="form-control rounded-3" id="inputnewpassword" 
                                    placeholder="Enter new password" name="adminPass">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-success px-4 mt-3 rounded-pill shadow-sm" name="adminPassUpdatebtn">
                                    <i class="fas fa-sync-alt me-1"></i> Update Password
                                </button>
                            </div>
                        </div>
                        <div class="mt-3 text-center">
                            <?php if(isset($passmsg)) { echo $passmsg; } ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</div>  <!-- div row close from header -->
</div><!-- div container-fluid close from header -->
<?php
include('./admininclude/footer.php');
?>
