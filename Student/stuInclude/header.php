<?php
include_once('../dbConnection.php');
if (!isset($_SESSION)) {
  session_start();
}

if (isset($_SESSION['is_login'])) {
  $stuLogEmail = $_SESSION['stuLogEmail'];
} else {
  echo "<script> location.href='../index.php'; </script>";
}

if (isset($stuLogEmail)) {
  $sql = "SELECT stu_img FROM student WHERE stu_email = '$stuLogEmail'";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  $stu_img = $row['stu_img'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- bootstrap css -->
  <link rel="stylesheet" href="../css/bootstrap.min.css">

  <!-- font awesome css -->
  <link rel="stylesheet" href="../css/all.min.css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@700&display=swap" rel="stylesheet">

  <!-- Custom styles -->
  <link rel="stylesheet" href="../css/stustyle.css">

  <!-- jQuery -->
  <script src="../js/jquery.min.js"></script>

  <title>
    <?php echo isset($page_title) ? $page_title : "Main-Pages"; ?>
  </title>

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
  //     foreach ($extra_js as $js) { 
  //         echo '<script src="'.$js.'"></script>' . "\n"; 
  //     } 
  // } 
  ?>
</head>

<body>

  <!-- Top Navbar -->
  <nav class="navbar navbar-dark fixed-top flex-md-nowrap p-0 shadow"
    style="background-color: #000000ff; height: 55px;">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="studentProfile.php"><img src="../image/logo/style-logo.png"
        alt="Logo" class="logo" width="140px" height="80px"></a>
  </nav>

  <!-- Sidebar -->
  <div class="container-fluid mb-5" style="margin-top:40px;">
    <div class="row">
      <nav class="col-sm-2 bg-light sidebar pt-3 d-print-none"
        style="position: fixed; top: 55px; left: 0; height: calc(100vh - 55px); overflow-y: auto; z-index: 100;">
        <div class="sidebar-sticky">
          <ul class="nav flex-column">
            <li class="nav-item mb-3">
              <img src="<?php echo $stu_img ?>" alt="studentimage" class="img-thumbnail rounded-circle" />
            </li>
            <li class="nav-item">
              <a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'index.php') {
                echo 'active';
              } ?>"
                href="../index.php">
                <i class="fa-solid fa-house"></i> Home
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'studentProfile.php') {
                echo 'active';
              } ?>"
                href="studentProfile.php">
                <i class="fas fa-user"></i> Profile
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'mycourse.php') {
                echo 'active';
              } ?>"
                href="mycourse.php">
                <i class="fab fa-accessible-icon"></i> My Courses
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'stufeedback.php') {
                echo 'active';
              } ?>"
                href="stufeedback.php">
                <i class="fas fa-comment-dots"></i> Feedback
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'studentChangePassword.php') {
                echo 'active';
              } ?>"
                href="studentChangePassword.php">
                <i class="fas fa-key"></i> Change Pass
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'logout.php') {
                echo 'active';
              } ?>"
                href="../logout.php">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </li>
          </ul>
        </div>
      </nav>