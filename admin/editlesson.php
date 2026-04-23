<?php
if (!isset($_SESSION)) {
    session_start();
}

// use for page title and extra CSS/JS dynamic for specific page 
$page_title = "Edit Lesson";
// $extra_css = ["../css/payment.css"];  
//$extra_js = ["./js/feedbacksliding.js"];

include('./admininclude/header.php');
include('../dbConnection.php');

if (isset($_SESSION['is_admin_login'])) {
    $adminEmail = $_SESSION['adminLogEmail'];
} else {
    echo "<script>location.href='../index.php';</script>";
}

// UPDATE LESSON
if (isset($_REQUEST['requpdate'])) {
    if (($_REQUEST['lesson_id'] == "") || ($_REQUEST['lesson_name'] == "") || ($_REQUEST['lesson_desc'] == "") || ($_REQUEST['course_id'] == "") || ($_REQUEST['course_name'] == "")) {
        $msg = '<div class="alert alert-warning col-sm-12 ml-6 mt-2 text-center" role="alert">Fill All Fields</div>';
    } else {
        $lid   = $_REQUEST['lesson_id'];
        $lname = $_REQUEST['lesson_name'];
        $ldesc = $_REQUEST['lesson_desc'];
        $cid   = $_REQUEST['course_id'];
        $cname = $_REQUEST['course_name'];

        // Get old link if already exists
        $sql_old = "SELECT lesson_link FROM lesson WHERE lesson_id='$lid'";
        $result_old = $conn->query($sql_old);
        $row_old = $result_old->fetch_assoc();
        $old_link = $row_old['lesson_link'];

        // File upload handling
        if (!empty($_FILES['lesson_link']['name'])) {
            $lesson_link = $_FILES['lesson_link']['name'];
            $lesson_link_temp = $_FILES['lesson_link']['tmp_name'];
            $link_folder = '../lessonvid/' . $lesson_link;
            move_uploaded_file($lesson_link_temp, $link_folder);
        } else {
            // If no new file uploaded, keep old one
            $link_folder = $old_link;
        }

        $sql = "UPDATE lesson 
                SET lesson_name='$lname', lesson_desc='$ldesc', lesson_link='$link_folder', 
                    course_id='$cid', course_name='$cname' 
                WHERE lesson_id='$lid'";

        if ($conn->query($sql) == TRUE) {
            $msg = '<div class="alert alert-success col-sm-12 ml-6 mt-2 text-center" role="alert">Update Successfully</div>';
        } else {
            $msg = '<div class="alert alert-danger col-sm-12 ml-6 mt-2 text-center" role="alert">Unable to Update</div>';
        }
    }
}
// ------------------- ROW FETCH BLOCK (SEPARATE) after update -------------------
if (isset($_REQUEST['view']) || isset($_REQUEST['requpdate'])) {
    $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : $_REQUEST['lesson_id'];
    $sql = "SELECT l.lesson_id, l.lesson_name, l.lesson_desc, l.lesson_link, c.course_id, c.course_name FROM lesson l JOIN course c ON l.course_id = c.course_id WHERE l.lesson_id = '$id'";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
    }
}
?>

<div class="col-sm-9 offset-md-2">
    <div class="card mt-4 shadow-sm">
        <div class="card-header text-white text-center"
             style="background: linear-gradient(135deg, #28a745, #218838);">
            <h3 class="mb-0">
                <i class="fas fa-video mr-2"></i> Update Lesson Details
            </h3>
        </div>

        <div class="card-body">
            <?php
            // if (isset($_REQUEST['view'])) {
            //     $sql = "SELECT * FROM lesson WHERE lesson_id = {$_REQUEST['id']}";
            //     $result = $conn->query($sql);
            //     $row = $result->fetch_assoc();
            // }
            ?>

            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="lesson_id"><i class="fas fa-hashtag mr-1"></i> Lesson ID</label>
                        <input type="text" class="form-control" id="lesson_id" name="lesson_id"
                            value="<?php if (isset($row['lesson_id'])) echo $row['lesson_id']; ?>" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="lesson_name"><i class="fas fa-file-alt mr-1"></i> Lesson Name</label>
                        <input type="text" class="form-control" id="lesson_name" name="lesson_name"
                            value="<?php if (isset($row['lesson_name'])) echo $row['lesson_name']; ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="lesson_desc"><i class="fas fa-align-left mr-1"></i> Lesson Description</label>
                    <textarea class="form-control" id="lesson_desc" name="lesson_desc" rows="2"><?php if (isset($row['lesson_desc'])) echo $row['lesson_desc']; ?></textarea>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="course_id"><i class="fas fa-id-badge mr-1"></i> Course ID</label>
                        <input type="text" class="form-control" id="course_id" name="course_id"
                            value="<?php if (isset($row['course_id'])) echo $row['course_id']; ?>" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="course_name"><i class="fas fa-book mr-1"></i> Course Name</label>
                        <input type="text" class="form-control" id="course_name" name="course_name"
                            value="<?php if (isset($row['course_name'])) echo $row['course_name']; ?>" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label for="lesson_link"><i class="fas fa-video mr-1"></i> Lesson Video</label>
                    <?php if (!empty($row['lesson_link'])): ?>
                        <div class="embed-responsive embed-responsive-16by9 mt-2">
                            <iframe class="embed-responsive-item" src="<?php echo $row['lesson_link']; ?>" allowfullscreen></iframe>
                        </div>
                    <?php endif; ?>
                    <input type="file" class="form-control mt-2" id="lesson_link" name="lesson_link">
                </div>

                <div class="text-center mt-3">
                    <button type="submit" class="btn btn-success mr-2" id="requpdate" name="requpdate">
                        <i class="fas fa-save mr-1"></i> Update
                    </button>
                    <a href="lessons.php" class="btn btn-secondary">
                        <i class="fas fa-times-circle mr-1"></i> Close
                    </a>
                </div>

                <?php if (isset($msg)) echo $msg; ?>
            </form>
        </div>
    </div>
</div>

</div> <!-- div row close from header -->
</div><!-- div conatiner-fluid close from header -->

<?php
include('./admininclude/footer.php');
?>
