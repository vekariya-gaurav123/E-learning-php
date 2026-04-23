<?php
// Start session once at the very beginning, before any output
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Save the current page URL to session for redirect after login/signup
//$_SESSION['last_page'] = $_SERVER['REQUEST_URI']; 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- bootstrap css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- font awesome css -->
    <link rel="stylesheet" href="css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@700&display=swap" rel="stylesheet">

    <!-- Custom styles -->
    <link rel="stylesheet" href="css/style.css">

    <!-- jQuery -->
    <script src="js/jquery.min.js"></script>

    <title>
        <?php echo isset($page_title) ? $page_title : "Main-Pages"; ?>
    </title>

    <!-- Page-specific CSS -->
    <?php
    // if (isset($extra_css) && is_array($extra_css)) { 
    //     foreach ($extra_css as $css) { 
    //         echo '<link rel="stylesheet" href="'.$css.'">' . "\n"; 
    //     } 
    // } 
    ?>

    <!-- Page-specific JS -->
    <?php
    // if (isset($extra_js) && is_array($extra_js)) { 
    //     foreach ($extra_js as $js) { 
    //         echo '<script src="'.$js.'"></script>' . "\n"; 
    //     } 
    // } 
    ?>
</head>

<body>
    <!-- start navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <a class="navbar-brand" href="index.php">
            <img src="./image/logo/style-logo.png" alt="Logo" class="logo" width="140px" height="80px">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav custom-nav mx-auto">
                <li class="nav-item custom-nav-item">
                    <a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'index.php') {
                        echo 'active';
                    } ?>" href="index.php">Home</a>
                </li>
                <li class="nav-item custom-nav-item">
                    <a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'courses.php') {
                        echo 'active';
                    } ?>" href="courses.php">Courses</a>
                </li>
                <li class="nav-item custom-nav-item">
                    <a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'paymenthistory.php') {
                        echo 'active';
                    } ?>" href="paymenthistory.php">Transactions</a>
                </li>
                <?php
                if (isset($_SESSION['is_login'])) {
                    echo '
                <li class="nav-item custom-nav-item">
                    <a class="nav-link" href="./Student/stufeedback.php">Feedback</a>
                </li>';
                } else {
                    echo '
                <li class="nav-item custom-nav-item">
                    <a class="nav-link" href="#" data-toggle="modal" data-target="#stuLoginModalCenter">Feedback</a>
                </li>';
                }
                ?>
            </ul>

            <ul class="navbar-nav">
                <?php
                if (isset($_SESSION['is_login'])) {
                    echo '
                        <li class="nav-item custom-nav-btn">
                            <a class="btn btn-outline-light mr-2" style="border:1.5px solid white" href="student/studentProfile.php">My Profile</a>
                        </li>
                        <li class="nav-item custom-nav-btn">
                            <a class="btn btn-outline-light" style="border:1.5px solid white" href="logout.php">Logout</a>
                        </li>
                    ';
                } else if (isset($_SESSION['is_admin_login'])) {
                    echo '
                        <li class="nav-item custom-nav-btn">
                            <a class="btn btn-outline-light mr-2" style="border:1.5px solid white" href="admin/adminDashboard.php">Admin Profile</a>
                        </li>
                        <li class="nav-item custom-nav-btn">
                            <a class="btn btn-outline-light" style="border:1.5px solid white" href="logout.php">Logout</a>
                        </li>
                    ';
                } else {
                    echo '
                        <li class="nav-item custom-nav-btn">
                            <a class="btn btn-outline-light mr-2" style="border:1.5px solid white" href="#" data-toggle="modal" data-target="#stuLoginModalCenter">Login</a>
                        </li>
                        <li class="nav-item custom-nav-btn">
                            <a class="btn btn-outline-light" style="border:1.5px solid white" href="#" data-toggle="modal" data-target="#stuRegModalCenter">Signup</a>
                        </li>
                    ';
                }

                ?>
            </ul>
        </div>
    </nav>
    <!-- end navigation bar -->