<?php
if (!isset($_SESSION)) {
    session_start();
}
// use for page title and extra CSS/JS dynamic for specific page 
$page_title = "Add Course";
// $extra_css = ["../css/payment.css"];  
//$extra_js = ["./js/feedbacksliding.js"];

include('./admininclude/header.php');
include('../dbConnection.php');

if (isset($_SESSION['is_admin_login'])) {
    $adminEmail = $_SESSION['adminLogEmail']; // ✅ fixed semicolon
} else {
    echo "<script>location.href='../index.php';</script>";
}

if (isset($_REQUEST['CourseSubmitBtn'])) { // ✅ spelling fixed
    //checking for empty fields
    if (($_REQUEST['course_name'] == "") || ($_REQUEST['course_desc'] == "") || ($_REQUEST['course_category'] == "") || ($_REQUEST['course_author'] == "") || ($_REQUEST['course_duration'] == "") || ($_REQUEST['course_price'] == "") || ($_REQUEST['course_original_price'] == "")) {
        $msg = '<div class="alert alert-warning col-sm-12 ml-6 mt-2 text-center">Fill All Fields</div>';
    } else {
        $course_name = $_REQUEST['course_name'];
        $course_desc = $_REQUEST['course_desc'];
        $course_category = $_REQUEST['course_category'];
        $course_author = $_REQUEST['course_author'];
        $course_duration = $_REQUEST['course_duration'];
        $course_price = $_REQUEST['course_price'];
        $course_original_price = $_REQUEST['course_original_price'];
        $course_image = $_FILES['course_img']['name']; // ✅ corrected key
        $course_image_temp = $_FILES['course_img']['tmp_name'];
        $img_folder = '../image/courseimg/' . $course_image; // ✅ added slash
        move_uploaded_file($course_image_temp, $img_folder);

        $sql = "INSERT INTO course (course_name, course_desc,course_category, course_author, course_img, course_duration, course_price, course_original_price) 
        VALUES ('$course_name','$course_desc','$course_category','$course_author','$img_folder','$course_duration','$course_price','$course_original_price')";

        if ($conn->query($sql) == TRUE) {
            $msg = '<div class="alert alert-success col-sm-12 ml-6 mt-2 text-center">Course Added Successfully</div>';
        } else {
            $msg = '<div class="alert alert-danger col-sm-12 ml-6 mt-2 text-center">Unable to ADD Course</div>';
        }
    }
}
?>
<div class="col-sm-9 offset-md-2">
    <div class="card mt-4 shadow-sm">
        <div class="card-header text-white text-center" style="background: linear-gradient(135deg, #28a745, #218838);">
            <h3 class="mb-0">
                <i class="fas fa-book mr-2"></i> Add New Course
            </h3>
        </div>
        <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="course_name"><i class="fas fa-book mr-1"></i> Course Name</label>
                        <input type="text" class="form-control" id="course_name" name="course_name"
                            placeholder="Enter course name" value="<?php if (isset($_REQUEST['course_name']))
                                echo $_REQUEST['course_name']; ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="course_category"><i class="fas fa-tags mr-1"></i> Course Category</label>
                        <input type="text" class="form-control" id="course_category" name="course_category"
                            placeholder="Enter category" value="<?php if (isset($_REQUEST['course_category']))
                                echo $_REQUEST['course_category']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="course_desc"><i class="fas fa-align-left mr-1"></i> Course Description</label>
                    <textarea class="form-control" id="course_desc" name="course_desc" rows="3"
                        placeholder="Write course description"><?php if (isset($_REQUEST['course_desc']))
                            echo $_REQUEST['course_desc']; ?></textarea>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="course_author"><i class="fas fa-user-edit mr-1"></i> Author</label>
                        <input type="text" class="form-control" id="course_author" name="course_author"
                            placeholder="Author name" value="<?php if (isset($_REQUEST['course_author']))
                                echo $_REQUEST['course_author']; ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="course_duration"><i class="fas fa-clock mr-1"></i> Course Duration</label>
                        <input type="text" class="form-control" id="course_duration" name="course_duration"
                            placeholder="e.g., 5" pattern="^[0-9]+$" title="Enter only numbers" value="<?php if (isset($_REQUEST['course_duration']))
                                echo $_REQUEST['course_duration']; ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="course_original_price"><i class="fas fa-dollar-sign mr-1"></i> Original Price</label>
                        <input type="text" class="form-control" id="course_original_price" name="course_original_price"
                            placeholder="e.g., 500" pattern="^[0-9]+$" title="Enter only numbers" value="<?php if (isset($_REQUEST['course_original_price']))
                                echo $_REQUEST['course_original_price']; ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="course_price"><i class="fas fa-tag mr-1"></i> Selling Price</label>
                        <input type="text" class="form-control" id="course_price" name="course_price"
                            placeholder="e.g., 400" pattern="^[0-9]+$" title="Enter only numbers" value="<?php if (isset($_REQUEST['course_price']))
                                echo $_REQUEST['course_price']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="course_img"><i class="fas fa-image mr-1"></i> Course Image</label>
                    <input type="file" class="form-control-file" id="course_img" name="course_img">
                    <small class="text-muted">* You need to re-select the file if form fails</small>
                </div>

                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-success mr-2" name="CourseSubmitBtn"><i class="fas fa-plus-circle mr-1"></i> Submit</button>
                    <a href="courses.php" class="btn btn-secondary"><i class="fas fa-times-circle mr-1"></i> Close</a>
                </div>

                <?php if (isset($msg))
                    echo $msg; ?>
            </form>
        </div>
    </div>
</div>

</div> <!-- div row close from header -->
</div><!-- div container-fluid close from header -->
<?php
include('./admininclude/footer.php');
?>