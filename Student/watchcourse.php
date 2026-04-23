<?php
if (!isset($_SESSION)) {
    session_start();
}
include('../dbConnection.php');

if (isset($_SESSION['is_login'])) {
    $stuEmail = $_SESSION['stuLogEmail'];   // Student email
} elseif (isset($_SESSION['is_admin_login'])) {
    // Admin logged in (you can set a dummy email or leave blank if not needed)
   $adminEmail = $_SESSION['adminLogEmail']; 
} else {
    echo "<script>location.href='../index.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Watch Course</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../css/all.min.css">

    <style>
        /* Fixed Navbar */
        .header-bar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            background: #212529;
            color: #fff;
            padding: 0px 15px;
            height: 55px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .header-bar h5 {
            margin: 0;
            font-weight: 600;
        }

        /* Add padding so content not hidden behind navbar */
        body {
            padding-top: 60px;
            background-color: #f8f9fa;
        }

        /* Sidebar fixed */
        .sidebar {
            position: fixed;
            top: 60px; /* below navbar */
            left: 0;
            width: 25%; /* about col-md-3 width */
            background: #fff;
            border-radius: 6px;
            padding: 12px;
            height: calc(100vh - 70px);
            overflow-y: auto;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        /* Lesson list */
        #playlist li {
            padding: 10px;
            border-bottom: 1px solid #eee;
            cursor: pointer;
            transition: 0.2s;
        }

        #playlist li:hover {
            background: #f3f8f4;
        }

        #playlist li.active {
            background: #28a745;
            color: #fff;
            font-weight: 500;
            border-radius: 4px;
        }

        /* Video styling */
        #videoarea {
            border-radius: 8px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.15);
        }

        /* Video section shifts right */
        .video-section {
            margin-left: 26%; /* space for sidebar */
            padding: 10px;
        }
    </style>
</head>

<body>
    <!-- Fixed Navbar -->
    <div class="header-bar">
        <h5>
            <a href="../index.php">
                <img src="../image/logo/style-logo.png" alt="Logo" width="140" height="80">
            </a>
        </h5>
        <a class="btn btn-outline-light btn-sm" href="./mycourse.php">
            <i class="fas fa-book"></i> My Courses
        </a>
    </div>

    <!-- Sidebar Lessons -->
    <div class="sidebar">
        <h6 class="text-center mb-3">Lessons</h6><hr class="bg-dark" style="border:2px solid black">
        <ul id="playlist" class="nav flex-column">
            <?php
            if (isset($_GET['course_id'])) {
                $course_id = $_GET['course_id'];
                $sql = "SELECT * FROM lesson WHERE course_id = '$course_id'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<li class="nav-item" style="border-bottom:1px solid black"
                            movieurl="' . $row['lesson_link'] . '" 
                            data-desc="' . $row['lesson_desc'] . '">' 
                            . $row['lesson_name'] . 
                            '</li>';
                    }
                }
            }
            ?>
        </ul>
    </div>

    <!-- Video Section -->
    <div class="video-section">
        <video id="videoarea" src="" class="w-100" height="500" controls></video>
        <div id="lessonDesc" class="mt-2 p-2 bg-light border rounded small" style="font-size:20px;"></div>
    </div>

    <!-- Scripts -->
    <script src="../js/jquery.min.js"></script>
    <script src="../js/popper.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script>
        // Lesson click event
        $(document).on("click", "#playlist li", function () {
            $("#playlist li").removeClass("active");
            $(this).addClass("active");

            var movieurl = $(this).attr("movieurl");
            var desc = $(this).data("desc");

            $("#videoarea").attr("src", movieurl);
            $("#lessonDesc").html(desc);
        });

        // Auto-play first lesson
        $(document).ready(function () {
            let firstLesson = $("#playlist li").first();
            if (firstLesson.length) {
                firstLesson.addClass("active");
                $("#videoarea").attr("src", firstLesson.attr("movieurl"));
                $("#lessonDesc").html(firstLesson.data("desc"));
            }
        });
    </script>
</body>
</html>
