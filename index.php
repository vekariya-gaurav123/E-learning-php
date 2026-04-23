<?php
// use for page title and extra CSS/JS dynamic for specific page 
$page_title = "Home";
// $extra_css = ["../css/payment.css"];  
$extra_js = ["./js/feedbacksliding.js", "./js/bannersearch.js"];

include('./mainInclude/header.php');
include_once('./dbConnection.php'); // Add this line here by jeel  
?>

<!-- start coursedetails banner -->
<div class="banner text-center text-white p-4">
    <h1>Welcome To Learning</h1>
    <p>Learn with us and grow your skills</p>
    <div class="container mt-2">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <!-- Input Group -->
                <div class="input-group">
                    <!-- Search Input Wrapper -->
                    <div class="position-relative flex-grow-1">
                        <input type="text" id="search" class="form-control rounded-pill pe-5"
                            placeholder="Search courses...">
                        <!-- Clear Button (X) inside input -->
                        <span id="clear-search"
                            style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer; display: none; color: #888; font-size: 18px;">
                            <i class="fa-regular fa-circle-xmark"></i>
                        </span>
                    </div>
                    <!-- Search Button -->
                    <button type="button" id="search-btn" class="btn btn-dark rounded-pill ml-2 p-1"
                        style="width:100px; border:1.5px solid white;">Search</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end coursedetails banner -->

<!-- start most popular courses section -->
<div class="container mt-2">
    <h1 class="text-center">Popular Courses</h1>

    <!-- start most popular course 1st card deck -->
    <div class="card-deck mt-4">
        <!-- this is used for making dynamic course card -->
        <?php
        $sql = "SELECT * FROM course LIMIT 3";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $course_id = $row['course_id'];
                echo '<a href="coursedetails.php?course_id=' . $course_id . '" class="btn" style="text-align: left; padding:0px; margin:0px;">  
                        <div class="card course-card">  
                            <div style="height:200px;">
                                <img src="' . str_replace('..', '.', $row['course_img']) . '" alt="course" class="card-img-top" style="height:200px; width:100%; object-fit:cover; object-position:center;">  
                            </div>  
                            <div class="card-body">  
                                <h5 class="card-title">' . $row['course_name'] . '</h5>  
                                <p class="card-text">Duration :- ' . $row['course_duration'] . ' Hours</p>  
                                <p class="card-title">Category :- ' . $row['course_category'] . '</p>  
                            </div>  
                            <div class="card-footer">  
                                <p class="card-text d-inline">Price:  
                                    <small><del>&#8377 ' . $row['course_original_price'] . '</del></small>  
                                    <span class="font-weight-bolder">&#8377 ' . $row['course_price'] . '</span>  
                                </p>';

                if (isset($_SESSION['is_admin_login'])) {
                    // Admin always sees Enrolled
                    echo '<a href="coursedetails.php?course_id=' . $course_id . '" class="btn btn-info font-weight-bolder float-right">Check Details</a>';
                } elseif (isset($_SESSION['is_login'])) {
                    $stuEmail = $_SESSION['stuLogEmail'];
                    $checkOrder = "SELECT * FROM courseorder WHERE course_id = $course_id AND stu_email = '$stuEmail'";
                    $orderResult = $conn->query($checkOrder);
                    if ($orderResult->num_rows > 0) {
                        echo '<a href="coursedetails.php?course_id=' . $course_id . '" class="btn btn-success font-weight-bolder float-right">Enrolled</a>';
                    } else {
                        echo '<a href="coursedetails.php?course_id=' . $course_id . '" class="btn btn-dark font-weight-bolder float-right">Enroll</a>';
                    }
                } else {
                    echo '<a href="coursedetails.php?course_id=' . $course_id . '" class="btn btn-dark font-weight-bolder float-right">Enroll</a>';
                }
                echo '</div>  
                        </div>  
                    </a>';
            }
        }
        ?>
    </div>

    <!-- 2nd row -->
    <div class="card-deck mt-4">
        <?php
        $sql = "SELECT * FROM course LIMIT 3, 3";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $course_id = $row['course_id'];
                echo '<a href="coursedetails.php?course_id=' . $course_id . '" class="btn" style="text-align: left; padding:0px; margin:0px;">  
                        <div class="card course-card">  
                            <div style="height:200px;">
                                <img src="' . str_replace('..', '.', $row['course_img']) . '" alt="course" class="card-img-top" style="height:200px; width:100%; object-fit:cover; object-position:center;">  
                            </div>
                            <div class="card-body">  
                                <h5 class="card-title">' . $row['course_name'] . '</h5>  
                                <p class="card-text">Duration :- ' . $row['course_duration'] . ' Hours</p>  
                                <p class="card-title">Category :- ' . $row['course_category'] . '</p>  
                            </div>  
                            <div class="card-footer">  
                                <p class="card-text d-inline">Price:  
                                    <small><del>&#8377 ' . $row['course_original_price'] . '</del></small>  
                                    <span class="font-weight-bolder">&#8377 ' . $row['course_price'] . '</span>  
                                </p>';

                if (isset($_SESSION['is_admin_login'])) {
                    // Admin always sees Enrolled
                    echo '<a href="coursedetails.php?course_id=' . $course_id . '" class="btn btn-info font-weight-bolder float-right">Check Details</a>';
                } elseif (isset($_SESSION['is_login'])) {
                    $stuEmail = $_SESSION['stuLogEmail'];
                    $checkOrder = "SELECT * FROM courseorder WHERE course_id = $course_id AND stu_email = '$stuEmail'";
                    $orderResult = $conn->query($checkOrder);
                    if ($orderResult->num_rows > 0) {
                        echo '<a href="coursedetails.php?course_id=' . $course_id . '" class="btn btn-success font-weight-bolder float-right">Enrolled</a>';
                    } else {
                        echo '<a href="coursedetails.php?course_id=' . $course_id . '" class="btn btn-dark font-weight-bolder float-right">Enroll</a>';
                    }
                } else {
                    echo '<a href="coursedetails.php?course_id=' . $course_id . '" class="btn btn-dark font-weight-bolder float-right">Enroll</a>';
                }
                echo '</div>  
                        </div>  
                    </a>';
            }
        }
        ?>
    </div>
    <!-- end most popular course 1st card deck -->

    <!-- start button of view all course -->
    <div class="text-center m-2">
        <a href="courses.php" class="btn btn-dark btn-sm mt-4">View All Course</a>
    </div>
    <!-- end button of view all course -->
</div>
<!-- end most popular courses section -->

<!-- start feedback section -->
<div class="container mt-5">
    <h2 class="text-center mb-4">Student Feedback</h2>
    <div class="position-relative">
        <!-- Slider Container -->
        <div id="feedbackSlider" class="overflow-hidden">
            <div class="d-flex" id="feedbackInner" style="transition: transform 0.5s ease;">
                <?php
                // Join feedback with student table  
                $sql = "SELECT f.f_content, s.stu_name, s.stu_img FROM feedback f JOIN student s ON f.stu_id = s.stu_id ORDER BY f.f_id DESC";
                $fb = $conn->query($sql);
                if ($fb && $fb->num_rows > 0) {
                    while ($r = $fb->fetch_assoc()) {
                        $txt = htmlspecialchars($r['f_content'] ?? '', ENT_QUOTES, 'UTF-8');
                        $name = htmlspecialchars($r['stu_name'] ?? '', ENT_QUOTES, 'UTF-8');
                        $img = htmlspecialchars($r['stu_img'] ?? '', ENT_QUOTES, 'UTF-8');
                        $imgPath = str_replace('..', '.', $img);
                        echo '  
                        <div class="card m-2 text-center" style="min-width: 33.33%; flex: 0 0 33.33%; border-radius: 20px;">  
                            <img src="' . $imgPath . '" class="rounded-circle mx-auto mt-3" alt="' . $name . '" style="width:80px; height:80px; object-fit:cover;">  
                            <div class="card-body">  
                                <h6 class="card-title mb-1">' . $name . '</h6>  
                                <p class="card-text">' . $txt . '</p>  
                            </div>  
                        </div>';
                    }
                } else {
                    echo '<div class="text-center">No feedback available.</div>';
                }
                ?>
            </div>
        </div>

        <!-- Arrows -->
        <button id="fbPrev" type="button" class="btn btn-light rounded-circle shadow position-absolute"
            style="top: 40%; left: -25px; z-index: 10;">
            <i class="fa-solid fa-chevron-left"></i>
        </button>
        <button id="fbNext" type="button" class="btn btn-light rounded-circle shadow position-absolute"
            style="top: 40%; right: -25px; z-index: 10;">
            <i class="fa-solid fa-chevron-right"></i>
        </button>
    </div>
</div>
<!-- end feedback section -->

<!-- start about us section -->
<div class="container-fluid p-4" style="background-color:#E9ECEF">
    <div class="container" style="background-color:#E9ECEF">
        <div class="row text-center">
            <div class="col-sm">
                <h5>About Us</h5>
                <p>Learning provides universal access to the world's best education, partnering with top universities
                    and
                    organizations to offer courses online.</p>
            </div>
            <div class="col-sm">
                <h5>Categories</h5>
                <?php
                $sql = "SELECT DISTINCT course_category 
                FROM course 
                ORDER BY course_id DESC 
                LIMIT 5";  // fetch only last 5
                $result = $conn->query($sql);
                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $cat = htmlspecialchars($row['course_category']);
                        echo '<p class="mb-0">' . $cat . '</p>';
                    }
                } else {
                    echo '<p class="mb-0">No categories found</p>';
                }
                ?>
            </div>
            <div class="col-sm">
                <h5>Contact Us</h5>
                <p>
                    <a href="https://www.google.com/maps/place/Sentosa+Heights/@21.2355695,72.8591911,17z/data=!3m1!4b1!4m6!3m5!1s0x3be04f25b94e7ef5:0x4733329ddaf2a756!8m2!3d21.2355695!4d72.8591911!16s%2Fg%2F11ckrf735l?entry=ttu&g_ep=EgoyMDI1MDgxMi4wIKXMDSoASAFQAw%3D%3D"
                        target="_blank" class="text-dark">
                        Learning PVT LTD <br> Near D-mart <br> Motavarachha, Surat
                    </a> <br>
                    Phone :- <a href="tel:6354799958" class="text-dark">6354799958</a> <br>
                </p>
            </div>
        </div>
    </div>
</div>
<!-- end about us section -->

<!-- start social follow section -->
<div class="container-fluid bg-dark">
    <div class="row text-white text-center p-1">
        <div class="col-sm">
            <a href="https://www.facebook.com/profile.php?id=61579209940436" target="_blank"
                class="text-white social-hover">
                <i class="fa-brands fa-square-facebook"></i> Facebook
            </a>
        </div>
        <div class="col-sm">
            <a href="https://mail.google.com/mail/?view=cm&to=jeelgolakiya2311@gmail.com" target="_blank"
                class="text-white social-hover">
                <i class="fa-solid fa-envelope"></i> Email
            </a>
        </div>
        <div class="col-sm">
            <a href="https://wa.me/6354799958/" target="_blank" class="text-white social-hover">
                <i class="fa-brands fa-square-whatsapp"></i> Whatsapp
            </a>
        </div>
        <div class="col-sm">
            <a href="https://www.instagram.com/jeel_golakiya_2021/" target="_blank" class="text-white social-hover">
                <i class="fa-brands fa-square-instagram"></i> Instagram
            </a>
        </div>
    </div>
</div>
<!-- end social follow section -->

<!-- start footer, sturegister, stulogin, adminlogin section -->
<?php include('./mainInclude/footer.php'); ?>
<!-- end footer, sturegister, stulogin, adminlogin section -->