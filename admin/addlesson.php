<?php
if (!isset($_SESSION)) {
    session_start();
}
// use for page title and extra CSS/JS dynamic for specific page 
$page_title = "Add Lesson";
// $extra_css = ["../css/payment.css"];  
//$extra_js = ["./js/feedbacksliding.js"];

include('./admininclude/header.php');
include('../dbConnection.php');

if (isset($_SESSION['is_admin_login'])) {
    $adminEmail = $_SESSION['adminLogEmail'];
} else {
    echo "<script> location.href='../index.php'; </script>";
}

// Handle Lesson Insert
if (isset($_REQUEST['lessonSubmitBtn'])) {
    // Checking for Empty Fields
    if (
        ($_REQUEST['lesson_name'] == "") ||
        ($_REQUEST['lesson_desc'] == "") ||
        ($_REQUEST['course_id'] == "") ||
        ($_REQUEST['course_name'] == "")
    ) {
        // msg displayed if required field missing
        $msg = '<div class="alert alert-warning col-sm-12 ml-6 mt-2 text-center" role="alert"> Fill All Fields </div>';
    } else {
        // Assigning User Values to Variable
        $lesson_name = $_REQUEST['lesson_name'];
        $lesson_desc = $_REQUEST['lesson_desc'];
        $course_id = $_REQUEST['course_id'];
        $course_name = $_REQUEST['course_name'];

        // File upload handling
        $lesson_link = $_FILES['lesson_link']['name'];
        $lesson_link_temp = $_FILES['lesson_link']['tmp_name'];
        $link_folder = '../lessonvid/' . $lesson_link;
        move_uploaded_file($lesson_link_temp, $link_folder);

        // Insert query
        $sql = "INSERT INTO lesson (lesson_name, lesson_desc, lesson_link, course_id, course_name) 
                VALUES ('$lesson_name', '$lesson_desc', '$link_folder', '$course_id', '$course_name')";

        if ($conn->query($sql) == TRUE) {
            // success msg
            $msg = '<div class="alert alert-success col-sm-12 ml-6 mt-2 text-center" role="alert"> Lesson Added Successfully </div>';
        } else {
            // error msg
            $msg = '<div class="alert alert-danger col-sm-12 ml-6 mt-2 text-center" role="alert"> Unable to Add Lesson </div>';
        }
    }
}
?>

<!-- Add Lesson Form -->
<div class="col-sm-9 offset-md-2">
    <div class="card mt-4 shadow-sm">
        <div class="card-header text-white text-center" 
             style="background: linear-gradient(135deg, #28a745, #218838);">
            <h3 class="mb-0">
                <i class="fas fa-chalkboard-teacher mr-2"></i> Add New Lesson
            </h3>
        </div>
        <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data">

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="course_id"><i class="fas fa-id-badge mr-1"></i> Course ID</label>
                        <input type="text" class="form-control" id="course_id" name="course_id"
                            value="<?php if (isset($_SESSION['course_id'])) echo $_SESSION['course_id']; ?>"
                            readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="course_name"><i class="fas fa-book mr-1"></i> Course Name</label>
                        <input type="text" class="form-control" id="course_name" name="course_name"
                            value="<?php if (isset($_SESSION['course_name'])) echo $_SESSION['course_name']; ?>"
                            readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label for="lesson_name"><i class="fas fa-file-alt mr-1"></i> Lesson Name</label>
                    <input type="text" class="form-control" id="lesson_name" name="lesson_name"
                        placeholder="Enter lesson title"
                        value="<?php if(isset($_REQUEST['lesson_name'])) echo $_REQUEST['lesson_name']; ?>">
                </div>

                <div class="form-group">
                    <label for="lesson_desc"><i class="fas fa-align-left mr-1"></i> Lesson Description</label>
                    <textarea class="form-control" id="lesson_desc" name="lesson_desc" rows="3"
                        placeholder="Write lesson description"><?php if(isset($_REQUEST['lesson_desc'])) echo $_REQUEST['lesson_desc']; ?></textarea>
                </div>

                <div class="form-group">
                    <label for="lesson_link"><i class="fas fa-video mr-1"></i> Lesson Video</label>
                    <input type="file" class="form-control-file" id="lesson_link" name="lesson_link">
                </div>

                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-success mr-2" id="lessonSubmitBtn"
                        name="lessonSubmitBtn"><i class="fas fa-plus-circle mr-1"></i> Submit</button>
                    <a href="lessons.php" class="btn btn-secondary"><i class="fas fa-times-circle mr-1"></i> Close</a>
                </div>

                <?php if (isset($msg)) echo $msg; ?>
            </form>
        </div>
    </div>
</div>

</div> <!-- Row close -->
</div> <!-- Container-fluid close -->

<?php include('./admininclude/footer.php'); ?>