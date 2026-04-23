<?php
// Start session once at the very beginning, before any output
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title><?php echo isset($page_title) ? $page_title : "Main Page"; ?></title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="../css/bootstrap.min.css">

  <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="../css/all.min.css">

  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@700&display=swap" rel="stylesheet">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="../css/adminstyle.css">

  <!-- jQuery -->
  <script src="../js/jquery.min.js"></script>

  <!-- Page-specific CSS -->
  <?php
  // if (isset($extra_css) && is_array($extra_css)) {
  //   foreach ($extra_css as $css) {
  //     echo '<link rel="stylesheet" href="' . $css . '">' . "\n";
  //   }
  // }
  ?>

  <!-- Page-specific JS -->
  <?php
  // if (isset($extra_js) && is_array($extra_js)) { 
  //   foreach ($extra_js as $js) { 
  //     echo '<script src="'.$js.'"></script>' . "\n"; 
  //   } 
  // } 
  ?>
</head>

<body>
  <!-- Top Navbar -->
  <nav class="navbar navbar-dark fixed-top flex-md-nowrap p-0 shadow" style="background-color: #000000ff; height: 55px;">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="adminDashboard.php">
      <img src="../image/logo/style-logo.png" alt="Logo" class="logo img-fluid" style="max-width:140px; height:auto;">
    </a>
  </nav>
  <!-- Side Bar -->
<div class="container-fluid mb-5 mt-5">
  <div class="row">
    <nav class="col-sm-3 col-md-2 bg-light sidebar d-print-none py-3"
      style="position: fixed; top: 55px; left: 0; height: calc(100vh - 55px); overflow-y: auto; z-index: 100;">
        <div class="sidebar-sticky">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) == 'index.php'){echo 'active';} ?>" href="../index.php">
                <i class="fa-solid fa-house"></i> home
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) == 'adminDashboard.php'){echo 'active';} ?>" href="adminDashboard.php">
                <i class="fas fa-tachometer-alt"></i> Dashboard
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) == 'courses.php'){echo 'active';} ?>" href="courses.php">
                <i class="fas fa-book"></i> Courses
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) == 'lessons.php'){echo 'active';} ?>" href="lessons.php">
                <i class="fas fa-chalkboard-teacher"></i> Lessons
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) == 'students.php'){echo 'active';} ?>" href="students.php">
                <i class="fas fa-users"></i> Students
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) == 'sellreport.php'){echo 'active';} ?>" href="sellreport.php">
                <i class="fas fa-table"></i> Sales Report
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) == 'adminpaymenthistory.php'){echo 'active';} ?>" href="adminpaymenthistory.php">
                <i class="fas fa-money-check-alt"></i> Pay History
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) == 'feedback.php'){echo 'active';} ?>" href="feedback.php">
                <i class="fas fa-comment-dots"></i> Feedback
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) == 'adminChangePass.php'){echo 'active';} ?>" href="adminChangePass.php">
                <i class="fas fa-key"></i> Change Pass
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php if(basename($_SERVER['PHP_SELF']) == 'logout.php'){echo 'active';} ?>" href="../logout.php">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </li>
          </ul>
        </div>
    </nav>
  
