<?php
if (!isset($_SESSION)) {
    session_start();
}

// use for page title and extra CSS/JS dynamic for specific page 
$page_title = "Edit Course";
// $extra_css = ["../css/payment.css"];  
//$extra_js = ["./js/feedbacksliding.js"];

include('./admininclude/header.php');
include('../dbConnection.php');

if (isset($_SESSION['is_admin_login'])) {
    $adminEmail = $_SESSION['adminLogEmail'];
} else {
    echo "<script>location.href='../index.php';</script>";
    exit;
}

// ================= Update Course =================
if (isset($_REQUEST['requpdate'])) {
    // Checking for empty fields
    if (
        ($_REQUEST['course_id'] == "") ||
        ($_REQUEST['course_name'] == "") ||
        ($_REQUEST['course_desc'] == "") ||
        ($_REQUEST['course_category'] == "") ||
        ($_REQUEST['course_author'] == "") ||
        ($_REQUEST['course_duration'] == "") ||
        ($_REQUEST['course_price'] == "") ||
        ($_REQUEST['course_original_price'] == "")
    ) {
        // Msg displayed if required field missing 
        $msg = '<div class="alert alert-warning col-sm-12 ml-6 mt-2 text-center" role="alert">Fill All Fields</div>';
    } else {
        // Assigning User Values to Variables
        $cid = $_REQUEST['course_id'];
        $cname = $_REQUEST['course_name'];
        $cdesc = $_REQUEST['course_desc'];
        $ccategory = $_REQUEST['course_category'];
        $cauthor = $_REQUEST['course_author'];
        $cduration = $_REQUEST['course_duration'];
        $cprice = $_REQUEST['course_price'];
        $coriginalprice = $_REQUEST['course_original_price'];

        // ✅ handle image options (keep, new, remove)
        if (!empty($_FILES['course_img']['name'])) {
            // Case: New image uploaded
            $cimg = '../image/courseimg/' . $_FILES['course_img']['name'];
            move_uploaded_file($_FILES['course_img']['tmp_name'], $cimg);
        } elseif (isset($_POST['remove_img'])) {
            // Case: Remove image
            $cimg = '';
        } else {
            // Case: Keep old image
            $cimg = $_POST['old_img']; // UPDATED (store old image in hidden input)
        }

        $sql = "UPDATE course 
                SET course_name = '$cname',
                    course_desc = '$cdesc',
                    course_category = '$ccategory',
                    course_author = '$cauthor',
                    course_duration = '$cduration',
                    course_price = '$cprice',
                    course_original_price = '$coriginalprice',
                    course_img = '$cimg'
                WHERE course_id = '$cid'";

        if ($conn->query($sql) === TRUE) {
            $msg = '<div class="alert alert-success col-sm-12 ml-6 mt-2 text-center" role="alert">Update Successfully</div>';
        } else {
            $msg = '<div class="alert alert-danger col-sm-12 ml-6 mt-2 text-center" role="alert">Unable to Update</div>';
        }
    }
}
// ------------------- ROW FETCH BLOCK (SEPARATE) after update -------------------
if (isset($_REQUEST['view']) || isset($_REQUEST['requpdate'])) {
    $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : $_REQUEST['course_id'];
    $sql = "SELECT * FROM course WHERE course_id = '$id'";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
    }
}
?>

<div class="col-sm-9 offset-md-2">
    <div class="card mt-4 shadow-sm">
        <!-- Fancy Green Gradient Header -->
        <div class="card-header text-white text-center" style="background: linear-gradient(135deg, #28a745, #218838);">
            <h3 class="mb-0">
                <i class="fas fa-edit mr-2"></i> Update Course Details
            </h3>
        </div>

        <div class="card-body">
            <?php
            // if (isset($_REQUEST['view'])) {
            //     $sql = "SELECT * FROM course WHERE course_id = {$_REQUEST['id']}";
            //     $result = $conn->query($sql);
            //     $row = $result->fetch_assoc();
            // }
            ?>

            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="course_id"><i class="fas fa-id-badge mr-1"></i> Course ID</label>
                        <input type="text" class="form-control" id="course_id" name="course_id"
                            value="<?php if (isset($row['course_id']))
                                echo $row['course_id']; ?>" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="course_name"><i class="fas fa-book mr-1"></i> Course Name</label>
                        <input type="text" class="form-control" id="course_name" name="course_name"
                            value="<?php if (isset($row['course_name']))
                                echo $row['course_name']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="course_desc"><i class="fas fa-align-left mr-1"></i> Course Description</label>
                    <textarea class="form-control" id="course_desc" name="course_desc"
                        rows="2"><?php if (isset($row['course_desc']))
                            echo $row['course_desc']; ?></textarea>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="course_category"><i class="fas fa-tags mr-1"></i> Course Category</label>
                        <input type="text" class="form-control" id="course_category" name="course_category"
                            value="<?php if (isset($row['course_category']))
                                echo $row['course_category']; ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="course_author"><i class="fas fa-user-edit mr-1"></i> Author</label>
                        <input type="text" class="form-control" id="course_author" name="course_author"
                            value="<?php if (isset($row['course_author']))
                                echo $row['course_author']; ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="course_duration"><i class="fas fa-clock mr-1"></i> Course Duration</label>
                        <input type="text" class="form-control" id="course_duration" name="course_duration"
                            pattern="^[0-9]+$"
         title="Enter only numbers" value="<?php if (isset($row['course_duration']))
                                echo $row['course_duration']; ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="course_original_price"><i class="fas fa-dollar-sign mr-1"></i> Original Price</label>
                        <input type="text" class="form-control" id="course_original_price" name="course_original_price"
                           pattern="^[0-9]+$"
         title="Enter only numbers" value="<?php if (isset($row['course_original_price']))
                                echo $row['course_original_price']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="course_price"><i class="fas fa-tag mr-1"></i> Selling Price</label>
                    <input type="text" class="form-control" id="course_price" name="course_price"
                        pattern="^[0-9]+$"
         title="Enter only numbers" value="<?php if (isset($row['course_price']))
                            echo $row['course_price']; ?>">
                </div>

                <div class="form-group">
                    <label for="course_img"><i class="fas fa-image mr-1"></i> Course Image</label><br>
                    <?php if (!empty($row['course_img'])): ?>
                        <img src="<?php echo $row['course_img']; ?>" alt="Course Image" class="img-thumbnail mb-2"
                            width="200">
                        <input type="hidden" name="old_img" value="<?php echo $row['course_img']; ?>">
                        <div>
                            <label><input type="checkbox" name="remove_img" value="1"> Remove Image</label>
                        </div>
                    <?php else: ?>
                        <input type="hidden" name="old_img" value="">
                    <?php endif; ?>
                    <input type="file" class="form-control-file" id="course_img" name="course_img">
                </div>

                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-success mr-2" id="requpdate" name="requpdate">
                        <i class="fas fa-save mr-1"></i> Update
                    </button>
                    <a href="courses.php" class="btn btn-secondary">
                        <i class="fas fa-times-circle mr-1"></i> Close
                    </a>
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